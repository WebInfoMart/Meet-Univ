<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Admin_engagement extends CI_Controller
{
	function __construct()
	{
		parent::__construct();

		$this->load->helper('url');
		$this->load->library('tank_auth');
		$this->load->model('engagement_panel');
		$this->load->model('adminmodel');
	}

	function index()
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
		$this->load->view('admin/header',$data);
		$this->load->view('admin/sidebar',$data);
		if($data['admin_user_level']==3 || $data['admin_user_level']==5)
		{
		 $univ=$this->engagement_panel->fetch_univ_detail($data['user_id']);
		 $u_id=$univ[0]['univ_id']; 
		 $data['u_id']=$u_id;
		 $data['type_info']=$this->engagement_panel->count_students_type($u_id);
		 $data['recent_leads']=$this->engagement_panel->recent_leads();
		 $data['count']=$this->engagement_panel->count_students_in_univ($u_id);
		 $data['city_wise']=$this->engagement_panel->count_univ_event_citywise($u_id);
		 $max=date('m');
		 $min=$max-6;
			for($i=$min;$i<$max;$i++)
			{
				$data['type_count'][$i]=$this->engagement_panel->month_event_count_model($u_id,$i);		
			}			
		 
		 $this->load->view('admin/engage/engagement',$data);
		}
		else
		{
		$this->load->view('admin/accesserror',$data);
		}
		}
	}
function city_events()
	{
		$data = $this->path->all_path();
		if (!$this->tank_auth->is_admin_logged_in()) 
		{   
		 echo 'logout';
		} 
		else
		{
			$result['city_event']=$this->engagement_panel->city_events_model();
			//print_r($result['city_event']);
			$this->load->view('admin/engage/city_events_detail',$result);
		}
	
	}
	
function city_students($start='',$end='')
	{
		$data = $this->path->all_path();
		if (!$this->tank_auth->is_admin_logged_in()) 
		{   
			echo 'logout';
		} 
		else
		{
			if($this->input->post('more'))
			{
			  $start=0;
			  $end=$this->input->post('end');
				$end=$end+5;
				$result['end']=$end;
				$result['id']=$this->input->post('event_id');
			  $result['event_stud']=$this->engagement_panel->cityevents_stud_model($start,$end);
				$total=$this->engagement_panel->cityevents_stud_count();
			  if($total-$end==0)
			  {
				$result['dact_more']='nomore';
			  }
			  else
			  {
				$result['dact_more']='';
			  }			  
			}
			else
			{
				$start=0;
				$end=5;
				$result['end']=$end;
				$result['id']=$this->input->post('event_id');				
				$result['event_stud']=$this->engagement_panel->cityevents_stud_model($start,$end);
				$total=$this->engagement_panel->cityevents_stud_count();
			  if($total-$end<=0)
			  {
				$result['dact_more']='nomore';
			  }
			  else
			  {
				$result['dact_more']='';
			  }

			}
							
			//print_r($result['city_event']);
			$this->load->view('admin/engage/event_student_detail',$result);
		}
	
	}
	
	
}
