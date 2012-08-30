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
class Subdomain extends CI_Model
{
	function __construct()
	{
	
		parent::__construct();
	}

	function homefunction()
    {
	    $data = $this->path->all_path();
		$data['gallery_home'] = $this->users->fetch_home_gallery();
		$data['country'] = $this->frontmodel->fetch_search_country_having_univ();
		$data['cities'] = $this->frontmodel->fetch_cities_having_events();
		$data['total_poste_event_count'] = $this->frontmodel->count_total_posted_event();
		$data['area_interest'] = $this->frontmodel->fetch_area_interest_having_univ();
		$data['featured_events']=$this->frontmodel->fetch_featured_events();
		$data['featured_college']=$this->frontmodel->fetch_featured_college();
		$data['featured_article']=$this->frontmodel->fetch_featured_article_home();	
		$data['featured_news']=$this->frontmodel->fetch_featured_news();
		$data['featured_news_show']=$this->frontmodel->fetch_featured_news_home();
		$data['featured_quest'] = $this->frontmodel->fetch_home_featured_quest();
		$data['get_latest_question_home'] = $this->quest_ans_model->get_all_quest_user_info();
		$data['keyword_content'] = "higher studies,  international students, upcoming events, global events, universities events, study in UK, UK scholarship, higher education, uk student visa, sponsorship, study in Canada, expenditure, Counselling.";
		$data['description_content'] = "Attend Events, Study Abroad - Research, Connect & Meet Your Dream University";
		$this->load->view('auth/header',$data);
		$this->load->view('auth/home',$data);
		$this->load->view('auth/footer',$data);
       	
    }	
	
 function university_by_domain($univ_id,$univ_subdomain)
 {
  $data = $this->path->all_path();
  
  $data['univ_id_for_program'] = $univ_id;
  $data['university_details'] = $this->users->get_university_by_id($univ_id);
  $country_id = $data['university_details']['country_id'];
  $city_id = $data['university_details']['city_id'];
  $state_id = $data['university_details']['state_id'];
  $longitude = $data['university_details']['longitude'];
  $latitude = $data['university_details']['latitude'];
  $university_name = $data['university_details']['univ_name'];
  $university_address = $data['university_details']['address_line1'];
  $logged_user_id = $this->session->userdata('user_id');
  $pageURL = '';
  $domain = $_SERVER['HTTP_HOST'];
  $pageURL ="http://" . $domain . $_SERVER['REQUEST_URI'];
        
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
   redirect($pageURL);
   }
  }

  else if($this->input->post('unjoin_now'))
  {
   $data['unjoin_now_success'] = $this->users->unjoin_now($add_follower);
   redirect($pageURL);
  }
  
  else if($this->input->post('apply_now'))
  {
   $level_steps = $this->session->userdata('level_steps');
   if($level_steps != '')
   {
    $this->session->set_userdata('apply_college',$univ_id);
    redirect('find_college');
   }
   else {
   $condition = array(
    'firstname' => $this->input->post('apply_name'),
    'email' => $this->input->post('apply_email'),
    'phone_no1' => $this->input->post('apply_mobile'),
    'applied_univ_id'=> $univ_id
   );
   //print_r($apply_now_data);
   //$this->session->set_userdata($apply_now_data);
   $this->form_validation->set_rules('apply_name', 'Name ', 'trim|required|xss_clean');
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
     foreach ($errors as $k => $v) $data['errors'][$k] = $this->lang->line($v);
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
   $data['university_name'] = $university_name;
   //$data['header_title'] = $university_name;
   $title=$university_name;
    if($data['city_name_university'] != 0)
    {
		$title = $title. " - ". $data['city_name_university']['cityname'];
	}
	if($data['country_name_university'] != 0)
	{
		$title = $title. " , " . $data['country_name_university']['country_name'];
	}
	$data['header_title'] = $title;
   $this->load->view('auth/header',$data);
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
	
	function univ_id_of_domain($domain)
	{
	$this->db->select('*');
	$this->db->from('university');
	$this->db->where('subdomain_name',$domain);
	$query=$this->db->get();
	if($query->num_rows()>0)
	return $query->row_array();
	else
	return 0;
	}
	
	function genereate_the_subdomain_link($subdomain,$cat_type,$cat_title,$catid)
	{
		 $data = $this->path->all_path();
		 $url='';
		 if($cat_title!='' && $catid!='')
		 {
		 $cat_title=$this->process_url_title($cat_title);
		  $url='http://'.$subdomain.$data['domain_name'].'/'.$cat_type.'/'.$catid.'/'.$cat_title;
		 }
		 else if($cat_title=='' && $catid!='')
		 {
		 $url='http://'.$subdomain.$data['domain_name'].'/'.$cat_type;
		 }
		 else if($cat_title=='' && $catid=='')
		 {
		  $url='http://'.$subdomain.$data['domain_name'].'/'.$cat_type;
		 }
		 return $url;
	}
	function find_subdomain_name_and_id()
	{
	    $subdomain_arr = explode('.', $_SERVER['HTTP_HOST']);
		if(count($subdomain_arr)>2)
		{
		if($subdomain_arr[0]!='www')
		{
		$univ_subdomain['domain']=trim($subdomain_arr[0]);
		$univ_subdomain['university']=$this->subdomain->univ_id_of_domain($univ_subdomain['domain']);
		return $univ_subdomain;
		}
		}
	}
	function find_id_of_current_univ()
	{
	    $subdomain_arr = explode('.', $_SERVER['HTTP_HOST']);
		if(count($subdomain_arr)>2)
		{
		if($subdomain_arr[0]!='www')
		{
		$univ_subdomain['domain']=trim($subdomain_arr[0]);
		$univ_subdomain['university']=$this->subdomain->univ_id_of_domain($univ_subdomain['domain']);
		return $univ_subdomain['university']['univ_id'];
		}
		}
	}
	function generate_univ_link_by_subdomain($subdomain)
	{
	 $data = $this->path->all_path();
	 $univ_link='http://'.$subdomain.$data['domain_name'];
	 return $univ_link;
	}
	
	function process_url_title($cat_title)
	{
	     $cat_title=strtolower($cat_title);
		 $cat_title=str_replace("'",' ',$cat_title);
		 $cat_title=str_replace(' ','-',$cat_title);
		 $cat_title=str_replace('&','and',$cat_title);
		 $cat_title=str_replace(':','-',$cat_title);
		 $cat_title=str_replace(';','-',$cat_title);
		 $cat_title=str_replace('(','',$cat_title);
		 $cat_title=str_replace(')','',$cat_title);
		 $cat_title=str_replace('?','',$cat_title);
		 $cat_title=preg_replace('/[^a-zA-Z0-9_ -%][().][\/]/s', '', $cat_title);
		 if(strlen($cat_title)>150)
		 {
		 $cat_title=substr($cat_title,0,150);
		 }
		 return $cat_title;
		 
	}

}
/* End of file users.php */
/* Location: ./application/models/auth/users.php */