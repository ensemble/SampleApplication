<?php
return array(
    'twitter' => array(
        'username' => ''
    ),
    
    'router' => array(
        'routes' => array(
            'twitter' => array(
                'type' => 'literal',
                'options' => array(
                    'route'    => '/twitter',
                    'defaults' => array(
                        'controller' => 'Twitter\Controller\TwitterController',
                        'action'     => 'index',
                    ),
                )
            ),
        ),
    ),
    
    'view_manager' => array(
        'strategies' => array(
            'ViewJsonStrategy',
        ),
    ),
    
    'di' => array(
        'instance' => array(
            'Twitter\Controller\TwitterController' => array(
                'parameters' => array(
                    'cache' => 'Zend\Cache\Storage\Adapter\Apc'
                ),
            ),
        ),
    ),
);
