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
		//$this->program_parent	= $ci->config->item('db_table_prefix', 'tank_auth').$this->program_parent;
		//$this->program_educ_level	= $ci->config->item('db_table_prefix', 'tank_auth').$this->program_educ_level;
		//$this->country	= $ci->config->item('db_table_prefix', 'tank_auth').$this->country;
		
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
	
	
	/* function UnixTime($mysql_timestamp){ 
    if (preg_match('/(\d{4})(\d{2})(\d{2})(\d{2})(\d{2})(\d{2})/', $mysql_timestamp, $pieces) 
        || preg_match('/(\d{2})(\d{2})(\d{2})(\d{2})(\d{2})(\d{2})/', $mysql_timestamp, $pieces)) { 
            $unix_time = mktime($pieces[4], $pieces[5], $pieces[6], $pieces[2], $pieces[3], $pieces[1]); 
    } elseif (preg_match('/\d{4}\-\d{2}\-\d{2} \d{2}:\d{2}:\d{2}/', $mysql_timestamp) 
        || preg_match('/\d{2}\-\d{2}\-\d{2} \d{2}:\d{2}:\d{2}/', $mysql_timestamp) 
        || preg_match('/\d{4}\-\d{2}\-\d{2}/', $mysql_timestamp) 
        || preg_match('/\d{2}\-\d{2}\-\d{2}/', $mysql_timestamp)) { 
            $unix_time = strtotime($mysql_timestamp); 
    } elseif (preg_match('/(\d{4})(\d{2})(\d{2})/', $mysql_timestamp, $pieces) 
        || preg_match('/(\d{2})(\d{2})(\d{2})/', $mysql_timestamp, $pieces)) { 
            $unix_time = mktime(0, 0, 0, $pieces[2], $pieces[3], $pieces[1]); 
    } 
  return $unix_time; 
} */

/// Second function

/* function GetTimeDiff($timestamp) {
    $how_log_ago = '';
    $seconds = time() - $timestamp; 
    $minutes = (int)($seconds / 60);
    $hours = (int)($minutes / 60);
    $days = (int)($hours / 24);
    if ($days >= 1) {
      $how_log_ago = $days . ' day' . ($days != 1 ? 's' : '');
    } else if ($hours >= 1) {
      $how_log_ago = $hours . ' hour' . ($hours != 1 ? 's' : '');
    } else if ($minutes >= 1) {
      $how_log_ago = $minutes . ' minute' . ($minutes != 1 ? 's' : '');
    } else {
      $how_log_ago = $seconds . ' second' . ($seconds != 1 ? 's' : '');
    }
    return $how_log_ago; 
	} */
	
	
	function post_quest($quest)
	{
		$this->db->set($quest);
		$this->db->insert('questions');
		return $this->db->affected_rows() ? 1 : 0;
	}
	
	public static function convertToFBTimestamp( $d ) 
{
    if(isset($d))
    {
	//echo time() ."-". $d ;
	//echo $script_tz = date_default_timezone_get();
	//echo date('Y-m-d;H:i:s');
  $d = ( is_string( $d ) ? strtotime( $d ) : $d ); // Date in Unix Time
  if( ( time() - $d ) < 60 )
    return ( time() - $d ).' seconds ago';
  if( ( time() - $d ) < 120 )
    return 'about a minute ago';
  if( ( time() - $d ) < 3600 )
    return (int) ( ( time() - $d ) / 60 ).' minutes ago';
  if( ( time() - $d ) == 3600 )
    return '1 hour ago';
  if( date( 'Ymd' ) == date( 'Ymd' , $d ) )
    return (int) ( ( time() - $d ) / 3600 ).' hours ago';
  if( ( time() - $d ) < 86400 )
    return 'Yesterday at '.date( 'g:ia' , $d );
  if( ( time() - $d ) < 259200 )
  {
        return date( 'l \a\t g:ia' , $d );
    }
  if( date( 'Y' ) == date( 'Y' , $d ) )
  {
      return date( 'F, jS \a\t g:ia' , $d );
  }
//, Y
  return date( 'F j, Y \a\t g:ia' , $d );
}
}
	function get_all_quest_user_info()
	{
		/*$this->db->select('*');
		$this->db->from('questions');
		$this->db->join('users','questions.q_askedby = users.id');
		$this->db->join('user_profiles','questions.q_askedby = user_profiles.user_id');
		$query = $this->db->get();
		
		$numrows=$query->num_rows();
		if($numrows > 5)
		{
			$rows_per_page = 5;
		}
		else {
		$rows_per_page = $numrows;
		}
		$config['base_url']=base_url()."quest_ans_controler/QuestandAns";
		$config['total_rows']=$numrows;
		$config['per_page'] = $rows_per_page; 
		$offset = $page;//this will work like site/folder/controller/function/query_string_for_cat/query_string_offset
		$limit = $config['per_page'];
		*/
		$this->db->select('*');
		$this->db->from('questions');
		$this->db->join('users','questions.q_askedby = users.id');
		$this->db->join('user_profiles','questions.q_askedby = user_profiles.user_id');
		$this->db->order_by("que_id","desc");
		//$this->db->limit($limit,$offset);
		$query = $this->db->get(); 
	//	$this->pagination->initialize($config);
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
	
	
	
	function get_all_quest_of_univ_user_info($univ_id)
	{
		$this->db->select('*');
		$this->db->from('questions');
		$this->db->where('q_univ_id',$univ_id);
		$this->db->join('users','questions.q_askedby = users.id');
		$this->db->join('user_profiles','questions.q_askedby = user_profiles.user_id');
		$query = $this->db->get();
		if($query->num_rows() > 0)
		{
			/* $times = $query->result_array();
			//$before_time=array();
			foreach($times as $time)
			{
				$d = $time['q_asked_time'];
				//$seconds = $this->UnixTime($d);
				//echo $d; 
				$before_time[] = $this->convertToFBTimestamp(strtotime($d));
				
				//exit;
				
			} */
			//print_r($before_time);
			//exit;
			//return $query->result_array();
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
				$this->db->from('answers');
				$this->db->where('qid',$getAns['que_id']);
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
}






