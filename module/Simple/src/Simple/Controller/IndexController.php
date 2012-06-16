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
    
    public function setEntityManager(EntityManager $em)
    {
        $this->repository = $em->getRepository('Simple\Entity\Text');
    }
    
    public function indexAction()
    {
        $id   = $this->getTextId();
        $text = $this->repository->find($id);
        
        return new ViewModel(array('text' => $text));
    }
    
    protected function getTextId()
    {
        return $this->getEvent()->getParam('page', null)->getModuleId();
    }
}
