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
}

