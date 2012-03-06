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
		$this->load->view('auth/header',$data);
		if (!$this->tank_auth->is_logged_in()) {
			redirect('/auth/login/');
		} else {
			$data['user_id']	= $this->tank_auth->get_user_id();
			$data['username']	= $this->tank_auth->get_username();
			$logged_user = $data['user_id'];
			$this->load->model('users');
			$data2['query'] = $this->users->fetch_all_data($logged_user);
			$this->load->view('welcome',$data2);
			//$this->load->view('welcome', $data);
		}
		$this->load->view('auth/footer',$data);
	}
	// function fetch_data($logged_user)
	// {
		// $logged_user = $data['user_id'];
			// $this->load->model('users');
			// $data2['query'] = $this->users->fetch_all_data($logged_user);
			//$this->load->view('welcome',$data);
			// $this->load->view('welcome', $data2);
	// }
}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */