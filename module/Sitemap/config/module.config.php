<?php
return array(
    'router' => array(
        'routes' => array(
            'sitemap' => array(
                'type' => 'literal',
                'options' => array(
                    'route'    => '/sitemap',
                    'defaults' => array(
                        'controller' => 'Sitemap\Controller\SitemapController',
                        'action'     => 'index',
                    ),
                ),
                'may_terminate' => true,
                'child_routes' => array(
                    'xml' => array(
                        'type' => 'literal',
                        'options' => array(
                            'route'    => '/xml',
                            'defaults' => array(
                                'action'     => 'xml',
                            ),
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
);
