<?php

namespace Simple\Controller;

use Zend\Mvc\Controller\ActionController;
use Zend\View\Model\ViewModel;

use Doctrine\ORM\EntityRepository;
use Doctrine\ORM\EntityManager;

class IndexController extends ActionController
{
    /**
     * @var EntityRepository
     */
    protected $repository;
    
    public function indexAction()
    {
        $id   = $this->getTextId();
        $text = $this->getRepository()->find($id);
        
        return new ViewModel(array('text' => $text));
    }
    
    protected function getTextId()
    {
        return $this->getEvent()->getParam('page', null)->getModuleId();
    }
    
    protected function getRepository()
    {
        if (null === $this->repository) {
            $em = $this->getServiceLocator()->get('Doctrine\ORM\EntityManager');
            $this->repository = $em->getRepository('Simple\Entity\Text');
        }
        
        return $this->repository;
    }
}
