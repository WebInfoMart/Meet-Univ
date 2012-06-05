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

$route['admin/update-(:num)-user-(:num)'] = 'admin/edituser/$1/$2';
$route['404_override'] = '';
$route['user/(:num)']='auth/user/$1';
$route['university/(:num)']='univ/university/$1';
$route['univ_programs/(:num)/(:any)']='univ/univ_programs/$1/$2';
$route['univ-(:num)-event-(:num)']='univ/univ_event/$1/$2';
$route['univ-(:num)-news-(:num)']='univ/univ_news/$1/$2';
$route['univ-(:num)-article-(:num)']='univ/univ_articles/$1/$2';

$route['univ-(:num)-events']='univ/university_events_list/$1';
$route['univ-(:num)-news']='univ/university_news_list/$1';
$route['univ-(:num)-articles']='univ/university_article_list/$1';
$route['program_detail/(:num)/(:num)']='univ/program_detail/$1/$2';
$route['about-(:num)-university']='univ/univ_aboutus/$1';
$route['(Recent_Articles/articles/(:num))']='auth/articles/$1';
$route['(Recent_Articles/articles)']='auth/articles';
$route['(Recent_News/news/(:num))']='auth/news/$1';
$route['(Recent_News/news)']='auth/news';

$route['change_user_password/(:any)/(:num)']='auth/change_user_password/$1/$2';
$route['(college_search|events_search)'] = 'search/$1';
$route['colleges/(.*)'] = 'auth/all_colleges/$1';
$route['colleges']='auth/all_colleges';




$route['UniversityQuest/(:num)/(:num)/(:num)'] = 'univ/UniversityQuest/$1/$2/$3';
$route['MeetQuest/(:any)/(:any)'] = 'quest_ans_controler/MeetQuest/$1/$2';
$route['UniversityQuestSection/(:num)'] = 'univ/UniversityQuestSection/$1';
$route['UniversityQuestSection'] = 'univ/UniversityQuestSection';
$route['(QuestandAns)'] = 'quest_ans_controler/$1';

$route['(inbox)'] = 'user/$1';
$route['inbox/(:any)']='user/inbox/$1';
$route['(outbox)'] = 'user/$1';
$route['outbox/(:any)']='user/outbox/$1';
$route['(compose_email)'] = 'user/$1';
$route['BrowseQuestion/(:any)'] = 'quest_ans_controler/BrowseQuestion/$1';


$route['(delete_message_inbox)'] = 'user/delete_message_inbox';
$route['(delete_message_inbox/(:num))'] = 'user/delete_message_inbox/$1';
$route['(delete_message_inbox/(:num)/(:num))'] = 'user/delete_message_inbox/$1/$2';
$route['(delete_message_outbox)'] = 'user/delete_message_outbox/$1';
$route['(delete_message_outbox/(:num))'] = 'user/delete_message_outbox/$1';
$route['(delete_message_outbox/(:num)/(:num))'] = 'user/delete_message_outbox/$1/$2';



//$route['(:any)'] = "auth/$1";
//define function call with this controller
$route['(spot_admission_events|fairs_events|Counselling_events|login|register|logout|news|articles|update_password|home|events|events/(:any)|update_profile|user_profile_update|forgot_password|change_user_password|university/id|home/pwd_change|about_us|contact_us|home/pus|index/cfr)'] = 'auth/$1';
$route['default_controller'] = 'auth';
$route['(find_college)'] = 'leadcontroller/find_college';
$route['(find_college/(:num))'] = 'leadcontroller/find_college/$1';
$route['(find_college/(:num)/(:num))'] = 'leadcontroller/find_college/$1/$2';

$route['(EventRegistration)'] = 'leadcontroller/EventRegistration';
/* End of file routes.php */
/* Location: ./application/config/routes.php */