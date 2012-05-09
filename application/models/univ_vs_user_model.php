<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Univ_vs_user_model extends CI_Model
{
	private $table_name			= 'users';			// user accounts
	private $profile_table_name	= 'user_profiles';	// user profiles
	var $gallery_path;
	//var $gallery_path_url;
	
	function __construct()
	{
		parent::__construct();
		$this->gallery_path = realpath(APPPATH . '../uploads');
		$ci =& get_instance();
		$this->table_name			= $ci->config->item('db_table_prefix', 'tank_auth').$this->table_name;
		$this->profile_table_name	= $ci->config->item('db_table_prefix', 'tank_auth').$this->profile_table_name;
		
	}
	
	function get_univ_user_info()
	{
		$users_lists=array('0');
		$this->db->select('univ_user_id');
		$this->db->from('university_vs_users');
		$query=$this->db->get();
		$user_list=$query->result_array();
		foreach($user_list as $users)
		{
		$users_lists[]=$users['univ_user_id'];
		}
		$this->db->select('*');
		$this->db->from('users');
		$this->db->where_not_in('id',$users_lists); 
		$this->db->where('level','4');
		$query=$this->db->get();
		$user_list1=$query->result_array();
		return $user_list1;
	}
	function get_univ_user_info_already_maped()
	{
		$users_lists=array('0');
		$this->db->select('univ_user_id');
		$this->db->from('university_vs_users');
		$query=$this->db->get();
		$user_list=$query->result_array();
		foreach($user_list as $users)
		{
		$users_lists[]=$users['univ_user_id'];
		}
		$this->db->select('*');
		$this->db->from('users');
		$this->db->where_in('id',$users_lists); 
		$this->db->where('level','4');
		$query=$this->db->get();
		$user_list1=$query->result_array();
		return $user_list1;
	}
	function fetch_univ_user_universities()
	{
		$univs_lists=array('0');
		$this->db->select('university_id');
		$this->db->from('university_vs_users');
		$query=$this->db->get();
		$univ_list=$query->result_array();
		foreach($univ_list as $univs)
		{
		$univs_lists[]=$univs['university_id'];
		}
		$this->db->select('*');
		$this->db->from('university');
		$this->db->where_not_in('univ_id',$univs_lists); 
		$query=$this->db->get();
		$univ_list1=$query->result_array();
		return $univ_list1;
	}
	function manage_fetch_univ_user_universities($user_id)
	{
		
		$query=$this->db->query("SELECT * from (SELECT * FROM (`university`) LEFT JOIN `university_vs_users` ON `university`.`univ_id`=`university_vs_users`.`university_id`  ) t where t.univ_user_id is null or t.univ_user_id='".$user_id."'");
		$univ_list1=$query->result_array();
		return $univ_list1;
	}
	function insert_univ_user_data()
	{
		$user_id=$this->input->post('users');
		$univs_ids=$this->input->post('university');
		$login_user_id	= $this->tank_auth->get_admin_user_id();
		foreach($univs_ids as $univ_id)
		{
			$data=array('university_id'=>$univ_id,
						'univ_user_id'=>$user_id,
						'assigned_by'=>$login_user_id
			);
			$this->db->insert('university_vs_users',$data);		
		}
	}	
	
	function get_mapped_univ_info($user_id)
	{
		$this->db->select('university_id');
		$this->db->from('university_vs_users');
		$this->db->where('univ_user_id',$user_id); 
		$query=$this->db->get();
		$univs= $query->result_array();
		$c=count($univs);
		$f=0;
		$univ_ids='';
		foreach($univs as $univs_id)
		{
			$f=$f+1;
			$univ_ids.=$univs_id['university_id'];
			if($f!=$c)
			$univ_ids.='##';	
		}
		return $univ_ids;
	}
	
	function update_univ_user_map_data()
	{
	
		$login_user_id	= $this->tank_auth->get_admin_user_id();
		$user_id=$this->input->post('users');
		$univ_ids=$this->input->post('university');
		$this->db->delete('university_vs_users', array('univ_user_id' => $user_id));
		foreach($univ_ids as $univ_id)
		{
		$data=array('university_id'=>$univ_id,
					'univ_user_id'=>$user_id,
					'assigned_by'=>$login_user_id
		);
		$this->db->insert('university_vs_users',$data);
		}
	}
	
	function get_assigned_univ_info($user_id)
	{
	  $univ=array();	
	  $this->db->select('university_id');
	  $this->db->from(' university_vs_users');
	  $this->db->where('univ_user_id',$user_id);
	  $query= $this->db->get();
	  $univ_ids=$query->result_array();
	  foreach($univ_ids as $univ_id)
	  {
	   $univ[]=$univ_id['university_id'];
	  }
	  if(count($univ)>0)
	  {
	   return $univ;
	  }
	  else
	  {
	  return 0;
	  }
	}
	
}