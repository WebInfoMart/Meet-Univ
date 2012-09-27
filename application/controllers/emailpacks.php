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
	
	function manage_packs($msg='')
	{
		if (!$this->tank_auth->is_admin_logged_in()) {
			redirect('admin/adminlogin/');
		}
		else {	
			$data = $this->path->all_path();
			$data['user_id']= $this->tank_auth->get_admin_user_id();
			$data['admin_user_level']=$this->tank_auth->get_admin_user_level();
			$data['admin_priv']=$this->adminmodel->get_user_privilege($data['user_id']);
			if(!($data['admin_priv']))
			{
			redirect('admin/adminlogout');
			}
			if($msg=='uds')
			{
			$data['msg']='Pack Deleted Successfully';
			$this->load->view('admin/userupdated',$data);
			}
			if($msg=='edt')
			{
				$data['msg']='Pack Updated Successfully';
				$this->load->view('admin/userupdated',$data);
			}
			
			//fetch user privilege data from model
			if($this->input->post('ajax')!='1')
			{
			$this->load->view('admin/header', $data);
			$this->load->view('admin/sidebar', $data);
			}
			$data['email_packs']=$this->emailpacks_model->manage_packs_model();
			$this->load->view('admin/emailpacks/manage_packs', $data);
			
		}	
	}
	
	function add_packs()
	{
		$data = $this->path->all_path();
		if (!$this->tank_auth->is_admin_logged_in()) {
			redirect('admin/adminlogin/');
		} else {
			$data['user_id']= $this->tank_auth->get_admin_user_id();
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
				{
					$created=$this->emailpacks_model->create_new();
					if($created==1)
					{
						redirect('emailpacks/manage_packs');
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
	function add_promo()
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
							
				$promo=$this->emailpacks_model->new_promo($data['user_id']);
				if($promo)
				{
					echo $promo;
				}
				else
				{
					echo 0;
				}
			}
		}
	}
	function delete_pack($id='')
	{
		$delete=$this->emailpacks_model->delete_email_pack($id);
		if($delete)
		{
			redirect('emailpacks/manage_packs');
		}
	}
	function update_email_pack($id='')
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
				
				if($this->input->post('ajax')=='1')
				{
					$result=$this->emailpacks_model->email_pack_edit($id);
					echo $result;
				}
				else
				{
				$this->load->view('admin/header',$data);
					$this->load->view('admin/sidebar',$data);
				$data['pack']=$this->emailpacks_model->email_pack_update($id);
				$this->load->view('admin/emailpacks/edit_pack',$data);
				}
			
		
			}
		}
	}
	
}

/* End of file auth.php */
/* Location: ./application/controllers/auth.php */