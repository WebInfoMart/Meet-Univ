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
class Users extends CI_Model
{
	private $table_name			= 'users';			// user accounts
	private $profile_table_name	= 'user_profiles';	// user profiles
	var $gallery_path;
	var $gallery_path_url;
	
	function __construct()
	{
		parent::__construct();
		$this->gallery_path = realpath(APPPATH . '../uploads');
		$this->gallery_path_url = base_url().'uploads/';
		$ci =& get_instance();
		$this->table_name			= $ci->config->item('db_table_prefix', 'tank_auth').$this->table_name;
		$this->profile_table_name	= $ci->config->item('db_table_prefix', 'tank_auth').$this->profile_table_name;
		//$this->program_parent	= $ci->config->item('db_table_prefix', 'tank_auth').$this->program_parent;
		//$this->program_educ_level	= $ci->config->item('db_table_prefix', 'tank_auth').$this->program_educ_level;
		//$this->country	= $ci->config->item('db_table_prefix', 'tank_auth').$this->country;
		
	}

	/**
	 * Get user record by Id
	 *
	 * @param	int
	 * @param	bool
	 * @return	object
	 */
	 
	 function fetch_country()
	 {
		$this->db->select('*');
		$this->db->from('country');
		$query=$this->db->get();
		//$query = $this->db->query("select * from country");
		return $query->result_array();
	 }
	 
	 function fetch_educ_level()
	 {
		$this->db->select('*');
		$this->db->from('program_educ_level');
		$query = $this->db->get();
		return $query->result_array();
	 }
	 
	 function fetch_area_interest()
	 {
		$this->db->select('*');
		$this->db->from('program_parent');
		$query = $this->db->get();
		return $query->result_array();
	 }
	 
	 function fetch_program()
	 {
		$this->db->select('*');
		$this->db->from('program');
		$query = $this->db->get();
		return $query->result_array();
	 }
	 
	 function user_profile_update($logged_user)
	 {
		$year = $this->input->post('year');
		$month = $this->input->post('month');
		$date = $this->input->post('date');
		$dob = $year.'-'.$month.'-'.$date;
		$data = array(
		'full_name' => $this->input->post('full_name'),
		'gender' => $this->input->post('sex'),
		'country_id' => $this->input->post('country'),
		'alias_name' => $this->input->post('alias_name'),
		'home_address' => $this->input->post('home_adrs'),
		'mob_no' => $this->input->post('mob_no'),
		'alt_email' => $this->input->post('alt_email'),
		'curr_educ_level' => $this->input->post('curnt_quali'),
		'prog_parent_id' => $this->input->post('area_intrst'),
		'dob' => $dob
		//'user_pic_path' => $this->input->post('area_intrst')
		);
		$users_update_data = array(
		'fullname' => $this->input->post('full_name')
		);
		
		$this->db->where('user_id',$logged_user);
		$this->db->update('user_profiles', $data); 
		
		$this->db->where('id',$logged_user);
		$this->db->update('users',$users_update_data); 
		
	 }
	 
	 /* function for pic upload */
	 
	
	function do_upload() {
		 //$this->ci->load->config('tank_auth', TRUE);
  
		$config = array(
			'allowed_types' => 'jpg|jpeg|gif|png',
			'upload_path' => $this->gallery_path,
			'max_size' => 2000 
		);
		
		$this->load->library('upload', $config);
		$this->upload->do_upload();
		$image_data = $this->upload->data();
		
		$config = array(
			'source_image' => $image_data['full_path'],
			'new_image' => $this->gallery_path . '/thumbs',
			'maintain_ration' => true,
			'width' => 150,
			'height' => 100
		);
		
		$this->load->library('image_lib', $config);
		$this->image_lib->resize();
		//print_r($config);
		//print_r($image_data['file_name']);
		//$img_path_store = $this->input->post('userfile');
		//$img_path_store = $config['new_image'];
		//print_r($this->session->userdata());
		$data['user_id'] = $this->tank_auth->get_user_id();
		if($image_data['file_name'] != '')
		{
		 $this->db->query("update user_profiles set user_pic_path = '".$image_data['file_name']."' where user_id='".$data['user_id']."'");
		}
		if($this->input->post('area_interest') != '')
		{
		 $this->db->query("update user_profiles set prog_parent_id = '".$this->input->post('area_interest')."' where user_id='".$data['user_id']."'");
		}
		if($this->input->post('educ_level') != '')
		{
		 $this->db->query("update user_profiles set curr_educ_level = '".$this->input->post('educ_level')."' where user_id='".$data['user_id']."'");
		}
		if($this->input->post('countries') != '')
		{
		 $this->db->query("update user_profiles set country_id = '".$this->input->post('countries')."' where user_id='".$data['user_id']."'");
		}
		if($this->input->post('sex') != '')
		{
		 $this->db->query("update user_profiles set gender = '".$this->input->post('sex')."' where user_id='".$data['user_id']."'");
		}
		//echo $this->session->userdata('user_id');
		redirect('home');
	}
	
	
	function do_upload_profile_pic() {
		 //$this->ci->load->config('tank_auth', TRUE);
  
		$config = array(
			'allowed_types' => 'jpg|jpeg|gif|png',
			'upload_path' => $this->gallery_path,
			'max_size' => 2000
		);
		
		$this->load->library('upload', $config);
		$this->upload->do_upload();
		$image_data = $this->upload->data();
		
		$config = array(
			'source_image' => $image_data['full_path'],
			'new_image' => $this->gallery_path . '/thumbs',
			'maintain_ration' => true,
			'width' => 150,
			'height' => 100
		);
		
		$this->load->library('image_lib', $config);
		$this->image_lib->resize();
		//print_r($config);
		//print_r($image_data['file_name']);
		//$img_path_store = $this->input->post('userfile');
		//$img_path_store = $config['new_image'];
		//print_r($this->session->userdata());
		$data['user_id'] = $this->tank_auth->get_user_id();
		if($image_data['file_name'] != '')
		{
		 $this->db->query("update user_profiles set user_pic_path = '".$image_data['file_name']."' where user_id='".$data['user_id']."'");
		}
		//echo $this->session->userdata('user_id');
	}
	
