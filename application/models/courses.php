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
class Courses extends CI_Model
{
	var $gallery_path;
		var $univ_gallery_path;
		function __construct()
		{
		
			parent::__construct();
			$this->gallery_path = realpath(APPPATH . '../uploads/home_gallery');
			$this->univ_gallery_path = realpath(APPPATH . '../uploads/univ_gallery');
			$this->gallery_path_url = 'http://127.0.0.1/Meet-Univ/uploads/';
			$this->load->library('pagination');
			$this->load->database();
		}

		function educ_lvl_id_by_name($val)
		{
		$val=trim($val);
		$query = $this->db->get_where('program_educ_level', array('educ_level' => $val));
		if($query->num_rows() > 0)
		{
		$res=$query->row_array();
		$educ_lvl_id=$res['prog_edu_lvl_id'];
		}
		else
		{
		$educ_lvl_id=0;
		}
		return $educ_lvl_id; 
		}
		
		function area_of_intrst_id_by_name($val)
		{
		$val=trim($val);
		$query = $this->db->get_where('program_parent', array('program_parent_name' => $val));
		if($query->num_rows() > 0)
		{
		$res=$query->row_array();
		$educ_lvl_id=$res['prog_parent_id'];
		}
		else
		{
		$educ_lvl_id=0;
		}
		return $educ_lvl_id; 
		}
	
	
	
	function upload_bulk_courses()
	{
			$data['user_id']	= $this->tank_auth->get_admin_user_id();
			$config['upload_path'] = $this->excel_path;
			$config['allowed_types'] = 'xls';
			//$config['max_size']    = '10000';
			$this->load->library('upload', $config);
			if(!$this->upload->do_upload()){
			$data['msg']=$this->upload->display_errors();
			$this->load->view('admin/userupdated',$data);
			} else {
			$this->load->library('Spreadsheet_Excel_Reader');
			$path=$this->excel_path.'/'.$_FILES['userfile']['name'];
			$data1 = new Spreadsheet_Excel_Reader();
			$data1->read($path);
			error_reporting(E_ALL ^ E_NOTICE);
			for ($j = 1; $j < $data1->sheets[0]['numRows']; $j++)
			{
				$prog_data=array();
				for ($i = 1; $i <= $data1->sheets[0]['numCols']; $i++)
				{	
				$res=$data1->sheets[0]['cells'][$j+1][$i];			
				//for finding program education level id by its name
				if($i==2)
				{
				$res=$this->courses->educ_lvl_id_by_name($data1->sheets[0]['cells'][$j+1][$i]);
				}
				if($i==4)
				{
				$res=$this->courses->area_of_intrst_id_by_name($data1->sheets[0]['cells'][$j+1][$i]);
				}
				$prog_data[]=$res;	
								
				}
				$pro=array('prog_title' =>$prog_data[0],
							'educ_level_id'=>$prog_data[1],
							'course_name'=>$prog_data[2],
							'prog_parent_id'=>$prog_data[3],
							'createdby'=>$data['user_id']
							);
				/*$pro=array('prog_title' =>$prog_data[0],
							'educ_level_id'=>$prog_data[1],
							'course_name'=>$prog_data[2],
							'prog_parent_id'=>$prog_data[3],
							'intake1'=>$prog_data[4],
							'intake2'=>$prog_data[5],
							'program_duration1'=>$prog_data[6],
							'tution_fee1'=>$prog_data[7],
							'program_duration2'=>$prog_data[8],
							'tution_fee2'=>$prog_data[9],
							'experience_required'=>$prog_data[10],
							'gpa_required'=>$prog_data[11],
							'per_required'=>$prog_data[12],
							'program_detail'=>$prog_data[13],
							'createdby'=>$data['user_id']
							);
				*/			
				$this->db->insert('program',$pro);
			}
			//echo $data->sheets[0]['numRows'];
			
		}
	}
	
	function add_single_course()
	{
		$data['user_id']	= $this->tank_auth->get_admin_user_id();
		$data=array(
		'prog_title'=>$this->input->post('prog_title'),
		'course_name'=>$this->input->post('course_name'),
		'educ_level_id'=>$this->input->post('educ_level'),
		'prog_parent_id'=>$this->input->post('area_interest'),
		'createdby'=>$data['user_id']
			);
		$this->db->insert('program',$data);
	}
	
	function fetch_programs($educ_lvl_id,$prog_parent_id)
	{
		$query = $this->db->get_where('program', array('educ_level_id' =>$educ_lvl_id ,'prog_parent_id' =>$prog_parent_id));
		return $query->result_array();
	}
	
	function add_course_to_univ()
	{
	$data['user_id']	= $this->tank_auth->get_admin_user_id();
		$data=array(
		'program_id'=>$this->input->post('program'),
		'univ_id'=>$this->input->post('university'),
		'intake1'=>$this->input->post('intake1'),
		'intake2'=>$this->input->post('intake2'),
		'program_duration1'=>$this->input->post('course_duration1'),
		'tution_fee1'=>$this->input->post('currency1').''.$this->input->post('tution_fee1'),
		'program_duration2'=>$this->input->post('course_duration2'),
		'tution_fee2'=>$this->input->post('currency2').''.$this->input->post('tution_fee2'),
		'experience_required'=>$this->input->post('exp_required'),
		'gpa_required'=>$this->input->post('gpa_required'),
		'per_required'=>$this->input->post('per_required'),
		'program_detail'=>$this->input->post('prog_detail'),
		'insertedby'=>$data['user_id']
			);
		$this->db->insert('univ_program',$data);
		$res=$this->courses->university_educ_level_exists($this->input->post('university'),$this->input->post('educ_level'));
		if(!$res)
		{
			$data=array('univ_id'=>$this->input->post('university'),
						'curr_educ_level_id'=>$this->input->post('educ_level')
			);
			$this->db->insert('university_educ_level',$data);
		}
	}
	
	function check_univ_course($univ_id,$prog_id)
	{
		$query = $this->db->get_where('univ_program', array('univ_id' => $univ_id,'program_id'=>$prog_id));
		return $query->num_rows();
		
	}
	
	function university_educ_level_exists($univ_id,$educ_level)
	{
	$query = $this->db->get_where('university_educ_level', array('univ_id' => $univ_id,'curr_educ_level_id'=>$educ_level));
	return $query->num_rows();
	}
}
/* End of file users.php */
/* Location: ./application/models/auth/users.php */