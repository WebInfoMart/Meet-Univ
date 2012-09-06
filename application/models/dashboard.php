<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

/**
 * Users
 *
 * This model represents user authentication data. It operates the following tables:
 * - user account data,
 * - user profiles
 *
 * @package	Tank_auth
 * @author	Ilya Konyukhov (http://konyukhov.com/soft/)
 */
class Dashboard extends CI_Model
{
	function __construct()
	{
		parent::__construct();
		
	}
	
	function fetch_lead_data_date_wise($univ_id)
	{
		
		$query=$this->db->query("SELECT * FROM `lead_data` where find_in_set('".$univ_id."',applied_univ_id) order by lead_created_time desc LIMIT 0,10");
		if($query->num_rows()>0)
		{
		return $query->result_array();
		}
		else
		return 0;
	}
	
	function count_no_of_registerd_user_by_date($univ_id,$timestamp)
	{
	$date=$timestamp;
	$query=$this->db->query("SELECT * FROM `lead_data` where find_in_set('".$univ_id."',applied_univ_id) && lead_created_time LIKE '$date%'");
	return $query->num_rows();
	}
	
	function count_no_of_event_registerd_user_by_date($univ_id,$timestamp)
	{
	$date=$timestamp;
	$this->db->select('*');
	$this->db->from('event_register');
	$this->db->where('register_event_univ_id',$univ_id);
	$this->db->like('event_registered_time', $date);
	$query=$this->db->get();
	return $query->num_rows();
	}
	
	function count_lead_data_by_univ($univ_id)
	{
	$query=$this->db->query("SELECT * FROM `lead_data` where find_in_set('".$univ_id."',applied_univ_id)");
	return $query->num_rows();
	}
	
	function find_no_of_register_of_just_upcoming_event($univ_id)
	{
		$this->db->select("*");
		$this->db->from('events');
		$condition=array('event_univ_id'=>$univ_id,
						'event_type'=>'univ_event',
						'STR_TO_DATE(event_date_time, "%d %M %Y")>='=>date("Y-m-d"));
		$this->db->join('event_register','event_register.register_event_id=events.event_id');
		$this->db->where($condition);
		$this->db->limit(1);
		$res=$this->db->get();
		return $res->num_rows();
	}
	
	function upcoming_event_registerd_user_detail($univ_id)
	{
		$this->db->select("*");
		$this->db->from('events');
		$condition=array('event_univ_id'=>$univ_id,
						'event_type'=>'univ_event',
						'STR_TO_DATE(event_date_time, "%d %M %Y")>='=>date("Y-m-d"));
		$this->db->join('event_register','event_register.register_event_id=events.event_id');
		$this->db->where($condition);
		$this->db->limit(7);
		$res=$this->db->get();
		if($res->num_rows()>0)
		return $res->result_array();
		else
		return 0;
	}
	
	function fetch_recent_five_question($univ_id)
	{
		$this->db->select("*");
		$this->db->from('questions');
		$condition=array('q_univ_id'=>$univ_id,
						'q_category'=>'univ');
		$this->db->join('users','questions.q_askedby=users.id');
		$this->db->join('user_profiles','user_profiles.user_id=users.id');
		$this->db->where($condition);
		$this->db->order_by("q_asked_time", "desc");
		$this->db->limit(5);
		$res=$this->db->get();
		if($res->num_rows()>0)
		return $res->result_array();
		else
		return 0;
	}
	
	function recent_followers_of_univ($univ_id)
	{
		$this->db->select("*");
		$this->db->from('follow_univ');
		$condition=array('follow_to_univ_id'=>$univ_id);
		$this->db->join('users','follow_univ.followed_by=users.id');
		$this->db->join('user_profiles','user_profiles.user_id=users.id');
		$this->db->where($condition);
		$this->db->order_by("ontime", "desc");
		$this->db->limit(5);
		$res=$this->db->get();
		if($res->num_rows()>0)
		return $res->result_array();
		else
		return 0;
	}
}

/* End of file users.php */
/* Location: ./application/models/auth/users.php */