<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->get('/log-in', 'Home::login');
$routes->get('/', 'Home::login');
$routes->get('/food-list', 'Home::products');
$routes->get('/orders-list', 'Home::orders');
$routes->get('/home', 'Home::products');
