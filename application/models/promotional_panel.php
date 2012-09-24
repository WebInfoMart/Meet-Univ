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
			$this->db->select('id');
			$this->db->from('users');
			$this->db->join('verified_lead_data','users.email=verified_lead_data.v_email','left');
			$where=array();
			$where['users.level'] =  '1';
			$this->db->where($where);
			$query = $this->db->get();
			$no_of_student = $query->num_rows();
			return $no_of_student;
		}
		
		function count_total_student_in_sms_email_send($type)
		{
			if($type=='sms')
			{
			$where=' v_phone!="" && v_phone!="NULL" && v_phone!="0"';
			}
			if($type=='email')
			{
			$where=' v_email!="" && v_email!="NULL" && v_email!="0"';
		    }
			$res=$this->db->query("select * from verified_lead_data vl where ".$where);
			return $res->num_rows();
			
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
		 
	    // $c_where=" and if(ld.v_country <>'0',if(ld.v_country <> '',if(ld.v_country IS NOT NULL,ld.v_country,up.country_id),up.country_id),up.country_id)='".$country."'";
	    // }
		//$sql="SELECT * from lead_data ld LEFT JOIN user_profiles up on ld.user_id=up.user_id LEFT JOIN users u on up.user_id=u.id ".$c_where;
		// $sql="SELECT * from users u  JOIN user_profiles up on u.id=up.user_id LEFT JOIN verified_lead_data ld  on u.email=ld.v_email ".$c_where;
		// $res=$this->db->query($sql);
	    // return $res->num_rows();
		
		if($country!='0' && $country!='') {
		$this->db->select('v_id');
		$this->db->from('verified_lead_data');
		if($country!='0')
		$this->db->where('v_country',$country);
		$query=$this->db->get();
		return $query->num_rows();
		}
		else {
		$this->db->select('id');
			$this->db->from('users');
			$this->db->join('verified_lead_data','users.email=verified_lead_data.v_email','left');
			$where=array();
			$where['users.level'] =  '1';
			$this->db->where($where);
			$query = $this->db->get();
			$no_of_student = $query->num_rows();
			return $no_of_student;
			}
		
		}
		
		function total_student_in_city($city)
		{
		if($city!='0')
		{
		$this->db->select('v_id');
		$this->db->from('verified_lead_data');
		$this->db->where('v_city',$city);
		$query=$this->db->get();
		return $query->num_rows();
		}
		return 0;
		}
		function total_student_in_ug($country_id,$educ_level)
		{
			// $c_where=" and if(ld.home_country_id <>'0',if(ld.home_country_id <> '',if(ld.home_country_id IS NOT NULL,ld.home_country_id,up.country_id),up.country_id),up.country_id) = '".$country_id."'";
			
	        //$educ_lvl_where="AND IF( ld.current_educ_level =  '0', up.curr_educ_level, ld.current_educ_level )='".$educ_level."'";
			// $educ_lvl_where="and if(ld.current_educ_level <> '0',if(ld.current_educ_level <> '',if(ld.current_educ_level IS NOT NULL,ld.current_educ_level,up.curr_educ_level),up.curr_educ_level),up.curr_educ_level)='".$educ_level."'";
			
			// $sql="SELECT * 
			// FROM user_profiles up, lead_data AS ld, users u
			// WHERE up.user_id = u.id
			// AND u.email = ld.email".
			// $c_where." ".$educ_lvl_where;
			// $res=$this->db->query($sql);
			// return $res->num_rows(); 
			//return $sql;
			if($educ_level=='' || $educ_level=='0')
			{
			return 0;
			}
			else
			{
			$this->db->select('v_id');
			$this->db->from('verified_lead_data');
			if($country_id!='' && $country_id!='0')
			{
			$this->db->where('v_country',$country_id);
			}
			
			$this->db->where('v_current_educ_level',$educ_level);
			$query=$this->db->get();
			return $query->num_rows();
			}
	
		}
		
		function total_student_in_country_sms_email($country_id,$type)
		{
			if($type=='sms')
			{
			$where=' v_phone!="" && v_phone!="NULL" && v_phone!="0"';
		    }
			if($type=='email')
			{
			$where=' v_email!="" && v_email!="NULL" && v_email!="0"';
			}
			if($country_id!=0)
			{
			$where.=' && v_country ='.$country_id;
			}
			//echo 'select * from verified_lead_data where'.$where;
			$res=$this->db->query('select * from verified_lead_data where'.$where);
			return $res->num_rows();
		}
		
		function count_total_student_in_educ_sms_email_send($country_id,$educ_level,$type)
		{
			$where=' 1';
			if($country_id!='0'){
			$where.=' && v_country='.$country_id;
			}
			if($educ_level!=''){
			$where.=' && v_current_educ_level IN('.$educ_level.')';
			}
			
			if($type=='sms')
			{
			$where.=' && v_phone!="" && v_phone!="NULL" && v_phone!="0"';
		    }
			if($type=='email')
			{
			$where.=' && v_email!="" && v_email!="NULL" && v_email!="0"';
		    }
			$res=$this->db->query('select * from verified_lead_data where'.$where);
			return $res->num_rows();
		}
		
		function total_student_in_sms_email_educ_change($country,$city,$educ_lvl,$type)
		{
			$where=' 1';
			if($country!='0')
			{
			$where.=' && v_country='.$country;
			}
			if($city!='0')
			{
			$where.=' && v_city='.$city;
			}
			if($educ_lvl!='')
			{
			$where.=' && v_current_educ_level IN ('.$educ_lvl.')';
			}
		    if($type=='sms')
			{
			$where.=' && v_phone!="" && v_phone!="NULL" && v_phone!="0"';
		    }
			if($type=='email')
			{
			$where.=' && v_email!="" && v_email!="NULL" && v_email!="0"';
		    }
			$res=$this->db->query('select * from verified_lead_data where'.$where);
			return $res->num_rows();
		}
		function total_student_in_city_ug($country_id,$city_id,$educ_level)
		{
		    $this->db->select('v_id');
			$this->db->from('verified_lead_data');
			$where=array();
			if($country_id!='0')
			{
			 $where['v_country']=$country_id;
			}
			if($city_id!='0')
			{
			$where['v_city']=$city_id;
			}
			if($educ_level!='0')
			{
			$where['v_current_educ_level']=$educ_level;
			}
			$this->db->where($where);
			$query=$this->db->get();
			return $query->num_rows();
		
		}
		function fetch_all_cities()
		{
		 $this->db->select('*');
		 $this->db->from('city');
		 $query = $this->db->get();
		 return $query->result_array();
		}
		
		function fetch_cities_having_country($cid)
		{
		 $this->db->select('*');
		 $this->db->from('city');
		 if($cid!='0')
		 $this->db->where('country_id',$cid);
		 $query = $this->db->get();
		 $res= $query->result_array();
		 $city_list='<option value="0">select city</option>';
		 foreach($res as $res1) { 
		 $city_list.='<option value="'.$res1['city_id'].'">'.$res1['cityname'].'</option>';
		 } 
		 echo $city_list;	
		}
		
		function find_all_area_of_intrests()
		{
		 $this->db->select('*');
		 $this->db->from('program_parent');
		 $query = $this->db->get();
		 return $query->result_array();
		}
		
		function total_student_in_city_sms_email($city,$type)
		{
			if($city!='0'){
			$where=' v_city='.$city;
			if($type=='sms')
			{
			$where.=' && v_phone!="" && v_phone!="NULL" && v_phone!="0"';
		    }
			if($type=='email')
			{
			$where.=' && v_email!="" && v_email!="NULL" && v_email!="0"';
		    }
			$res=$this->db->query('select * from verified_lead_data where'.$where);
			return $res->num_rows();
			}
			else
			{
			return 0;
			}
		}
}

