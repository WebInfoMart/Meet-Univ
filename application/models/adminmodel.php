<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Adminmodel extends CI_Model
{
	
		var $gallery_path;
	function __construct()
	{
	
		parent::__construct();
		$this->gallery_path = realpath(APPPATH . '../uploads/home_gallery');
		$this->univ_gallery_path = realpath(APPPATH . '../uploads/univ_gallery');
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
	
	public function fetch_user_data($paging)
	{
		$this->load->library('pagination');
		$user_id	= $this->tank_auth->get_admin_user_id();
		$this->db->select('*');
		$this->db->from('users');
		$this->db->join('user_profiles', 'users.id = user_profiles.user_id');
		$this->db->where(array('level !=' => '5','id !='=>$user_id));
		$query = $this->db->get();
		$config['base_url']=base_url()."admin/manageusers/";
		$config['total_rows']=$query->num_rows();
		$config['per_page'] = '7'; 
		//$config['use_page_numbers'] = TRUE;
		$offset = $this->uri->segment(3); //this will work like site/folder/controller/function/query_string_for_cat/query_string_offset
        $limit = $config['per_page'];
		$this->db->select('*');
		$this->db->from('users');
		$this->db->join('user_profiles', 'users.id = user_profiles.user_id');
		$this->db->where(array('level !=' => '5','id !='=>$user_id));
		$this->db->limit($limit,$offset);
		$query = $this->db->get();
		$this->pagination->initialize($config);
		//$this->load->library('table');
		//$table= $this->table->generate($query);
		return $query->result();
	}
	public function get_user_privilege($user_id)
	{
	//$query = $this->db->get('user_privilige');
	$this->load->library('pagination');
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
			  /* 'banned'=>$_POST['switch_user_status']*/
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
	
	public function deleteuser()
	{
		$usercount=count($this->input->post('users_id'));	
		$user_id=$this->input->post('users_id');
		$users_level=$this->input->post("users_level");
		for( $i =0; $i < $usercount ; $i++ )
		{
			if($this->input->post("check_users_".$user_id[$i])=='checked')
			{
			$this->db->delete('users', array('id' => $user_id[$i]));
			$this->db->delete('user_profiles', array('user_id' => $user_id[$i]));
			if($users_level[$i]!=1 && $users_level[$i]!=5)
			{
			$this->db->delete('user_privilige', array('user_id' => $user_id[$i]));
			}
			}
		}
		
	}
	public function delete_single_user($userid,$user_level)
	{
	$this->db->delete('users', array('id' => $userid));
	$this->db->delete('user_profiles', array('user_id' => $userid));
	if($user_level!=1 && $user_level!=5)
	{
	$this->db->delete('user_privilige', array('user_id' => $userid));
	}
	}
	//upload home gallery
	//upload home gallery
	function do_upload() {
		 //$this->ci->load->config('tank_auth', TRUE);
		
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
			$num_files = count($_FILES[$field]['name'])-1;
			$f=0;
			for($a=0;$a<$num_files;$a++)
			{
						$data = array(
			   'image_path' => $data1['upload_data'][$a]['name'],
			   'postedby' => $user_id,
			   
			);
			$this->db->insert('home_slider', $data);	
				$f=1;
			}
			return $files;
		}
		
}
		
		function get_gallery_info()
		{
			$this->db->select('*');
			$this->db->from('home_slider');
			$query = $this->db->get();
			return $query->result_array();
		}
		
		function delete_gallery_pic($gid)
		{
			$this->db->delete('home_slider', array('id' => $gid));
		}
		
		
		
		function update_gallery()
		{
		$g_id=$this->input->post('g_id');
		$imgcount=count($this->input->post('g_id'));	
		$image_caption=$this->input->post('image_caption');
		$title=$this->input->post('title');
		$link_to=$this->input->post("link_to");
		for( $i =0; $i < $imgcount ; $i++ )
		{
			$cretedby_admin=$this->tank_auth->get_admin_user_id();
						$data = array(
			   'image_caption' => $image_caption[$i],
			   'title' => $title[$i],
			   'event_link_path' => $link_to[$i],
			   'postedby' => $cretedby_admin,
			);
			$this->db->where('id', $g_id[$i]);
			$this->db->update('home_slider', $data); 
			//$this->db->insert('mytable', $data);
		}
		}
		
		
		function get_univ_admin()
		{
			$this->db->select('user_id');
			$this->db->from('university');
			$user= $this->db->get();
			$users=$user->result_array();
			$userid=array('0');
			foreach($users as $user_id)
			{
			$userid[]=$user_id['user_id'];
			}
			$level=array('1','2','4','5');
			//$query = $this->db->get_where('basic_operation', array('operation_level' => $level));	
			$this->db->select('id,fullname');
			$this->db->from('users');
			//$this->db->join('university', 'users.id != university.user_id','right');
			$this->db->where_not_in('id',$userid); 
			$this->db->where('level','3');
			$query = $this->db->get();
			//$query = $this->db->get_where('basic_operation', array('operation_level' => $level));
			return $query->result_array();	
		}
		
	 function fetch_states($cid)
	 {
		$this->db->select('*');
		$this->db->from('state');
		$this->db->where('country_id',$cid);
		$query=$this->db->get();
		return $query->result_array();
	 }
	 function fetch_city($sid)
	 {
		$this->db->select('*');
		$this->db->from('city');
		$this->db->where('state_id',$sid);
		$query=$this->db->get();
		return $query->result_array();
	 }
		
	function create_univ()
	{
	
		$config = array(
			'allowed_types' => 'jpg|jpeg|gif|png',
			'upload_path' => $this->gallery_path,
			'max_size' => 2000
		);
		
		$this->load->library('upload', $config);
		$this->upload->do_upload();
		$image_data = $this->upload->data();
		
		$config = array(
			'source_image' => $image_data['full_path'],
			'new_image' => $this->gallery_path . '/thumbs',
			'maintain_ration' => true,
			'width' => 150,
			'height' => 100
		);
		
		$this->load->library('image_lib', $config);
		$this->image_lib->resize();
	
		$cretedby_admin=$this->tank_auth->get_admin_user_id();
						$data = array(
			   'univ_name' => $this->input->post('univ_name'),
			   'title' => $this->input->post('title'),
			   'keyword' => $this->input->post('keyword'),
			   'description' => $this->input->post('description'),
			   'latitude' => $this->input->post('latitude'),
			   'longitude' => $this->input->post('longitude'),
			   'univ_logo_path' =>$image_data['file_name'],
			   'address_line1' => $this->input->post('address1'),
			   'address_line2' => $this->input->post('address2'),
			   'user_id' => $this->input->post('univ_owner'),
			   'city_id' =>$this->input->post('city'),
			   'state_id' => $this->input->post('state'),
			   'country_id'=>$this->input->post('country'),
			   'phone_no' => $this->input->post('phone_no'),
			  /* 'switch_off_univ'=>$this->input->post('switch_univ_status'),*/
			   'univ_is_client' =>$this->input->post('univ_is_client'),
			   'subdomain_name' =>$this->input->post('sub_domain'),
			   'about_us' => $this->input->post('about_us'),
			   'contact_us' => $this->input->post('contact_us'),
			   'createdby' =>$cretedby_admin
			);
			$this->db->insert('university', $data);		
			redirect('admin/manage_university');
	}
		
	function enterplacelevel1()
	{
		$cretedby_admin=$this->tank_auth->get_admin_user_id();
		$data1=array(
		'country_name'=>$this->input->post('country_model'),
		'createdby' =>$cretedby_admin
		);
		$this->db->insert('country', $data1);
		$country_id=$this->db->insert_id();
		$data2=array(
		'statename'=>$this->input->post('state_model'),
		'country_id' =>$country_id,
		'createdby' =>$cretedby_admin
		);
		$this->db->insert('state', $data2);
		$state_id=$this->db->insert_id();
		$data3=array(
		'cityname'=>$this->input->post('city_model'),
		'state_id' =>$state_id,
		'country_id' =>$country_id, 
		'createdby' =>$cretedby_admin
		);
		$this->db->insert('city', $data3);
		$city_id=$this->db->insert_id();
		$select_place=array($country_id,$state_id,$city_id);
		return $select_place;
		
	}
	
	function enterplacelevel2()
	{
		$cretedby_admin=$this->tank_auth->get_admin_user_id();
		$country_id=$this->input->post('country_model1');
		$data2=array(
		'statename'=>$this->input->post('state_model1'),
		'country_id' =>$country_id,
		'createdby' =>$cretedby_admin
		);
		$this->db->insert('state', $data2);
		$state_id=$this->db->insert_id();
		$data3=array(
		'cityname'=>$this->input->post('city_model1'),
		'state_id' =>$state_id,
		'country_id' =>$country_id, 
		'createdby' =>$cretedby_admin
		);
		$this->db->insert('city', $data3);
		$city_id=$this->db->insert_id();
		$select_place=array($country_id,$state_id,$city_id);
		return $select_place;
	}
	function enterplacelevel3()
	{
		$cretedby_admin=$this->tank_auth->get_admin_user_id();
		$country_id=$this->input->post('country_model2');
		$state_id=$this->input->post('state_model2');
		$data3=array(
		'cityname'=>$this->input->post('city_model2'),
		'state_id' =>$state_id,
		'country_id' =>$country_id, 
		'createdby' =>$cretedby_admin
		);
		$this->db->insert('city', $data3);
		$city_id=$this->db->insert_id();
		$select_place=array($country_id,$state_id,$city_id);
		return $select_place; 
	}	
		
	function state_chk_in_country($country,$state)
	{
		$this->db->select('*');
		$this->db->from('state');
		$this->db->where(array('statename'=>$state,'country_id'=>$country));
		$query=$this->db->get();
		return $query->num_rows();
	}
	
    function city_chk_in_state($state,$city)
	{
		$this->db->select('*');
		$this->db->from('city');
		$this->db->where(array('cityname'=>$city,'state_id'=>$state));
		$query=$this->db->get();
		return $query->num_rows();
	}
    function ban_unban_users($ban_status,$ban_user_id,$userlevel)
	{
		$ban_unban=!$ban_status;
		$data = array(
               'banned' => $ban_unban,
			  /* 'banned'=>$_POST['switch_user_status']*/
            );
		if($userlevel!='5')
		{
		$this->db->update('users', $data, array('id' => $ban_user_id,'level'=>$userlevel));
		}
	}
	function get_user_info()
	{
		$this->db->select('*');
		$this->db->from('users');
		$query=$this->db->get();
		return $query->result_array();
	}
		
}
/* End of file users.php */
/* Location: ./application/models/auth/users.php */