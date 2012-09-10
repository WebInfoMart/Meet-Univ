<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class adminarticles extends CI_Controller
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
			redirect('adminarticles/manage_articles');
			
		}	
	}
	
	function manage_articles($msg='')
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
			$data['msg']='Article Approved Successfully';
			$this->load->view('admin/userupdated', $data);
			}
			if($msg=='adas')
			{
			$data['msg']='Article DisApproved Successfully';
			$this->load->view('admin/userupdated', $data);
			}
			if($msg=='eas')
			{
			$data['msg']='Article Added Successfully';
			$this->load->view('admin/userupdated', $data);
			}
			if($msg=='fh')
			{
			$data['msg']='Article set as Home featured Successfully';
			$this->load->view('admin/userupdated', $data);
			}
			if($msg=='ufh')
			{
			$data['msg']='Article remove as Home featured Successfully';
			$this->load->view('admin/userupdated', $data);
			}
			if($msg=='fd')
			{
			$data['msg']='Article set as Study Abroad featured Successfully';
			$this->load->view('admin/userupdated', $data);
			}
			if($msg=='ufd')
			{
			$data['msg']='Article remove as Study Abroad featured Successfully';
			$this->load->view('admin/userupdated', $data);
			}
			if($msg=='eds')
			{
			$data['msg']='Article deleted Successfully';
			$this->load->view('admin/userupdated', $data);
			}
			if($msg=='eus')
			{
			$data['msg']='Article Updated Successfully';
			$this->load->view('admin/userupdated', $data);
			}
			$data['article_info']=$this->articlemodel->article_detail();
			$data['approved']=$this->input->post('approved');
			$this->load->view('admin/articles/manage_articles', $data);
			}
		}	
	}
	
	function add_article()
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
			$add_article=array('4','6','8','10');
			$flag=0;
			foreach($data['admin_priv'] as $userdata['admin_priv']){
			if($userdata['admin_priv']['privilege_type_id']==2 && in_array($userdata['admin_priv']['privilege_level'],$add_article) )
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
			/* $this->form_validation->set_rules('state', 'state', 'trim|xss_clean|required');
			$this->form_validation->set_rules('city', 'City', 'trim|required|string');
			$this->form_validation->set_rules('event_time', 'Event Time', 'trim|xss_clean|required');
			$this->form_validation->set_rules('detail', 'Detail', 'trim|string');
			$this->form_validation->set_rules('event_place', 'Event Place', 'trim|string');
			$this->form_validation->set_rules('event_timing', 'Event Time', 'trim|string'); */
			
			//$this->form_validation->set_rulesi('sub_domain', 'Sub Domain', 'xss_clean|alpha_dash|trim|required|string|is_unique[university.subdomain_name]');
			if ($this->form_validation->run()) {
			/* $datas = array(
			   'article_title' => $this->input->post('title'),
			   'article_detail' => $this->input->post('detail'),
			   'postedby' => $data['user_id'],
			   'article_univ_id' => $this->input->post('university'),
			   'article_image_path' => $image_data['file_name'],
			   'article_type_ud' => $this->input->post('article_type_ud')
			); */
			//print_r($datas);
			if(!$this->articlemodel->create_article())
			redirect('adminarticles/manage_articles/eas');
			}
			//fetch user privilege data from model
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
			$this->load->view('admin/articles/add_articles', $data);
			
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
	
	function delete_single_article($article_id)
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
		$admin_univ_id=$this->articlemodel->fetch_univ_id($data['user_id']);
		$article_list=$this->articlemodel->fetch_article_ids($admin_univ_id['univ_id']);
		if(!in_array($article_id,$article_list))
		{
			$f=0;
		}
		}
		if($f==1)
		{
		$this->articlemodel->delete_single_article($article_id);
		redirect('adminarticles/manage_articles/eds');
		}
		else
		{
		$this->load->view('admin/accesserror', $data);
		}
		}
	  }
	}
	
	function view_article($article_id)
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
		$admin_univ_id=$this->articlemodel->fetch_univ_id($data['user_id']);
		$article_list=$this->articlemodel->fetch_article_ids($admin_univ_id['univ_id']);
		if(!in_array($article_id,$article_list))
		{
			$f=0;
		}
		}
		if($f==1)
		{
		$data['article_info']=$this->articlemodel->fetch_article_detail($article_id);
		//$this->load->view('admin/event/view_event', $data);
		$this->load->view('admin/articles/view_article', $data);
		}
		else
		{
		$this->load->view('admin/accesserror', $data);
		}
		}
	  }
	}
	
	
	function edit_article($article_id)
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
		$edit_articles=array('3','6','7','10');
		$flag=0;
		foreach($data['admin_priv'] as $userdata['admin_priv']){
		if($userdata['admin_priv']['privilege_type_id']==2 && in_array($userdata['admin_priv']['privilege_level'],$edit_articles) )
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
		$admin_univ_id=$this->articlemodel->fetch_univ_id($data['user_id']);
		$article_list=$this->articlemodel->fetch_article_ids($admin_univ_id['univ_id']);
		if(!in_array($article_id,$article_list))
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
			$this->articlemodel->update_article($article_id);
			redirect('adminarticles/manage_articles/eus');
			}
		}
		$data['countries']=$this->users->fetch_country();
		$data['univ_info']=$this->events->get_univ_detail();
		$data['article_info']=$this->articlemodel->fetch_article_detail($article_id);
		$this->load->view('admin/articles/edit_article', $data);	
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
	 
	 function featured_unfeatured_article($f_status='',$article_id)
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
		$admin_univ_id=$this->articlemodel->fetch_univ_id($data['user_id']);
		$article_list=$this->articlemodel->fetch_events_ids($admin_univ_id['univ_id']);
		if(!in_array($article_id,$article_list))
		{
			$f=0;
		}
		}
		if($f==1)
		{
		$fu_status=$this->articlemodel->home_featured_unfeatured_article($f_status,$article_id);
		if($fu_status)
		{
		redirect('adminarticles/manage_articles/fh');
		}
		else
		{
		redirect('adminarticles/manage_articles/ufh');
		}
		}
		else
		{
		$this->load->view('admin/accesserror', $data);
		}	
		}
	  }
	}
	
	function count_featured_articles($field)
	 {
		$data['result']=$this->articlemodel->count_feature_article($field);
		$this->load->view('ajaxviews/check_unique_field',$data);
		
	 }
	 
	 function delete_articles()
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
		$this->articlemodel->delete_articles();
		redirect('adminarticles/manage_articles/eds');
		}
	  }
	}
	
	
	function approve_disapprove_article($approve_status='',$article_id)
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
		$fu_status=$this->articlemodel->approve_home_confirm($approve_status,$article_id);
		if($fu_status)
		{
		redirect('adminarticles/manage_articles/aas');
		}
		else
		{
		redirect('adminarticles/manage_articles/adas');
		}
		}
			
		}
	  }
	}

/* End of file auth.php */
/* Location: ./application/controllers/auth.php */