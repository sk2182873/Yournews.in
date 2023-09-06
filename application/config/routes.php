<?php
defined('BASEPATH') or exit('No direct script access allowed');

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
|	https://codeigniter.com/userguide3/general/routing.html
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
$route['default_controller'] = 'Home';
$route['404_override'] = '';
$route['translate_uri_dashes'] = FALSE;

// admin routes
$route['admin'] = 'admin/login';
$route['register'] = 'admin/register';
$route['profile'] = 'admin/profile';
$route['admin/forgot-password'] = 'admin/forgot_pass';
$route['admin/dashboard'] = 'pages/dashboard';
$route['admin/articles'] = 'pages/articles';
$route['admin/addarticle'] = 'pages/addarticle';
$route['admin/blogs'] = 'pages/blogs';
$route['admin/addblogs'] = 'pages/addblogs';
$route['admin/users'] = 'pages/users';
$route['admin/addusers'] = 'pages/addusers';
$route['admin/account'] = 'pages/account';
$route['admin/pages'] = 'pages/pagesList';
$route['admin/addpage'] = 'pages/addpage';

//user routes.
$route['user'] = 'user/login';
$route['user/dashboard'] = 'pages/dashboard';
$route['user/articles'] = 'pages/articles';
$route['user/addarticle'] = 'pages/addarticle';
$route['user/blogs'] = 'pages/blogs';
$route['user/addblogs'] = 'pages/addblogs';
$route['user/account'] = 'pages/account';

//pages route.
$route['category/(:any)'] = 'Home/loadPages/$1';

//functions route.
$route['article/(:num)/(:any)'] = "Article/index/$1/$2";


require_once APPPATH.'cache/routes.php';




