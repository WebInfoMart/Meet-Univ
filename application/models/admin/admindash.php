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
class Admindash extends CI_Model
{
	function __construct()
	{
		parent::__construct();
		
	}
	
	function fetch_recent_five_question()
	{
		$this->db->select("*");
		$this->db->from('questions');
		$condition=array('q_category'=>'univ');
		$this->db->join('users','questions.q_askedby=users.id','left');
		$this->db->join('user_profiles','user_profiles.user_id=users.id','left');
		$this->db->join('university','questions.q_univ_id=university.univ_id','left');					//Edited by satbir on 11/19/2012
		$this->db->where($condition);
		$this->db->order_by("q_asked_time", "desc");
		$this->db->limit(5);
		$res=$this->db->get();
		if($res->num_rows()>0)
		return $res->result_array();
		else
		return 0;
	}
	
	function recent_articles($univ_id)
	{
		$this->db->select("*");
		$this->db->from('article');		
		$this->db->join('users','article.postedby=users.id','left');
		$this->db->join('user_profiles','user_profiles.user_id=users.id','left');
		$this->db->where('article_univ_id',$univ_id);
		$this->db->where('article_approve_status','1');
		$this->db->order_by("publish_time", "desc");
		$this->db->limit(7);
		$res=$this->db->get();
		if($res->num_rows()>0)
		return $res->result_array();
		else
		return 0;
	}
	function unasnwered()
	{
		$this->db->select("*");
		$this->db->from('questions');
		$condition=array('q_category'=>'univ',
						'q_answered'=>'0');
		$this->db->join('users','questions.q_askedby=users.id','left');
		$this->db->join('user_profiles','user_profiles.user_id=users.id','left');
		$this->db->join('university','questions.q_univ_id=university.univ_id','left');					//Edited by satbir on 11/19/2012
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
		$this->db->select('*');
		$this->db->from('follow_univ');
		$condition=array('follow_to_univ_id'=>$univ_id);
		$this->db->join('users','follow_univ.followed_by=users.id','left');
		$this->db->join('user_profiles','user_profiles.user_id=users.id','left');
		$this->db->where($condition);
		$this->db->order_by("ontime", "desc");
		$this->db->limit(5);
		$res=$this->db->get();
		if($res->num_rows()>0)
		return $res->result_array();
		else
		return 0;
	}
	function recent_leads($u_id)
	{
	
	$query=$this->db->query("SELECT `email`,`fullname`,`lead_created_time` from lead_data where FIND_IN_SET('".$u_id."',lead_data.applied_univ_id)  order by `lead_created_time` desc limit 0,10");	
	return $query->result_array();
	 
	}
}
