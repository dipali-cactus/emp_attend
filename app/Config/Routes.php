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
$routes->get('master/a_dept', 'Master::a_dept');
$routes->post('master/a_dept', 'Master::_addDept');
//$routes->get('master/e_dept/(:num)', 'Master::editDepartment/$1');
$routes->get('master/e_dept/(:num)', 'Master::e_dept/$1');
$routes->post('master/e_dept', 'Master::_editDept');
$routes->get('master/d_dept/(:num)', 'Master::d_dept');

$routes->get('master/shift', 'Master::shift');
$routes->get('master/a_shift', 'Master::a_shift');
$routes->post('master/a_shift', 'Master::_addShift');
$routes->get('master/e_shift/(:num)', 'Master::e_shift/$1');
$routes->post('master/e_shift', 'Master::_editShift');
$routes->get('master/d_shift/(:num)', 'Master::d_shift');


$routes->get('master/employee', 'Master::employee');
$routes->get('master/a_employee', 'Master::a_employee');
$routes->post('master/a_employee', 'Master::_addEmployee');
$routes->get('master/e_employee/(:num)', 'Master::e_employee/$1');
$routes->post('master/e_employee', 'Master::_editEmployee');
$routes->get('master/d_employee/(:num)', 'Master::d_employee');


$routes->get('master/location', 'Master::location');
$routes->get('master/a_location', 'Master::a_location');
$routes->post('master/a_location', 'Master::_addLocation');
$routes->get('master/e_location/(:num)', 'Master::e_location/$1');
$routes->post('master/e_location', 'Master::_editLocation');
$routes->get('master/d_location/(:num)', 'Master::d_location');


$routes->get('master/users', 'Master::users');
$routes->get('master/a_users/(:num)', 'Master::a_users/$1');
$routes->post('master/a_users', 'Master::a_users');
$routes->get('master/e_users/(:num)', 'Master::e_users/$1');
$routes->post('master/e_users', 'Master::e_users');
$routes->get('master/d_users/(:num)', 'Master::d_users');





