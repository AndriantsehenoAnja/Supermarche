<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
/* $routes->get('/', 'Home::index');
$routes->get('/produits', 'ProduitController::index');
$routes->get('/produit/(:num)', 'ProduitController::show/$1');
 */


// Caisse
$routes->get('/', 'Caisse::index');
$routes->post('caisse/valider', 'Caisse::valider');