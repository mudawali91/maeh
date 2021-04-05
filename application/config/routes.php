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
$route['registration/qualification/details'] = 'Registration/qualification_details';
$route['registration/organization/details'] = 'Registration/organization_details';


$route['registration-status'] = 'Registration/check_status';
$route['registration-status/get'] = 'Registration/get_status';

//<<<<<<<<<<<<<<<<<<<<<<<<<<<<< END PUBLIC USER SITE >>>>>>>>>>>>>>>>>>>>>>>>>>>>>>


//<<<<<<<<<<<<<<<<<<<<<<<<<<<<< ADMIN SITE >>>>>>>>>>>>>>>>>>>>>>>>>>>>>>

/*----------  LOGIN  ----------*/
$route['admin'] = admin_path.'Start/login';
$route['admin/login'] = admin_path.'Start/login_submit';
$route['admin/logout'] = admin_path.'Start/logout';
$route['admin/forgot-password'] = admin_path.'Start/forgot_password';

$route['admin/dashboard'] = admin_path.'Start/index';
$route['admin/registration'] = 'Registration/list_page';
$route['admin/registration/list'] = 'Registration/list_data';
$route['admin/registration/total'] = 'Registration/total';
$route['admin/registration/delete'] = 'Registration/delete';
$route['admin/registration/approval'] = 'Registration/approval';
$route['admin/registration/(:any)'] = 'Registration/details/$1';

// SETTINGS

$route['qualification-category-list-dd'] = 'Qualification_category/list_dd';

//<<<<<<<<<<<<<<<<<<<<<<<<<<<<< END ADMIN SITE >>>>>>>>>>>>>>>>>>>>>>>>>>>>>>


