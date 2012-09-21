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
		$data['header_title'] = 'Question and Answer | Meet Universities';
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
		if($this->form_validation->run())
		{
		$univ_or_country_id = $this->input->post('colleges');
		$quest_title = $this->input->post('quest_title');
		$quest_detail = $this->input->post('quest_detail');
		$quest_cat_type = $this->input->post('category');
		if($univ_or_country_id==0)
		{
			$univ_or_country_id='';
		}
		if($quest_cat_type=='col')
		{
		 $quest_cat_type='univ';
		}
		if($quest_cat_type=='gen')
		{
		$quest_cat_type='general';
		}
		$quest = array(
				'q_category'=>$quest_cat_type,
				'q_univ_id'=>$univ_or_country_id,
				'q_title'=>$quest_title,
				'q_detail'=>$quest_detail,
				'q_approve'=>'0',
				'q_featured_home_que'=>'0',
				'q_featured_country_que'=>'0',
				'q_asked_time'=>date('Y-m-d H:i:s',time())
		);
		if (!$this->tank_auth->is_logged_in()) {	
			$quest_sess = array('quest_sess_active'=>1);
			$this->session->set_userdata($quest);
			$this->session->set_userdata($quest_sess);
			redirect('/login/');			
		}
		else {
			$quest['q_askedby']=$this->tank_auth->get_user_id();
			$data['post_quest'] = $this->quest_ans_model->post_quest($quest);
			$this->session->set_flashdata('success',1);
			$domain = $_SERVER['HTTP_HOST'];
			$pageURL ="http://" . $domain . $_SERVER['REQUEST_URI'];
			redirect($pageURL);
			
		}
			
			
		}
		
		if($this->session->userdata('quest_send_suc') != '')
			{
				$data['show_quest_send_msg'] = '1';
				$this->session->set_userdata('quest_send_suc','');
			}
	    }		
		$data['get_all_question'] = $this->quest_ans_model->get_recent_quest_user_info();
		//echo count($data['get_all_question']);
		//$data['count_all_question'] = $this->quest_ans_model->count_all_questions();
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
	
	function Browse_Question($type='')
	{
		$data = $this->path->all_path();
		$this->load->view('auth/header',$data);
		if($type == 'All' || $type=='all')
		{
		$data['count_all_question'] = $this->quest_ans_model->count_all_questions();
		$data['get_all_question'] = $this->quest_ans_model->get_recent_quest_user_info();
		$this->load->view('auth/browse_all_quest',$data);
		}
		else if($type == 'All_Questions')
		{
			 $univ_id=$this->subdomain->find_id_of_current_univ();
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
	
	function AnotherQuestion($quest_id='')
	{

		$data = $this->path->all_path();
		$ask_user_id=$this->quest_ans_model->find_user_id_of_question($quest_id);
		
		$data['user_is_logged_in']=0;
				if($this->tank_auth->is_logged_in())
				{
				$data['user_is_logged_in']=1;
				$data['user_detail']=$this->users->fetch_profile($this->ci->session->userdata('user_id'));
				}
		if($quest_id!='' && $ask_user_id!='')
		{
			$univ_id = 'meetquest';
			$data['single_quest'] = $this->quest_ans_model->get_single_quest_detail($univ_id,$quest_id,$ask_user_id);
			//$data['question_comments'] = $this->quest_ans_model->get_single_quest_comments($quest_id);
			if($this->tank_auth->is_logged_in())
				{
				$data['user_is_logged_in']=1;
				$data['user_detail']=$this->users->fetch_profile($this->ci->session->userdata('user_id'));
				}
			$comments=$this->frontmodel->fetch_all_comments('qna',$quest_id);
				if($comments!=0)
				{
				$data['article_comments']=$comments['comments'];
				$data['total_comment']=$comments['total_comment'];
				}
				else
				{
				$data['article_comments']=0;
				$data['total_comment']=0;
				}	
			
			$data['img_src'] = base_url()."uploads/univ_gallery/univ_logo.png";

			if($data['single_quest']['q_title'] != '' || $data['single_quest']['q_title'] != 0)
			{
				$data['header_title'] = $data['single_quest']['q_title'].' | Meet Universities';
			}
			else {
				$data['header_title'] = "Meet Universities - Get connected to your dream university.";
			}
			
			if($data['single_quest']['q_detail'] != '' || $data['single_quest']['q_detail'] != 0)
			{
				$event_details=str_replace('<div>','',$data['single_quest']['q_detail']);
				$event_details=str_replace('</div>','',$event_details);
				$data['header_detail'] = $event_details; 
			}
			else {
				$data['header_detail'] = "Study Abroad - Research, Connect &  Meet Your Dream University.";
			}
			
			$this->load->view('auth/header',$data);
			
			if($data['single_quest'] == 0)
			{
				$data['err_msg']='<h2> Sorry....</br><span class="text-align">Question Detail Not Found.... </span> </h2>';
				$data['err_div']=1;
				$this->load->view('auth/NotFoundPage',$data);
			}
			else{
			$this->load->view('auth/meet_general_question',$data);
			}
		}
		else{
		$this->load->view('auth/header',$data);
		$data['err_msg']='<h2> Sorry....</br><span class="text-align">No Question Found.... </span> </h2>';
			$data['err_div']=1;
		$this->load->view('auth/NotFoundPage',$data);
		}
		$this->load->view('auth/footer',$data);
	}
}