<?php

$apiRoute = new Zend_Controller_Router_Route(
    'api/people',
    array(
        'module'     => 'API',
        'controller' => 'people',
        'action'     => 'index'
    )
);

$router->addRoute('default', $apiRoute);

$apiRoute = new Zend_Controller_Router_Route(
    'api/people/:id',
    array(
        'module'     => 'API',
        'controller' => 'people',
        'action'     => 'get'
    )
);

$router->addRoute('id', $apiRoute);

?>
