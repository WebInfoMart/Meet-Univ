<?php
class Path extends CI_Model{
	
  function __construct()
  {
    parent::__construct();
  }
 	function all_path(){
	$data['base'] = $this->config->item('base_url');
	$data['css_path'] = $this->config->item('css_path');	
	$data['img_path'] = $this->config->item('img_path');
	$data['admin_css'] = $this->config->item('admin_css_path');
	return $data;	
 	}
}
?>