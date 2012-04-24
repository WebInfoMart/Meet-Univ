<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Searchmodel extends CI_Model
{
	private $table_name			= 'users';			// user accounts
	private $profile_table_name	= 'user_profiles';	// user profiles
	var $gallery_path;
	//var $gallery_path_url;
	
	function __construct()
	{
		parent::__construct();
		$this->gallery_path = realpath(APPPATH . '../uploads');
		//$this->gallery_path_url = base_url().'uploads/';
		$ci =& get_instance();
		$this->table_name			= $ci->config->item('db_table_prefix', 'tank_auth').$this->table_name;
		$this->profile_table_name	= $ci->config->item('db_table_prefix', 'tank_auth').$this->profile_table_name;
		//$this->program_parent	= $ci->config->item('db_table_prefix', 'tank_auth').$this->program_parent;
		//$this->program_educ_level	= $ci->config->item('db_table_prefix', 'tank_auth').$this->program_educ_level;
		//$this->country	= $ci->config->item('db_table_prefix', 'tank_auth').$this->country;
		
	}

	function get_collages_by_search($type_educ_level,$search_country,$search_course)
	{
		if($type_educ_level != '' and $search_country != '' and $search_course != '')
		{
		
		$this->db->select('univ_id');
		$this->db->from('university');
		if($search_country!='')
		{
		$this->db->where('country_id',trim($search_country));
		}
		$rows_univ = $this->db->get();
		$rows_univ_table = $rows_univ->result_array();
		$this->db->select('univ_id');
		if($search_course!='')
		{
		$this->db->where('program_id',trim($search_course));         
		} 
		$rows_univ_program = $this->db->get('univ_program');
		$rows_univ_program_table = $rows_univ_program->result_array();
		$arr = array();
		if($rows_univ->num_rows() > 0 || $rows_univ_program->num_rows() > 0)
		{
			foreach($rows_univ_table as $univ_table)
			{
				 $univ_id_one = $univ_table['univ_id'];
				foreach($rows_univ_program_table as $univ_prog_table)
				{
					 $univ_prog_table = $univ_prog_table['univ_id'];
					if(trim($univ_id_one) == trim($univ_prog_table))
					{
						//echo $univ_prog_table;
						$this->db->select('*');
						$this->db->from('university');
						$this->db->where('univ_id',$univ_prog_table);
						$results = $this->db->get();
						$res_of_univ_search = $results->row_array();
						$arr[] = $results->row_array();
						$marker[] = $res_of_univ_search['latitude'].','.$res_of_univ_search['longitude'].','.$res_of_univ_search['univ_name'].','.$res_of_univ_search['address_line1'];
						$univ_follow[] = $this->users->get_followers_of_univ($univ_prog_table);
						$univ_article[] = $this->users->get_articles_of_univ($univ_prog_table);
						$univ_program[] = $this->users->get_program_provide_by_univ($univ_prog_table);
						
					}
					
				}
			}
			$univ_data=array();
			$univ_data['university'] = $arr;
			$univ_data['followers'] = $univ_follow;
			$univ_data['article'] = $univ_article;
			$univ_data['program'] = $univ_program;
			$univ_data['position'] = $marker;
			//print_r(univ_data);
			if(!empty($univ_data))
			{
			return $univ_data;
			}
			else{
			return 0;
			}
		}
		
	}
	else if($type_educ_level == 0 and $search_country != '' and $search_course == '')
	{
						$this->db->select('*');
						$this->db->from('university');
						$this->db->where('country_id',$search_country);
						$results = $this->db->get();
						$res_of_univ_search = $results->row_array();
						$arr[] = $results->row_array();
						$univ_follow[] = $this->users->get_followers_of_univ($univ_prog_table);
						$univ_article[] = $this->users->get_articles_of_univ($univ_prog_table);
						$univ_program[] = $this->users->get_program_provide_by_univ($univ_prog_table);	
						$marker[] = $res_of_univ_search['latitude'].','.$res_of_univ_search['longitude'].','.$res_of_univ_search['univ_name'].','.$res_of_univ_search['address_line1'];
						//return $arr;
						$univ_data=array();
						$univ_data['university'] = $arr;
						$univ_data['followers'] = $univ_follow;
						$univ_data['article'] = $univ_article;
						$univ_data['program'] = $univ_program;
						$univ_data['position'] = $marker;
						//print_r(univ_data);
						if(!empty($univ_data))
						{
						return $univ_data;
						}
						else{
						return 0;
						}
	}
	
	else if($type_educ_level != 0 and $type_educ_level != '' and $search_country != '' and $search_course == '')
	{
		$this->db->select('univ_id');
		$this->db->from('university');
		$this->db->where('country_id',trim($search_country));
		$rows_univ = $this->db->get();
		$rows_univ_table = $rows_univ->result_array();
		
		$this->db->select('univ_id');
		$this->db->where('curr_educ_level_id',trim($type_educ_level));
		$rows_univ_program = $this->db->get('univ_program');
		$rows_univ_program_table = $rows_univ_program->result_array();
		
		if($rows_univ->num_rows() > 0 && $rows_univ_program->num_rows() > 0)
		{
			foreach($rows_univ_table as $univ_table)
			{
				 $univ_id_one = $univ_table['univ_id'];
				foreach($rows_univ_program_table as $univ_prog_table)
				{
					 $univ_prog_table = $univ_prog_table['univ_id'];
					if(trim($univ_id_one) == trim($univ_prog_table))
					{
						//echo $univ_prog_table;
						$this->db->select('*');
						$this->db->from('university');
						$this->db->where('univ_id',$univ_prog_table);
						$results = $this->db->get();
						$res_of_univ_search = $results->row_array();
						$arr[] = $results->row_array();
						$univ_follow[] = $this->users->get_followers_of_univ($univ_prog_table);
						$univ_article[] = $this->users->get_articles_of_univ($univ_prog_table);
						$univ_program[] = $this->users->get_program_provide_by_univ($univ_prog_table);
						$marker[] = $res_of_univ_search['latitude'].','.$res_of_univ_search['longitude'].','.$res_of_univ_search['univ_name'].','.$res_of_univ_search['address_line1'];
					}
					
				}
			}
			$univ_data=array();
			$univ_data['university'] = $arr;
			$univ_data['followers'] = $univ_follow;
			$univ_data['article'] = $univ_article;
			$univ_data['program'] = $univ_program;
			$univ_data['position'] = $marker;
			//print_r(univ_data);
			if(!empty($univ_data))
			{
			return $univ_data;
			}
			else{
			return 0;
			}
		}
	}
	}
	
	
	
	
	
	function get_collages_by_search1($type_educ_level,$search_country,$search_course)
	{
		
						$this->db->select('*');
						$this->db->from('university');
						$this->db->join('univ_program','univ_program.univ_id=university.univ_id','left');
						$this->db->group_by("university.univ_id"); 
						$chk=0;
						if($search_course!='' && $search_course!='0')
						{
						$search_array['univ_program.prog_parent_id']=$search_course;
						$chk++;
						}
						if($type_educ_level!='' && $type_educ_level!=0)
						{
						$search_array['univ_program.prog_educ_level']=$type_educ_level;
						$ckh++;
						}
						if($search_country!='')
						{
						$search_array['country_id']=$search_country;
						$chk++;
						//$this->db->where('country_id',trim($search_country));
						}
						if($chk>0)
						{
						$this->db->where($search_array);
						}
						$results = $this->db->get();
						//echo $results->num_rows();
			if($results->num_rows()>0)
			{
						$res_of_univ_search1 = $results->result_array();
						foreach($res_of_univ_search1 as $univ_search_result)
						{	
								$university_id=$univ_search_result['univ_id'];
								$this->db->select('*');
								$this->db->from('university');
								$this->db->where('univ_id',$university_id);
								$results=$this->db->get();
								$university_detail[] = $results->row_array();
								$marker[] = $univ_search_result['address_line1'].'||'.$univ_search_result['univ_name'].'||'.$univ_search_result['address_line1'];
								$univ_follow[] = $this->users->get_followers_of_univ($university_id);
								$univ_article[] = $this->users->get_articles_of_univ($university_id);
								$univ_program[] = $this->users->get_program_provide_by_univ($university_id);
						}		
						$univ_data=array();
						$univ_data['university'] = $university_detail;
						$univ_data['followers'] = $univ_follow;
						$univ_data['article'] = $univ_article;
						$univ_data['program'] = $univ_program;
						$univ_data['position'] = $marker;
						return $univ_data;
			}
			else{
			return 0;
			}
		
		
	}
	
	function serach_events()
	{
		$this->db->select('*');
		$this->db->from('events');
		$this->db->join('university','events.event_univ_id=university.univ_id');
		$this->db->join('city','city.city_id=events.event_city_id','left');
		$this->db->join('state','state.state_id=events.event_state_id','left');
		$this->db->join('country','country.country_id=events.event_country_id','left');
		if($this->input->get('event_city')!='')
		{
		$this->db->where('event_city_id',$this->input->get('event_city'));
		}
		if($this->input->get('type_search')!='0')
		{
		$this->db->where('event_category',$this->input->get('type_search'));
		}
		if($this->input->get('event_month')!='')
		{
		$month=$this->input->get('event_month');
		$mon=substr($month,0,3);
		$this->db->like('event_date_time', $mon, 'both'); 
		}
		$query=$this->db->get();
		if($query->num_rows()>0)
		{
		return $query->result_array();
		}
		else
		{
		return 0;
		}
	}
	
	function fetch_program_list_ajax()
	{
		$this->db->select('*');
		$this->db->from('program_parent');
		$this->db->join('program','program.prog_parent_id=program_parent.prog_parent_id','left');
		if($this->input->post('educ_level')!='0')
		{
		$this->db->where('program.educ_level_id',$this->input->post('educ_level'));
		}
		$this->db->group_by("program_parent.prog_parent_id"); 
		$query=$this->db->get();
		return $query->result_array();
	}
}