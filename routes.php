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
$route['default_controller'] = 'login';
$route['forget-password'] = 'Login/forgetPassword';
$route['logout'] = 'Login/logout';
$route['thankyou'] = 'Login/thankYou';
$route['users'] = 'User/index';
$route['reset-password/(.*)'] = 'Login/resetPassword/$1';
$route['distributors'] = 'Distributor/index';
$route['agents'] = 'Agents/index';
$route['dealers'] = 'Dealer/index';
$route['orderList'] = 'Order/index';
$route['jobbers'] = 'Jobber/index';
$route['jobberlist'] = 'Jobber/jobberlist';
$route['suppliers'] = 'Supplier/index';
$route['Jobber/addJobber/(:any)/(:any)'] = 'Jobber/addJobber/$1/$2';
$route['Jobber/addJobber/(:any)'] = 'Jobber/addJobber/$1/$2';
$route['Jobber/editJobbers/(:any)/(:any)'] = 'Jobber/addJobber/$1/$2';
$route['Fabric/editFabricInward/(:any)'] = 'Fabric/addFabricInward/$1';
$route['purchaseorders'] = 'Purchaseorder/index';
$route['fabricinwards'] = 'Fabric/fabricinwards';
$route['assignedjobbers'] = 'Fabric/assignedjobbers';
$route['my-profile'] = 'User/editProfile';
$route['cuttingprogramme'] = 'Cuttingreports/index';
$route['cuttingprogramme/addcuttingprogramme'] = 'Cuttingreports/addcuttingreport/None';
$route['cuttingprogramme/addcuttingprogramme/(:any)'] = 'Cuttingreports/addcuttingreport/$1';
$route['cuttingprogramme/editcuttingprogramme/(:any)'] = 'Cuttingreports/editCuttingReport/$1';
$route['cuttingprogramme/viewcuttingprogramme/(:any)'] = 'Cuttingreports/viewcuttingprogramme/$1';
$route['cuttingprogramme/addcuttingreport/(:any)'] = 'Cuttingreports/addReport/$1';
$route['cuttingprogramme/editcuttingreport/(:any)'] = 'Cuttingreports/editReport/$1';
$route['washinginwards'] = 'Washingreports/washinginwards';
$route['404_override'] = '';
$route['translate_uri_dashes'] = FALSE;
