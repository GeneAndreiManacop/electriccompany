<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */

// Home page
$routes->get('/', 'Home::index');

// About page
$routes->get('/about', 'About::index');

// Services page
$routes->get('/services', 'Services::index');

// Contact page
$routes->match(['get', 'post'], '/contact', 'Contact::index');

// Register
$routes->get('/register', 'Register::index');
$routes->post('/register', 'Register::create');

// Login
$routes->match(['get', 'post'], '/login', 'Auth::login');

// Logout
$routes->post('/logout', 'Auth::logout');

// Dashboard page
$routes->get('/dashboard', 'Dashboard::index', ['filter' => 'authCheck']);

// Dashboard - Create account
$routes->match(['get', 'post'], '/create', 'Dashboard::create', ['filter' => 'authCheck']);

// Dashboard - View account
$routes->get('account/(:num)', 'Dashboard::viewAccount/$1', ['filter' => 'authCheck']);

// Dashboard - Delete Account
$routes->post(
    'account/(:num)/delete',
    'Dashboard::delete/$1',
    ['filter' => 'authCheck']
);

// Dashboard - Edit Account
$routes->get('account/(:num)/edit', 'Dashboard::edit/$1', ['filter' => 'authCheck']);
$routes->post('account/(:num)/update', 'Dashboard::update/$1', ['filter' => 'authCheck']);
