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
class Autosuggest_model extends CI_Model
{
	function __construct()
	{
		parent::__construct();
	}
	
	 function get_univ_detail($hint)
	 {
		$this->db->select('*');
		$this->db->from('university');
		$this->db->like('univ_name',$hint); 
		$query = $this->db->get();
		if($query->num_rows()>0)
		return $query->result();
		else
		return 0;
	 }
	 
	 function get_country_detail($hint,$univ_id)
	 {
		$this->db->select('*');
		$this->db->from('country');
		$query=$this->db->get();
		return $query->result_array();
	 }

		
		
}

/* End of file users.php */
/* Location: ./application/models/auth/users.php */