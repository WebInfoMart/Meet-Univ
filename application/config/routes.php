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

$route['default_controller'] = "auth";
$route['admin/update-(:num)-user-(:num)'] = 'admin/edituser/$1/$2';
$route['404_override'] = '';
$route['user/(:num)']='auth/user/$1';
$route['university/(:num)']='univ/university/$1';
$route['univ_programs/(:num)/(:any)']='univ/univ_programs/$1/$2';
$route['univ-(:num)-event-(:num)']='univ/univ_event/$1/$2';
$route['univ-(:num)-news-(:num)']='univ/univ_news/$1/$2';
$route['univ-(:num)-events']='univ/university_events_list/$1';
$route['univ-(:num)-news']='univ/university_news_list/$1';
$route['program_detail/(:num)/(:num)']='univ/program_detail/$1/$2';
$route['inbox/(:any)']='user/inbox/$1';
$route['change_user_password/(:any)/(:num)']='auth/change_user_password/$1/$2';

//$route['(:any)'] = "auth/$1";
//define function call with this controller
$route['(login|register|logout|news|update_password|home|events|events/(:any)|update_profile|user_profile_update|find_college|forgot_password|change_user_password|university/id|all_colleges|home/pwd_change|home/pus|index/cfr)'] = 'auth/$1';
$route['(college_search)'] = 'search/$1';
$route['(inbox)'] = 'user/$1';
$route['(delete_message_inbox)'] = 'user/$1';
$route['(delete_message_inbox/(:num))'] = 'user/$1';
/* End of file routes.php */
/* Location: ./application/config/routes.php */