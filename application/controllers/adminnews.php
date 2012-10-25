<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class adminnews extends CI_Controller
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
		$this->load->model('newsmodel');
	}

	function index()
	{
		$data = $this->path->all_path();
		if (!$this->tank_auth->is_admin_logged_in()) {
			redirect('admin/adminlogin/');
		} else {
			redirect('adminnews/manage_news');
			
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
			$this->load->view('admin/accesserror', $data);
			}
			else
			{
			if($this->input->post('submit'))
			{
			$this->form_validation->set_rules('title', 'Title', 'trim|required');
			$this->form_validation->set_rules('university', 'University', 'trim|required|xss_clean');
			$this->form_validation->set_rules('detail', 'Detail', 'trim|xss_clean|required');			
			if ($this->form_validation->run()) {			
			if($this->newsmodel->create_news())
			redirect('adminnews/manage_news/eas');
			}			
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
			$this->load->view('admin/header', $data);
			$this->load->view('admin/sidebar', $data);	
			$this->load->view('admin/news/add_news', $data);
			
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
		$this->load->view('admin/accesserror', $data);
		}
		else
		{
		$f=1;
		if($data['admin_user_level']=='3')
		{
		$admin_univ_id=$this->newsmodel->fetch_univ_id($data['user_id']);
		$news_list=$this->newsmodel->fetch_news_ids($admin_univ_id['univ_id']);
		if(!in_array($news_id,$news_list))
		{
			$f=0;
		}
		}
		if($f==1)
		{
		$this->newsmodel->delete_single_news($news_id);
		redirect('adminnews/manage_news/eds');
		}
		else
		{
		$this->load->view('admin/accesserror', $data);
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
		$this->load->view('admin/header',$data);
		$this->load->view('admin/sidebar',$data);
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
		$this->load->view('admin/accesserror', $data);
		}
		else
		{
		$f=1;
		if($data['admin_user_level']=='3')
		{
		$admin_univ_id=$this->newsmodel->fetch_univ_id($data['user_id']);
		$news_list=$this->newsmodel->fetch_news_ids($admin_univ_id['univ_id']);
		if(!in_array($news_id,$news_list))
		{
			$f=0;
		}
		}
		if($f==1)
		{
		$data['news_info']=$this->newsmodel->fetch_news_detail($news_id);
		//$this->load->view('admin/event/view_event', $data);
		$this->load->view('admin/news/view_news', $data);
		}
		else
		{
		$this->load->view('admin/accesserror', $data);
		}
		}
	  }
	}
	
	
	function edit_news($news_id)
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
		$this->load->view('admin/accesserror', $data);
		}
		else
		{
		$f=1;
		if($data['admin_user_level']=='3')
		{
		$admin_univ_id=$this->newsmodel->fetch_univ_id($data['user_id']);
		$news_list=$this->newsmodel->fetch_news_ids($admin_univ_id['univ_id']);
		if(!in_array($news_id,$news_list))
		{
			$f=0;
		}
		}
		if($f=='1')
		{
			if($this->input->post('submit'))
			{
			$this->form_validation->set_rules('title', 'Title', 'trim|required');
			$this->form_validation->set_rules('university', 'University', 'trim|required|xss_clean');
			$this->form_validation->set_rules('detail', 'Detail', 'trim|string');
			
			//$this->form_validation->set_rulesi('sub_domain', 'Sub Domain', 'xss_clean|alpha_dash|trim|required|string|is_unique[university.subdomain_name]');
			if ($this->form_validation->run()) {
			if($this->newsmodel->update_news($news_id))
			redirect('adminnews/manage_news/eus');
			}
		    }
		$data['countries']=$this->users->fetch_country();
		$data['univ_info']=$this->events->get_univ_detail();
		$data['news_info']=$this->newsmodel->fetch_news_detail($news_id);
		//print_r($data['news_info']);exit;
		$this->load->view('admin/news/edit_news', $data);	
		}
		else
		{
		$this->load->view('admin/accesserror', $data);
		}
		}
		}
	  }	
	 
	 function count_featured_events($field)
	 {
		$data['result']=$this->events->count_feature_event($field);
		$this->load->view('ajaxviews/check_unique_field',$data);
		
	 }
	 
	 function featured_unfeatured_news($f_status='',$news_id)
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
		if($userdata['admin_priv']['privilege_type_id']==2 && $userdata['admin_priv']['privilege_level']>1 && $data['admin_user_level']!='3')
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
		$admin_univ_id=$this->newsmodel->fetch_univ_id($data['user_id']);
		$news_list=$this->newsmodel->fetch_news_ids($admin_univ_id['univ_id']);
		if(!in_array($news_id,$news_list))
		{
			$f=0;
		}
		}
		if($f==1)
		{
		$fu_status=$this->newsmodel->home_featured_unfeatured_news($f_status,$news_id);
		if($fu_status)
		{
		redirect('adminnews/manage_news/fh');
		}
		else
		{
		redirect('adminnews/manage_news/ufh');
		}
		}
		else
		{
		$this->load->view('admin/accesserror', $data);
		}	
		}
	  }
	}
	
	function count_featured_news($field)
	 {
		$data['result']=$this->newsmodel->count_feature_news($field);
		$this->load->view('ajaxviews/check_unique_field',$data);
		
	 }
	 
	 function delete_news()
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
		$delete_user_priv=array('5','7','8','10');
		$flag=0;
		foreach($data['admin_priv'] as $userdata['admin_priv']){
		if($userdata['admin_priv']['privilege_type_id']==2 && in_array($userdata['admin_priv']['privilege_level'],$delete_user_priv))
		{
		$flag=1;
		break;
		}
		}
		if($flag==0)
		{
		$this->load->view('admin/accesserror', $data);
		}
		else if($flag==1)
		{
		$this->newsmodel->delete_news();
		redirect('adminnews/manage_news/eds');
		}
	  }
	}
	
	
	function approve_disapprove_news($approve_status='',$news_id)
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
		if($userdata['admin_priv']['privilege_type_id']==2 && $userdata['admin_priv']['privilege_level']>1 && $data['admin_user_level']!='3')
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
		$fu_status=$this->newsmodel->approve_home_confirm($approve_status,$news_id);
		if($fu_status)
		{
		redirect('adminnews/manage_news/aas');
		}
		else
		{
		redirect('adminnews/manage_news/adas');
		}
		}
			
		}
	  }
	}

/* End of file auth.php */
/* Location: ./application/controllers/auth.php */