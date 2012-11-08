<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Quest_ans_model extends CI_Model
{
	private $table_name			= 'users';			// user accounts
	private $profile_table_name	= 'user_profiles';	// user profiles
	var $gallery_path;
	//var $gallery_path_url;
	
	function __construct()
	{
		parent::__construct();
		$this->gallery_path = realpath(APPPATH . '../uploads');
		//$this->gallery_path_url = base_url().'uploads/';
		$ci =& get_instance();
		$this->table_name			= $ci->config->item('db_table_prefix', 'tank_auth').$this->table_name;
		$this->profile_table_name	= $ci->config->item('db_table_prefix', 'tank_auth').$this->profile_table_name;
		//$this->db->query("SET time_zone='+5:30'");
		$this->load->library('pagination');
	}
	
	function collage_list()
	{
		$this->db->select('*');
		$this->db->from('university');
		$query = $this->db->get();
		if($query->num_rows() > 0)
		{
			return $query->result_array();
		}
		else {
		return 0;
		}
	}
	
	
	function post_quest($quest)
	{
		
		$this->db->set($quest);
		$this->db->insert('questions');
		return $this->db->affected_rows() ? 1 : 0;
	}
	function quest_exist($asked_by)
	{
		$this->db->select('que_id');
		$this->db->from('questions');
		$this->db->where('q_askedby',$asked_by);
		$this->db->where('q_title',$this->input->post('quest_title'));
		$qry=$this->db->get();
		return $qry->num_rows();
	}
	
	

	function get_all_quest_user_info()
	{
		
		$this->db->select('*');
		$this->db->from('questions');
		$this->db->join('users','questions.q_askedby = users.id');
		$this->db->join('user_profiles','questions.q_askedby = user_profiles.user_id');
		$this->db->join('university','questions.q_univ_id = university.univ_id','left');
		$this->db->order_by("que_id","desc");
		//$this->db->limit($limit,$offset);
		$query = $this->db->get(); 
		if($query->num_rows() > 0)
		{
			$q_detail = $query->result_array();
			foreach($q_detail as $getAns)
			{
				$this->db->select('*');
				$this->db->from('comment_table');
				$this->db->where('comment_on_id',$getAns['que_id']);
				$query = $this->db->get();
				$cntAns[] = $query->num_rows();
			}
			$quest_data = array();
			$quest_data['quest_detail'] = $q_detail;
			
			$quest_data['ans_count'] = $cntAns;
			return $quest_data;
		}
		else{
		return 0;
		}
	}
	function get_recent_quest_user_info()
	{
		$quest_data = array();
		$this->db->select('*');
		$this->db->from('questions');
		$this->db->join('university','questions.q_univ_id = university.univ_id','left');
		$this->db->join('users','questions.q_askedby = users.id');
		$this->db->join('user_profiles','questions.q_askedby = user_profiles.user_id');
		$this->db->order_by("que_id","desc");
		$query = $this->db->get(); 
		$no_of_que=$query->num_rows();
		$quest_data['no_of_que']=$no_of_que;
		$config['base_url']= base_url()."Recent_Questions/question/all/";
		$config['total_rows']=$no_of_que;
		$config['per_page'] = '6'; 
		$config['uri_segment'] = 4;
		$offset = $this->uri->segment('4');//this will work like site/folder/controller/function/query_string_for_cat/query_string_offset
		$limit = $config['per_page'];
		
		$this->db->select('*');
		$this->db->from('questions');
		$this->db->join('university','questions.q_univ_id = university.univ_id','left');
		$this->db->join('users','questions.q_askedby = users.id');
		$this->db->join('user_profiles','questions.q_askedby = user_profiles.user_id');		
		$this->db->order_by("que_id","desc");
		$this->db->limit($limit,$offset);
		$query = $this->db->get(); 
		$q_detail=$query->result_array();
		$quest_data['quest_detail'] = $q_detail;
	//	$quest_data['ans_count'] = 0;
		$this->pagination->initialize($config);
		return $quest_data;
		/*if($no_of_que > 0)
		{
			$q_detail = $query->result_array();
			foreach($q_detail as $getAns)
			{
				$this->db->select('*');
				$this->db->from('answers');
				$this->db->where('qid',$getAns['que_id']);
				$query = $this->db->get();
				$cntAns[] = $query->num_rows();
			}
			$quest_data['quest_detail'] = $q_detail;
			
			$quest_data['ans_count'] = $cntAns;
			return $quest_data;
		}
		else{
		return 0;
		}*/
	}
	public function count_all_questions()
	{
		$this->db->select('*');
		$this->db->from('questions');
		$count = $this->db->count_all_results();
		if($count > 0)
		{
			return $count;
		}
		else{
		return 0;
		}
	}
	
	public function get_single_quest_detail($univ_id,$quest_id,$user_id)
	{
		if($univ_id == 'meetquest')
		{
			$where_clause = array(
			'que_id'=>$quest_id,
			'q_category'=>'general'
			);	
		}
		else{
			$where_clause = array(
			'que_id'=>$quest_id,
			'q_univ_id'=>$univ_id
			);
		}
		$this->db->select('*');
		$this->db->from('questions');
		$this->db->where($where_clause);
		$this->db->join('users','questions.q_askedby = users.id');
		$this->db->join('user_profiles','questions.q_askedby = user_profiles.user_id');
		$query = $this->db->get();
		if($query->num_rows() > 0)
		{
			return $query->row_array();
		}
		else{
		return 0;
		}
	}
	public function get_single_quest_comments($quest_id)
	{
		$this->db->select('*');
		$this->db->from('comment_table');
		$this->db->where('comment_on_id',$quest_id);		
		$query = $this->db->get();
		if($query->num_rows() > 0)
		{
			return $query->result_array();
		}
		else{
		return 0;
		}
	}
	public function get_noof_comments($quest_id)
	{
		$this->db->select('*');
		$this->db->from('comment_table');
		$this->db->where('comment_on_id',$quest_id);		
		$query = $this->db->get();
		return $query->num_rows();		
	}
	
	
	
	function get_all_quest_of_univ_user_info($univ_id)
	{
		$this->db->select('*');
		$this->db->from('questions');
		$this->db->where('q_univ_id',$univ_id);
		$this->db->join('users','questions.q_askedby = users.id');
		$this->db->join('user_profiles','questions.q_askedby = user_profiles.user_id');
		$this->db->join('university','questions.q_univ_id = university.univ_id','left');
		$this->db->order_by('q_asked_time','desc');
		$this->db->limit(10);
		$query = $this->db->get();
		if($query->num_rows() > 0)
		{
			$q_detail = $query->result_array();
			foreach($q_detail as $getAns)
			{
				$this->db->select('*');
				$this->db->from('answers');
				$this->db->where('qid',$getAns['que_id']);
				$query = $this->db->get();
				$cntAns[] = $query->num_rows();
			}
			$quest_data = array();
			$quest_data['quest_detail'] = $q_detail;
			
			$quest_data['ans_count'] = $cntAns;
			//echo count($quest_data['ans_count']);
			return $quest_data;
		}
		else{
		return 0;
		}
	}
	
	public function count_all_questions_of_univ($univ_id)
	{
		$this->db->select('*');
		$this->db->from('questions');
		$this->db->where('q_univ_id',$univ_id);
		$count = $this->db->count_all_results();
		if($count > 0)
		{
			return $count;
		}
		else{
		return 0;
		}
	}
	
	function latest_question_profile()
	{
		$this->db->select('*');
		$this->db->from('questions');
		$this->db->join('users','questions.q_askedby = users.id');
		$this->db->join('university','questions.q_univ_id = university.univ_id','left');
		$this->db->join('user_profiles','questions.q_askedby = user_profiles.user_id');
		$this->db->order_by("que_id","desc");
		$this->db->limit(5);
		$query = $this->db->get(); 
		if($query->num_rows() > 0)
		{
			$q_detail = $query->result_array();
			foreach($q_detail as $getAns)
			{
				$this->db->select('*');
				$this->db->from('comment_table');
				$this->db->where('comment_on_id',$getAns['que_id']);
				$query = $this->db->get();
				$cntAns[] = $query->num_rows();
			}
			$quest_data = array();
			$quest_data['quest_detail'] = $q_detail;
			
			$quest_data['ans_count'] = $cntAns;
			return $quest_data;
		}
		else{
		return 0;
		}
	} 
	
	function find_user_id_of_question($que_id)
	{
	
				$this->db->select('q_askedby');
				$this->db->from('questions');
				$this->db->where('que_id',$que_id);
				$query = $this->db->get();
				$res=$query->row_array();
				if($query->num_rows()>0)
				{
				 return $res['q_askedby'];
				}
				else
				{
				return 0;
				}
				
	}
	
	
}






