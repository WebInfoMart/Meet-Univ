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
		$this->db->where('country_id',trim($search_country));
		$rows_univ = $this->db->get();
		$rows_univ_table = $rows_univ->result_array();
		
		$this->db->select('univ_id');
		$this->db->where('program_id',trim($search_course));
		$rows_univ_program = $this->db->get('univ_program');
		$rows_univ_program_table = $rows_univ_program->result_array();
		$arr = array();
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
}