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
		if($this->input->get('type_search') == '0' && $this->input->get('event_city')!='' && $this->input->get('event_month')!='')
		{
			$month=$this->input->get('event_month');
			$mon=substr($month,0,3);
			$this->db->where('event_city_id',$this->input->get('event_city'));
			$this->db->like('event_date_time', $mon, 'both'); 
		}
		else if($this->input->get('type_search') == '0' && $this->input->get('event_city')!='' && $this->input->get('event_month')=='')
		{
			$this->db->where('event_city_id',$this->input->get('event_city'));
		}
		else if($this->input->get('type_search') == '0' && $this->input->get('event_city')=='' && $this->input->get('event_month')!='')
		{
			$month=$this->input->get('event_month');
			$mon=substr($month,0,3);
			$this->db->like('event_date_time', $mon, 'both'); 
		}
		else {
		if($this->input->get('event_city')!='' && $this->input->get('event_month')!='')
		{
			$month=$this->input->get('event_month');
			$mon=substr($month,0,3);
			$this->db->where('event_category',$this->input->get('type_search'));
			$this->db->where('event_city_id',$this->input->get('event_city'));
			$this->db->like('event_date_time', $mon, 'both'); 
		}
		else if($this->input->get('event_city')=='' && $this->input->get('event_month')!='')
		{
			$month=$this->input->get('event_month');
			$mon=substr($month,0,3);
			$this->db->where('event_category',$this->input->get('type_search'));
			$this->db->like('event_date_time', $mon, 'both'); 
		}
		else if($this->input->get('event_city')!='' && $this->input->get('event_month')=='')
		{
			$this->db->where('event_category',$this->input->get('type_search'));
			$this->db->where('event_city_id',$this->input->get('event_city'));
		}
		}
		/* if($this->input->get('event_city')!='')
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
		} */
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
		$this->db->join('univ_program','univ_program.prog_parent_id = program_parent.prog_parent_id');
		if($this->input->post('educ_level')!='0')
		{
		$this->db->where('univ_program.prog_educ_level',$this->input->post('educ_level'));
		}
		$this->db->group_by("program_parent.prog_parent_id"); 
		$query=$this->db->get();
		return $query->result_array();
	}
	
	function get_country_id_by_name($country_name)
	{
		$this->db->select('country_id');
		$this->db->from('country');
		$this->db->where('country_name',$country_name);
		$res=$this->db->get();
		if($res->num_rows()>0)
		{
		 return $res->row_array();
		}
		else
		{
		return 0;
		}
	}
	function get_city_id_by_name($cityname){
		$this->db->select('city_id');
		$this->db->from('city');
		$this->db->where('cityname',$cityname);
		$res=$this->db->get();
		if($res->num_rows()>0)
		{
		 return $res->row_array();
		}
		else
		{
		return 0;
		}
	}
	function get_educ_level_id_by_name($educ_level)
	{
		$this->db->select('prog_edu_lvl_id');
		$this->db->from('program_educ_level');
		$this->db->where('educ_level',$educ_level);
		$res=$this->db->get();
		if($res->num_rows()>0)
		{
		 return $res->row_array();
		}
		else
		{
		return 0;
		}
	}
	function get_area_intrest_id_by_name($area_interest)
	{
		$area_interest=trim($area_interest);
		$this->db->select('prog_parent_id');
		$this->db->from('program_parent');
		$this->db->where('program_parent_name',$area_interest);
		$res=$this->db->get();
		if($res->num_rows()>0)
		{
		 return $res->row_array();
		}
		else
		{
		return 0;
		}
	}
	
	//college page filteration,list of college,paging 
