<?php
return array(
    'cmf_routes' => array(
        'simple' => array(
            'options' => array(
                'defaults' => array(
                    'controller' => 'Simple\Controller\IndexController',
                    'action'     => 'index'
                ),
            ),
        ),
    ),
    
    'cmf_admin_routes' => array(
        'simple' => array(
            'type'     => 'literal',
            'options'  => array(
                'route'    => '/',
                'defaults' => array(
                    'controller' => 'SimpleAdmin\Controller\IndexController',
                    'action'     => 'index'
                ),
            )
        ),
    ),
    
    'view_manager' => array(
        'template_path_stack' => array(
            __DIR__ . '/../view'
        ),
    ),
    
    'doctrine' => array(
        'driver' => array(
            'simple' => array(
                'paths' =>  array(__DIR__ . '/../src/Simple/Entity')
            ),
            'orm_default' => array(
                'drivers' => array(
                    'Simple\Entity' => 'simple'
                ),      
            ),
        ),
    ),
);
