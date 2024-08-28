<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->get('/', 'Auth::index');

$routes->post('login','Auth::_login');
$routes->post('test','Auth::mytest');

$routes->get('auth', 'Auth::index');
$routes->get('admin', 'Admin::index');
$routes->get('profile', 'Profile::index');

$routes->get('master', 'Master::index');
$routes->get('master/shift', 'Master::shift');
$routes->get('master/e_dept/(:num)', 'Master::editDepartment/$1');
$routes->get('master/e_shift/(:num)', 'Master::editShift/$1');






