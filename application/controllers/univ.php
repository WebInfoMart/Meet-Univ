<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Univ extends CI_Controller
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

	/* Function used for single university page */
function university($univ_id='')
	{
		$data = $this->path->all_path();
		$this->load->view('auth/header',$data);
		$data['univ_id_for_program'] = $univ_id;
		$data['university_details'] = $this->users->get_university_by_id($univ_id);
		$country_id = $data['university_details']['country_id'];
		$city_id = $data['university_details']['city_id'];
		$longitude = $data['university_details']['longitude'];
		$latitude = $data['university_details']['latitude'];
		$university_name = $data['university_details']['univ_name'];
		$university_address = $data['university_details']['address_line1'];
		$logged_user_id = $this->session->userdata('user_id');
		 $redirect_current_url = $this->config->site_url().$this->uri->uri_string();
		 $data['area_interest'] = $this->users->fetch_area_interest();
		 $data['univ_gallery'] = $this->users->get_univ_gallery($univ_id);
		 $data['article_news_gallery'] = $this->users->get_detail_articles_of_univ($univ_id);
		 $data['followers_detail_of_univ'] = $this->users->get_followers_detail_of_univ($univ_id);
		 $data['events_of_univ'] = $this->users->fetch_latest_events_by_univ_id($univ_id);
		 //print_r($data['events_of_univ']);
		 //print_r($data['followers_detail_of_univ']);
		$add_follower = array(
			'follow_to_univ_id' => $univ_id,
			'followed_by' => $logged_user_id
			);
			
		$data['is_already_follow'] = $this->users->check_is_already_followed($add_follower);
		
		/* code for university map */
		$this->load->library('GMapuniv');
		$this->gmapuniv->GoogleMapAPI();
		$this->gmapuniv->setMapType('map');
		$this->gmapuniv->addMarkerByCoords($longitude,$latitude,$university_name,$university_address);
		
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
			$apply_now_data = array(
				'apply_name' => $this->input->post('apply_name'),
				'apply_course_interest' => $this->input->post('apply_course_interest'),
				'apply_email' => $this->input->post('apply_email'),
				'apply_mob' => $this->input->post('apply_mobile')
			);
			$this->session->set_userdata($apply_now_data);
		}
		
		if($data['university_details'] != 0)
		{
			$data['country_name_university'] = $this->users->fetch_country_name_by_id($country_id);
			$data['city_name_university'] = $this->users->fetch_city_name_by_id($city_id);
			$data['count_followers'] = $this->users->get_followers_of_univ($univ_id);
			$data['count_articles'] = $this->users->get_articles_of_univ($univ_id);
			$this->load->view('auth/university',$data);
		}
		
		else{
		//$data['errors'] = 'Sorry, No University Details Found !!!';
		$this->load->view('auth/NotFoundPage',$data);
		}
		//$this->load->view('auth/university',$data);
		/* load not found if university not found */
		$this->load->view('auth/NotFoundPage',$data);
		}
		
		$this->load->view('auth/footer',$data);
	}
	
	/* This Function used for get program categories provided by university */
	function univ_programs($univ_id='',$prg='')
	{
		$data = $this->path->all_path();
		$this->load->view('auth/header',$data);
		$data['univ_id_for_program'] = $univ_id;
		$data['university_details'] = $this->users->get_university_by_id($univ_id);
		
		$country_id = $data['university_details']['country_id'];
		$city_id = $data['university_details']['city_id'];
		$university_name = $data['university_details']['univ_name'];
		$university_address = $data['university_details']['address_line1'];
		$logged_user_id = $this->session->userdata('user_id');
		 $redirect_current_url = $this->config->site_url().$this->uri->uri_string();
		 $data['area_interest'] = $this->users->fetch_area_interest();
		 $data['univ_gallery'] = $this->users->get_univ_gallery($univ_id);
		 //$data['article_news_gallery'] = $this->users->get_detail_articles_of_univ($univ_id);
		 //$data['followers_detail_of_univ'] = $this->users->get_followers_detail_of_univ($univ_id);
		 //$data['events_of_univ'] = $this->users->fetch_latest_events_by_univ_id($univ_id);
		 if($data['university_details'] != 0)
		{
			$data['country_name_university'] = $this->users->fetch_country_name_by_id($country_id);
			$data['city_name_university'] = $this->users->fetch_city_name_by_id($city_id);
			$data['count_followers'] = $this->users->get_followers_of_univ($univ_id);
			$data['count_articles'] = $this->users->get_articles_of_univ($univ_id);
			if($prg == 'program')
		{
			$data['prog_title_of_univ'] = $this->users->fetch_program_title_of_univ($univ_id);
		}
		$this->load->view('auth/university-courses',$data);
		}
		else{
		$this->load->view('auth/NotFoundPage',$data);
		}
		$this->load->view('auth/footer',$data);
	}
	
	/* This Function used for get course detail of program category 
	of university selected by user */
	
	function program_detail($univ_id='',$course_id='')
	{
		$data = $this->path->all_path();
		$this->load->view('auth/header',$data);
		$data['univ_id_for_program'] = $univ_id;
		$data['university_details'] = $this->users->get_university_by_id($univ_id);
		
		$country_id = $data['university_details']['country_id'];
		$city_id = $data['university_details']['city_id'];
		$university_name = $data['university_details']['univ_name'];
		$university_address = $data['university_details']['address_line1'];
		$logged_user_id = $this->session->userdata('user_id');
		 $redirect_current_url = $this->config->site_url().$this->uri->uri_string();
		 $data['area_interest'] = $this->users->fetch_area_interest();
		 $data['univ_gallery'] = $this->users->get_univ_gallery($univ_id);
		
		
		if($data['university_details'] != 0)
		{
			$data['country_name_university'] = $this->users->fetch_country_name_by_id($country_id);
			$data['city_name_university'] = $this->users->fetch_city_name_by_id($city_id);
			$data['count_followers'] = $this->users->get_followers_of_univ($univ_id);
			$data['count_articles'] = $this->users->get_articles_of_univ($univ_id);
			/* get detail of course */
			$data['detail_of_course'] = $this->users->fetch_course_detail($univ_id,$course_id);
			$this->load->view('auth/course_detail_of_univ',$data);
		}
		else{
		$this->load->view('auth/NotFoundPage',$data);
		}
		
		$this->load->view('auth/footer',$data);
	}
	}

?>
