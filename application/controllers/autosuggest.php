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
			echo "$univ_name|$univ_id\n";
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
	  if (!$hint) return;	
	   if($data['admin_user_level']=='3')
	   {
	   $univ_id=$univ_detail_edit->univ_id;
	   }
	   else
	   {
	   $univ_id=0;
	   }
	  $data['univ_info']=$this->autosuggest_model->get_country_detail($hint,$univ_id);
	  if($data['univ_info']!=0)
	  {
	  foreach($data['univ_info'] as $univ_info) {
			$univ_name=$univ_info->univ_name;
			$univ_id=$univ_info->univ_id;
			echo "$univ_name|$univ_id\n";
	 }
	 }
	 else
	 {
	 echo 'No Result Found';
	 }
			
	}
 }

 
}

/* End of file auth.php */
/* Location: ./application/controllers/auth.php */