//1.list of college
			/*		function show_all_college()
						{
							if($results->num_rows()>$univ_data['limit_res']);
							{
							$this->db->select('*');
							$this->db->from('university');
							$chk_sc_sel=0;
							$chk_c_id=0;
							if($search_course!='' && $search_course!='0')
							{
							$search_array['univ_program.prog_parent_id']=$search_course;
							$chk_sc_sel++;
							}
							if($type_educ_level!='' && $type_educ_level!=0)
							{
							$search_array['univ_program.prog_educ_level']=$type_educ_level;
							$chk_sc_sel++;
							}
							if($search_country!='' && $search_country!=0)
							{
							$search_array['country_id']=$search_country;
							$chk_c_id=1;
							//$this->db->where('country_id',trim($search_country));
							}
							if($search_program!='' && $search_program!=0)
							{
							$search_array['univ_program.program_id']=$search_program;
							$chk_sc_sel++;
							}
							if($chk_sc_sel>0 || $chk_c_id)
							{
							if($chk_sc_sel>0)
							{
							$this->db->join('univ_program','univ_program.univ_id=university.univ_id','left');
							}
							}
							$this->db->group_by("university.univ_id"); 
							$this->db->limit($univ_data['limit_res']);
							$this->db->where($search_array);
							$results = $this->db->get();
							}
				if($results->num_rows()>0)
				{
							$res_of_univ_search1 = $results->result_array();
							//print_r($res_of_univ_search1);
							foreach($res_of_univ_search1 as $univ_search_result)
							{	
									$university_id=$univ_search_result['univ_id'];
									$this->db->select('*');
									$this->db->from('university');
									$this->db->where('univ_id',$university_id);
									$this->db->join('country','country.country_id=university.country_id','left');
									$results=$this->db->get();
									$university_detail[] = $results->row_array();
									$univ_follow[] = $this->users->get_followers_of_univ($university_id);
									$univ_article[] = $this->users->get_articles_of_univ($university_id);
									$univ_program[] = $this->users->get_program_provide_by_univ($university_id);
									$univ_question[] = $this->users->get_question_by_univ($university_id);
									$univ_event[] = $this->users->get_upcoming_event_by_univ($university_id);
									
									if ($this->tank_auth->is_logged_in()) {	
									$user_id	= $this->tank_auth->get_user_id();
									$add_follower = array(
										'follow_to_univ_id' => $university_id,
										'followed_by' => $user_id
										); 
									$is_already_follow[] = $this->users->check_is_already_followed($add_follower);
									}
									else
									{
									$is_already_follow[] = 0;
									}
							}		
							$univ_data['university'] = $university_detail;
							$univ_data['followers'] = $univ_follow;
							$univ_data['article'] = $univ_article;
							$univ_data['program'] = $univ_program;
							$univ_data['questions'] = $univ_question;
							$univ_data['is_already_follow']	=$is_already_follow	;
							$univ_data['univ_event']	=$univ_event	;
							
							//$univ_data['total_univ']=$total_result;
							//$univ_data['position'] = $marker;
							return $univ_data;
				}
				else{
				return 0;
				}
			
		}
*/		
		
