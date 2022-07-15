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

$route['default_controller'] = 'frontend';
$route['404_override'] = 'errors/not_found';
$route['translate_uri_dashes'] = FALSE;

$route['landing'] = 'frontend/landing';

// $route['promo-imlek-hikvision'] = 'frontend/promo_imlek_hikvision';
// $route['promo-imlek-proview'] = 'frontend/promo_imlek_proview';

$route['promo-2022-hikvision'] = 'frontend/promo_2022_hikvision';
$route['promo-2022-proview'] = 'frontend/promo_2022_proview';
$route['promo-2022-colorvu-2mp'] = 'frontend/promo_2022_colorvu_2mp';
$route['promo-2022-colorvu-5mp'] = 'frontend/promo_2022_colorvu_5mp';

$route['catalogue'] = 'frontend/catalogue';

$route['backend/sort-catalogue'] = 'backend/sortCatalogue';

$route['backend/sales-quote'] = 'backend/sales_quote';
$route['backend/sales-quote/generate'] = 'backend/sales_quote_generate';

$route['sales-quote/view'] = 'api/sales_quote_view/view/view';
$route['sales-quote/download'] = 'api/sales_quote_view/download/view';

$route['sales-quote-preview/view'] = 'api/sales_quote_view/view/preview';
$route['sales-quote-preview/download'] = 'api/sales_quote_view/download/preview';