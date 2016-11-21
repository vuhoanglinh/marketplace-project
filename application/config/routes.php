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

$route['default_controller'] = "public/index";
$route['404_override'] 	= '';

//Config router for index page
$route['mua-sam/(:any)'] 							= "public/index/search";
$route['san-pham/(:any)/chi-tiet'] 					= "public/index/detail";
$route['thoi-trang'] 								= "public/index/news";
$route['thoi-trang/(:any)'] 		= "public/index/newsdetail";

//Config route for admin page
$route['admincp'] 	 = "admincp/index";
$route['adminlevel'] = "adminlevel/index";
$route['stores']  	 = "stores/index";

//Config route for store
$route['cua-hang/(:any)/trang-chu'] 				= "stores/merchant";
$route['cua-hang/(:any)/gioi-thieu']				= "stores/merchant/intro";
$route['cua-hang/(:any)/he-thong']  				= "stores/merchant/stores";
$route['cua-hang/(:any)/danh-gia']  				= "stores/merchant/assessment";
$route['cua-hang/(:any)/san-pham']  				= "stores/merchant/product";
$route['cua-hang/(:any)/san-pham/(:any)/chi-tiet']  = "stores/merchant/detail";
$route['cua-hang/(:any)/su-kien']  	 				= "stores/merchant/event";
$route['cua-hang/(:any)/lien-he']  	 				= "stores/merchant/contact";
/* End of file routes.php */
/* Location: ./application/config/routes.php */