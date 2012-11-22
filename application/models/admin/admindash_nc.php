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
class Admindash_nc extends CI_Model
{
	function __construct()
	{
		parent::__construct();		
	}

	function recent_leads_nc()
	{	
		$this->db->select("*");
		$this->db->from('lead_data');
		$condition=array('lead_source'=>'nc');
		$this->db->join('users','lead_data.email=users.email','left');
		$this->db->where($condition);
		$this->db->order_by("lead_created_time", "desc");		
		$res=$this->db->get();		
		return $res->result_array();		
		 
	}
	function recent_leads_as()
	{	
		$this->db->select("*");
		$this->db->from('lead_data');
		$condition=array('lead_source'=>'as');	
		$this->db->join('users','lead_data.email=users.email','left');
		$this->db->where($condition);
		$this->db->order_by("lead_created_time", "desc");		
		$res=$this->db->get();		
		return $res->result_array();		
		 
	}
}
