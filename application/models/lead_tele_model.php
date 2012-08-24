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
		$this->load->library('tank_auth');
		$this->load->model('tank_auth/users');
		//require_once base_url().'application/libraries/phpass-0.1/PasswordHash.php';
		//require_once '../libraries/phpass-0.1/PasswordHash.php';
		//$this->load->library('phpass-0.1/PasswordHash');
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
		$config['per_page']   = 15;
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
		$config['per_page']   = 15;
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
	//kulbir
	function v_note($user_id)
	{
		$this->db->select('*');
		$this->db->from('verified_notes');
		//$this->db->join('user_profiles','users.id=user_profiles.user_id');
		//$this->db->join('country','country.country_id=lead_data.home_country_id','left');
		$this->db->where(array('lead_id'=>$user_id));
		$query=$this->db->get();
		if($query->num_rows()>0)
		return $query->result_array();
		else
		return 0;
	}
	//kulbir
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
	
	function save_verified_lead_info($lead_info,$update_old_lead_info,$notes)
	{
		if($this->input->post('lead_verified'))
		{
		$this->db->insert('verified_lead_data',$lead_info);		
		$this->db->where('id',$this->input->post('current_lead_id'));
		$this->db->update('lead_data',$update_old_lead_info);
		if($this->input->post('notes')!='')
		{
		 $this->db->insert('verified_notes',$notes);
		}		
		return 1;
		}
		else
		{
		if($this->input->post('notes')!='')
		{
		 $this->db->insert('verified_notes',$notes);
		}	
		$this->db->where('id',$this->input->post('current_lead_id'));
		$this->db->update('lead_data',$update_old_lead_info);
		return 0;
		}
		
		
	}
	
	function update_verify_lead_model($update_verify_lead_info,$notes)
	{
		
		$this->db->where('v_id',$this->input->post('current_lead_id'));
		$this->db->update('verified_lead_data',$update_verify_lead_info);
		if($this->input->post('notes')!='')
		$this->db->insert('verified_notes',$notes);
		if($this->db->affected_rows() > 0)
		{
				return 1;
		}
		else
		{
				return 0;
		}
	}
	
		function check_for_email_existing()
		{ 
		 $email = $this->input->post('email');
		 if($this->input->post('phone')!='')
		 {
		  $phone = $this->input->post('phone');
		 }
		 else
		 {
		 $phone='123';
		 }
		 if($email=='')
		 {
		  $email = '123';
		 }
		 $query_one=$this->db->query("select * from verified_lead_data where v_email='".$email."' || v_phone='".$phone."' "); 
		 
		 if($query_one->num_rows())
		 {
		  return 1;
		 }
		 else 
		 {
		  return 0;
		 }
		}
		
		function check_for_email_phone_existing($email,$phone,$mob,$mail)
		{
		if($phone=='' || $phone==0)
		{
		$phone=1;
		}
		if($mail)
		{
		$where=" v_email='".$email."'";
		}
		else if($mob)
		{
		$where=" v_phone='".$phone."'";
		}
		else
		{
		$where=" v_email='".$email."' || v_phone='".$phone."'";
		}
		 $query_one=$this->db->query("select * from verified_lead_data where ".$where); 
		 
		 if($query_one->num_rows())
		 {
		  return 1;
		 }
		 else 
		 {
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
	
	function fetch_states_by_country_ajax($country_id)
	{
		$this->db->select('*');
		$this->db->from('state');
		$this->db->where('country_id',$country_id);
		$query = $this->db->get();
		if($query->num_rows()>0)
		{
		 return $query->result_array();
		}
		else
		{
		return 0;
		}
	  
	}
	
	function fetch_cities_by_state_ajax($state_id)
	{
		$this->db->select('*');
		$this->db->from('city');
		$this->db->where('state_id',$state_id);
		$query = $this->db->get();
		if($query->num_rows() > 0)
		{
		 return $query->result_array();
		}
		else
		{
		return 0;
		}
	}
	
	function country_name_by_id($cid)
	{
	    $this->db->select('country_name');
		$this->db->from('country');
		$this->db->where('country_id',$cid);
		$query = $this->db->get();
		if($query->num_rows() > 0)
		{
		 return $query->row_array();
		}
		else
		{
		return 0;
		}
	}
	
	 function email_as_site_user($email)
	 {
	    $this->db->select('id');
		$this->db->from('users');
		$this->db->where('email',$email);
		$query = $this->db->get();
		if($query->num_rows() > 0)
		{
		 return $query->row_array();
		}
		else
		{
		return 0;
		}
	 
	 }
	
	
		 function save_lead_info($user_id)
		 {
		 $logged_in_user_id	= $this->tank_auth->get_admin_user_id();
		 $dob = $this->input->post('year').'-'.$this->input->post('month').'-'.$this->input->post('date');
		 if($user_id==0)
		  {
		  $password=rand(14543423,64543423);
		  $hashed_password=$this->tank_auth->genrate_hash_passsword($password);
		  $site_user_data = array(
				'fullname'	=> $this->input->post('fullname'),
				'createdby' => 'admin',
				'level'     => '1',
				'password'	=> $hashed_password,
				'email'		=> $this->input->post('email'),
				'createdby_user_id' =>$logged_in_user_id,
				'last_ip'	=> $this->input->ip_address(),
				'user_type' => 'other'
			);
		$site_user_data['new_email_key'] = md5(rand().microtime());
			$profile_user_data=array(
			 'mob_no'=>$this->input->post('phone'),
			 'dob'=>$dob,
			 'city_id'=>$this->input->post('city'),
			 'state_id'=>$this->input->post('state'),
			 'country_id'=>$this->input->post('country')
		   );	
		  $user_id=$this->create_lead_as_site_user($site_user_data,$profile_user_data);
		  $data_email = $this->path->all_path();
		  $data_email['password']=$password;
		  $data_email['fullname']=$this->input->post('fullname');
		  $new_email_key=$this->users->get_new_email_key_by_userid($user_id);
          $data_email['new_email_key']=$new_email_key['new_email_key'];
		  $data_email['user_id']=$user_id;
		  $email_body = $this->load->view('auth/new_signup_email',$data_email,TRUE);
		  $this->load->library('email');
          $this->email->set_newline("\r\n");
		 
		  $this->email->from('info@meetuniversities.com', 'Meet Universities');
		  $this->email->to($this->input->post('email'));
		  $this->email->subject('Welcome to Global University Events Listing | MeetUniversities.com');
		  $message = $email_body ;
		  $this->email->message($message);
		  $this->email->send();
		  //endemail code
		 
		  }
		  $insert_lead_info = array(
		  'user_id'=>$user_id,
		  'fullname'=>$this->input->post('fullname'),
		  'email'=>$this->input->post('email'),
		  'phone_no1'=>$this->input->post('phone'),
		  'dob'=>$dob,
		  'home_country_id'=>$this->input->post('country'),
		  'state'=>$this->input->post('state'),
		  'city'=>$this->input->post('city'),
		  'email_verified'=>$this->input->post('email_verified'),
		  'phone_verified'=>$this->input->post('phone_verified'),
		  'enroll_key'=>$this->input->post('enroll'),
		  'lead_verified'=>$this->input->post('lead_verified'),
		  'studying_country_id'=>$this->input->post('interested_cont'),
		  'lead_status'=>$this->input->post('lead_status'),
		  'next_action'=>$this->input->post('next_action')
		  );
		  $query=$this->db->insert('lead_data',$insert_lead_info);  
		  $id=$this->db->insert_id($query);
		  if($id!='')
		  {
		  $verify_lead_info = array(
		  'v_lead_id'=>$id,
		  'v_fullname'=>$this->input->post('fullname'),
		  'v_email'=>$this->input->post('email'),
		  'v_phone'=>$this->input->post('phone'),
		  'v_dob'=>$dob,
		  'v_country'=>$this->input->post('country'),
		  'v_state'=>$this->input->post('state'),
		  'v_city'=>$this->input->post('city'),
		  'v_enroll_key'=>$this->input->post('enroll'), 
		  'v_interested_country'=>$this->input->post('interested_cont'),
		  'v_user_type'=>$this->input->post('lead_source'),
		  'v_verified_email'=>$this->input->post('email_verified'),
		  'v_verified_phone'=>$this->input->post('phone_verified'),
		  'v_lead_status'=>$this->input->post('lead_status'),
		  'v_next_action'=>$this->input->post('next_action'),
		  'v_user_id'=>$user_id
		  
		  );
		  if($this->input->post('notes')!='')
		   {   
			$notes = array(
			'lead_id'=>$id,
			'v_note'=>$this->input->post('notes'),
			'updated_on'=>date('Y-m-d H:i:S', time())  
			);
			$this->db->insert('verified_notes',$notes);
		   }
		  $this->db->insert('verified_lead_data',$verify_lead_info);
		  
			  return $this->db->affected_rows()? 1 : 0;
		  }
	 }
	  function create_lead_as_site_user($data1,$data2)
	  {
	   $this->db->insert('users', $data1); 
	   $user_id = $this->db->insert_id();
	   $data2['user_id']=$user_id;
	   $this->db->insert('user_profiles', $data2); 
	   return $user_id;
	  }
      
}

/* End of file users.php */
/* Location: ./application/models/auth/users.php */