//2.paging
function show_all_college_paging($current_url)
	{
						$univ_data['total_res']=0;
						$univ_data['limit_res']=25;
						$pos = strpos($current_url,'colleges/');
						$filter_country=0;
						$filter_educ_level=0;
						$filter_area_interest=0;
						$offset=$this->input->post('offset');
						if($pos>0)
						{
						$arr=explode('colleges/',$current_url);
						if(count($arr)>0 )
						{
						if($arr[1]!='' && $arr[1]!=NULL)
						{
						 $filter_content=explode('/',$arr[1]);
						for($f=0;$f<count($filter_content);$f++)
						{
						  $chk_country=$this->searchmodel->get_country_id_by_name($filter_content[$f]);
						  if($chk_country!=0)
						  {
						   $country_id[]=$chk_country['country_id'];
						   $filter_country=1;
						   continue;
						  }
						  $chk_educ_level=$this->searchmodel->get_educ_level_id_by_name($filter_content[$f]);
						  if($chk_educ_level!=0)
						  {
						  $educ_level[]=$chk_educ_level['prog_edu_lvl_id'];
						  $filter_educ_level=1;
						  continue;
						  }
						  $chk_area_intrest=$this->searchmodel->get_area_intrest_id_by_name($filter_content[$f]);
						  if($chk_area_intrest!=0)
						  {
						  $area_interest[]=$chk_area_intrest['prog_parent_id'];
						  $filter_area_interest=1;
						  continue;
						  }
						  
						}
						}
						}
						else
						{
						$filter_content=0;
						}
						
					}	
						$join=" LEFT JOIN  `events` ON events.event_univ_id = university.univ_id";
						$where='';
						if($filter_country==1)
						{
						$country_ids=implode(",",$chk_country);
						$where.=" and university.country_id IN (".$country_ids.")";
						}
						if($filter_educ_level==1 )
						{
						$educ_level_ids=implode(",",$chk_educ_level);
						$join.=' JOIN univ_program ON univ_program.univ_id=university.univ_id';
						$where.=" and univ_program.prog_educ_level IN(".$educ_level_ids.")";
						}
						if($filter_area_interest==1)
						{
						if($filter_educ_level!=1)
						$join.=' JOIN univ_program ON univ_program.univ_id=university.univ_id';
						$area_interest_ids=implode(',',$chk_area_intrest);
						$where.=" and univ_program.prog_parent_id IN('".$area_interest_ids."')";
						}
						/*$this->db->join('events','events.event_univ_id=university.univ_id','left');
						//$this->db->order_by('STR_TO_DATE(,"%d %M %Y")');
						$this->db->group_by("university.univ_id"); 
						$this->db->order_by("STR_TO_DATE(event_date_time,`'%d %m %Y'')");
						$results = $this->db->get();*/
						$sql = "SELECT *,STR_TO_DATE( `events`.`event_date_time`,  '%d %M %Y' )  as dt , if(STR_TO_DATE( `events`.`event_date_time`,  '%d %M %Y' ) is null ,3, if(STR_TO_DATE( `events`.`event_date_time`,  '%d %M %Y' )>= '".date('Y-m-d')."' ,1,2)) as st FROM university".$join."  where 1 ".$where." GROUP BY university.univ_id order by st asc,dt asc LIMIT ".$offset.",".$univ_data['limit_res']."";
						$results=$this->db->query($sql);
						$univ_data['per_page_res']=$results->num_rows();
						
			if($results->num_rows()>0)
			{
						$res_of_univ_search1 = $results->result_array();
						foreach($res_of_univ_search1 as $univ_search_result)
						{	
								$university_id=$univ_search_result['univ_id'];
								$this->db->select('*');
								$this->db->from('university');
								$this->db->join('country','country.country_id=university.country_id','left');
								$this->db->where('univ_id',$university_id);
								$results=$this->db->get();
								$university_detail[] = $results->row_array();
								$marker[] = $univ_search_result['address_line1'].'||'.$univ_search_result['univ_name'].'||'.$univ_search_result['address_line1'];
								$univ_follow[] = $this->users->get_followers_of_univ($university_id);
								$univ_article[] = $this->users->get_articles_of_univ($university_id);
								$univ_program[] = $this->users->get_program_provide_by_univ($university_id);
								$univ_question[] = $this->users->get_question_by_univ($university_id);
								$univ_event[] = $this->users->get_upcoming_event_by_univ($university_id);
								
								if ($this->tank_auth->is_logged_in()) {	
								$user_id	= $this->tank_auth->get_user_id();
								$add_follower = array(
									'follow_to_univ_id' => $university_id,
									'followed_by' => $user_id
									); 
								$is_already_follow[] = $this->users->check_is_already_followed($add_follower);
								}
								else
								{
								$is_already_follow[] = 0;
								}
						}		
						$univ_data['university'] = $university_detail;
						$univ_data['followers'] = $univ_follow;
						$univ_data['article'] = $univ_article;
						$univ_data['program'] = $univ_program;
						$univ_data['position'] = $marker;
						$univ_data['questions'] = $univ_question;
						$univ_data['is_already_follow']	=$is_already_follow	;
						$univ_data['univ_event']	=$univ_event	;
						
						
						return $univ_data;
			}
			else{
			return 0;
			}
		
	}		