	/*function get_images() {
		
		$files = scandir($this->gallery_path);
		$files = array_diff($files, array('.', '..', 'thumbs'));
		
		$images = array();
		
		foreach ($files as $file) {
			$images []= array (
				'url' => $this->gallery_path_url . $file,
				'thumb_url' => $this->gallery_path_url . 'thumbs/' . $file
			);
		}
		return $images;
	}*/
	 
	 /* End Here */
	 
	 /* function for fetch profile */
	 
	 function fetch_profile($logged_user)
	 {
	 
			 $this->db->select('*');
			  $this->db->from('users');
			  $this->db->join('user_profiles', 'users.id = user_profiles.user_id');
			  $this->db->where('id', $logged_user);
			  $query = $this->db->get();
			  return $query->row_array();
	 }
	 
	 /* function for get profile pic */
	 function fetch_profile_data($logged_user) 
	 {
	 
		$query = $this->db->get_where($this->profile_table_name,array('user_id'=>$logged_user));
		return $query->row_array();
		// $this->db->select('*');
		// $this->db->where('user_id',$logged_user);
		// $query = $this->db->get($this->profile_table_name);
		// return $query->result_array();
	 }
	 /* End Here */
	 
	 function fetch_all_data($logged_user)
	 {
		$query = $this->db->get_where('users',array('id'=>$logged_user));
	return $query->row_array();
	 }
	function get_user_by_id($user_id, $activated)
	{
		$this->db->where('id', $user_id);
		$this->db->where('activated', $activated ? 1 : 0);

		$query = $this->db->get($this->table_name);
		if ($query->num_rows() == 1) return $query->row();
		return NULL;
	}

	
	function check_facebook_email($fb_email)
	{
		$query = $this->db->get_where('users',array('email'=>$fb_email));
		return $query = $query->num_rows();
	}
	function facebook_insert($fbdata)
	{
		if ($this->db->insert($this->table_name, $fbdata)) {
			$user_id = $this->db->insert_id();
			$this->create_profile($user_id);
			return array('user_id' => $user_id);
		}
	}
	
	function fetch_fb_user_id($fb_email)
	{
		$this->db->select('id');
		$this->db->where('email',$fb_email);
		$query = $this->db->get($this->table_name);
		// $this->db->select('id');
		// $this->db->where("email", $fb_email);
		// $query = $this->db->get('users');
		  
  return $query->row_array();
	}
	/**
	 * Get user record by login (username or email)
	 *
	 * @param	string
	 * @return	object
	 */
	function get_user_by_login($login,$user_type)
	{
		if($user_type=='admin')
		{
		$level='2,3,4,5';
		}
		else if($user_type=='student')
		{
		$level='1';
		}
		$this->db->where("LOWER(username)='".strtolower($login)."' and level IN($level)");
		//$this->db->where('LOWER(username)=', strtolower($login));
		//$this->db->where('LOWER(level)=', '1');
		$this->db->or_where("LOWER(email)='".strtolower($login)."' and level IN($level)");
		//$this->db->or_where('LOWER(email)=', strtolower($login));
		

		$query = $this->db->get($this->table_name);
		if ($query->num_rows() == 1) return $query->row();
		return NULL;
		
	}

	/**
	 * Get user record by username
	 *
	 * @param	string
	 * @return	object
	 */
	function get_user_by_username($username)
	{
		$this->db->where('LOWER(username)=', strtolower($username));

		$query = $this->db->get($this->table_name);
		if ($query->num_rows() == 1) return $query->row();
		return NULL;
	}

