<?php

use CodeIgniter\Router\RouteCollection;

/** @var RouteCollection $routes */
$routes->get('/', 'Home::index');
$routes->get('/login', 'Auth::login');
$routes->match(['get', 'post'], '/login/process', 'Auth::loginProcess');
$routes->get('/logout', 'Auth::logout');

// Group routes untuk Admin, dilindungi oleh filter 'auth' khusus role admin
$routes->group('admin', ['filter' => 'auth:admin'], static function ($routes) {
    $routes->get('/', 'Admin::index');
    $routes->get('members', 'Admin::members');
    $routes->match(['get', 'post'], 'members/add', 'Admin::addMember');
    $routes->match(['get', 'post'], 'verifikasi', 'Admin::verifikasi');
    $routes->get('report', 'Admin::report');
});

// Group routes untuk Warga, dilindungi oleh filter 'auth' khusus role warga
$routes->group('warga', ['filter' => 'auth:warga'], static function ($routes) {
    $routes->get('/', 'Warga::index');
    $routes->get('saving', 'Warga::saving');
    $routes->match(['get', 'post'], 'saving/process', 'Warga::saveProcess');
    $routes->get('history', 'Warga::history');
});
