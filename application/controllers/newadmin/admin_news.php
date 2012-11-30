<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Admin_news extends CI_Controller
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
		$this->load->model('admin/news_model');
	}

	/* function index()
	{
		$data = $this->path->all_path();
		if (!$this->tank_auth->is_admin_logged_in()) {
			redirect('admin/adminlogin/');
		} else {
			redirect('newadmin/admin_news/manage_news');
			
		}	
	} */
	
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
			$this->load->view('univadmin/header', $data);
			$this->load->view('univadmin/sidebar', $data);
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
			$this->load->view('univadmin/accesserror', $data);
			}
			else
			{
			if($msg=='aas')
			{
			$data['msg']='News Approved Successfully';
			$this->load->view('univadmin/userupdated', $data);
			}
			if($msg=='adas')
			{
			$data['msg']='News DisApproved Successfully';
			$this->load->view('univadmin/userupdated', $data);
			}
			if($msg=='eas')
			{
			$data['msg']='News Added Successfully';
			$this->load->view('univadmin/userupdated', $data);
			}
			if($msg=='fh')
			{
			$data['msg']='News set as Home featured Successfully';
			$this->load->view('univadmin/userupdated', $data);
			}
			if($msg=='ufh')
			{
			$data['msg']='News remove as Home featured Successfully';
			$this->load->view('univadmin/userupdated', $data);
			}
			if($msg=='fd')
			{
			$data['msg']='News set as Study Abroad featured Successfully';
			$this->load->view('univadmin/userupdated', $data);
			}
			if($msg=='ufd')
			{
			$data['msg']='News remove as Study Abroad featured Successfully';
			$this->load->view('univadmin/userupdated', $data);
			}
			if($msg=='eds')
			{
			$data['msg']='News deleted Successfully';
			$this->load->view('univadmin/userupdated', $data);
			}
			if($msg=='eus')
			{
			$data['msg']='News Updated Successfully';
			$this->load->view('univadmin/userupdated', $data);
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
			$data['news_info']=$this->news_model->news_detail();
			$data['latest_news']=$this->news_model->latest_news();			
			$this->load->view('univadmin/news/news', $data);
			}
		}	
	}
	//new
	function add_news()
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
			$add_news=array('4','6','8','10');
			$flag=0;
			foreach($data['admin_priv'] as $userdata['admin_priv']){
			if($userdata['admin_priv']['privilege_type_id']==2 && in_array($userdata['admin_priv']['privilege_level'],$add_news) )
			{
			$flag=1;
			break;
			}
			}
			if($flag==0)
			{
			$this->load->view('univadmin/accesserror', $data);
			}
			else
			{				
			$inserted=$this->news_model->create_news();
			if($inserted=='1')
			{
				redirect('newadmin/admin_news/manage_news/eas');
			}			
			
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
	
	function delete_single_news($news_id)
	{
		if (!$this->tank_auth->is_admin_logged_in()) 
		{
			redirect('admin/adminlogin/');
		}
		else
		{
		$data = $this->path->all_path();
		$data['user_id']	= $this->tank_auth->get_admin_user_id();
		$data['admin_user_level']=$this->tank_auth->get_admin_user_level();
		$data['admin_priv']=$this->adminmodel->get_user_privilege($data['user_id']);
		if(!($data['admin_priv']))
		{
			redirect('admin/adminlogout');
		}
		//$this->load->view('univadmin/header',$data);
		//$this->load->view('univadmin/sidebar',$data);
		$flag=0;
		$delete_events=array('5','7','8','10');
		foreach($data['admin_priv'] as $userdata['admin_priv']){
		if($userdata['admin_priv']['privilege_type_id']==2 && in_array($userdata['admin_priv']['privilege_level'],$delete_events))
		{
		$flag=1;
		break;
		}
		}
		if($flag==0)
		{
		$this->load->view('univadmin/accesserror', $data);
		}
		else
		{
		$f=1;
		if($data['admin_user_level']=='3')
		{
		$admin_univ_id=$this->news_model->fetch_univ_id($data['user_id']);
		$news_list=$this->news_model->fetch_news_ids($admin_univ_id['univ_id']);
		if(!in_array($news_id,$news_list))
		{
			$f=0;
		}
		}
		if($f==1)
		{
			$deleted=$this->news_model->delete_single_news($news_id);
			echo $deleted;
		//redirect('newadmin/admin_news/manage_news/eds');
		}
		else
		{
		$this->load->view('univadmin/accesserror', $data);
		}
		}
	  }
	}
	
	function view_news($news_id)
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
		$this->load->view('univadmin/header',$data);
		$this->load->view('univadmin/sidebar',$data);
		$flag=0;
		foreach($data['admin_priv'] as $userdata['admin_priv']){
		if($userdata['admin_priv']['privilege_type_id']==2 && $userdata['admin_priv']['privilege_level']>0)
		{
		$flag=1;
		break;
		}
		}
		if($flag==0)
		{
		$this->load->view('univadmin/accesserror', $data);
		}
		else
		{
		$f=1;
		if($data['admin_user_level']=='3')
		{
		$admin_univ_id=$this->news_model->fetch_univ_id($data['user_id']);
		$news_list=$this->news_model->fetch_news_ids($admin_univ_id['univ_id']);
		if(!in_array($news_id,$news_list))
		{
			$f=0;
		}
		}
		if($f==1)
		{
		$data['news_info']=$this->news_model->fetch_news_detail($news_id);
		//$this->load->view('admin/event/view_event', $data);
		$this->load->view('univadmin/news/view_news', $data);
		}
		else
		{
		$this->load->view('univadmin/accesserror', $data);
		}
		}
	  }
	}
	
	//new
	function edit_news($news_id)
	{
		if (!$this->tank_auth->is_admin_logged_in()) 
		{
			redirect('admin/adminlogin/');
		}
		else
		{
		$data = $this->path->all_path();
		$data['user_id']	= $this->tank_auth->get_admin_user_id();
		$data['admin_user_level']=$this->tank_auth->get_admin_user_level();
		$data['admin_priv']=$this->adminmodel->get_user_privilege($data['user_id']);
		if(!($data['admin_priv']))
		{
			redirect('admin/adminlogout');
		}
		$this->load->view('univadmin/header',$data);
		$this->load->view('univadmin/sidebar',$data);
		$edit_news=array('3','6','7','10');
		$flag=0;
		foreach($data['admin_priv'] as $userdata['admin_priv']){
		if($userdata['admin_priv']['privilege_type_id']==2 && in_array($userdata['admin_priv']['privilege_level'],$edit_news) )
		{
		$flag=1;
		break;
		}
		}
		if($flag==0)
		{
		$this->load->view('univadmin/accesserror', $data);
		}
		else
		{
		$f=1;
		if($data['admin_user_level']=='3')
		{
		$admin_univ_id=$this->news_model->fetch_univ_id($data['user_id']);
		$news_list=$this->news_model->fetch_news_ids($admin_univ_id['univ_id']);
		if(!in_array($news_id,$news_list))
		{
			$f=0;
		}
		}
		if($f==1)
		{
			if($this->input->post('submit'))
			{
				$this->news_model->update_news($news_id);
				redirect('newadmin/admin_news/manage_news/eus');				
		    }
			$data['countries']=$this->users->fetch_country();
			$data['univ_info']=$this->events->get_univ_detail();
			$data['news_info']=$this->news_model->fetch_news_detail($news_id);
			//print_r($data['news_info']);exit;
			$this->load->view('univadmin/news/edit_news', $data);	
		}
		else
		{
			$this->load->view('univadmin/accesserror', $data);
		}
		}
		}
	  }	
	 
	 function count_featured_events($field)
	 {
		$data['result']=$this->events->count_feature_event($field);
		$this->load->view('ajaxviews/check_unique_field',$data);
		
	 }
	 //new
	function featured_unfeatured_news($f_status='',$news_id)
	{
		if (!$this->tank_auth->is_admin_logged_in())
		{
			redirect('admin/adminlogin/');
		}
		else
		{
			$data = $this->path->all_path();
			$data['user_id']	= $this->tank_auth->get_admin_user_id();
			$data['admin_user_level']=$this->tank_auth->get_admin_user_level();
			$data['admin_priv']=$this->adminmodel->get_user_privilege($data['user_id']);
			if(!($data['admin_priv']))
			{
				redirect('admin/adminlogout');
			}
			//$this->load->view('univadmin/header',$data);
			//$this->load->view('univadmin/sidebar',$data);
			$flag=0;
			foreach($data['admin_priv'] as $userdata['admin_priv'])
			{
				if($userdata['admin_priv']['privilege_type_id']==2 && $userdata['admin_priv']['privilege_level']>1 )
				{
					$flag=1;
					break;
				}
			}
			if($flag==0)
			{
				$this->load->view('univadmin/accesserror', $data);
			}
			else
			{
				$f=1;
				if($data['admin_user_level']=='3')
				{
					$admin_univ_id=$this->news_model->fetch_univ_id($data['user_id']);
					$news_list=$this->news_model->fetch_news_ids($admin_univ_id['univ_id']);
					if(!in_array($news_id,$news_list))
					{
						$f=0;
					}
				}
				if($f==1)
				{
					$fu_status=$this->news_model->home_featured_unfeatured_news($f_status,$news_id);
					echo $fu_status;		
				}
				else
				{
					$this->load->view('univadmin/accesserror', $data);
				}	
			}
		}
	}
	
	function count_featured_news($field)
	 {
		$data['result']=$this->news_model->count_feature_news($field);
		$this->load->view('ajaxviews/check_unique_field',$data);
		
	 }
	 //new
	 function delete_news()
	{
		if (!$this->tank_auth->is_admin_logged_in()) 
		{
			redirect('admin/adminlogin/');
		}
		else
		{
			$data = $this->path->all_path();
			$data['user_id']	= $this->tank_auth->get_admin_user_id();
			$data['admin_user_level']=$this->tank_auth->get_admin_user_level();
			$data['admin_priv']=$this->adminmodel->get_user_privilege($data['user_id']);
			if(!($data['admin_priv']))
			{
				redirect('admin/adminlogout');
			}
			$delete_user_priv=array('5','7','8','10');
			$flag=0;
			foreach($data['admin_priv'] as $userdata['admin_priv'])
			{
				if($userdata['admin_priv']['privilege_type_id']==2 && in_array($userdata['admin_priv']['privilege_level'],$delete_user_priv))
				{
					$flag=1;
					break;
				}
			}
			if($flag==0)
			{
				echo 0;
			}
			else if($flag==1)
			{
				$deleted=$this->news_model->delete_news();
				echo $deleted;
			}
	  }
	}
	
	//new
	function approve_disapprove_news($approve_status='',$news_id)
	{
		if (!$this->tank_auth->is_admin_logged_in()) 
		{
			redirect('admin/adminlogin/');
		}
		else
		{
			$data = $this->path->all_path();
			$data['user_id']	= $this->tank_auth->get_admin_user_id();
			$data['admin_user_level']=$this->tank_auth->get_admin_user_level();
			$data['admin_priv']=$this->adminmodel->get_user_privilege($data['user_id']);
			if(!($data['admin_priv']))
			{
				redirect('admin/adminlogout');
			}
			//$this->load->view('univadmin/header',$data);
			//$this->load->view('univadmin/sidebar',$data);
			$flag=0;
			foreach($data['admin_priv'] as $userdata['admin_priv'])
			{
				if($userdata['admin_priv']['privilege_type_id']==2 && $userdata['admin_priv']['privilege_level']>1 )
				{
					$flag=1;
					break;
				}
			}
			if($flag==0)
			{
				$this->load->view('univadmin/accesserror', $data);
			}
			else
			{
				$fu_status=$this->news_model->approve_home_confirm($approve_status,$news_id);
				echo $fu_status;		
			}
			
		}
	}
}

/* End of file auth.php */
/* Location: ./application/controllers/auth.php */