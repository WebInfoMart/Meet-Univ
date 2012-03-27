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
		
		$this->db->where('user_id',$logged_user);
		$this->db->update('user_profiles', $data); 
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
	
	// function get_email_by_userid()
	// {
		
	// }
	
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
}

/* End of file users.php */
/* Location: ./application/models/auth/users.php */