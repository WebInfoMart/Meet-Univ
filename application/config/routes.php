<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/*
| -------------------------------------------------------------------------
| URI ROUTING
| -------------------------------------------------------------------------
| This file lets you re-map URI requests to specific controller functions.
|
| Typically there is a one-to-one relationship between a URL string
| and its corresponding controller class/method. The segments in a
| URL normally follow this pattern:
|
|	example.com/class/method/id/
|
| In some instances, however, you may want to remap this relationship
| so that a different class/function is called than the one
| corresponding to the URL.
|
| Please see the user guide for complete details:
|
|	http://codeigniter.com/user_guide/general/routing.html
|
| -------------------------------------------------------------------------
| RESERVED ROUTES
| -------------------------------------------------------------------------
|
| There area two reserved routes:
|
|	$route['default_controller'] = 'welcome';
|
| This route indicates which controller class should be loaded if the
| URI contains no data. In the above example, the "welcome" class
| would be loaded.
|
|	$route['404_override'] = 'errors/page_missing';
|
| This route will tell the Router what URI segments to use if those provided
| in the URL cannot be matched to a valid route.
|
*/
//$route['(admin/manage_leads)']='adminleads/managetelecalls';



$route['admin/update-(:num)-user-(:num)'] = 'admin/edituser/$1/$2';
$route['404_override'] = '';
$route['user/(:num)/(:any)']='auth/user/$1';
$route['(Recent_Articles/articles/(:num))']='auth/articles/$1';
$route['(Recent_Articles/articles)']='auth/articles';

$route['(Recent_Questions/question/all/(:num))']='quest_ans_controler/Browse_Question/all/$1';
$route['(Recent_Questions/question/all)']='quest_ans_controler/Browse_Question/all';


$route['article-list/university_articles_list/(:num)']='univ/university_articles_list/$1';
$route['article-list/university_articles_list']='univ/university_articles_list';

$route['(Recent_News/news/(:num))']='auth/news/$1';
$route['(Recent_News/news)']='auth/news';

$route['news-list/university_news_list/(:num)']='univ/university_news_list/$1';
$route['news-list/university_news_list']='univ/university_news_list';

$route['university_events']='univ/university_events';
$route['event-list/university_events/(:num)']='univ/university_events/$1';
$route['event-list/university_events']='univ/university_events';

$route['university_articles']='univ/university_articles_list';


$route['about']='univ/univ_aboutus';
$route['programs']='univ/programs';

$route['university_news']='univ/university_news_list';


//$route['university_qustions_qnswers']='univ/UniversityQuest';
//$route['(:any)/(:any)/(:num)']='univ/university_articles_list';
$route['(event/EventRegistration)'] = 'leadcontroller/EventRegistration';
$route['event/(:num)/(:any)']='univ/univ_event/$1';

//news detail page
$route['news/(:num)/(:any)']='univ/univ_news/$1';
//article detail page

$route['articles/(:num)/(:any)']='univ/univ_articles/$1';
//event detail page

//for program page
$route['programs/(:num)/(:any)']='univ/program_detail/$1';


$route['question/(:num)/(:any)']='univ/UniversityQuest/$1';

//$route['university/(:num)/(:any)/article/(:num)/(:any)']='univ/univ_articles/$1/$3';

//for news page

//for about us
$route['(:num)/university/(:any)/about']='univ/univ_aboutus/$1';

//for event list
$route['(:num)/university/(:any)/events']='univ/university_events_list/$1';


$route['(:num)/university/(:any)/news']='univ/university_news_list/$1';
$route['(:num)/university/(:any)/articles']='univ/university_article_list/$1';
$route['program_detail/(:num)/(:num)']='univ/program_detail/$1/$2';


$route['university/(:num)/(:any)']='univ/university/$1';
$route['Questions_Answers']='univ/UniversityQuestSection';
$route['otherQuestion/(:num)/(:any)']='quest_ans_controler/AnotherQuestion/$1';





$route['change_user_password/(:any)/(:num)']='auth/change_user_password/$1/$2';
$route['(college_search|events_search)'] = 'search/$1';
$route['colleges/(.*)'] = 'auth/all_colleges/$1';
$route['colleges']='auth/all_colleges';

$route['events/(.*)'] = 'auth/events/$1';
$route['events']='auth/events';
$route['british_council_fair/(.*)/(.*)']='auth/advt_events';$route['thankyou/(:any)']='auth/thankupage/$1';$route['success']='auth/success';

$route['(questandans)'] = 'quest_ans_controler/$1';

$route['(inbox)'] = 'user/$1';
$route['inbox/(:any)']='user/inbox/$1';
$route['(outbox)'] = 'user/$1';
$route['outbox/(:any)']='user/outbox/$1';
$route['(compose_email)'] = 'user/$1';
$route['Browse_Question/(:any)'] = 'quest_ans_controler/Browse_Question/$1';

//profile messages
$route['(delete_message_inbox)'] = 'user/delete_message_inbox';
$route['(delete_message_inbox/(:num))'] = 'user/delete_message_inbox/$1';
$route['(delete_message_inbox/(:num)/(:num))'] = 'user/delete_message_inbox/$1/$2';
$route['(delete_message_outbox)'] = 'user/delete_message_outbox/$1';
$route['(delete_message_outbox/(:num))'] = 'user/delete_message_outbox/$1';
$route['(delete_message_outbox/(:num)/(:num))'] = 'user/delete_message_outbox/$1/$2';



//$route['(:any)'] = "auth/$1";
//define function call with this controller
$route['(use_higer_browser|subdomain|subspot_admission_events|fairs_events|Counselling_events|login|register|register/(:any)|logout|news|articles|update_password|home|events|events/(:any)|update_profile|user_profile_update|forgot_password|change_user_password|university/id|home/pwd_change|about_us|contact_us|home/pus|index/cfr)'] = 'auth/$1';
$route['default_controller'] = 'auth';
$route['(find_college)'] = 'leadcontroller/find_college';

$route['(alumini-detail)'] = 'univ/univ_overview_detail/$1';
$route['(faculties-detail)'] = 'univ/univ_overview_detail/$1';
$route['(studentlife-detail)'] = 'univ/univ_overview_detail/$1';
$route['(internationalstudent-detail)'] = 'univ/univ_overview_detail/$1';
$route['(expertise-detail)'] = 'univ/univ_overview_detail/$1';
$route['(departments-detail)'] = 'univ/univ_overview_detail/$1';
$route['(univ-services)'] = 'univ/univ_overview_detail/$1';


$route['(find_college/(:num))'] = 'leadcontroller/find_college/$1';
$route['(find_college/(:num)/(:num))'] = 'leadcontroller/find_college/$1/$2';

$route['(MeetUniversities-Canvas)'] = 'user/meet_canvas_page';
$route['(submit_canvas_data)'] = 'user/submit_canvas_data';
/* End of file routes.php */
/* Location: ./application/config/routes.php */