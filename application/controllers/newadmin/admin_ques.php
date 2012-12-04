<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Admin_ques extends CI_Controller
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
		$this->load->library('email');
		$this->lang->load('tank_auth');
		$this->load->model('admin/ques_model');
		$this->load->model('frontmodel');
		$this->load->model('users');
	}

	/* function index()
	{
		$data = $this->path->all_path();
		if (!$this->tank_auth->is_admin_logged_in()) {
			redirect('admin/adminlogin/');
		} else {
			redirect('newadmin/admin_ques/manage_ques');
			
		}	
	} */
	//new
	function manage_ques($msg='')
	{
		if (!$this->tank_auth->is_admin_logged_in()) {
			redirect('admin/adminlogin');
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
			
			$this->load->view('univadmin/header', $data);
			$this->load->view('univadmin/sidebar', $data);
			
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
			$data['msg']='ques Approved Successfully';
			$this->load->view('univadmin/userupdated', $data);
			}
			if($msg=='adas')
			{
			$data['msg']='ques DisApproved Successfully';
			$this->load->view('univadmin/userupdated', $data);
			}
			if($msg=='eas')
			{
			$data['msg']='ques Added Successfully';
			$this->load->view('univadmin/userupdated', $data);
			}
			if($msg=='fh')
			{
			$data['msg']='ques set as Home featured Successfully';
			$this->load->view('univadmin/userupdated', $data);
			}
			if($msg=='ufh')
			{
			$data['msg']='ques remove as Home featured Successfully';
			$this->load->view('univadmin/userupdated', $data);
			}
			if($msg=='fd')
			{
			$data['msg']='ques set as Study Abroad featured Successfully';
			$this->load->view('univadmin/userupdated', $data);
			}
			if($msg=='ufd')
			{
			$data['msg']='ques remove as Study Abroad featured Successfully';
			$this->load->view('univadmin/userupdated', $data);
			}
			if($msg=='eds')
			{
			$data['msg']='ques deleted Successfully';
			$this->load->view('univadmin/userupdated', $data);
			}
			if($msg=='eus')
			{
			$data['msg']='ques Updated Successfully';
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
			$data['ques_info']=$this->ques_model->ques_detail();
			$data['latest_ques']=$this->ques_model->latest_ques();			
			$this->load->view('univadmin/ques/ques', $data);
			}
		}	
	}
	//new
	function add_ques()
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
			$add_ques=array('4','6','8','10');
			$flag=0;
			foreach($data['admin_priv'] as $userdata['admin_priv']){
			if($userdata['admin_priv']['privilege_type_id']==2 && in_array($userdata['admin_priv']['privilege_level'],$add_ques) )
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
			$created=$this->ques_model->create_ques();		
			echo $created;
			
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
	
	function delete_single_ques($ques_id)
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
		$admin_univ_id=$this->ques_model->fetch_univ_id($data['user_id']);
		$ques_list=$this->ques_model->fetch_ques_ids($admin_univ_id['univ_id']);
		if(!in_array($ques_id,$ques_list))
		{
			$f=0;
		}
		}
		if($f==1)
		{
		$del=$this->ques_model->delete_single_ques($ques_id);
		echo $del;
		//redirect('newadmin/admin_ques/manage_ques/eds');
		}
		
		}
	  }
	}
	
	function view_ques($ques_id)
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
		$this->load->view('univadmin/accesserror', $data);
		}
		else
		{
		{
		$f=1;
		if($data['admin_user_level']=='3')
		{
		$admin_univ_id=$this->quesmodel->fetch_univ_id($data['user_id']);
		$ques_list=$this->quesmodel->fetch_ques_ids($admin_univ_id['univ_id']);
		if(!in_array($ques_id,$ques_list))
		{
			$f=0;
		}
		}
		if($f==1)
		{
		$data['ques_info']=$this->quesmodel->fetch_ques_detail($ques_id);
		$data['ans_info']=$this->quesmodel->fetch_ques_ans($ques_id);
		//$this->load->view('admin/event/view_event', $data);
		$this->load->view('admin/Q&A/view_ques', $data);
		}
		else
		{
		$this->load->view('admin/accesserror', $data);
		}
		}
	  }
	}
	}
	//new
	function edit_ques($ques_id)
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
			if(!$this->input->post('ajax'))
			{
			$this->load->view('univadmin/header',$data);
			$this->load->view('univadmin/sidebar',$data);
			 }
			$edit_ques=array('3','6','7','10');
			$flag=0;
			foreach($data['admin_priv'] as $userdata['admin_priv'])
			{
				if($userdata['admin_priv']['privilege_type_id']==2 && in_array($userdata['admin_priv']['privilege_level'],$edit_ques) )
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
				$admin_univ_id=$this->ques_model->fetch_univ_id($data['user_id']);
				$ques_list=$this->ques_model->fetch_ques_ids($admin_univ_id['univ_id']);
				if(!in_array($ques_id,$ques_list))
				{
					$f=0;
				}
				}
				if($f=='1')
				{
					if($this->input->post('ajax'))
					{
					$updated=$this->ques_model->update_ques($ques_id);
					echo $updated;	
					}
					else
					{
						$data['countries']=$this->users->fetch_country();
						$data['univ_info']=$this->events->get_univ_detail();
						$data['ques_info']=$this->ques_model->fetch_ques_detail($ques_id);
						$data['ans_info']=$this->ques_model->fetch_ques_ans($ques_id);
						//print_r($data['ques_info']);exit;
						$this->load->view('univadmin/ques/view_question', $data);
					}					
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
	 function featured_unfeatured_ques($f_status='',$ques_id)
	{
		if (!$this->tank_auth->is_admin_logged_in()) {
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
					$admin_univ_id=$this->ques_model->fetch_univ_id($data['user_id']);
					$ques_list=$this->ques_model->fetch_events_ids($admin_univ_id['univ_id']);
					if(!in_array($ques_id,$ques_list))
					{
						$f=0;
					}
				}
				if($f==1)
				{
					$fu_status=$this->ques_model->home_featured_unfeatured_ques($f_status,$ques_id);
					echo $fu_status;			
				}
			
			}
		}
	}
	//new
	function count_featured_ques($field)
	 {
		$count=$this->ques_model->count_feature_ques($field);
		echo $count;
		//$this->load->view('ajaxviews/check_unique_field',$data);
		
	 }
	 
	 function delete_ques()
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
		$this->load->view('univadmin/accesserror', $data);
		}
		else if($flag==1)
		{
		$deleted=$this->ques_model->delete_ques();
		echo $deleted;
		}
	  }
	}
	
	//new
	function approve_disapprove_ques($approve_status='',$ques_id)
	{
		if (!$this->tank_auth->is_admin_logged_in()) {
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
				$fu_status=$this->ques_model->approve_home_confirm($approve_status,$ques_id);
				echo $fu_status;		
			}
				
		}
	}
	  //new
	function add_ans()
	{		if (!$this->tank_auth->is_admin_logged_in()) 
			{
				redirect('admin/adminlogin');
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
				$logged_in_user_id = $this->tank_auth->get_admin_user_id();	
				
				$info = $this->path->all_path();
				$info['url']=$this->input->post('que_url');				
				$commented_on_id=$this->input->post('id');
				
				$asked_by=$this->frontmodel->email_asked_by($commented_on_id);
				$asked_by_email=$asked_by[0]['email'];
				$asked_by_id=$asked_by[0]['id'];
				$asked_by_name=$asked_by[0]['fullname'];				
				
				$mail=$this->frontmodel->emailids_commented_on_ques($commented_on_id,$logged_in_user_id);
				echo $mail;
				$arr=array();
				foreach($mail as $email)
					{
						array_push($arr,$email['email']);
					}
				$askedby='';
				if(!in_array($asked_by[0]['email'],$arr))
					{//echo 'hello';exit;
						$askedby=$asked_by[0]['email'];
					}	
				$uid = $logged_in_user_id;
				$result= $this->users->get_username_by_userid($uid); 					  	  
				$info['fullname'] =$result['fullname'];	
					
				if(!empty($mail))
				{
				  foreach($mail as $email)
					{  
						if($email['email']!=$askedby)
						{							
							//echo $email['email'];					
					 
						 $info['username']=$email['fullname'];
						$email_body=$this->load->view('auth/email_templates/qna_comment_notification',$info,TRUE);
						
						$this->email->set_newline("\r\n");
						 $config['protocol'] = $this->config->item('mail_protocol');
						 $config['smtp_host'] = $this->config->item('smtp_server');
						 $config['smtp_user'] = $this->config->item('smtp_user_name');
						 $config['smtp_pass'] = $this->config->item('smtp_pass');
						 $this->email->initialize($config);    
						 $this->email->from('info@meetuniversities.com', 'MeetUniversities.com');						
						 $this->email->to($email['email']);				
						 $this->email->subject($result['fullname'].' Just commented on your thread');
						 $message = $email_body ;
						 $this->email->message($message);
						 $this->email->send();     
						}						 
					}
				}
				if($askedby!='' && $asked_by_id!=$logged_in_user_id)
				{
					//echo $askedby;
					
						 $info['username']=$asked_by_name;
						$email_body=$this->load->view('auth/email_templates/qna_comment_notification',$info,TRUE);
						
						$this->email->set_newline("\r\n");
						 $config['protocol'] = $this->config->item('mail_protocol');
						 $config['smtp_host'] = $this->config->item('smtp_server');
						 $config['smtp_user'] = $this->config->item('smtp_user_name');
						 $config['smtp_pass'] = $this->config->item('smtp_pass');
						 $this->email->initialize($config);    
						 $this->email->from('info@meetuniversities.com', 'MeetUniversities.com');						
						 $this->email->to($askedby);				
						 $this->email->subject($result['fullname'].' Just commented on your thread');
						 $message = $email_body ;
						 $this->email->message($message);
						 $this->email->send();   
				}
				$insert=$this->ques_model->addans();
				echo $insert;
			}	  
	}
//new	
function droprecord()
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
				$insert=$this->ques_model->dropans();	
				echo $insert;
			}
}	
//new
function edit_ans()
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
				$insert=$this->ques_model->edit_ans();	
				echo $insert;
			}
}
}
