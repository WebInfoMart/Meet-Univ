<?php if (!defined('BASEPATH')) exit('No direct script access allowed');
class Engagement_panel extends CI_Model
{
function __construct()
{

	parent::__construct();
	$this->load->database();
}

function count_students_type($u_id)
{
	
	$query=$this->db->query("select v_user_type,lead_source,count(lead_source) as count from lead_data ld left join verified_lead_data vld on ld.id=vld.v_lead_id where FIND_IN_SET('".$u_id."',applied_univ_id) or FIND_IN_SET('".$u_id."',vld.v_applied_univ_id) group by lead_source") ;	
	return $query->result_array();
	 
}
function count_students_in_univ($u_id)
{
	
	$query=$this->db->query("select ld.id from lead_data as ld left join verified_lead_data vld on ld.id=vld.v_lead_id where FIND_IN_SET('".$u_id."',ld.applied_univ_id) or FIND_IN_SET('".$u_id."',vld.v_applied_univ_id)");	
	return $query->num_rows();
	 
}
function count_univ_event_citywise($u_id)
{
	
	$query=$this->db->query("select events.event_city_id,city.cityname,count(event_city_id) as count from events
left join city on city.city_id=events.event_city_id
where event_univ_id='".$u_id."' group by event_city_id");	//change event_univ_id
	return $query->result_array();
	 
}
function city_events_model()
{
	$univ_id=$this->input->post('univ_id');
	$event_city_id=$this->input->post('event_city_id');
	$query=$this->db->query("select * from events left join city on events.event_city_id=city.city_id where event_city_id='".$event_city_id."' && event_univ_id='".$univ_id."'");	
	return $query->result_array();
	 
}
function cityevents_stud_model($start,$end)
{
	
	$event_id=$this->input->post('event_id');
	//$city_id=$this->input->post('city_id');
	$query=$this->db->query("select * from event_register where register_event_id='".$event_id."' group by email limit ".$start.",".$end." ");	
	return $query->result_array();
	 
}
function cityevents_stud_count()
{
	
	$event_id=$this->input->post('event_id');	
	$query=$this->db->query("select * from event_register where register_event_id='".$event_id."' group by email ");	
	return $query->num_rows();
	 
}
function month_event_count_model($u_id,$mon)
{
	$query=$this->db->query("select v_user_type,lead_source,count(lead_source) as count,MONTH(lead_created_time) as month from lead_data ld 
left join verified_lead_data vld on ld.id=vld.v_lead_id 
where (FIND_IN_SET('".$u_id."',applied_univ_id) or FIND_IN_SET('".$u_id."',vld.v_applied_univ_id)) 
and (MONTH(lead_created_time)='".$mon."') group by lead_source ORDER BY ld.lead_source");	
	if($query->num_rows()>0)
	{
	 return $query->result_array();
	 }
	 else
	 {
	 return 0;
	 }
	 
}

function recent_leads()
{
	
	$query=$this->db->query("SELECT `email`,`fullname`,`lead_created_time` from lead_data order by `lead_created_time` desc limit 0,10");	
	return $query->result_array();
	 
}
function fetch_univ_detail($user_id)
 {
	 $this->db->select('univ_id');
	 $this->db->from('university');
	 $this->db->where('user_id',$user_id);
	 $query=$this->db->get();
	 if($query->num_rows()>0)
	 return $query->result_array();
	 else
	 return 0;
 }	
		
}

