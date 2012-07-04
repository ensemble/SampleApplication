<?php

namespace Welcome\Controller;

use Zend\Mvc\Controller\ActionController;
use Zend\View\Model\ViewModel;

class IndexController extends ActionController
{
    public function indexAction()
    {
        return new ViewModel;
    }
}
