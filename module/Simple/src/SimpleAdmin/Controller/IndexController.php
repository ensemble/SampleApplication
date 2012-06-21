<?php

namespace SimpleAdmin\Controller;

use Zend\Mvc\Controller\ActionController;
use Zend\View\Model\ViewModel;

use Doctrine\ORM\EntityManager;
use SimpleAdmin\Form\Text as TextForm;

class IndexController extends ActionController
{
    /**
     * @var EntityManager
     */
    protected $em;

    public function indexAction()
    {
        $page = $this->event->getRouteMatch()->getParam('page');
        $id   = $page->getModuleId();
        
        $text = $this->getEntityManager()->find('Simple\Entity\Text', $id);
        $form = new TextForm;
        $form->populateValues(array(
            'id'      => $text->getId(),
            'content' => $text->getContent()
        ));
        
        $request = $this->getRequest();
        $form->setData($request->post());
        
        if ($request->isPost()) {
            $content = $request->post()->get('content');
            $text->setContent($content);
            $this->em->flush();
        }
        
        return new ViewModel(array(
            'form' => $form,
            'text' => $text
        ));
    }
    
    protected function getEntityManager()
    {
        if (null === $this->em) {
            $this->em = $this->getServiceLocator('Doctrine\ORM\EntityManager');
        }
        
        return $this->em;
    }
}
