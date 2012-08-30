<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Admin_promotional extends CI_Controller
{
	function __construct()
	{
		parent::__construct();

		$this->load->helper('url');
		$this->load->library('tank_auth');
		$this->load->model('promotional_panel');
	}

	function index()
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
		$this->load->view('admin/header',$data);
		$this->load->view('admin/sidebar',$data);
		if($data['admin_user_level']==3 || $data['admin_user_level']==5)
		{
		 $data['total_student']=$this->promotional_panel->count_total_student_in_portal();
		 $data['country_list']=$this->promotional_panel->show_country_list();
		 $data['all_cities']=$this->promotional_panel->fetch_all_cities();
		 $this->load->view('admin/promotional/promotional',$data);
		}
		else
		{
		$this->load->view('admin/accesserror',$data);
		}
		}
	}
	
	function count_student_change_wise($change)
	{
	 $country=$this->input->post('country_id');
	 $city=$this->input->post('city_id');
	 $educ_lvl=$this->input->post('educ_level');
	 $c_where=array();
	 if($change=='country')
	 {
	 $count=$this->promotional_panel->total_student_in_country($country);
	 $city_list=$this->promotional_panel->fetch_cities_having_country($country);
	 $educ_in_country=$this->promotional_panel->total_student_in_ug($country,$educ_lvl);
	 echo $city_list.'!@#$%'.$count.'!@#$%'.$educ_in_country;
	 }
	 else if($change=='city')
	 {
	 $count=$this->promotional_panel->total_student_in_city($city);
	 $educ_in_city=$this->promotional_panel->total_student_in_city_ug($country,$city,$educ_lvl);
	 echo $count.'!@#$%'.$educ_in_city;
	 }
	 else
	 {
     if($country!='0')
	 {
	 $c_where['v_country']=$country;
	 }
	 if($city!='0')
	 {
	 $c_where['v_city']=$city;		
	 }
	 if($educ_lvl!='0')
	 {
	 $c_where['v_current_educ_level']=$educ_lvl;		
	 }
	 $this->db->select('v_id');
	 $this->db->from('verified_lead_data');
	 $this->db->where($c_where);
	 $query=$this->db->get();
	 $count=$query->num_rows(); 
	 echo $count;
	 }
	} 
	
	function sms_campaign()
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
		$this->load->view('admin/header',$data);
		$this->load->view('admin/sidebar',$data);
		
		if($data['admin_user_level']==3 || $data['admin_user_level']==5)
		{
		$data['total_student']=$this->promotional_panel->count_total_student_in_sms_email_send('sms');
		$data['country_list']=$this->promotional_panel->show_country_list();
		$data['area_interest']=$this->promotional_panel->find_all_area_of_intrests();
		
		$data['all_cities']=$this->promotional_panel->fetch_all_cities();
		$this->load->view('admin/promotional/sms_promotional',$data);
		}
		else
		{
		$this->load->view('admin/accesserror',$data);
		}
		
	}
	}
	
	
	function count_student_change_sms_email_wise($change,$type)
	{
	 $country=$this->input->post('country_id');
	 $city=$this->input->post('city_id');
	 $educ_lvl=$this->input->post('educ_level');
	// $educ_chk=explode(',',$educ_lvl);
	 $c_where=array();
	 if($change=='country')
	 {
	 $count=$this->promotional_panel->total_student_in_country_sms_email($country,$type);
	 $city_list=$this->promotional_panel->fetch_cities_having_country($country);
	 $educ_in_country=$this->promotional_panel->count_total_student_in_educ_sms_email_send($country,$educ_lvl,$type);
	 echo $city_list.'!@#$%'.$count.'!@#$%'.$educ_in_country;
	 //echo $count;
	 }
	 else if($change=='city')
	 {
	 $count=$this->promotional_panel->total_student_in_city_sms_email($city,$type);
	 $educ_in_city=$this->promotional_panel->total_student_in_sms_email_educ_change($country,$city,$educ_lvl,$type);
	 echo $count.'!@#$%'.$educ_in_city;
	 }
	 else
	 {
     $educ_in_educ_change=$this->promotional_panel->total_student_in_sms_email_educ_change($country,$city,$educ_lvl,$type);
	 echo $educ_in_educ_change;
	 }
	}
	
	function email_campaign()
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
		$this->load->view('admin/header',$data);
		$this->load->view('admin/sidebar',$data);
		
		if($data['admin_user_level']==3 || $data['admin_user_level']==5)
		{
		$data['total_student']=$this->promotional_panel->count_total_student_in_sms_email_send('email');
		$data['country_list']=$this->promotional_panel->show_country_list();
		$data['area_interest']=$this->promotional_panel->find_all_area_of_intrests();
		
		$data['all_cities']=$this->promotional_panel->fetch_all_cities();
		$this->load->view('admin/promotional/email_promotional',$data);
		}
		else
		{
		$this->load->view('admin/accesserror',$data);
		}
		
	}
	}
	
	
	
	
	
	
	
	
	
	

}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */