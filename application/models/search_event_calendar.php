<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Search_event_calendar extends CI_Model
{
	
	function __construct()
	{
		$this->load->library('pagination');
		$this->load->database();
	}
	
	function get_event_list_by_calendar($event_date,$type)
	{
		$event_data=array();
		$events_data['total_res']=0;
		$events_data['limit_res']=1000;
		$this->db->select('*');
		$this->db->from('events');
		$this->db->join('university', 'events.event_univ_id = university.univ_id'); 
		$this->db->join('country', 'country.country_id = events.event_country_id','left'); 
		$this->db->join('state', 'state.state_id = events.event_state_id','left'); 
		$this->db->join('city', 'city.city_id = events.event_city_id','left'); 
		$this->db->where('events.ban_event','0');
		$this->db->where($event_date);
		$query = $this->db->get();
		if($query->num_rows()>0)
		{
		$events_data['total_res']=$query->num_rows();	
		  $events_data['event_res'] = $query->result_array();
			return $events_data;
		} else{
			//$events_data['event_res']=array();
			return 0;
		}
	}
}