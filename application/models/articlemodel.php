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
		$this->load->library('pagination');
		$this->load->database();
	}
	
	function create_article()
	{
		$data['user_id'] = $this->tank_auth->get_admin_user_id();
		$config = array(
			'allowed_types' => 'jpg|jpeg|gif|png',
			'upload_path' => $this->univ_gallery_path,
		);
		
		$this->load->library('upload', $config);
		$flag=1;
		if($_FILES["userfile"]["name"]!=''){
		if(!$this->upload->do_upload())
		{
		  $flag=0;
		  $data['err_msg']=$this->upload->display_errors();
		  $this->load->view('admin/show_error',$data);
		 
		}
		}
		if($flag==1){
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
			   'article_type_ud' => $this->input->post('article_type_ud'),
			   'article_approve_status'=>'0'
			);
			$this->db->insert('article', $data_insert);
		return $flag;
	}
	else
	{
	return $flag;
	}
	}
	
	function article_detail()
	{$arr=array('0');
		$data['admin_user_level']=$this->tank_auth->get_admin_user_level();
		$data['user_id']	= $this->tank_auth->get_admin_user_id();
		$this->db->select('*');
		$this->db->from('article');
		$this->db->join('university', 'article.article_univ_id = university.univ_id');
		if($this->input->post('sel_id')=='1')
		{		
		$title=trim($this->input->post('search_box'));  		  
		$this->db->like('article_title',$title,'both');
		}
		if($this->input->post('approved')==1)
		{
			$status=$this->input->post('approved');
			$this->db->where('article.article_approve_status',$status);
		}
		if($this->input->post('sel_id')=='2')
		{
		$univ_name=trim($this->input->post('search_box'));  
		$query1=$this->db->query("select univ_id from university as uni where uni.univ_name like '%$univ_name%'");		  
		$res1=$query1->result_array();
		foreach($res1 as $res)				
					{
					 array_push($arr,$res['univ_id']);
					}
		$this->db->where_in('article.article_univ_id',$arr);
		}
		if($data['admin_user_level']=='3')
		{
		$this->db->where('university.user_id',$data['user_id']);
		}		
		$query=$this->db->get();
		$config['base_url']=base_url()."adminarticles/manage_articles/";
		$config['total_rows']=$query->num_rows();
		$config['per_page'] = '7'; 
		//$config['use_page_numbers'] = TRUE;
		$offset = $this->uri->segment(3); //this will work like site/folder/controller/function/query_string_for_cat/query_string_offset
        $limit = $config['per_page'];
		$this->db->select('*');
		$this->db->from('article');
		$this->db->join('university', 'article.article_univ_id = university.univ_id');
		if($this->input->post('sel_id')=='1')
		{		
		$title=trim($this->input->post('search_box'));  		  
		$this->db->like('article_title',$title,'both');
		}
		if($this->input->post('sel_id')=='2')
		{
		$univ_name=trim($this->input->post('search_box'));  
		$query1=$this->db->query("select univ_id from university as uni where uni.univ_name like '%$univ_name%'");		  
		$res1=$query1->result_array();
		foreach($res1 as $res)				
					{
					 array_push($arr,$res['univ_id']);
					}
		$this->db->where_in('article.article_univ_id',$arr);
		}
		if($data['admin_user_level']=='3')
		{
			$this->db->where('university.user_id',$data['user_id']);
		}
		$this->db->order_by("publish_time", "desc");
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
		$this->db->where('article_id',$article_id);
		$query=$this->db->get();
		return $query->result_array();
		
	}
	
	function update_article($article_id)
	{
		$data['user_id'] = $this->tank_auth->get_admin_user_id();
		$config = array(
			'allowed_types' => 'jpg|jpeg|gif|png',
			'upload_path' => $this->univ_gallery_path,
		);
		$this->load->library('upload', $config);
		$myflag=1;
		if($_FILES["userfile"]["name"]!=''){
		if(!$this->upload->do_upload())
		{
		  $myflag=0;
		  $data['err_msg']=$this->upload->display_errors();
		  $this->load->view('admin/show_error',$data);
		}
		}
		if($myflag==1){
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
			$data = array(
			   'article_title' => $this->input->post('title'),
			   'article_detail' => $this->input->post('detail'),
			   'postedby' => $data['user_id'],
			   'article_univ_id' => $this->input->post('university'),
			   'article_type_ud' => $this->input->post('article_type'),
			);
			$this->db->update('article', $data, array('article_id' => $article_id));
			if($myflag==1)
			{
			$data=array('article_image_path' =>$image_data['file_name']);
			$this->db->update('article', $data,array('article_id'=>$article_id));		
			}
	 }
	
	return $myflag;
	}
	
	function delete_single_article($article_id)
	{
		$this->db->delete('article', array('article_id' => $article_id));
	}
	
	function home_featured_unfeatured_article($f_status,$article_id)
	{
		if($f_status=='1')
		{
		$f_status='0';
		}
		else if($f_status=='0')
		{
		$f_status='1';
		}
		$data=array('featured_home_article'=>$f_status);
		$this->db->update('article', $data, array('article_id' => $article_id));
		return $f_status;
       
	}
	
	function approve_home_confirm($approve_status,$article_id)
	{
		if($approve_status=='1')
		{
		$approve_status='0';
		}
		else if($approve_status=='0')
		{
		$approve_status='1'; 
		}
		$data=array('article_approve_status'=>$approve_status);
		$this->db->update('article', $data, array('article_id' => $article_id));
		return $approve_status;
       
	}	
	
	function count_feature_article($field)
	{
		$this->db->select('*');
		$this->db->from('article');
		$this->db->where($field,'1');
		$query = $this->db->get();
		if($query->num_rows()<5)
		return 1;
		else
		return 0;
	}
	
	function delete_articles()
	{
		$eventcount=count($this->input->post('article_id'));	
		$article_id=$this->input->post('article_id');
		for( $i =0; $i < $eventcount ; $i++ )
		{
			if($this->input->post("check_article_".$article_id[$i])=='checked')
			{
			$this->db->delete('article', array('article_id' => $article_id[$i]));
			}
		}
	
	}
	
}