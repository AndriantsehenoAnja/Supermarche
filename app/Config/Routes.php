<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->get('/', 'Home::index');
$routes->get('/produits', 'ProduitController::index');
$routes->get('/produit/(:num)', 'ProduitController::show/$1');

$routes->get('/achats', 'ProduitController::index');
$routes->post('/vent/enregistrer', 'VenteController::enregistrer');
