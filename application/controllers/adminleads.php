<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Adminleads extends CI_Controller
{
	function __construct()
	{
		parent::__construct();

		$this->load->helper('url');
		$this->load->library('tank_auth');
		$this->load->model('lead_tele_model');
		$this->load->library('pagination');


	}

	function managetelecalls($start=0)
	{
		$data = $this->path->all_path();
		if (!$this->tank_auth->is_admin_logged_in()) {
   
   redirect('admin/adminlogin/');
	} else {
	   $flag=0;
	  $data['username'] = $this->tank_auth->get_username();
	   $data['user_id'] = $this->tank_auth->get_admin_user_id();
	   $data['admin_user_level']=$this->tank_auth->get_admin_user_level();
		   //fetch user privilege data from model
	  if($flag==0)
	 {
	  $data['teleleads']=$this->lead_tele_model->tele_lead_users($start);
	  if ($this->input->post('ajax')) {
      $this->load->view('ajaxviews/admin_engage/manage_tele_leads', $data);
    } else {
	$this->load->view('admin/header', $data);
	  $this->load->view('admin/sidebar', $data); 
      $this->load->view('admin/leads/manage_tele_leads', $data);
    }
	 
	 }
		
		 
	}
	
	}
	
	function fetch_user_info_for_tele()
	{
	  $data = $this->path->all_path();
		if (!$this->tank_auth->is_admin_logged_in()) {
   
	   redirect('admin/adminlogin/');
		} else {
		   $flag=0;
		   $user_id=$this->input->post('id');
		   $data['username'] = $this->tank_auth->get_username();
		   $data['user_id'] = $this->tank_auth->get_admin_user_id();
		   $data['admin_user_level']=$this->tank_auth->get_admin_user_level();
		   $data['lead_info']=$this->lead_tele_model->lead_user_info($user_id);
		   $data['country_res']=$this->users->fetch_country();
		   //print_r( $data['lead_info']);
		   $view=$this->load->view('ajaxviews/admin_engage/edit_tele_user', $data,TRUE);
		   echo $view;
		 }
			
			 
	}
	

}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */