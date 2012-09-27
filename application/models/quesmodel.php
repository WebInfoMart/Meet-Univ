<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Quesmodel extends CI_Model
{
	var $gallery_path;
		var $univ_gallery_path;
	function __construct()
	{
	
		parent::__construct();
		$this->gallery_path = realpath(APPPATH . '../uploads/home_gallery');
		$this->univ_gallery_path = realpath(APPPATH . '../uploads/ques_ques_images');
		$this->load->library('pagination');
		$this->load->database();
	}
	
	function create_ques()
	{$flag=1;
		$data['user_id'] = $this->tank_auth->get_admin_user_id();		
		$data_insert = array(
			   'q_title' => $this->input->post('title'),
			   'q_detail' => $this->input->post('detail'),
			   'q_askedby' => $data['user_id'],			    
			   'q_univ_id' => $this->input->post('colleges'),
			   'q_category' => $this->input->post('category'),
			   'q_featured_home_que'=>'0',
			   'q_approve'=>'0'
			);
			//print_r($data_insert);exit;
			$this->db->insert('questions', $data_insert);
			return $flag;
	}

	function ques_detail()
	{$arr=array('0');
		$data['admin_user_level']=$this->tank_auth->get_admin_user_level();
		$data['user_id']	= $this->tank_auth->get_admin_user_id();
		$this->db->select('*');
		$this->db->from('questions');
		$this->db->join('university', 'questions.q_univ_id = university.univ_id','left');		
		if($this->input->post('approved')==1)
		{
			$status=0;
			$this->db->where('questions.q_approve',$status);
		}
		if($this->input->post('featured')==1)
		{
			$status=$this->input->post('featured');
			$this->db->where('questions.q_featured_home_que',$status);
		}
		if($this->input->post('sel_id')=='1')
		{		
		$title=trim($this->input->post('search_box'));  		  
		$this->db->like('q_title',$title,'both');
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
		$this->db->where_in('questions.q_univ_id',$arr);
		}
		if($data['admin_user_level']=='3')
		{
		$this->db->where('university.user_id',$data['user_id']);
		}		
		$query=$this->db->get();
		$config['base_url']=base_url()."adminques/manage_ques/";
		$config['total_rows']=$query->num_rows();
		$config['per_page'] = '5'; 
		//$config['use_page_numbers'] = TRUE;
		$offset = $this->uri->segment(3); //this will work like site/folder/controller/function/query_string_for_cat/query_string_offset
        $limit = $config['per_page'];
		$this->db->select('*');
		$this->db->from('questions');
		$this->db->join('university', 'questions.q_univ_id = university.univ_id','left');
		if($this->input->post('approved')==1)
		{
			$status=0;;
			$this->db->where('questions.q_approve',$status);
		}
		if($this->input->post('featured')==1)
		{
			$status=$this->input->post('featured');
			$this->db->where('questions.q_featured_home_que',$status);
		}
		if($this->input->post('sel_id')=='1')
		{		
		$title=trim($this->input->post('search_box'));  		  
		$this->db->like('q_title',$title,'both');
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
		$this->db->where_in('questions.q_univ_id',$arr);
		}
		if($data['admin_user_level']=='3')
		{
			$this->db->where('university.user_id',$data['user_id']);
		}
		$this->db->order_by("q_asked_time", "desc");
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
	
	function fetch_ques_ids($univ_id)
	{
		$this->db->select('que_id');
		$this->db->from('questions');
		$this->db->where('q_univ_id',$univ_id);
		$query = $this->db->get();
		$res=$query->result_array();
		$i=0;
		foreach($res as $res1)
		{
		$r[]=$res[$i]['que_id'];
		$i++;
		}
		return $r;
	}
	
	function fetch_ques_detail($ques_id)
	{
		$this->db->select('*');
		$this->db->from('questions');
		$this->db->join('university', 'questions.q_univ_id = university.univ_id');		
		$this->db->where('que_id',$ques_id);
		$query=$this->db->get();
		return $query->result_array();
		
	}
	
	function fetch_ques_ans($ques_id)
	{
		$this->db->select('*');
		$this->db->from('comment_table');	
		$this->db->where('comment_on_id',$ques_id);
		$query=$this->db->get();
		return $query->result_array();
		
	}
	function ans_count($id)
	{
		$query=$this->db->query("select comment_id from comment_table where comment_on_id='".$id."'");		
		return $query->num_rows();
	}
	
	function update_ques($ques_id)
	{
		$data['user_id'] = $this->tank_auth->get_admin_user_id();	
			$id=$this->input->post('que_id');
			$data = array(
		   'q_title' => $this->input->post('title'),
			'q_detail' => $this->input->post('detail')
		);
		//print_r($data);exit;
		$this->db->where('que_id',$id);
		$this->db->update('questions', $data, array('que_id' => $ques_id));
		return 1;
		
	}	
	
	function delete_single_ques($ques_id)
	{
		$this->db->delete('questions', array('que_id' => $ques_id));
		$this->db->delete('comment_table', array('comment_on_id' => $ques_id));
	}
	function dropans()	
	{
		$id=$this->input->post('id');
		$this->db->delete('comment_table', array('comment_id' => $id));	
		return 1;
	}
function edit_ans()	
	{
		$id=$this->input->post('id');
		$ans=$this->input->post('ans');
		$record=array(		
		'commented_text'=>$ans
		);
		$this->db->where('comment_id',$id);
		$this->db->update('comment_table', $record);	
		return 1;
	}	
	function home_featured_unfeatured_ques($f_status,$ques_id)
	{
		if($f_status=='1')
		{
		$f_status='0';
		}
		else if($f_status=='0')
		{
		$f_status='1';
		}
		$data=array('q_featured_home_que'=>$f_status);
		$this->db->update('questions', $data, array('que_id' => $ques_id));
		return $f_status;
       
	}
	
	function approve_home_confirm($approve_status,$ques_id)
	{
		if($approve_status=='1')
		{
		$approve_status='0';
		}
		else if($approve_status=='0')
		{
		$approve_status='1'; 
		}
		$data=array('q_approve'=>$approve_status);
		$this->db->update('questions', $data, array('que_id' => $ques_id));
		return $approve_status;
       
	}	
	
	function count_feature_ques($field)
	{
		$this->db->select('*');
		$this->db->from('questions');
		$this->db->where($field,'1');
		$query = $this->db->get();
		if($query->num_rows()<2)
		return 1;
		else
		return 0;
	}
	
	function delete_ques()
	{
		$eventcount=count($this->input->post('que_id'));	
		$ques_id=$this->input->post('que_id');
		for( $i =0; $i < $eventcount ; $i++ )
		{
			if($this->input->post("check_ques_".$ques_id[$i])=='checked')
			{
			$this->db->delete('questions', array('que_id' => $ques_id[$i]));
			$this->db->delete('comment_table', array('comment_on_id' => $ques_id[$i]));
			}
		}
	
	}
	
	function addans()
	{
		$user_id = $this->tank_auth->get_admin_user_id();	
		$id=$this->input->post('id');
		$data = array(
		'commented_by' => $user_id,
		'comment_on_id'=>$id,
		'commented_on'=>'qna',
		'commented_text' => $this->input->post('answer')
		);
		//print_r($data);exit;		
		$this->db->insert('comment_table',$data);
		return 1;
		
	}	
	
}