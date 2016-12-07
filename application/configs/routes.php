<?php

$apiRoute = new Zend_Controller_Router_Route(
    'api/people',
    array(
        'module'     => 'API',
        'controller' => 'people',
        'action'     => 'index'
    )
);

$router->addRoute('apipeople', $apiRoute);




$apiRoute = new Zend_Controller_Router_Route(
    'api/people/:idp',
    array(
        'module'     => 'API',
        'controller' => 'people',
        'action'     => 'get'
    )
);

$router->addRoute('idp', $apiRoute);



$apiRoute = new Zend_Controller_Router_Route(
    'api/states',
    array(
        'module'     => 'API',
        'controller' => 'states',
        'action'     => 'index'
    )
);

$router->addRoute('apistates', $apiRoute);



$apiRoute = new Zend_Controller_Router_Route(
    'api/states/:ids',
    array(
        'module'     => 'API',
        'controller' => 'states',
        'action'     => 'get'
    )
);


$router->addRoute('ids', $apiRoute);




$apiRoute = new Zend_Controller_Router_Route(
    'api/visits',
    array(
        'module'     => 'API',
        'controller' => 'visits',
        'action'     => 'index'
    )
);

$router->addRoute('apivisits', $apiRoute);





$apiRoute = new Zend_Controller_Router_Route(
    'api/visits/:idv',
    array(
        'module'     => 'API',
        'controller' => 'visits',
        'action'     => 'get'
    )
);

$router->addRoute('idv', $apiRoute);


?>
