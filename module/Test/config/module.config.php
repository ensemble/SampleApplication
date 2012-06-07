<?php
return array(
    'cmf_routes' => array(
        'test' => array(
            'options' => array(
                'defaults' => array(
                    'controller' => 'Test\Controller\IndexController',
                    'action'     => 'index'
                ),
            ),
        ),
    ),
    
    'cmf_admin_routes' => array(
        'test' => array(
            'type'     => 'literal',
            'options'  => array(
                'route'    => '/',
                'defaults' => array(
                    'controller' => 'TestAdmin\Controller\IndexController',
                    'action'     => 'index'
                ),
            ),
            'may_terminate' => true,
            'child_routes' => array(
                'sub' => array(
                    'type' => 'literal',
                    'options' => array(
                        'route' => 'sub',
                        'defaults' => array(
                            'controller' => 'TestAdmin\Controller\IndexController',
                            'action'     => 'sub'
                        )
                    )
                )
            )
        ),
    ),
    
    'view_manager' => array(
        'template_path_stack' => array(
            __DIR__ . '/../view'
        ),
    ),
);
