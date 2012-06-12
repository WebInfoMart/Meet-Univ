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
		$this->db->join('city','events.event_city_id=city.city_id');
		$this->db->join('state','events.event_state_id=state.state_id');
		$this->db->join('country','events.event_country_id=country.country_id');
		$this->db->where(array('featured_home_event' =>'1','STR_TO_DATE(event_date_time, "%d %M %Y")>='=>date("Y-m-d")));
		$this->db->limit(3);
		$query = $this->db->get();
		//$x = $query->result_array();
		//echo $x['event_id'];
		if($query->num_rows>0)
		{
		return $query->result_array();
		}
		else
		{
		return 0;
		}
	}
	function count_event_register($event_id)
	{
		$this->db->select('*');
		$this->db->from('event_register');
		$this->db->where('register_event_id',$event_id);
		return $this->db->count_all_results();
	}
	
	function fetch_featured_news()
	{
		$this->db->select('*');
		$this->db->from('news');
		$this->db->join('university', 'news.news_univ_id=university.univ_id');
		$this->db->where(array('featured_home_news' =>'1','news_type_ud'=>'univ_news'));
		$this->db->limit(2);
		$query = $this->db->get();
		if($query->num_rows>0)
		{
		return $query->result_array();
		}
		else
		{
		return 0;
		}
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
		$this->db->join('university', 'article.article_univ_id = university.univ_id'); 
		$this->db->where(array('featured_home_article'=>'1','article_type_ud'=>'univ_article','article_approve_status'=>'1'));
		$this->db->limit(2);
		$query = $this->db->get();
		return $query->result_array();
	}
	function fetch_featured_news_home()
	{
		$this->db->select('*');
		$this->db->from('news');
		$this->db->join('university', 'news.news_univ_id = university.univ_id'); 
		$this->db->where(array('featured_home_news'=>'1','news_type_ud'=>'univ_news'));
		$this->db->limit(4);
		$query = $this->db->get();
		return $query->result_array();
	}
	
	function fetch_events($cat,$page)
	{
		$this->db->select('*');
		$this->db->from('events');
		$this->db->join('university', 'events.event_univ_id = university.univ_id'); 
		$this->db->join('country', 'country.country_id = events.event_country_id','left'); 
		$this->db->join('state', 'state.state_id = events.event_state_id','left'); 
		$this->db->join('city', 'city.city_id = events.event_city_id','left'); 
		if($cat=='spot_admission' || $cat=='fairs')
		{
		//$event_arr['event_category']=$cat;
		$this->db->where(array('event_category'=>$cat,'event_type'=>'univ_event',
		'STR_TO_DATE(event_date_time, "%d %M %Y")>='=>date("Y-m-d")
		));
		}
		else if($cat=='others_alumuni')
		{
		//$event_arr['event_category']='others';
		$this->db->where(array('event_type'=>'univ_event',
		'STR_TO_DATE(event_date_time, "%d %M %Y")>='=>date("Y-m-d")));
		$category=array('spot_admission','fairs');
		$this->db->where_not_in('event_category',$category);
			
		//$this->db->or_where(array('event_category'=>'others','STR_TO_DATE(event_date_time, "%d %M %Y")>='=>date("Y-m-d")));
		}
		else
		{
		$this->db->where(array('event_type'=>'univ_event',
		'STR_TO_DATE(event_date_time, "%d %M %Y")>='=>date("Y-m-d")
		));
		}
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
		if($cat=='spot_admission' || $cat=='fairs')
		{
		$this->db->where(array('event_category'=>$cat,'event_type'=>'univ_event',
		'STR_TO_DATE(event_date_time, "%d %M %Y")>='=>date("Y-m-d")
		));
		}
		else if($cat=='others_alumuni')
		{
			$this->db->where(array('event_type'=>'univ_event',
			'STR_TO_DATE(event_date_time, "%d %M %Y")>='=>date("Y-m-d")
			));
			$category=array('spot_admission','fairs');
			$this->db->where_not_in('event_category',$category);
			//$this->db->or_where(array('event_category'=>'others','STR_TO_DATE(event_date_time, "%d %M %Y")>='=>date("Y-m-d")));
		}
		else
		{
		$this->db->where(array('event_type'=>'univ_event',
		'STR_TO_DATE(event_date_time, "%d %M %Y")>='=>date("Y-m-d")
		));
		}
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
	function fetch_news($page='')
	{
		$this->db->select('*');
		$this->db->from('news');
		$this->db->join('university', 'news.news_univ_id = university.univ_id'); 
		$this->db->where('news_type_ud','univ_news');
		$query = $this->db->get();
		$numrows=$query->num_rows();
		$config['base_url']=base_url()."Recent_News/news/";
		$config['total_rows']=$numrows;
		$config['per_page'] = 7; 
		$offset = $this->uri->segment('3');//this will work like site/folder/controller/function/query_string_for_cat/query_string_offset
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
	
	function fetch_articles($page='')
	{
		$this->db->select('*');
		$this->db->from('article');
		$this->db->join('university', 'article.article_univ_id = university.univ_id'); 
		$this->db->where(array('article_type_ud'=>'univ_article','article_approve_status'=>'1'));
		$query = $this->db->get();
		$numrows=$query->num_rows();
		$config['base_url']=base_url()."Recent_Articles/articles";
		$config['total_rows']=$numrows;
		$config['per_page'] = '7'; 
		$offset = $this->uri->segment('3');//this will work like site/folder/controller/function/query_string_for_cat/query_string_offset
        $limit = $config['per_page'];
		$this->db->select('*');
		$this->db->from('article');
		$this->db->join('university', 'article.article_univ_id = university.univ_id'); 
		$this->db->where(array('article_type_ud'=>'univ_article','article_approve_status'=>'1'));
		$this->db->limit($limit,$offset);
		$this->db->order_by("publish_time", "desc"); 
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
	function get_article_detail_by_univ($univ_id,$article_id)
	{
		$this->db->select('*');
		$this->db->from('article');
		$this->db->join('university', 'article.article_univ_id = university.univ_id'); 
		$this->db->where(array('article_id'=>$article_id,'article_univ_id'=>$univ_id,'article_type_ud'=>'univ_article','article_approve_status'=>'1'));
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
	function get_articles_list_by_univ($univ_id)
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
		$this->db->from('article');
		$this->db->join('university', 'article.article_univ_id = university.univ_id'); 
		$this->db->where(array('article_univ_id'=>$univ_id,'article_type_ud'=>'univ_article','article_approve_status'=>'1'));
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
	function newly_registered_users()
	{
		$this->db->select('*');
		$this->db->from('users');
		$this->db->join('user_profiles', 'user_profiles.user_id = users.id'); 
		$this->db->where('level','1');
		$this->db->order_by("id", "desc");
		$this->db->limit(9);
		$query=$this->db->get();
		return $query->result_array();
	}
	//function for finding the cities list for event search
	function fetch_cities()
	{
		$this->db->select('*');
		$this->db->from('city');
		$this->db->order_by('cityname','asc');
		$query=$this->db->get();
		return $query->result_array();
	}
	
	function insert_user_comment()
	{
	$data=array(
	'commented_by_user_name'=>$this->input->post('full_name'),
	'commented_by_user_email'=>$this->input->post('email'),
	'commented_on'=>$this->input->post('commented_on'),
	'comment_on_id'=>$this->input->post('commented_on_id'),
	'commented_text'=>$this->input->post('commented_text'),
	);
	$this->db->insert('comment_table',$data);
	}
	
	function fetch_all_comments($commented_on,$commented_on_id)
	{
		$this->db->select('*');
		$this->db->from('comment_table');
		$this->db->join('users', 'users.id = comment_table.commented_by','left');
		$this->db->join('user_profiles','user_profiles.user_id = users.id','left');	
		$this->db->where(array('comment_on_id'=>$commented_on_id,'commented_on'=>$commented_on));
		$query=$this->db->get();
		if($query->num_rows() > 0)
		{
		return $query->result_array();
		}
		else {
		return 0;
		}
	}
	
	function post_comment_by_logged_in_user($logged_in_user_id,$commented_on,$commented_on_id,$commented_text)
	{
		$data=array(
		'commented_by'=>$logged_in_user_id,
		'commented_on'=>$commented_on,
		'comment_on_id'=>$commented_on_id,
		'commented_text'=>$commented_text,
		);
	$this->db->insert('comment_table',$data);
		return $this->db->insert_id();
	}
	
	function delete_comment()
	{
	$this->db->delete('comment_table', array('comment_id' =>$this->input->post('comment_id')));
	}	
	
	function recent_articles()
	{
		$this->db->select('*');
		$this->db->from('article');
		$this->db->join('university', 'article.article_univ_id = university.univ_id'); 
		$this->db->where(array('article_type_ud'=>'univ_article','article_approve_status'=>1));
		$this->db->order_by("publish_time", "desc"); 
		$this->db->limit(3);
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
	function recent_news()
	{
		$this->db->select('*');
		$this->db->from('news');
		$this->db->join('university', 'news.news_univ_id = university.univ_id'); 
		$this->db->where(array('news_type_ud'=>'univ_news'));
		$this->db->order_by("publish_time", "desc"); 
		$this->db->limit(3);
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
	function fetch_recent_events()
	{
		$this->db->select('*');
		$this->db->from('events');
		$this->db->join('university', 'events.event_univ_id=university.univ_id');
		$this->db->where(array('STR_TO_DATE(event_date_time, "%d %M %Y")>='=>date("Y-m-d")));
		$this->db->limit(5);
		$query = $this->db->get();
		if($query->num_rows>0)
		{
		return $query->result_array();
		}
		else
		{
		return 0;
		}
	}
	
	function get_id_of_univ_by_subdomain($sub_domain)
	{
		$this->db->select('univ_id');
		$this->db->from('university');
		$this->db->where('subdomain_name',$sub_domain);
		$query = $this->db->get();
		return $query->row_array();
	}
	
	 function fetch_home_featured_quest()
	 {
	  $condition = array(
	  'q_featured_home_que'=>'1'
	  );
	  $limit = 5;
	  $this->db->select('*');
	  $this->db->from('questions');
	  $this->db->where($condition);
	  $this->db->join('users','questions.q_askedby = users.id');
	  $this->db->join('user_profiles','questions.q_askedby = user_profiles.user_id');
	  $this->db->order_by("q_askedby","desc");
	  $this->db->limit($limit);
	  $query = $this->db->get();
	  //$query = $this->db->get_where('questions',$condition,$limit);
	  if($query->num_rows() > 0)
	  {
	   return $query->result_array();
	  }
	  else {
	  return 0;
	  }
	 }
	 
	function fetch_search_country_having_univ()
	{
		$this->db->select('*');
		$this->db->from('country');
		$this->db->join('university','university.country_id = country.country_id');
		$this->db->group_by("country.country_id");
		$query=$this->db->get();
		if($query->num_rows()>0)
		{
		return $query->result_array();
		}
		else
		{
		return 0;
		}
	}	
	
	function fetch_area_interest_having_univ()
	{
		$this->db->select('*');
		$this->db->from('program_parent');
		$this->db->join('univ_program','univ_program.prog_parent_id = program_parent.prog_parent_id');
		$this->db->group_by("program_parent.prog_parent_id");
		$query=$this->db->get();
		if($query->num_rows()>0)
		{
		return $query->result_array();
		}
		else
		{
		return 0;
		}
	}
	
	function fetch_cities_having_univ()
	{
		$this->db->select('*');
		$this->db->from('city');
		$this->db->join('events','events.event_city_id = city.city_id');
		$this->db->group_by("city.city_id");
		$query=$this->db->get();
		if($query->num_rows()>0)
		{
		return $query->result_array();
		}
		else
		{
		return 0;
		}
	}
	
	function fetch_country_having_univ_footer()
	{
		$this->db->select('*');
		$this->db->from('country');
		$this->db->join('university','university.country_id = country.country_id');
		$this->db->group_by("country.country_id");
		$this->db->limit(5);
		$query=$this->db->get();
		if($query->num_rows()>0)
		{
		return $query->result_array();
		}
		else
		{
		return 0;
		}
	}
	
	function fetch_area_interest_having_univ_footer()
	{
		$this->db->select('*');
		$this->db->from('program_parent');
		$this->db->join('univ_program','univ_program.prog_parent_id = program_parent.prog_parent_id');
		$this->db->group_by("program_parent.prog_parent_id");
		$this->db->limit(5);
		$query=$this->db->get();
		if($query->num_rows()>0)
		{
		return $query->result_array();
		}
		else
		{
		return 0;
		}
	}
	
	function get_event_for_sms($event_id)
	{
		$this->db->select('*');
		$this->db->from('events');
		$this->db->join('university', 'events.event_univ_id = university.univ_id'); 
		$this->db->join('country', 'country.country_id = events.event_country_id','left'); 
		$this->db->join('state', 'state.state_id = events.event_state_id','left'); 
		$this->db->join('city', 'city.city_id = events.event_city_id','left'); 
		$this->db->where('event_id',$event_id);
		$query = $this->db->get();
		if($query->num_rows() > 0)
		{
			return $query->result_array();
		}
		else{
		return 0;
		}
	}
	function fetch_cities_having_events()
	 {
	  $this->db->select('*');
	  $this->db->from('city');
	  $this->db->join('events', 'events.event_city_id = city.city_id'); 
	  $this->db->where(array('event_type'=>'univ_event',
	  'STR_TO_DATE(event_date_time, "%d %M %Y")>='=>date("Y-m-d")
	  ));
	  $this->db->group_by('events.event_city_id');
	  $this->db->order_by('cityname','asc');
	  $query=$this->db->get();
	  return $query->result_array();
	 }
	function fetch_featured_events_of_univ($univ_id)
	{
		$this->db->select('*');
		$this->db->from('events');
		$this->db->join('university', 'events.event_univ_id=university.univ_id');
		$this->db->join('city','events.event_city_id=city.city_id');
		$this->db->join('state','events.event_state_id=state.state_id');
		$this->db->join('country','events.event_country_id=country.country_id');
		$this->db->where(array('featured_home_event' =>'1','STR_TO_DATE(event_date_time, "%d %M %Y")>='=>date("Y-m-d")));
		$this->db->where('event_univ_id',$univ_id);
		$this->db->limit(5);
		$query = $this->db->get();
		//$x = $query->result_array();
		//echo $x['event_id'];
		if($query->num_rows>0)
		{
		return $query->result_array();
		}
		else
		{
		return 0;
		}
	}
	function count_total_posted_event()
	{
		$this->db->select('event_id');
		$this->db->from('events');
		$query = $this->db->get();
		$tot_rows = $query->num_rows();
		$total_rows = ceil($tot_rows * 2.4);
		return $total_rows;
	}
	
	function count_register_user_by_ajax()
	{
		$this->db->set('register_user_counter','register_user_counter+3',FALSE);
		$this->db->where('id','1');
		$this->db->update('total_event_register_counter');
		$this->db->select('*');
		$this->db->from('total_event_register_counter');
		$this->db->where('id','1');
		$tot = $this->db->get();
		$tot2 = $tot;
		return $tot2->result_array();
		//return $total = floor($tot);
	}
	/*Anusha*/
	function count_register_user()
	{
		$this->db->select('*');
		$this->db->from('total_event_register_counter');
		$this->db->where('id','1');
		$tot = $this->db->get();
		return $tot->result_array();
		//return $total = floor($tot);
	}
	
}