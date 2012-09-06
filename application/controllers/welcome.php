<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Welcome extends CI_Controller
{
	function __construct()
	{
		parent::__construct();

		$this->load->helper('url');
		$this->load->library('tank_auth');
	}

	function index()
	{
		$data = $this->path->all_path();
  //$this->load->view('auth/header',$data);
  //$this->load->view('auth/footer',$data);
  if (!$this->tank_auth->is_admin_logged_in()) {
   
   redirect('admin/adminlogin/');
  } else {
	   $flag=0;
	   $data['username'] = $this->tank_auth->get_username();
	   $data['user_id'] = $this->tank_auth->get_admin_user_id();
	   $data['admin_user_level']=$this->tank_auth->get_admin_user_level();
		   //fetch user privilege data from model
		   $this->load->view('admin/header', $data);
	 if($flag==0)
	 {
	  $this->load->view('admin/sidebar', $data); 
	 }
	 $this->load->view('admin/main', $data);
		 
	}
	
	}

}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */