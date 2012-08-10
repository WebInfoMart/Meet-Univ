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
		$config['per_page']   = 50;
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
	
	function manage_verify_teleleads($start)
	{
		$config['base_url']   = site_url('adminleads/manage_verified_telecalls');
		$this->db->select('*');
		$this->db->from('verified_lead_data');
		//$this->db->where('lead_verified','0');
		$this->db->order_by('v_email');
		$query=$this->db->get();
		$config['total_rows'] = $query->num_rows();
		$config['per_page']   = 50;
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
	
	function verify_lead_user_info($user_id)
	{
		$this->db->select('*');
		$this->db->from('verified_lead_data');
		//$this->db->join('user_profiles','users.id=user_profiles.user_id');
		$this->db->join('country','country.country_id=verified_lead_data.v_country','left');
		$this->db->where(array('verified_lead_data.v_id'=>$user_id));
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
		if($this->input->post('lead_verfied'))
		{
		//$this->db->insert('verified_lead_data',$lead_info);
		//$this->db->where('id',$this->input->post('current_lead_id'));
		//$this->db->update('lead_data',$update_old_lead_info);
		return 1;
		}
		else
		{
		//$this->db->where('id',$this->input->post('current_lead_id'));
		//$this->db->update('lead_data',$update_old_lead_info);
		return 0;
		}
		
		
	}
	
	function update_verify_lead_model($update_verify_lead_info)
	{
		$this->db->where('v_id',$this->input->post('current_lead_id'));
		$this->db->update('verified_lead_data',$update_verify_lead_info);
		if($this->db->affected_rows() > 0)
			{
				return 1;
			}
			else {
				return 0;
			}
	}
	
	function check_for_email_existing($email,$phone)
	{
		$clause_one = array(
		'v_email'=>$this->input->post('email'),
		'v_phone'=>$this->input->post('phone')
		);
		$clause_two = array(
		'v_email'=>$this->input->post('email')
		);
		$clause_three = array(
		'v_phone'=>$this->input->post('phone')
		);
		
		$this->db->select('*');
		$this->db->from('verified_lead_data');
		$this->db->where($clause_one);
		$query_one = $this->db->get();
		
		$this->db->select('*');
		$this->db->from('verified_lead_data');
		$this->db->where($clause_two);
		$query_two = $this->db->get();
		
		$this->db->select('*');
		$this->db->from('verified_lead_data');
		$this->db->where($clause_three);
		$query_three = $this->db->get();
		
		if($query_one->num_rows() > 0)
		{
			return 3;
		}
		else if($query_two->num_rows() > 0)
		{
			return 1;
		}
		else if($query_three->num_rows() > 0)
		{
			return 2;
		}
		else {
			
			return 0;
		}
	}
	
	function check_lead_email_in_verify_table($check_lead_email)
	{
		$this->db->select('v_email');
		$this->db->from('verified_lead_data');
		$query = $this->db->get();
		$result = $query->result_array();
		
		foreach($result as $values)
		{
			if($values['v_email'] == $check_lead_email)
			{
				return 1;
				//break;
			}
		}
	}

	function check_lead_phone_in_verify_table($check_lead_phone)
	{
		$this->db->select('v_phone');
		$this->db->from('verified_lead_data');
		$query = $this->db->get();
		$result = $query->result_array();
		
		foreach($result as $values)
		{
			if($values['v_phone'] == $check_lead_phone)
			{
				return 1;
				//break;
			}
		}
	}
	
	function drop_record_from_lead($id)
	{
		$clause = array(
		'lead_verified'=>'1'
		);
		$this->db->where('id',$id);
		$this->db->update('lead_data',$clause);
		
		if($this->db->affected_rows() > 0)
		{
			return 1;
		}
		else {
		return 0;
		}
		
	}

}

/* End of file users.php */
/* Location: ./application/models/auth/users.php */