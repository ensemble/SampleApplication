<?php
return array(
    'modules' => array(
        'DoctrineModule',
        'DoctrineORMModule',
        'SlmCmfKernel',
        'SlmCmfKernelDoctrineOrm',
        'SlmCmfUtils',
        'SlmCmfAdmin',
        'Simple',
        //'Blog',
        //'Bacon',
        //'Twitter',
        'Application',
    ),
    'module_listener_options' => array( 
        'config_glob_paths'    => array(
            'config/autoload/{,*.}{global,local}.php',
        ),
        'config_cache_enabled' => false,
        'cache_dir'            => 'data/cache',
        'module_paths' => array(
            './module',
            './vendor',
        ),
    ),
    'service_manager' => array(
        'use_defaults' => true,
        'factories'    => array(
        ),
    ),
);
