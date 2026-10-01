<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->get('/', 'Home::index');

// Keep implementation tools out of production and testing route collections.
$routes->environment('development', static function (RouteCollection $routes): void {
    $routes->get('dev', 'DevPages::index');
    $routes->get('dev-design-components', 'DevPages::components');
    $routes->get('dev-progress/(:segment)', 'DevPages::progress/$1');
    $routes->get('dev-landing-progress', 'DevPages::progress/home');
});
