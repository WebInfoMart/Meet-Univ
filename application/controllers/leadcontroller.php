<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Leadcontroller extends CI_Controller
{
	function __construct()
	{
		parent::__construct();
		$this->load->helper(array('form', 'url'));
		$this->load->library('form_validation');
		$this->load->library('security');
		$this->load->helper('url');
		$this->load->library('tank_auth');
		$this->lang->load('tank_auth');
		$this->load->helper('string');
		$this->load->library('email');
		$this->ci =& get_instance();
		$this->load->library('fbConn/facebook');
	}
	
	// Functions for steps in of Lead Data
	function find_college($x='',$request_univ_id='',$event_id='')
	{
		$data = $this->path->all_path();
		$this->load->view('auth/header',$data);
		//echo $this->session->userdata('user_type');
		$this->session->userdata('current_insert_lead_id');
		if($this->input->post('hid_send_univ_id_frm_search'))
		{
			$unvid = $this->input->post('hid_send_univ_id_frm_search');
			$this->session->set_userdata('apply_college',$unvid);
		} 
		//echo $this->session->userdata('apply_college');
		$id = $request_univ_id;
		$events_id = $event_id;
		$data['country'] = $this->frontmodel->fetch_search_country_having_univ();
		$data['area_interest'] = $this->users->fetch_area_interest();
		$data['educ_level'] = $this->users->fetch_educ_level();
		$data['show_country_having_univ'] = $this->users->fetch_country();
		$level_steps = $this->session->userdata('level_steps');
		
		$country = $this->session->userdata('country');
		$area_interest = $this->session->userdata('area_interest');
		$next_educ_level = $this->session->userdata('next_educ_level');
		if($level_steps!= '' && $country!='' && $area_interest!='' && $next_educ_level!='')
		{
		$data['selected_college_step_three'] = $this->leadmodel->fetch_college_step_three($country,$area_interest,$next_educ_level);
		$college_for_apply = $this->session->userdata('apply_college');
		$data['selected_university_name_by_step'] = $this->leadmodel->get_university_title_by_id($college_for_apply);
		}
		$user_id	= $this->tank_auth->get_user_id();										// Edit by Satbir on 19/10/2012
		$user_data = $this->users->fetch_profile($user_id);
		
		$data['user_data'] = $user_data;
		if($this->input->post('process_step_one'))
		{
			$this->form_validation->set_rules('first_name','First Name','trim|xss_clean|required');
			//$this->form_validation->set_rules('last_name','Last Name','trim|xss_clean|required');				//Commented by satbir
			$this->form_validation->set_rules('dob_day','DOB Day','trim|xss_clean|integer|required');
			$this->form_validation->set_rules('dob_year','DOB Year','trim|xss_clean|integer|required');
			$this->form_validation->set_rules('step_email','Email','trim|xss_clean|required|valid_email');
			$this->form_validation->set_rules('phone','Phone','trim|xss_clean|integer|required');
			$this->form_validation->set_rules('iagree','I agree','trim|xss_clean|required');
			if($this->form_validation->run())
			{
				
				$this->session->set_userdata('sess_lead_email',$this->input->post('step_email'));
				$condition = array(
				'home_country_id' => $this->input->post('home_country'),
				'email' => $this->input->post('step_email'),
				'title'=> $this->input->post('title'),
				'fullname'=> $this->input->post('first_name'),										//commented by satbir		.' '.$this->input->post('last_name'),
				'dob'=> $this->input->post('dob_year').'-'.$this->input->post('dob_month').'-'.$this->input->post('dob_day'),
				'phone_type1'=> $this->input->post('phone_type'),
				'phone_no1'=> $this->input->post('phone')
				);
				
				$insert_type = '1';
				$data['insert_step_one_data'] = $this->leadmodel->insert_data_lead_data($condition,$insert_type);			
				if($data['insert_step_one_data'] != 0)
				{
				$this->session->set_userdata('current_insert_lead_id', $data['insert_step_one_data']);
				$id_for_session = array(
				'level_steps'=>'2'
				);
				$this->session->set_userdata($id_for_session);
				}
				$this->load->view('auth/step_two',$data);
				
			}
			else{
				$errors = $this->tank_auth->get_error_message();
				foreach ($errors as $k => $v)	$data['errors'][$k] = $this->lang->line($v);
				
				$this->load->view('auth/step_one',$data);
			}
		}
		else if($this->input->post('submit_step_data'))
		{
			
			$this->form_validation->set_rules('interest_study_country','Interested Country','trim|xss_clean|required');
		
		$this->form_validation->set_rules('home_address','Home Address','trim|xss_clean|required');
		$this->form_validation->set_rules('state','State','required');
		$this->form_validation->set_rules('city','City','required');
		$this->form_validation->set_rules('area_interest','Interest Area','required');
		$this->form_validation->set_rules('current_educ_level','Current Education','required');
		$this->form_validation->set_rules('next_educ_level','Next Education Level','required');
		$this->form_validation->set_rules('academic_exam_score1','Academic Exam Score','trim|xss_clean|required|integer');
		//$this->form_validation->set_rules('eng_prof_exam_score1','English Proficiency','trim|xss_clean|required');
			//echo $this->session->userdata('current_insert_lead_id');
			if($this->form_validation->run())
			{
			 $condition = array(
			 'intake1'             => $this->input->post('begin_year1'),
			 'intake2'             => $this->input->post('begin_year2'),
			 'studying_country_id' => $this->input->post('interest_study_country'),
			 'address'            =>  $this->input->post('home_address'),
			 'state'              => $this->input->post('state'),
			 'city'               => $this->input->post('city'),
			 'prog_parent_id'     => $this->input->post('area_interest'),
			 'current_educ_level' => $this->input->post('current_educ_level'),
			 'next_educ_level'    => $this->input->post('next_educ_level'),
			 'acedmic_exam_score_type1' =>  $this->input->post('academic_exam_type1'),
			 'acedmic_exam_score1'      => 	$this->input->post('academic_exam_score1'),
			 'acedmic_exam_score_type2' =>  $this->input->post('academic_exam_type2'),
			 'acedmic_exam_score2'      =>  $this->input->post('academic_exam_score2'),
			 'eng_profiency_exam1'      =>  $this->input->post('eng_prof_exam_type1'),
			 'eng_profiency_exam_score1'=>  $this->input->post('eng_prof_exam_score1'),
			 'eng_profiency_exam2'      =>  $this->input->post('eng_prof_exam_type2'),
			 'eng_profiency_exam_score2'=>  $this->input->post('eng_prof_exam_score2'),
			 
			 );
			 //$this->session->set_userdata($data_steptwo);
			 $insert_type = '2';
			 $data['insert_step_two_data'] = $this->leadmodel->insert_data_lead_data($condition,$insert_type);
			 $college_for_apply = $this->session->userdata('apply_college');
			 $data['selected_university_name_by_step'] = $this->leadmodel->get_university_title_by_id($college_for_apply);
			 //print_r($data['insert_step_two_data']);
			 //if($data['insert_step_two_data'] != 0)
			 //{
				$country = $data['insert_step_two_data']['studying_country_id'];
				$area_interest = $data['insert_step_two_data']['prog_parent_id'];
				$next_educ_level = $data['insert_step_two_data']['next_educ_level'];
				$user_listed_college_data = array(
				'country'=>$country,
				'area_interest'=>$area_interest,
				'next_educ_level'=>$next_educ_level
				);
				$this->session->set_userdata($user_listed_college_data);
				$this->session->userdata('country');
				$this->session->userdata('area_interest');
				$this->session->userdata('next_educ_level');
				$data['selected_college_step_three'] = $this->leadmodel->fetch_college_step_three($country,$area_interest,$next_educ_level);
				//print_r($data['selected_college_step_three']);
				$id_for_session = array(
				'level_steps'=>'3'
				);
			$this->session->set_userdata($id_for_session);
			 //}
			 $this->load->view('auth/step_three',$data);
			 
			 /* else{
			 $this->load->view('auth/step_one');
			 } */
			 
			 }
			 
			else
				{
					$errors = $this->tank_auth->get_error_message();
					foreach ($errors as $k => $v)	$data['errors'][$k] = $this->lang->line($v);
					
					$this->load->view('auth/step_two',$data);
				}
			 
		 }
		 else if($this->input->post('submit_step_three_data'))
		 {
			$level_steps = $this->session->userdata('level_steps');
			$apply_college_steps = $this->session->userdata('apply_college');
			$university_ids = $this->input->post('select_id');
			$arr = array('0');
			if($apply_college_steps!='')
			{
			array_push($arr,$apply_college_steps);
			}
			if(!empty($university_ids))
			{
			foreach($university_ids as $ids)
			{
				if($ids != $apply_college_steps)
				{
				array_push($arr,$ids);
				}
			}
			}
			$insert_val = implode($arr,",");
			$data['submitting_step_three'] = $this->leadmodel->insert_step_three($insert_val);
			/* if($data['submitting_step_three'] != 0)
			{
				
				
			} */
														/* Added by Satbir on 17/10/2012 (code start)*/
			$uni_name = $this->leadmodel->get_university_name_by_id($insert_val); 
			$uni_name_list_arr=array();
			foreach($uni_name as $index => $uni_name_arr)
			{
				$uni_name_list_arr[] = $uni_name_arr['univ_name'];
			}
			$uni_name_list = implode($uni_name_list_arr,",");
			$data['uni_name_list'] = $uni_name_list;
			$user_email = $this->session->userdata('sess_lead_email');
			$config['protocol'] = $this->config->item('mail_protocol');
			$config['smtp_host'] = $this->config->item('smtp_server');
			$config['smtp_user'] = $this->config->item('smtp_user_name');
			$config['smtp_pass'] = $this->config->item('smtp_pass');
			$this->email->initialize($config);    
			$this->email->from('info@meetuniversities.com', 'MeetUniversities.com');
			$this->email->to($user_email);
			$this->email->subject('Applied Collages and Univercities | MeetUniversities.com');
			$email_body = $this->load->view('auth/email_templates/search_apply_collage_notification',$data,TRUE);
			$message = $email_body ;
			$this->email->message($message);
			$this->email->send();
													/* Added by Satbir on 17/10/2012 (code end)*/
			$set_session_data_to_blank = array(
				'current_insert_lead_id'=>'',
				'current_insert_lead_email'=>'',
				'apply_college'=>'',
				'level_steps'=>'',
				'country'=>'',
				'area_interest'=>'',
				'next_educ_level'=>''
				); 
				$this->session->set_userdata($set_session_data_to_blank);
			// $id_for_session = array(
			// 'level_steps'=>''
			// );
			//$this->session->set_userdata($id_for_session);
			$this->load->view('auth/step_four');
			/* else {
			$redirect_url = $base.'find_college';
			redirect($redirect_url);
			} */
		 }
		 else if($this->input->post('edit_search'))
		 {
			$this->session->set_userdata('level_steps','2');
			redirect('find_college');
		 }
		else{
		$level_steps = $this->session->userdata('level_steps');
		if($level_steps == '2')
		{
			$this->load->view('auth/step_two',$data);
		}
		else if($level_steps == '3')
		{
			$this->load->view('auth/step_three',$data);
		}
		else{
			$this->load->view('auth/step_one',$data);
			}
		}
		$this->load->view('auth/footer',$data);
	}
	
	
	function EventRegistration()
	{
		$this->load->library('parser');
		$data = $this->path->all_path();
		$this->load->view('auth/header',$data);
		$data['get_info_logged_user'] = '';
		$data['eve_reg_suc'] = '';
		if ($this->tank_auth->is_logged_in()) {
			$logged_user_id = $this->session->userdata('user_id');
			$data['get_info_logged_user'] = $this->users->fetch_profile($logged_user_id);
			}
			else{
			$data['get_info_logged_user'] = '';
			$logged_user_id='';
			}
		$univ_id = $this->input->post('event_register_of_univ_id');
		$event_id = $this->input->post('event_register_id');
		if($univ_id!='' && $event_id!='')
		{
		$set_session_event_register = array(
		'register_event_university_id'=>$univ_id,
		'register_event_id'=>$event_id
		);
		$this->session->set_userdata($set_session_event_register);
		}
		$id_of_university = $this->session->userdata('register_event_university_id');
		$id_of_event = $this->session->userdata('register_event_id');
		$condition = array(
		'event_univ_id'=>$id_of_university,
		'event_id'=>$id_of_event
		);
		$data['univ_event_info'] = $this->leadmodel->get_event_univ_info($condition);
		if($this->input->post('submit_event_register'))
		{
			$this->form_validation->set_rules('event_fullname','Fullname','trim|xss_clean|required');
			$this->form_validation->set_rules('event_email','Email','trim|xss_clean|required|valid_email');
			$this->form_validation->set_rules('event_phone','Phone','trim|xss_clean|required|integer');
			
			if($this->form_validation->run())
			{
				/* $university_id = $this->session->userdata('register_event_university_id');
				$event_id = $this->session->userdata('register_event_id'); */
				$user_email = $this->input->post('event_email');
				$id_university = $this->session->userdata('register_event_university_id');
				$id_event = $this->session->userdata('register_event_id');
				$data['success_event_register'] = $this->leadmodel->event_registration($logged_user_id,$id_university,$id_event);
				$latest_registered_event_id = $data['success_event_register']['event_id'];
					$data['latest_register_event_info'] = $this->leadmodel->event_detail_for_email($latest_registered_event_id);
					//$message_email = $this->load->view('auth/event_register_content_email',$data,TRUE);
					 $message_email =  $this->parser->parse('auth/event_register_content_email', $data, TRUE);
					 $config['protocol'] = $this->config->item('mail_protocol');
					 $config['smtp_host'] = $this->config->item('smtp_server');
					 $config['smtp_user'] = $this->config->item('smtp_user_name');
					 $config['smtp_pass'] = $this->config->item('smtp_pass');
					 $config['mailtype'] = 'html';
					 $this->email->initialize($config);    
					 $this->email->from('info@meetuniversities.com', 'Meet Universities');
					 $this->email->to($user_email);
					 $this->email->subject('Event Registration');
					 $message = $message_email ;
					 $this->email->message($message);
					 $this->email->send(); 
					$set_blank_session_event_register = array(
						'register_event_university_id'=>'',
						'register_event_id'=>''
					);
					$this->session->set_userdata($set_blank_session_event_register);
					$this->session->set_flashdata('eve_reg_suc','suc');
					redirect('events');
				//}
			}
		}
		$this->load->view('auth/event_register',$data);
		$this->load->view('auth/footer',$data);
	}

	function sms_me_event_ajax()
	{
	$data = $this->path->all_path();
	if ($this->tank_auth->is_logged_in()) {
	$logged_user = $data['user_id'] = $this->tank_auth->get_user_id();
	$data['fetch_profile_user'] = $this->users->fetch_profile($logged_user);
	}
		$id = $this->input->post('event_id');
		$data['event_info_sms'] = $this->frontmodel->get_event_for_sms($id);
		$this->load->view('ajaxviews/events_for_send_sms',$data);
	}
	
	function send_sms_of_event()
	{
		$data = $this->path->all_path();
		$username = $this->input->post('uname');
		$password = $this->input->post('pass');
		$send = $this->input->post('send');
		$destination = $this->input->post('dest');
		$fullname = $this->input->post('fullname');
		$event_id_sms = $this->input->post('event_id_sms');
		$page_to_redirect = $this->input->post('page_status');
		$email_text_sms = $this->input->post('email');
		//$message = $this->input->post('msg');
		$event_title = $this->input->post('event_title');
		$event_date = $this->input->post('event_date');
		$event_time = $this->input->post('event_time');
		$event_place = $this->input->post('event_place');
		$event_city = $this->input->post('event_city');
		$event_country=$this->input->post('event_country');
		$event_univ=$this->input->post('event_univ');
		$event_category=$this->input->post('event_category');
		if($event_category == "spot_admission")
		{
			$event_category="Spot Admission";
		} 
		else if($event_category == "fairs")
		{
			$event_category="Fairs";
		}
		else if($event_category == "others")
		{
			$event_category="Counselling";
		}
		else if($event_category == "alumuni")
		{
			$event_category="Counselling";
		}
		
		$msg_type = 'text';
		/* $this->form_validation->set_rules('fullname','Name','required');
		$this->form_validation->set_rules('dest','Mobile No','required|integer');
		if($this->form_validation->run())
		{ */
		$message = urlencode('Time- '.$event_time.'\n'.'Date- '.$event_date.'\n'.'Place- '.$event_place.','.$event_country.'\n'.'Event-'.$event_univ.','.$event_category);
		$url = "http://www.unicel.in/SendSMS/sendmsg.php?uname=$username&pass=$password&send=$send&dest=$destination&msg=$message";
		//echo $url;exit;
		$send_suc = file_get_contents($url);
		$data['insert_in_user_aft_txt_msg'] = $this->leadmodel->insert_user_data_after_send_sms($msg_type);
		//$red_url = $base.'msg_send_suc';
		$this->session->set_userdata('msg_send_suc','1');
		//}
		//echo $current_url;
		//echo $url;
		if($page_to_redirect == 'home')
		{
			$current_url = base_url();
		}
		else if($page_to_redirect == 'events')
		{
			$current_url = base_url().'events';
		}
		else if($page_to_redirect == 'fairs')
		{
			$current_url = base_url().'fairs_events';
		}
		else if($page_to_redirect == 'spot')
		{
			$current_url = base_url().'spot_admission_events';
		}
		else if($page_to_redirect == 'counsell')
		{
			$current_url = base_url().'Counselling_events';
		}
		else{
		$current_url = $page_to_redirect;
		}
		redirect($current_url);
		//echo $send_suc;
	}
	
	function sms_voice_me_event_ajax()
	{
	$data = $this->path->all_path();
	if ($this->tank_auth->is_logged_in()) {
	$logged_user = $data['user_id'] = $this->tank_auth->get_user_id();
	$data['fetch_profile_user'] = $this->users->fetch_profile($logged_user);
	}
		$id = $this->input->post('event_id');
		$data['event_info_sms'] = $this->frontmodel->get_event_for_sms($id);
		$this->load->view('ajaxviews/events_for_send_voice_sms',$data);
	}
	
	function send_sms_voice_of_event()
	{
		$data = $this->path->all_path();
		$username = $this->input->post('uid');
		$password = $this->input->post('pwd');
		$fid = $this->input->post('fid');
		$destination = $this->input->post('mobno');
		$fullname = $this->input->post('fullname_voice');
		$event_id = $this->input->post('event_id_voice');
		$page_to_redirect = $this->input->post('page_status_voice');
		//$message = $this->input->post('msg');
		
		$date_call = (int)$this->input->post('call_date');
		$month_call = (int)$this->input->post('call_month');
		$year_call = (int) $this->input->post('call_year');
		$hour_call = '00';
		$minute_call = '00';
		$second_call = '00';
		$date_and_time = $year_call.'-'.$month_call.'-'.$date_call.'%20'.$hour_call.':'.$minute_call.':'.$second_call;
		
		$event_univ_name = $this->input->post('event_univ_name_voice');
		$event_title = $this->input->post('event_title_voice');
		$event_date = $this->input->post('event_date_voice');
		$event_time = $this->input->post('event_time_voice');
		$event_place = $this->input->post('event_place_voice');
		$event_city = $this->input->post('event_city_voice');
		$voice_email = $this->input->post('email_voice');
		$data['fullname'] = $fullname;
		$data['event_id'] = $event_id;
		
		
		$letter_year = $this->leadmodel->translate_to_words($year_call);
		$letter_date = $this->leadmodel->translate_to_words($date_call);
		$letter_month = date( 'F', mktime(0, 0, 0, $month_call) );
		
		$subject_of_voice_sms = "Dear User You are invited of $event_univ_name";
		$invited_date = "on $letter_date $letter_month $letter_year";
		
		//$message = urlencode('Event-  '.$event_title.'\n'.'  Date- '.$event_date.'\n'.' Time- '.$event_time.'\n'.' Place- '.$event_place.','.$event_city);
		$msg_type = 'voice';
		
		$url_execute = "http://www.hostedivr.in/obdapi/inserteventdata.php?uid=$username&pwd=$password&mobno=$destination&name=$subject_of_voice_sms&eventdate=$invited_date";
		//echo $url_execute;exit;
		//$url = "http://hostedivr.in/obdapi/callscheduling.php?uid=$username&pwd=$password&mobno=$destination&fid=$fid&schtime=$date_and_time";
		//echo $year_call;
		$url = str_replace(" ", "%20", $url_execute);
		
		$send_suc = file_get_contents($url);
		//echo $send_suc;
		//echo $url;
		$data['insert_in_user_aft_voice_msg'] = $this->leadmodel->insert_user_data_after_send_sms($msg_type);
		
		$message_email = $this->load->view('auth/reminder_alert_content_email',$data,TRUE);
		/* $this->email->from('info@meetuniversities.info', 'Meet Universities');
					$this->email->to($voice_email);
					$this->email->subject('Event Registration');
					$message = "$message_email" ;
					//$message .="<br/>Thank you very much";
					$this->email->message($message);
					print_r($message);
					$this->email->send();  */
		$this->session->set_userdata('msg_send_suc_voice','1');
		//echo $current_url;
		if($page_to_redirect == 'home')
		{
			$current_url = base_url();
		}
		else if($page_to_redirect == 'events')
		{
			$current_url = base_url().'events';
		}
		else if($page_to_redirect == 'fairs')
		{
			$current_url = base_url().'fairs_events';
		}
		else if($page_to_redirect == 'spot')
		{
			$current_url = base_url().'spot_admission_events';
		}
		else if($page_to_redirect == 'counsell')
		{
			$current_url = base_url().'Counselling_events';
		}
		else{
		$current_url = $page_to_redirect;
		}
		redirect($current_url);
		//echo $send_suc;
	}		/*Added by Anusha*/	function send_mail_gmail_contacts($subject='', $to){				$this->load->library('parser');		$config['protocol'] = $this->config->item('mail_protocol');		$config['smtp_host'] = $this->config->item('smtp_server');		$config['smtp_user'] = $this->config->item('smtp_user_name');		$config['smtp_pass'] = $this->config->item('smtp_pass');		$config['mailtype'] = 'html';		$this->email->initialize($config);    		$this->email->from('info@meetuniversities.com', 'Meet Universities');		$this->email->to($check);		$this->email->subject($subject.' sent you a message.');		$message = "<html><body><img style='float:left;' src='http://meetuniversities.com/images/logo.png' /><div style='float:right;'>Universities | Events | Scholarship</div><div style='clear:both'></div><br/> Hi,<br/>How are you?<br/><br/> I thought you'd like www.meetuniversities.com; it has the largest listing of university events & plenty of free information with regard to study options abroad .<br/><br/> MeetUniversities has an awesome interface to explore, get in touch and connect with universities directly.<br/><br/> Hurry up! Grab a free ebook for studying abroad by simply joining them. <br/><br/> Come join. I have also joined. <br/><br/> Thanks</body></html>" ;		$this->email->message($message);		$this->email->send(); 		redirect('thankyou.php');		return true;	}
}




