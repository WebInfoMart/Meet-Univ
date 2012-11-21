<?php if (!defined('BASEPATH')) exit('No direct script access allowed');
class emailpacks extends CI_Controller
{
	function __construct()
	{
		parent::__construct();
		$this->gallery_path = realpath(APPPATH . '../uploads/home_gallery');
		
		$this->ci =& get_instance();
		$this->ci->load->config('tank_auth', TRUE);		
		$this->load->helper(array('form', 'url'));
		$this->load->library('form_validation');
		$this->load->library('security');
		$this->load->library('tank_auth');
		$this->lang->load('tank_auth');
		$this->load->model('emailpacks_model');
	}
	
	function index()							//added by satbir
	{
		$data = $this->path->all_path();
		if (!$this->tank_auth->is_admin_logged_in()) {			
			redirect('admin/adminlogin/');
		}
		else {
			$data['user_id']	= $this->tank_auth->get_admin_user_id();
			$data['admin_user_level']=$this->tank_auth->get_admin_user_level();
			$data['admin_priv']=$this->adminmodel->get_user_privilege($data['user_id']);
			if(!($data['admin_priv'])){
				redirect('admin/adminlogout');
			}
			$this->load->view('univadmin/header',$data);
			$this->load->view('univadmin/sidebar',$data);
			if($data['admin_user_level']==3 || $data['admin_user_level']==5){
				$this->load->view('univadmin/engage/email_pack',$data);
			}
			else{
				$this->load->view('univadmin/accesserror',$data);
			}
		}
	}	
}

/* End of file auth.php */
/* Location: ./application/controllers/auth.php */