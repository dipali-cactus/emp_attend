<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->get('/', 'Auth::index');
$routes->get('/login', 'Auth::index');

$routes->post('login','Auth::index');
$routes->post('test','Auth::mytest');

$routes->get('auth', 'Auth::index');
$routes->get('admin', 'Admin::index', ['filter' => 'admin']);

$routes->get('master', 'Master::index', ['filter' => 'admin']);
$routes->get('master/a_dept', 'Master::a_dept', ['filter' => 'admin']);
$routes->post('master/addDepartment', 'Master::addDept', ['filter' => 'admin']);
$routes->get('master/e_dept/(:segment)', 'Master::e_dept/$1', ['filter' => 'admin']);
// $routes->post('master/updateDepartment', function(){
//     echo "Test";exit;
// });
$routes->post('master/updateDepartment', 'Master::editDept', ['filter' => 'admin']);
$routes->get('master/d_dept/(:segment)', 'Master::d_dept/$1', ['filter' => 'admin']);

$routes->get('master/shift', 'Master::shift', ['filter' => 'admin']);
$routes->get('master/a_shift', 'Master::a_shift', ['filter' => 'admin']);
$routes->post('master/a_shift', 'Master::addShift', ['filter' => 'admin']);
$routes->get('master/e_shift/(:segment)', 'Master::e_shift/$1', ['filter' => 'admin']);
$routes->post('master/e_shift/(:segment)', 'Master::e_shift/$1', ['filter' => 'admin']);
$routes->get('master/d_shift/(:segment)', 'Master::d_shift/$1', ['filter' => 'admin']);

$routes->get('master/employee', 'Master::employee', ['filter' => 'admin']);
$routes->get('master/a_employee', 'Master::a_employee', ['filter' => 'admin']);
$routes->post('master/a_employee', 'Master::a_employee', ['filter' => 'admin']);
$routes->get('master/e_employee/(:segment)', 'Master::e_employee/$1', ['filter' => 'admin']);
$routes->post('master/e_employee/(:segment)', 'Master::e_employee/$1', ['filter' => 'admin']);
$routes->get('master/d_employee/(:segment)', 'Master::d_employee/$1', ['filter' => 'admin']);

$routes->get('master/location', 'Master::location', ['filter' => 'admin']);
$routes->get('master/a_location', 'Master::a_location', ['filter' => 'admin']);
$routes->post('master/a_location', 'Master::a_location', ['filter' => 'admin']);
$routes->get('master/e_location/(:num)', 'Master::e_location/$1', ['filter' => 'admin']);
$routes->post('master/e_location/(:num)', 'Master::e_location/$1', ['filter' => 'admin']);
$routes->get('master/d_location/(:num)', 'Master::d_location/$1', ['filter' => 'admin']);

$routes->get('master/users', 'Master::users', ['filter' => 'admin']);
$routes->get('master/a_users/(:num)', 'Master::a_users/$1', ['filter' => 'admin']);
$routes->post('master/a_users/(:num)', 'Master::a_users/$1', ['filter' => 'admin']);

$routes->get('master/e_users/(:segment)', 'Master::e_users/$1', ['filter' => 'admin']);
$routes->post('master/e_users/(:segment)', 'Master::e_users/$1', ['filter' => 'admin']);
$routes->get('master/d_users/(:num)', 'Master::d_users/$1', ['filter' => 'admin']);

$routes->get('report', 'Report::index', ['filter' => 'admin']);
$routes->get('report/print/(:segment)/(:segment)/(:segment)', 'Report::print/$1/$2/$3', ['filter' => 'admin']);

$routes->get('auth/logout', 'Auth::logout');

$routes->get('profile', 'Profile::index');
$routes->get('attendance', 'Attendance::index');
$routes->post('attendance', 'Attendance::index');

$routes->get('attendance/history', 'Attendance::history');
$routes->get('attendance/checkout', 'Attendance::checkout');