	/**
	 * Get user record by email
	 *
	 * @param	string
	 * @return	object
	 */
	/*function get_user_by_email($email) by sumit munjal
 {
  $this->db->where('LOWER(email)=', strtolower($email));

  $query = $this->db->get($this->table_name);
  if ($query->num_rows() == 1) return $query->row();
  return NULL;
 }*/

 function get_user_by_email($login,$user_type)
 {
  if($user_type=='admin')
  {
  $level='2,3,4,5';
  }
  else if($user_type=='student')
  {
  $level='1';
  }
  $this->db->where("LOWER(email)='".strtolower($login)."' && level IN($level) && banned!='1' ");
  //$this->db->where('LOWER(username)=', strtolower($login));
  //$this->db->where('LOWER(level)=', '1');
 // $this->db->or_where("LOWER(username)='".strtolower($login)."' and level IN($level)");
  //$this->db->or_where('LOWER(email)=', strtolower($login));
  

  $query = $this->db->get($this->table_name);
  if ($query->num_rows() == 1) return $query->row();
  return NULL;
 }

	/**
	 * Check if username available for registering
	 *
	 * @param	string
	 * @return	bool
	 */
	function is_username_available($username)
	{
		$this->db->select('1', FALSE);
		$this->db->where('LOWER(username)=', strtolower($username));

		$query = $this->db->get($this->table_name);
		return $query->num_rows() == 0;
	}

	/**
	 * Check if email available for registering
	 *
	 * @param	string
	 * @return	bool
	 */
	function is_email_available($email)
	{
		$this->db->select('1', FALSE);
		$this->db->where('LOWER(email)=', strtolower($email));
		$this->db->or_where('LOWER(new_email)=', strtolower($email));

		$query = $this->db->get($this->table_name);
		return $query->num_rows() == 0;
	}

	/**
	 * Create new user record
	 *
	 * @param	array
	 * @param	bool
	 * @return	array
	 */
	function create_user($data, $activated = TRUE)
	{
		//$data['created'] = date('Y-m-d H:i:s');
		//$data['activated'] = $activated ? 1 : 0;
		$data['activated'] = 1;

		if ($this->db->insert($this->table_name, $data)) {
			$user_id = $this->db->insert_id();
			//if ($activated) by sumit wim 
			$this->create_profile($user_id);
			return array('user_id' => $user_id);
		}
		return NULL;
	}

	/**
	 * Activate user if activation key is valid.
	 * Can be called for not activated users only.
	 *
	 * @param	int
	 * @param	string
	 * @param	bool
	 * @return	bool
	 */
	function activate_user($user_id, $activation_key, $activate_by_email)
	{
		$this->db->select('1', FALSE);
		$this->db->where('id', $user_id);
		if ($activate_by_email) {
			$this->db->where('new_email_key', $activation_key);
		} else {
			$this->db->where('new_password_key', $activation_key);
		}
		$this->db->where('activated', 0);
		$query = $this->db->get($this->table_name);

		if ($query->num_rows() == 1) {

			$this->db->set('activated', 1);
			$this->db->set('new_email_key', NULL);
			$this->db->where('id', $user_id);
			$this->db->update($this->table_name);

			$this->create_profile($user_id);
			return TRUE;
		}
		return FALSE;
	}

	/**
	 * Purge table of non-activated users
	 *
	 * @param	int
	 * @return	void
	 */
	function purge_na($expire_period = 172800)
	{
		$this->db->where('activated', 0);
		$this->db->where('UNIX_TIMESTAMP(created) <', time() - $expire_period);
		$this->db->delete($this->table_name);
	}

	/**
	 * Delete user record
	 *
	 * @param	int
	 * @return	bool
	 */
	function delete_user($user_id)
	{
		$this->db->where('id', $user_id);
		$this->db->delete($this->table_name);
		if ($this->db->affected_rows() > 0) {
			$this->delete_profile($user_id);
			return TRUE;
		}
		return FALSE;
	}

	/**
	 * Set new password key for user.
	 * This key can be used for authentication when resetting user's password.
	 *
	 * @param	int
	 * @param	string
	 * @return	bool
	 */
	function set_password_key($user_id, $new_pass_key)
	{
		$this->db->set('new_password_key', $new_pass_key);
		$this->db->set('new_password_requested', date('Y-m-d H:i:s'));
		$this->db->where('id', $user_id);

		$this->db->update($this->table_name);
		return $this->db->affected_rows() > 0;
	}

