<?php

use CodeIgniter\Router\RouteCollection;

/** @var RouteCollection $routes */
$routes->get('/', 'Home::index');

$routes->get('/about', 'About::index');
$routes->get('/skills', 'Skills::index');
$routes->get('/projects', 'Projects::index');
$routes->get('/projects/(:num)', 'Projects::detail/$1');
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

    // Admin Gambar/Gallery CRUD Routes
    $routes->get('gallery', 'Admin\Gambar::index');
    $routes->get('gallery/create', 'Admin\Gambar::create');
    $routes->post('gallery/store', 'Admin\Gambar::store');
    $routes->get('gallery/edit/(:num)', 'Admin\Gambar::edit/$1');
    $routes->post('gallery/update/(:num)', 'Admin\Gambar::update/$1');
    $routes->get('gallery/delete/(:num)', 'Admin\Gambar::delete/$1');
});
