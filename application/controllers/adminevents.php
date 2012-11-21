<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Adminevents extends CI_Controller
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
	}

	function index()
	{
		$data = $this->path->all_path();
		if (!$this->tank_auth->is_admin_logged_in()) {
			redirect('admin/adminlogin/');
		} else {
			redirect('adminevents/manage_events');
			
		}	
	}
	
	function manage_events($msg='')
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
			//fetch user privilege data from model
			if($this->input->post('ajax')!=1)
			{
				$this->load->view('admin/header', $data);
				$this->load->view('admin/sidebar', $data);
			}
			$flag=0;
			foreach($data['admin_priv'] as $userdata['admin_priv']){
			if($userdata['admin_priv']['privilege_type_id']==3 && $userdata['admin_priv']['privilege_level']!=0 )
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
			if($msg=='eas')
			{
			$data['msg']='Event Added Successfully';
			$this->load->view('admin/userupdated', $data);
			}
			if($msg=='fh')
			{
			$data['msg']='Event set as Home featured event Successfully';
			$this->load->view('admin/userupdated', $data);
			}
			if($msg=='ufh')
			{
			$data['msg']='Event remove as Home featured event Successfully';
			$this->load->view('admin/userupdated', $data);
			}
			if($msg=='fd')
			{
			$data['msg']='Event set as Study Abroad featured event Successfully';
			$this->load->view('admin/userupdated', $data);
			}
			if($msg=='ufd')
			{
			$data['msg']='Event remove as Study Abroad featured event Successfully';
			$this->load->view('admin/userupdated', $data);
			}
			if($msg=='eds')
			{
			$data['msg']='Event deleted Successfully';
			$this->load->view('admin/userupdated', $data);
			}
			if($msg=='eus')
			{
			$data['msg']='Event Updated Successfully';
			$this->load->view('admin/userupdated', $data);
			}
			if($msg=='ehs' || $msg=='ess')
			{
			$data['msg']='Action Performed Successfully';
			$this->load->view('admin/userupdated', $data);
			}
			$data['events_info']=$this->events->events_detail();
			$data['featured']=$this->input->post('featured');
			$data['sel_id']=$this->input->post('sel_id');  
			$data['search_box']= $this->input->post('search_box'); 
			$data['date_selector']= $this->input->post('date_selector');
			$this->load->view('admin/event/manage_events', $data);
			}
		}	
	}
	
	function add_event()
	{
		 $this->load->library('fbConn/facebook');
		$data = $this->path->all_path();
		$data['fb_permissions']='no';
		$facebook = new Facebook();
			
		if(isset($facebook->access_token) && $facebook->access_token!='')
			{
		    $permissions = $facebook->api("/me/permissions?access_token=".$facebook->access_token);
			if(array_key_exists('create_event', $permissions['data'][0]) && array_key_exists('manage_pages', $permissions['data'][0])) 
		    {
			$data['fb_permissions']='yes';
			}
		}
		//$this->config->load('sendgrid');
		//$this->load->library('fbConn/facebook');
		//$facebook = new Facebook();
		$config['protocol'] = $this->config->item('protocol');
		$config['smtp_host'] = $this->config->item('smtp_host');
		$config['smtp_user'] = $this->config->item('smtp_user');
		$config['smtp_pass'] = $this->config->item('smtp_pass');
		$config['smtp_port'] = $this->config->item('smtp_port');
		$config['crlf'] = $this->config->item('crlf');
		$config['newline'] = $this->config->item('newline');
		$this->email->initialize($config);
		if (!$this->tank_auth->is_admin_logged_in()) {
			redirect('admin/adminlogin/');
		} else {
			$data['user_id']	= $this->tank_auth->get_admin_user_id();
			$data['admin_user_level']=$this->tank_auth->get_admin_user_level();
			$data['admin_priv']=$this->adminmodel->get_user_privilege($data['user_id']);
			if(!($data['admin_priv']))
			{
			redirect('admin/adminlogout');
			}
			$add_events=array('4','6','8','10');
			$flag=0;
			foreach($data['admin_priv'] as $userdata['admin_priv']){
			if($userdata['admin_priv']['privilege_type_id']==3 && in_array($userdata['admin_priv']['privilege_level'],$add_events) )
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
			if($this->input->post('submit'))
			{
			$this->form_validation->set_rules('title', 'Title', 'trim|required');
			$this->form_validation->set_rules('university', 'University', 'trim|required|xss_clean');
			$this->form_validation->set_rules('country', 'country', 'trim|xss_clean|required');
			$this->form_validation->set_rules('state', 'state', 'trim|xss_clean|required');
			$this->form_validation->set_rules('city', 'City', 'trim|required|string');
			$this->form_validation->set_rules('event_time', 'Event Time', 'trim|xss_clean|required');
			$this->form_validation->set_rules('detail', 'Detail', 'trim|string');
			$this->form_validation->set_rules('event_place', 'Event Place', 'trim|string');
			$this->form_validation->set_rules('event_start_timing', 'Event Start Time', 'trim|string');
			$this->form_validation->set_rules('event_end_timing', 'Event End Time', 'trim|string');
			$this->form_validation->set_rules('university_name', 'University Name', 'trim|required|xss_clean');
			$this->form_validation->set_rules('country_name', 'Country Name', 'trim|required|xss_clean');
			$this->form_validation->set_rules('state_name', 'State Name', 'trim|required|xss_clean');
			$this->form_validation->set_rules('city_name', 'City Name', 'trim|required|xss_clean');
			
			//$this->form_validation->set_rulesi('sub_domain', 'Sub Domain', 'xss_clean|alpha_dash|trim|required|string|is_unique[university.subdomain_name]');
			if ($this->form_validation->run()) {
			$followers_id = array();
			$followers_detail = array();
			$followers_email_for_sent = array();
			$data['x']=$this->events->create_event();
			$latest_registered_event_id = $data['x'];
			$data['latest_register_event_info'] = $this->leadmodel->event_detail_for_email($latest_registered_event_id);
			//print_r($data['latest_register_event_info']);
			//echo $data['latest_register_event_info'][0]['univ_is_client'];
			$message_body = $this->load->view('auth/event_register_content_email_from_admin',$data,TRUE);
			$selected_univ_id = $this->input->post('university');
			if($data['latest_register_event_info'][0]['univ_is_client'] == '1')
			{
			$data['followers_of_univ'] = $this->users->get_followers_detail_of_univ($selected_univ_id);
			$followers_detail = $data['followers_of_univ'];
			foreach($followers_detail as $follow)
			{
				//$data['user_info_for_sent_email'] = $this->users->fetch_profile_by_user_email($follow['email']);
				
				//print_r($data['user_info_for_sent_email']);
				array_push($followers_id,$follow['email']);
				//echo $follow['email'];
			}
			$message_body;
			$followers_email_for_sent = implode($followers_id,",");
				 $this->email->from('info@meetuniversities.com', 'Meet Universities');
					$this->email->to($followers_id);
					//$this->email->cc('another@another-example.com');
					//$this->email->bcc('them@their-example.com');
					$this->email->subject('Welcome To Meet Universities');
					$this->email->message($message_body);
					$this->email->send(); 
			
			}
			redirect('adminevents/manage_events/eas');
			
			}
			//fetch user privilege data from model
			}
			$data['countries']=$this->users->fetch_country();
			if($data['admin_user_level']=='5'  || $data['admin_user_level']=='4')
			{
			$data['univ_info']=$this->events->get_univ_detail();
			}
			else
			{
			$data['univ_info']=$this->events->get_univ_id_by_user_id($data['user_id']);
			}
			$this->load->view('admin/header', $data);
			$this->load->view('admin/sidebar', $data);	
			$this->load->view('admin/event/add_event', $data);
			
			}	
	}
	}
	
	function featured_unfeatured_event($f_status='',$event_id)
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
		if($userdata['admin_priv']['privilege_type_id']==3 && $userdata['admin_priv']['privilege_level']>1 && $data['user_id']!='3')
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
		$f=1;
		if($data['admin_user_level']=='3')
		{
		$admin_univ_id=$this->events->fetch_univ_id($data['user_id']);
		$event_list=$this->events->fetch_events_ids($admin_univ_id['univ_id']);
		if(!in_array($event_id,$event_list))
		{
			$f=0;
		}
		}
		if($f==1)
		{
		$fu_status=$this->events->home_featured_unfeatured_event($f_status,$event_id);
		if($fu_status)
		{
		redirect('adminevents/manage_events/fh');
		}
		else
		{
		redirect('adminevents/manage_events/ufh');
		}
		}
		else
		{
		$this->load->view('admin/accesserror', $data);
		}	
		}
	  }
	}
	
	function featured_unfeatured_dest_event($f_status='',$event_id)
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
		if($userdata['admin_priv']['privilege_type_id']==3 && $userdata['admin_priv']['privilege_level']>1 && $data['user_id']!='3')
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
		$f=1;
		if($data['admin_user_level']=='3')
		{
		$admin_univ_id=$this->events->fetch_univ_id($data['user_id']);
		$event_list=$this->events->fetch_events_ids($admin_univ_id['univ_id']);
		if(!in_array($event_id,$event_list))
		{
			$f=0;
		}
		}
		if($f==1)
		{
		$fu_status=$this->events->dest_featured_unfeatured_event($f_status,$event_id);
		if($fu_status)
		{
		redirect('adminevents/manage_events/fd');
		}
		else
		{
		redirect('adminevents/manage_events/ufd');
		}
		}
		else
		{
		$this->load->view('admin/accesserror', $data);
		}	
		
		}
	  }
	}
	
	function delete_single_event($event_id)
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
		$delete_events=array('5','7','8','10');
		foreach($data['admin_priv'] as $userdata['admin_priv']){
		if($userdata['admin_priv']['privilege_type_id']==3 && in_array($userdata['admin_priv']['privilege_level'],$delete_events))
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
		$f=1;
		if($data['admin_user_level']=='3')
		{
		$admin_univ_id=$this->events->fetch_univ_id($data['user_id']);
		$event_list=$this->events->fetch_events_ids($admin_univ_id['univ_id']);
		if(!in_array($event_id,$event_list))
		{
			$f=0;
		}
		}
		if($f==1)
		{
		$this->events->delete_single_event($event_id);
		redirect('adminevents/manage_events/eds');
		}
		else
		{
		$this->load->view('admin/accesserror', $data);
		}
		}
	  }
	}
	
	function view_event($event_id)
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
		if($userdata['admin_priv']['privilege_type_id']==3 && $userdata['admin_priv']['privilege_level']>0)
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
		$f=1;
		if($data['admin_user_level']=='3')
		{
		$admin_univ_id=$this->events->fetch_univ_id($data['user_id']);
		$event_list=$this->events->fetch_events_ids($admin_univ_id['univ_id']);
		if(!in_array($event_id,$event_list))
		{
			$f=0;
		}
		}
		if($f==1)
		{
		$data['event_info']=$this->events->fetch_event_detail($event_id);
		$this->load->view('admin/event/view_event', $data);
		}
		else
		{
		$this->load->view('admin/accesserror', $data);
		}
		}
	  }
	}
	
	
	function edit_event($event_id)
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
		$edit_events=array('3','6','7','10');
		$flag=0;
		foreach($data['admin_priv'] as $userdata['admin_priv']){
		if($userdata['admin_priv']['privilege_type_id']==3 && in_array($userdata['admin_priv']['privilege_level'],$edit_events) )
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
		$f=1;
		if($data['admin_user_level']=='3')
		{
		$admin_univ_id=$this->events->fetch_univ_id($data['user_id']);
		$event_list=$this->events->fetch_events_ids($admin_univ_id['univ_id']);
		if(!in_array($event_id,$event_list))
		{
			$f=0;
		}
		}
		if($f=='1')
		{
			if($this->input->post('submit'))
			{
			$this->form_validation->set_rules('title', 'Title', 'trim|required');
			$this->form_validation->set_rules('university', 'University', 'trim|required|xss_clean');
			$this->form_validation->set_rules('country', 'country', 'trim|xss_clean|required');
			$this->form_validation->set_rules('state', 'state', 'trim|xss_clean|required');
			$this->form_validation->set_rules('city', 'City', 'trim|required|string');
			$this->form_validation->set_rules('country', 'country_name', 'trim|xss_clean|required');
			$this->form_validation->set_rules('state', 'state_name', 'trim|xss_clean|required');
			$this->form_validation->set_rules('city', 'City_name', 'trim|required|string');
			$this->form_validation->set_rules('event_time', 'Event Time', 'trim|xss_clean|required');
			$this->form_validation->set_rules('detail', 'Detail', 'trim|string');
			
			//$this->form_validation->set_rulesi('sub_domain', 'Sub Domain', 'xss_clean|alpha_dash|trim|required|string|is_unique[university.subdomain_name]');
			if ($this->form_validation->run()) {
			$this->events->update_event($event_id);
			redirect('adminevents/manage_events/eus');
			}
		}
		$data['countries']=$this->users->fetch_country();
		$data['univ_info']=$this->events->get_univ_detail();
		$data['event_info']=$this->events->fetch_event_detail($event_id);
		$this->load->view('admin/event/edit_event', $data);	
		}
		else
		{
		$this->load->view('admin/accesserror', $data);
		}
		}
		}
	  }
	 
	 
	function delete_events()
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
		if($userdata['admin_priv']['privilege_type_id']==3 && in_array($userdata['admin_priv']['privilege_level'],$delete_user_priv))
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
		$this->events->delete_events();
		redirect('adminevents/manage_events/eds');
		}
	  }
	}	
	 
	 function count_featured_events($field)
	 {
		$data['result']=$this->events->count_feature_event($field);
		$this->load->view('ajaxviews/check_unique_field',$data);
		
	 }
	 
	 function add_more_event()
	 {
		$data = $this->path->all_path();
		if (!$this->tank_auth->is_admin_logged_in()) {
			redirect('admin/adminlogin/');
		} else {
			$data['user_id']	= $this->tank_auth->get_admin_user_id();
			$data['admin_user_level']=$this->tank_auth->get_admin_user_level();
			$data['admin_priv']=$this->adminmodel->get_user_privilege($data['user_id']);
			if(!($data['admin_priv']))
			{
			redirect('admin/adminlogout');
			}
			$add_events=array('4','6','8','10');
			$flag=0;
			foreach($data['admin_priv'] as $userdata['admin_priv']){
			if($userdata['admin_priv']['privilege_type_id']==3 && in_array($userdata['admin_priv']['privilege_level'],$add_events) )
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
			if($this->input->post('submit'))
			{
			$this->form_validation->set_rules('title', 'Title', 'trim|required');
			$this->form_validation->set_rules('university', 'University', 'trim|required|xss_clean');
			$this->form_validation->set_rules('country', 'country', 'trim|xss_clean|required');
			$this->form_validation->set_rules('state', 'state', 'trim|xss_clean|required');
			$this->form_validation->set_rules('city', 'City', 'trim|required|string');
			$this->form_validation->set_rules('event_time', 'Event Time', 'trim|xss_clean|required');
			$this->form_validation->set_rules('detail', 'Detail', 'trim|string');
			$this->form_validation->set_rules('event_place', 'Event Place', 'trim|string');
			$this->form_validation->set_rules('event_timing', 'Event Time', 'trim|string');
			if ($this->form_validation->run()) {
			$data['x']=$this->events->create_event();
			redirect('adminevents/manage_events/eas');
			}
			//fetch user privilege data from model
			}
			}
			$data['countries']=$this->users->fetch_country();
			if($data['admin_user_level']=='5'  || $data['admin_user_level']=='4')
			{
			$data['univ_info']=$this->events->get_univ_detail();
			}
			else
			{
			$data['univ_info']=$this->events->get_univ_id_by_user_id($data['user_id']);
			}
			$this->load->view('admin/header', $data);
			$this->load->view('admin/sidebar', $data);	
			$this->load->view('admin/event/add_more_event', $data);
			
			}	
	}
	 
	function add_more_event_by_ajax()
	{
		if($this->input->post('add_multiple_event_by_ajax'))
		{
		$data = $this->path->all_path();
		if (!$this->tank_auth->is_admin_logged_in()) {
			redirect('admin/adminlogin/');
		} else {
			$data['user_id']	= $this->tank_auth->get_admin_user_id();
			$data['admin_user_level']=$this->tank_auth->get_admin_user_level();
			$data['admin_priv']=$this->adminmodel->get_user_privilege($data['user_id']);
			if(!($data['admin_priv']))
			{
			redirect('admin/adminlogout');
			}
			$add_events=array('4','6','8','10');
			$flag=0;
			foreach($data['admin_priv'] as $userdata['admin_priv']){
			if($userdata['admin_priv']['privilege_type_id']==3 && in_array($userdata['admin_priv']['privilege_level'],$add_events) )
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
			$data['x']=$this->events->create_event();
			}
		}	
		}
	}
	
	//function add event by ajax 
	function create_event_ajax()
	{
		
		if (!$this->tank_auth->is_admin_logged_in())
		{
			echo "0";
		} 
		else 
		{
			$data['user_id']	= $this->tank_auth->get_admin_user_id();
			$data['admin_user_level']=$this->tank_auth->get_admin_user_level();
			$data['admin_priv']=$this->adminmodel->get_user_privilege($data['user_id']);
			if(!($data['admin_priv']))
			{
			echo "0";
			}
			$add_events=array('4','6','8','10');
			$flag=0;
			foreach($data['admin_priv'] as $userdata['admin_priv']){
			if($userdata['admin_priv']['privilege_type_id']==3 && in_array($userdata['admin_priv']['privilege_level'],$add_events) )
			{
			$flag=1;
			break;
			}
			}
			if($flag==0)
			{
			echo "sorry";
			}
			else
			{
			if($this->input->post('submit'))
			{
				$this->events->create_event();
				 
				 
				if(($this->input->post('share_facebook')=='on') && ($this->input->post('etiming')))
				{
				//$page_id = '198465570173386';
				$page_id = '132735360191608';
					 
				$this->load->library('fbConn/facebook');
				
				$facebook=new Facebook();
				
				$app_id='332345880170760';
				$app_secret='29a0f2cd00dcfbab6143d0566b0218d1';
				
				$accessToken='AAAF5umslDiYBAFRvEHb5K9EaTLdzKWUFf8q0Vhg5d5Dh8VtxobZBvg4UDfZC7YzsL9QrMsYIBMFd77WgpI2vsaESkZBrZCubbHGtvcZAXgcVd84TFTCgs';
				//echo $accessToken;exit;
				if($this->input->post('fixedloc'))
				{
				$street=$this->input->post('event_place');
				$city=$this->input->post('cityname');
				$state=$this->input->post('statename');
				$country= $this->input->post('countryname'); 
				//echo 'hello';
				//$places =json_decode(file_get_contents("https://graph.facebook.com/oauth/search?q=".urlencode($street.", ".$city.",".$state.", ".$country)."&type=place&access_token=".$page_access_token));
				 $places = "https://graph.facebook.com/oauth/access_token?"."client_id=".$app_id."&redirect_uri=".urlencode($street.",".$city.",".$state.",".$country)."&client_secret=".$app_secret."&code=".$code;
				
				// $query = urlencode($street.", ".$city.",".$state.", ".$country);
				// $graphUrl = 'https://graph.facebook.com/search?type=user&accessToken=' . $accessToken . '&q=' . $query;
				// $places = json_decode(file_get_contents($graphUrl));
				//print_r($places);exit;
				$venue=array();
				$venue["street"]=$street;
				$venue["city"]=$city;
				$venue["state"]=$state;
				$venue["country"]= $country; 
				if(count($places->data)>0)
				{
				$locid=$places->data[0];
				$venue["location_id"]=$locid->id;
				$event_info['location_id']=$locid->id;
				}
				$event_info['venue'] =$venue;
				}
				else
				{
				  $event_info['location'] = $this->input->post('event_place'); 
				
				}
				
				$event_info['name']= $this->input->post('university_name');
				$event_info['start_time'] = $this->input->post('event_time').' '.$this->input->post('event_time_start');
				$event_info['end_time'] =$this->input->post('event_time').' '.$this->input->post('event_time_end');
				$event_info['email'] ='info@meetuniversities.com';
				$event_info['description'] =$this->input->post('detail');				
				$event_info['access_token'] = $accessToken;
				//$event_info['city'] = $event_loc;
				$event_info['page_id'] = $page_id;
				$event_info['privacy'] ="OPEN";
				//print_r($event_info);exit;
				$accounts = $facebook->api('/132735360191608/events','POST',$event_info);
			}
			echo "1";		 
			 
			}
			}
			
		}
		}
	 
	function edit_event_ajax($event_id)
	{
		if (!$this->tank_auth->is_admin_logged_in()) {
			echo "0";
		}
		else{
		$data = $this->path->all_path();
		$data['user_id']	= $this->tank_auth->get_admin_user_id();
		$data['admin_user_level']=$this->tank_auth->get_admin_user_level();
		$data['admin_priv']=$this->adminmodel->get_user_privilege($data['user_id']);
		if(!($data['admin_priv']))
		{
			echo "0";
		}
		$this->load->view('admin/header',$data);
		$this->load->view('admin/sidebar',$data);
		$edit_events=array('3','6','7','10');
		$flag=0;
		foreach($data['admin_priv'] as $userdata['admin_priv']){
		if($userdata['admin_priv']['privilege_type_id']==3 && in_array($userdata['admin_priv']['privilege_level'],$edit_events) )
		{
		$flag=1;
		break;
		}
		}
		if($flag==0)
		{
		echo "sorry";
		}
		else
		{
		$f=1;
		if($data['admin_user_level']=='3')
		{
		$admin_univ_id=$this->events->fetch_univ_id($data['user_id']);
		$event_list=$this->events->fetch_events_ids($admin_univ_id['univ_id']);
		if(!in_array($event_id,$event_list))
		{
			$f=0;
		}
		}
		if($f=='1')
		{
			if($this->input->post('submit'))
			{
			$this->events->update_event($event_id);
			echo "1";
		}
		}
		else
		{
		echo "0";
		}
		}
		}
	}	
	 
	function show_hide_event()
	{
	$event_id=$this->input->post('event_id');
	$this->events->hide_show_event($event_id);
	echo $this->input->post('show_hide');
	
	}
	
}

/* End of file auth.php */
/* Location: ./application/controllers/auth.php */