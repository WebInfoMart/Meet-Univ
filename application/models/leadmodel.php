<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Leadmodel extends CI_Model
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
	function insert_data_lead_data($condition,$insert_type)
	{
		$to_insert_id = $this->session->userdata('current_insert_lead_id');
		if($insert_type == '0')
		{
			if($to_insert_id!='' || $to_insert_id!=0)
			{
			$condition_id = trim($to_insert_id);
			$this->db->where('id',$condition_id);
			$this->db->update('lead_data',$condition);
			if($this->db->affected_rows() > 0)
			{
				return 1;
			}
			else {
			return 0;
			}
			}
			else {
			$this->db->insert('lead_data',$condition);
			if($this->db->affected_rows() > 0)
			{
				return $this->db->insert_id();
			}
			else {
			return 0;
			}
			}
		}
		else if($insert_type == '1')
		{
		$to_insert_id = $this->session->userdata('current_insert_lead_id');
			if($to_insert_id!='' || $to_insert_id!=0)
			{
			$condition_id = trim($to_insert_id);
			$this->db->where('id',$condition_id);
			$this->db->update('lead_data',$condition);
			if($this->db->affected_rows() > 0)
			{
				return 1;
			}
			else {
			return 0;
			}
			}
			else{
			$this->db->insert('lead_data',$condition);
			if($this->db->affected_rows() > 0)
			{
				return $this->db->insert_id();
			}
			else {
			return 0;
			}
			}
			//return $this->db->affected_rows()? 1 : 0 ;
			
		}
		else if($insert_type == '2')
		{
			$to_insert_id = $this->session->userdata('current_insert_lead_id');
			$this->db->where('id',$to_insert_id);
			$this->db->update('lead_data',$condition);
			if($this->db->affected_rows() > 0)
			{
				//$data_for_step_three = 
				$this->db->select('*');
				$this->db->from('lead_data');
				$this->db->where('id',$to_insert_id);
				$query = $this->db->get();
				return $query->row_array();
			}
			else {
			return 0;
			}
		}
	}
	
	function fetch_college_step_three($country,$area_interest,$next_educ_level)
	{
		// echo $country;
		// echo $area_interest;
		// echo $next_educ_level;
		$to_insert_id = $this->session->userdata('current_insert_lead_id');
		$cond1 = array(
		'prog_parent_id'=>$area_interest,
		'prog_educ_level'=>$next_educ_level
		);
		//print_r($cond1);
		$university_id = array();
		$this->db->select('univ_id');
		$this->db->from('univ_program');
		$this->db->where($cond1);
		$this->db->distinct();
		$query = $this->db->get();
		$res = $query->result_array();
		if(!empty($res))
		{
		foreach($query->result_array() as $univ)
		{
			$university_id[] = $univ['univ_id'];
		}
		$this->db->select('*');
		$this->db->from('university');
		$this->db->where('country_id',$country);
		$this->db->where_in('univ_id',$university_id);
		$query = $this->db->get();
		return $query->result_array();	
		}
		else{
		return 0;
		}
	}
	
	function insert_step_three($insert_val)
	{
		$cond_clause = array(
		'applied_univ_id'=>$insert_val
		);
		$to_insert_id = $this->session->userdata('current_insert_lead_id');
		$this->db->where('id',$to_insert_id);
		$this->db->update('lead_data',$cond_clause);
		if($this->db->affected_rows() > 0)
		{
			return 1;
		}
		else {
		return 0;
		}
	}
	
	function get_university_title_by_id($college_for_apply)
	{
		$this->db->select('title');
		$this->db->from('university');
		$this->db->where('univ_id',$college_for_apply);
		$query = $this->db->get();
		if($query->num_rows() > 0)
		{
			return $query->row_array();
		}
		else {
		return 0;
		}
	}
	
	function event_registration($university_id,$event_id)
	{
		$fullname = $this->input->post('event_fullname');
		$email = $this->input->post('event_email');
		$phone = $this->input->post('event_phone');
		$clause = array(
		'fullname'=>$fullname,
		'email'=>$email,
		'phone'=>$phone,
		'register_event_id'=>$event_id,
		'register_event_univ_id'=>$university_id
		);
		if($this->db->insert('event_register',$clause))
		{
			$current_insert_id = $this->db->insert_id();
			$this->db->select('*');
			$this->db->from('users');
			$this->db->where('email',$email);
			$get_result = $this->db->get();
			if($get_result->num_rows() > 0)
			{
				$msg_data = "Email Already Exists";
			}
			else
			{
				$user_insert_clause = array(
				'fullname'=>$fullname,
				'email'=>$email,
				'user_type'=> "event_user"
				);
				if($this->db->insert('users',$user_insert_clause))
				{
					$current_user_table_insert_id = $this->db->insert_id();
					$user_profile_clause = array(
					'user_id'=>$current_user_table_insert_id,
					'mob_no'=>$phone,
					'full_name'=>$fullname
					);
			
			$this->db->insert('user_profiles',$user_profile_clause);
				}
			}
		}
		if($this->db->affected_rows() > 0)
		{
		$this->db->select('*');
		$this->db->from('event_register');
		$this->db->join('events','event_register.register_event_id=events.event_id');
		$this->db->where('id',$current_insert_id);
		$query = $this->db->get();
		if($this->db->affected_rows() > 0)
		{
			return $query->row_array();
		}
		else{
			return 0;
		}
		}
		//return $this->db->affected_rows() ? 1 : 0;
	}
	
	function get_event_univ_info($condition)
	{
		$this->db->select('*');
		$this->db->from('events');
		$this->db->join('university','university.univ_id=events.event_univ_id');
		$this->db->where($condition);
		$query = $this->db->get();
		if($this->db->affected_rows() > 0)
		{
			return $query->row_array();
		}
		else {
		return 0;
		}
	}
	
	function city_name_having_event()
	{
		$this->db->select('city_id,cityname');
		$this->db->from('city');
		$this->db->join('events','events.event_city_id = city.city_id');
		$this->db->where(array('STR_TO_DATE(event_date_time, "%d %M %Y")>='=>date("Y-m-d")));
		$this->db->distinct();
		$query = $this->db->get();
		if($query->num_rows() > 0)
		{
			return $query->result_array();
		}
		else {
			return 1;
		}
	}
	
	function country_name_having_event()
	{
		$this->db->select('country_id,country_name');
		$this->db->from('country');
		$this->db->join('events','events.event_country_id = country.country_id');
		$this->db->where(array('STR_TO_DATE(event_date_time, "%d %M %Y")>='=>date("Y-m-d")));
		$this->db->distinct();
		$query = $this->db->get();
		if($query->num_rows() > 0)
		{
			return $query->result_array();
		}
		else {
			return 1;
		}
	}
	
	function events_filter_by_city($event_city,$event_month)
	{
		/* $this->db->select('*');
		$this->db->from('events');
		$this->db->join('city','city.city_id=events.event_city_id');
		$this->db->where('event_city_id',$event_city);
		$this->db->like('event_date_time',$event_month,'both');
		$query = $this->db->get(); */
		$this->db->select('*');
		$this->db->from('events');
		$this->db->join('university', 'events.event_univ_id = university.univ_id'); 
		$this->db->join('country', 'country.country_id = events.event_country_id','left'); 
		$this->db->join('state', 'state.state_id = events.event_state_id','left'); 
		$this->db->join('city', 'city.city_id = events.event_city_id','left'); 
		$this->db->where('event_city_id',$event_city);
		$this->db->like('event_date_time',$event_month,'both');
		$query = $this->db->get();
		if($query->num_rows() > 0)
		{
			return $query->result_array();
		}
		else {
			return 0;
		}
	}
	
	function event_detail_for_email($latest_registered_event_id)
	{
		$this->db->select('*');
		$this->db->from('events');
		$this->db->join('university', 'events.event_univ_id = university.univ_id'); 
		$this->db->join('country', 'country.country_id = events.event_country_id','left'); 
		$this->db->join('state', 'state.state_id = events.event_state_id','left'); 
		$this->db->join('city', 'city.city_id = events.event_city_id','left'); 
		$this->db->where('event_id',$latest_registered_event_id);
		$query = $this->db->get();
		if($query->num_rows() > 0)
		{
			return $query->result_array();
		}
		else {
			return 0;
		}
	}
	
	function insert_user_data_after_send_sms($msg_type)
	{
		if($msg_type == 'text')
		{
			$email = $this->input->post('email');
			$name = $this->input->post('fullname');
			$mobile = $this->input->post('dest');
		}
		else if($msg_type == 'voice')
		{
			$email = $this->input->post('email_voice');
			$name = $this->input->post('fullname_voice');
			$mobile = $this->input->post('mobno');
		}
		$this->db->select('id');
		$this->db->from('users');
		$this->db->where('email',$email);
		$query = $this->db->get();
		if($query->num_rows() < 1)
		{
			$this->db->insert('users',array('email'=>$email,'fullname'=>$name));
			if($this->db->affected_rows() > 0)
			{
				$current_id = $this->db->insert_id();
				$this->db->insert('user_profiles',array('user_id'=>$current_id,'full_name'=>$name,'mob_no'=>$mobile));
			}
		}
		
	}
	
	

 
 function translate_to_words($number) 
		{
			$max_size = pow(10,18);
			if (!$number) return "zero";
			if (is_int($number) && $number < abs($max_size)) 
			{
				$prefix = '';
				$suffix = '';
				switch ($number) 
				{
					// set up some rules for converting digits to words

					case $number < 0:
						$prefix = "negative";
						$suffix = $this->translate_to_words(-1*$number);
						$string = $prefix . " " . $suffix;
						break;
					case 1:
						$string = "one";
						break;
					case 2:
						$string = "two";
						break;
					case 3:
						$string = "three";
						break;
					case 4: 
						$string = "four";
						break;
					case 5:
						$string = "five";
						break;
					case 6:
						$string = "six";
						break;
					case 7:
						$string = "seven";
						break;
					case 8:
						$string = "eight";
						break;
					case 9:
						$string = "nine";
						break;                
					case 10:
						$string = "ten";
						break;            
					case 11:
						$string = "eleven";
						break;            
					case 12:
						$string = "twelve";
						break;            
					case 13:
						$string = "thirteen";
						break;            
					// fourteen handled later

					case 15:
						$string = "fifteen";
						break;            
					case $number < 20:
						$string = $this->translate_to_words($number%10);
						// eighteen only has one "t"

						if ($number == 18)
						{
						$suffix = "een";
						} else 
						{
						$suffix = "teen";
						}
						$string .= $suffix;
						break;            
					case 20:
						$string = "twenty";
						break;            
					case 30:
						$string = "thirty";
						break;            
					case 40:
						$string = "forty";
						break;            
					case 50:
						$string = "fifty";
						break;            
					case 60:
						$string = "sixty";
						break;            
					case 70:
						$string = "seventy";
						break;            
					case 80:
						$string = "eighty";
						break;            
					case 90:
						$string = "ninety";
						break;                
					case $number < 100:
						$prefix = $this->translate_to_words($number-$number%10);
						$suffix = $this->translate_to_words($number%10);
						//$string = $prefix . "-" . $suffix;

						$string = $prefix . " " . $suffix;
						break;
					// handles all number 100 to 999

					case $number < pow(10,3):                    
						// floor return a float not an integer

						$prefix = $this->translate_to_words(intval(floor($number/pow(10,2)))) . " hundred";
						if ($number%pow(10,2)) $suffix = " and " . $this->translate_to_words($number%pow(10,2));
						$string = $prefix . $suffix;
						break;
					case $number < pow(10,6):
						// floor return a float not an integer

						$prefix = $this->translate_to_words(intval(floor($number/pow(10,3)))) . " thousand";
						if ($number%pow(10,3)) $suffix = $this->translate_to_words($number%pow(10,3));
						$string = $prefix . " " . $suffix;
						break;
				}
			} else
			{
				echo "ERROR with - $number<br/> Number must be an integer between -" . number_format($max_size, 0, ".", ",") . " and " . number_format($max_size, 0, ".", ",") . " exclussive.";
			}
			return $string;    
		}

}




