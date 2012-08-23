<?php if (!defined('BASEPATH')) exit('No direct script access allowed');
class Admin_counsellor_model extends CI_Model
{
	// private $table_name			= 'users';			// user accounts
	// private $profile_table_name	= 'user_profiles';	// user profiles
	 // $gallery_path;
	 // $gallery_path_url;
	
	function __construct()
	{
		parent::__construct();
		$this->load->library('session');
		
	}
	
	
	function c_manage_verify_teleleads($start)
	{   
	    
		$config['base_url'] = site_url('admin_counsellor/counsellor');
		
		if($this->input->post('id')!='')
		{	
			$id=$this->input->post('id');			
			$query=mysql_query("select *,a.educ_level as current,b.educ_level as next from verified_lead_data as vld
left join country on vld.v_country=country.country_id
left join state on vld.v_state=state.state_id
left join city on vld.v_city=city.city_id
left join program_educ_level a on vld.v_current_educ_level=a.prog_edu_lvl_id
left join program_educ_level b on vld.v_next_educ_level=b.prog_edu_lvl_id
where vld.v_id=".$id." ");
			if(mysql_num_rows($query)>0)
			{
				return mysql_fetch_array($query);
			}
			else
			{
				return 0;
			}
		}
		else
		{
			$this->db->select('*');
			$this->db->from('verified_lead_data');
			$this->db->order_by('v_email');
			$query=$this->db->get();
			$config['total_rows'] = $query->num_rows();
			$config['per_page']   = 15;
			$limit=$config['per_page'];
			$offset=$start;
			$this->db->select('*');
			$this->db->from('verified_lead_data');			
			$this->db->order_by('v_email');
			$this->db->limit($limit,$offset);
			$query=$this->db->get();
			$this->pagination->initialize($config);
			if($query->num_rows()>0)
			return $query->result_array();
			else
			return 0;
		}	
	}
function country_model()
{
	$query=$this->db->get('country');
	return $query->result_array();
}
function state_model()
{
	$query=$this->db->get('state');
	return $query->result_array();
}
function city_model()
{
	$query=$this->db->get('city');
	return $query->result_array();
}
function program_model($id)
{
	$this->db->select('*');
	$this->db->where('prog_parent_id',$id);
	$query=$this->db->get('program');
	return $query->result_array();
}
function program_parent_model()
{	
	$query=$this->db->get('program_parent');	
	return $query->result_array();
}
function program_level()
{	
	$query=$this->db->get('program_educ_level');	
	return $query->result_array();
}
function fetch_program_model($id)
{
	$this->db->select('course_name');
	$this->db->where('prog_id',$id);
	$query=$this->db->get('program');
	return $query->result_array();
}

function verified_lead_model()
{	$id=$this->input->post('id');
	
	$notes=array(
	'v_note'=>$this->input->post('notes'),
	'lead_id'=>$this->input->post('lead_id')
	);
	$lead=array(
			'v_lead_id'=>$this->input->post('lead_id'),
			'v_fullname'=>$this->input->post('name'),
			'v_dob'=>$this->input->post('year').'-'.$this->input->post('month').'-'.$this->input->post('date'),
			'v_email'=>$this->input->post('email'),
			'v_phone'=>$this->input->post('phone'),
			'v_country'=>$this->input->post('country'),
			'v_state'=>$this->input->post('state'),	
			'v_city'=>$this->input->post('city'),
			'v_enroll_key'=>$this->input->post('enroll'),
			'v_interested_country'=>$this->input->post('auto_intrested_countries'),
			'v_program'=>$this->input->post('courses'),
			'v_enroll_date'=>$this->input->post('enroll_date'),
			'v_acedmic_exam_score_type1'=>$this->input->post('exam1'),
			'acedmic_exam_score1'=>$this->input->post('exam1_score'),
			'v_acedmic_exam_score_type2'=>$this->input->post('exam2'),
			'v_acedmic_exam_score2'=>$this->input->post('exam2_score'),
			'v_last_institute'=>$this->input->post('attended'),
			'v_other_exam'=>$this->input->post('other_exam_name'),
			'v_other_exam_score'=>$this->input->post('other_exam_score'),
			'v_status'=>$this->input->post('status'),
			'v_stage'=>$this->input->post('stage'),
			'v_priority'=>$this->input->post('priority'),
			'v_next_educ_level'=>$this->input->post('next_educ_level'),
			'v_current_educ_level'=>$this->input->post('c_educ_level'),
			'v_aggregate_percentage'=>$this->input->post('academic'),
			'v_interested_country'=>$this->input->post('interested_cont')			
		);		
	$this->db->insert('verified_notes',$notes);
	$this->db->where('v_id',$id);
	$this->db->update('verified_lead_data',$lead);				
	return 1;		
	
}
function city_list_model()
{
	$id=$this->input->post('country_id');
	$this->db->where('country_id',$id);
	$query=$this->db->get('city');
	return $query->result_array();
}
function search_lead_model()
{
	$where="1";
	
	if($this->input->post('country'))
	{
		$where=$where."&& v_country='".$this->input->post('country')."'";
	}
	if($this->input->post('city'))
	{
		$where=$where."&& v_city='".$this->input->post('city')."'";
	}
	if($this->input->post('status'))
	{
		$where=$where."&& v_status='".$this->input->post('status')."'";
	}
	if($this->input->post('action_id'))
	{
		$where=$where."&& v_next_action='".$this->input->post('action_id')."'";
	}
	if($this->input->post('src_id'))
	{
		$where=$where."&& v_user_type='".$this->input->post('src_id')."'";
	}
	if($this->input->post('phone')=='true')
	{
		$where=$where."&& v_phone!='' && v_phone!='0'";
	}
	if($this->input->post('email')=='true')
	{
		$where=$where."&& v_email!=''";
	}
	
	$query=$this->db->query("select v_id from verified_lead_data where ".$where."");
	$data=$query->result_array();	
	foreach($data as $d)
	{
		$ids[]=$d['v_id'];
	}	
	$array=implode(',',$ids);
	
	 $query2=$this->db->query("select * from verified_lead_data as vld where vld.v_id in ($array) order by vld.v_email");
	return $query2->result_array();

}

}
