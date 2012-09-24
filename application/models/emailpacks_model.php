<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class emailpacks_model extends CI_Model
{
	var $gallery_path;
		var $univ_gallery_path;
	function __construct()
	{
	
		parent::__construct();
		$this->gallery_path = realpath(APPPATH . '../uploads/home_gallery');
		$this->univ_gallery_path = realpath(APPPATH . '../uploads/news_news_images');
		$this->load->library('pagination');
		$this->load->database();
	}
	
	function create_new()
	{
		$data['user_id'] = $this->tank_auth->get_admin_user_id();
		$data=array(
		'email_pack_name'=>$this->input->post('pack_name'),
		'email_pack_cost'=>$this->input->post('pack_cost'),
		'pack_contains_email'=>$this->input->post('emails'),
		'enabled'=>$this->input->post('enable')		
		);
		$this->db->insert('email_pack',$data);
		return 1;
		
	}
	function create_promocode()
	{
		$data['user_id'] = $this->tank_auth->get_admin_user_id();
		$data=array(
		'promo_name'=>md5($this->input->post('promo_name')),
		'promo_applied_on_pack'=>$this->input->post('applied_on'),
		'discount'=>$this->input->post('disc'),
		'discount_on'=>$this->input->post('discount'),
		'disc_type'=>$this->input->post('type'),
		'enabled'=>'1'		
		);
		$this->db->insert('promocode',$data);
		return md5($this->input->post('promo_name'));
		
	}
	function fetchemail_plans()
	{
		$query=$this->db->get('email_pack');
		$result=$query->result_array();
		return $result;
	}
	function purchase_pack($user_id)
	{
		$data=array(		
		'user_id'=>$user_id,
		'applied_for_pack'=>$this->input->post('packid'),
		'enabled'=>'1',
		'total_emails'=>$this->input->post('emails'),
		'email_balance'=>$this->input->post('emails')
		);
		$this->db->insert('user_email_pack',$data);
		return 1;
	}
	function user_packs($user_id)
	{
		$this->db->select('*');
		$this->db->from('user_email_pack');
		$this->db->join('email_pack','email_pack.email_pack_id=user_email_pack.applied_for_pack','left');
		$this->db->where('user_id',$user_id);
		$query=$this->db->get();
		
		$result=$query->result_array();
		return $result;
	}
	
	
	
}