	/**
	 * Check if given password key is valid and user is authenticated.
	 *
	 * @param	int
	 * @param	string
	 * @param	int
	 * @return	void
	 */
	function can_reset_password($user_id, $new_pass_key, $expire_period = 900)
	{
		$this->db->select('1', FALSE);
		$this->db->where('id', $user_id);
		$this->db->where('new_password_key', $new_pass_key);
		$this->db->where('UNIX_TIMESTAMP(new_password_requested) >', time() - $expire_period);

		$query = $this->db->get($this->table_name);
		return $query->num_rows() == 1;
	}

	/**
	 * Change user password if password key is valid and user is authenticated.
	 *
	 * @param	int
	 * @param	string
	 * @param	string
	 * @param	int
	 * @return	bool
	 */
	function reset_password($user_id, $new_pass, $new_pass_key, $expire_period = 900)
	{
		$this->db->set('password', $new_pass);
		$this->db->set('new_password_key', NULL);
		$this->db->set('new_password_requested', NULL);
		$this->db->where('id', $user_id);
		$this->db->where('new_password_key', $new_pass_key);
		$this->db->where('UNIX_TIMESTAMP(new_password_requested) >=', time() - $expire_period);

		$this->db->update($this->table_name);
		return $this->db->affected_rows() > 0;
	}

	/**
	 * Change user password
	 *
	 * @param	int
	 * @param	string
	 * @return	bool
	 */
	function change_password($user_id, $new_pass)
	{
		$this->db->set('password', $new_pass);
		$this->db->where('id', $user_id);

		$this->db->update($this->table_name);
		return $this->db->affected_rows() > 0;
	}

	/**
	 * Set new email for user (may be activated or not).
	 * The new email cannot be used for login or notification before it is activated.
	 *
	 * @param	int
	 * @param	string
	 * @param	string
	 * @param	bool
	 * @return	bool
	 */
	function set_new_email($user_id, $new_email, $new_email_key, $activated)
	{
		$this->db->set($activated ? 'new_email' : 'email', $new_email);
		$this->db->set('new_email_key', $new_email_key);
		$this->db->where('id', $user_id);
		$this->db->where('activated', $activated ? 1 : 0);

		$this->db->update($this->table_name);
		return $this->db->affected_rows() > 0;
	}

	/**
	 * Activate new email (replace old email with new one) if activation key is valid.
	 *
	 * @param	int
	 * @param	string
	 * @return	bool
	 */
	function activate_new_email($user_id, $new_email_key)
	{
		$this->db->set('email', 'new_email', FALSE);
		$this->db->set('new_email', NULL);
		$this->db->set('new_email_key', NULL);
		$this->db->where('id', $user_id);
		$this->db->where('new_email_key', $new_email_key);

		$this->db->update($this->table_name);
		return $this->db->affected_rows() > 0;
	}

	/**
	 * Update user login info, such as IP-address or login time, and
	 * clear previously generated (but not activated) passwords.
	 *
	 * @param	int
	 * @param	bool
	 * @param	bool
	 * @return	void
	 */
	function update_login_info($user_id, $record_ip, $record_time)
	{
		$this->db->set('new_password_key', NULL);
		$this->db->set('new_password_requested', NULL);

		if ($record_ip)		$this->db->set('last_ip', $this->input->ip_address());
		if ($record_time)	$this->db->set('last_login', date('Y-m-d H:i:s'));

		$this->db->where('id', $user_id);
		$this->db->update($this->table_name);
	}

	/**
	 * Ban user
	 *
	 * @param	int
	 * @param	string
	 * @return	void
	 */
	function ban_user($user_id, $reason = NULL)
	{
		$this->db->where('id', $user_id);
		$this->db->update($this->table_name, array(
			'banned'		=> 1,
			'ban_reason'	=> $reason,
		));
	}

	/**
	 * Unban user
	 *
	 * @param	int
	 * @return	void
	 */
	function unban_user($user_id)
	{
		$this->db->where('id', $user_id);
		$this->db->update($this->table_name, array(
			'banned'		=> 0,
			'ban_reason'	=> NULL,
		));
	}

	/**
	 * Create an empty profile for a new user
	 *
	 * @param	int
	 * @return	bool
	 */
	private function create_profile($user_id)
	{
		$this->db->set('user_id', $user_id);
		return $this->db->insert($this->profile_table_name);
	}

	/**
	 * Delete user profile
	 *
	 * @param	int
	 * @return	void
	 */
	private function delete_profile($user_id)
	{
		$this->db->where('user_id', $user_id);
		$this->db->delete($this->profile_table_name);
	}
	
	
	function fetch_home_gallery()
	{
		$this->db->select('*');
		$this->db->from('home_slider');
		$query = $this->db->get();
		return $query->result_array();
	}
	
	
	// function find_collage_steps_data()
	// {
		
		// if($this->tank_auth->is_logged_in())
		// {
			// $logged_user_id = $this->tank_auth->get_user_id();
		// }
		
