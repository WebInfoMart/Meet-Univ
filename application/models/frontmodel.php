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

}