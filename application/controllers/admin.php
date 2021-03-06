<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Admin extends CI_Controller
{
	function __construct()
	{
		parent::__construct();
		$this->gallery_path = realpath(APPPATH . '../uploads/home_gallery');
		
		$this->ci =& get_instance();
		$this->ci->load->config('tank_auth', TRUE);
		// $data['base'] = $this->config->item('base_url');
		// $data['css'] = $this->config->item('css_path');
		// $data['css'] = $this->config->item('img_path');
		$this->load->helper(array('form', 'url'));
		$this->load->library('form_validation');
		$this->load->library('security');
		$this->load->library('tank_auth');
		$this->lang->load('tank_auth');
		$this->load->library('googleanalytics');
		$this->load->model('admin/admindash');
		$this->load->model('admin/admindash_nc');			//added by satbir on 11/22/2012
		$this->load->model('admin/event_model');			//added by satbir on 11/17/2012		
	}
	function index($msg='')
	{
		$data = $this->path->all_path();
		if (!$this->tank_auth->is_admin_logged_in()) 
		{
			redirect('admin/adminlogin/');
		} 
		else 
		{
			$flag=0;
			$data['username'] = $this->tank_auth->get_username();
			$data['user_id'] = $this->tank_auth->get_admin_user_id();
			$data['admin_user_level']=$this->tank_auth->get_admin_user_level();			
			$data['admin_priv']=$this->adminmodel->get_user_privilege($data['user_id']);
			if((!($data['admin_priv'])) && ($data['admin_user_level']!=6 && $data['admin_user_level']!=2))
			{
				redirect('admin/adminlogout');
			}
			$this->load->view('univadmin/header', $data);
			$this->load->view('univadmin/sidebar', $data); 
			if($data['admin_user_level']=='3')
			{
				//$this->session->set_userdata('chat_username','Counselor_break_1212111_12121'); // Must be already set
				$data['univ_detail_edit']=$this->adminmodel->fetch_univ_detail($data['user_id']);
				if($data['univ_detail_edit']==0)
				{
					$flag=1;
					$data['msg']='No University Assigned Yet';
					$this->load->view('admin/userupdated',$data);
				}
				else
				{
					$data['university_id']=$data['univ_detail_edit'][0]->univ_id;
					$data['recent_leads']=$this->admindash->recent_leads($data['university_id']);//new
					$data['recent_questions']=$this->admindash->fetch_recent_five_question();//new
					$data['unasnwered']=$this->admindash->unasnwered();//new
					$data['recent_followers_of_univ']=$this->admindash->recent_followers_of_univ($data['university_id']); //new
					$data['recent_articles']=$this->admindash->recent_articles($data['university_id']);//new	
				}
				if($data['user_id']==534)
				{
					$data['recent_leads']="";
					$data['recent_leads']=$this->admindash_nc->recent_leads_nc();			
					$this->load->view('univadmin/admin_dash_nc', $data);					
				}
				else if($data['user_id']==533)
				{
					$data['recent_leads']="";
					$data['recent_leads']=$this->admindash_nc->recent_leads_as();			
					$this->load->view('univadmin/admin_dash_nc', $data);					
				}
				else if($data['user_id']==544)
				{		
					redirect('newadmin/admin_events/recent_event');
				}
				else
				{
					$data['events_for_calendar'] = $this->event_model->fetch_events_for_calendar();		//added by satbir on 11/17/2012
					$this->load->view('univadmin/admin_dash', $data);
				}
			}
			if($data['admin_user_level']=='5' || $data['admin_user_level']=='4' || $data['admin_user_level']=='6')
			{
				//$this->session->set_userdata('chat_username','Counselor_break_1212111_12121'); // Must be already set
				$ga = new GoogleAnalytics();
				$this->googleanalytics->setProfile('ga:60386809');
				$this->googleanalytics->setDateRange(date('Y-m-d',strtotime('30 day ago')),date('Y-m-d',strtotime('1 day ago')));
				$data['report'] = $this->googleanalytics->getReport(array('dimensions'=>urlencode('ga:date'),'metrics'=>urlencode('ga:pageviews,ga:visitors')));
				// for($i = 1; $i <=31; $i++) 
				// {    
					// $lead_created_time=date("Y-m-d", strtotime('-'. $i .' days'));
					// $data['no_of_registerd_user'][$i]=$this->dashboard->count_lead_data_by_date($lead_created_time);
				// } 
				$data['event_users']=$this->dashboard->latest_event_users();
				$data['latest_users']=$this->dashboard->latest_users();
				$data['ten_question']=$this->dashboard->ten_question();	
				$this->load->view('univadmin/admin_dash', $data);
			}
		}
	}
  
	function adminlogin()
	{
		$data = $this->path->all_path();
		if ($this->tank_auth->is_admin_logged_in()) {									// logged in
			redirect('admin');

		}  else {
			$data['login_by_username'] = ($this->config->item('login_by_username', 'tank_auth') AND
					$this->config->item('use_username', 'tank_auth'));
			$data['login_by_email'] = $this->config->item('login_by_email', 'tank_auth');

			$this->form_validation->set_rules('login', 'Login', 'trim|required|xss_clean');
			$this->form_validation->set_rules('password', 'Password', 'trim|required|xss_clean');
			$this->form_validation->set_rules('remember', 'Remember me', 'integer');
			$this->form_validation->set_rules('user_type', 'user_type', 'string');

			// Get login for counting attempts to login
			if ($this->config->item('login_count_attempts', 'tank_auth') AND
					($login = $this->input->post('login'))) {
				$login = $this->security->xss_clean($login);
			} else {
				$login = '';
			}

			$data['errors'] = array();

			if ($this->form_validation->run()) {								// validation ok
				if ($this->tank_auth->login(
						$this->form_validation->set_value('login'),
						$this->form_validation->set_value('password'),
						$this->form_validation->set_value('remember'),
						$data['login_by_username'],
						$data['login_by_email'],
						$this->form_validation->set_value('user_type')
						)) {								// success
					redirect('/admin/');
				} else {
					$errors = $this->tank_auth->get_error_message();
					if (isset($errors['banned'])) {								// banned user
						$this->_show_message($this->lang->line('auth_message_banned').' '.$errors['banned']);

					} elseif (isset($errors['not_activated'])) {				// not activated user
						redirect('/auth/send_again/');

					} else {													// fail
						foreach ($errors as $k => $v)	{
						$data['errors'][$k] = $this->lang->line($v);
						}
						
					}
				}
			}
			
		}
		$this->load->view('admin/backend',$data);
	}

	function adminlogout()
	{
		$this->tank_auth->adminlogout();
		redirect('admin');
		
	}

	function adduser()
	{
	if (!$this->tank_auth->is_admin_logged_in()) {
			redirect('admin/adminlogin/');
		}
	else {
	$data = $this->path->all_path();
	
	$data['user_id']	= $this->tank_auth->get_admin_user_id();
	$data['admin_user_level']=$this->tank_auth->get_admin_user_level();
	$data['admin_priv']=$this->adminmodel->get_user_privilege($data['user_id']);
	if(!($data['admin_priv']))
		{
			redirect('admin/adminlogout');
		}
	$this->load->view('admin/header',$data);
	$this->load->view('admin/sidebar',$data);
	$use_username = $this->config->item('use_username', 'tank_auth');
			if ($use_username) {
				$this->form_validation->set_rules('username', 'Username', 'trim|required|xss_clean|min_length['.$this->config->item('username_min_length', 'tank_auth').']|max_length['.$this->config->item('username_max_length', 'tank_auth').']|alpha_dash');
			}
			$this->form_validation->set_rules('fullname', 'Fullname', 'trim|required|xss_clean');
			$this->form_validation->set_rules('createdby', 'Createdby', 'trim');
			$this->form_validation->set_rules('email', 'Email', 'trim|required|xss_clean|valid_email|is_unique[users.email]');
			$this->form_validation->set_rules('password', 'Password', 'trim|required|xss_clean|min_length['.$this->config->item('password_min_length', 'tank_auth').']|max_length['.$this->config->item('password_max_length', 'tank_auth').']|alpha_dash');
			$this->form_validation->set_rules('confirm_password', 'Confirm Password', 'trim|required|xss_clean|matches[password]');
			$this->form_validation->set_rules('user_type', 'user_type', 'trim|string');
			$this->form_validation->set_rules('level_user', 'User Roll', 'trim|required|string');
			$data['errors'] = array();

			$email_activation = $this->config->item('email_activation', 'tank_auth');

			if ($this->form_validation->run()) {								// validation ok
				if (!is_null($data1 = $this->tank_auth->create_user(
						$use_username ? $this->form_validation->set_value('username') : '',
						$this->form_validation->set_value('fullname'),
						$this->form_validation->set_value('createdby'),
						$this->form_validation->set_value('level_user'),
						$this->form_validation->set_value('email'),
						$this->form_validation->set_value('password'),
						$this->form_validation->set_value('user_type'),
						$email_activation
						))) {									// success

					$data['site_name'] = $this->config->item('website_name', 'tank_auth');

					
				} else {
					$errors = $this->tank_auth->get_error_message();
					foreach ($errors as $k => $v)	$data['errors'][$k] = $this->lang->line($v);
				}
			
			
			
			//$this->load->view('auth/adduser', $data);
		}
	$add_user_priv=array('4','6','8','10');
	$flag=0;
	foreach($data['admin_priv'] as $userdata['admin_priv']){
	if($userdata['admin_priv']['privilege_type_id']==1 && in_array($userdata['admin_priv']['privilege_level'],$add_user_priv) )
	{
	$this->load->view('admin/adduser', $data);
	$flag=1;
	break;
	}
	}
	if($flag==0)
	{
	$this->load->view('admin/accesserror', $data);
	}
	}
	
	
	}

	/**
	 * Send activation email again, to the same or new email address
	 *
	 * @return void
	 */
	function send_again()
	{
		if (!$this->tank_auth->is_admin_logged_in(FALSE)) {							// not logged in or activated
			redirect('/login/');

		} else {
			$this->form_validation->set_rules('email', 'Email', 'trim|required|xss_clean|valid_email');

			$data['errors'] = array();

			if ($this->form_validation->run()) {								// validation ok
				if (!is_null($data = $this->tank_auth->change_email(
						$this->form_validation->set_value('email')))) {			// success

					$data['site_name']	= $this->config->item('website_name', 'tank_auth');
					$data['activation_period'] = $this->config->item('email_activation_expire', 'tank_auth') / 3600;

					$this->_send_email('activate', $data['email'], $data);

					$this->_show_message(sprintf($this->lang->line('auth_message_activation_email_sent'), $data['email']));

				} else {
					$errors = $this->tank_auth->get_error_message();
					foreach ($errors as $k => $v)	$data['errors'][$k] = $this->lang->line($v);
				}
			}
			$this->load->view('auth/send_again_form', $data);
		}
	}

	/**
	 * Activate user account.
	 * User is verified by user_id and authentication code in the URL.
	 * Can be called by clicking on link in mail.
	 *
	 * @return void
	 */
	function activate()
	{
		$user_id		= $this->uri->segment(3);
		$new_email_key	= $this->uri->segment(4);

		// Activate user
		if ($this->tank_auth->activate_user($user_id, $new_email_key)) {		// success
			$this->tank_auth->logout();
			$this->_show_message($this->lang->line('auth_message_activation_completed').' '.anchor('/auth/login/', 'Login'));

		} else {																// fail
			$this->_show_message($this->lang->line('auth_message_activation_failed'));
		}
	}

	/**
	 * Generate reset code (to change password) and send it to user
	 *
	 * @return void
	 */
	function forgot_password()
	{
		if ($this->tank_auth->is_admin_logged_in()) {									// logged in
			redirect('');

		} elseif ($this->tank_auth->is_admin_logged_in(FALSE)) {						// logged in, not activated
			redirect('/send_again/');

		} else {
			$this->form_validation->set_rules('login', 'Email or login', 'trim|required|xss_clean');

			$data['errors'] = array();

			if ($this->form_validation->run()) {								// validation ok
				if (!is_null($data = $this->tank_auth->forgot_password(
						$this->form_validation->set_value('login')))) {

					$data['site_name'] = $this->config->item('website_name', 'tank_auth');

					// Send email with password activation link
					$this->_send_email('forgot_password', $data['email'], $data);

					$this->_show_message($this->lang->line('auth_message_new_password_sent'));

				} else {
					$errors = $this->tank_auth->get_error_message();
					foreach ($errors as $k => $v)	$data['errors'][$k] = $this->lang->line($v);
				}
			}
			$this->load->view('auth/forgot_password_form', $data);
		}
	}

	/**
	 * Replace user password (forgotten) with a new one (set by user).
	 * User is verified by user_id and authentication code in the URL.
	 * Can be called by clicking on link in mail.
	 *
	 * @return void
	 */
	function reset_password()
	{
		$user_id		= $this->uri->segment(3);
		$new_pass_key	= $this->uri->segment(4);

		$this->form_validation->set_rules('new_password', 'New Password', 'trim|required|xss_clean|min_length['.$this->config->item('password_min_length', 'tank_auth').']|max_length['.$this->config->item('password_max_length', 'tank_auth').']|alpha_dash');
		$this->form_validation->set_rules('confirm_new_password', 'Confirm new Password', 'trim|required|xss_clean|matches[new_password]');

		$data['errors'] = array();

		if ($this->form_validation->run()) {								// validation ok
			if (!is_null($data = $this->tank_auth->reset_password(
					$user_id, $new_pass_key,
					$this->form_validation->set_value('new_password')))) {	// success

				$data['site_name'] = $this->config->item('website_name', 'tank_auth');

				// Send email with new password
				$this->_send_email('reset_password', $data['email'], $data);

				$this->_show_message($this->lang->line('auth_message_new_password_activated').' '.anchor('/auth/login/', 'Login'));

			} else {														// fail
				$this->_show_message($this->lang->line('auth_message_new_password_failed'));
			}
		} else {
			// Try to activate user by password key (if not activated yet)
			if ($this->config->item('email_activation', 'tank_auth')) {
				$this->tank_auth->activate_user($user_id, $new_pass_key, FALSE);
			}

			if (!$this->tank_auth->can_reset_password($user_id, $new_pass_key)) {
				$this->_show_message($this->lang->line('auth_message_new_password_failed'));
			}
		}
		$this->load->view('auth/reset_password_form', $data);
	}

	/**
	 * Change user password
	 *
	 * @return void
	 */
	function change_password()
	{
		if (!$this->tank_auth->is_admin_logged_in()) {								// not logged in or not activated
			redirect('/login/');

		} else {
			$this->form_validation->set_rules('old_password', 'Old Password', 'trim|required|xss_clean');
			$this->form_validation->set_rules('new_password', 'New Password', 'trim|required|xss_clean|min_length['.$this->config->item('password_min_length', 'tank_auth').']|max_length['.$this->config->item('password_max_length', 'tank_auth').']|alpha_dash');
			$this->form_validation->set_rules('confirm_new_password', 'Confirm new Password', 'trim|required|xss_clean|matches[new_password]');

			$data['errors'] = array();

			if ($this->form_validation->run()) {								// validation ok
				if ($this->tank_auth->change_password(
						$this->form_validation->set_value('old_password'),
						$this->form_validation->set_value('new_password'))) {	// success
					$this->_show_message($this->lang->line('auth_message_password_changed'));

				} else {														// fail
					$errors = $this->tank_auth->get_error_message();
					foreach ($errors as $k => $v)	$data['errors'][$k] = $this->lang->line($v);
				}
			}
			$this->load->view('auth/change_password_form', $data);
		}
	}

	/**
	 * Change user email
	 *
	 * @return void
	 */
	function change_email()
	{
		if (!$this->tank_auth->is_admin_logged_in()) {								// not logged in or not activated
			redirect('/login/');

		} else {
			$this->form_validation->set_rules('password', 'Password', 'trim|required|xss_clean');
			$this->form_validation->set_rules('email', 'Email', 'trim|required|xss_clean|valid_email');

			$data['errors'] = array();

			if ($this->form_validation->run()) {								// validation ok
				if (!is_null($data = $this->tank_auth->set_new_email(
						$this->form_validation->set_value('email'),
						$this->form_validation->set_value('password')))) {			// success

					$data['site_name'] = $this->config->item('website_name', 'tank_auth');

					// Send email with new email address and its activation link
					$this->_send_email('change_email', $data['new_email'], $data);

					$this->_show_message(sprintf($this->lang->line('auth_message_new_email_sent'), $data['new_email']));

				} else {
					$errors = $this->tank_auth->get_error_message();
					foreach ($errors as $k => $v)	$data['errors'][$k] = $this->lang->line($v);
				}
			}
			$this->load->view('auth/change_email_form', $data);
		}
	}

	/**
	 * Replace user email with a new one.
	 * User is verified by user_id and authentication code in the URL.
	 * Can be called by clicking on link in mail.
	 *
	 * @return void
	 */
	function reset_email()
	{
		$user_id		= $this->uri->segment(3);
		$new_email_key	= $this->uri->segment(4);

		// Reset email
		if ($this->tank_auth->activate_new_email($user_id, $new_email_key)) {	// success
			$this->tank_auth->logout();
			$this->_show_message($this->lang->line('auth_message_new_email_activated').' '.anchor('/auth/login/', 'Login'));

		} else {																// fail
			$this->_show_message($this->lang->line('auth_message_new_email_failed'));
		}
	}

	/**
	 * Delete user from the site (only when user is logged in)
	 *
	 * @return void
	 */
	function unregister()
	{
		if (!$this->tank_auth->is_admin_logged_in()) {								// not logged in or not activated
			redirect('/login/');

		} else {
			$this->form_validation->set_rules('password', 'Password', 'trim|required|xss_clean');

			$data['errors'] = array();

			if ($this->form_validation->run()) {								// validation ok
				if ($this->tank_auth->delete_user(
						$this->form_validation->set_value('password'))) {		// success
					$this->_show_message($this->lang->line('auth_message_unregistered'));

				} else {														// fail
					$errors = $this->tank_auth->get_error_message();
					foreach ($errors as $k => $v)	$data['errors'][$k] = $this->lang->line($v);
				}
			}
			$this->load->view('auth/unregister_form', $data);
		}
	}

	/**
	 * Show info message
	 *
	 * @param	string
	 * @return	void
	 */
	function _show_message($message)
	{
		$this->session->set_flashdata('message', $message);
		redirect('/auth/');
	}

	/**
	 * Send email message of given type (activate, forgot_password, etc.)
	 *
	 * @param	string
	 * @param	string
	 * @param	array
	 * @return	void
	 */
	function _send_email($type, $email, &$data)
	{
		$this->load->library('email');
		$this->email->from($this->config->item('webmaster_email', 'tank_auth'), $this->config->item('website_name', 'tank_auth'));
		$this->email->reply_to($this->config->item('webmaster_email', 'tank_auth'), $this->config->item('website_name', 'tank_auth'));
		$this->email->to($email);
		$this->email->subject(sprintf($this->lang->line('auth_subject_'.$type), $this->config->item('website_name', 'tank_auth')));
		$this->email->message($this->load->view('email/'.$type.'-html', $data, TRUE));
		$this->email->set_alt_message($this->load->view('email/'.$type.'-txt', $data, TRUE));
		$this->email->send();
	}

	/**
	 * Create CAPTCHA image to verify user as a human
	 *
	 * @return	string
	 */
	function _create_captcha()
	{
		$this->load->helper('captcha');

		$cap = create_captcha(array(
			'img_path'		=> './'.$this->config->item('captcha_path', 'tank_auth'),
			'img_url'		=> base_url().$this->config->item('captcha_path', 'tank_auth'),
			'font_path'		=> './'.$this->config->item('captcha_fonts_path', 'tank_auth'),
			'font_size'		=> $this->config->item('captcha_font_size', 'tank_auth'),
			'img_width'		=> $this->config->item('captcha_width', 'tank_auth'),
			'img_height'	=> $this->config->item('captcha_height', 'tank_auth'),
			'show_grid'		=> $this->config->item('captcha_grid', 'tank_auth'),
			'expiration'	=> $this->config->item('captcha_expire', 'tank_auth'),
		));

		// Save captcha params in session
		$this->session->set_flashdata(array(
				'captcha_word' => $cap['word'],
				'captcha_time' => $cap['time'],
		));

		return $cap['image'];
	}

	/**
	 * Callback function. Check if CAPTCHA test is passed.
	 *
	 * @param	string
	 * @return	bool
	 */
	function _check_captcha($code)
	{
		$time = $this->session->flashdata('captcha_time');
		$word = $this->session->flashdata('captcha_word');

		list($usec, $sec) = explode(" ", microtime());
		$now = ((float)$usec + (float)$sec);

		if ($now - $time > $this->config->item('captcha_expire', 'tank_auth')) {
			$this->form_validation->set_message('_check_captcha', $this->lang->line('auth_captcha_expired'));
			return FALSE;

		} elseif (($this->config->item('captcha_case_sensitive', 'tank_auth') AND
				$code != $word) OR
				strtolower($code) != strtolower($word)) {
			$this->form_validation->set_message('_check_captcha', $this->lang->line('auth_incorrect_captcha'));
			return FALSE;
		}
		return TRUE;
	}

	/**
	 * Create reCAPTCHA JS and non-JS HTML to verify user as a human
	 *
	 * @return	string
	 */
	function _create_recaptcha()
	{
		$this->load->helper('recaptcha');

		// Add custom theme so we can get only image
		$options = "<script>var RecaptchaOptions = {theme: 'custom', custom_theme_widget: 'recaptcha_widget'};</script>\n";

		// Get reCAPTCHA JS and non-JS HTML
		$html = recaptcha_get_html($this->config->item('recaptcha_public_key', 'tank_auth'));

		return $options.$html;
	}

	/**
	 * Callback function. Check if reCAPTCHA test is passed.
	 *
	 * @return	bool
	 */
	function _check_recaptcha()
	{
		$this->load->helper('recaptcha');

		$resp = recaptcha_check_answer($this->config->item('recaptcha_private_key', 'tank_auth'),
				$_SERVER['REMOTE_ADDR'],
				$_POST['recaptcha_challenge_field'],
				$_POST['recaptcha_response_field']);

		if (!$resp->is_valid) {
			$this->form_validation->set_message('_check_recaptcha', $this->lang->line('auth_incorrect_captcha'));
			return FALSE;
		}
		return TRUE;
	}
	
	/* add new user function by super admin */
	/*function adduser()
	{
		$data = $this->path->all_path();
		//$this->load->view('auth/header',$data);
		//$this->load->view('auth/footer',$data);
		if (!$this->tank_auth->is_admin_logged_in()) {
			redirect('admin/adminlogin/');
		} else {
			$data['user_id']	= $this->tank_auth->get_user_id();
			$data['username']	= $this->tank_auth->get_username();
			$this->load->view('admin/header', $data);
			$this->load->view('admin/sidebar', $data);	
			$this->load->view('admin/adduser', $data);
			
		}
	}*/
	
	function user_privileges()
	{
		if (!$this->tank_auth->is_admin_logged_in()) {
			redirect('admin/adminlogin/');
		}
		else
		{
		
		
		$nadminid=$this->tank_auth->get_newadmin_inprocess();
		if($nadminid=='1')
		{
		
		$data = $this->path->all_path();
		$data['results'] = $this->adminmodel->userprivlegetype();
		$data['new_user_level']=$this->tank_auth->get_newadmin_user_level();
		$data['user_id']	= $this->tank_auth->get_admin_user_id();
		$data['admin_user_level']=$this->tank_auth->get_admin_user_level();
		$data['admin_priv']=$this->adminmodel->get_user_privilege($data['user_id']);
		if(!($data['admin_priv']))
		{
			redirect('admin/adminlogout');
		}
		$this->load->view('admin/header',$data);
		$this->load->view('admin/sidebar',$data);
		$this->load->view('admin/user_privilege',$data);
		}
		else
		{
		redirect('admin/adduser/');
		}
		
		}
	}
	
	
	function usercreated()
	{
		if (!$this->tank_auth->is_admin_logged_in()) {
			redirect('admin/adminlogin/');
		}
		else{
		
			$email_activation = $this->config->item('email_activation', 'tank_auth');
		//insert data in user and profile table
		if($this->tank_auth->get_newadmin_inprocess())
		{
			if (!is_null($newadminid = $this->tank_auth->create_admin_user(
						$email_activation))) {									// success
					$data['site_name'] = $this->config->item('website_name', 'tank_auth');	
				}
		
		
		$data = $this->path->all_path();
		
		$admin_level=$this->session->userdata('newadmin_level');
		if(!($admin_level==1 || $admin_level==6 || $admin_level==2))
		{
		 $this->adminmodel->insert_userprivlege_data($newadminid);
		}
		$this->tank_auth->delete_newadmin_sessiondata();
		redirect('admin/manageusers/ucs');
	//	print_r($data);
		/*$data['user_id']	= $this->tank_auth->get_admin_user_id();
		$data['admin_user_level']=$this->tank_auth->get_admin_user_level();
		$data['admin_priv']=$this->adminmodel->get_user_privilege($data['user_id']);
		$this->load->view('admin/header',$data);
		$this->load->view('admin/sidebar',$data);
		$this->load->view('admin/usersuccess',$data);*/
		}
		else
		{
			redirect('admin/adduser');
		}
		}
			
	}
	
	//function for show users
	function manageusers($ups='',$paging='')
	{
		if (!$this->tank_auth->is_admin_logged_in()) {
			redirect('admin/adminlogin/');
		}
		else{
		$data = $this->path->all_path();
		$data['user_id']	= $this->tank_auth->get_admin_user_id();
		$data['admin_user_level']=$this->tank_auth->get_admin_user_level();
		$data['admin_priv']=$this->adminmodel->get_user_privilege($data['user_id']);
		if(!($data['admin_priv']))
		{
			redirect('admin/adminlogout');
		}
		$data['no_of_users']=$this->adminmodel->get_user_info();
		if($this->input->post('ajax')!=1)
		{
			$this->load->view('admin/header',$data);
			$this->load->view('admin/sidebar',$data);
		}
		$data['user_detail']= $this->adminmodel->fetch_user_data($paging);
		$flag=0;
		foreach($data['admin_priv'] as $userdata['admin_priv']){
		if($userdata['admin_priv']['privilege_type_id']==1 && $userdata['admin_priv']['privilege_level']!=0)
		{
		if($ups=='ups')
		{
		$data['msg']='User Updated Successfully';
		$this->load->view('admin/userupdated',$data);
		}
		else if($ups=='uds')
		{
		$data['msg']='User Deleted Successfully';
		$this->load->view('admin/userupdated',$data);
		}
		else if($ups=='ucs')
		{
		$data['msg']='User Created Successfully';
		$this->load->view('admin/userupdated',$data);
		}
		else if($ups=='ban')
		{
		$data['msg']='Selected User Ban Successfully';
		$this->load->view('admin/userupdated',$data);
		}
		else if($ups=='unban')
		{
		$data['msg']='Selected User Unban Successfully';
		$this->load->view('admin/userupdated',$data);
		}
		$data['level']='';
		$data['level']=$this->input->post('level');
		$data['toSearch']='';
		$data['toSearch']=$this->input->post('toSearch');
		$data['banned']='';
		$data['banned']=$this->input->post('banned');
		$this->load->view('admin/manageuser',$data);
		$flag=1;
		break;
		}
		}
		if($flag==0)
		{
		$this->load->view('admin/accesserror',$data);
		}
	  }
	}
	
	
	function user_detail($id,$level)
	{
		if (!$this->tank_auth->is_admin_logged_in()) {
			redirect('admin/adminlogin/');
		}
		else{
		$data = $this->path->all_path();
		$data['user_id']	= $this->tank_auth->get_admin_user_id();
		$data['admin_user_level']=$this->tank_auth->get_admin_user_level();
		$data['admin_priv']=$this->adminmodel->get_user_privilege($data['user_id']);
		if(!($data['admin_priv']))
		{
			redirect('admin/adminlogout');
		}
		$this->load->view('admin/header',$data);
		$this->load->view('admin/sidebar',$data);
		$data['user_detail_edit'] = $this->adminmodel->fetch_data_edit($id);
		//fetch all privilege type 
		$this->form_validation->set_rules('fullname', 'Fullname', 'trim|required|xss_clean');
		//$this->form_validation->set_rules('email', 'Email', 'trim|required|xss_clean|valid_email');
		$flag=0;
		foreach($data['admin_priv'] as $userdata['admin_priv']){
		if($userdata['admin_priv']['privilege_type_id']==1 && $userdata['admin_priv']['privilege_level']>0 && $level!='5' )
		{
		$flag=1;
		break;
		}
		}
		if($flag==0)
		{
		$this->load->view('admin/accesserror', $data);
		}
		else
		{
		$this->load->view('admin/userdetails', $data);
		}
		}
	}
	
	
	/*function edituser()
	{
		if (!$this->tank_auth->is_admin_logged_in()) {
			redirect('admin/adminlogin/');
		}
		else{
		$data['admin_user_level']=$this->tank_auth->get_admin_user_level();
			
		
		}
		
	
	}*/
	
	function edituser($id='',$level)
	{
		if (!$this->tank_auth->is_admin_logged_in()) {
			redirect('admin/adminlogin/');
		}
		else{
		$data = $this->path->all_path();
		$data['user_id']	= $this->tank_auth->get_admin_user_id();
		$data['admin_user_level']=$this->tank_auth->get_admin_user_level();
		$data['admin_priv']=$this->adminmodel->get_user_privilege($data['user_id']);
		if(!($data['admin_priv']))
		{
			redirect('admin/adminlogout');
		}
		$data['current_user_priv']=$this->adminmodel->get_user_privilege($id);
		$this->load->view('admin/header',$data);
		$this->load->view('admin/sidebar',$data);
		$data['user_detail_edit'] = $this->adminmodel->fetch_data_edit($id);
		//fetch all privilege type 
		$data['results'] = $this->adminmodel->userprivlegetype();
		$this->form_validation->set_rules('fullname', 'Fullname', 'trim|required|xss_clean');
		//$this->form_validation->set_rules('email', 'Email', 'trim|required|xss_clean|valid_email');
		if ($this->form_validation->run()) {
		$this->adminmodel->edit_user_data();
		redirect('admin/manageusers/ups');
		}
		$edit_user_priv=array('3','6','7','10');
		$flag=0;
		foreach($data['admin_priv'] as $userdata['admin_priv']){
		if($userdata['admin_priv']['privilege_type_id']==1 && in_array($userdata['admin_priv']['privilege_level'],$edit_user_priv) && $id!=$data['user_id'] && $level!='5' )
		{
		$this->load->view('admin/edituser', $data);
		$flag=1;
		break;
		}
		}
		if($flag==0)
		{
		$this->load->view('admin/accesserror', $data);
		}
		//$send_id = '123';
		}
	}
	function update_user_detail()
	{
			
		$this->load->view('admin/edituser',$data);
		
		//$this->adminmodel->edit_user_profile_data(); 
		
	}
	
	//call back function for unique email when updating
	function update_unique_email($email)
	{
		$data['admin_priv']=$this->adminmodel->check_unique_email($email);
	}
	function userupdated()
	{
		if (!$this->tank_auth->is_admin_logged_in()) {
			redirect('admin/adminlogin/');
		}
		else{
		$data = $this->path->all_path();
		$data['user_id']	= $this->tank_auth->get_admin_user_id();
		$data['admin_user_level']=$this->tank_auth->get_admin_user_level();
		$data['admin_priv']=$this->adminmodel->get_user_privilege($data['user_id']);
		if(!($data['admin_priv']))
		{
			redirect('admin/adminlogout');
		}
		$this->load->view('admin/header',$data);
		$this->load->view('admin/sidebar',$data);
		$this->load->view('admin/userupdated',$data);
		}
	}
	
	function deleteuser()
	{
		if (!$this->tank_auth->is_admin_logged_in()) {
			redirect('admin/adminlogin/');
		}
		else{
		$data = $this->path->all_path();
		$data['user_id']	= $this->tank_auth->get_admin_user_id();
		$data['admin_user_level']=$this->tank_auth->get_admin_user_level();
		$data['admin_priv']=$this->adminmodel->get_user_privilege($data['user_id']);
		if(!($data['admin_priv']))
		{
			redirect('admin/adminlogout');
		}
		$this->load->view('admin/header',$data);
		$this->load->view('admin/sidebar',$data);
		$delete_user_priv=array('5','7','8','10');
		$flag=0;
		foreach($data['admin_priv'] as $userdata['admin_priv']){
		if($userdata['admin_priv']['privilege_type_id']==1 && in_array($userdata['admin_priv']['privilege_level'],$delete_user_priv))
		{
		$data['msg']='User Delted Successfully';
		$this->load->view('admin/userupdated', $data);
		$flag=1;
		break;
		}
		}
		if($flag==0)
		{
		$this->load->view('admin/accesserror', $data);
		}
		else if($flag==1)
		{
		$cc=$this->adminmodel->deleteuser();
		redirect('admin/manageusers/uds');
		}
		}	
	}
	
	function delete_single_user($id='',$level='')
	{
		if (!$this->tank_auth->is_admin_logged_in()) {
			redirect('admin/adminlogin/');
		}
		else{	
		$data = $this->path->all_path();
		$data['user_id']	= $this->tank_auth->get_admin_user_id();
		$data['admin_user_level']=$this->tank_auth->get_admin_user_level();
		$data['admin_priv']=$this->adminmodel->get_user_privilege($data['user_id']);
		if(!($data['admin_priv']))
		{
			redirect('admin/adminlogout');
		}
		$this->load->view('admin/header',$data);
		$this->load->view('admin/sidebar',$data);
		$delete_user_priv=array('5','7','8','10');
		$flag=0;
		foreach($data['admin_priv'] as $userdata['admin_priv']){
		if($userdata['admin_priv']['privilege_type_id']==1 && in_array($userdata['admin_priv']['privilege_level'],$delete_user_priv )&& $data['user_id']!=$id && $level!=5)
		{
		$flag=1;
		break;
		}
		}
		if($flag==0)
		{
		$this->load->view('admin/accesserror', $data);
		}
		else if($flag==1)
		{
		$this->adminmodel->delete_single_user($id,$level);
		redirect('admin/manageusers/uds');
		}
	  }
	}
	
	
	
	
	
	function home_gallery()
	{
		if (!$this->tank_auth->is_admin_logged_in()) {
			redirect('admin/adminlogin/');
		}
		else{
		$data = $this->path->all_path();
		$data['user_id']	= $this->tank_auth->get_admin_user_id();
		$data['admin_user_level']=$this->tank_auth->get_admin_user_level();
		$data['admin_priv']=$this->adminmodel->get_user_privilege($data['user_id']);
		if(!($data['admin_priv']))
		{
			redirect('admin/adminlogout');
		}
		$this->load->view('admin/header',$data);
		$this->load->view('admin/sidebar',$data);
		$add_gallery_priv=array('4','6','8','10');
		$flag=0;
		foreach($data['admin_priv'] as $userdata['admin_priv']){
		if($userdata['admin_priv']['privilege_type_id']==11 && $data['admin_user_level']!='3' && in_array($userdata['admin_priv']['privilege_level'],$add_gallery_priv ) )
		{
		$flag=1;
		
		break;
		}
		}
		if($flag==0)
		{
		$this->load->view('admin/accesserror', $data);
		}
		else 
		{
		if ($this->input->post('upload')) {
		$data['x']=$this->adminmodel->do_upload();
		
		//print_r($data['x']);
		
		}
		 $this->load->view('admin/home_gallery', $data);
		}
	  }
	}
	
	function manage_home_gallery($del_pic=0)
	{
		if (!$this->tank_auth->is_admin_logged_in()) {
			redirect('admin/adminlogin/');
		}
		else{
		$data = $this->path->all_path();
		$data['user_id']	= $this->tank_auth->get_admin_user_id();
		$data['admin_user_level']=$this->tank_auth->get_admin_user_level();
		$data['admin_priv']=$this->adminmodel->get_user_privilege($data['user_id']);
		if(!($data['admin_priv']))
		{
			redirect('admin/adminlogout');
		}
		$this->load->view('admin/header',$data);
		$this->load->view('admin/sidebar',$data);
		$flag=0;
		$delete=0;
		foreach($data['admin_priv'] as $userdata['admin_priv']){
		if($userdata['admin_priv']['privilege_type_id']==11 && $userdata['admin_priv']['privilege_level']!=0 && $data['admin_user_level']!=3)
		{
		$delete_gallery_pic=array('5','7','8','10');
		if(in_array($userdata['admin_priv']['privilege_level'],$delete_gallery_pic))
		{
		$delete=1;
		}
		$flag=1;
		}
		}
		if($flag==0)
		{
		$this->load->view('admin/accesserror', $data);
		}
		else if($flag==1)
		{
		if ($this->input->post('update')) {
		$this->adminmodel->update_gallery();
		$data['msg']="Gallery Updated successfully";
		$this->load->view('admin/userupdated', $data);
		}
		if($delete==1 && $del_pic!=0 && $del_pic!='' && $del_pic!=NULL)
		{
			$this->adminmodel->delete_gallery_pic($del_pic);
			$data['msg']="Gallery Image Deleted successfully";
			$this->load->view('admin/userupdated', $data);
		
		}
		$data['gallery']=$this->adminmodel->get_gallery_info();
		$this->load->view('admin/manage_gallery', $data);
		
		}
		}	
	}
	
	function create_university()
	{
		if (!$this->tank_auth->is_admin_logged_in()) {
			redirect('admin/adminlogin/');
		}
		else{
		$data = $this->path->all_path();
		$data['user_id']	= $this->tank_auth->get_admin_user_id();
		$data['admin_user_level']=$this->tank_auth->get_admin_user_level();
		$data['admin_priv']=$this->adminmodel->get_user_privilege($data['user_id']);
		if(!($data['admin_priv']))
		{
			redirect('admin/adminlogout');
		}
		$data['results'] = $this->adminmodel->userprivlegetype();
		$this->load->view('admin/header',$data);
		$this->load->view('admin/sidebar',$data);
		if($this->input->post('submit'))
		{
		$this->form_validation->set_rules('univ_name', 'University', 'trim|required|is_unique[university.univ_name]');
		$this->form_validation->set_rules('address1', 'Addrss Line1', 'trim|xss_clean');
		$this->form_validation->set_rules('phone_no', 'phone no', 'trim|xss_clean');
		$this->form_validation->set_rules('contact_us', 'Contact Us', 'trim|xss_clean');
		$this->form_validation->set_rules('salient_features', 'Salient Features', 'trim|xss_clean');
		$this->form_validation->set_rules('title', 'Title', 'trim|xss_clean');
		$this->form_validation->set_rules('keyword', 'Keyword', 'trim|xss_clean');
		$this->form_validation->set_rules('description', 'Description', 'trim|xss_clean');
		$this->form_validation->set_rules('latitude', 'Latitude', 'trim|xss_clean');
		$this->form_validation->set_rules('longitude', 'Longitude', 'trim|xss_clean');
		$this->form_validation->set_rules('fax_address', 'Fax Address', 'trim|xss_clean');
		$this->form_validation->set_rules('univ_email', 'university email', 'trim|xss_clean|valid_email');
		$this->form_validation->set_rules('web_address', 'Web Address', 'trim|xss_clean');
		$this->form_validation->set_rules('sub_domain', 'Sub Domain', 'xss_clean|alpha_dash|trim|required|string|is_unique[university.subdomain_name]|max_length[50]');
		if ($this->form_validation->run()) {
		$data['x']=$this->adminmodel->create_univ();
		//print_r($data['x']);
		//$this->adminmodel->edit_user_data();
		//redirect('admin/manageusers/ups');
		}
		}
		$create_univ=array('4','6','8','10');
		$flag=0;
		foreach($data['admin_priv'] as $userdata['admin_priv']){
		if($userdata['admin_priv']['privilege_type_id']==5 && in_array($userdata['admin_priv']['privilege_level'],$create_univ) )
		{
		$flag=1;
		break;
		}
		}
		if($flag==0)
		{
		$this->load->view('admin/accesserror', $data);
		}
		else
		{
		$data['univ_admins']=$this->adminmodel->get_univ_admin();
		$data['countries']=$this->users->fetch_country();
		$this->load->view('admin/add_university', $data);
		}
		
		}
	
	}
	
	function add_country_ajax()
	{
	if (!$this->tank_auth->is_admin_logged_in()) {
			redirect('admin/adminlogin/');
		}
	else {
	$data['result']=$this->adminmodel->enterplacelevel1();
	$this->load->view('ajaxviews/check_unique_field', $data);	
	}
	}
	function add_state_ajax()
	{if (!$this->tank_auth->is_admin_logged_in()) {
			redirect('admin/adminlogin/');
		}
	else {
	$data['result']=$this->adminmodel->enterplacelevel2();
	$this->load->view('ajaxviews/check_unique_field', $data);	
		}
	}
	function add_city_ajax()
	{
	if (!$this->tank_auth->is_admin_logged_in()) {
			redirect('admin/adminlogin/');
		}
	else {	
	$data['result']=$this->adminmodel->enterplacelevel3();
	$this->load->view('ajaxviews/check_unique_field', $data);
	}	
	}

	function country_list_ajax($scid='0')
	{
		if (!$this->tank_auth->is_admin_logged_in()) {
			redirect('admin/adminlogin/');
		}
		else {
		$data['region']=$this->users->fetch_country();
		$data['scid']=$this->input->post('country_id');
		$this->load->view('ajaxviews/country_ajax',$data);
		}
	}
	function state_list_ajax()
	{
		if (!$this->tank_auth->is_admin_logged_in()) {
			redirect('admin/adminlogin/');
		}
		else {
		$cid=$this->input->post('country_id');
		$data['region']=$this->adminmodel->fetch_states($cid);
		$data['ssid']=$this->input->post('sel_state_id');
		$this->load->view('ajaxviews/state_ajax',$data);
		}
	}
	function city_list_ajax()
	{	
		if (!$this->tank_auth->is_admin_logged_in()) {
			redirect('admin/adminlogin/');
		}
		else {
		$sid=$this->input->post('state_id');
		$data['region']=$this->adminmodel->fetch_city($sid);
		$data['scid']=$this->input->post('sel_city_id');
		$this->load->view('ajaxviews/city_ajax',$data);
		}
	}
	
	function state_check()
	{
		if (!$this->tank_auth->is_admin_logged_in()) {
			redirect('admin/adminlogin/');
		}
		else {
		$data['result']=$this->adminmodel->state_chk_in_country($this->input->post('country_model1'),$this->input->post('state_model1'));
		$this->load->view('ajaxviews/check_unique_field', $data);
		}
	}
	
	function city_check()
	{
		$data['result']=$this->adminmodel->city_chk_in_state($this->input->post('state_model2'),$this->input->post('city_model2'));
		$this->load->view('ajaxviews/check_unique_field', $data);
	}
	
function manage_university($mps='')
 {
  if (!$this->tank_auth->is_admin_logged_in()) 
  {
	  redirect('admin/adminlogin/');
  }
  else
  {
	  $data = $this->path->all_path();
	  $data['user_id'] = $this->tank_auth->get_admin_user_id();
	  $data['admin_user_level']=$this->tank_auth->get_admin_user_level();
	  $data['admin_priv']=$this->adminmodel->get_user_privilege($data['user_id']);
	  if(!($data['admin_priv']))
	  {
		redirect('admin/adminlogout');
	  }
	  if($this->input->post('ajax')!='1')
	  {
		  $this->load->view('admin/header',$data);
		  $this->load->view('admin/sidebar',$data);
	  }
	  $flag=0;
	  foreach($data['admin_priv'] as $userdata['admin_priv'])
	  {
		  if($userdata['admin_priv']['privilege_type_id']==5 && $userdata['admin_priv']['privilege_level']!=0)
		  {
			  $flag=1;
			  break;
		  }
	  }
	  if($mps=='ban')
	  {
		  $data['msg']='Selected University Ban Successfully';
		  $this->load->view('admin/userupdated',$data);
	  }
	  else if($mps=='unban')
	  {
		  $data['msg']='Selected University Unban Successfully';
		  $this->load->view('admin/userupdated',$data);
	  }
	  else if($mps=='uds')
	  {
		  $data['msg']='Selected University Deleted Successfully';
		  $this->load->view('admin/userupdated',$data);
	  }
	  else if($mps=='uus')
	  {
		  $data['msg']='University Updated Successfully';
		  $this->load->view('admin/userupdated',$data);
	  }
	  else if($mps=='ucs')
	  {
		  $data['msg']='University Created Successfully';
		  $this->load->view('admin/userupdated',$data);
	  }
	  else if($mps=='fh')
	  {
		  $data['msg']='University set as Home featured university Successfully';
		  $this->load->view('admin/userupdated',$data);
	  }
	  else if($mps=='ufh')
	  {
		  $data['msg']='University set as Home Unfeatured university Successfully';
		  $this->load->view('admin/userupdated',$data);
	  }
	  
	  if($flag==0)
	  {
		$this->load->view('admin/accesserror',$data);
	  }
	  else
	  {
		  if($data['admin_user_level']=='5')
		  {
			$data['univ_info']=$this->adminmodel->get_univ_info($mps);
		  }
		  else if($data['admin_user_level']=='4')
		  {
			$data['univ_info']=$this->adminmodel->get_assigned_univ_info($mps);
		  }
		  $this->load->view('admin/manage_university',$data);
	  }
	  //$data['msg']='University Created Successfully';
	  //$this->load->view('admin/userupdated',$data);
	  
	  }
 }
	//ban the user
	function ban_unban_user($ban_status,$ban_user_id,$user_level)
	{
		if (!$this->tank_auth->is_admin_logged_in()) {
			redirect('admin/adminlogin/');
		}
		else{
		$data = $this->path->all_path();
		$data['user_id']	= $this->tank_auth->get_admin_user_id();
		$data['admin_user_level']=$this->tank_auth->get_admin_user_level();
		$data['admin_priv']=$this->adminmodel->get_user_privilege($data['user_id']);
		if(!($data['admin_priv']))
		{
			redirect('admin/adminlogout');
		}
		$this->load->view('admin/header',$data);
		$this->load->view('admin/sidebar',$data);
		$flag=0;
		foreach($data['admin_priv'] as $userdata['admin_priv']){
		if($userdata['admin_priv']['privilege_type_id']==1 && $userdata['admin_priv']['privilege_level']>1 && $data['user_id']!=$ban_user_id && $user_level!='5')
		{
		$flag=1;
		break;
		}
		}
		if($flag==0)
		{
		$this->load->view('admin/accesserror', $data);
		}
		else
		{
		$this->adminmodel->ban_unban_users($ban_status,$ban_user_id,$user_level);
		if($ban_status)
		{
		redirect('admin/manageusers/unban');
		}
		else
		{
		redirect('admin/manageusers/ban');
		}
		}
	  }
	}
	
	function ban_unban_university($ban_status,$univ_id)
	{
		if (!$this->tank_auth->is_admin_logged_in()) {
			redirect('admin/adminlogin/');
		}
		else{
		$data = $this->path->all_path();
		$data['user_id']	= $this->tank_auth->get_admin_user_id();
		$data['admin_user_level']=$this->tank_auth->get_admin_user_level();
		$data['admin_priv']=$this->adminmodel->get_user_privilege($data['user_id']);
		if(!($data['admin_priv']))
		{
			redirect('admin/adminlogout');
		}
		$this->load->view('admin/header',$data);
		$this->load->view('admin/sidebar',$data);
		$flag=0;
		foreach($data['admin_priv'] as $userdata['admin_priv']){
		if($userdata['admin_priv']['privilege_type_id']==5 && $userdata['admin_priv']['privilege_level']>1)
		{
		$flag=1;
		break;
		}
		}
		if($flag==0)
		{
		$this->load->view('admin/accesserror', $data);
		}
		else
		{
		$this->adminmodel->ban_unban_university($ban_status,$univ_id);
		if($ban_status)
		{
		redirect('admin/manage_university/unban');
		}
		else
		{
		redirect('admin/manage_university/ban');
		}
		} 
	  }
	}
	
	function delete_single_university($univ_id)
	{
		if (!$this->tank_auth->is_admin_logged_in()) {
			redirect('admin/adminlogin/');
		}
		else{
		$data = $this->path->all_path();
		$data['user_id']	= $this->tank_auth->get_admin_user_id();
		$data['admin_user_level']=$this->tank_auth->get_admin_user_level();
		$data['admin_priv']=$this->adminmodel->get_user_privilege($data['user_id']);
		if(!($data['admin_priv']))
		{
			redirect('admin/adminlogout');
		}
		$this->load->view('admin/header',$data);
		$this->load->view('admin/sidebar',$data);
		$delete_user_priv=array('5','7','8','10');
		$flag=0;
		foreach($data['admin_priv'] as $userdata['admin_priv']){
		if($userdata['admin_priv']['privilege_type_id']==5 && in_array($userdata['admin_priv']['privilege_level'],$delete_user_priv ))
		{
		$flag=1;
		break;
		}
		}
		if($flag==0)
		{
		$this->load->view('admin/accesserror', $data);
		}
		else if($flag==1)
		{
		$this->adminmodel->delete_single_university($univ_id);
		redirect('admin/manage_university/uds');
		}
	  }
	}
	
	function delete_universities()
	{
		if (!$this->tank_auth->is_admin_logged_in()) {
			redirect('admin/adminlogin/');
		}
		else{
		$data = $this->path->all_path();
		$data['user_id']	= $this->tank_auth->get_admin_user_id();
		$data['admin_user_level']=$this->tank_auth->get_admin_user_level();
		$data['admin_priv']=$this->adminmodel->get_user_privilege($data['user_id']);
		if(!($data['admin_priv']))
		{
			redirect('admin/adminlogout');
		}
		$this->load->view('admin/header',$data);
		$this->load->view('admin/sidebar',$data);
		$delete_user_priv=array('5','7','8','10');
		$flag=0;
		foreach($data['admin_priv'] as $userdata['admin_priv']){
		if($userdata['admin_priv']['privilege_type_id']==5 && in_array($userdata['admin_priv']['privilege_level'],$delete_user_priv))
		{
		$flag=1;
		break;
		}
		}
		if($flag==0)
		{
		$this->load->view('admin/accesserror', $data);
		}
		else if($flag==1)
		{
		$this->adminmodel->delete_universities();
		redirect('admin/manage_university/uds');
		}
	  }
	}
	
	
	
	function update_university($univ_id='')
	{
		if (!$this->tank_auth->is_admin_logged_in()) {
			redirect('admin/adminlogin/');
		}
		else{
		$data = $this->path->all_path();
		$data['user_id']	= $this->tank_auth->get_admin_user_id();
		$data['admin_user_level']=$this->tank_auth->get_admin_user_level();
		$data['admin_priv']=$this->adminmodel->get_user_privilege($data['user_id']);
		if(!($data['admin_priv']))
		{
			redirect('admin/adminlogout');
		}
		$data['results'] = $this->adminmodel->userprivlegetype();
		$this->load->view('admin/header',$data);
		$this->load->view('admin/sidebar',$data);
		if($this->input->post('submit'))
		{
		$this->form_validation->set_rules('univ_name', 'University', 'trim|required');
		$this->form_validation->set_rules('address1', 'Addrss Line1', 'trim|xss_clean');
		$this->form_validation->set_rules('phone_no', 'phone no', 'trim|xss_clean');
		$this->form_validation->set_rules('contact_us', 'Contact Us', 'trim|xss_clean');
		$this->form_validation->set_rules('sub_domain', 'Sub Domain', 'xss_clean|alpha_dash|trim|required|string|callback_check_subdomain|max_length[50]');
		$this->form_validation->set_rules('userfile1', 'File', 'callback_check_images');
		if ($this->form_validation->run()) {
		$data['x']=$this->adminmodel->update_university($univ_id);
		//print_r($data['x']);
		//$this->adminmodel->edit_user_data();
		//redirect('admin/manageusers/ups');
		}
		}
		$edit_priv=array('3','6','7','10');
		$flag=0;
		foreach($data['admin_priv'] as $userdata['admin_priv']){
		if($userdata['admin_priv']['privilege_type_id']==5 && in_array($userdata['admin_priv']['privilege_level'],$edit_priv) )
		{
		$flag=1;
		break;
		}
		}
		if($data['admin_user_level']==4)
		 {
			  $univ=$this->univ_vs_user_model->get_assigned_univ_info($data['user_id']);
			  if(!(in_array($univ_id,$univ)))
			  {
				$flag=0;
			  }
		 }
		if($flag==0)
		{
		$this->load->view('admin/accesserror', $data);
		}
		else
		{
		$data['univ_admins']=$this->adminmodel->get_univ_admin();
		$data['countries']=$this->users->fetch_country();
		$data['univ_detail_edit']=$this->adminmodel->fetch_univ_data_edit($univ_id);
		//print_r($data['univ_detail_edit']);
		$this->load->view('admin/edituniversity',$data);
		}
	   }
	}
	
	function check_subdomain()
	{
		if($this->input->post('sub_domain')==$this->input->post('sub_domain_name'))
		{
		return TRUE;
		}
		else if($this->adminmodel->check_subdomain($this->input->post('sub_domain')))
		{
		$this->form_validation->set_message('check_subdomain', 'This SubDomain is alredy Exist');
		return FALSE;
		}
		else
		{
		return TRUE;
		}
	}
	
	function univ_detail($univ_id)
	{
		if (!$this->tank_auth->is_admin_logged_in()) {
			redirect('admin/adminlogin/');
		}
		else{
		$data = $this->path->all_path();
		$data['user_id']	= $this->tank_auth->get_admin_user_id();
		$data['admin_user_level']=$this->tank_auth->get_admin_user_level();
		$data['admin_priv']=$this->adminmodel->get_user_privilege($data['user_id']);
		if(!($data['admin_priv']))
		{
			redirect('admin/adminlogout');
		}
		$this->load->view('admin/header',$data);
		$this->load->view('admin/sidebar',$data);
		$delete_user_priv=array('5','7','8','10');
		$flag=0;
		foreach($data['admin_priv'] as $userdata['admin_priv']){
		if($userdata['admin_priv']['privilege_type_id']==5 && $userdata['admin_priv']['privilege_level']>0)
		{
		$flag=1;
		break;
		}
		}
		if($flag==0)
		{
		$this->load->view('admin/accesserror', $data);
		}
		else if($flag==1)
		{
		$data['univ_admins']=$this->adminmodel->get_univ_admin();
		//$data['countries']=$this->users->fetch_country();
		$data['univ_detail_edit']=$this->adminmodel->fetch_univ_data_edit($univ_id);
		$this->load->view('admin/view_university_detail', $data);	
		}
	 }	
	}
	
	function check_unique_field($field_name='',$table_name='')
	{
		if (!$this->tank_auth->is_admin_logged_in()) {
			redirect('admin/adminlogin/');
		}
		else {
		$data['result']=$this->adminmodel->check_unique_field($field_name,$this->input->post('field'),$table_name);
		$this->load->view('ajaxviews/check_unique_field', $data);
		}	
	}
	
	function add_univ_admin_ajax()
	{
		if (!$this->tank_auth->is_admin_logged_in()) {
			redirect('admin/adminlogin/');
		}
		else {
		$data['user_id']	= $this->tank_auth->get_admin_user_id();
		$hasher = new PasswordHash(
		$this->ci->config->item('phpass_hash_strength', 'tank_auth'),
		$this->ci->config->item('phpass_hash_portable', 'tank_auth'));
		$password=$this->input->post('pwd');
		$univ_admin_data=array(
		'fullname'=>$this->input->post('name'),
		'email'=>$this->input->post('email'),
		'password'=>$hasher->HashPassword($password),
		'createdby'=>'admin',
		'level'=>'3',
		'last_ip'	=> $this->ci->input->ip_address(),
		'createdby_user_id'=>$data['user_id'],
		);
		
		$univ_admin_id=$this->users->create_user($univ_admin_data,1);
		$this->adminmodel->insert_userprivlege_data_ajax($univ_admin_id['user_id']);
		//$data['msg']='University Admin Added Successfully';
		$this->load->view('admin/userupdated', $data);
		$data['uai']=$univ_admin_id['user_id'];
		$data['univ_admins']=$this->adminmodel->get_univ_admin();
		$this->load->view('ajaxviews/univ_admin_list',$data);
		}
	}
	
	function add_univ_gallery()
	{
	if (!$this->tank_auth->is_admin_logged_in()) {
			redirect('admin/adminlogin/');
		}
		else{
		$data = $this->path->all_path();
		$data['user_id']	= $this->tank_auth->get_admin_user_id();
		$data['admin_user_level']=$this->tank_auth->get_admin_user_level();
		$data['admin_priv']=$this->adminmodel->get_user_privilege($data['user_id']);
		if(!($data['admin_priv']))
		{
			redirect('admin/adminlogout');
		}
		$this->load->view('admin/header',$data);
		$this->load->view('admin/sidebar',$data);
		$add_gallery_priv=array('4','6','8','10');
		$flag=0;
		foreach($data['admin_priv'] as $userdata['admin_priv']){
		if($userdata['admin_priv']['privilege_type_id']==11 && in_array($userdata['admin_priv']['privilege_level'],$add_gallery_priv ) )
		{
		$flag=1;
		break;
		}
		}
		if($flag==0)
		{
		$this->load->view('admin/accesserror', $data);
		}
		else 
		{
		$submit=0;
		$data['univ_info']=$this->events->get_univ_detail();
		if ($this->input->post('upload')) {
		
		//echo  $num_files = count($_FILES['userfile1']['name']);
		$this->form_validation->set_rules('userfile1', 'File', 'callback_check_images');
		if ($this->form_validation->run()) 
		{
			
			if($data['admin_user_level']=='3')
			{
			$univ_info=$this->events->fetch_univ_id($data['user_id']);
			$university_id=$univ_info['univ_id'];
			$submit=1;
			}
			else
			{
				$this->form_validation->set_rules('university', 'University', 'trim|required');
				if ($this->form_validation->run()) 
				{
					$submit=1;
					$university_id=$this->input->post('university');
				}
			}
			if($submit=='1')
			{	
				if($this->adminmodel->upload_univ_gallery($university_id))
				{
					redirect('admin/manage_univ_gallery/ius');
				}
			}
		}
		}
		$this->load->view('admin/add_univ_gallery', $data);
	  }
		
	}
	}
	
	
	function manage_univ_gallery($del_pic='')
	{
		if (!$this->tank_auth->is_admin_logged_in()) 
		{
			redirect('admin/adminlogin/');
		}
		else
		{
			$data = $this->path->all_path();
			$data['user_id']	= $this->tank_auth->get_admin_user_id();
			$data['admin_user_level']=$this->tank_auth->get_admin_user_level();
			$data['admin_priv']=$this->adminmodel->get_user_privilege($data['user_id']);
			if(!($data['admin_priv']))
			{
				redirect('admin/adminlogout');
			}			
			$this->load->view('univadmin/header',$data);
			$this->load->view('univadmin/sidebar',$data);		
			$flag=0;
			$delete=0;
			foreach($data['admin_priv'] as $userdata['admin_priv'])
			{
				if($userdata['admin_priv']['privilege_type_id']==11 && $userdata['admin_priv']['privilege_level']!=0)
				{
					$delete_gallery_pic=array('5','7','8','10');
					if(in_array($userdata['admin_priv']['privilege_level'],$delete_gallery_pic))
					{
						$delete=1;
					}
					$flag=1;
				}
			}
			if($flag==0)
			{
				$this->load->view('univadmin/accesserror', $data);
			}
			else if($flag==1)
			{			
				if($delete==1 && $del_pic!=0 && $del_pic!='' && $del_pic!=NULL)
				{
					$this->adminmodel->delete_univ_gallery_pic($del_pic);
					$data['msg']="Gallery Image Deleted successfully";
					$this->load->view('admin/userupdated', $data);				
				}
				if($del_pic=='ius')
				{
					$data['msg']="Gallery Image Uploaded successfully";
					$this->load->view('univadmin/userupdated', $data);
				}
				if($data['admin_user_level']=='3')
				{
					$univ_info=$this->events->fetch_univ_id($data['user_id']);
					$data['gallery']=$this->adminmodel->get_univ_gallery_info($univ_info['univ_id']);
				
					if($this->input->post('upload'))
					{
						$university_id=$univ_info['univ_id'];						
						$added=$this->adminmodel->upload_univ_gallery($university_id);	
						if($added==1)
						{
							redirect('admin/manage_univ_gallery/ius');
						}			
					}				
				}
				else
				{
					$data['univ_info']=$this->events->get_univ_detail();
					$data['gallery']=$this->adminmodel->get_all_univ_gallery_info();
					if($this->input->post('upload'))
					{
						$university_id= $this->input->post('university');						
						$added=$this->adminmodel->upload_univ_gallery($university_id);	
						if($added==1)
						{
							redirect('admin/manage_univ_gallery/ius');
						}			
					}
				}
				if($data['admin_user_level']=='5')
				{
					//$this->load->view('admin/manage_univ_gallery', $data);
					$this->load->view('univadmin/gallery/uni_gallery', $data);					
				}
				else
				{
					$this->load->view('univadmin/gallery/uni_gallery', $data);
				}
			}
		}	
	}
	//new to delte image in univ admin panel
	function delete_image()
	{
		if (!$this->tank_auth->is_admin_logged_in()) 
		{
			redirect('admin/adminlogin/');
		}
		else
		{
			$data = $this->path->all_path();
			$data['user_id']	= $this->tank_auth->get_admin_user_id();
			$data['admin_user_level']=$this->tank_auth->get_admin_user_level();
			$data['admin_priv']=$this->adminmodel->get_user_privilege($data['user_id']);
			if(!($data['admin_priv']))
			{
				redirect('admin/adminlogout');
			}			
			$flag=0;
			$delete=0;
			foreach($data['admin_priv'] as $userdata['admin_priv'])
			{
				if($userdata['admin_priv']['privilege_type_id']==11 && $userdata['admin_priv']['privilege_level']!=0)
				{
					$delete_gallery_pic=array('5','7','8','10');
					if(in_array($userdata['admin_priv']['privilege_level'],$delete_gallery_pic))
					{
						$delete=1;
					}
					$flag=1;
				}
			}
			if($flag==0)
			{
				echo 0;
			}
			else if($flag==1)
			{			
				if($delete==1 )
				{
					$id=$this->input->post('id');
					$deleted=$this->adminmodel->delete_univ_gallery_pic($id);
					echo $deleted;	
				}				
			}
		}
	}
	//to delete multiple images in univ panel
	function delete_mul_images()
	{
		if (!$this->tank_auth->is_admin_logged_in()) 
		{
			redirect('admin/adminlogin/');
		}
		else
		{
			$data = $this->path->all_path();
			$data['user_id']	= $this->tank_auth->get_admin_user_id();
			$data['admin_user_level']=$this->tank_auth->get_admin_user_level();
			$data['admin_priv']=$this->adminmodel->get_user_privilege($data['user_id']);
			if(!($data['admin_priv']))
			{
				redirect('admin/adminlogout');
			}			
			$flag=0;
			$delete=0;
			foreach($data['admin_priv'] as $userdata['admin_priv'])
			{
				if($userdata['admin_priv']['privilege_type_id']==11 && $userdata['admin_priv']['privilege_level']!=0)
				{
					$delete_gallery_pic=array('5','7','8','10');
					if(in_array($userdata['admin_priv']['privilege_level'],$delete_gallery_pic))
					{
						$delete=1;
					}
					$flag=1;
				}
			}
			if($flag==0)
			{
				echo 0;
			}
			else if($flag==1)
			{			
				if($delete==1 )
				{					
					$deleted=$this->adminmodel->delete_images();
					echo $deleted;	
				}				
			}
		}
	}
	function fetch_univ_gallery_ajax()
	{
		if (!$this->tank_auth->is_admin_logged_in()) 
		{
			redirect('admin/adminlogin/');
		}
		else 
		{
			$data = $this->path->all_path();
			$data['user_id']= $this->tank_auth->get_admin_user_id();
			$data['admin_user_level']=$this->tank_auth->get_admin_user_level();
			$data['admin_priv']=$this->adminmodel->get_user_privilege($data['user_id']);
			if(!($data['admin_priv']))
			{
				redirect('admin/adminlogout');
			}
			$delete=0;
			$delete_gallery_pic=array('5','7','8','10');
			foreach($data['admin_priv'] as $userdata['admin_priv'])
			{
				if($userdata['admin_priv']['privilege_type_id']==11 && $userdata['admin_priv']['privilege_level']!=0 && $data['admin_user_level']!='3')
				{
					if(in_array($userdata['admin_priv']['privilege_level'],$delete_gallery_pic))
					{
						$delete=1;
					}
				}
			}
			$univ_id=$this->input->post('univ_id');
			$data['delete']=$delete;	
			$data['count']=$this->adminmodel->get_univ_gallery_info_count($univ_id);
			$data['gallery']=$this->adminmodel->get_univ_gallery_info($univ_id);
			$this->load->view('ajaxviews/manage_univ_gallery_admin', $data);		
		}
	}	
	function update_password()
	{
		if (!$this->tank_auth->is_admin_logged_in()) {
			redirect('admin/adminlogin/');
		}
		else{
		$data = $this->path->all_path();
		$data['user_id']	= $this->tank_auth->get_admin_user_id();
		$data['admin_user_level']=$this->tank_auth->get_admin_user_level();
		$data['admin_priv']=$this->adminmodel->get_user_privilege($data['user_id']);
		if(!($data['admin_priv']) && ($data['admin_user_level']!='2' && $data['admin_user_level']!='6'))
		{
			redirect('admin/adminlogout');
		}
		if($data['admin_user_level']==3)
		{
			$this->load->view('univadmin/header',$data);
			$this->load->view('univadmin/sidebar',$data);
		}
		else
		{
			$this->load->view('admin/header',$data);
			$this->load->view('admin/sidebar',$data);
		}
		$this->form_validation->set_rules('current_password', 'Current Password', 'trim|required|xss_clean|min_length['.$this->config->item('password_min_length', 'tank_auth').']|max_length['.$this->config->item('password_max_length', 'tank_auth').']|alpha_dash');
		$this->form_validation->set_rules('new_password', 'New Password', 'trim|required|xss_clean|min_length['.$this->config->item('password_min_length', 'tank_auth').']|max_length['.$this->config->item('password_max_length', 'tank_auth').']|alpha_dash');
		$this->form_validation->set_rules('confirm_new_password', 'Confirm new Password', 'trim|required|xss_clean|matches[new_password]');
		$data['errors'] = array();
		$flag=0;
		if ($this->form_validation->run()) {								// validation ok
				if ($this->tank_auth->change_admin_password(
						$this->form_validation->set_value('current_password'),
						$this->form_validation->set_value('new_password'))) {	// success
						$data['msg']='Your Password has been changed Successfully';
						if($data['admin_user_level']==3)
						{
							$this->load->view('univadmin/userupdated',$data);
						}
						else
						{						
							$this->load->view('admin/userupdated',$data);
						}
						$flag=1;
					//$this->_show_message($this->lang->line('auth_message_password_changed'));
					
				} else {														// fail
					$errors = $this->tank_auth->get_error_message();
					foreach ($errors as $k => $v)	$data['errors'][$k] = $this->lang->line($v);
				}
				
			}
		if($flag==0)
		{
			if($data['admin_user_level']==3)
				{
					$this->load->view('univadmin/change_password',$data);
				}
				else
				{
					$this->load->view('admin/update_password', $data);							
				}	
		}
	 }
	}
	
 function ManageUniversitySearch($paging='')
 {
   if (!$this->tank_auth->is_admin_logged_in()) {
   redirect('admin/adminlogin/');
   }
   else{
   //echo "Function call from controller";
   $data = $this->path->all_path();
   $data['user_id']	= $this->tank_auth->get_admin_user_id();
   $data['admin_user_level']=$this->tank_auth->get_admin_user_level();
   $data['admin_priv']=$this->adminmodel->get_user_privilege($data['user_id']);
    if(!($data['admin_priv']))
	{
			redirect('admin/adminlogout');
	}
   $univ_name = $this->input->post('search_box');
   $data['univ_name']=$univ_name;
   $sel_id = $this->input->post('sel_id');
   $data['sel_id']=$sel_id;
   $search_box = $this->input->post('search_box');
   $data['search_box']=$search_box;
   $data['user_id'] = $this->tank_auth->get_admin_user_id();
   $data['admin_user_level']=$this->tank_auth->get_admin_user_level();
   $data['univ_info_search']=$this->adminmodel->get_univ_info_search($paging,$univ_name,$sel_id );
   $this->load->view('ajaxviews/search_manage_university',$data);
   //print_r($data['univ_info_search']);
   }
 }
 
 //new
	function update_university_detail($msg="")
	{
		if (!$this->tank_auth->is_admin_logged_in())
		{
			redirect('admin/adminlogin/');
		}
		else
		{
			$data = $this->path->all_path();
			$data['user_id'] = $this->tank_auth->get_admin_user_id();
			$data['admin_user_level']=$this->tank_auth->get_admin_user_level();
			$data['admin_priv']=$this->adminmodel->get_user_privilege($data['user_id']);
			$univ_info=$this->events->fetch_univ_id($data['user_id']);
			$univ_id=$univ_info['univ_id'];
			if(!($data['admin_priv']))
			{
				redirect('admin/adminlogout');
			}
			$data['results'] = $this->adminmodel->userprivlegetype();	    
			if($this->input->post('submit'))
			{
				// $this->form_validation->set_rules('univ_name', 'University', 'trim|required');
				// $this->form_validation->set_rules('address', 'Addrss Line1', 'trim|xss_clean');
				// $this->form_validation->set_rules('phone_no', 'phone no', 'trim|xss_clean');
				// $this->form_validation->set_rules('contact_us', 'Contact Us', 'trim|xss_clean');
				// if ($this->form_validation->run()) 
				// {
					$flg=$this->adminmodel->update_univ_admin_university($univ_id);
					echo $flg;
					exit;
					// if(!$flag) 
					// { 
						// redirect('admin/update_university_detail/uus');
					// }
					//print_r($data['x']);
					//$this->adminmodel->edit_user_data();
					//redirect('admin/manageusers/ups');
				// }
			}
			if($this->input->post('info_save'))									//added by satbir on 11/08/2012
			{				
				// $this->form_validation->set_rules('txtareaoverview', 'Overview University', 'trim|xss_clean');
				// $this->form_validation->set_rules('txtareacampus', 'Campus Overview', 'trim|xss_clean');
				// $this->form_validation->set_rules('txtareaservices', 'Services', 'trim|xss_clean');
				// $this->form_validation->set_rules('txtareaalumni', 'Awarded Alumni', 'trim|xss_clean');
				// $this->form_validation->set_rules('txtareadepartments', 'Departments', 'trim|xss_clean');
				// $this->form_validation->set_rules('txtareafaculties', 'Faculties', 'trim|xss_clean');
				// $this->form_validation->set_rules('txtareaslife', 'Student Life', 'trim|xss_clean');
				// $this->form_validation->set_rules('txtareainterstudents', 'For International Students', 'trim|xss_clean');
				// $this->form_validation->set_rules('txtareaexpertise', 'Research Expertise', 'trim|xss_clean');
				// $this->form_validation->set_rules('txtareainsights', 'Insights', 'trim|xss_clean');
				//if ($this->form_validation->run()) 
				//{
					$flg = $this->adminmodel->update_univ_admin_university_info($univ_id);
					echo $flg;
					exit;
					// if(!$flag) 
					// { 
						// redirect('admin/update_university_detail/uus');
					// }
				//}
			}
			if($this->input->post('info_seo'))									//added by satbir on 11/08/2012
			{
				// $this->form_validation->set_rules('title', 'Title', 'trim|xss_clean');
				// $this->form_validation->set_rules('description', 'Description', 'trim|xss_clean');
				// $this->form_validation->set_rules('keyword', 'Keyword', 'trim|xss_clean');
				//if ($this->form_validation->run()) 
				//{
				$res = $this->adminmodel->update_univ_admin_university_seo($univ_id);
				echo $res;
				exit;
				// if(!$flag) 
				// { 
					// redirect('admin/update_university_detail/uus');
				// }
				// }
			}
			$flag=0;
			$data['univ_detail_edit']=$this->adminmodel->fetch_univ_detail($data['user_id']);	  
			if($data['univ_detail_edit']!=0)
			{		 
				if($data['univ_detail_edit'][0]->univ_id==$univ_id)
				{
					$flag=1;
				}
				else
				{
					$flag=0;
				}
			}
			if($data['admin_user_level']=='5')
			{
				$this->load->view('admin/header',$data);
				$this->load->view('admin/sidebar',$data);
				$flag=1;
			}
			if($flag==0)
			{
				$this->load->view('univadmin/accesserror', $data);
			}
			else
			{			  
				$this->load->view('univadmin/header',$data);
				$this->load->view('univadmin/sidebar',$data);
				if($msg=='uus')
				{
					$data['msg']='University Updated Successfully';
					$this->load->view('univadmin/userupdated',$data);
				}
				$data['countries']=$this->users->fetch_country();
				$data['univ_detail_edit']=$this->adminmodel->fetch_univ_data_edit($univ_id);
				$this->load->view('univadmin/university/update_university',$data);
			}
		}	
	}
 
 function featured_unfeatured_university($f_status,$univ_id)
 {
 if (!$this->tank_auth->is_admin_logged_in()) {
   redirect('admin/adminlogin/');
   }
   else{
   //echo "Function call from controller";
   $data = $this->path->all_path();
   $data['user_id']	= $this->tank_auth->get_admin_user_id();
   $data['admin_user_level']=$this->tank_auth->get_admin_user_level();
   $data['admin_priv']=$this->adminmodel->get_user_privilege($data['user_id']);
    if(!($data['admin_priv']))
	{
			redirect('admin/adminlogout');
	}
	if($data['admin_user_level']==5)
	{
	$fu_status=$this->adminmodel->home_featured_unfeatured_university($f_status,$univ_id);
	if($fu_status)
	{
	redirect('admin/manage_university/fh');
	}
	else
	{
	redirect('admin/manage_university/ufh');
	}
	}
	else
	{
	$this->load->view('admin/accesserror', $data);
	}
   //print_r($data['univ_info_search']);
   }
 }
 
 function check_images()
 {
		//echo "hello";
		if ($_FILES['userfile1']['name'][0]!='')
		{		
	    $num_files = count($_FILES['userfile1']['name'])-1;
        for ($i=0; $i < $num_files; $i++) {
		$png_mimes  = array('image/x-png','image/png');
		$jpeg_mimes = array('image/jpg', 'image/jpe', 'image/jpeg', 'image/pjpeg');
		if (in_array($_FILES['userfile1']['type'][$i], $png_mimes))
		{
			$filetype = 'image/png';
		}

		if (in_array($_FILES['userfile1']['type'][$i], $jpeg_mimes))
		{
			$filetype = 'image/jpeg';
		}
		else
		{
		$filetype=$_FILES['userfile1']['type'][$i];
		}

		$img_mimes = array(
							'image/gif',
							'image/jpeg',
							'image/png',
						);

		if (! (in_array($filetype, $img_mimes)))
		{
		$data['err_msg']='Please Select the Image Gallery file in jpg/png/gif format.';
		$this->load->view('admin/show_error',$data);
		return false;
		}
		
		}
		return true;
		}
        return true; 
 
 }
	function edit_profile($profile_id='')											//added by satbir on 12/07/2012
	{
		if(!$this->tank_auth->is_admin_logged_in()) 
		{
			redirect('admin/adminlogin/');
		}
		else
		{
			$data = $this->path->all_path();
			$data['user_id']	= $this->tank_auth->get_admin_user_id();
			$data['admin_user_level']=$this->tank_auth->get_admin_user_level();
			$data['admin_priv']=$this->adminmodel->get_user_privilege($data['user_id']);
			$data['admin_profile'] = $this->adminmodel->get_admin_profile($data['user_id']);		
			if(!($data['admin_priv']))
			{
				redirect('admin/adminlogout');
			}
			$this->load->view('univadmin/header', $data);
			$this->load->view('univadmin/sidebar', $data);
			$flag=0;
			foreach($data['admin_priv'] as $userdata['admin_priv'])
			{
				if($userdata['admin_priv']['privilege_type_id']==2 && $userdata['admin_priv']['privilege_level']!=0 )
				{
					$flag=1;
					break;
				}
			}
			if($flag==0)
			{
				$this->load->view('univadmin/accesserror', $data);
			}
			else
			{				
				if($this->input->post('submit'))
				{
					$myFlag = $this->adminmodel->update_profile($profile_id);
					redirect('admin/edit_profile');
				}
				else
				{
					$this->load->view('univadmin/admin_profile/edit_profile', $data);
				}	
			}
		}		
	}
	function update_university_detail_by_ajax()    		// added by satbir 12_15_2012
	{
		
	}
 
}


/* End of file auth.php */
/* Location: ./application/controllers/auth.php */