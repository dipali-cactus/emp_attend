<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->get('/', 'Auth::index');

$routes->post('login','Auth::index');
$routes->post('test','Auth::mytest');

$routes->get('auth', 'Auth::index');
$routes->get('admin', 'Admin::index');
$routes->get('profile', 'Profile::index');

$routes->get('master', 'Master::index');
$routes->get('master/a_dept', 'Master::a_dept');
$routes->post('master/addDepartment', 'Master::addDept');
$routes->get('master/e_dept/(:segment)', 'Master::e_dept/$1');
// $routes->post('master/updateDepartment', function(){
//     echo "Test";exit;
// });
$routes->post('master/updateDepartment', 'Master::editDept');
$routes->get('master/d_dept/(:segment)', 'Master::d_dept/$1');

$routes->get('master/shift', 'Master::shift');
$routes->get('master/a_shift', 'Master::a_shift');
$routes->post('master/a_shift', 'Master::addShift');
$routes->get('master/e_shift/(:segment)', 'Master::e_shift/$1');
$routes->post('master/e_shift/(:segment)', 'Master::e_shift/$1');
$routes->get('master/d_shift/(:segment)', 'Master::d_shift/$1');

$routes->get('master/employee', 'Master::employee');
$routes->get('master/a_employee', 'Master::a_employee');
$routes->post('master/a_employee', 'Master::a_employee');
$routes->get('master/e_employee/(:segment)', 'Master::e_employee/$1');
$routes->post('master/e_employee/(:segment)', 'Master::e_employee/$1');
$routes->get('master/d_employee/(:segment)', 'Master::d_employee/$1');

$routes->get('master/location', 'Master::location');
$routes->get('master/a_location', 'Master::a_location');
$routes->post('master/a_location', 'Master::_addLocation');
$routes->get('master/e_location/(:num)', 'Master::e_location/$1');
$routes->post('master/e_location', 'Master::_editLocation');
$routes->get('master/d_location/(:num)', 'Master::d_location/$1');

$routes->get('master/users', 'Master::users');
$routes->get('master/a_users/(:segment)', 'Master::a_users/$1');
$routes->post('master/a_users', 'Master::a_users');
$routes->get('master/e_users/(:segment)', 'Master::e_users/$1');
$routes->post('master/e_users', 'Master::e_users');
$routes->get('master/d_users/(:num)', 'Master::d_users/$1');

$routes->get('report/(:any)?', 'Report::index');

$routes->get('auth/logout', 'Auth::logout');





