<?php if (!defined('BASEPATH')) exit('No direct script access allowed');
class Admin_counsellor_model extends CI_Model
{
	private $table_name			= 'users';			// user accounts
	private $profile_table_name	= 'user_profiles';	// user profiles
	var $gallery_path;
	var $gallery_path_url;
	
	function __construct()
	{
		parent::__construct();
		$this->load->library('session');
		
	}
	
	
	function c_manage_verify_teleleads($start)
	{   
	    
		$config['base_url']   = site_url('adminleads/manage_verified_telecalls');
		
		if($this->input->post('id')!='')
		{	
			$id=$this->input->post('id');			
			$query=mysql_query("select * from verified_lead_data as vld
left join country on vld.v_country=country.country_id
left join state on vld.v_state=state.state_id
left join city on vld.v_city=city.city_id
left join program on vld.v_program=program.prog_id
left join v_notes on vld.v_program=program.prog_id
where vld.v_id=".$id." order by vld.v_email");
			if(mysql_num_rows($query)>0)
			{
				return mysql_fetch_array($query);
			}
			else
			{
				return 0;
			}
		}
		else
		{
			$this->db->select('*');
			$this->db->from('verified_lead_data');
			$this->db->order_by('v_email');
			$query=$this->db->get();
			$config['total_rows'] = $query->num_rows();
			$config['per_page']   = 30;
			$limit=$config['per_page'];
			$offset=$start;
			$this->db->select('*');
			$this->db->from('verified_lead_data');
			//$this->db->where('lead_verified','0');
			$this->db->order_by('v_email');
			$this->db->limit($limit,$offset);
			$query=$this->db->get();
			$this->pagination->initialize($config);
			if($query->num_rows()>0)
			return $query->result_array();
			else
			return 0;
		}	
	}
function country_model()
{
	$query=$this->db->get('country');
	return $query->result_array();
}
function state_model()
{
	$query=$this->db->get('state');
	return $query->result_array();
}
function city_model()
{
	$query=$this->db->get('city');
	return $query->result_array();
}

}
