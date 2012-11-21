<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Autosuggest extends CI_Controller
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
		$this->lang->load('tank_auth');
	}

 function suggest_university()
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
	  $hint = strtolower($_GET["q"]);
	  if (!$hint) return;	
	  $data['univ_info']=$this->autosuggest_model->get_univ_detail($hint);
	  if($data['univ_info']!=0)
	  {
		foreach($data['univ_info'] as $univ_info) {
				$univ_name=$univ_info->univ_name;
				$univ_id=$univ_info->univ_id;
		if(file_exists(getcwd().'/uploads/univ_gallery/'.$univ_info->univ_logo_path) && $univ_info->univ_logo_path!='')	
		{
		$img_name=$univ_info->univ_logo_path;
		}		
		else
		{
		$img_name='logo.png';
		}
		$img='<img src="'.base_url().'/uploads/univ_gallery/'.$img_name.'" style="width:50px;height:25px;">';
		echo $img.'<b>'."$univ_name|$univ_id\n";
		}
	}
	 else
	 {
	 echo 'No Result Found';
	 }
			
	}	

 }
 
 function suggest_country()
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
	  $hint = strtolower($_GET["q"]);
	  $univ_id=$_GET['univ_id'];
	  if (!$hint) return;	
	  $data['country_info']=$this->autosuggest_model->get_country_detail_by_univ($hint,$univ_id);
	  if($data['country_info']!=0)
	  {
	  foreach($data['country_info'] as $country_info) {
			$country_name=$country_info->country_name;
			$country_id=$country_info->country_id;
			echo "$country_name|$country_id\n";
	  }
	  }
	 else
	 {
	  $data['country_info1']=$this->autosuggest_model->get_country_detail($hint);
	  if($data['country_info1']!=0)
	  {
	  foreach($data['country_info1'] as $country_info1) {
			$country_name=$country_info1->country_name;
			$country_id=$country_info1->country_id;
			echo "$country_name|$country_id\n";
	  }
	  }
	  else
	  {
	  echo 'No Result Found';
	  }
	 }
	 
			
	}
 }
 
 function suggest_state()
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
	  $hint = strtolower($_GET["q"]);
	  $univ_id=$_GET['univ_id'];
	  $country_id=$_GET['country_id'];
	  if (!$hint) return;	
	  $data['state_info']=$this->autosuggest_model->get_state_detail_by_univ($hint,$univ_id,$country_id);
	  if($data['state_info']!=0)
	  {
	  foreach($data['state_info'] as $state_info) {
			$state_name=$state_info->statename;
			$state_id=$state_info->state_id;
			echo "$state_name|$state_id\n";
	  }
	  }
	 else
	 {
	  $data['state_info1']=$this->autosuggest_model->get_state_detail($hint,$country_id);
	  if($data['state_info1']!=0)
	  {
	  foreach($data['state_info1'] as $state_info1) {
			$state_name=$state_info1->statename;
			$state_id=$state_info1->state_id;
			echo "$state_name|$state_id\n";
	  }
	  }
	  else
	  {
	  echo 'No Result Found';
	  }
	 }
	 
			
	}
 }

  function suggest_city()
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
	  $hint = strtolower($_GET["q"]);
	  $univ_id=$_GET['univ_id'];
	  $country_id=$_GET['country_id'];
	  $state_id=$_GET['state_id'];
	  if (!$hint) return;	
	  $data['city_info']=$this->autosuggest_model->get_city_detail_by_univ($hint,$univ_id,$country_id,$state_id);
	  if($data['city_info']!=0)
	  {
	  foreach($data['city_info'] as $city_info) {
			$city_name=$city_info->cityname;
			$city_id=$city_info->city_id;
			echo "$city_name|$city_id\n";
	  }
	  }
	 else
	 {
	  $data['city_info1']=$this->autosuggest_model->get_city_detail($hint,$country_id,$state_id);
	  if($data['city_info1']!=0)
	  {
	  foreach($data['city_info1'] as $city_info1) {
			$city_name=$city_info1->cityname;
			$city_id=$city_info1->city_id;
			echo "$city_name|$city_id\n";
	  }
	  }
	  else
	  {
	  echo 'No Result Found';
	  }
	 }		
	}
 }
 
}

/* End of file auth.php */
/* Location: ./application/controllers/auth.php */