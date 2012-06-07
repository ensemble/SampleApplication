<?php

namespace TestAdmin\Controller;

use Zend\Mvc\Controller\ActionController,
    Zend\View\Model\ViewModel;

class IndexController extends ActionController
{
    public function indexAction()
    {
        return new ViewModel();
    }
    
    public function subAction()
    {
        return new ViewModel();
    }
}
