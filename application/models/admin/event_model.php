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
class Event_model extends CI_Model
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
		$newStartDate = date("d M Y", strtotime($_POST['event_start_date']));
		$newEndDate = date("d M Y", strtotime($_POST['event_end_date']));
		$event_time = $_POST['event_time_start']."-".$_POST['event_time_end'];
		$ban_event = '0';
		if(isset($_POST['event_timing_fixed_not_fixed'])){
			$event_time = $this->input->post('event_mention_time');
		}
		if(isset($_POST['hide_event'])){
			$ban_event = '1';
		}
		$data['user_id'] = $this->tank_auth->get_admin_user_id();		
		$data = array(
			   'event_title' => $this->input->post('title'),
			   'event_detail' => $this->input->post('detail'),
			   'event_date_time'=> $newStartDate,
			   'event_date_time_end'=> $newEndDate,
			   'postedby' => $data['user_id'],
			   'event_univ_id' => $this->input->post('university'),
			   'event_category' => $this->input->post('event_type'),
			   'event_country_id' => $this->input->post('country'),
			   'event_state_id' => $this->input->post('state'),
			   'event_city_id' => $this->input->post('city'),
			   'event_place' => $this->input->post('event_place'),
			   'ban_event' => $ban_event,
			   'event_time' => $event_time,
			   'event_tags' => $this->input->post('tags')
			);
			$this->db->insert('events', $data);
			$current_id = $this->db->insert_id();
			return $current_id;
	}
	
	function events_detail()									// edit by satbir on 26/10/2012
	{
		$data['admin_user_level']=$this->tank_auth->get_admin_user_level();
		$data['user_id']	= $this->tank_auth->get_admin_user_id();		
		$univ=$this->univ_vs_user_model->get_assigned_univ_info($data['user_id']);
		$this->db->select('*');
		$this->db->from('events');
		$this->db->join('university', 'events.event_univ_id = university.univ_id','left');
		$this->db->join('country', 'country.country_id = events.event_country_id','left');
		$this->db->join('city', 'events.event_city_id = city.city_id','left');
		
		if($data['admin_user_level']=='3')
		{
		$this->db->where('university.user_id',$data['user_id']);
		}
		if($data['admin_user_level']=='4')
		{
			$this->db->where_in('event_univ_id',$univ);
		}	
		$this->db->order_by('event_created_time','desc');
		$query=$this->db->get();		
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
		$newStartDate = date("d M Y", strtotime($_POST['event_time']));
		$newEndDate = date("d M Y", strtotime($_POST['event_time_end']));
		$event_country = $this->input->post('country');
		$event_state = $this->input->post('state');
		$event_city = $this->input->post('city');
		if(isset($_POST['location_event'])){
			$event_country = '';
			$event_state = '';
			$event_city = '';
		}
		$event_time = $_POST['event_start_time']."-".$_POST['event_end_time'];
		if(isset($_POST['event_timing_not_fixed'])){
			$event_time = $this->input->post('event_mention_time');
		}
		$data['user_id'] = $this->tank_auth->get_admin_user_id();
		
		$data = array(
			   'event_title' => $this->input->post('title'),
			   'event_detail' => $this->input->post('detail'),
			   'event_date_time'=> $newStartDate,
			   'event_date_time_end'=> $newEndDate,
			   'postedby' => $data['user_id'],
			   'event_univ_id' => $this->input->post('university'),
			   'event_country_id' => $event_country,
			   'event_state_id' => $event_state,
			   'event_category' => $this->input->post('event_type'),
			   'event_city_id' => $event_city,
				'event_place' => $this->input->post('event_place'),
				'event_time' => $event_time				
			);
			$this->db->update('events', $data, array('event_id' => $event_id));
	}
	
	function delete_events()											// edit by satbir on 26/10/2012
	{
		$idsstring=$this->input->post('event_id');
		foreach($idsstring as $ids)
		{
			$this->db->delete('events', array('event_id' => $ids));
		}
		return 1;	
	}

	function count_feature_event($field)
	{
		$this->db->select('*');
		$this->db->from('events');
		$this->db->where($field,'1');
		$query = $this->db->get();
		if($query->num_rows()<30)
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
	
	function recent_events()									//added by satbir on 26/10/2012
	{		
		$data['admin_user_level']=$this->tank_auth->get_admin_user_level();
		$data['user_id']	= $this->tank_auth->get_admin_user_id();		
		$univ=$this->univ_vs_user_model->get_assigned_univ_info($data['user_id']);
		$this->db->select('*');
		$this->db->from('events');
		$this->db->join('university', 'events.event_univ_id = university.univ_id','left');
		$this->db->join('country', 'country.country_id = events.event_country_id','left');
		$this->db->join('city', 'events.event_city_id = city.city_id','left');
		
		if($data['admin_user_level']=='3')
		{
		$this->db->where('university.user_id',$data['user_id']);
		}
		if($data['admin_user_level']=='4')
		{
			$this->db->where_in('event_univ_id',$univ);
		}
		$this->db->order_by('event_created_time','desc');
		$this->db->limit(10);		
		$query=$this->db->get();		
		return $query->result();
	}
	function fetch_events_for_calendar(){							//added by satbir on 11/09/2012
		$sql = "SELECT *,STR_TO_DATE( `events`.`event_date_time`,  '%d %M %Y' )  as dt FROM events where STR_TO_DATE(event_date_time, '%d %M %Y')>='".date('Y-m-d')."' and  ban_event!='1' order by dt asc";
		$results=$this->db->query($sql);
		if($results->num_rows()>0){
			return $results->result_array();
		}
		else{
			return 0;
		}		
	}
	function count_students_visit()									//added by satbir on 11/23/2012
	{
		$this->db->select('campaign_type, COUNT(campaign_type) as total');	
		$this->db->from('campaign');
		$this->db->group_by('campaign_type'); 
		$query=$this->db->get();		
		return $query->result_array();
	}
	function recent_event_registered()
	{
		$this->db->select('event_register.id,event_register.fullname,event_register.email,event_register.phone,users.activated,lead_data.phone_verified,verified_lead_data.v_verified_phone');
		$this->db->from('event_register');
		$this->db->join('lead_data','event_register.email=lead_data.email','left');
		$this->db->join('verified_lead_data','event_register.email=verified_lead_data.v_email','left');
		$this->db->join('users','event_register.email=users.email','left');		
		$this->db->group_by('event_register.email');
		$this->db->order_by('event_registered_time','desc');
		$this->db->limit(30);
		$query=$this->db->get();
		return $query->result_array();

	}
	function delete_recent_events()
	{
		$email = $this->input->post('reg_email');		
		$query1 =$this->db->delete('event_register', array('email' => $email));
		$query2 = $this->db->delete('lead_data', array('email' => $email));
		if($this->db->affected_rows($query1)>0 || $this->db->affected_rows($query2)>0)
		{
			return 1;
		}
		else
		{
			return 0;
		}
	}
	
}
/* End of file users.php */
/* Location: ./application/models/auth/users.php */