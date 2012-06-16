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
    
    'di' => array(
        'instance' => array(
            'Simple\Controller\IndexController' => array(
                'parameters' => array(
                    'em' => 'doctrine_em'
                ),
            ),
            'SimpleAdmin\Controller\IndexController' => array(
                'parameters' => array(
                    'em' => 'doctrine_em'
                ),
            ),
            
            // Set Doctrine annotations in driver chain
            'orm_driver_chain' => array(
                'parameters' => array(
                    'drivers' => array(
                        'simple' => array(
                            'class'     => 'Doctrine\ORM\Mapping\Driver\AnnotationDriver',
                            'namespace' => 'Simple\Entity',
                            'paths'     => array(__DIR__ . '/../src/Simple/Entity')
                        ),
                    ),
                ),
            ),
        ),
    ),
);
