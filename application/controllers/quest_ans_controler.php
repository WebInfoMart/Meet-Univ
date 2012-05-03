<?php if (!defined('BASEPATH')) exit('No direct script access allowed');
class Quest_ans_controler extends CI_Controller
{
	function __construct()
	{
		parent::__construct();
		$this->load->helper(array('form', 'url'));
		$this->load->library('form_validation');
		$this->load->library('security');
		$this->load->helper('url');
		$this->load->library('tank_auth');
		$this->lang->load('tank_auth');
		$this->load->helper('string');
		$this->load->library('email');
		$this->ci =& get_instance();
		$this->ci->load->library('session');
		$this->load->library('fbConn/facebook');
	}
	
	function index()
	{
	}
	
	function QuestandAns()
	{
		$data = $this->path->all_path();
		$this->load->view('auth/header',$data);
		$this->load->helper('date');
		/// use session for show question send success--Subh
		$data['show_quest_send_msg'] = '';
		//$data['quest_var'] = '';
		if($this->input->post('ask_quest'))
			{
				$data['quest_var'] = $this->input->post('quest_on_univ');
			}
			else{
			$data['quest_var'] = '';
			}		
		if($this->input->post('post_quest'))
		{
		$this->form_validation->set_rules('quest_title','Question Title','required');
		$this->form_validation->set_rules('colleges','Category Field','required');
		if($this->form_validation->run())
		{
		if (!$this->tank_auth->is_logged_in()) {
			$univ_or_country_id = $this->input->post('colleges');
			$quest_title = $this->input->post('quest_title');
			$quest_detail = $this->input->post('quest_detail');
			$quest_cat_type = $this->input->post('category');
			if($quest_cat_type == 'col')
			{
			$quest = array(
			'q_category'=>'univ',
			'q_univ_id'=>$univ_or_country_id,
			'q_title'=>$quest_title,
			'q_detail'=>$quest_detail,
			'q_approve'=>'0',
			'q_featured_home_que'=>'0',
			'q_featured_country_que'=>'0',
			);
			}
			
			{
				$quest = array(
			'q_category'=>'country',
			'q_country_id'=>$univ_or_country_id,
			'q_title'=>$quest_title,
			'q_detail'=>$quest_detail,
			'q_approve'=>'0',
			'q_featured_home_que'=>'0',
			'q_featured_country_que'=>'0',
			);
			}
			$quest_sess = array(
			'quest_sess_active'=>'true'
			);
			$quest_cat_type = array(
			'quest_cat_type'=>$this->input->post('category')
			);
			$this->session->set_userdata($quest);
			$this->session->set_userdata($quest_sess);
			$this->session->set_userdata($quest_cat_type);
			
			redirect('/login/');
		} else {
			$univ_or_country_id = $this->input->post('colleges');
			$quest_title = $this->input->post('quest_title');
			$quest_detail = $this->input->post('quest_detail');
			$data['user_id']	= $this->tank_auth->get_user_id();
			$quest_cat_type = $this->input->post('category');
			if($quest_cat_type == 'col')
			{
			$quest = array(
			'q_category'=>'univ',
			'q_univ_id'=>$univ_or_country_id,
			'q_title'=>$quest_title,
			'q_detail'=>$quest_detail,
			'q_askedby'=>$data['user_id'],
			'q_approve'=>'0',
			'q_featured_home_que'=>'0',
			'q_featured_country_que'=>'0',
			);
			$data['post_quest'] = $this->quest_ans_model->post_quest($quest);
			$data['show_quest_send_msg'] = '1';
			}
			else if($quest_cat_type == 'sa')
			{
				$quest = array(
			'q_category'=>'country',
			'q_country_id'=>$univ_or_country_id,
			'q_title'=>$quest_title,
			'q_detail'=>$quest_detail,
			'q_askedby'=>$data['user_id'],
			'q_approve'=>'0',
			'q_featured_home_que'=>'0',
			'q_featured_country_que'=>'0',
			);
			$data['post_quest'] = $this->quest_ans_model->post_quest($quest);
			$data['show_quest_send_msg'] = '1';
			}
			
			
		}
		}
		}
		if($this->session->userdata('quest_send_suc') != '')
			{
				$data['show_quest_send_msg'] = '1';
				$this->session->set_userdata('quest_send_suc','');
			}
			
		$data['get_all_question'] = $this->quest_ans_model->get_all_quest_user_info();
		//echo count($data['get_all_question']);
		$data['count_all_question'] = $this->quest_ans_model->count_all_questions();
		//print_r($data['count_all_question']);
		$this->load->view('auth/all_question',$data);
		$this->load->view('auth/footer',$data);
	}
	function collage_list_ajax()
	{
		$data['collage_list'] = $this->quest_ans_model->collage_list();
		$this->load->view('ajaxviews/col_list_ajax',$data);
	}
	
	function country_list_ajax()
	{
		$data['country_list'] = $this->users->fetch_country();
		$this->load->view('ajaxviews/country_list_ajax',$data);
	}
	
	function BrowseQuestion($type='',$univ_id='')
	{
		$data = $this->path->all_path();
		$this->load->view('auth/header',$data);
		if($type == 'allcol')
		{
		$data['count_all_question'] = $this->quest_ans_model->count_all_questions();
		$data['get_all_question'] = $this->quest_ans_model->get_all_quest_user_info();
		$this->load->view('auth/browse_all_quest',$data);
		}
		else if($type == 'univquest')
		{
			$data['get_all_question'] = $this->quest_ans_model->get_all_quest_of_univ_user_info($univ_id);
			$data['count_all_question'] = $this->quest_ans_model->count_all_questions_of_univ($univ_id);
			//print_r($data['get_all_question']);
			$this->load->view('auth/browse_all_quest',$data);
		}
		else
		{
		$data['err_msg']='<h2> Sorry....</br><span class="text-align">No Results Found.... </span> </h2>';
			$data['err_div']=1;
			$this->load->view('auth/NotFoundPage',$data);
		}
		//print_r($data['get_all_question']);
		
		
		$this->load->view('auth/footer',$data);
	}
}