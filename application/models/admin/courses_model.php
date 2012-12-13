<?php if (!defined('BASEPATH')) exit('No direct script access allowed');
class Courses_model extends CI_Model
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
			$data['err_msg']=$this->upload->display_errors();
			$this->load->view('admin/show_error',$data);
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
				redirect('admincourses/manage_courses/bcus');
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
		'prog_educ_level'=>$this->input->post('educ_level'),
		'prog_parent_id'=>$this->input->post('area_interest'),
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
		
	}
	
	function check_univ_course($univ_id,$prog_id)
	{
		$query = $this->db->get_where('univ_program', array('univ_id' => $univ_id,'program_id'=>$prog_id));
		return $query->num_rows();
		
	}
	
	
	function program_info()
	{
		$this->db->select('*');
		$this->db->from('program');
		$this->db->join('program_educ_level', 'program_educ_level.prog_edu_lvl_id = program.educ_level_id');
		$this->db->join('program_parent', 'program_parent.prog_parent_id = program.prog_parent_id');
		$this->db->group_by("program.course_name");
		$query =$this->db->get();
		$config['base_url']=base_url()."admincourses/manage_courses/";
		$config['total_rows']=$query->num_rows();
		$config['per_page'] = '5'; 
		$offset = $this->uri->segment(3); //this will work like site/folder/controller/function/query_string_for_cat/query_string_offset
        $limit = $config['per_page'];
		$this->db->select('*');
		$this->db->from('program');
		$this->db->join('program_educ_level', 'program_educ_level.prog_edu_lvl_id = program.educ_level_id');
		$this->db->join('program_parent', 'program_parent.prog_parent_id = program_parent.prog_parent_id');
		$this->db->group_by("program.prog_id");
		$this->db->limit($limit,$offset);
		$query = $this->db->get();
		$this->pagination->initialize($config);
		return $query->result();
	}
	function delete_single_course($prog_id)
	{
		$this->db->delete('program', array('prog_id' => $prog_id));
		$this->db->delete('univ_program',array('program_id' => $prog_id));
	}
	
	function delete_courses()
	{
		$progcount=count($this->input->post('course_id'));	
		$prog_id=$this->input->post('course_id');
		for( $i =0; $i < $progcount ; $i++ )
		{
			if($this->input->post("check_course_".$prog_id[$i])=='checked')
			{
			$this->db->delete('program', array('prog_id' => $prog_id[$i]));
			$this->db->delete('univ_program',array('program_id' => $prog_id[$i]));
			
			}
		}
		
	}
	//new
	function delete_univ_courses()
	{
		$idsstring=$this->input->post('course_id');
		foreach($idsstring as $ids)
		{
			$this->db->delete('univ_program', array('id' => $ids));
		}
		return 1;
	}
	//new
	function delete_single_course_univ($prog_id)
	{
	$this->db->delete('univ_program',array('id' => $prog_id));
	return 1;
	}
	//new	
	function fetch_univ_courses($univ_id)
	{
	
		$this->db->select('*');
		$this->db->from('univ_program');
		$this->db->join('program', 'program.prog_id = univ_program.program_id');
		$this->db->join('program_educ_level', 'program_educ_level.prog_edu_lvl_id = program.educ_level_id');
		$this->db->join('program_parent', 'program_parent.prog_parent_id = program.prog_parent_id');
		$this->db->where('univ_id', $univ_id);		
		$query = $this->db->get();		
		return $query->result();
	}
	function univ_courses_latest($univ_id)
	{
	
		$this->db->select('*');
		$this->db->from('univ_program');
		$this->db->join('program', 'program.prog_id = univ_program.program_id');
		$this->db->join('program_educ_level', 'program_educ_level.prog_edu_lvl_id = program.educ_level_id');
		$this->db->join('program_parent', 'program_parent.prog_parent_id = program.prog_parent_id');
		$this->db->where('univ_id', $univ_id);
		$this->db->order_by('created_time','desc');
		$this->db->limit(10);
		$query = $this->db->get();		
		return $query->result();
	}
	
	function fetch_program_list($educ_level)
	{
		$this->db->select('*');
		$this->db->from('program');
		if($educ_level!='' && $educ_level!=NULL)
		{
		$this->db->where('educ_level_id',$educ_level);
		}
		$query = $this->db->get();
		if($query->num_rows()>1)
		return $query->result_array();
		else
		return 0;
	}
	function fetch_program_list_with_educ_level()
	{
		$this->db->select('*');
		$this->db->from('program');
		$this->db->join('program_educ_level','program.educ_level_id=program_educ_level.prog_edu_lvl_id');
		$query = $this->db->get();
		if($query->num_rows()>1)
		return $query->result_array();
		else
		return 0;
	}
	function fetch_universities()
	{
		$this->db->select('*');
		$this->db->from('university');
		$this->db->order_by("univ_name", "asc");
		$query = $this->db->get();
		if($query->num_rows()>1)
		return $query->result_array();
		else
		return 0;
	} 
	
	function fetch_univ_program($univ_id)
	{
		$this->db->select('program_id');
		$this->db->from('univ_program');
		$this->db->where('univ_id', $univ_id);
		$query=$this->db->get();
		return $query->result_array();
		
	}
	
	function insert_courses_to_univ()
	{
	
			$program_name = $this->input->post('programs_name');
			$program_id = $this->input->post('program_id');
			$univ_id=$this->input->post('university');
			$already_checked_prog = $this->input->post('already_checked_prog');
			
			$data['user_id']	= $this->tank_auth->get_admin_user_id();
			$area_intrest=$this->input->post('area_interest');	
			$educ_level=$this->input->post('education_level_id');	
			$i=0;
			foreach($program_id as $prog_id)
			{
			 if(!in_array($prog_id,$program_name))
			 {
			 $this->db->delete('univ_program',array('program_id'=>$prog_id,'univ_id'=>$univ_id));
			 }
			 if((in_array($prog_id,$program_name)) && (!in_array($prog_id,$already_checked_prog)))
			 {
				$prog_educ_level_id=$educ_level[$i];
				$univ_prog_data = array(
				'univ_id'=>$univ_id,
				'program_id'=> $prog_id,
				'insertedby' => $data['user_id'],
				'prog_parent_id' =>$area_intrest[$i],
				'prog_educ_level' => $prog_educ_level_id
				);
				$this->db->insert('univ_program',$univ_prog_data);
			 }
			 $i=$i+1;
			}
			/*foreach($education_level_id as $educ_level_id)
			{
			if()
			$this->db->delete('univ_program',array('univ_id'=>$this->input->post('university')));
			
			
			$prog_educ_level_id=$educ_level[$i];
			$univ_prog_data = array(
			'univ_id'=>$this->input->post('university'),
			'program_id'=> $program_id,
			'insertedby' => $data['user_id'],
			'prog_parent_id' =>$area_intrest[$i],
			'prog_educ_level' => $prog_educ_level_id
			);
			//$this->db->insert('univ_program',$univ_prog_data);
			$i=$i+1;
			}*/
	}
	function fetch_all_univ_courses()
	{	
		$this->db->select('*');
		$this->db->from('univ_program');
		$this->db->join('program', 'program.prog_id = univ_program.program_id');
		$this->db->join('program_educ_level', 'program_educ_level.prog_edu_lvl_id = program.educ_level_id');
		$this->db->join('program_parent', 'program_parent.prog_parent_id = program.prog_parent_id');
		$query = $this->db->get();		
		return $query->result();
	}
	function fetch_univ_courses_latest()
	{
	
		$this->db->select('*');
		$this->db->from('univ_program');
		$this->db->join('program', 'program.prog_id = univ_program.program_id');
		$this->db->join('program_educ_level', 'program_educ_level.prog_edu_lvl_id = program.educ_level_id');
		$this->db->join('program_parent', 'program_parent.prog_parent_id = program.prog_parent_id');
		$this->db->order_by('created_time','desc');
		$this->db->limit(10);
		$query = $this->db->get();		
		return $query->result();
	}
}

/* End of file users.php */
/* Location: ./application/models/auth/users.php */