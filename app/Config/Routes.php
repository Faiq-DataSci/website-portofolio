<?php

use CodeIgniter\Router\RouteCollection;

/** @var RouteCollection $routes */
$routes->get('/', 'Home::index');

$routes->get('/about', 'About::index');
$routes->get('/skills', 'Skills::index');
$routes->get('/projects', 'Projects::index');
$routes->get('/projects/detail/(:num)', 'Projects::detail/$1'); // API endpoint for project detail
$routes->match(['get', 'post'], '/contact', 'Contact::index');

// Auth Routes
$routes->get('/login', 'Auth::login');
$routes->post('/login', 'Auth::processLogin');
$routes->get('/logout', 'Auth::logout');

// Protected Admin Routes (Only accessible by logged-in admin)
$routes->group('admin', ['filter' => 'adminAuth'], static function ($routes) {
    $routes->get('dashboard', 'Admin\Dashboard::index');

    // Admin Project CRUD Routes
    $routes->get('project', 'Admin\Project::index');
    $routes->get('project/create', 'Admin\Project::create');
    $routes->post('project/store', 'Admin\Project::store');
    $routes->get('project/edit/(:num)', 'Admin\Project::edit/$1');
    $routes->post('project/update/(:num)', 'Admin\Project::update/$1');
    $routes->get('project/delete/(:num)', 'Admin\Project::delete/$1');

    // Admin Skills CRUD Routes
    $routes->get('skills', 'Admin\Skills::index');
    $routes->get('skills/create', 'Admin\Skills::create');
    $routes->post('skills/store', 'Admin\Skills::store');
    $routes->get('skills/edit/(:num)', 'Admin\Skills::edit/$1');
    $routes->post('skills/update/(:num)', 'Admin\Skills::update/$1');
    $routes->get('skills/delete/(:num)', 'Admin\Skills::delete/$1');

    // Admin Certificate CRUD Routes
    $routes->get('certificates', 'Admin\Certificate::index');
    $routes->get('certificates/create', 'Admin\Certificate::create');
    $routes->post('certificates/store', 'Admin\Certificate::store');
    $routes->get('certificates/edit/(:num)', 'Admin\Certificate::edit/$1');
    $routes->post('certificates/update/(:num)', 'Admin\Certificate::update/$1');
    $routes->get('certificates/delete/(:num)', 'Admin\Certificate::delete/$1');

    // Admin Technology Colors CRUD Routes
    $routes->get('technology-colors', 'Admin\TechnologyColor::index');
    $routes->get('technology-colors/create', 'Admin\TechnologyColor::create');
    $routes->post('technology-colors/store', 'Admin\TechnologyColor::store');
    $routes->get('technology-colors/edit/(:num)', 'Admin\TechnologyColor::edit/$1');
    $routes->post('technology-colors/update/(:num)', 'Admin\TechnologyColor::update/$1');
    $routes->get('technology-colors/delete/(:num)', 'Admin\TechnologyColor::delete/$1');
});
