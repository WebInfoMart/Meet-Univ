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
		 $this->load->view('admin/promotional/promotional',$data);
		}
		}
	}
	
	function count_student_country_wise()
	{
	  $country=$this->input->post('country');	
	  $sql="SELECT id,if(ld.home_country_id='',up.country_id,ld.home_country_id) as country from user_profiles up,verified_lead_data as vl,users u where up.user_id=u.id and u.email=ld.email and if(ld.home_country_id='',up.country_id,ld.home_country_id)='".$country."'";
	  $res=$this->db->query($sql);
	  echo $res->num_rows();
	  

	}

}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */