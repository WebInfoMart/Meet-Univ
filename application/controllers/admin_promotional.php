<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Admin_promotional extends CI_Controller
{
	function __construct()
	{
		parent::__construct();

		$this->load->helper('url');
		$this->load->library('tank_auth');
		$this->load->model('promotional_panel');
	}

	function index()
	{
		$data = $this->path->all_path();
		if (!$this->tank_auth->is_admin_logged_in()) {
			
	    redirect('admin/adminlogin/');
		} else {
		$data['user_id']	= $this->tank_auth->get_admin_user_id();
		$data['admin_user_level']=$this->tank_auth->get_admin_user_level();
		$data['admin_priv']=$this->adminmodel->get_user_privilege($data['user_id']);
		if(!($data['admin_priv']))
		{
			redirect('admin/adminlogout');
		}
		if($data['admin_user_level']==3 || $data['admin_user_level']==5)
		{
		 $data['total_student']=$this->promotional_panel->count_total_student_in_portal();
		 $data['country_list']=$this->promotional_panel->show_country_list();
		 $country_id=$this->promotional_panel->get_country_id_by_name('India');
		 $data['total_student_in_india']=$this->promotional_panel->total_student_in_country($country_id['country_id']);
		 $data['undergraduate_in_india']=$this->promotional_panel->total_student_in_ug($country_id['country_id'],2);
		 $data['all_cities']=$this->promotional_panel->fetch_all_cities();
		 $this->load->view('admin/header',$data);
		 $this->load->view('admin/sidebar',$data);
		 $this->load->view('admin/promotional/promotional',$data);
		}
		}
	}
	
	function count_student_change_wise()
	{
	 $country=$this->input->post('country_id');
	 $city=$this->input->post('city_id');
	 $educ_lvl=$this->input->post('educ_level');
     if($country!='0')
	 {
	 $c_where=" and if(ld.home_country_id='',up.country_id,ld.home_country_id)='".$country."'";
	 }
	 if($city!='0')
	 {
	 $c_where.=" AND IF( ld.city =  '0', up.city_id, ld.city )='".$city."'";		
	 }
	 if($educ_lvl!='0')
	 {
	 $c_where.=" AND IF( ld.current_educ_level =  '0', up.curr_educ_level, ld.current_educ_level )='".$educ_level."'";		
	 }
	        $sql="SELECT * ,
			IF( ld.current_educ_level =  '0', up.curr_educ_level, ld.current_educ_level ) AS el,
			IF( ld.home_country_id =  '0', up.country_id, ld.home_country_id ) AS hc,
			IF( ld.city =  '0', up.city_id, ld.city ) as city
			FROM user_profiles up, lead_data AS ld, users u
			WHERE up.user_id = u.id
			AND u.email = ld.email".
			$c_where;
			$res=$this->db->query($sql);
			echo $res->num_rows();
			//echo $sql;	
	}

}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */