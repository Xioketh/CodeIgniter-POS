<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->get('/log-in', 'Home::login');
$routes->get('/', 'Home::login');
$routes->get('/orders-list', 'Home::orders');


//$routes->get('/add-food', 'FoodController::add_food');


//$routes->get('/food-list', 'Home::products');
//$routes->get('/food-list', 'FoodController::index');


$routes->get('/food-list', 'CategoryController::index');
$routes->get('/foods/(:num)', 'CategoryController::getFoods/$1');

$routes->post('order/placeOrder', 'OrderController::placeOrder');

$routes->post('orders/search', 'OrderController::search');

$routes->post('/orders/getOrderItems', 'OrderController::getOrderItems');
$routes->post('/orders/changeOrderStatus', 'OrderController::changeOrderStatus');


$routes->get('/add-food', 'FoodController::index');
$routes->post('/food/add', 'FoodController::addFood');