			// $data = array(
			// 'user_id' => $logged_user_id,
			// 'intake1' => $this->input->post('begin_year1'),
			// 'intake2' => $this->input->post('begin_year2'),
			// 'studying_country_id' => $this->input->post(''),
			// '' => '',
			// '' => '',
			// '' => '',
			// '' => '',
			// '' => '',
			// '' => '',
			// '' => '',
			// '' => '',
			// '' => '',
			// '' => '',
			// '' => '',
			// '' => '',
			// '' => '',
			// '' => '',
			// '' => '',
			// '' => '',
			// );
		
	// }
	//function for fetch country id for fb
	function fetch_country_id($country_fb_user)
	{
  
		$this->db->select('country_id');
		$this->db->where('country_name',$country_fb_user);
		$query = $this->db->get('country');
		//print_r($query);
		if($query->num_rows() > 0)
		{
		$row = $query->row_array(); 
		return $row['country_id'];
		}
		else{
		return 0;
		}
	}
	//function for fetch city id for fb
	function fetch_city_id($city_fb_user)
	{
  
		$this->db->select('city_id');
		$this->db->where('cityname',$city_fb_user);
		$query = $this->db->get('city');
		//print_r($query);
		if($query->num_rows() > 0)
		{
		$row = $query->row_array(); 
		return $row['city_id'];
		}
		else{
		return 0;
		}
	}
	
	function update_facebook_profile($update_fb_profile)
	{
		$logged_user_id = $this->tank_auth->get_user_id();
		
		$this->db->where('user_id',$logged_user_id);
		$this->db->update('user_profiles',$update_fb_profile); 
	}
	/* Code For Reset Password by Subhanarayan */
	function check_email_exists_lost_pass()
	{
		$post_current_email = $this->input->post('email');
		$this->db->select('id,email');
		$this->db->where('email',$post_current_email);
		$query = $this->db->get('users');
		if($query->num_rows() > 0)
		{
			return $query->row_array();
		}
		else{
		return 0;
		}
		// $this->db->where('email_address', $str);
	  // $found = $this->db->get('users')->num_results(); // this returns the number of rows having the same address.
	  // if ($found!=0)
		 // return 0;  // more than 0 rows found. the callback fails.
	  // else
		// return true;   // 0 rows found. callback is ok.
	
	}
	function set_key_forgot_password($set_key,$user_id)
	{
		$this->db->where('id', $user_id);
		$this->db->update($this->table_name, $set_key);
	}
	
	/* check if lost password link is valid */
	function update_and_deactivate_psw_request($set_values,$set_update_values)
	{
		$clean_key = array(
		'new_password_key' => 'NULL'
		);
		$this->db->where($set_values);
		$this->db->update($this->table_name, $set_update_values);
		if($this->db->affected_rows() > 0)
		{
			$this->db->where('id',$set_values['id']);
		$this->db->update($this->table_name, $clean_key);
			return 1;
		}
		else{
		return 0;
		}
	}
	
	function get_email_by_userid($uid)
	{
		$this->db->select('email');
		$query = $this->db->get_where('users',array('id'=>$uid));
		if($this->db->affected_rows() > 0)
		{
			return $query->row_array();
		}
		else{
		return 0;
		}
	}
	
	function get_university_by_id($univ_id)
	{
		$query = $this->db->get_where('university',array('univ_id'=>$univ_id));
		if($query->num_rows() > 0)
		{
			return $query->row_array();
		}
		else {
		return 0;
		}
	}
	
	function fetch_country_name_by_id($country_id)
	{
		$this->db->select('country_name');
		$this->db->where('country_id',$country_id);
		$query = $this->db->get('country');
		if($query->num_rows() > 0)
		{
			return $query->row_array();
		}
		else {
		return 0;
		}
	}
	
	function fetch_city_name_by_id($city_id)
	{
		$this->db->select('cityname');
		$this->db->where('city_id',$city_id);
		$query = $this->db->get('city');
		if($query->num_rows() > 0)
		{
			return $query->row_array();
		}
		else {
		return 0;
		}
	}
	
	function get_followers_of_univ($univ_id)
	{
		$query = $this->db->get_where('follow_univ',array('follow_to_univ_id'=>$univ_id,'followed_by !='=>''));
		$rows = mysql_affected_rows();
		return $rows;
	}
	
	function get_followers_detail_of_univ($univ_id)
	{
		$this->db->select('followed_by');
		$this->db->from('follow_univ');
		$this->db->where('follow_to_univ_id',$univ_id);
		$query = $this->db->get();
		foreach($query->result_array() as $results)
		{
		$followers_id[]=$results['followed_by'];
		}
			if($query->num_rows() > 0)
			{	
			  $this->db->select('*');
			  $this->db->from('users');
			  $this->db->join('user_profiles', 'users.id = user_profiles.user_id');
			  $this->db->where_in('id', $followers_id);
			  $this->db->limit(10);
			  $res = $this->db->get();
			  return $res->result_array();
			}
	}
	
