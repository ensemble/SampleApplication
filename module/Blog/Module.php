<?php

namespace Blog;

use Zend\ModuleManager\Feature;
use Zend\EventManager\Event;

use Blog\Service\Article as ArticleService;

class Module implements
    Feature\AutoloaderProviderInterface,
     Feature\ServiceProviderInterface,
    Feature\ConfigProviderInterface
{
    public function getAutoloaderConfig()
    {
        return array(
            'Zend\Loader\ClassMapAutoloader' => array(
                __DIR__ . '/autoload_classmap.php',
            ),
            'Zend\Loader\StandardAutoloader' => array(
                'namespaces' => array(
                    __NAMESPACE__ => __DIR__ . '/src/' . __NAMESPACE__,
                ),
            ),
        );
    }
    
    public function getServiceConfiguration()
    {
        return array(
            'factories' => array(
                'Blog\Service\Article' => function ($sm) {
                    $di = $sm->get('Di');
                    $em = $di->get('doctrine_em');
                    
                    $repository = $em->getRepository('Blog\Entity\Article');
                    $service    = new ArticleService($repository);
                },
            ),
        );
    }
    
    public function getConfig()
    {
        return include __DIR__ . '/config/module.config.php';
    }
}
