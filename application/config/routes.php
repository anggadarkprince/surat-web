<?php
defined('BASEPATH') OR exit('No direct script access allowed');

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
| There are three reserved routes:
|
|	$route['default_controller'] = 'welcome';
|
| This route indicates which controller class should be loaded if the
| URI contains no data. In the above example, the "welcome" class
| would be loaded.
|
|	$route['404_override'] = 'errors/page_missing';
|
| This route will tell the Router which controller/method to use if those
| provided in the URL cannot be matched to a valid route.
|
|	$route['translate_uri_dashes'] = FALSE;
|
| This is not exactly a route, but allows you to automatically route
| controller and method names that contain dashes. '-' isn't a valid
| class or method name character, so it requires translation.
| When you set this option to TRUE, it will replace ALL dashes in the
| controller and method URI segments.
|
| Examples:	my-controller/index	-> my_controller/index
|		my-controller/my-method	-> my_controller/my_method
*/
$route['default_controller'] = 'page';

$route['inbox'] = 'inbox/index';
$route['inbox/create'] = 'inbox/create';
$route['inbox/edit/(:id)'] = 'inbox/edit/$1';
$route['inbox/detail/(:id)'] = 'inbox/show/$1';
$route['inbox/update'] = 'inbox/update';
$route['inbox/delete'] = 'inbox/delete';

$route['outbox'] = 'outbox/index';
$route['outbox/create'] = 'outbox/create';
$route['outbox/edit/(:id)'] = 'outbox/edit/$1';
$route['outbox/detail/(:id)'] = 'outbox/show/$1';
$route['outbox/update'] = 'outbox/update';
$route['outbox/delete'] = 'outbox/delete';

$route['archive'] = 'page/archive';

$route['report'] = 'report/index';
$route['report/today'] = 'report/today';
$route['report/week'] = 'report/week';

$route['settings'] = 'setting/index';
$route['account'] = 'user/account';

$route['dashboard'] = 'page/dashboard';
$route['login'] = 'page/login';
$route['register'] = 'page/register';
$route['logout'] = 'page/logout';
$route['lockscreen'] = 'page/lockscreen';
$route['unlock'] = 'page/unlock';
$route['(:any)'] = 'page/view/$1';
$route['404_override'] = '';
$route['translate_uri_dashes'] = FALSE;
