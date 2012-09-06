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
class Autosuggest_model extends CI_Model
{
	function __construct()
	{
		parent::__construct();
	}
	
	 function get_univ_detail($hint)
	 {
		$this->db->select('*');
		$this->db->from('university');
		$this->db->like('univ_name',$hint); 
		$query = $this->db->get();
		if($query->num_rows()>0)
		return $query->result();
		else
		return 0;
	 }
	 
	 function get_country_detail_by_univ($hint,$univ_id)
	 {
		$this->db->distinct();
		$this->db->select('country_name,country_id');
		$this->db->from('country');
		$this->db->like('country_name',$hint); 
		$this->db->join('events','events.event_country_id = country.country_id');
		$this->db->where('events.event_univ_id',$univ_id);
		$query=$this->db->get();
		if($query->num_rows()>0)
		return $query->result();
		else
		return 0;
	 }
	 
	 function get_country_detail($hint)
	 {
		$this->db->select('*');
		$this->db->from('country');
		$this->db->like('country_name',$hint); 
		$query=$this->db->get();
		if($query->num_rows()>0)
		return $query->result();
		else
		return 0;
	 }

	function get_state_detail_by_univ($hint,$univ_id,$country_id)
	{
		$this->db->distinct();
		$this->db->select('statename,state_id');
		$this->db->from('state');
		$this->db->like('statename',$hint); 
		$this->db->join('events','events.event_state_id = state.state_id');
		$this->db->where(array('events.event_univ_id'=>$univ_id,'event_country_id'=>$country_id));
		$query=$this->db->get();
		if($query->num_rows()>0)
		return $query->result();
		else
		return 0;
	
	}

	function get_state_detail($hint,$country_id)
	 {
		$this->db->select('*');
		$this->db->from('state');
		$this->db->like('statename',$hint);
		$this->db->where('country_id',$country_id);	
		$query=$this->db->get();
		if($query->num_rows()>0)
		return $query->result();
		else
		return 0;
	 }	
	
	function get_city_detail_by_univ($hint,$univ_id,$country_id,$state_id)
	{
		$this->db->distinct();
		$this->db->select('cityname,city_id');
		$this->db->from('city');
		$this->db->like('cityname',$hint); 
		$this->db->join('events','events.event_city_id = city.city_id');
		$this->db->where(array('events.event_univ_id'=>$univ_id,'event_country_id'=>$country_id,'event_state_id'=>$state_id));
		$query=$this->db->get();
		if($query->num_rows()>0)
		return $query->result();
		else
		return 0;
	
	}

	function get_city_detail($hint,$country_id,$state_id)
	{
		$this->db->select('*');
		$this->db->from('city');
		$this->db->like('cityname',$hint);
		$this->db->where(array('country_id'=>$country_id,'state_id'=>$state_id));	
		$query=$this->db->get();
		if($query->num_rows()>0)
		return $query->result();
		else
		return 0;
	}		
}

/* End of file users.php */
/* Location: ./application/models/auth/users.php */