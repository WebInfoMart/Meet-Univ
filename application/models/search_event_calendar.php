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
		if($type == 'counsell_alumuni_others')
		{
			$category = array('alumuni','others');
			$this->db->select('*');
		$this->db->from('events');
		$this->db->join('university', 'events.event_univ_id = university.univ_id'); 
		$this->db->join('country', 'country.country_id = events.event_country_id','left'); 
		$this->db->join('state', 'state.state_id = events.event_state_id','left'); 
		$this->db->join('city', 'city.city_id = events.event_city_id','left'); 
		$this->db->where($event_date);
		$this->db->where_in('event_category',$category);
		}
		else {
		$this->db->select('*');
		$this->db->from('events');
		$this->db->join('university', 'events.event_univ_id = university.univ_id'); 
		$this->db->join('country', 'country.country_id = events.event_country_id','left'); 
		$this->db->join('state', 'state.state_id = events.event_state_id','left'); 
		$this->db->join('city', 'city.city_id = events.event_city_id','left'); 
		$this->db->where($event_date);
		}
		$query = $this->db->get();
		if($query->num_rows() > 0)
		{
			return $query->result_array();
		}
		else{
		return 0;
		}
	}
}