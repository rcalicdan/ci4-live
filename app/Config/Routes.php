<?php

use CodeIgniter\Router\RouteCollection;
use App\Controllers\PostController;

/**
 * @var RouteCollection $routes
 */
$routes->get('/', 'Home::index');

$routes->get('posts', [PostController::class, 'index'], ['as' => 'posts.index']);
$routes->get('posts/create', [PostController::class, 'create'], ['as' => 'posts.create']);
$routes->post('posts/store', [PostController::class, 'store'], ['as' => 'posts.store']);
$routes->get('posts/edit/(:num)', [PostController::class, 'edit'], ['as' => 'posts.edit']);
$routes->post('posts/update/(:num)', [PostController::class, 'update'], ['as' => 'posts.update']);
$routes->get('posts/delete/(:num)', [PostController::class, 'delete'], ['as' => 'posts.delete']);
