<?
class Facebooktest extends CI_Controller{
	function __construct()
	{
		parent::__construct();
		$this->load->model('facebook');
	}
	
	function index(){
		$this->load->view('example');
	}

	function test1(){
		$data = array();
		$data['user'] = $this->facebook_model->getUser();
		$this->load->view('facebooktest/test1',$data);
	}

	function test2(){
		$data = array();
		$data['friends'] = $this->facebook_model->getFriends();
		$this->load->view('facebooktest/test2',$data);
	}
}

?>