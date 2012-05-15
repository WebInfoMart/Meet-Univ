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
		$id = $request_univ_id;
		$events_id = $event_id;
		$data['country'] = $this->users->fetch_country();
		$data['area_interest'] = $this->users->fetch_area_interest();
		$data['educ_level'] = $this->users->fetch_educ_level();
		$data['show_country_having_univ'] = $this->frontmodel->fetch_search_country_having_univ();
		if($this->input->post('process_step_one'))
		{
		$this->form_validation->set_rules('first_name','First Name','trim|xss_clean|required');
		$this->form_validation->set_rules('last_name','Last Name','trim|xss_clean|required');
		$this->form_validation->set_rules('dob_day','DOB Day','trim|xss_clean|integer|required');
		$this->form_validation->set_rules('dob_year','DOB Year','trim|xss_clean|integer|required');
		$this->form_validation->set_rules('step_email','Email','trim|xss_clean|required|valid_email');
		$this->form_validation->set_rules('phone','Phone','trim|xss_clean|integer|required');
		$this->form_validation->set_rules('iagree','I agree','trim|xss_clean|required');
		if($this->form_validation->run())
		{
			
			if($id=='')
			{
			$condition = array(
			'home_country_id' => $this->input->post('home_country'),
			'email' => $this->input->post('step_email'),
			'title'=> $this->input->post('title'),
			'firstname'=> $this->input->post('first_name'),
			'lastname'=> $this->input->post('last_name'),
			'dob'=> $this->input->post('dob_year').'-'.$this->input->post('dob_month').'-'.$this->input->post('dob_day'),
			'phone_type1'=> $this->input->post('phone_type'),
			'phone_no1'=> $this->input->post('phone')
			);
			//print_r($condition);echo "h3";
			}
			else if($id!='' && $events_id!='')
			{
				$condition = array(
			'home_country_id' => $this->input->post('home_country'),
			'email' => $this->input->post('step_email'),
			'title'=> $this->input->post('title'),
			'firstname'=> $this->input->post('first_name'),
			'lastname'=> $this->input->post('last_name'),
			'dob'=> $this->input->post('dob_year').'-'.$this->input->post('dob_month').'-'.$this->input->post('dob_day'),
			'phone_type1'=> $this->input->post('phone_type'),
			'phone_no1'=> $this->input->post('phone'),
			'applied_univ_id'=>$id,
			'applied_event_id'=>$events_id
			);
			//print_r($condition);echo "h2";
			}
			else{
			$condition = array(
			'home_country_id' => $this->input->post('home_country'),
			'email' => $this->input->post('step_email'),
			'title'=> $this->input->post('title'),
			'firstname'=> $this->input->post('first_name'),
			'lastname'=> $this->input->post('last_name'),
			'dob'=> $this->input->post('dob_year').'-'.$this->input->post('dob_month').'-'.$this->input->post('dob_day'),
			'phone_type1'=> $this->input->post('phone_type'),
			'phone_no1'=> $this->input->post('phone'),
			'applied_univ_id'=>$id
			);
			//print_r($condition);echo "h1";
			}
			$insert_type = '1';
			$data['insert_step_one_data'] = $this->leadmodel->insert_data_lead_data($condition,$insert_type);
			//print_r($data['insert_step_one_data']);
			//$this->session->set_userdata($data_stepone);
			if($data['insert_step_one_data'] != 0)
			{
			$this->session->set_userdata('current_insert_lead_id', $data['insert_step_one_data']);
			$this->load->view('auth/step_two',$data);
			}
			else{
			$this->load->view('auth/step_one',$data);
			}
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
			 //print_r($data['insert_step_two_data']);
			 if($data['insert_step_two_data'] != 0)
			 {
				$country = $data['insert_step_two_data']['studying_country_id'];
				$area_interest = $data['insert_step_two_data']['prog_parent_id'];
				$next_educ_level = $data['insert_step_two_data']['next_educ_level'];
				$data['selected_college_step_three'] = $this->leadmodel->fetch_college_step_three($country,$area_interest,$next_educ_level);
				//print_r($data['selected_college_step_three']);
				$this->load->view('auth/step_three',$data);
			 }
			 else{
			 $this->load->view('auth/step_one');
			 }
			 
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
			$university_ids = $this->input->post('select_id');
			$arr = array();
			foreach($university_ids as $ids)
			{
				array_push($arr,$ids);
				
			}
			$insert_val = implode(",",$arr);
			$data['submitting_step_three'] = $this->leadmodel->insert_step_three($insert_val);
			if($data['submitting_step_three'] != 0)
			{
				$set_session_data_to_blank = array(
				'current_insert_lead_id'=>'',
				'current_insert_lead_email'=>''
				); 
				$this->session->set_userdata($set_session_data_to_blank);
				$this->load->view('auth/step_four');
			}
			else {
			$redirect_url = $base.'find_college';
			redirect($redirect_url);
			}
		 }
		else{
			$this->load->view('auth/step_one',$data);
		}
		$this->load->view('auth/footer',$data);
	}
}