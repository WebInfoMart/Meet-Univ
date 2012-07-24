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
		$this->gallery_path = realpath(APPPATH . '../uploads/user_pic/');
		$this->gallery_path_url = base_url().'uploads/user_pic/';
		$ci =& get_instance();
		$this->table_name			= $ci->config->item('db_table_prefix', 'tank_auth').$this->table_name;
		$this->profile_table_name	= $ci->config->item('db_table_prefix', 'tank_auth').$this->profile_table_name;
		$this->load->library('pagination');
		$this->load->library('session');
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
		$this->db->order_by('country_name','asc');
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
		$this->db->order_by('program_parent_name','asc');
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
		if($this->input->post('year')=='-1')
		{
		$year='0000';
		$month='00';
		$date='00';
		}
		else{
		$year = $this->input->post('year');
		$month = $this->input->post('month');
		$date = $this->input->post('date');
		}
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
		 $user_id = $this->tank_auth->get_user_id();
		 $data['user_id'] = $this->tank_auth->get_user_id();
		
		 $image_data['file_name'] = "";
		$config = array(
			'allowed_types' => 'jpg|jpeg|gif|png',
			'upload_path' => $this->gallery_path,
			'min_width'=> '175',
			'min_height'=> '138',
			'file_name'=>'user_'.$user_id
		);
        
		$this->load->library('upload', $config);
		$this->upload->overwrite = true;
		if (!$this->upload->do_upload())
        {
          $data['error'] = $this->upload->display_errors();
		  $data['upload_errors'] = $data['error']."";
		  $this->session->set_flashdata('upload_pic_error',$data['error']);
        }
		else{
		//$this->upload->do_upload();
		$image_data = $this->upload->data();
		
		$config = array(
			'source_image' => $image_data['full_path'],
			'create_thumb'=> TRUE,
			'new_image' => $this->gallery_path . '/thumbs',
			'maintain_ration' => true,
			'width' => 200,
			'height' => 200
		);
		
		$this->load->library('image_lib', $config);
		$this->image_lib->resize();
		$data['thumb_image_name'] = $image_data['raw_name'].'_thumb'.$image_data['file_ext'];
		if($image_data['file_name'] != '')
		{
		 $this->db->query("update user_profiles set user_pic_path = '".$image_data['file_name']."',user_thumb_pic_path = '".$data['thumb_image_name']."' where user_id='".$data['user_id']."'");
		}
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
		 $data['user_id'] = $this->tank_auth->get_user_id();
		 $redirect_false_update_profile = "";
		 $image_data['file_name'] = "";
		$config = array(
			'allowed_types' => 'jpg|jpeg|gif|png',
			'upload_path' => $this->gallery_path,
			'file_name'=>'user_'.$data['user_id']
		);
		if($_FILES['userfile']['name']!='') {
		$this->load->library('upload', $config);
		$this->upload->overwrite = true;
		if (!$this->upload->do_upload())
        {
          $data['error'] = $this->upload->display_errors();
		  $data['upload_errors'] = $data['error'];
		  $this->session->set_flashdata('update_upload_pic_error','please upload the image file');
		  $redirect_false_update_profile = 'notredirect';
        }
		else{
		//$this->upload->do_upload();
		$image_data = $this->upload->data();
		
		$config = array(
			'source_image' => $image_data['full_path'],
			'create_thumb'=> TRUE,
			'new_image' => $this->gallery_path . '/thumbs',
			'maintain_ration' => true,
			'width' => 200,
			'height' => 200
		);
		
		$this->load->library('image_lib', $config);
		$this->image_lib->resize();
		$data['thumb_image_name'] = $image_data['raw_name'].'_thumb'.$image_data['file_ext'];
		//$img_path_store = $this->input->post('userfile');
		//$img_path_store = $config['new_image'];
		//print_r($this->session->userdata());
		
		if($image_data['file_name'] != '')
		{
		 $this->db->query("update user_profiles set user_pic_path = '".$image_data['file_name']."',user_thumb_pic_path = '".$data['thumb_image_name']."' where user_id='".$data['user_id']."'");
		}
		}
		
		}
		//echo $this->session->userdata('user_id');
		if($redirect_false_update_profile != '')
		{
		redirect('update_profile');
		}
		else{
		redirect('home/pus');
		}
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
		$this->db->select('*');
		$this->db->from('users');
		$this->db->where('id',$user_id);
		$query = $this->db->get();
		// return $query->result_array();
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
			//$this->create_profile($user_id);
			return $user_id;
		}
	}
	
	function facebook_profile_insert($user_id,$fb_gender)
	{
		$this->db->set('user_id', $user_id);
		$this->db->set('gender', $fb_gender);
		return $this->db->insert($this->profile_table_name);
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
  $this->db->where("LOWER(email)='".strtolower($login)."' && level IN($level) && banned!='1'");
  
  }
  else if($user_type=='student')
  {
  $level='1';
  $this->db->where("LOWER(email)='".strtolower($login)."' && level IN($level) && banned!='1' && activated!='0'");
  }
  //$this->db->where("LOWER(email)='".strtolower($login)."' && level IN($level) && banned!='1' && activated!='0'");
  //$this->db->where('LOWER(username)=', strtolower($login));
  //$this->db->where('LOWER(level)=', '1');
 // $this->db->or_where("LOWER(username)='".strtolower($login)."' and level IN($level)");
  //$this->db->or_where('LOWER(email)=', strtolower($login));
  

  $query = $this->db->get($this->table_name);
 if ($query->num_rows() == 1) 
  {
  return $query->row();
  }
  else
  {
  return NULL;
  }
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
	function activate_user($user_id, $activation_key)
 {
  $data = array(
               'activated' =>'1'
            );
  $this->db->where(array('id'=>$user_id,'new_email_key'=>$activation_key));
  $this->db->update('users', $data);
  return $this->db->affected_rows() ? 1 : 0;
  
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
	// Fetch State Name for showing in university page
	function fetch_state_name_by_id($state_id)
	{
		$this->db->select('statename');
		$this->db->where('state_id',$state_id);
		$query = $this->db->get('state');
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
		$query = $this->db->get_where('article',array('article_univ_id'=>$univ_id,'article_type_ud'=>'univ_article','article_approve_status'=>'1'));
		$rows = mysql_affected_rows();
		return $rows;
	}
	function get_question_by_univ($univ_id)
	{
		$query = $this->db->get_where('questions',array('q_univ_id'=>$univ_id,'q_category'=>'univ'));
		$rows = mysql_affected_rows();
		return $rows;
	}
	function get_detail_news_of_univ($univ_id)
	{
		$this->db->select('*');
		$this->db->from('news');
		$this->db->where(array('news_univ_id'=>$univ_id,'news_type_ud'=>'univ_news'));
		$this->db->limit(2);
		$this->db->order_by("publish_time", "desc"); 	
		$query = $this->db->get();
		return $query->result_array();
	}
	function get_detail_articles_of_univ($univ_id)
	{
		$this->db->select('*');
		$this->db->from('article');
		$this->db->where(array('article_univ_id'=>$univ_id,'article_type_ud'=>'univ_article','article_approve_status'=>'1'));
		$this->db->limit(4);
		$this->db->order_by("publish_time", "desc");
		$query = $this->db->get();		
		return $query->result_array();
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
		$this->db->select('prog_id,course_name');
		$this->db->from('program');
		$this->db->where_in('prog_id', $program_id);
		$this->db->limit(5);
		$res=$this->db->get();
		//print_r($res->row_array());
		return $res->result_array();
		}
	}
	//increase no views of univ
	function increase_univ_no_of_views($univ_id,$views_count)
	{
	$this->db->where('univ_id', $univ_id);
	$this->db->update('university',array('univ_views_count'=>$views_count));
	}
	
	
	/*function show_all_college()
	{
		$this->db->select('univ_id');
		$this->db->from('university');
		if($this->input->get('country_id')!='')
		{
		 $this->db->where('country_id',$this->input->get('country_id'));
		}
		if($this->input->get('education_level')!='')
		{
		 //$this->db->where('country_id',$this->input->get('education_level'));
		}
		$result1 = $this->db->get();
		$all_results1 = $result1->result_array();
		//print_r($all_results);
		$count_res = count($all_results1);
		if($count_res > 0)
		{
		$config['base_url']=base_url()."college_list/all_colleges";
		$config['total_rows']=$count_res;
		$config['per_page'] = '30'; 
		$offset = $this->uri->segment(3); //this will work like site/folder/controller/function/query_string_for_cat/query_string_offset
        $limit = $config['per_page'];
		$this->db->select('univ_id');
		$this->db->from('university');
		$this->db->limit($limit,$offset);
		$result = $this->db->get();
		$this->pagination->initialize($config);
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
		else
		{
		return 0;
		}		
	}*/
	
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
		$this->db->select('*');
		$this->db->from('events');
		$this->db->where('event_univ_id',$univ_id);
		$this->db->limit(2);
		$this->db->order_by("event_created_time", "desc");
		$query = $this->db->get();
		$result = $query->result_array();
		return $result;
		
	}
	
	function fetch_educ_level_by_id($cur_educ_lvl)
	 {
	  $this->db->select('educ_level');
	  $this->db->from('program_educ_level');
	  $this->db->where('prog_edu_lvl_id',$cur_educ_lvl);
	  $query = $this->db->get();
	  if($query->num_rows() > 0)
	  {
	  return $query->row_array();
	  }
	  else{
	  return 0;
	  }
	 }
	
	function fetch_area_interest_by_id($area_interest)
	 {
	  $this->db->select('program_parent_name');
	  $this->db->from('program_parent');
	  $this->db->where('prog_parent_id',$area_interest);
	  $query = $this->db->get();
	  if($query->num_rows() > 0)
	  {
	  return $query->row_array();
	  }
	  else {
	  return 0;
	  }
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
		$query = $this->db->get_where('message_table',array('recipent_id'=>$logged_user,'msg_inbox_status'=>'0'));
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
	
	function delete_single_message_inbox($msg_del_cond,$outbox_status)
	{

		 if($outbox_status)
		  {
		  $this->db->where($msg_del_cond);
		  $this->db->delete('message_table');
		  }
		  else
		  {
		  $this->db->where($msg_del_cond);
		  $msg_update_cond['msg_inbox_status']='1';
		  $this->db->update('message_table', $msg_update_cond);
		  }
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
			$this->db->join('university', 'university.univ_id = univ_program.univ_id','left');
			$this->db->where_in('univ_program.univ_id',$univ_id);
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
	
		public function get_content($url)
		{
				   $ch = curl_init($url);
					curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
					$curl_scraped_page = curl_exec($ch);
					curl_close($ch);
				//echo $curl_scraped_page;
		   
		   $explode_data = explode('<table id="guide">',$curl_scraped_page);
		   $explode_data2 = explode('</div>',$explode_data[1]);
		   $explode_data3 = explode('<tr>',$explode_data2[0]);
		    //print_r($explode_data3);
			//extract university name
			for($explode_data3_1=1;$explode_data3_1<count($explode_data3);$explode_data3_1++)
		   {
			$explode_univ_name1 = explode('- ',$explode_data3[$explode_data3_1]);
			$explode_univer_name2 = explode('</h3>',$explode_univ_name1[1]);
			
			$explode_univ_phone1 = explode('t:',$explode_univ_name1[1]);
			$explode_univ_fax1 = explode('f:',$explode_univ_phone1[1]);
			$explode_univ_email1 = explode('e:',$explode_univ_fax1[1]);
			$explode_univ_web1 = explode('w:',$explode_univ_email1[1]);
			$explode_univ_web = explode('w:',$explode_univ_web1[1]);
			$explode_univer_web1 = explode('<br />',$explode_univ_web1[1]);
			$explode_adress1 = explode('</h3>',$explode_univ_phone1[0]);
			
			
			
			$a = strip_tags($explode_univer_name2[0]);
			$b = strip_tags($explode_univer_name2[0]);
			$c = strip_tags($explode_adress1[1]);
			$d = strip_tags($explode_univ_fax1[0]);
			$e = strip_tags($explode_univ_email1[0]);
			$f = strip_tags($explode_univ_web1[0]);
			$g = strip_tags($explode_univer_web1[0]);
			$array_insert_univ_data = array(
			'univ_name'=>$a,
			'title'=>$b,
			'address_line1'=>$c,
			'phone_no'=>$d,
			'univ_fax'=>$e,
			'univ_email'=>$f,
			'univ_web'=>$g
			);
			$this->db->insert('university',$array_insert_univ_data);
			
			}
			//echo "web"; print_r(strip_tags($explode_univer_web1[0]));
			//print_r($explode_univ_name1);

		}
		
		public function my_collage_of_user($logged_user)
		{
		   $this->db->select('*');
		   $this->db->from('follow_univ');
		   $this->db->where('followed_by',$logged_user);
		   $this->db->join('university','follow_univ.follow_to_univ_id = university.univ_id');
		   $this->db->order_by('ontime','desc');
		   $this->db->limit(2);
		   $query = $this->db->get();
		   if($query->num_rows() > 0)
		   {
			return $query->result_array();
		   }
		   else {
			return 0;
		}
	   }
		public function fetch_user_list_compose($email)
		{
		   $this->db->select('*');
		   $this->db->from('users');
		   $this->db->where_in('email',$email);
		   $this->db->join('user_profiles','users.id=user_profiles.user_id');
		   $query = $this->db->get();
		   if($query->num_rows() > 0)
		   {
			return $query->result_array();
		   }
		   else{
		   return 0;
		   }
		}
	  
		public function send_msg_by_search($insert)
		{
		   $this->db->set($insert);
		  $query = $this->db->insert('message_table');
		  return $this->db->affected_rows() ? 1: 0;
		}
		
		public function count_inbox_user($logged_user)
		{
		   $condition = array(
		   'recipent_id'=>$logged_user,
		   'msg_read_status'=>'0'
		   );
		   $this->db->select('*');
		   $this->db->from('message_table');
		   $this->db->where($condition);
		   $query = $this->db->get();
		   //$results = $query->result_array();
		   //print_r($query->result_array());
		   if($query->num_rows() > 0)
		   {
			return $query->num_rows();
		   }
		   else{
		   return 0;
		   }
		}
		  public function count_outbox_user($logged_user)
		  {
			   $this->db->select('*');
			   $this->db->from('message_table');
			   $this->db->where('sender_id',$logged_user);
			   $query = $this->db->get();
			   //$results = $query->result_array();
			   //print_r($query->result_array());
			   if($query->num_rows() > 0)
			   {
				return $query->num_rows();
			   }
			   else{
			   return 0;
			   }
		  }
		  
		public function set_msg_read_status($message_condition)
		{
		   $update_data = array(
		   'msg_read_status'=> '1'
		   );
		   $this->db->where($message_condition);
		   $this->db->update('message_table',$update_data);
		}
		function outbox_message($logged_user)
		{
		   $query = $this->db->get_where('message_table',array('sender_id'=>$logged_user,'msg_outbox_status'=>'0'));
		   if($query->num_rows() > 0)
		   {
			//print_r($query->result_array());
			return $query->result_array();
		   }
		   else{
		   return 0;
			}
		}
		function fetch_outbox_message_by_id($message_condition)
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
		
		function delete_single_message_outbox($msg_del_cond,$inbox_status)
		{
		  if($inbox_status)
		  {
		  $this->db->where($msg_del_cond);
		  $this->db->delete('message_table');
		  }
		  else
		  {
		  $this->db->where($msg_del_cond);
		  $msg_update_cond['msg_outbox_status']='1';
		  $this->db->update('message_table', $msg_update_cond);
		  }
		  return $this->db->affected_rows() ? 1 : 0;
		}
		
		function chk_profile_completeness($pro_data)
		{
		 $pro=0;
		 foreach($pro_data as $profile_data)
		 {
		 if($profile_data=='' || $profile_data==NULL || $profile_data=='0' || $profile_data=='0000-00-00')
		 {
			if($pro<12)
			{
			$pro++;
			}
		 }
		 }
		 $pro_complete=100-(($pro-2)*10);
		 if($pro_complete>100)
		 {
		 $pro_complete=100;
		 }
		 return $pro_complete ;
		
		}
		
		function fetch_program_by_area_intrest($educ_level,$area_interest)
		{
			$this->db->select('*');
			$this->db->from('univ_program');
			$this->db->join('program','univ_program.program_id=program.prog_id');
		    if($educ_level!='' && $educ_level!=0)
			{
			$serach_array['univ_program.prog_educ_level']=$educ_level;
			}
			$serach_array['univ_program.prog_parent_id']=$area_interest;
			$this->db->where($serach_array);
			$query=$this->db->get();
			if($query->num_rows()>0)
			return $query->result_array();
			else
			return 0;
			
		}
		
		
		
		
		
	
	
	
		
	function fetch_map_of_colleges($map_addresses)
    {
		$map_addresses_colleges=explode('map#@$%map',$map_addresses);
		foreach($map_addresses_colleges as $map_addresses_colleges_list)
		{
		$univ_name_with_address=explode('univ_name#@$%univ_name',$map_addresses_colleges_list);
		$univ_name=$univ_name_with_address[0];
		$univ_address="";
		if(count($univ_name_with_address)>1)
		{
		$univ_address=$univ_name_with_address[1];
		}
	    $marker[] = $univ_address.'||'.$univ_name.'||'.$univ_address;
		}
		return $marker;
	}	
		
	function get_upcoming_event_by_univ($univ_id)
	{
		$this->db->select("*");
		$this->db->from('events');
		$condition=array('event_univ_id'=>$univ_id,
						'event_type'=>'univ_event',
						'STR_TO_DATE(event_date_time, "%d %M %Y")>='=>date("Y-m-d"));
		$this->db->join('country','country.country_id=events.event_country_id','left');
		$this->db->join('city','city.city_id=events.event_city_id','left');
		
		$this->db->where($condition);
		$this->db->limit(1);
		//$this->db->order_by('STR_TO_DATE(event_date_time, "%d %M %Y")','asc');
		$res=$this->db->get();
		if($res->num_rows() > 0)
		{
		return $res->result_array();
		}
		else
		{
		return 0;
		}
	}	
		
		
	function fetch_area_interest_having_univ()
	{
		$this->db->select('*');
		$this->db->from('program_parent');
		$this->db->join('univ_program','univ_program.prog_parent_id=program_parent.prog_parent_id');
		$this->db->group_by("univ_program.prog_parent_id"); 
		$this->db->order_by('program_parent_name','asc');
		$query = $this->db->get();
		if($query->num_rows() > 0)
		return $query->result_array();
		else
		return 0;
	}	
		
	function fetch_profile_by_user_email($logged_user_email)
	 {
	 
			  $this->db->select('*');
			  $this->db->from('users');
			  $this->db->join('user_profiles', 'users.id = user_profiles.user_id');
			  $this->db->where('email', $logged_user_email);
			  $query = $this->db->get();
			  return $query->row_array();
	 }	
		
	function authfunction()
	{
	 
		$data = $this->path->all_path();
		/*  Upload code */
		//$this->load->model('Gallery_model');
		
		$data['gallery_home'] = $this->users->fetch_home_gallery();
		$data['country'] = $this->frontmodel->fetch_search_country_having_univ();
		//$data['cities'] = $this->frontmodel->fetch_cities_having_univ();
		$data['cities'] = $this->frontmodel->fetch_cities_having_events();
		
		$data['area_interest'] = $this->frontmodel->fetch_area_interest_having_univ();
		$data['featured_events']=$this->frontmodel->fetch_featured_events();
		$data['featured_college']=$this->frontmodel->fetch_featured_college();
		$data['featured_article']=$this->frontmodel->fetch_featured_article_home();	
		$data['featured_news']=$this->frontmodel->fetch_featured_news();
		$data['featured_news_show']=$this->frontmodel->fetch_featured_news_home();
		 $data['featured_quest'] = $this->frontmodel->fetch_home_featured_quest();
		 $data['get_latest_question_home'] = $this->quest_ans_model->get_all_quest_user_info();
		  
	//	print_r($data['featured_events']);
		/*  Upload code end */
		$this->load->view('auth/header',$data);
		$this->load->view('auth/home',$data);
		
		//$this->load->view('auth/home',$data);
		/*if (!$this->tank_auth->is_logged_in()) {
			redirect('/login/');
		} else {
			$data['user_id']	= $this->tank_auth->get_user_id();
			$data['username']	= $this->tank_auth->get_username();
			$logged_user = $data['user_id'];
			$this->load->model('users');
			$data['query'] = $this->users->fetch_all_data($logged_user);
			$data['profile_pic'] = $this->users->fetch_profile_pic($logged_user);
		//	print_r($data['profile_pic']);
			$data['educ_level'] = $this->users->fetch_educ_level();
			$data['country'] = $this->users->fetch_country();
			//print_r($data['country']);
			$data['area_interest'] = $this->users->fetch_area_interest();
			$this->load->view('auth/profile',$data);
			//$this->load->view('welcome', $data);
		}
		if ($this->input->post('upload')) {
			$this->users->do_upload();
		}*/
		
		//$data['images'] = $this->users->get_images();
		$this->load->view('auth/footer',$data);
	}
	
	function univ_id_of_domain($domain)
	{
	$this->db->select('*');
	$this->db->from('university');
	$this->db->where('subdomain_name',$domain);
	$query=$this->db->get();
	if($query->num_rows()>0)
	return $query->row_array();
	else
	return 0;
	}
	
	function get_new_email_key_by_userid($uid)
	{
  $this->db->select('new_email_key');
  $query = $this->db->get_where('users',array('id'=>$uid));
  if($this->db->affected_rows() > 0)
  {
   return $query->row_array();
  }
  else{
  return 0;
  }
 }
 
 function get_univ_overview_detail($univ_id,$overview_cond)
 {
	$this->db->select($overview_cond);
	$this->db->from('university');
	$this->db->where('univ_id',$univ_id);
	$query = $this->db->get();
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