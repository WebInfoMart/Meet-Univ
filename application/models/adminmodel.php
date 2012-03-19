<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Adminmodel extends CI_Model
{
	
		var $gallery_path;
	function __construct()
	{
	
		parent::__construct();
		$this->gallery_path = realpath(APPPATH . '../uploads');
		$this->gallery_path_url = 'http://127.0.0.1/Meet-Univ/uploads/';
	
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
		$this->db->join('user_profiles', 'users.id = user_profiles.user_id');
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
	
	//upload home gallery
	function do_upload() {
		 //$this->ci->load->config('tank_auth', TRUE);
		   $this->load->library('upload');

            foreach ($_FILES as $key => $value)
            {


                if (!empty($key['name']))
                {


                    $this->upload->initialize($config);
                    if (!$this->upload->do_upload())
                    {

                        $errors = $this->upload->display_errors();
						

                        //flashMsg($errors);

                    }
                    else
                    {
                         // Code After Files Upload Success GOES HERE
                    }
					
                }
            }
			return $key['name'];
		$config['upload_path'] = $this->gallery_path; // server directory
        $config['allowed_types'] = 'gif|jpg|png'; // by extension, will check for whether it is an image
        $config['max_size']    = '1000'; // in kb
        $config['max_width']  = '1024';
        $config['max_height']  = '768';
        
        $this->load->library('upload', $config);
        $this->load->library('Multi_upload');
    
        $files = $this->multi_upload->go_upload();
        
        if ( ! $files )        
        {
            $error = array('error' => $this->upload->display_errors());
            return $error;
        }    
        else
        {
				$field = 'userfile';
				$user_id=$this->tank_auth->get_admin_user_id();
            $data1 = array('upload_data' => $files);
			$num_files = count($_FILES[$field]['name']);
			$f=0;
			for($a=0;$a<$num_files;$a++)
			{
						$data = array(
			   'image_path' => $data1['upload_data'][$a]['name'],
			   'postedby' => $user_id
			   
			);
			$this->db->insert('home_slider', $data);	
				$f=1;
			}
			return $f;
		}

}
}
/* End of file users.php */
/* Location: ./application/models/auth/users.php */