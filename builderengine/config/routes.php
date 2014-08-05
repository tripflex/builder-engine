<?php
/***********************************************************
* BuilderEngine v2.0.12
* ---------------------------------
* BuilderEngine CMS Platform - Radian Enterprise Systems Limited
* Copyright Radian Enterprise Systems Limited 2012-2014. All Rights Reserved.
*
* http://www.builderengine.com
* Email: info@builderengine.com
* Time: 2014-23-04 | File version: 2.0.12
*
***********************************************************/

  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
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

//Everything routed through the module_manager; He initializes the initial show object which later on is used everywhere.
//Besides that in the module_manager is the only place where the functions frontend and backend are called
$route['404_override'] = '';
$route['default_controller'] = "module_manager/process/page";
$route['editor'] = "module_manager/process_editor/page/index";
$route['editor/(:any)'] = "module_manager/process_editor/$1";
$route['admin/module/(:any)/(:any)/(:any)/(:any)/(:any)/(:any)/(:any)/(:any)'] = "module_manager/process_admin/$1/admin/$2/$3/$4/$5/$6/$7/$8";
$route['admin/module/(:any)/(:any)/(:any)/(:any)/(:any)/(:any)/(:any)'] = "module_manager/process_admin/$1/admin/$2/$3/$4/$5/$6/$7";
$route['admin/module/(:any)/(:any)/(:any)/(:any)/(:any)/(:any)'] = "module_manager/process_admin/$1/admin/$2/$3/$4/$5/$6";
$route['admin/module/(:any)/(:any)/(:any)/(:any)/(:any)'] = "module_manager/process_admin/$1/admin/$2/$3/$4/$5";
$route['admin/module/(:any)/(:any)/(:any)/(:any)'] = "module_manager/process_admin/$1/admin/$2/$3/$4";
$route['admin/module/(:any)/(:any)/(:any)'] = "module_manager/process_admin/$1/admin/$2/$3";
$route['admin/module/(:any)/(:any)'] = "module_manager/process_admin/$1/admin/$2";

$route['admin/module/(:any)'] = "module_manager/process_admin/$1";

$route['admin/(:any)/(:any)'] = "admin_$1/$2";

//$route['module/(:any)/(:any)'] = "module_manager/process/$1/$2";
$route['module/(:any)'] = "module_manager/process/$1";



$route['(:any)/ajax/(:any)'] = "module_manager/process_ajax/$1/ajax/$2";

$route['(:any).html'] = "module_manager/process_seo/$1";

$route['admin'] = "/admin_main/dashboard";
$route['(:any)'] = "module_manager/process/$1";


/* End of file routes.php */
/* Location: ./application/config/routes.php */