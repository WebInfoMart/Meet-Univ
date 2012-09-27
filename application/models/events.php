<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

/**
 * Users
 *
 * This model represents user authentication data. It operates the following tables:
 * - user account data,
 * - user profiles
 *
 * @package	Tank_auth
 * @author	Ilya Konyukhov (http://konyukhov.com/soft/)
 */
class Events extends CI_Model
{
	var $gallery_path;
		var $univ_gallery_path;
	function __construct()
	{
	
		parent::__construct();
		$this->gallery_path = realpath(APPPATH . '../uploads/home_gallery');
		$this->univ_gallery_path = realpath(APPPATH . '../uploads/univ_gallery');
		$this->load->library('pagination');
		$this->load->database();
	}

	
	function fetch_univ_id($user_id)
	{
		$this->db->select('univ_id');
		$this->db->from('university');
		$this->db->where('user_id',$user_id);
		$query = $this->db->get();
		return $query->row_array();
	}
	function fetch_events_ids($univ_id)
	{
		$this->db->select('event_id');
		$this->db->from('events');
		$this->db->where('event_univ_id',$univ_id);
		$query = $this->db->get();
		$res=$query->result_array();
		$i=0;
		foreach($res as $res1)
		{
		$r[]=$res1['event_id'];
		$i++;
		}
		return $r;
	}
	function get_univ_detail()
	{
		$this->db->select('*');
		$this->db->from('university');
		$this->db->order_by("univ_name","asc");
		$query = $this->db->get();
		return $query->result();
	}
	
	function get_univ_id_by_user_id($id)
	{
		$this->db->select('*');
		$this->db->from('university');
		$this->db->where('user_id',$id);
		$query = $this->db->get();
		return $query->row_array();

	}
	
	function create_event()
	{
		$data['user_id'] = $this->tank_auth->get_admin_user_id();
		//$event_time=$this->input->post('event_start_timing').'-'.$this->input->post('event_end_timing');
		$data = array(
			   'event_title' => $this->input->post('title'),
			   'event_detail' => $this->input->post('detail'),
			   'event_date_time'=> $this->input->post('event_time'),
			   'postedby' => $data['user_id'],
			   'event_univ_id' => $this->input->post('university'),
			   'event_category' => $this->input->post('event_type'),
			   'event_country_id' => $this->input->post('country'),
			   'event_state_id' => $this->input->post('state'),
			   'event_city_id' => $this->input->post('city'),
			   'event_place' => $this->input->post('event_place'),
			   'ban_event' => $this->input->post('hide_event'),
			   'event_time' => $this->input->post('event_timing')
			);
			$this->db->insert('events', $data);
			$current_id = $this->db->insert_id();
			return $current_id;
	}
	
	function events_detail()
	{$arr=array('0');
		$data['admin_user_level']=$this->tank_auth->get_admin_user_level();
		$data['user_id']	= $this->tank_auth->get_admin_user_id();
		$this->db->select('*');
		$this->db->from('events');
		$this->db->join('university', 'events.event_univ_id = university.univ_id');
		$this->db->join('country', 'country.country_id = events.event_country_id','left');
		$this->db->join('city', 'events.event_city_id = city.city_id','left');
		
		if($this->input->post('sel_id')==4)
		{
		//$tosearch=$this->input->post('search_box');
			$this->db->where('featured_home_event','0');
		}
		if($this->input->post('sel_id')==5)
		{
			$tosearch=trim($this->input->post('search_box'));	
				$this->db->where('event_date_time',$tosearch);
		}
		if($data['admin_user_level']=='3')
		{
		$this->db->where('university.user_id',$data['user_id']);
		}
		if($this->input->post('sel_id')==2)
		{
		$tosearch=trim($this->input->post('search_box'));			 
		$query1=$this->db->query("select univ_id from university as uni where uni.univ_name like '%$tosearch%'");		  
		$res1=$query1->result_array();
		foreach($res1 as $res)				
					{
					 array_push($arr,$res['univ_id']);
					}
		$this->db->where_in('events.event_univ_id',$arr);
		}
		if($this->input->post('sel_id')==3)
		{
		$tosearch=trim($this->input->post('search_box'));	
			$query1=$this->db->query("select country_id from country as cnt where cnt.country_name like '%$tosearch%'");		  
		$res1=$query1->result_array();
		foreach($res1 as $res)				
					{
					 array_push($arr,$res['country_id']);
					}
		$this->db->where_in('events.event_country_id',$arr);
		}
		if($this->input->post('sel_id')==1)
		{	$tosearch=$this->input->post('search_box');
			$this->db->like('event_title',$tosearch);
		}
		
		$query=$this->db->get();
		$config['base_url']=base_url()."adminevents/manage_events/";
		$config['total_rows']=$query->num_rows();
		$config['per_page'] = '7'; 
		//$config['use_page_numbers'] = TRUE;
		$offset = $this->uri->segment(3); //this will work like site/folder/controller/function/query_string_for_cat/query_string_offset
        $limit = $config['per_page'];
		$this->db->select('*');
		$this->db->from('events');
		$this->db->join('university', 'events.event_univ_id = university.univ_id');
		$this->db->join('country', 'country.country_id = events.event_country_id','left');
		$this->db->join('city', 'events.event_city_id = city.city_id','left');
		//echo $this->input->post('sel_id');exit;
		if($this->input->post('sel_id')==1)
		{	$tosearch=trim($this->input->post('search_box'));		
			$this->db->like('event_title',$tosearch);
		}
		if($this->input->post('sel_id')==2)
		{$tosearch=trim($this->input->post('search_box'));				 
		$query1=$this->db->query("select univ_id from university as uni where uni.univ_name like '%$tosearch%'");		  
		$res1=$query1->result_array();
		foreach($res1 as $res)				
					{
					 array_push($arr,$res['univ_id']);
					}
		$this->db->where_in('events.event_univ_id',$arr);
		}
		if($this->input->post('sel_id')==3)
		{$tosearch=trim($this->input->post('search_box'));	
			$query1=$this->db->query("select country_id from country as cnt where cnt.country_name like '%$tosearch%'");		  
		$res1=$query1->result_array();
		foreach($res1 as $res)				
					{
					 array_push($arr,$res['country_id']);
					}
		$this->db->where_in('events.event_country_id',$arr);
		}
		if($this->input->post('sel_id')==4)
		{//$tosearch=$this->input->post('search_box');
			$this->db->where('featured_home_event','1');
		}
		if($this->input->post('sel_id')==5)
		{
		$tosearch=trim($this->input->post('date_selector'));
			$this->db->where('event_date_time',$tosearch);
		}
		if($data['admin_user_level']=='3')
		{
		$this->db->where('university.user_id',$data['user_id']);
		}
		$this->db->order_by('event_created_time','desc');
		$this->db->limit($limit,$offset);
		$query=$this->db->get();
		$this->pagination->initialize($config);
		return $query->result();
		
	}

