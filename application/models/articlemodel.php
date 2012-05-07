<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Articlemodel extends CI_Model
{
	var $gallery_path;
		var $univ_gallery_path;
	function __construct()
	{
	
		parent::__construct();
		$this->gallery_path = realpath(APPPATH . '../uploads/home_gallery');
		$this->univ_gallery_path = realpath(APPPATH . '../uploads/news_article_images');
		$this->gallery_path_url = 'http://127.0.0.1/Meet-Univ/uploads/';
		$this->load->library('pagination');
		$this->load->database();
	}
	
	function create_article()
	{
		$data['user_id'] = $this->tank_auth->get_admin_user_id();
		$config = array(
			'allowed_types' => 'jpg|jpeg|gif|png',
			'upload_path' => $this->univ_gallery_path,
			'max_size' => 500
		);
		
		$this->load->library('upload', $config);
		$flag=0;
		if($_FILES["userfile"]["name"]!=''){
		echo "kjkljkljkl";
		if(!$this->upload->do_upload())
		{
		echo "opopopop";
		  $flag=1;
		  $data['err_msg']=$this->upload->display_errors();
		  $this->load->view('admin/show_error',$data);
		 
		}
		}
		if($flag==0){
		$image_data = $this->upload->data();
		
		$config = array(
			'source_image' => $image_data['full_path'],
			'new_image' => $this->univ_gallery_path . '/thumbs',
			'maintain_ration' => true,
			'width' => 150,
			'height' => 100
		);
		
		$this->load->library('image_lib', $config);
		$this->image_lib->resize();
		
		$data_insert = array(
			   'article_title' => $this->input->post('title'),
			   'article_detail' => $this->input->post('detail'),
			   'postedby' => $data['user_id'],
			    'article_image_path' => $image_data['file_name'],
			   'article_univ_id' => $this->input->post('university'),
			   'article_type_ud' => $this->input->post('article_type_ud')
			);
			$this->db->insert('article', $data_insert);

	}
	}
	
	function article_detail()
	{
	$data['admin_user_level']=$this->tank_auth->get_admin_user_level();
		$data['user_id']	= $this->tank_auth->get_admin_user_id();
		$this->db->select('*');
		$this->db->from('article');
		$this->db->join('university', 'article.article_univ_id = university.univ_id');
		$this->db->join('country', 'country.country_id = article.article_univ_id','left');
		$this->db->join('city', 'article.article_univ_id = city.city_id','left');
		if($data['admin_user_level']=='2')
		{
		$this->db->where('university.user_id',$data['user_id']);
		}
		$query=$this->db->get();
		$config['base_url']=base_url()."adminarticles/index/";
		$config['total_rows']=$query->num_rows();
		$config['per_page'] = '7'; 
		//$config['use_page_numbers'] = TRUE;
		$offset = $this->uri->segment(3); //this will work like site/folder/controller/function/query_string_for_cat/query_string_offset
        $limit = $config['per_page'];
		$this->db->select('*');
		$this->db->from('article');
		$this->db->join('university', 'article.article_univ_id = university.univ_id');
		$this->db->join('country', 'country.country_id = article.article_univ_id','left');
		$this->db->join('city', 'article.article_univ_id = city.city_id','left');
		if($data['admin_user_level']=='2')
		{
		$this->db->where('university.user_id',$data['user_id']);
		}
		$this->db->limit($limit,$offset);
		$query=$this->db->get();
		$this->pagination->initialize($config);
		return $query->result();
	}
	
	function fetch_univ_id($user_id)
	{
		$this->db->select('univ_id');
		$this->db->from('university');
		$this->db->where('user_id',$user_id);
		$query = $this->db->get();
		return $query->row_array();
	}
	
	function fetch_article_ids($univ_id)
	{
		$this->db->select('article_id');
		$this->db->from('article');
		$this->db->where('article_univ_id',$univ_id);
		$query = $this->db->get();
		$res=$query->result_array();
		$i=0;
		foreach($res as $res1)
		{
		$r[]=$res[$i]['article_id'];
		$i++;
		}
		return $r;
	}
	
	function fetch_article_detail($article_id)
	{
		$this->db->select('*');
		$this->db->from('article');
		$this->db->join('university', 'article.article_univ_id = university.univ_id');
		//$this->db->join('country', 'country.country_id = article.event_country_id','left');
		//$this->db->join('city', 'events.event_city_id = city.city_id','left');
		//$this->db->join('state', 'state.state_id = events.event_state_id','left');
		$this->db->where('article_id',$article_id);
		$query=$this->db->get();
		return $query->result_array();
		
	}
}