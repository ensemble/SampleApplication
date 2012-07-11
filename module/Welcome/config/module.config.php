<?php
return array(
    'cmf_routes' => array(
        'welcome' => array(
            'options' => array(
                'defaults' => array(
                    'controller' => 'Welcome\Controller\IndexController',
                    'action'     => 'index'
                ),
            ),
        ),
    ),
    'controllers'      => array(
        'invokables' => array(
            'Welcome\Controller\IndexController' => 'Welcome\Controller\IndexController',
        ),
    ),
    'view_manager' => array(
        'template_path_stack' => array(
            __DIR__ . '/../view'
        ),
    ),
);
