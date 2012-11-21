<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Newsmodel extends CI_Model
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
	
	function create_news()
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
			   'news_title' => $this->input->post('title'),
			   'news_detail' => $this->input->post('detail'),
			   'postedby' => $data['user_id'],
			    'news_image_path' => $image_data['file_name'],
			   'news_univ_id' => $this->input->post('university'),
			   'news_type_ud' => $this->input->post('news_type_ud'),
			   'featured_home_news'=>'1'
			);
			//print_r($data_insert);exit;
			$this->db->insert('news', $data_insert);
		return $flag;
	}
	else
	{
	return $flag;
	}
	}
	
	function news_detail()
	{$arr=array('0');
		$data['admin_user_level']=$this->tank_auth->get_admin_user_level();
		$data['user_id']	= $this->tank_auth->get_admin_user_id();
		$univ=$this->univ_vs_user_model->get_assigned_univ_info($data['user_id']);
		$this->db->select('*');
		$this->db->from('news');
		$this->db->join('university', 'news.news_univ_id = university.univ_id');		
		if($this->input->post('approved')==1)
		{
			$status=$this->input->post('approved');
			$this->db->where('news.news_approve_status',$status);
		}
		if($this->input->post('featured')==1)
		{
			$status=$this->input->post('featured');
			$this->db->where('news.featured_home_news',$status);
		}
		if($this->input->post('sel_id')=='1')
		{		
		$title=trim($this->input->post('search_box'));  		  
		$this->db->like('news_title',$title,'both');
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
		$this->db->where_in('news.news_univ_id',$arr);
		}
		if($data['admin_user_level']=='3')
		{
		$this->db->where('university.user_id',$data['user_id']);
		}
		if($data['admin_user_level']=='4')
		{
			$this->db->where_in('news_univ_id',$univ);
		}
		$query=$this->db->get();
		$config['base_url']=base_url()."adminnews/manage_news/";
		$config['total_rows']=$query->num_rows();
		$config['per_page'] = '7'; 
		//$config['use_page_numbers'] = TRUE;
		$offset = $this->uri->segment(3); //this will work like site/folder/controller/function/query_string_for_cat/query_string_offset
        $limit = $config['per_page'];
		$this->db->select('*');
		$this->db->from('news');
		$this->db->join('university', 'news.news_univ_id = university.univ_id');
		if($this->input->post('approved')==1)
		{
			$status=$this->input->post('approved');
			$this->db->where('news.news_approve_status',$status);
		}
		if($this->input->post('featured')==1)
		{
			$status=$this->input->post('featured');
			$this->db->where('news.featured_home_news',$status);
		}
		if($this->input->post('sel_id')=='1')
		{		
		$title=trim($this->input->post('search_box'));  		  
		$this->db->like('news_title',$title,'both');
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
		$this->db->where_in('news.news_univ_id',$arr);
		}
		if($data['admin_user_level']=='3')
		{
			$this->db->where('university.user_id',$data['user_id']);
		}
		if($data['admin_user_level']=='4')
		{
			$this->db->where_in('news_univ_id',$univ);
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
	
	function fetch_news_ids($univ_id)
	{
		$this->db->select('news_id');
		$this->db->from('news');
		$this->db->where('news_univ_id',$univ_id);
		$query = $this->db->get();
		$res=$query->result_array();
		$i=0;
		foreach($res as $res1)
		{
		$r[]=$res[$i]['news_id'];
		$i++;
		}
		return $r;
	}
	
	function fetch_news_detail($news_id)
	{
		$this->db->select('*');
		$this->db->from('news');
		$this->db->join('university', 'news.news_univ_id = university.univ_id');
		$this->db->where('news_id',$news_id);
		$query=$this->db->get();
		return $query->result_array();
		
	}
	
	function update_news($news_id)
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
			   'news_title' => $this->input->post('title'),
			   'news_detail' => $this->input->post('detail'),
			   'postedby' => $data['user_id'],
			   'news_univ_id' => $this->input->post('university'),
			   'news_type_ud' => $this->input->post('news_type'),
			);
			$this->db->update('news', $data, array('news_id' => $news_id));
			if($myflag==1)
			{
			$data=array('news_image_path' =>$image_data['file_name']);
			$this->db->update('news', $data,array('news_id'=>$news_id));		
			}
	 }
	
	return $myflag;
	}
	
	function delete_single_news($news_id)
	{
		$this->db->delete('news', array('news_id' => $news_id));
	}
	
	function home_featured_unfeatured_news($f_status,$news_id)
	{
		if($f_status=='1')
		{
		$f_status='0';
		}
		else if($f_status=='0')
		{
		$f_status='1';
		}
		$data=array('featured_home_news'=>$f_status);
		$this->db->update('news', $data, array('news_id' => $news_id));
		return $f_status;
       
	}
	
	function approve_home_confirm($approve_status,$news_id)
	{
		if($approve_status=='1')
		{
		$approve_status='0';
		}
		else if($approve_status=='0')
		{
		$approve_status='1'; 
		}
		$data=array('news_approve_status'=>$approve_status);
		$this->db->update('news', $data, array('news_id' => $news_id));
		return $approve_status;
       
	}	
	
	function count_feature_news($field)
	{
		$this->db->select('*');
		$this->db->from('news');
		$this->db->where($field,'1');
		$query = $this->db->get();
		if($query->num_rows()<2)
		return 1;
		else
		return 0;
	}
	
	function delete_news()
	{
		$eventcount=count($this->input->post('news_id'));	
		$news_id=$this->input->post('news_id');
		for( $i =0; $i < $eventcount ; $i++ )
		{
			if($this->input->post("check_news_".$news_id[$i])=='checked')
			{
			$this->db->delete('news', array('news_id' => $news_id[$i]));
			}
		}
	
	}
	
}