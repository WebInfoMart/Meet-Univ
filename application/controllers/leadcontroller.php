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
	function find_college($x='',$request_univ_id='')
	{
		$data = $this->path->all_path();
		$this->load->view('auth/header',$data);
		$id = $request_univ_id;
		$data['country'] = $this->users->fetch_country();
		$data['area_interest'] = $this->users->fetch_area_interest();
		$data['educ_level'] = $this->users->fetch_educ_level();
		$data['show_country_having_univ'] = $this->frontmodel->fetch_search_country_having_univ();
		if($this->input->post('process_step_one'))
		{
		
		$this->form_validation->set_rules('step_email','Email','trim|xss_clean|required|valid_email');
		$this->form_validation->set_rules('iagree','I agree','trim|xss_clean|required');
		if($this->form_validation->run())
		{
			
			if($id=='')
			{
			$condition = array(
			'home_country_id' => $this->input->post('home_country'),
			'email' => $this->input->post('step_email')
			);
			}
			else{
			$condition = array(
			'home_country_id' => $this->input->post('home_country'),
			'email' => $this->input->post('step_email'),
			'applied_univ_id'=>$id
			);
			}
			$insert_type = '1';
			$data['insert_step_one_data'] = $this->leadmodel->insert_data_lead_data($condition,$insert_type);
			//$this->session->set_userdata($data_stepone);
			if($data['insert_step_one_data'] == '1')
			{
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
		$this->form_validation->set_rules('first_name','First Name','trim|xss_clean|required');
		$this->form_validation->set_rules('last_name','Last Name','trim|xss_clean|required');
		$this->form_validation->set_rules('dob_day','DOB Day','trim|xss_clean|integer|required');
		$this->form_validation->set_rules('dob_year','DOB Year','trim|xss_clean|integer|required');
		$this->form_validation->set_rules('home_address','Home Address','trim|xss_clean|required');
		$this->form_validation->set_rules('state','State','required');
		$this->form_validation->set_rules('city','City','required');
		$this->form_validation->set_rules('phone','Phone','trim|xss_clean|integer|required');
		$this->form_validation->set_rules('area_interest','Interest Area','required');
		$this->form_validation->set_rules('current_educ_level','Current Education','required');
		$this->form_validation->set_rules('next_educ_level','Next Education Level','required');
		$this->form_validation->set_rules('academic_exam_score1','Academic Exam Score','trim|xss_clean|required|integer');
		//$this->form_validation->set_rules('eng_prof_exam_score1','English Proficiency','trim|xss_clean|required');
			
			if($this->form_validation->run())
			{
			 $condition = array(
			 'intake1'             => $this->input->post('begin_year1'),
			 'intake2'             => $this->input->post('begin_year2'),
			 'title'               => $this->input->post('title'),
			 'firstname'           => $this->input->post('first_name'),
			 'lastname'            => $this->input->post('last_name'),
			 'studying_country_id' => $this->input->post('interest_study_country'),
			 'dob'                 => $this->input->post('dob_year').'-'.$this->input->post('dob_month').'-'.$this->input->post('dob_day'),
			 'address'            =>  $this->input->post('home_address'),
			 'state'              => $this->input->post('state'),
			 'city'               => $this->input->post('city'),
			 'phone_type1'        => $this->input->post('phone_type'),
			 'phone_no1'          => $this->input->post('phone'),
			 'phone_type2'        => $this->input->post('home_country'),
			 'phone_no2'          => $this->input->post('home_country'),
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
			 $this->load->view('auth/step_two');
			 }
			 
			else
				{
					$errors = $this->tank_auth->get_error_message();
					foreach ($errors as $k => $v)	$data['errors'][$k] = $this->lang->line($v);
					
					$this->load->view('auth/step_two',$data);
				}
			 
		 }
		else{
			$this->load->view('auth/step_one',$data);
		}
		$this->load->view('auth/footer',$data);
	}
}