//3.filteration
				function show_all_college_filteration($current_url)
				{
						$univ_data['filter_area_intrest']=array(0);
						$univ_data['filter_country']=array(0);
						$univ_data['filter_educ_level']=array(0);
						//$current_url=str_replace('-',',',$current_url);
						$current_url=str_replace('_',' ',$current_url);
						
						$pos = strpos($current_url,'colleges/');
						$filter_country=0;
						$filter_educ_level=0;
						$filter_area_interest=0;
						if($pos>0)
						{
						$arr=explode('colleges/',$current_url);
						if(count($arr)>0 )
						{
						if($arr[1]!='' && $arr[1]!=NULL)
						{
						 $filter_content=explode('/',$arr[1]);
						for($f=0;$f<count($filter_content);$f++)
						{
						  $chk_country=$this->searchmodel->get_country_id_by_name($filter_content[$f]);
						  if($chk_country!=0)
						  {
						   $country_id[]=$chk_country['country_id'];
						   $univ_data['filter_country'][]=$chk_country['country_id'];
						   $filter_country=1;
						   continue;
						  }
						  $chk_educ_level=$this->searchmodel->get_educ_level_id_by_name($filter_content[$f]);
						  if($chk_educ_level!=0)
						  {
						  $educ_level[]=$chk_educ_level['prog_edu_lvl_id'];
						  $filter_educ_level=1;
						  $univ_data['filter_educ_level'][]=$chk_educ_level['prog_edu_lvl_id'];  
						  continue;
						  }
						  $chk_area_intrest=$this->searchmodel->get_area_intrest_id_by_name($filter_content[$f]);
						  if($chk_area_intrest!=0)
						  {
						  $area_interest[]=$chk_area_intrest['prog_parent_id'];
						  $filter_area_interest=1;
						  $univ_data['filter_area_intrest'][]=$chk_area_intrest['prog_parent_id'];
						  continue;
						  }
						}
						}
						}
						else
						{
						$filter_content=0;
						}
						
					}	
						$univ_data['total_res']=0;
						$univ_data['limit_res']=25;
						//$this->db->select('*');
						//$this->db->from('university');
						$join=" LEFT JOIN  `events` ON events.event_univ_id = university.univ_id";
						$where='';
						if($filter_country==1)
						{
						$country_ids=implode(",",$country_id);
						$where.=" and university.country_id IN (".$country_ids.")";
						}
						if($filter_educ_level==1 )
						{
						$educ_level_ids=implode(",",$educ_level);
						$join.=' JOIN univ_program ON univ_program.univ_id=university.univ_id';
						$where.=" and univ_program.prog_educ_level IN(".$educ_level_ids.")";
						}
						if($filter_area_interest==1)
						{
						if($filter_educ_level!=1)
						$join.=' JOIN univ_program ON univ_program.univ_id=university.univ_id';
						$area_interest_ids=implode(',',$area_interest);
						$where.=" and univ_program.prog_parent_id IN(".$area_interest_ids.")";
						}

						/*$this->db->join('events','events.event_univ_id=university.univ_id','left');
						//$this->db->order_by('STR_TO_DATE(,"%d %M %Y")');
						$this->db->group_by("university.univ_id"); 
						$this->db->order_by("STR_TO_DATE(event_date_time,`'%d %m %Y'')");
						$results = $this->db->get();*/
						$sql = "SELECT *,STR_TO_DATE( `events`.`event_date_time`,  '%d %M %Y' )  as dt , if(STR_TO_DATE( `events`.`event_date_time`,  '%d %M %Y' ) is null ,3, if(STR_TO_DATE( `events`.`event_date_time`,  '%d %M %Y' )>= '".date('Y-m-d')."' ,1,2)) as st FROM university".$join."  where 1 ".$where." GROUP BY university.univ_id order by st asc,dt asc";
						$results=$this->db->query($sql);
						$univ_data['total_res']=$results->num_rows();
						if($results->num_rows()>$univ_data['limit_res']);
						{
						$univ_data['per_page_res']=$univ_data['limit_res'];
						}
						if($results->num_rows()<=$univ_data['limit_res'])
						{
						$univ_data['per_page_res']=$univ_data['total_res'];
						}
						$sql = "SELECT *,STR_TO_DATE( `events`.`event_date_time`,  '%d %M %Y' )  as dt , if(STR_TO_DATE( `events`.`event_date_time`,  '%d %M %Y' ) is null ,3, if(STR_TO_DATE( `events`.`event_date_time`,  '%d %M %Y' )>= '".date('Y-m-d')."' ,1,2)) as st FROM university".$join."  where 1 ".$where." GROUP BY university.univ_id order by st asc,dt asc LIMIT 0,".$univ_data['limit_res']."";
						//$this->db->limit($univ_data['limit_res']);
						//$results = $this->db->get();
						$results=$this->db->query($sql);
						
			if($results->num_rows()>0)
			{
			
						$res_of_univ_search1 = $results->result_array();
						//print_r($res_of_univ_search1);
						foreach($res_of_univ_search1 as $univ_search_result)
						{	
								$university_id=$univ_search_result['univ_id'];
								$this->db->select('*');
								$this->db->from('university');
								$this->db->join('country','country.country_id=university.country_id','left');
								$this->db->where('univ_id',$university_id);
								$results=$this->db->get();
								$university_detail[] = $results->row_array();
								$univ_follow[] = $this->users->get_followers_of_univ($university_id);
								$univ_article[] = $this->users->get_articles_of_univ($university_id);
								$univ_program[] = $this->users->get_program_provide_by_univ($university_id);
								$univ_question[] = $this->users->get_question_by_univ($university_id);
								$univ_event[] = $this->users->get_upcoming_event_by_univ($university_id);
								
								if ($this->tank_auth->is_logged_in()) {	
								$user_id	= $this->tank_auth->get_user_id();
								$add_follower = array(
									'follow_to_univ_id' => $university_id,
									'followed_by' => $user_id
									); 
								$is_already_follow[] = $this->users->check_is_already_followed($add_follower);
								}
								else
								{
								$is_already_follow[] = 0;
								}
						}		
						$univ_data['university'] = $university_detail;
						$univ_data['followers'] = $univ_follow;
						$univ_data['article'] = $univ_article;
						$univ_data['program'] = $univ_program;
						$univ_data['questions'] = $univ_question;
						$univ_data['is_already_follow']	=$is_already_follow	;
						$univ_data['univ_event']	=$univ_event	;
						
						//$univ_data['total_univ']=$total_result;
						//$univ_data['position'] = $marker;
						return $univ_data;
			}
			else{
			$univ_data['university']=array();
			return $univ_data;
			}
						
					
					
		
		
	}
