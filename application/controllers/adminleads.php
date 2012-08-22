<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Adminleads extends CI_Controller
{
	function __construct()
	{
		parent::__construct();

		$this->load->helper('url');
		$this->load->library('tank_auth');
		$this->load->model('lead_tele_model');
		$this->load->library('pagination');


	}

	function managetelecalls($start=0)
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
			$data['admin_priv']=$this->adminmodel->get_user_privilege($data['user_id']);
			//fetch user privilege data from model
			if($flag==0)
			{
				$data['teleleads']=$this->lead_tele_model->tele_lead_users($start);
				if ($this->input->post('ajax'))
				{
					$this->load->view('ajaxviews/admin_engage/manage_tele_leads', $data);
				} 
				else 
				{
					$this->load->view('admin/header', $data);
					$this->load->view('admin/sidebar', $data); 
					$this->load->view('admin/leads/manage_tele_leads', $data);
				} 
			}	 
		}
	
	}
	
	function manage_verified_telecalls($start=0)
	{
		$data = $this->path->all_path();
		if (!$this->tank_auth->is_admin_logged_in()) {
   
   redirect('admin/adminlogin/');
	} else {
	   $flag=0;
	  $data['username'] = $this->tank_auth->get_username();
	   $data['user_id'] = $this->tank_auth->get_admin_user_id();
	   $data['admin_user_level']=$this->tank_auth->get_admin_user_level();
	   $data['admin_priv']=$this->adminmodel->get_user_privilege($data['user_id']);
		
		   //fetch user privilege data from model
	  if($flag==0)
	 {
	  $data['verify_teleleads']=$this->lead_tele_model->manage_verify_teleleads($start);
	  if ($this->input->post('ajax')) {
      $this->load->view('ajaxviews/admin_engage/manage_verify_tele_leads', $data);
    } else {
	$this->load->view('admin/header', $data);
	  $this->load->view('admin/sidebar', $data); 
      $this->load->view('admin/leads/manage_verify_tele_leads', $data);
    }
	 
	 }
		
		 
	}
	}
	
	function fetch_user_info_for_tele()
	{
	  $data = $this->path->all_path();
		if (!$this->tank_auth->is_admin_logged_in()) {
   
	   redirect('admin/adminlogin/');
		} else {
		   $flag=0;
		   $user_id=$this->input->post('id');
		   $data['username'] = $this->tank_auth->get_username();
		   $data['user_id'] = $this->tank_auth->get_admin_user_id();
		   $data['admin_user_level']=$this->tank_auth->get_admin_user_level();
		    //kulbir
		   $data['note_info']=$this->lead_tele_model->v_note($user_id);
		   //kulbir
		   $data['lead_info']=$this->lead_tele_model->lead_user_info($user_id);
		   $data['country_res']=$this->users->fetch_country();
		   $data['state_res'] = $this->lead_tele_model->fetch_state();
		   $data['city_res'] = $this->lead_tele_model->fetch_city();
		   //print_r( $data['lead_info']);
		   $view=$this->load->view('ajaxviews/admin_engage/edit_tele_user', $data,TRUE);
		   echo $view;
		 }
			
			 
	}
	
	function fetch_user_info_for_verify_tele()
	{
		$data = $this->path->all_path();
		if (!$this->tank_auth->is_admin_logged_in()) {
   
	   redirect('admin/adminlogin/');
		} else {
		   $flag=0;
		   $user_id=$this->input->post('id');
		   $data['username'] = $this->tank_auth->get_username();
		   $data['user_id'] = $this->tank_auth->get_admin_user_id();
		   $data['admin_user_level']=$this->tank_auth->get_admin_user_level();
		   $data['lead_info']=$this->lead_tele_model->verify_lead_user_info($user_id);
		   $data['note_info']=$this->lead_tele_model->v_note($user_id);
		   $data['country_res']=$this->users->fetch_country();
		   $data['state_res'] = $this->lead_tele_model->fetch_state();
		   $data['city_res'] = $this->lead_tele_model->fetch_city();
		   //print_r( $data['lead_info']);
		   $view=$this->load->view('ajaxviews/admin_engage/edit_verify_tele_user', $data,TRUE);
		   echo $view;
		 }
	}
	
	function save_verified_leads()
	{
		$dob = $this->input->post('year').'-'.$this->input->post('month').'-'.$this->input->post('date');
		
		$lead_info = array(
		'v_fullname'=>$this->input->post('fullname'),
		'v_lead_id'=>$this->input->post('current_lead_id'),
		'v_email'=>$this->input->post('email'),
		'v_phone'=>$this->input->post('phone'),
		'v_dob'=>$dob,
		'v_country'=>$this->input->post('country'),
		'v_state'=>$this->input->post('state'),
		'v_city'=>$this->input->post('city'),
		'v_enroll_key'=>$this->input->post('enroll'),
		//'v_notes'=>$this->input->post('notes'),
		'v_interested_country'=>$this->input->post('interested_cont'),
		'v_user_type'=>$this->input->post('lead_source'),
		'v_verified_email'=>$this->input->post('email_verified'),
		'v_verified_phone'=>$this->input->post('phone_verified'),		
		'v_lead_status'=>$this->input->post('lead_status'),
		'v_next_action'=>$this->input->post('next_action')
		);
		//kulbir
		$notes = array(
		'lead_id'=>$this->input->post('current_lead_id'),
		'v_note'=>$this->input->post('notes'),
		'updated_on'=>date('Y-m-d H:i:s', time())		
		);
	 //kulbir
		
		$update_old_lead_info = array(
		'fullname'=>$this->input->post('fullname'),
		'email'=>$this->input->post('email'),
		'phone_no1'=>$this->input->post('phone'),
		'dob'=>$dob,
		'home_country_id'=>$this->input->post('country'),
		'state'=>$this->input->post('state'),
		'city'=>$this->input->post('city'),
		'email_verified'=>$this->input->post('email_verified'),
		'phone_verified'=>$this->input->post('phone_verified'),
		'enroll_key'=>$this->input->post('enroll'),
		'lead_verified'=>$this->input->post('lead_verified'),
		'studying_country_id'=>$this->input->post('interested_cont'),
		'lead_status'=>$this->input->post('lead_status'),
		'next_action'=>$this->input->post('next_action')
		);
		$data['submit_verified_lead_info'] = $this->lead_tele_model->save_verified_lead_info($lead_info,$update_old_lead_info,$notes);
		if($data['submit_verified_lead_info'] == 1)
		{
			echo "1";
		}
		else if($data['submit_verified_lead_info'] == 0)
		{
			echo "0";
		}
	}
	
	function update_verify_leads()
	{
		$dob = $this->input->post('year').'-'.$this->input->post('month').'-'.$this->input->post('date');
		$update_verify_lead_info = array(
		'v_fullname'=>$this->input->post('fullname'),
		'v_email'=>$this->input->post('email'),
		'v_phone'=>$this->input->post('phone'),
		'v_dob'=>$dob,
		'v_country'=>$this->input->post('country'),
		'v_state'=>$this->input->post('state'),
		'v_city'=>$this->input->post('city'),
		'v_enroll_key'=>$this->input->post('enroll'),
		'v_interested_country'=>$this->input->post('interested_cont'),
		'v_user_type'=>$this->input->post('lead_source'),
		'v_verified_email'=>$this->input->post('verified_email'),
		'v_verified_phone'=>$this->input->post('verified_phone'),
		'v_lead_status'=>$this->input->post('lead_status'),
		'v_next_action'=>$this->input->post('next_action'),
		'updated_on' => date('Y-m-d H:i:s', time())
		);
		$notes = array(
		'lead_id'=>$this->input->post('current_lead_id'),
		'v_note'=>$this->input->post('notes'),
		'updated_on'=>date('Y-m-d H:i:s', time())		
		);
		$data['update_verify_lead_info'] = $this->lead_tele_model->update_verify_lead_model($update_verify_lead_info,$notes);
		echo $data['update_verify_lead_info'];
	}
	
	function check_email_exist()
	{
		//$query = $this->db->get_where('verified_lead_data',);
		$email = $this->input->post('email');
		$phone = $this->input->post('phone');
		$data['check_email'] = $this->lead_tele_model->check_for_email_existing($email,$phone);
		echo $data['check_email'];
	}
	function chk_email_phone_exists()
	{
		$email = $this->input->post('email');
		$cur_email=$this->input->post('cur_email');
		$phone = $this->input->post('phone');
		$cur_phone = $this->input->post('cur_phone');
		$mob=0;
		$mail=0;
		if($email==$cur_email)
		{
		$mob=1;
		}
		else if($phone==$cur_phone)
		{
		$mail=1;
		}
		$data['check_email'] = $this->lead_tele_model->check_for_email_phone_existing($email,$phone,$mob,$mail);
		
		echo $data['check_email'];
	
	}
	
	function droprecord()
	{
		$id = $this->input->post('id');
		$data['drop_record'] = $this->lead_tele_model->drop_record_from_lead($id);
		echo $data['drop_record'];
	}
	
	function permotional_panel()
	{
	$data = $this->path->all_path();
		if (!$this->tank_auth->is_admin_logged_in()) {
   
	   redirect('admin/adminlogin/');
		} else {
	 $this->load->view('admin/engage/promotional',$data);
	 }
	}
	
	function sms_capaign()
	{
	$data = $this->path->all_path();
		if (!$this->tank_auth->is_admin_logged_in()) {
   
	   redirect('admin/adminlogin/');
		} else {
	 $this->load->view('admin/engage/sms_capaign',$data);
	 }
	}
	
	function counsellor()
	{
	$data = $this->path->all_path();
		if (!$this->tank_auth->is_admin_logged_in()) {
   
	   redirect('admin/adminlogin/');
		} else {
	 $this->load->view('admin/engage/counsellor',$data);
	 }
	}
	
	function get_country_list($c_list)
	{
	
	 $param=$_GET["term"];
	 parse_str($_SERVER['QUERY_STRING'], $_GET);
	 $query = mysql_query("SELECT * FROM country WHERE country_name REGEXP '^$param'");
	
		//build array of results
		for ($x = 0, $numrows = mysql_num_rows($query); $x < $numrows; $x++) {
			$row = mysql_fetch_assoc($query);
			$country_list=explode(",",$c_list);
			if(!(in_array($row["country_id"],$country_list)))
			{
			$friends[$x] = array("name" => $row["country_name"],"id" => $row["country_id"]);
			}	
		}
	
		//echo JSON to page
		$response = $_GET["callback"] . "(" . json_encode($friends) . ")";
		echo $response;
	}
	
		function add_new_leads()
	  {
	   $data = $this->path->all_path();
	   if (!$this->tank_auth->is_admin_logged_in()) {

	   redirect('admin/adminlogin/');
	   } 
	   else 
	   {
		
		$data['username'] = $this->tank_auth->get_username();
		$data['user_id'] = $this->tank_auth->get_admin_user_id();
		$data['admin_user_level']=$this->tank_auth->get_admin_user_level();

		//$data['lead_info']=$this->lead_tele_model->lead_user_info();
		$data['country_res']=$this->users->fetch_country();
		$data['state_res'] = $this->lead_tele_model->fetch_state();
		$data['city_res'] = $this->lead_tele_model->fetch_city();

		$view=$this->load->view('admin/leads/add_new_leads', $data,TRUE);
		echo $view;
	   }


	  }
	
	 function add_new_verified_lead()
	 {
	  $email=$this->input->post('email');
	  if($email!='' && $this->input->post('lead_as_site_user')!='0')
	  {
	  $lead_as_user=$this->lead_tele_model->email_as_site_user($email);
	  if($lead_as_user)
	  {
	   $user_id=$lead_as_user['id'];
	  }
	  else
	  {
	   $user_id=0;
	  }
	  }
	  else
	  {
	  $user_id='';
	  }
	  $data['insert_lead_info'] = $this->lead_tele_model->save_lead_info($user_id);  
	  
	  if($data['insert_lead_info']=='1')
	  {
	   echo '1';
	  }
	  else
	  {
	   echo '0';
	  }
	 }
}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */