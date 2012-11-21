<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class News_article extends CI_Controller
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
			redirect('news_article/manage_news_article');
			
		}	
	}
	
	function manage_news_article($msg='')
	{
			$data = $this->path->all_path();
			$data['user_id']	= $this->tank_auth->get_admin_user_id();
			$data['admin_user_level']=$this->tank_auth->get_admin_user_level();
			$data['admin_priv']=$this->adminmodel->get_user_privilege($data['user_id']);
			//fetch user privilege data from model
			$this->load->view('admin/header', $data);
			$this->load->view('admin/sidebar', $data);
			$flag=0;
			foreach($data['admin_priv'] as $userdata['admin_priv']){
			if($userdata['admin_priv']['privilege_type_id']==2 && $userdata['admin_priv']['privilege_level']!=0 )
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
			$this->load->view('admin/userupdated', $data);
			}
	}
	
	function add_news_article()
	{
			$data = $this->path->all_path();
			$data['user_id']	= $this->tank_auth->get_admin_user_id();
			$data['admin_user_level']=$this->tank_auth->get_admin_user_level();
			$data['admin_priv']=$this->adminmodel->get_user_privilege($data['user_id']);
			//fetch user privilege data from model
			$this->load->view('admin/header', $data);
			$this->load->view('admin/sidebar', $data);
			$add_na=array('4','6','8','10');
			$flag=0;
			foreach($data['admin_priv'] as $userdata['admin_priv']){
			if($userdata['admin_priv']['privilege_type_id']==2 && in_array($userdata['admin_priv']['privilege_level'],$add_na) )
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
			$this->load->view('admin/news_article/add_news_article', $data);
			}
	}
	
	
}

/* End of file auth.php */
/* Location: ./application/controllers/auth.php */