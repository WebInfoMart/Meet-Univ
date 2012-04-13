<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Frontmodel extends CI_Model
{
	
	function __construct()
	{
		$this->load->library('pagination');
		$this->load->database();
	}
	
	function fetch_featured_events()
	{
		$this->db->select('*');
		$this->db->from('events');
		$this->db->join('university', 'events.event_univ_id=university.univ_id');
		$this->db->where(array('featured_home_event' =>'1'));
		$this->db->limit(5);
		$query = $this->db->get();
		return $query->result_array();
	}
	
	//function for getting university information
	function fetch_featured_college()
	{
		$query = $this->db->get_where('university',array('featured_college'=>'1'));
		return $query->result_array();
	}
	function fetch_featured_article_home()
	{
		$this->db->select('*');
		$this->db->from('article');
		$this->db->where(array('featured_home_article'=>'1','article_type_ud'=>'univ_article'));
		$this->db->limit(1);
		$query = $this->db->get();
		return $query->result_array();
	}
	
	function fetch_events($page)
	{
		$this->db->select('*');
		$this->db->from('events');
		$this->db->join('university', 'events.event_univ_id = university.univ_id'); 
		$this->db->join('country', 'country.country_id = events.event_country_id','left'); 
		$this->db->join('state', 'state.state_id = events.event_state_id','left'); 
		$this->db->join('city', 'city.city_id = events.event_city_id','left'); 
		$this->db->where('event_type','univ_event');
		$query = $this->db->get();
		$numrows=$query->num_rows();
		$config['base_url']=base_url()."auth/events";
		$config['total_rows']=$numrows;
		$config['per_page'] = '5'; 
		$offset = $page;//this will work like site/folder/controller/function/query_string_for_cat/query_string_offset
        $limit = $config['per_page'];
		$this->db->select('*');
		$this->db->from('events');
		$this->db->join('university', 'events.event_univ_id = university.univ_id'); 
		$this->db->join('country', 'country.country_id = events.event_country_id','left'); 
		$this->db->join('state', 'state.state_id = events.event_state_id','left'); 
		$this->db->join('city', 'city.city_id = events.event_city_id','left'); 
		$this->db->where('event_type','univ_event');
		$this->db->order_by("event_created_time", "desc"); 
		$this->db->limit($limit,$offset);
		$query = $this->db->get();
		$this->pagination->initialize($config);
		return $query->result_array();
	}
	
	function get_event_detail_by_univ($univ_id,$event_id)
	{
		$this->db->select('*');
		$this->db->from('events');
		$this->db->join('university', 'events.event_univ_id = university.univ_id'); 
		$this->db->join('country', 'country.country_id = events.event_country_id','left'); 
		$this->db->join('state', 'state.state_id = events.event_state_id','left'); 
		$this->db->join('city', 'city.city_id = events.event_city_id','left'); 
		
		$this->db->where(array('event_id'=>$event_id,'event_univ_id'=>$univ_id));
		$query=$this->db->get();
		if($query->num_rows()>0)
		{
		  return $query->row_array();
		}
		else
		{
		return 0;
		}
	}
	
	function get_events_list_by_univ($univ_id='')
	{
		/*$this->db->select('*');
		$this->db->from('events');
		$this->db->join('university', 'events.event_univ_id = university.univ_id'); 
		$this->db->join('country', 'country.country_id = events.event_country_id','left'); 
		$this->db->join('state', 'state.state_id = events.event_state_id','left'); 
		$this->db->join('city', 'city.city_id = events.event_city_id','left'); 
		$this->db->where(array('event_univ_id'=>$univ_id,'event_type'=>'univ_event'));
		$query = $this->db->get();
		$numrows=$query->num_rows();
		$config['base_url']=base_url()."univ/university_events_list";
		$config['total_rows']=$numrows;
		$config['per_page'] = '2'; 
		$offset = $this->uri->segment(3); //this will work like site/folder/controller/function/query_string_for_cat/query_string_offset
        $limit = $config['per_page'];*/
		$this->db->select('*');
		$this->db->from('events');
		$this->db->join('university', 'events.event_univ_id = university.univ_id'); 
		$this->db->join('country', 'country.country_id = events.event_country_id','left'); 
		$this->db->join('state', 'state.state_id = events.event_state_id','left'); 
		$this->db->join('city', 'city.city_id = events.event_city_id','left'); 
		$this->db->where(array('event_univ_id'=>$univ_id,'event_type'=>'univ_event'));
		//$this->db->limit($limit,$offset);
		$query = $this->db->get();
		//$this->pagination->initialize($config);
		if($query->num_rows()>0)
		{
		  return $query->result_array();
		}
		else
		{
		return 0;
		}

	}
	function get_news_list_by_univ($univ_id='')
	{
		/*$this->db->select('*');
		$this->db->from('events');
		$this->db->join('university', 'events.event_univ_id = university.univ_id'); 
		$this->db->join('country', 'country.country_id = events.event_country_id','left'); 
		$this->db->join('state', 'state.state_id = events.event_state_id','left'); 
		$this->db->join('city', 'city.city_id = events.event_city_id','left'); 
		$this->db->where(array('event_univ_id'=>$univ_id,'event_type'=>'univ_event'));
		$query = $this->db->get();
		$numrows=$query->num_rows();
		$config['base_url']=base_url()."univ/university_events_list";
		$config['total_rows']=$numrows;
		$config['per_page'] = '2'; 
		$offset = $this->uri->segment(3); //this will work like site/folder/controller/function/query_string_for_cat/query_string_offset
        $limit = $config['per_page'];*/
		$this->db->select('*');
		$this->db->from('news');
		$this->db->join('university', 'news.news_univ_id = university.univ_id'); 
		$this->db->where(array('news_univ_id'=>$univ_id,'news_type_ud'=>'univ_news'));
		//$this->db->limit($limit,$offset);
		$query = $this->db->get();
		//$this->pagination->initialize($config);
		if($query->num_rows()>0)
		{
		  return $query->result_array();
		}
		else
		{
		return 0;
		}

	}
	function fetch_news($page)
	{
		$this->db->select('*');
		$this->db->from('news');
		$this->db->join('university', 'news.news_univ_id = university.univ_id'); 
		$this->db->where('news_type_ud','univ_news');
		$query = $this->db->get();
		$numrows=$query->num_rows();
		$config['base_url']=base_url()."auth/news";
		$config['total_rows']=$numrows;
		$config['per_page'] = '5'; 
		$offset = $page;//this will work like site/folder/controller/function/query_string_for_cat/query_string_offset
        $limit = $config['per_page'];
		$this->db->select('*');
		$this->db->from('news');
		$this->db->join('university', 'news.news_univ_id = university.univ_id'); 
		$this->db->where('news_type_ud','univ_news');
		$this->db->order_by("publish_time", "desc"); 
		$this->db->limit($limit,$offset);
		$query = $this->db->get();
		$this->pagination->initialize($config);
		return $query->result_array();
		
	}
	
	function get_news_detail_by_univ($univ_id,$news_id)
	{
		$this->db->select('*');
		$this->db->from('news');
		$this->db->join('university', 'news.news_univ_id = university.univ_id'); 
		$this->db->where(array('news_id'=>$news_id,'news_univ_id'=>$univ_id,'news_type_ud'=>'univ_news'));
		$query=$this->db->get();
		if($query->num_rows()>0)
		{
		  return $query->row_array();
		}
		else
		{
		return 0;
		}
	}

}