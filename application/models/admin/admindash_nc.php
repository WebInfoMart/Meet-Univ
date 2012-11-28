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
		$this->db->select('lead_data.fullname,lead_data.email,lead_data.phone_no1,lead_data.phone_verified,lead_data.lead_created_time,users.activated,verified_lead_data.v_verified_phone');
		$this->db->from('lead_data');		
		$condition=array('lead_data.lead_source'=>'nc');
		$this->db->join('verified_lead_data','lead_data.email=verified_lead_data.v_email','left');
		$this->db->join('users','lead_data.email=users.email','left');
		$this->db->group_by('lead_data.email');
		$this->db->where($condition);
		$this->db->order_by("lead_data.lead_created_time", "desc");		
		$res=$this->db->get();		
		return $res->result_array();		
		 
	}
	function recent_leads_as()
	{	
		$this->db->select('lead_data.fullname,lead_data.email,lead_data.phone_no1,lead_data.phone_verified,lead_data.lead_created_time,users.activated,verified_lead_data.v_verified_phone');
		$this->db->from('lead_data');		
		$condition=array('lead_data.lead_source'=>'as');
		$this->db->join('verified_lead_data','lead_data.email=verified_lead_data.v_email','left');
		$this->db->join('users','lead_data.email=users.email','left');
		$this->db->group_by('lead_data.email');
		$this->db->where($condition);
		$this->db->order_by("lead_data.lead_created_time", "desc");		
		$res=$this->db->get();		
		return $res->result_array();		
		 
	}
}
