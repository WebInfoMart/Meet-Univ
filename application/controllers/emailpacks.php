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

	function index()
	{
		$data = $this->path->all_path();
		if (!$this->tank_auth->is_admin_logged_in()) {
			redirect('admin/adminlogin/');
		} else {
			redirect('emailpacks/managenews');
			
		}	
	}
	
	function manage_news($msg='')
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
			if($this->input->post('ajax')!='1')
			{
			$this->load->view('admin/header', $data);
			$this->load->view('admin/sidebar', $data);
			}
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
			if($msg=='aas')
			{
			$data['msg']='News Approved Successfully';
			$this->load->view('admin/userupdated', $data);
			}
			if($msg=='adas')
			{
			$data['msg']='News DisApproved Successfully';
			$this->load->view('admin/userupdated', $data);
			}
			if($msg=='eas')
			{
			$data['msg']='News Added Successfully';
			$this->load->view('admin/userupdated', $data);
			}
			if($msg=='fh')
			{
			$data['msg']='News set as Home featured Successfully';
			$this->load->view('admin/userupdated', $data);
			}
			if($msg=='ufh')
			{
			$data['msg']='News remove as Home featured Successfully';
			$this->load->view('admin/userupdated', $data);
			}
			if($msg=='fd')
			{
			$data['msg']='News set as Study Abroad featured Successfully';
			$this->load->view('admin/userupdated', $data);
			}
			if($msg=='ufd')
			{
			$data['msg']='News remove as Study Abroad featured Successfully';
			$this->load->view('admin/userupdated', $data);
			}
			if($msg=='eds')
			{
			$data['msg']='News deleted Successfully';
			$this->load->view('admin/userupdated', $data);
			}
			if($msg=='eus')
			{
			$data['msg']='News Updated Successfully';
			$this->load->view('admin/userupdated', $data);
			}
			$data['news_info']=$this->newsmodel->news_detail();			
			$data['approved']=$this->input->post('approved');
			$data['featured']=$this->input->post('featured');
			$data['sel_id']=$this->input->post('sel_id');  
			$data['search_box']= $this->input->post('search_box');  
			$this->load->view('admin/news/manage_news', $data);
			}
		}	
	}
	
	function add_packs()
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
				if($this->input->post('ajax')!='1')
				{
				$this->load->view('admin/header',$data);
				$this->load->view('admin/sidebar',$data);
				$this->load->view('admin/emailpacks/add_packs');
				}
				if($this->input->post('ajax')=='1')
				{echo 'hello';exit;
					$created=$this->emailpacks_model->create_new();
					if($created==1)
					{
						echo 1;
					}
				}
			}
			
				
		}
	}
	function add_promocode()
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
				if($this->input->post('ajax')!='1')
				{
				$this->load->view('admin/header',$data);
				$this->load->view('admin/sidebar',$data);
				$this->load->view('admin/emailpacks/promocode');
				}
				if($this->input->post('ajax')=='1')
				{
					$created=$this->emailpacks_model->create_promocode();
					echo $created; 
				}
			}
			
				
		}
	}
	function viewplans()
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
				$this->load->view('admin/header',$data);
				$this->load->view('admin/sidebar',$data);
				$data['packs']=$this->emailpacks_model->fetchemail_plans();				
				$this->load->view('admin/emailpacks/viewplans',$data);
				
			}
	}
	}
	function purchase()
	{
		$data = $this->path->all_path();
		if (!$this->tank_auth->is_admin_logged_in()) {
			redirect('admin/adminlogin/');
		} 
		else 
		{
			$data['user_id']= $this->tank_auth->get_admin_user_id();
			$data['admin_user_level']=$this->tank_auth->get_admin_user_level();
			$data['admin_priv']=$this->adminmodel->get_user_privilege($data['user_id']);
			if(!($data['admin_priv']))
			{
			redirect('admin/adminlogout');
			}
			else
			{
				
				$inserted=$this->emailpacks_model->purchase_pack($data['user_id']);				
				echo $inserted;
				
			}
		}
	}
	
	function user_email_packs()
	{
		$data = $this->path->all_path();
		if (!$this->tank_auth->is_admin_logged_in()) {
			redirect('admin/adminlogin/');
		} 
		else 
		{
			$data['user_id']= $this->tank_auth->get_admin_user_id();
			$data['admin_user_level']=$this->tank_auth->get_admin_user_level();
			$data['admin_priv']=$this->adminmodel->get_user_privilege($data['user_id']);
			if(!($data['admin_priv']))
			{
			redirect('admin/adminlogout');
			}
			else
			{
				$this->load->view('admin/header',$data);
				$this->load->view('admin/sidebar',$data);
				$data['email_packs']=$this->emailpacks_model->user_packs($data['user_id']);
				$this->load->view('admin/emailpacks/useremail_packs',$data);
			}
		}
	}
}

/* End of file auth.php */
/* Location: ./application/controllers/auth.php */