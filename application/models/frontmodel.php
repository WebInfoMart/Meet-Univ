<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Frontmodel extends CI_Model
{
	
	function __construct()
	{
		$this->load->library('pagination');
		$this->load->database();
	}
	
	function fetch_featured_events()
	{
		$this->db->select('*');
		$this->db->from('events');
		$this->db->join('university', 'events.event_univ_id=university.univ_id');
		$this->db->where(array('featured_home_event' =>'1'));
		$this->db->limit(5);
		$query = $this->db->get();
		return $query->result_array();
	}
	
	//function for getting university information
	function fetch_featured_college()
	{
		$query = $this->db->get_where('university',array('featured_college'=>'1'));
		return $query->result_array();
	}
	function fetch_featured_article_home()
	{
		$this->db->select('*');
		$this->db->from('article');
		$this->db->where(array('featured_home_article'=>'1','article_type_ud'=>'univ_article'));
		$this->db->limit(1);
		$query = $this->db->get();
		return $query->result_array();
	}
	
	function fetch_events($page)
	{
		$this->db->select('*');
		$this->db->from('events');
		$this->db->join('university', 'events.event_univ_id = university.univ_id'); 
		$this->db->join('country', 'country.country_id = events.event_country_id','left'); 
		$this->db->join('state', 'state.state_id = events.event_state_id','left'); 
		$this->db->join('city', 'city.city_id = events.event_city_id','left'); 
		$this->db->where('event_type','univ_event');
		$query = $this->db->get();
		$numrows=$query->num_rows();
		$config['base_url']=base_url()."auth/events";
		$config['total_rows']=$numrows;
		$config['per_page'] = '7'; 
		$offset = $page;//this will work like site/folder/controller/function/query_string_for_cat/query_string_offset
        $limit = $config['per_page'];
		$this->db->select('*');
		$this->db->from('events');
		$this->db->join('university', 'events.event_univ_id = university.univ_id'); 
		$this->db->join('country', 'country.country_id = events.event_country_id','left'); 
		$this->db->join('state', 'state.state_id = events.event_state_id','left'); 
		$this->db->join('city', 'city.city_id = events.event_city_id','left'); 
		
		$this->db->where('event_type','univ_event');
		$this->db->limit($limit,$offset);
		$query = $this->db->get();
		$this->pagination->initialize($config);
		return $query->result_array();
	}


}