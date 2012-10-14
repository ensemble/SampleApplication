<?php
return array(
    'modules' => array(
        'DoctrineModule',
        'DoctrineORMModule',
        'Ensemble\Kernel',
        'Ensemble\KernelDoctrineOrm',
        'Ensemble\Utils',
        'ZfcAdmin',
        'ZfcBase',
        'ZfcUser',
        'ZfcUserDoctrineORM',
        'BjyAuthorize',
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
