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
class Lead_tele_model extends CI_Model
{
	private $table_name			= 'users';			// user accounts
	private $profile_table_name	= 'user_profiles';	// user profiles
	var $gallery_path;
	var $gallery_path_url;
	
	function __construct()
	{
		parent::__construct();
		$this->load->library('session');
		//$this->program_parent	= $ci->config->item('db_table_prefix', 'tank_auth').$this->program_parent;
		//$this->program_educ_level	= $ci->config->item('db_table_prefix', 'tank_auth').$this->program_educ_level;
		//$this->country	= $ci->config->item('db_table_prefix', 'tank_auth').$this->country;
		
	}
	
	function tele_lead_users($start)
	{
		$config['base_url']   = site_url('adminleads/managetelecalls');
		$this->db->select('*');
		$this->db->from('lead_data');
		$this->db->where('lead_verified','0');
		$this->db->order_by('email');
		$query=$this->db->get();
		$config['total_rows'] = $query->num_rows();
		$config['per_page']   = 5;
		$limit=$config['per_page'];
		$offset=$start;
		$this->db->select('*');
		$this->db->from('lead_data');
		$this->db->where('lead_verified','0');
		$this->db->order_by('email');
		$this->db->limit($limit,$offset);
		$query=$this->db->get();
		$this->pagination->initialize($config);
		if($query->num_rows()>0)
		return $query->result_array();
		else
		return 0;
	}

	function lead_user_info($user_id)
	{
		$this->db->select('*');
		$this->db->from('lead_data');
		//$this->db->join('user_profiles','users.id=user_profiles.user_id');
		$this->db->join('country','country.country_id=lead_data.home_country_id','left');
		$this->db->where(array('lead_data.id'=>$user_id));
		$query=$this->db->get();
		if($query->num_rows()>0)
		return $query->row_array();
		else
		return 0;
	}
	
	function fetch_state()
	{
		$this->db->select('*');
		$this->db->from('state');
		$this->db->order_by('statename','asc');
		$query=$this->db->get();
		//$query = $this->db->query("select * from country");
		return $query->result_array();
	}
	
	function fetch_city()
	{
		$this->db->select('*');
		$this->db->from('city');
		$this->db->order_by('cityname','asc');
		$query=$this->db->get();
		//$query = $this->db->query("select * from country");
		return $query->result_array();
	}
	
	function save_verified_lead_info($lead_info,$update_old_lead_info)
	{
		if($this->db->insert('verified_lead_data',$lead_info))
		{
			/* $update_lead_data = array(
			'lead_verified'=>'1'
			); */
			$this->db->where('id',$this->input->post('current_lead_id'));
			$this->db->update('lead_data',$update_old_lead_info);
			
			if($this->db->affected_rows() > 0)
			{
				return 1;
			}
			else {
				return 0;
			}
		}
		
	}

}

/* End of file users.php */
/* Location: ./application/models/auth/users.php */