//filteration end	
	
	//event filetration
	function all_event_filteration($current_url){
	
		$events_data['filter_event_type']=array();
		$events_data['filter_country']=array();
		$events_data['filter_city']=array();
		$current_url=str_replace('_',' ',$current_url);
		if($this->input->post('event_month'))
		{
		$month=$this->input->post('event_month');
		}
		else
		{
		$month='';
		}
		$pos = strpos($current_url,'events/');
		$filter_event_types=0;
		$filter_country=0;
		$filter_city=0;
		if($pos>0)
		{
			$arr=explode('events/',$current_url);
			if(count($arr)>0 )
			{
				if($arr[1]!='' && $arr[1]!=NULL)
				{
					$filter_content=explode('/',$arr[1]);
					for($f=0;$f<count($filter_content);$f++)
					{
					    $chk_country=$this->searchmodel->get_country_id_by_name($filter_content[$f]);
						if($chk_country!=0)
						{
							$country_id[]=$chk_country['country_id'];
							$events_data['filter_country'][]=$chk_country['country_id'];
							$filter_country=1;
							continue;
						}
						
						$chk_city=$this->searchmodel->get_city_id_by_name($filter_content[$f]);
						if($chk_city!=0)
						{
							$city_id[]=$chk_city['city_id'];
							$events_data['filter_city'][]=$chk_city['city_id'];
							$filter_city=1;
							continue;
						}
						if($chk_country==0 && $chk_city==0)
						{
						 
						 if($filter_content[$f]=='spot admission')
						 {
						 $events_data['filter_event_type'][]='spot_admission';
						 $event_type_list='spot_admission';
						 $filter_event_types=1; 
						 continue;
						 }
						 else if($filter_content[$f]=='fairs')
						 {
						  $events_data['filter_event_type'][]='fairs';
						  $event_type_list='fairs';
						  $filter_event_types=1;	
						  continue;
						 }
						 else if($filter_content[$f]=='counselling')
						 {
						 $events_data['filter_event_type'][]='others'; 
						 $event_type_list='alumuni';
						 $event_type_list='others'; 
						 $events_data['filter_event_type'][]='alumuni';
						 $filter_event_types=1;
						 continue;						  
						 } 
							
						}	
					}
				}
			}
			else
			{
				$filter_content=0;
			}
		}	
			$events_data['total_res']=0;
			$events_data['limit_res']=10;
			$join=" LEFT JOIN  `university` ON events.event_univ_id = university.univ_id LEFT JOIN country ON country.country_id = events.event_country_id LEFT JOIN  state ON state.state_id = events.event_state_id LEFT JOIN city ON city.city_id = events.event_city_id";
			
			$where='';
			if($filter_country==1)
			{
				$country_ids=implode(",",$country_id);
				$where.=" and events.event_country_id IN (".$country_ids.")";
			}
			if($filter_event_types==1 )
			{
				$event_type=implode("','",$events_data['filter_event_type']);
			    $where.=" and events.event_category IN('".$event_type."')";
			}
			
			if($filter_city==1)
			{
				$city_ids=implode(",",$city_id);
				$where.=" and events.event_city_id IN(".$city_ids.")";
			}
			if($month!='')
			{
			$where=" and events.event_date_time LIKE '%$month%' ";
			}
			$where.=" and STR_TO_DATE( `events`.`event_date_time`,  '%d %M %Y' )>='".date('Y-m-d')."'";
			$sql = "SELECT *,STR_TO_DATE( `events`.`event_date_time`,  '%d %M %Y' )  as dt FROM events".$join."  where 1 ".$where." order by dt asc";
			
			$results=$this->db->query($sql);
			$events_data['total_res']=$results->num_rows();
			if($results->num_rows()>$events_data['limit_res']);
			{
				$events_data['per_page_res']=$events_data['limit_res'];
			}
			if($results->num_rows()<=$events_data['limit_res'])
			{
				$events_data['per_page_res']=$events_data['total_res'];
			}
			$sql = "SELECT *,STR_TO_DATE( `events`.`event_date_time`,  '%d %M %Y' )  as dt FROM events".$join."  where 1 ".$where." order by dt asc LIMIT 0,".$events_data['limit_res']."";
			
			$results=$this->db->query($sql);
			
			if($results->num_rows()>0)
			{
			  $events_data['event_res'] = $results->result_array();
				return $events_data;
			}else{
				$events_data['event_res']=array();
				return $events_data;
			}
		
	}
	
	function show_events_paging($current_url)
	{
		$events_data['filter_event_type']=array();
		$events_data['filter_country']=array();
		$events_data['filter_city']=array();
		$current_url=str_replace('_',' ',$current_url);
		$offset=$this->input->post('offset');
		$pos = strpos($current_url,'events/');
		$filter_event_types=0;
		$filter_country=0;
		$filter_city=0;
		if($pos>0)
		{
			$arr=explode('events/',$current_url);
			if(count($arr)>0 )
			{
				if($arr[1]!='' && $arr[1]!=NULL)
				{
					$filter_content=explode('/',$arr[1]);
					for($f=0;$f<count($filter_content);$f++)
					{
					    $chk_country=$this->searchmodel->get_country_id_by_name($filter_content[$f]);
						if($chk_country!=0)
						{
							$country_id[]=$chk_country['country_id'];
							$events_data['filter_country'][]=$chk_country['country_id'];
							$filter_country=1;
							continue;
						}
						
						$chk_city=$this->searchmodel->get_city_id_by_name($filter_content[$f]);
						if($chk_city!=0)
						{
							$city_id[]=$chk_city['city_id'];
							$events_data['filter_city'][]=$chk_city['city_id'];
							$filter_city=1;
							continue;
						}
						if($chk_country==0 && $chk_city==0)
						{
						 
						 if($filter_content[$f]=='spot admission')
						 {
						 $events_data['filter_event_type'][]='spot_admission';
						 $event_type_list='spot_admission';
						 $filter_event_types=1; 
						 continue;
						 }
						 else if($filter_content[$f]=='fairs')
						 {
						  $events_data['filter_event_type'][]='fairs';
						  $event_type_list='fairs';
						  $filter_event_types=1;	
						  continue;
						 }
						 else if($filter_content[$f]=='counselling')
						 {
						 $events_data['filter_event_type'][]='counselling'; 
						 $event_type_list='alumuni';
						 $event_type_list='others'; 
						 $events_data['filter_event_type'][]='';
						 $filter_event_types=1;
						 continue;						  
						 } 
							
						}	
					}
				}
			}
			else
			{
				$filter_content=0;
			}
		}	
			$events_data['total_res']=0;
			$events_data['limit_res']=10;
			$join=" LEFT JOIN  `university` ON events.event_univ_id = university.univ_id LEFT JOIN country ON country.country_id = events.event_country_id LEFT JOIN  state ON state.state_id = events.event_state_id LEFT JOIN city ON city.city_id = events.event_city_id";
			$where='';
			if($filter_country==1)
			{
				$country_ids=implode(",",$country_id);
				$where.=" and events.event_country_id IN (".$country_ids.")";
			}
			if($filter_event_types==1 )
			{
				$event_type=implode("','",$events_data['filter_event_type']);
			    $where.=" and events.event_category IN('".$event_type."')";
			}
			
			if($filter_city==1 )
			{
				$city_ids=implode(",",$city_id);
				$where.=" and events.event_city_id IN(".$city_ids.")";
			}
			$where.=" and STR_TO_DATE( `events`.`event_date_time`,  '%d %M %Y' )>='".date('Y-m-d')."'";
			$sql = "SELECT *,STR_TO_DATE( `events`.`event_date_time`,  '%d %M %Y' )  as dt FROM events".$join."  where 1 ".$where." order by dt asc LIMIT ".$offset.",".$events_data['limit_res']."";
			
			$results=$this->db->query($sql);
			$events_data['per_page_res']=$results->num_rows();
			
			$results=$this->db->query($sql);
			
			if($results->num_rows()>0)
			{
			  $events_data['event_res'] = $results->result_array();
				return $events_data;
			}else{
				$events_data['event_res']=array();
				return $events_data;
			}
		
	}
	
	
	function get_event_id_by_event_type($event_type){
		$this->db->select('event_id');
		$this->db->from('events');
		$this->db->where('event_category',$event_type);
		$res=$this->db->get();
		if($res->num_rows()>0)
		{
		 return $res->row_array();
		}
		else
		{
		return 0;
		}
	}
	
	function set_the_image($img_width,$img_height,$div_width,$div_height,$flag)
    {
			
		    $data = $this->searchmodel->ScaleImage($img_width, $img_height, $div_width, $div_height,$flag);
			return $data;
	
	}	
	
	function ScaleImage($srcwidth, $srcheight, $targetwidth, $targetheight, $fLetterBox) {
	$result = array( 'width'=>0, 'height'=>0, 'fScaleToTargetWidth'=>true);

    if (($srcwidth <= 0) || ($srcheight <= 0) || ($targetwidth <= 0) || ($targetheight <= 0)) {
        return $result;
    }
    if($srcwidth<$targetwidth && $srcheight<$targetheight)
	{
	$result = array('width'=>$srcwidth, 'height'=>$srcheight);
	$result['targetleft'] =floor(($targetwidth - $result['width']) / 2);
	$result['targettop'] = floor(($targetheight - $result['height']) / 2);
	 return $result;
	}
	
    // scale to the target width
    $scaleX1 = $targetwidth;
    $scaleY1 = ($srcheight * $targetwidth) / $srcwidth;

    // scale to the target height
    $scaleX2 = ($srcwidth * $targetheight) / $srcheight;
    $scaleY2 = $targetheight;

    // now figure out which one we should use
    $fScaleOnWidth = ($scaleX2 > $targetwidth);
    if ($fScaleOnWidth) {
        $fScaleOnWidth = $fLetterBox;
    }
    else {
        $fScaleOnWidth = !$fLetterBox;
    }

    if ($fScaleOnWidth) {
        $result['width'] = floor($scaleX1);
        $result['height'] = floor($scaleY1);
        $result['fScaleToTargetWidth'] = true;
    }
    else {
        $result['width'] = floor($scaleX2);
        $result['height'] = floor($scaleY2);
        $result['fScaleToTargetWidth'] = false;
    }
     $result['targetleft'] = floor(($targetwidth - $result['width']) / 2);
	 $result['targettop'] = floor(($targetheight - $result['height']) / 2);
   return $result;
}
	
	
		
}