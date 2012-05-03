<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Leadmodel extends CI_Model
{
	private $table_name			= 'users';			// user accounts
	private $profile_table_name	= 'user_profiles';	// user profiles
	var $gallery_path;
	//var $gallery_path_url;
	
	function __construct()
	{
		parent::__construct();
		$this->gallery_path = realpath(APPPATH . '../uploads');
		//$this->gallery_path_url = base_url().'uploads/';
		$ci =& get_instance();
		$this->table_name			= $ci->config->item('db_table_prefix', 'tank_auth').$this->table_name;
		$this->profile_table_name	= $ci->config->item('db_table_prefix', 'tank_auth').$this->profile_table_name;
		//$this->db->query("SET time_zone='+5:30'");
		$this->load->library('pagination');
		//$this->program_parent	= $ci->config->item('db_table_prefix', 'tank_auth').$this->program_parent;
		//$this->program_educ_level	= $ci->config->item('db_table_prefix', 'tank_auth').$this->program_educ_level;
		//$this->country	= $ci->config->item('db_table_prefix', 'tank_auth').$this->country;
		
	}
	public function insert_data_lead_data($condition,$insert_type)
	{
		if($insert_type == '0')
		{
			$this->db->insert('lead_data',$condition);
			if($this->db->affected_rows() > 0)
			{
				return $this->db->insert_id();
			}
		}
		else if($insert_type == '1')
		{
			$to_insert_id = $this->session->userdata('current_insert_lead_id');
			if($to_insert_id!='')
			{
			$this->db->where('id',$to_insert_id);
			$this->db->update('lead_data',$condition);
			}
			else{
			$this->db->insert('lead_data',$condition);
			}
			return $this->db->affected_rows()? 1 : 0 ;
		}
		else if($insert_type == '2')
		{
			$to_insert_id = $this->session->userdata('current_insert_lead_id');
			$this->db->where('id',$to_insert_id);
			$this->db->update('lead_data',$condition);
			if($this->db->affected_rows() > 0)
			{
				$set_session_data_to_blank = array(
				'current_insert_lead_id'=>'',
				'current_insert_lead_email'=>''
				);
				$this->session->set_userdata($set_session_data_to_blank);
				return 1;
			}
			else {
			return 0;
			}
		}
	}
}