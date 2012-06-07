<?php
return array(
    'cmf_routes' => array(
        'blog' => array(
            'type'     => 'literal',
            'options'  => array(
                'route'    => '',
                'defaults' => array(
                    'controller' => 'Blog\Controller\ArticleController',
                    'action'     => 'index'
                ),
            ),
            'child_routes' => array(
                'article' => array(
                    'type'    => 'segment',
                    'options' => array(
                        'route'    => '/article/:id/:title',
                        'defaults' => array(
                            'controller' => 'Blog\Controller\ArticleController',
                            'action'     => 'view'
                        ),
                        'constraints' => array(
                            'id' => '[0-9]+',
                        ),
                    ),
                ),
                'archive' => array(
                    'type'    => 'segment',
                    'options' => array(
                        'route'    => '/archive[/:page]',
                        'defaults' => array(
                            'controller' => 'Blog\Controller\ArticleController',
                            'action'     => 'archive',
                            'page'       => '1'
                        ),
                        'constraints' => array(
                            'page' => '[0-9]+',
                        ),
                    ),
                ),
                'feed' => array(
                    'type'    => 'segment',
                    'options' => array(
                        'route'    => '/feed[/:type]',
                        'defaults' => array(
                            'controller' => 'Blog\Controller\ArticleController',
                            'action'     => 'feed',
                            'type'       => 'rss'
                        ),
                        'constraints' => array(
                            'type' => '[a-z]+',
                        ),
                    ),
                ),
            ),
        ),
    ),
    
    'view_manager' => array(
        'template_path_stack' => array(
            __DIR__ . '/../view'
        ),
    ),
    
    'di' => array(
        'instance' => array(
            'Blog\Controller\ArticleController' => array(
                'parameters' => array(
                    'em' => 'doctrine_em'
                ),
            ),
            
            // Set Doctrine annotations in driver chain
            'orm_driver_chain' => array(
                'parameters' => array(
                    'drivers' => array(
                        'blog' => array(
                            'class'     => 'Doctrine\ORM\Mapping\Driver\AnnotationDriver',
                            'namespace' => 'Blog\Entity',
                            'paths'     => array(__DIR__ . '/../src/Blog/Entity')
                        ),
                    ),
                ),
            ),
        ),
    ),
);
