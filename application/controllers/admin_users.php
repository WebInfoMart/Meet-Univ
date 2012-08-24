<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Admin_users extends CI_Controller
{
	function __construct()
	{
		parent::__construct();
		$this->gallery_path = realpath(APPPATH . '../uploads/home_gallery');
		$this->excel_path = realpath(APPPATH . '../uploads/Excel');
		$this->xsl_path = realpath(APPPATH . '../uploads');
		
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
			redirect('admincourses/manage_courses');
			
		}	
	}
	
	function map_univ_vs_users($msg='')
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
			$this->load->view('admin/header', $data);
			$this->load->view('admin/sidebar', $data);
			if($data['admin_user_level']=='5')
			{
			if($msg=='ucus')
			{
			$data['msg']='Selcted universities Maped Sucessfully with selected users';
			$this->load->view('admin/userupdated',$data);
			}
			
			//$data['course_info']=$this->courses->program_info();
			$data['users_info']=$this->univ_vs_user_model->get_univ_user_info();
			//print_r($data['users_info']);
			$data['univ_info']=$this->univ_vs_user_model->fetch_univ_user_universities();
			if($this->input->post('submit'))
			{
			$this->form_validation->set_rules('users', 'User', 'trim|required');
			if ($this->form_validation->run()) {
			$this->univ_vs_user_model->insert_univ_user_data();
			redirect('admin_users/map_univ_vs_users/ucus');
			}
			}
			$this->load->view('admin/univ_vs_users/map_univ_vs_users',$data);	
			}
			else
			{
			$this->load->view('admin/accesserror',$data);
			}
			
		}
	}
	
	function manage_map_univ_vs_users($msg='')
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
			$this->load->view('admin/header', $data);
			$this->load->view('admin/sidebar', $data);
			if($data['admin_user_level']=='5')
			{
			if($msg=='ucus')
			{
			$data['msg']='Selcted universities Maped Sucessfully with selected users';
			$this->load->view('admin/userupdated',$data);
			}
			
			//$data['course_info']=$this->courses->program_info();
			$data['users_info']=$this->univ_vs_user_model->get_univ_user_info_already_maped();
			//print_r($data['users_info']);
			$data['univ_info']=$this->univ_vs_user_model->fetch_univ_user_universities();
			if($this->input->post('submit'))
			{
			$this->univ_vs_user_model->update_univ_user_map_data();
			redirect('admin_users/manage_map_univ_vs_users/ucus');
			}
			$this->load->view('admin/univ_vs_users/manage_map_univ_vs_users',$data);	
			}
			else
			{
			$this->load->view('admin/accesserror',$data);
			}
			}
		

	}
	
	function fetch_univ_maped_with_user_ajax()
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
			else
			{
			if($data['admin_user_level']=='5')
			{
			$user_id=$this->input->post('user_id');
			$data['univ_info']=$this->univ_vs_user_model->manage_fetch_univ_user_universities($user_id);
			$data['univ_user_mapped_info']=$this->univ_vs_user_model->get_mapped_univ_info($user_id);
			$this->load->view('ajaxviews/manage_map_univ_vs_users_ajax',$data);	
			}
			}
			
			
		}
	  
	}
	
}

/* End of file auth.php */
/* Location: ./application/controllers/auth.php */