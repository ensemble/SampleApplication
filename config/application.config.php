<?php
return array(
    'modules' => array(
        'ZfcAdmin',
        'DoctrineModule',
        'DoctrineORMModule',
        'Ensemble\Kernel',
        'Ensemble\KernelDoctrineOrm',
        'Ensemble\Utils',
        'Ensemble\Admin',
        'Welcome',
        'Simple',
        'Sitemap',
        'Application',
    ),
    'module_listener_options' => array(
        'config_glob_paths'    => array(
            'config/autoload/{,*.}{global,local}.php',
        ),
        'module_paths' => array(
            './module',
            './moduledev',
            './vendor',
        ),
    ),
);
