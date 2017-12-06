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

$route['default_controller'] = "i/padrao";
$route['404_override'] = "erro404";
$route['i/accounts/(:num)'] = 'i/accounts';
$route['i/contacts/(:num)'] = 'i/contacts';
$route['i/commissions/(:num)'] = 'i/commissions';



$route['i/(:any)'] = 'i/$1';
$route['i'] = 'i/padrao';
$route['search'] = 'search';


$route['signup'] = 'i/login/signup';
$route['signup/(:any)'] = 'i/login/signup/(:any)';
$route['login'] = 'i/login';
$route['dashboard'] = 'i/dashboard';
$route['pricing'] = 'i/pricing';





$route['robot/(:any)'] = 'robot/$1';
$route['(:any)'] = 'usuarios';

/* End of file routes.php */
/* Location: ./application/config/routes.php */