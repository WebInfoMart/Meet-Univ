<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Adminmodel extends CI_Model
{
	
	function __construct()
	{
	
		parent::__construct();
		$this->load->database();
	}

	//function for acessing the user privilage data
	public function userprivlegetype()
	{
	 $query = $this->db->get('privilege_type');
	 return  $query->result_array();
	}
		
	public function insert_userprivlege_data($new_admin_id)
	{
		$privcount=count($this->input->post('privilege_type_id'));	
		$priv_type_id=$this->input->post('privilege_type_id');
		$priv_level=$this->input->post("privilege_total");
		for( $i =0; $i < $privcount ; $i++ )
		{
			$cretedby_admin=$this->tank_auth->get_admin_user_id();
						$data = array(
			   'user_id' => $new_admin_id ,
			   'privilege_level' => $priv_level[$i],
			   'privilege_type_id' => $priv_type_id[$i],
			   'permitted_by' => $cretedby_admin,
			);
			$this->db->insert('user_privilige', $data);	
			//$this->db->insert('mytable', $data);
		}
		
		//return $this->ci->session->userdata('newadmin_user_id');
		return NULL;
	}
	
	public function fetch_user_data()
	{
		$user_id	= $this->tank_auth->get_admin_user_id();
		$this->db->select('*');
		$this->db->from('users');
		$this->db->where(array('level !=' => '5','id !='=>$user_id));
		$query = $this->db->get();
		//$this->load->library('table');
		//$table= $this->table->generate($query);
		return $query->result();
	}
	public function get_user_privilege($user_id)
	{
	//$query = $this->db->get('user_privilige');
	$query = $this->db->get_where('user_privilige', array('user_id' => $user_id));
	return $query->result_array();	
	}
	
	//fetch and edit user profile and basic data
	
	public function fetch_data_edit($id)
	{
		$this->db->select('*');
		$this->db->from('users');
		//$this->db->join('user_profiles', 'users.id = user_profiles.user_id');
		$this->db->where('id', $id); 
		$query = $this->db->get();
		return $query->result();
	}
	
	public function edit_user_data()
	{
	
		if($_POST['level_user']!=1)
		{
		$this->db->delete('user_privilige', array('user_id' => $_POST['hid_user_id'])); 
		$this->adminmodel->insert_userprivlege_data($_POST['hid_user_id']);
		}
		$data = array(
               'fullname' => $_POST['fullname'],
               'email' => $_POST['email'],
               'level' =>$_POST['level_user']
            );
		$this->db->update('users', $data, array('id' => $_POST['hid_user_id']));
       
	}
	
	public function get_basic_operation_level($user_id,$priv_id)
	{
		$this->db->select('*');
		$this->db->from('user_privilige');
		$this->db->join('basic_operation', 'user_privilige.privilege_level = basic_operation.operation_level');
		$this->db->where(array('user_privilige.user_id'=>$user_id,'user_privilige.privilege_type_id'=>$priv_id)); 
		$query = $this->db->get();
		//$query = $this->db->get_where('basic_operation', array('operation_level' => $level));
		return $query->result_array();	
	}
	
	public function deleteuser($user_level,$userid)
	{
	$this->db->delete('users', array('id' => $userid));
	$this->db->delete('user_profiles', array('user_id' => $userid));
	if($user_level!=1 && $user_level!=5)
	{
	$this->db->delete('user_privilige', array('user_id' => $userid));
	}
	}
	
	
}
/* End of file users.php */
/* Location: ./application/models/auth/users.php */