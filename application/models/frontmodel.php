<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Frontmodel extends CI_Model
{
	
	function __construct()
	{
		$this->load->library('pagination');
		$this->load->database();
		date_default_timezone_set('Asia/Kolkata');
	}
	function fetch_events_for_calendar()
	{
		//$sql = "select * from events where STR_TO_DATE(event_date_time, '%d %M %Y')>=".date('Y-m-d');
		
		//event of greater than now
		$sql = "SELECT *,STR_TO_DATE( `events`.`event_date_time`,  '%d %M %Y' )  as dt FROM events where STR_TO_DATE(event_date_time, '%d %M %Y')>='".date('Y-m-d')."' and  ban_event!='1' order by dt asc";
		
		//all event
		//$sql = "SELECT *,STR_TO_DATE( `events`.`event_date_time`,  '%d %M %Y' )  as dt FROM events order by dt asc";
		
		$results=$this->db->query($sql);
		if($results->num_rows()>0)
		{
		return $results->result_array();
		}
		else {
		return 0;
		}
		/*$this->db->select('*');
		$this->db->from('events');
		$sql = $this->db->where("STR_TO_DATE(event_date_time, '%d %M %Y')>='".date('Y-m-d')."'");
		$query = $this->db->get();
		if($query->num_rows() > 0)
		{
		return $query->result_array();
		}
		else {
		return 0;
		}*/
		//print_r($x);
	}
	function fetch_featured_events()
	{
		/*$this->db->select('*');
		$this->db->from('events');
		$this->db->join('university', 'events.event_univ_id=university.univ_id');
		$this->db->join('city','events.event_city_id=city.city_id','left');
		$this->db->join('state','events.event_state_id=state.state_id','left');
		$this->db->join('country','events.event_country_id=country.country_id','left');
		$this->db->where(array('featured_home_event' =>'1','STR_TO_DATE(event_date_time, "%d %M %Y")>='=>date("Y-m-d")));
		$this->db->limit(3);*/
		//$date=date('Y-m-d')
		
		//event of greater than now
		
		//$where='and events.featured_home_event="1" and STR_TO_DATE(event_date_time, "%d %M %Y")>="'.date('Y-m-d').'"';
		
		$where='and events.featured_home_event="1"';
		
		$join=" JOIN  `university` ON events.event_univ_id = university.univ_id LEFT JOIN country ON country.country_id = events.event_country_id LEFT JOIN  state ON state.state_id = events.event_state_id LEFT JOIN city ON city.city_id = events.event_city_id";
		$sql = "SELECT *,STR_TO_DATE( `events`.`event_date_time`,  '%d %M %Y' )  as dt FROM events".$join."  where 1 ".$where." order by dt asc LIMIT 3";
		$query=$this->db->query($sql);
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
	  $num=0;
	  $this->db->select('event_univ_id');
	  $this->db->from('events');
	  $this->db->where('event_id',$event_id);
	  $res=$this->db->get();
	  $res1=$res->row_array();
	  $univ_id=$res1['event_univ_id'];
	  $num=$univ_id%3;
	  if(!$num)
	  {
	  $num=$univ_id%4;
	  if(!$num)
	  {
	  $num=$univ_id%5;
	  if(!$num)
	  {
	  $num=3;
	  }
	  }
	  }
	  $this->db->select('*');
	  $this->db->from('event_register');
	  $this->db->where('register_event_id',$event_id);
	  $c=$this->db->count_all_results()+$num;
	  //$c=$this->db->count_all_results();
	  return $c;
	  /*$this->db->select('no_of_register_user');
	  $this->db->from('events');
	  $this->db->where('event_id',$event_id);
	  $query=$this->db->get();
	  $res=$query->row_array();
	  if($res['no_of_register_user']<=0 || $res['no_of_register_user']=='')
	  return 0;
	  else
	  return $res['no_of_register_user'];*/
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
		$data = $this->path->all_path();
		$subdomain_name = $this->subdomain->find_subdomain_name_and_id();
		$subdomain_name_for_paging = $subdomain_name['domain'];
		$this->db->select('*');
		$this->db->from('events');
		$this->db->join('university', 'events.event_univ_id = university.univ_id'); 
		$this->db->join('country', 'country.country_id = events.event_country_id','left'); 
		$this->db->join('state', 'state.state_id = events.event_state_id','left'); 
		$this->db->join('city', 'city.city_id = events.event_city_id','left'); 
		$this->db->where(array('event_univ_id'=>$univ_id,'event_type'=>'univ_event','STR_TO_DATE(event_date_time, "%d %M %Y")>='=>date("Y-m-d")));
		$query = $this->db->get();
		$numrows=$query->num_rows();
		$config['base_url']='http://'.$subdomain_name_for_paging.$data['domain_name']."/event-list/university_events";
		$config['total_rows']=$numrows;
		$config['per_page'] = '6'; 
		$offset = $this->uri->segment(3); //this will work like site/folder/controller/function/query_string_for_cat/query_string_offset
        $limit = $config['per_page'];
		$this->db->select('*');
		$this->db->from('events');
		$this->db->join('university', 'events.event_univ_id = university.univ_id'); 
		$this->db->join('country', 'country.country_id = events.event_country_id','left'); 
		$this->db->join('state', 'state.state_id = events.event_state_id','left'); 
		$this->db->join('city', 'city.city_id = events.event_city_id','left'); 
		$this->db->where(array('event_univ_id'=>$univ_id,'event_type'=>'univ_event','STR_TO_DATE(event_date_time, "%d %M %Y")>='=>date("Y-m-d")));
		$this->db->limit($limit,$offset);
		$query = $this->db->get();
		$this->pagination->initialize($config);
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
		$data = $this->path->all_path();
		$subdomain_name = $this->subdomain->find_subdomain_name_and_id();
		$subdomain_name_for_paging = $subdomain_name['domain'];
		$this->db->select('*');
		$this->db->from('news');
		$this->db->join('university', 'news.news_univ_id = university.univ_id'); 
		$this->db->where(array('news_univ_id'=>$univ_id,'news_type_ud'=>'univ_news'));
		$query = $this->db->get();
		$numrows=$query->num_rows();
		$config['base_url']='http://'.$subdomain_name_for_paging.$data['domain_name']."/news-list/university_news_list";
		//$config['base_url']=base_url()."news-list/university_news_list";
		$config['total_rows']=$numrows;
		$config['per_page'] = '6'; 
		$offset = $this->uri->segment(3); //this will work like site/folder/controller/function/query_string_for_cat/query_string_offset
        $limit = $config['per_page'];
		$this->db->select('*');
		$this->db->from('news');
		$this->db->join('university', 'news.news_univ_id = university.univ_id'); 
		$this->db->where(array('news_univ_id'=>$univ_id,'news_type_ud'=>'univ_news'));
		$this->db->limit($limit,$offset);
		$query = $this->db->get();
		$this->pagination->initialize($config);
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
		$config['per_page'] = '6'; 
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
		$config['base_url']= base_url()."Recent_Articles/articles";
		$config['total_rows']=$numrows;
		$config['per_page'] = '6'; 
		$offset = $this->uri->segment('3');//this will work like site/folder/controller/function/query_string_for_cat/query_string_offset
		$limit = $config['per_page'];
		$this->db->select('*');
		$this->db->from('article');
		$this->db->join('university', 'article.article_univ_id = university.univ_id'); 
		$this->db->where(array('article_type_ud'=>'univ_article','article_approve_status'=>'1'));
		$this->db->limit($limit,$offset);
		$this->db->order_by("publish_time", "desc"); 
		$query = $this->db->get();
		$a = $this->pagination->initialize($config);
		$x = $query->result_array();
	    //print_r($a);
		if($query->num_rows()>0)
		{
		 return $query->result_array();
		 }
		 else
		 {
		 return 0;
		 }
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
		$data = $this->path->all_path();
		$subdomain_name = $this->subdomain->find_subdomain_name_and_id();
		$subdomain_name_for_paging = $subdomain_name['domain'];
		$this->db->select('*');
		$this->db->from('article');
		$this->db->join('university', 'article.article_univ_id = university.univ_id'); 
		$this->db->where(array('article_univ_id'=>$univ_id,'article_type_ud'=>'univ_article','article_approve_status'=>'1'));
		$query = $this->db->get();
		$numrows=$query->num_rows();
		$config['base_url']='http://'.$subdomain_name_for_paging.$data['domain_name']."/article-list/university_articles_list";
		//$config['base_url']=base_url()."article-list/university_articles_list";
		$config['total_rows']=$numrows;
		$config['per_page'] = '6'; 
		$offset = $this->uri->segment(3); //this will work like site/folder/controller/function/query_string_for_cat/query_string_offset
        $limit = $config['per_page'];
		$this->db->select('*');
		$this->db->from('article');
		$this->db->join('university', 'article.article_univ_id = university.univ_id'); 
		$this->db->where(array('article_univ_id'=>$univ_id,'article_type_ud'=>'univ_article','article_approve_status'=>'1'));
		$this->db->limit($limit,$offset);
		$query = $this->db->get();
		$this->pagination->initialize($config);
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
		$this->db->limit(12);
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
	'comment_time'=>date('Y-m-d H:i:s',time())
	);
	$this->db->insert('comment_table',$data);
	}
	
	function fetch_all_comments($commented_on,$commented_on_id)
	{
		$limit=4;
		$data['show_more']=0;
		if($this->input->post('offset'))
		{
		$offset=$this->input->post('offset');
		$offset=$limit*$offset;
		$moreresult=$offset+$limit;
		}
		else
		{
		$offset=0;
		$moreresult=0;
		}
		$this->db->select('*');
		$this->db->from('comment_table');
		$this->db->join('users', 'users.id = comment_table.commented_by','left');
		$this->db->join('user_profiles','user_profiles.user_id = users.id','left');	
		$this->db->where(array('comment_on_id'=>$commented_on_id,'commented_on'=>$commented_on));
		$query=$this->db->get();
		$data['total_comment']=$query->num_rows();
		if($data['total_comment'] > 0)
		{
		$this->db->select('*');
		$this->db->from('comment_table');
		$this->db->join('users', 'users.id = comment_table.commented_by','left');
		$this->db->join('user_profiles','user_profiles.user_id = users.id','left');	
		$this->db->where(array('comment_on_id'=>$commented_on_id,'commented_on'=>$commented_on));
		$this->db->order_by('comment_table.comment_time','desc');
		$this->db->limit($limit,$offset);
		$query=$this->db->get();
		$data['comments']=$query->result_array();
		if($moreresult<$data['total_comment'])
		{
		$data['show_more']=1;
		}
		return $data;
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
		'comment_time'=>date('Y-m-d H:i:s',time())
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
		
		//by sumit 
		// event of greater than now
		//$this->db->where(array('STR_TO_DATE(event_date_time, "%d %M %Y")>='=>date("Y-m-d")));
		
		$this->db->order_by('event_date_time','desc');
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
	  
	  //event of upcoming date
	  // $this->db->where(array('event_type'=>'univ_event',
	  // 'STR_TO_DATE(event_date_time, "%d %M %Y")>='=>date("Y-m-d")
	  // ));
	  
	  $this->db->where(array('event_type'=>'univ_event'
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
		//event of ujpcoming date
		//$this->db->where(array('featured_home_event' =>'1','STR_TO_DATE(event_date_time, "%d %M %Y")>='=>date("Y-m-d")));
		
		$this->db->where(array('featured_home_event' =>'1'));
		
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
		$this->db->select('register_user_counter');
		$this->db->from('total_event_register_counter');
		$this->db->where('id','1');
		$tot = $this->db->get();
		$tot2 = $tot;
		$res=$tot2->row_array();
		$val=$res['register_user_counter'];
		$val=$val+0.01;
		$data = array(
               'register_user_counter' => $val
            );
		$this->db->where('id',1);
		$this->db->update('total_event_register_counter', $data); 
		return $tot2->result_array();
		//$this->db->set('register_user_counter','register_user_counter+0.1',FALSE);
		//$this->db->where('id','1');
		//$this->db->update('total_event_register_counter');
		
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
	
	function popular_articles()
	{
		$this->db->select('*');
		$this->db->from('article');
		$this->db->join('university', 'article.article_univ_id=university.univ_id');
		$this->db->order_by('article_id', 'RANDOM');
		$this->db->limit(6);
		$pa = $this->db->get();
		return $pa->result_array();
	}
	function popular_news()
	{
		$this->db->select('*');
		$this->db->from('news');
		$this->db->join('university', 'news.news_univ_id=university.univ_id');
		$this->db->order_by('news_id', 'RANDOM');
		$this->db->limit(6);
		$pa = $this->db->get();
		return $pa->result_array();
	}
	
	function contact_form_submit($contact_submit_condition)
	{
		$this->db->insert('contact_us',$contact_submit_condition);
		return $this->db->affected_rows() ? 1 : 0;
	}
	
	function submit_canvas_data()
	{
		$ret = 0;
		$canvas_insert_clause = array(
		'fullname'=>$this->input->post('name'),
		'email'=>$this->input->post('email'),
		'user_type'=> "fb_canvas"
		);
		$this->db->select('*');
		$this->db->from('users');
		$this->db->where('email',$this->input->post('email'));
		$query = $this->db->get();
		//'canvas_phone'=>$this->input->post('phone')
		if($query->num_rows() < 1)
		{
		if($this->db->insert('users',$canvas_insert_clause))
		{
			$user_id = $this->db->insert_id();
			
			$canvas_user_profile_clause = array(
			'user_id'=>$user_id,
			'mob_no'=>$this->input->post('phone'),
			'full_name'=>$this->input->post('name'),
			'email_as_lead'=>$this->input->post('email')
			);
			
			$this->db->insert('user_profiles',$canvas_user_profile_clause);
		}
		if($this->db->affected_rows() > 0)
		{
			$ret = 1;
		}
		}
		else{
			$ret = 0;
		}
		return $ret;
	}
	
}