	function add_followers($add_follower)
	{
		$this->db->set($add_follower);
		$query = $this->db->insert('follow_univ');
		 return $this->db->affected_rows() ? 1 : 0;
	}
	
	function check_is_already_followed($add_follower)
	{
		$query = $this->db->get_where('follow_univ',$add_follower);
		return $this->db->affected_rows() ? 1 : 0;
	}
	
	function check_is_already_followed_to_person($add_follower)
	{
		$query = $this->db->get_where('follow_person',$add_follower);
		return $this->db->affected_rows() ? 1 : 0;
	}
	
	function unjoin_now($add_follower)
	{
		$this->db->where($add_follower);
		$this->db->delete('follow_univ');
	}
	
	function unfollow_now_to_user($add_follower)
	{
		$this->db->where($add_follower);
		$this->db->delete('follow_person');
	}
	
	function add_followers_to_person($add_follower)
	{
		$this->db->set($add_follower);
		$query = $this->db->insert('follow_person');
		 return $this->db->affected_rows() ? 1 : 0;
	}
	
	function get_articles_of_univ($univ_id)
	{
		$query = $this->db->get_where('news_article',array('univ_id'=>$univ_id,'na_type'=>'article','na_type_ud'=>'univ_na'));
		$rows = mysql_affected_rows();
		return $rows;
	}
	function get_detail_articles_of_univ($univ_id)
	{
		$query = $this->db->get_where('news_article',array('univ_id'=>$univ_id));
		$rows = $query->result_array();
		return $rows;
	}
	function get_program_provide_by_univ($univ_id)
	{
		$this->db->select('program_id');
		$this->db->from('univ_program');
		$this->db->where('univ_id',$univ_id);
		$query = $this->db->get();
		//print_r($query->result_array());
		foreach($query->result_array() as $results)
		{
		$program_id[]=$results['program_id'];
		}
		if($query->num_rows() > 0)
		{
		$this->db->select('course_name');
		$this->db->from('program');
		$this->db->where_in('prog_id', $program_id);
		$this->db->limit(5);
		$res=$this->db->get();
		//print_r($res->row_array());
		return $res->result_array();
		}
	}
	
<<<<<<< HEAD
	function get_collages_by_search($type_educ_level,$search_country,$search_course)
	{
		if($type_educ_level != '' and $search_country != '' and $search_course != '')
		{
		
		$this->db->select('univ_id');
		$this->db->from('university');
		$this->db->where('country_id',trim($search_country));
		$rows_univ = $this->db->get();
		$rows_univ_table = $rows_univ->result_array();
		
		$this->db->select('univ_id');
		$this->db->where('program_id',trim($search_course));
		$rows_univ_program = $this->db->get('univ_program');
		$rows_univ_program_table = $rows_univ_program->result_array();
		$arr = array();
		if($rows_univ->num_rows() > 0 && $rows_univ_program->num_rows() > 0)
		{
			foreach($rows_univ_table as $univ_table)
			{
				 $univ_id_one = $univ_table['univ_id'];
				foreach($rows_univ_program_table as $univ_prog_table)
				{
					 $univ_prog_table = $univ_prog_table['univ_id'];
					if(trim($univ_id_one) == trim($univ_prog_table))
					{
						//echo $univ_prog_table;
						$this->db->select('*');
						$this->db->from('university');
						$this->db->where('univ_id',$univ_prog_table);
						$results = $this->db->get();
						$res_of_univ_search = $results->row_array();
						$arr[] = $results->row_array();
						$marker[] = $res_of_univ_search['latitude'].','.$res_of_univ_search['longitude'].','.$res_of_univ_search['univ_name'].','.$res_of_univ_search['address_line1'];
						$univ_follow[] = $this->get_followers_of_univ($univ_prog_table);
						$univ_article[] = $this->get_articles_of_univ($univ_prog_table);
						$univ_program[] = $this->get_program_provide_by_univ($univ_prog_table);
						
					}
					
				}
			}
			$univ_data=array();
			$univ_data['university'] = $arr;
			$univ_data['followers'] = $univ_follow;
			$univ_data['article'] = $univ_article;
			$univ_data['program'] = $univ_program;
			$univ_data['position'] = $marker;
			//print_r(univ_data);
			if(!empty($univ_data))
			{
			return $univ_data;
			}
			else{
			return 0;
			}
		}
		
	}
	else if($type_educ_level == 0 and $search_country != '' and $search_course == '')
	{
						$this->db->select('*');
						$this->db->from('university');
						$this->db->where('country_id',$search_country);
						$results = $this->db->get();
						$res_of_univ_search = $results->row_array();
						$arr[] = $results->row_array();
						$univ_follow[] = $this->get_followers_of_univ($univ_prog_table);
						$univ_article[] = $this->get_articles_of_univ($univ_prog_table);
						$univ_program[] = $this->get_program_provide_by_univ($univ_prog_table);	
						$marker[] = $res_of_univ_search['latitude'].','.$res_of_univ_search['longitude'].','.$res_of_univ_search['univ_name'].','.$res_of_univ_search['address_line1'];
						//return $arr;
						$univ_data=array();
						$univ_data['university'] = $arr;
						$univ_data['followers'] = $univ_follow;
						$univ_data['article'] = $univ_article;
						$univ_data['program'] = $univ_program;
						$univ_data['position'] = $marker;
						//print_r(univ_data);
						if(!empty($univ_data))
						{
						return $univ_data;
						}
						else{
						return 0;
						}
	}
	
	else if($type_educ_level != 0 and $type_educ_level != '' and $search_country != '' and $search_course == '')
	{
		$this->db->select('univ_id');
		$this->db->from('university');
		$this->db->where('country_id',trim($search_country));
		$rows_univ = $this->db->get();
		$rows_univ_table = $rows_univ->result_array();
		
		$this->db->select('univ_id');
		$this->db->where('curr_educ_level_id',trim($type_educ_level));
		$rows_univ_program = $this->db->get('univ_program');
		$rows_univ_program_table = $rows_univ_program->result_array();
		
		if($rows_univ->num_rows() > 0 && $rows_univ_program->num_rows() > 0)
		{
			foreach($rows_univ_table as $univ_table)
			{
				 $univ_id_one = $univ_table['univ_id'];
				foreach($rows_univ_program_table as $univ_prog_table)
				{
					 $univ_prog_table = $univ_prog_table['univ_id'];
					if(trim($univ_id_one) == trim($univ_prog_table))
					{
						//echo $univ_prog_table;
						$this->db->select('*');
						$this->db->from('university');
						$this->db->where('univ_id',$univ_prog_table);
						$results = $this->db->get();
						$res_of_univ_search = $results->row_array();
						$arr[] = $results->row_array();
						$univ_follow[] = $this->get_followers_of_univ($univ_prog_table);
						$univ_article[] = $this->get_articles_of_univ($univ_prog_table);
						$univ_program[] = $this->get_program_provide_by_univ($univ_prog_table);
						$marker[] = $res_of_univ_search['latitude'].','.$res_of_univ_search['longitude'].','.$res_of_univ_search['univ_name'].','.$res_of_univ_search['address_line1'];
					}
					
				}
			}
			$univ_data=array();
			$univ_data['university'] = $arr;
			$univ_data['followers'] = $univ_follow;
			$univ_data['article'] = $univ_article;
			$univ_data['program'] = $univ_program;
			$univ_data['position'] = $marker;
			//print_r(univ_data);
			if(!empty($univ_data))
			{
			return $univ_data;
			}
			else{
			return 0;
			}
		}
	}
	}
=======
	
>>>>>>> b5fd64388c0d83a053b3d8339f6279266205a1d0
	function show_all_college()
	{
		$this->db->select('univ_id');
		$this->db->from('university');
		$result = $this->db->get();
		$all_results = $result->result_array();
		//print_r($all_results);
		$count_res = count($all_results);
		
		for($loop=0; $loop < $count_res; $loop++)
		{
		$all_results2 = $all_results[$loop];
		foreach($all_results2 as $univ_id1)
		{
		//print_r($univ_id1);
			//$univ_detail_arr[] = $this->get_university_by_id($univ_id1);
						$this->db->select('*');
						$this->db->from('university');
						$this->db->where('univ_id',$univ_id1);
						$results = $this->db->get();
						$res_of_univ_search = $results->row_array();
						$univ_detail_arr[] = $results->row_array();
						
			
			$univ_follow[] = $this->get_followers_of_univ($univ_id1);
			$univ_article[] = $this->get_articles_of_univ($univ_id1);
			$univ_program[] = $this->get_program_provide_by_univ($univ_id1);
			//$univ_gallery[] = $this->get_univ_gallery($univ_id1);
			$marker[] = $res_of_univ_search['latitude'].','.$res_of_univ_search['longitude'].','.$res_of_univ_search['univ_name'].','.$res_of_univ_search['address_line1'];
		}
		}
			$univ_data=array();
			$univ_data['university'] = $univ_detail_arr;
			$univ_data['followers'] = $univ_follow;
			$univ_data['article'] = $univ_article;
			$univ_data['program'] = $univ_program;
			$univ_data['position'] = $marker;
			//$univ_data['gallery'] = $univ_gallery;
			//print_r(univ_data);
			if(!empty($univ_data))
			{
			return $univ_data;
			}
			else{
			return 0;
			}
	}
	
