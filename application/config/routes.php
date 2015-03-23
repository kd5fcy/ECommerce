<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

$route['default_controller'] = "products";
$route['404_override'] = '';
$route['buy/(:num)'] = "products/buy/$1";
$route['delete/(:num)'] = "products/delete/$1";

//end of routes.php