<?php

namespace Application;

use Doctrine\Common\Annotations\AnnotationRegistry;

class Module
{
    public function init ()
    {
        $namespace = 'Gedmo\Mapping\Annotation';
        $lib       = 'vendor/gedmo/doctrine-extensions/lib/';
        AnnotationRegistry::registerAutoloadNamespace($namespace, $lib);
    }
    
    public function getConfig()
    {
        return include __DIR__ . '/config/module.config.php';
    }
}