	function get_univ_gallery($univ_id)
	{
		$where_clause = array(
		'univ_id'=>$univ_id,
		'gal_type'=>'univ'
		);
		$this->db->select('g_image_path');
		$this->db->from('univ_gallery');
		$this->db->where($where_clause);
		$query = $this->db->get();
		return $result = $query->result_array();
	}

	function send_message_to_user($msg)
	{
		$this->db->set($msg);
		$query = $this->db->insert('message_table');
		return $this->db->affected_rows() ? 1: 0;
	}
	
	function fetch_latest_events_by_univ_id($univ_id)
	{
		$this->db->select_max('event_id');
		$this->db->from('events');
		$this->db->where('event_univ_id',$univ_id);
		$query = $this->db->get();
		//$query = $this->db->get_where('events',array('event_univ_id'=>$univ_id,'event_id'));
		$result = $query->row_array();
		if($this->db->affected_rows() > 0)
		{
			$this->db->select('*');
		$this->db->from('events');
		$this->db->where('event_id',$result['event_id']);
		$query = $this->db->get();
		$result = $query->row_array();
		return $result;
		//print_r($result);
		}
	}
	
	function fetch_educ_level_by_id($cur_educ_lvl)
	{
		$this->db->select('educ_level');
		$this->db->from('program_educ_level');
		$this->db->where('prog_edu_lvl_id',$cur_educ_lvl);
		$query = $this->db->get();
		return $query->row_array();
	}
	
