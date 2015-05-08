<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

$route['default_controller'] = "main";
$route['login'] = "users/login_route";
$route['admin/orders'] = "users/orders_route";
$route['admin/products'] = "users/product_route";
$route['admin/products/add'] = "users/add_product_route";
$route['admin/users'] = "users/users_route";
$route['admin/products/edit/(:num)'] = "products/edit_product_route/$1";
$route['admin/products/remove/(:num)'] = "products/remove_product/$1";
$route['404_override'] = '';
$route['carts'] = "products/carts";

//end of routes.php