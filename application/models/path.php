<?php
class Path extends CI_Model{
	
  function __construct()
  {
    parent::__construct();
  }
 	function all_path(){
	$data['base'] = $this->config->item('base_url');
	$data['admin']=$this->config->item('admin');
	$data['css_path'] = $this->config->item('css_path');	
	$data['img_path'] = $this->config->item('img_path');
	$data['admin_css'] = $this->config->item('admin_css_path');
	$data['js'] =$this->config->item('js');
	$data['admin_img'] =$this->config->item('admin_img');
	$data['domain_name'] =$this->config->item('domain');
	$this->load->library('email');
	return $data;	
 	}
}
?>