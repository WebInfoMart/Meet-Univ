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
	function manage_packs_model()
	{	
		$this->db->select('*');
		$this->db->from('email_pack');
		$query=$this->db->get();
		$result=$query->result_array();
		return $result;
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
		$time=date('y/h/m/s');
		$promo=md5($this->input->post('promo_name').$time);		
		$data=array(
		'promo_name'=>$promo,
		'promo_applied_on_pack'=>$this->input->post('applied_on'),
		'discount'=>$this->input->post('disc'),
		'discount_on'=>$this->input->post('discount'),
		'disc_type'=>$this->input->post('type'),
		'enabled'=>'1'		
		);
		$this->db->insert('promocode',$data);
		return $promo;
		
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
		$this->db->select('*');
		$this->db->from('user_email_pack');
		$this->db->where('user_id',$user_id);
		$exist1=$this->db->get();
		$exist=$exist1->result_array();
		if(!empty($exist))
		{
			$update=array(			
			'applied_for_pack'=>$this->input->post('packid'),			
			'total_emails'=>$exist[0]['total_emails']+$this->input->post('emails'),
			'email_balance'=>$exist[0]['email_balance']+$this->input->post('emails')
			);
			$this->db->update('user_email_pack',$update);
			$this->db->where('user_id',$user_id);
			$transaction=array(
		'trans_user_id'=>$user_id,
		'pack_id'=>$this->input->post('packid'),
		//'univ_id'=>$univ_id,
		'no_of_emails'=>$this->input->post('emails'),
		'trans_type'=>'purchase'
		);
		$this->db->insert('email_transactions',$transaction);
		}
		else
		{
		$this->db->insert('user_email_pack',$data);
		$transaction=array(
		'trans_user_id'=>$user_id,
		'pack_id'=>$this->input->post('packid'),
		//'univ_id'=>$univ_id,
		'no_of_emails'=>$this->input->post('emails'),
		'trans_type'=>'purchase'
		);
		$this->db->insert('email_transactions',$transaction);
		}		
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
	function new_promo($user_id)
	{
		$pcode=$this->input->post('promocode');
		$this->db->select('*');
		$this->db->from('promocode');
		$this->db->where('promo_name',$pcode);
		$query=$this->db->get();
		$result=$query->result_array();
		if(!empty($result))
		{
		$user_pack_id=$this->input->post('user_pack_id');
		$promo_used=array();
		if($this->input->post('promos_used')!='')
		{
		$promo_used=explode(',',$this->input->post('promos_used'));
		}
		//print_r($promo_used);exit;
		if($user_pack_id==$result[0]['promo_applied_on_pack'] && !in_array($result[0]['promocode_id'],$promo_used))
		{
			if($result[0]['discount_on']=='email')
			{	
				array_push($promo_used,$result[0]['promocode_id']);
				$promo=implode(',',$promo_used);
				if($result[0]['disc_type']=='num' && $result[0]['enabled']=='1')
				{
					$data=array(
					'total_emails'=>$this->input->post('total_emails')+$result[0]['discount'],
					'email_balance'=>$this->input->post('balance')+$result[0]['discount'],
					'user_promo_id'=>$promo
					);				
					$this->db->where('user_id',$user_id);
					$this->db->update('user_email_pack',$data);			
					$transaction=array(
					'trans_user_id'=>$user_id,
					//'univ_id'=>$univ_id,
					'no_of_emails'=>$result[0]['discount'],
					'pack_id'=>$result[0]['promocode_id'],
					'trans_type'=>'purchase'
					);
					$this->db->insert('email_transactions',$transaction);
					return $result[0]['discount'];
				}
				else if($result[0]['disc_type']=='per' && $result[0]['enabled']=='1')
				{$disc=($result[0]['discount']*$this->input->post('total_emails'))/100;
				 
					$data=array(
					'total_emails'=>$this->input->post('total_emails')+$disc,
					'email_balance'=>$this->input->post('balance')+$disc,
					'user_promo_id'=>$promo
					);
					$this->db->where('user_id',$user_id);
					$this->db->update('user_email_pack',$data);	
					$transaction=array(
					'trans_user_id'=>$user_id,
					//'univ_id'=>$univ_id,
					'no_of_emails'=>$disc,
					'pack_id'=>$result[0]['promocode_id'],
					'trans_type'=>'purchase'
					);
					$this->db->insert('email_transactions',$transaction);
					return $disc;
				}
				
			}
			// else if($result[0]['discount_on']=='price')
			// {
				// if($result[0]['discount_type']=='num' && $result[0]['enabled']=='1')
				// {
					
				// }
				// else if($result[0]['discount_type']=='per' && $result[0]['enabled']=='1')
				// {
					
				// }	
			// }
			
		}
		else
		{
			return 0;
		}
		}
		else
		{
			return 0;
		}
	}
	function manage_promo_model()
	{
		$this->db->select('*,promocode.enabled as en');
		$this->db->from('promocode');
		$this->db->join('email_pack','email_pack.email_pack_id=promocode.promocode_id','left');
		$result=$this->db->get();
		return $result->result_array();
	}
	function delete_promocode($id)
	{
		$this->db->where('promocode_id',$id);
		$this->db->delete('promocode');
		return 1;
	}
	function update_promocode($id,$status)
	{
		if($status==1)
		{
			$stat='0';
		}
		else
		{
			$stat='1';
		}
		$update=array(
		'enabled'=>$stat
		);
		$this->db->where('promocode_id',$id);
		$this->db->update('promocode',$update);
		return 1;
	}
	function delete_email_pack($id)
	{
		$this->db->where('email_pack_id',$id);
		$this->db->delete('email_pack');
		return 1;
	}
	function email_pack_update($id)
	{
		$this->db->where('email_pack_id',$id);
		$query=$this->db->get('email_pack');
		$result=$query->result_array();
		return $result;
	}
	function email_pack_edit($id)
	{
		$edit=array(
			'email_pack_name'=>$this->input->post('pack_name'),
			'email_pack_cost'=>$this->input->post('pack_cost'),
			'pack_contains_email'=>$this->input->post('emails'),
			'enabled'=>$this->input->post('enable')
		);		
		$this->db->where('email_pack_id',$id);
		$this->db->update('email_pack',$edit);		
		return 1;
	}
	
}