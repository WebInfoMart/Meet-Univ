<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Admin_counsellor extends CI_Controller
{
function __construct()
{
	parent::__construct();

	$this->load->helper('url');
	$this->load->library('tank_auth');
	$this->load->model('admin_counsellor_model');
	$this->load->model('lead_tele_model');
	$this->load->library('pagination');


}
function permotional_panel()
{
	$data = $this->path->all_path();
	if (!$this->tank_auth->is_admin_logged_in())
	{
		redirect('admin/adminlogin/');
	} 
	else
	{
		$this->load->view('admin/lead_counsellor/promotional',$data);
	}
}
function counsellor($start='0')
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
		
		//fetch user privilege data from model
		if($flag==0)
		{
			$data['verify_teleleads']=$this->admin_counsellor_model->c_manage_verify_teleleads($start);
			$data['country']=$this->admin_counsellor_model->country_model();
			$data['city']=$this->admin_counsellor_model->city_model();	
			if ($this->input->post('id'))
			{
				//$data['country']=$this->admin_counsellor_model->country_model();
				$data['state']=$this->admin_counsellor_model->state_model();
				//$data['city']=$this->admin_counsellor_model->city_model();				
				$data['program_parent']=$this->admin_counsellor_model->program_parent_model();
				$data['program_level']=$this->admin_counsellor_model->program_level();
				$this->load->view('admin/lead_counsellor/c_edit_lead_data',$data);				
			}
			else
			{
				$this->load->view('admin/header',$data);
				$this->load->view('admin/sidebar',$data);			
				$this->load->view('admin/lead_counsellor/counsellor',$data);
			} 
		}		
	}
}
function fetch_country()
{
	$data = $this->path->all_path();
	if (!$this->tank_auth->is_admin_logged_in())
	{
		redirect('admin/adminlogin/');
	} 
	else
	{
		$data['country']=$this->admin_counsellor_model->country_model();
	}
}
function fetch_state()
{
	$data = $this->path->all_path();
	if (!$this->tank_auth->is_admin_logged_in())
	{
		redirect('admin/adminlogin/');
	} 
	else
	{
		$data['state']=$this->admin_counsellor_model->state_model();
		
	}
}
function fetch_city()
{
	$data = $this->path->all_path();
	if (!$this->tank_auth->is_admin_logged_in())
	{
		redirect('admin/adminlogin/');
	} 
	else
	{
		$data['city']=$this->admin_counsellor_model->city_model();
	}
}
function city_list()
{
	$data = $this->path->all_path();
	if (!$this->tank_auth->is_admin_logged_in())
	{
		redirect('admin/adminlogin/');
	} 
	else
	{
		$data['region']=$this->admin_counsellor_model->city_list_model();
		$data['scid']=$this->input->post('sel_city_id');
		$this->load->view('ajaxviews/city_ajax',$data);
		
	}
}

function verified_lead()
{
	$data = $this->path->all_path();
	if (!$this->tank_auth->is_admin_logged_in())
	{
		redirect('admin/adminlogin/');
	} 
	else
	{
		$data=$this->admin_counsellor_model->verified_lead_model();
		echo $data;
	}
}	
function search_lead()
{
	$data = $this->path->all_path();
	if (!$this->tank_auth->is_admin_logged_in())
	{
		redirect('admin/adminlogin/');
	} 
	else
	{
		$data['verify_teleleads']=$this->admin_counsellor_model->search_lead_model();
		
		$this->load->view('admin/lead_counsellor/search_lead',$data);
	}
}	

	
}
