<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

$route['default_controller'] = "main";
$route['login'] = "users/login_route";
$route['register'] = "users/register_route";
$route['show/(:num)'] = "products/show_product/$1";
$route['cart'] = "carts/cart";

//ORDER ROUTES
$route['admin/orders'] = "orders/orders_route";
$route['admin/orders/edit/(:num)'] = "orders/edit_order/$1";
$route['admin/orders/delete/(:num)'] = "orders/delete_order/$1";
$route['orders/show/(:num)'] = "orders/show_order/$1";


//PRODUCT ROUTES
$route['admin/products'] = "users/product_route";
$route['admin/products/add'] = "users/add_product_route";
$route['admin/products/edit/(:num)'] = "products/edit_product_route/$1";
$route['admin/products/remove/(:num)'] = "products/remove_product/$1";
$route['products/(:any)/(:num)'] = "main/show_products/$1/$2";

//USER ROUTES
$route['admin/users'] = "users/users_route";
$route['users/dashboard/(:num)'] = "users/dashboard/$1";
//$route['products/categories/(:any)'] = "main/products_as_categories";
$route['404_override'] = '';

//end of routes.php