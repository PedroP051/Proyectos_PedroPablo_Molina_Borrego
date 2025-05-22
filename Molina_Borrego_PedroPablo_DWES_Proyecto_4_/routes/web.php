<?php

use Symfony\Component\Routing\Route;
use Symfony\Component\Routing\RouteCollection;

$routes = new RouteCollection();

$routes->add('homepage', new Route(BASE_PATH . '/', array('controller' => 'PageController', 'method'=>'home')));
$routes->add('transactions.show', new Route(BASE_PATH . '/transactions/{id}', array('controller' => 'TransactionController', 'method'=>'show'), array('id' => '[0-9]+')));
$routes->add('transactions.create', new Route(BASE_PATH . '/transactions/create', array('controller' => 'TransactionController', 'method'=>'create')));
$routes->add('transactions.store', new Route(BASE_PATH . '/transactions/store', array('controller' => 'TransactionController', 'method'=>'store')));
$routes->add('transactions.index', new Route(BASE_PATH . '/transactions/index', array('controller' => 'TransactionController', 'method'=>'index')));
$routes->add('transactions.update', new Route(BASE_PATH . '/transactions/update', array('controller' => 'TransactionController', 'method'=>'update')));
$routes->add('transactions.edit', new Route(BASE_PATH . '/transactions/edit', array('controller' => 'TransactionController', 'method'=>'edit')));

$routes->add('transactions.select_edit', new Route(
    BASE_PATH . '/transactions/select_edit/{id}',
    array('controller' => 'TransactionController', 'method' => 'selectEdit'),
    array('id' => '[0-9]+') // Validación: el ID debe ser un número
));
$routes->add('transactions.generar', new Route(BASE_PATH . '/transactions/generar', array('controller' => 'TransactionController', 'method'=>'generar')));
$routes->add('transactions.generarpdf', new Route(BASE_PATH . '/transactions/generarpdf', array('controller' => 'TransactionController', 'method'=>'generarpdf')));

//$routes->add('transactions.selectedit', new Route(BASE_PATH . '/transactions/selectedit', array('controller' => 'TransactionController', 'method'=>'select-edit')));
$routes->add('transactions.destroySelect', new Route(BASE_PATH . '/transactions/destroySelect', ['controller' => 'TransactionController', 'method' => 'destroySelect']));
$routes->add('transactions.destroy', new Route(BASE_PATH . '/transactions/destroy', ['controller' => 'TransactionController', 'method' => 'destroy']));

?>                                                  