	function fetch_area_interest_by_id($area_interest)
	{
		$this->db->select('program_parent_name');
		$this->db->from('program_parent');
		$this->db->where('prog_parent_id',$area_interest);
		$query = $this->db->get();
		return $query->row_array();
	}
	
	function get_followers_detail_of_person($id)
	{
		$this->db->select('followed_by');
		$this->db->from('follow_person');
		$this->db->where('followed_to_person_id',$id);
		$query = $this->db->get();
		foreach($query->result_array() as $results)
		{
		$followers_id[]=$results['followed_by'];
		}
			if($query->num_rows() > 0)
			{
			  $this->db->select('*');
			  $this->db->from('users');
			  $this->db->join('user_profiles', 'users.id = user_profiles.user_id');
			  $this->db->where_in('id', $followers_id);
			  $this->db->limit(10);
			  $res = $this->db->get();
			  return $res->result_array();
			  }
	}
	
	function inbox_message($logged_user)
	{
		$query = $this->db->get_where('message_table',array('recipent_id'=>$logged_user));
		if($query->num_rows() > 0)
		{
			//print_r($query->result_array());
			return $query->result_array();
		}
		else{
		return 0;
		}
	}
	
	function fetch_message_by_id($message_condition)
	{
		$query = $this->db->get_where('message_table',$message_condition);
		if($query->num_rows() > 0)
		{
			return $query->row_array();
		}
		else
		{
			return 0;
		}
	}
	
	function get_sender_email($sender_id)
	{
		$this->db->select('email');
		$this->db->from('users');
		$this->db->where('id',$sender_id);
		$query = $this->db->get();
		if($query->num_rows() > 0)
		{
			return $query->row_array();
		}
		else{
		return 0;
		}
	}
	
	function delete_single_message_inbox($msg_del_cond)
	{
		$this->db->where($msg_del_cond);
		$this->db->delete('message_table');
		return $this->db->affected_rows() ? 1 : 0;
	}
	
	function fetch_program_title_of_univ($univ_id)
	{
		// $this->db->select('program_id');
		// $this->db->from('univ_program');
		// $this->db->where('univ_id',$univ_id);
		// $query = $this->db->get();
		// print_r($query->result_array());
		// foreach($query->result_array() as $progid)
		// {
			// $prog_id[] = $progid['program_id'];
		// }
		
		// if($query->num_rows() > 0)
		// {
			$this->db->select('*');
			$this->db->from('univ_program');
			$this->db->join('program', 'univ_program.program_id = program.prog_id');
			$this->db->join('program_educ_level', 'program_educ_level.prog_edu_lvl_id = program.educ_level_id');
			$this->db->where_in('univ_id',$univ_id);
			$res = $this->db->get();
			//print_r($res->result_array());
			//print_r($res->result_array());
			return $res->result_array();
			//return $res->result_array();
		//}
	}
	
	function fetch_course_detail($univ_id,$course_id)
	{
			$condition = array(
			'prog_id'=>$course_id,
			'univ_id'=>$univ_id
			);
			$this->db->select('*');
			$this->db->from('univ_program');
			$this->db->join('program', 'univ_program.program_id = program.prog_id');
			$this->db->join('program_educ_level', 'program_educ_level.prog_edu_lvl_id = program.educ_level_id');
			
			$this->db->where($condition);
			$res = $this->db->get();
			if($res->num_rows() > 0)
			{
			return $res->row_array();
			}
			else{
			return 0;
			}
	}
	
	
}

/* End of file users.php */
/* Location: ./application/models/auth/users.php */