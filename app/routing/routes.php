<?php
//create new instance of altorouter
$router = new AltoRouter;
include ('adminRoutes.php');
//$router->map('method get or post','the route','target (controller)','name of the route');

$router->map('GET', '/', 'App\Controllers\IndexController@show', 'home');
$router->map('GET', '/featured', 'App\Controllers\IndexController@featuredProducts', 'featured_product');
