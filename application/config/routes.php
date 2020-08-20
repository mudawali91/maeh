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
|	https://codeigniter.com/user_guide/general/routing.html
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

//<<<<<<<<<<<<<<<<<<<<<<<<<<<<< PUBLIC USER SITE >>>>>>>>>>>>>>>>>>>>>>>>>>>>>>

$route['default_controller'] = 'registration';
$route['404_override'] = '';
$route['translate_uri_dashes'] = FALSE;

$route['registration-form'] = 'Registration';
$route['registration-upload'] = 'Registration/upload_file';
$route['registration-submit'] = 'Registration/save';
$route['registration-complete/(:any)'] = 'Registration/registration_complete/$1';

// $route['application-form'] = 'start';
// $route['application-submit'] = 'application/application_submit';
// $route['application-complete'] = 'application/application_complete';

//<<<<<<<<<<<<<<<<<<<<<<<<<<<<< END PUBLIC USER SITE >>>>>>>>>>>>>>>>>>>>>>>>>>>>>>


//<<<<<<<<<<<<<<<<<<<<<<<<<<<<< ADMIN SITE >>>>>>>>>>>>>>>>>>>>>>>>>>>>>>

/*----------  LOGIN  ----------*/
$route['admin'] = admin_path.'start/login';
$route['admin/login'] = admin_path.'start/login_submit';
$route['admin/logout'] = admin_path.'start/logout';
$route['admin/forgot-password'] = admin_path.'start/forgot_password';

// SETTINGS

$route['qualification-category-list-dd'] = 'Qualification_category/list_dd';

//<<<<<<<<<<<<<<<<<<<<<<<<<<<<< END ADMIN SITE >>>>>>>>>>>>>>>>>>>>>>>>>>>>>>