	function home_featured_unfeatured_event($f_status,$event_id)
	{
		if($f_status=='1')
		{
		$f_status='0';
		}
		else if($f_status=='0')
		{
		$f_status='1';
		}
		$data=array('featured_home_event'=>$f_status);
		$this->db->update('events', $data, array('event_id' => $event_id));
		return $f_status;
       
	}
	
	function dest_featured_unfeatured_event($f_status,$event_id)
	{
		if($f_status=='1')
		{
		$f_status='0';
		}
		else if($f_status=='0')
		{
		$f_status='1';
		}
		$data=array('featured_dest_event'=>$f_status);
		$this->db->update('events', $data, array('event_id' => $event_id));
		return $f_status;
       
	}
	
	function delete_single_event($event_id)
	{
		$this->db->delete('events', array('event_id' => $event_id));
	}
	
	function fetch_event_detail($event_id)
	{
		$this->db->select('*');
		$this->db->from('events');
		$this->db->join('university', 'events.event_univ_id = university.univ_id');
		$this->db->join('country', 'country.country_id = events.event_country_id','left');
		$this->db->join('city', 'events.event_city_id = city.city_id','left');
		$this->db->join('state', 'state.state_id = events.event_state_id','left');
		$this->db->where('event_id',$event_id);
		$query=$this->db->get();
		return $query->result_array();
		
	}
	
	function update_event($event_id)
	{
		$data['user_id'] = $this->tank_auth->get_admin_user_id();
		$event_time=$this->input->post('event_timing');
		$data = array(
			   'event_title' => $this->input->post('title'),
			   'event_detail' => $this->input->post('detail'),
			   'event_date_time'=> $this->input->post('event_time'),
			   'postedby' => $data['user_id'],
			   'event_univ_id' => $this->input->post('university'),
			   'event_country_id' => $this->input->post('country'),
			   'event_state_id' => $this->input->post('state'),
			   'event_category' => $this->input->post('event_type'),
			   'event_city_id' => $this->input->post('city'),
				'event_place' => $this->input->post('event_place'),
				'event_time' => $event_time
				
			);

			$this->db->update('events', $data, array('event_id' => $event_id));
	}
	
	function delete_events()
	{
		$eventcount=count($this->input->post('event_id'));	
		$event_id=$this->input->post('event_id');
		for( $i =0; $i < $eventcount ; $i++ )
		{
			if($this->input->post("check_event_".$event_id[$i])=='checked')
			{
			$this->db->delete('events', array('event_id' => $event_id[$i]));
			}
		}
	
	}

	function count_feature_event($field)
	{
		$this->db->select('*');
		$this->db->from('events');
		$this->db->where($field,'1');
		$query = $this->db->get();
		if($query->num_rows()<3)
		return 1;
		else
		return 0;
	}
	
	//add multiple event
	function add_multiple_event()
	{
		$event_univ=$this->input->post('university');
		$event_title=$this->input->post('title');
		$event_detail=$this->input->post('detail');
		$event_date_time=$this->input->post('event_time');
		$event_univ_id=$this->input->post('university');
		$event_category=$this->input->post('event_type');
		$event_country_id= $this->input->post('country');
		$event_state_id=$this->input->post('state');
		$event_city_id=$this->input->post('city');
		$event_place=$this->input->post('event_place');
		$event_time=$this->input->post('event_timing');
		$data['user_id'] = $this->tank_auth->get_admin_user_id();	
		for($i=0;$i<count($event_univ);$i++)
		{
			$data = array(
			   'event_title' => $event_title[$i],
			   'event_detail' => $event_detail[$i],
			   'event_date_time'=> $event_date_time[$i],
			   'postedby' => $data['user_id'],
			   'event_univ_id' => $event_univ[$i],
			   'event_category' => $event_category[$i],
			   'event_country_id' => $event_country_id[$i],
			   'event_state_id' => $event_state_id[$i],
			   'event_city_id' => $event_city_id[$i],
			   'event_place' => $event_place[$i],
			   'event_time' => $event_time[$i]
			);
			$this->db->insert('events', $data);
		}
	
	}
	
	function hide_show_event($event_id)
	{
	if( $this->input->post('show_hide')=='1')
	{
	$hs_event='0';
	}
	else if($this->input->post('show_hide')=='0')
	{
	$hs_event='1';
	}
	$data = array(
			   'ban_event' => $hs_event
			);

			$this->db->update('events', $data, array('event_id' => $event_id));
	}
	
	
}
/* End of file users.php */
/* Location: ./application/models/auth/users.php */