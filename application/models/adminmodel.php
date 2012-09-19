<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Adminmodel extends CI_Model
{
	
		var $gallery_path;
		var $univ_gallery_path;
	function __construct()
	{
	
		parent::__construct();
		$this->gallery_path = realpath(APPPATH . '../uploads/home_gallery');
		$this->univ_gallery_path = realpath(APPPATH . '../uploads/univ_gallery');
		//$this->gallery_path_url = 'http://127.0.0.1/Meet-Univ/uploads/';
		$this->load->library('pagination');
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
	public function insert_userprivlege_data_ajax($new_admin_id)
	{
		
		
		$privilege=$this->input->post('privilege');
		$privileges=explode('$$',$privilege);
		$cretedby_admin=$this->tank_auth->get_admin_user_id();
		for($i=0;$i<5;$i++)
		{
		$priv=explode('##',$privileges[$i]);
						$data = array(
			   'user_id' => $new_admin_id ,
			   'privilege_level' => $priv[1],
			   'privilege_type_id' => $priv[0],
			   'permitted_by' => $cretedby_admin,
			);
			$this->db->insert('user_privilige', $data);
		}
		//return $this->ci->session->userdata('newadmin_user_id');
		return $privileges;
	}
	public function fetch_user_data($paging)
	{ 	
		$user_id= $this->tank_auth->get_admin_user_id();
		if($this->input->post('toSearch')=='' && $this->input->post('banned')=='')
		{
			$this->db->select('*');
			$this->db->from('users');
			$this->db->join('user_profiles', 'users.id = user_profiles.user_id'); 
			if($this->input->post('level') && $this->input->post('level')!=0)
			{
				$level=$this->input->post('level');
				$this->db->where(array('level =' => $level));
			}
			else
			{
			 $this->db->where(array('level !=' => '5','id !='=>$user_id));
			}
			$this->db->order_by('users.createdon','desc');
			$query = $this->db->get();
		}
		else
		{ $arr=array('0');							
			if($this->input->post('toSearch'))
			{ 
				$mystring = trim($this->input->post('toSearch'));
				$findme   = '@';
				$pos = strpos($mystring, $findme);
				if ($pos === false)
				{//echo "select id from users where fullname like '%$mystring%' ";exit;
					$query=$this->db->query("select id from users where fullname like '%$mystring%' ");					
					$result=$query->result_array();
					foreach($result as $res)				
					{
					 array_push($arr,$res['id']);
					}
					//$arrr=implode("','",$arr);
					//print_r($arrr);exit;
					
				}
				else
				{
					$query=$this->db->query("select id from users where email like '%$mystring%'");
					$result=$query->result_array();
					foreach($result as $res)				
					{
					 array_push($arr,$res['id']);
					}
					//$arrr=implode(',',$arr);
				}
			
			}
			else
			{
				$mystring = trim($this->input->post('banned'));
				$query=$this->db->query("select id from users where banned='$mystring'");
				$result=$query->result_array();
					foreach($result as $res)				
					{
					 array_push($arr,$res['id']);
					}
					//$arrr=implode(',',$arr);
			}
			
		}
		
		
		$config['base_url']=base_url()."admin/manageusers/";
		$config['total_rows']=$query->num_rows();
		$config['per_page'] = '7'; 
		//$config['use_page_numbers'] = TRUE;
		$offset = $this->uri->segment(3); //this will work like site/folder/controller/function/query_string_for_cat/query_string_offset
        $limit = $config['per_page'];
		if($this->input->post('toSearch')=='' && $this->input->post('banned')=='')
		{
			$this->db->select('*');
			$this->db->from('users');
			$this->db->join('user_profiles', 'users.id = user_profiles.user_id');
			$this->db->join('university', 'university.user_id = users.id','left');
			if($this->input->post('level') && $this->input->post('level')!=0)
			{  
				$level=$this->input->post('level');
				$this->db->where(array('level =' => $level));
			}
			else
			{
			 $this->db->where(array('level !=' => '5','id !='=>$user_id));
			}
			$this->db->order_by('users.createdon','desc');
			$this->db->limit($limit,$offset);
			$query = $this->db->get();
		}
		else
		{
			$this->db->select('*');
			$this->db->from('users');
			$this->db->join('user_profiles', 'users.id = user_profiles.user_id');
			$this->db->join('university', 'university.user_id = users.id','left');
			$this->db->where_in('id',$arr);
			if($this->input->post('level') && $this->input->post('level')!=0)
			{  
				$level=$this->input->post('level');
				$this->db->where(array('level =' => $level));
			}
			else
			{
			 $this->db->where(array('level !=' => '5','id !='=>$user_id));
			}
			$this->db->order_by('users.createdon','desc');
			$this->db->limit($limit,$offset);
			$query = $this->db->get();
		}
		$this->pagination->initialize($config);
		//$this->load->library('table');
		//$table= $this->table->generate($query);
		if($query->num_rows()>0)
		{
			return $query->result();
		}
		else
		{
			return 0;
		}
	}
	public function get_user_privilege($user_id)
	{
	//$query = $this->db->get('user_privilige');
	$this->load->library('pagination');
	$query = $this->db->get_where('user_privilige', array('user_id' => $user_id));
	if($query->num_rows>0)
	return $query->result_array();
    else
    return 0;	
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
	
		if($_POST['level_user']!=1 && $_POST['level_user']!=6 && $_POST['level_user']!=2 && $_POST['level_user']!=5)
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
        $config['max_size']    = '100'; // in kb
        $config['max_width']  = '1024';
        $config['max_height']  = '768';
        
        $this->load->library('upload', $config);
        $this->load->library('Multi_upload');
    
        $files = $this->multi_upload->go_upload();
        
        if ( ! $files )        
        {
            $data['err_msg'] ='Error!  Please Check Your file size and type';
            $this->load->view('admin/show_rror', $data);
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
			//return $files;
			redirect('admin/manage_home_gallery');
		
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
			$this->db->select('*');
			$this->db->from('home_slider');
			$this->db->where('id',$gid);
			$query = $this->db->get();
			if($query->num_rows())
			{
			$res=$query->row_array();
			$delpath=$this->gallery_path;
			$del_path=$delpath.'/'.$res['image_path'];
			unlink($del_path);
			$this->db->delete('home_slider', array('id' => $gid));
			return $del_path;
			}
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
			$this->db->select('id,fullname,email');
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
		$this->db->select_max('univ_id');
		$this->db->from('university');
		$query = $this->db->get();
		$last_id = $query->row_array();
		$last_id['univ_id'];
		$current_id = $last_id['univ_id'] + 1;
		$config = array(
			'allowed_types' => 'jpg|jpeg|gif|png',
			'upload_path' => $this->univ_gallery_path,
			'max_size' => 500,
			'file_name'=>'univ_logo_'.$current_id
		);
		
		$this->load->library('upload', $config);
		$flag=0;
		if($_FILES["userfile"]["name"]!=''){
		if(!$this->upload->do_upload())
		{
		  $flag=1;
		  $data['err_msg']=$this->upload->display_errors();
		  $this->load->view('admin/show_error',$data);
		 
		}
		}
		if($flag==0){
		$image_data = $this->upload->data();
		
		$config = array(
			'source_image' => $image_data['full_path'],
			'new_image' => $this->univ_gallery_path . '/thumbs',
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
			   'user_id' => $this->input->post('univ_owner'),
			   'city_id' =>$this->input->post('city'),
			   'state_id' => $this->input->post('state'),
			   'country_id'=>$this->input->post('country'),
			   'phone_no' => $this->input->post('phone_no'),
			  /* 'switch_off_univ'=>$this->input->post('switch_univ_status'),*/
			   'univ_is_client' =>$this->input->post('univ_is_client'),
			   'subdomain_name' =>$this->input->post('sub_domain'),
			   'contact_us' => $this->input->post('contact_us'),
			   'createdby' =>$cretedby_admin,
			   'univ_fax' =>$this->input->post('fax_address'),
			   'univ_email'=>$this->input->post('univ_email'),
			   'univ_web'=>$this->input->post('web_address'),
			   'salient_features'=>$this->input->post('salient_features'),
			   'univ_overview'=>$this->input->post('txtareaoverview'),
			   'univ_campus'=>$this->input->post('txtareacampus'),
			   'univ_services'=>$this->input->post('txtareaservices'),
			   'univ_faculties'=>$this->input->post('txtareafaculties'),
			   'univ_expertise'=>$this->input->post('txtareaexpertise'),
			   'univ_slife'=>$this->input->post('txtareaslife'),
			   'univ_interstudents'=>$this->input->post('txtareainterstudents'),
			   'univ_alumni'=>$this->input->post('txtareaalumni'),
			   'univ_departments'=>$this->input->post('txtareadepartments'),
			   'univ_insights'=>$this->input->post('txtareainsights')
			);
			$this->db->insert('university', $data);
			redirect('admin/manage_university/ucs');
		}	
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
		$select_place=$country_id.'##'.$state_id.'##'.$city_id;
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
		$select_place=$country_id.'##'.$state_id.'##'.$city_id;
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
		$select_place=$country_id.'##'.$state_id.'##'.$city_id;
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
	
	function get_univ_info($paging='')
	{		
		$this->db->select('*');
		$this->db->from('university');
		$this->db->join('users', 'users.id = university.user_id','left');
		$this->db->join('country', 'country.country_id = university.country_id','left');				
		$query =$this->db->get();
		$config['base_url']=base_url()."admin/manage_university/";
		$config['total_rows']=$query->num_rows();
		$config['per_page'] = '25'; 
		$offset = $paging; //this will work like site/folder/controller/function/query_string_for_cat/query_string_offset
        $limit = $config['per_page'];
		$this->db->select('*');
		$this->db->from('university');
		$this->db->join('users', 'users.id = university.user_id','left');
		$this->db->join('country', 'country.country_id = university.country_id','left');
		$this->db->order_by("university.createdon", "desc");
		$this->db->limit($limit,$offset);
		$query = $this->db->get();
		$this->pagination->initialize($config);
		return $query->result();
	}
	
	function get_univ_info_search($paging,$univ_name,$sel_id)
	{$arr=array('0');
		$this->db->select('*');
		$this->db->from('university');
		$this->db->join('users', 'users.id = university.user_id','left');
		$this->db->join('country', 'country.country_id = university.country_id','left');
		if($sel_id=='1')
		{		  		  
		$this->db->like('univ_name',$univ_name,'both');
		}
		if($sel_id=='2')
		{
		$query1=$this->db->query("select country_id from country as cnt where cnt.country_name like '%$univ_name%'");		  
		$res1=$query1->result_array();
		foreach($res1 as $res)				
					{
					 array_push($arr,$res['country_id']);
					}
		$this->db->where_in('country.country_id',$arr);
		}	
		if($sel_id=='3')
		{
		$query1=$this->db->query("select id from users as usr where usr.fullname like '%$univ_name%'");		  
		$res1=$query1->result_array();
		foreach($res1 as $res)				
					{
					 array_push($arr,$res['id']);
					}
		$this->db->where_in('users.id',$arr);
		}
		if($sel_id=='4')
		{
		 $featured='1';
		$this->db->where('university.featured_college',$featured);
		}
		$query =$this->db->get();
		$config['base_url']=base_url()."admin/ManageUniversitySearch/";
		$config['total_rows']=$query->num_rows();
		$config['per_page'] = 25; 
		$offset = $paging; //this will work like site/folder/controller/function/query_string_for_cat/query_string_offset
        $limit = $config['per_page'];
		$this->db->select('*');
		$this->db->from('university');
		$this->db->join('users', 'users.id = university.user_id','left');
		$this->db->join('country', 'country.country_id = university.country_id','left');
		if($sel_id=='1')
		{		  		  
		$this->db->like('univ_name',$univ_name,'both');
		}
		if($sel_id=='2')
		{
		$query1=$this->db->query("select country_id from country as cnt where cnt.country_name like '%$univ_name%'");		  
		$res1=$query1->result_array();
		foreach($res1 as $res)				
					{
					 array_push($arr,$res['country_id']);
					}
		$this->db->where_in('country.country_id',$arr);
		}	
		if($sel_id=='3')
		{
		$query1=$this->db->query("select id from users as usr where usr.fullname like '%$univ_name%'");		  
		$res1=$query1->result_array();
		foreach($res1 as $res)				
					{
					 array_push($arr,$res['id']);
					}
		$this->db->where_in('users.id',$arr);
		}
		if($sel_id=='4')
		{
		 $featured='1';
		$this->db->where('university.featured_college',$featured);
		}
		$this->db->limit($limit,$offset);
		$query = $this->db->get();
		$this->pagination->initialize($config);
		if($query->num_rows()>0)
		{
		return $query->result();
		}
		else
		{
			return 0;
		}
	}
	function ban_unban_university($ban_status,$univ_id)
	{
		if($ban_status=='0')
		{
		$ban_unban='1';
		}
		else
		{
		$ban_unban='0';
		}
		$data = array(
               'switch_off_univ' => $ban_unban
            );
		$this->db->where('univ_id', $univ_id);	
		$this->db->update('university', $data);
	}
	
	function delete_single_university($univ_id)
	{
		$this->db->delete('university', array('univ_id' => $univ_id));
		$this->db->delete('univ_gallery', array('univ_id' => $univ_id));
		$this->db->delete('univ_program', array('univ_id' => $univ_id));
		$this->db->delete('follow_univ', array('follow_to_univ_id' => $univ_id));
		$this->db->delete('events', array('event_univ_id' => $univ_id));
		$this->db->delete('mailchimp_detail', array('univ_id' => $univ_id));
		$this->db->delete('news', array('news_univ_id' => $univ_id));
		$this->db->delete('article', array('article_univ_id' => $univ_id));		
	}
	
	function delete_universities()
	{
	    $univcount=count($this->input->post('univ_id'));	
		$univ_id=$this->input->post('univ_id');		
		for( $i =0; $i < $univcount ; $i++ )
		{
			if($this->input->post("check_university_".$univ_id[$i])=='checked')
			{
			$this->db->delete('university', array('univ_id' => $univ_id[$i]));
			$this->db->delete('univ_program', array('univ_id' => $univ_id[$i]));
			$this->db->delete('follow_univ', array('follow_to_univ_id' => $univ_id[$i]));
			$this->db->delete('events', array('event_univ_id' => $univ_id[$i]));
			$this->db->delete('mailchimp_detail', array('univ_id' => $univ_id[$i]));
			$this->db->delete('news', array('news_univ_id' => $univ_id[$i]));
			$this->db->delete('article', array('article_univ_id' => $univ_id[$i]));	
			}
		}
	}
	
	function fetch_univ_data_edit($univ_id)
	{
		$this->db->select('*');
		$this->db->from('university');
		$this->db->where('univ_id',$univ_id);
		$this->db->join('users', 'users.id = university.user_id','left');
		$this->db->join('state', 'state.state_id = university.state_id','left');
		$this->db->join('city', 'city.city_id = university.city_id','left');
		$this->db->join('country', 'country.country_id = university.country_id','left');
		$query=$this->db->get();
		return $query->result_array();
	}
	
	function check_subdomain($sub_domain)
	{
	  $this->db->select('*');
	  $this->db->from('university');
	  $this->db->where('subdomain_name',$sub_domain);
	  $query=$this->db->get();
	  if($query->num_rows())
	  return $query->num_rows();
	}
	
	function update_university($univ_id)
	{
	// 'salient_features'=>$this->input->post('salient_features'),
	 /* 'switch_off_univ'=>$this->input->post('switch_univ_status'),*/
	$config = array(
			'allowed_types' => 'jpg|jpeg|gif|png',
			'upload_path' => $this->univ_gallery_path,
			'max_size' => 2000,
			'file_name'=>'univ_logo_'.$univ_id
		);
		$myflag=0;
		$this->load->library('upload', $config);
		$this->upload->overwrite = true;
		 if($_FILES["userfile"]["name"]!=''){
	
		if(!$this->upload->do_upload())
		{
		$myflag=1;
		$data['err_msg']=$this->upload->display_errors();
		$this->load->view('admin/show_error',$data);
		}
		}
		$image_data = $this->upload->data();
		
		$config = array(
			'source_image' => $image_data['full_path'],
			'new_image' => $this->univ_gallery_path . '/thumbs',
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
			   'address_line1' => $this->input->post('address1'),
			   'user_id' =>$this->input->post('univ_owner'),
			   'city_id' =>$this->input->post('city'),
			   'state_id' => $this->input->post('state'),
			   'country_id'=>$this->input->post('country'),
			   'phone_no' => $this->input->post('phone_no'),
			   'univ_is_client' =>$this->input->post('univ_is_client'),
			   'subdomain_name' =>$this->input->post('sub_domain'),
			   'about_us' => $this->input->post('about_us'),
			   'contact_us' => $this->input->post('contact_us'),
			   'createdby' =>$cretedby_admin,
			   'univ_fax'=>$this->input->post('fax_address'),
			   'univ_email'=>$this->input->post('univ_email'),
			   'univ_web'=>$this->input->post('web_address'),
			   'univ_overview'=>$this->input->post('txtareaoverview'),
			   'univ_campus'=>$this->input->post('txtareacampus'),
			   'univ_services'=>$this->input->post('txtareaservices'),
			   'univ_faculties'=>$this->input->post('txtareafaculties'),
			   'univ_expertise'=>$this->input->post('txtareaexpertise'),
			   'univ_slife'=>$this->input->post('txtareaslife'),
			   'univ_interstudents'=>$this->input->post('txtareainterstudents'),
			   'univ_alumni'=>$this->input->post('txtareaalumni'),
			   'univ_departments'=>$this->input->post('txtareadepartments'),
			   'univ_insights'=>$this->input->post('txtareainsights')
			);
			//print_r($data);
			$this->db->update('university', $data,array('univ_id'=>$univ_id));		
			if($myflag==0 && $_FILES["userfile"]["name"]!='')
			{
			$data=array('univ_logo_path' =>$image_data['file_name']);
			$this->db->update('university', $data,array('univ_id'=>$univ_id));		
			}
			$check=$this->adminmodel->upload_univ_gallery($univ_id);	
			if($myflag==0)
			{
			redirect('admin/manage_university/uus');
			}
			
			//redirect('admin/manage_university/uus');
	}

	function check_unique_field($field_name,$value,$table_name)
	{
		$this->db->select('*');
		$this->db->from($table_name);
		$this->db->where($field_name,$value);
		$query=$this->db->get();
		return $query->num_rows();
	}
	
	function upload_univ_gallery($univ_id)
	{
		$config['upload_path'] = $this->univ_gallery_path; // server directory
        $config['allowed_types'] = 'gif|jpg|png|jpeg|'; // by extension, will check for whether it is an image
        $this->load->library('upload', $config);
        $this->load->library('Multi_upload');
		if (empty($_FILES))
		{
		return 0;
		}
		else
		{
				$files = $this->multi_upload->go_upload();
        
        if ( ! $files )        
        {
            $data['err_msg'] ='Error!  Please Check file size and type';
            $this->load->view('admin/show_error', $data);
			return 0;
        }    
        else
        {
		    $f=0;
				$field = 'userfile1';
				$user_id=$this->tank_auth->get_admin_user_id();
            $data1 = array('upload_data' => $files);
			$num_files = count($_FILES[$field]['name'])-1;
			$f=0;
			for($a=0;$a<$num_files;$a++)
			{
						$data = array(
				'gal_type' =>'univ',
				'univ_id'=>	$univ_id,
			   'g_image_path' => $data1['upload_data'][$a]['name'],
			   'postedby' => $user_id,
			   
			);
			$this->db->insert('univ_gallery', $data);	
				$f=1;
			}
			//return $f;
			//redirect('admin/manage_univ_gallery/ius');
			return 1;
			
		}
		}
        
	}
	
	function get_univ_gallery_info($univ_id)
	{
		$query = $this->db->get_where('univ_gallery', array('gal_type' =>'univ','univ_id'=>$univ_id));
		return $query->result_array();
	}
	function get_univ_gallery_info_count($univ_id)
	{
		$query = $this->db->get_where('univ_gallery', array('gal_type' =>'univ','univ_id'=>$univ_id));
		return $query->num_rows();
	}
	function delete_univ_gallery_pic($gid)
	{
	$this->db->delete('univ_gallery', array('gid' => $gid));
	}
	
	function fetch_univ_detail($user_id)
	 {
	 $this->db->select('*');
	 $this->db->from('university');
	 $this->db->where('user_id',$user_id);
	 $query=$this->db->get();
	 if($query->num_rows()>0)
	 return $query->result();
	 else
	 return 0;
	 }
	 
	 
 function update_univ_admin_university($univ_id)
 {
 $config = array(
   'allowed_types' => 'jpg|jpeg|gif|png',
   'upload_path' => $this->univ_gallery_path,
   'max_size' => 2000
  );
  $myflag=0;
  $this->load->library('upload', $config);
  if($this->upload->do_upload())
  {
  $myflag=1;
  }
  $image_data = $this->upload->data();
  
  $config = array(
   'source_image' => $image_data['full_path'],
   'new_image' => $this->univ_gallery_path . '/thumbs',
   'maintain_ration' => true,
   'width' => 150,
   'height' => 100
  );
  
  $this->load->library('image_lib', $config);
  $this->image_lib->resize();
 
  $cretedby_admin=$this->tank_auth->get_admin_user_id();
      $data = array(
      'univ_name' => $this->input->post('univ_name'),
      'address_line1' => $this->input->post('address1'),
       'city_id' =>$this->input->post('city'),
      'state_id' => $this->input->post('state'),
      'country_id'=>$this->input->post('country'),
      'phone_no' => $this->input->post('phone_no'),
      'contact_us' => $this->input->post('contact_us'),
      'createdby' =>$cretedby_admin,
      'univ_fax'=>$this->input->post('fax_address'),
      'univ_email'=>$this->input->post('univ_email'),
      'univ_web'=>$this->input->post('web_address'),
      'univ_overview'=>$this->input->post('txtareaoverview'),
      'univ_campus'=>$this->input->post('txtareacampus'),
      'univ_services'=>$this->input->post('txtareaservices'),
      'univ_faculties'=>$this->input->post('txtareafaculties'),
      'univ_expertise'=>$this->input->post('txtareaexpertise'),
      'univ_slife'=>$this->input->post('txtareaslife'),
      'univ_interstudents'=>$this->input->post('txtareainterstudents'),
      'univ_alumni'=>$this->input->post('txtareaalumni'),
      'univ_departments'=>$this->input->post('txtareadepartments'),
      'univ_insights'=>$this->input->post('txtareainsights')
   );
   $this->db->update('university', $data,array('univ_id'=>$univ_id));  
   if($myflag==1)
   {
   $data=array('univ_logo_path' =>$image_data['file_name']);
   $this->db->update('university', $data,array('univ_id'=>$univ_id)); 
   //redirect('admin) 
   }
   
 }
 
 function get_assigned_univ_info($paging='')
 {
  
  $data['user_id'] = $this->tank_auth->get_admin_user_id();
  $univ=$this->univ_vs_user_model->get_assigned_univ_info($data['user_id']);
  $this->db->select('*');
  $this->db->from('university');
  $this->db->where_in('univ_id',$univ);
  $this->db->join('users', 'users.id = university.user_id','left');
  $this->db->join('country', 'country.country_id = university.country_id','left');
  $query =$this->db->get();
  $config['base_url']=base_url()."admin/manage_university/";
  $config['total_rows']=$query->num_rows();
  $config['per_page'] = '25'; 
  $offset = $paging; //this will work like site/folder/controller/function/query_string_for_cat/query_string_offset
        $limit = $config['per_page'];
  $this->db->select('*');
  $this->db->from('university');
  $this->db->where_in('univ_id',$univ);
  $this->db->join('users', 'users.id = university.user_id','left');
  $this->db->join('country', 'country.country_id = university.country_id','left');
  $this->db->order_by("university.createdon", "desc");
  $this->db->limit($limit,$offset);
  $query = $this->db->get();
  $this->pagination->initialize($config);
  return $query->result();
 }
	
  function home_featured_unfeatured_university($f_status,$univ_id)
  {
		if($f_status=='1')
		{
		$f_status='0';
		}
		else if($f_status=='0')
		{
		$f_status='1';
		}
		$data=array('featured_college'=>$f_status);
		$this->db->update('university', $data, array('univ_id' => $univ_id));
		return $f_status;
  }  
	
}
/* End of file users.php */
/* Location: ./application/models/auth/users.php */

