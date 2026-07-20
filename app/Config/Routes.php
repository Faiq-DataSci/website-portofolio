<?php

use CodeIgniter\Router\RouteCollection;

/** @var RouteCollection $routes */
$routes->get('/', 'Home::index');

$routes->get('/', 'Home::index');

$routes->get('/about', 'About::index');

$routes->get('/skills', 'Skills::index');

$routes->get('/projects', 'Projects::index');

$routes->get('/projects/(:num)', 'Projects::detail/$1');

$routes->match(['get', 'post'], '/contact', 'Contact::index');
