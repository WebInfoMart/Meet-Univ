<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

/**
 * Users
 *
 * This model represents user authentication data. It operates the following tables:
 * - user account data,
 * - user profiles
 *
 * @package	Tank_auth
 * @author	Ilya Konyukhov (http://konyukhov.com/soft/)
 */
class University_subdomain extends CI_Model
{
	
	function __construct()
	{
		parent::__construct();
		
	}
	
	function university_by_domain($univ_id,$univ_subdomain)
	{
	$data = $this->path->all_path();
		
		$this->load->view('auth/header',$data);
		$data['univ_id_for_program'] = $univ_id;
		$data['univ_subdomain'] = $univ_subdomain;
		
		$data['university_details'] = $this->users->get_university_by_id($univ_id);
		$country_id = $data['university_details']['country_id'];
		$city_id = $data['university_details']['city_id'];
		$state_id = $data['university_details']['state_id'];
		$longitude = $data['university_details']['longitude'];
		$latitude = $data['university_details']['latitude'];
		$university_name = $data['university_details']['univ_name'];
		$university_address = $data['university_details']['address_line1'];
		$logged_user_id = $this->session->userdata('user_id');
		$redirect_current_url = $this->config->site_url().$this->uri->uri_string();
   
		 $redirect_current_url = $this->config->site_url().$this->uri->uri_string();
		 $data['area_interest'] = $this->users->fetch_area_interest();
		 $data['univ_gallery'] = $this->users->get_univ_gallery($univ_id);
		 $data['article_gallery'] = $this->users->get_detail_articles_of_univ($univ_id);
		 $data['news_gallery'] = $this->users->get_detail_news_of_univ($univ_id);
		 $data['followers_detail_of_univ'] = $this->users->get_followers_detail_of_univ($univ_id);
		 $data['events_of_univ'] = $this->users->fetch_latest_events_by_univ_id($univ_id);
		 $add_follower = array(
			'follow_to_univ_id' => $univ_id,
			'followed_by' => $logged_user_id
			);
			
		$data['is_already_follow'] = $this->users->check_is_already_followed($add_follower);
		
	/* code for university map */
  $this->load->library('GMapuniv');
  $this->gmapuniv->GoogleMapAPI();
  $this->gmapuniv->setMapType('map');
  //$this->gmapuniv->addMarkerByAddress($longitude,$latitude,$university_name,$university_address);
  $this->gmapuniv->addMarkerByAddress($university_address,$university_name, $university_address);
  
      $data['headerjs'] = $this->gmapuniv->getHeaderJS();
      $data['headermap'] = $this->gmapuniv->getMapJS();
      $data['onload'] = $this->gmapuniv->printOnLoad();
      $data['map'] = $this->gmapuniv->printMap();
      $data['sidebar'] = $this->gmapuniv->printSidebar();
		
		if($this->input->post('join_now'))
		{
			if (!$this->tank_auth->is_logged_in()) {
			redirect('/home');
		} else {
			$data['user_follow_university'] = $this->users->add_followers($add_follower);
			redirect($redirect_current_url);
			}
		}

		else if($this->input->post('unjoin_now'))
		{
			$data['unjoin_now_success'] = $this->users->unjoin_now($add_follower);
			redirect($redirect_current_url);
		}
		
		else if($this->input->post('apply_now'))
		{
			$level_steps = $this->session->userdata('level_steps');
			if($level_steps != '')
			{
				$this->session->set_userdata('apply_college',$univ_id);
				redirect(find_college);
			}
			else {
			$condition = array(
				'firstname' => $this->input->post('apply_name'),
				'prog_parent_id' => $this->input->post('apply_course_interest'),
				'email' => $this->input->post('apply_email'),
				'phone_no1' => $this->input->post('apply_mobile'),
				'applied_univ_id'=> $univ_id
			);
			//print_r($apply_now_data);
			//$this->session->set_userdata($apply_now_data);
			$this->form_validation->set_rules('apply_name', 'Name ', 'trim|required|xss_clean');
			$this->form_validation->set_rules('apply_course_interest', 'Course', 'required');
			$this->form_validation->set_rules('apply_email', 'Email', 'trim|required|xss_clean|valid_email');
			$this->form_validation->set_rules('apply_mobile', 'Email', 'trim|required|xss_clean|numeric');
			if($this->form_validation->run())
			{
			$this->session->set_userdata('current_insert_lead_email',$this->input->post('apply_email'));
			$insert_type = '0';
			$data['fb_sidebar_apply_form'] = $this->leadmodel->insert_data_lead_data($condition,$insert_type);
			if($data['fb_sidebar_apply_form'] != 0)
			{
			$id_for_session = array(
			'current_insert_lead_id'=>$data['fb_sidebar_apply_form'],
			'level_steps'=>'2',
			'apply_college'=>$univ_id
			);
			$this->session->set_userdata($id_for_session);
			//print_r($this->session->userdata('current_insert_lead_id'));
			//print_r($this->session->userdata('level_steps'));
			}
			redirect('find_college');
			}
			else {
					$errors = $this->tank_auth->get_error_message();
					foreach ($errors as $k => $v)	$data['errors'][$k] = $this->lang->line($v);
			}
			//print_r($data['fb_sidebar_apply_form']);
			}
		}
		else if($this->input->post('ask_quest'))
		  {
		   
		   $univ_quest = $this->input->post('quest_on_univ');
		   
			$quest_title = array(
			'ask_quest_on_univ_page'=>$univ_quest
			);
			$this->session->set_userdata($quest_title);
			redirect("UniversityQuestSection/$univ_id");

		  }
		if($data['university_details'] != 0)
		{
			$data['country_name_university'] = $this->users->fetch_country_name_by_id($country_id);
			$data['city_name_university'] = $this->users->fetch_city_name_by_id($city_id);
			$data['state_name_university'] = $this->users->fetch_state_name_by_id($state_id);
			$data['count_followers'] = $this->users->get_followers_of_univ($univ_id);
			$data['count_articles'] = $this->users->get_articles_of_univ($univ_id);
			$this->load->view('auth/univ-header-gallery-logo',$data);
			$this->load->view('auth/university',$data);
		}
		
		else{
		/* load not found if university not found */
		$data['err_msg']='<h2> Sorry....</br><span class="text-align"> Page Not Found.... </span> </h2>';
		$data['err_div']=1;
		$this->load->view('auth/NotFoundPage',$data);
		}
		
		$this->load->view('auth/footer',$data);
	}
}	
	