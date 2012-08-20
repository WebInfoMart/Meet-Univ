<?php if (!defined('BASEPATH')) exit('No direct script access allowed');


class Promotional_panel extends CI_Model
{
		function __construct()
		{
		
			parent::__construct();
			$this->load->database();
		}

		function count_total_student_in_portal()
		{
			$this->db->from('users');
			$this->db->where('level','1');
			$query = $this->db->get();
			$no_of_student = $query->num_rows();
			return $no_of_student;
		}
		
		function show_country_list()
		{
		 $this->db->select('*');
		 $this->db->from('country');
		 $query = $this->db->get();
		 return $query->result_array();
		} 
		
		function get_country_id_by_name($country_name)
		{
		 $this->db->select('country_id');
		 $this->db->from('country');
		 $this->db->where('country_name',$country_name);
		 $query = $this->db->get();
		 return $query->row_array();
		}
		
		function total_student_in_country($country)
		{
		if($country!='0')
	    {
	    $c_where=" and if(ld.current_educ_level='',up.curr_educ_level,ld.home_country_id)='".$country."'";
	    }
		$sql="SELECT *,if(ld.home_country_id='',up.country_id,ld.home_country_id) as country from user_profiles up,lead_data as ld,users u where up.user_id=u.id and u.email=ld.email".$c_where;
		$res=$this->db->query($sql);
	    return $res->num_rows();
		}
		
		function total_student_in_ug($country_id,$educ_level)
		{
			$c_where=" AND IF( ld.home_country_id =  '0', up.country_id, ld.home_country_id ) = '".$country_id."'";
	        $educ_lvl_where="AND IF( ld.current_educ_level =  '0', up.curr_educ_level, ld.current_educ_level )='".$educ_level."'";
			$sql="SELECT * , IF( ld.current_educ_level =  '0', up.curr_educ_level, ld.current_educ_level ) AS el, IF( ld.home_country_id =  '0', up.country_id, ld.home_country_id ) AS hc
			FROM user_profiles up, lead_data AS ld, users u
			WHERE up.user_id = u.id
			AND u.email = ld.email".
			$c_where." ".$educ_lvl_where;
			$res=$this->db->query($sql);
			return $res->num_rows(); 
			//return $sql;
	
		}
		function fetch_all_cities()
		{
		 $this->db->select('*');
		 $this->db->from('city');
		 $query = $this->db->get();
		 return $query->result_array();
		}
}

