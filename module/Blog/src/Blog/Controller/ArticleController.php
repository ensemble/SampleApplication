<?php

namespace Blog\Controller;

use Zend\Mvc\Controller\ActionController;
use Zend\View\Model\ViewModel;

use Doctrine\ORM\EntityManager;
use Blog\Repository\Article as ArticleRepository;
use SlmCmfKernel\Entity\Page;

use Blog\Exception;

class ArticleController extends ActionController
{
    const DEFAULT_COUNT = 10;
    
    /**
     * @var ArticleRepository
     */
    protected $repository;
    
    /**
     *
     * @var int
     */
    protected $blogId;
    
    public function __construct (EntityManager $em)
    {
        $this->repository = $em->getRepository('Blog\Entity\Article');
    }
    
    public function indexAction()
    {
        $blog       = $this->getBlogId();
        $config     = $this->getServiceLocator()->get('config');
        $count      = isset($config['blog']['index_count']) ? $config['blog']['index_count'] : self::DEFAULT_COUNT;
        
        $articles   = $this->getRepository()->getLatest($blog, $count);
        $params     = array('articles' => $articles);
        
        $this->events()->trigger(__FUNCTION__ . '.post', $params);
        return new ViewModel($params);
    }
    
    public function viewAction()
    {
        $blog       = $this->getBlogId();
        $routeMatch = $this->getEvent()->getRouteMatch();
        $id         = $routeMatch->getParam('id');
        $article    = $this->getRepository()->find($id);
        
        if (null === $article) {
            $this->getResponse()->setStatusCode(404);
            return;
        }
        
        $params = array('article' => $article);
        
        $this->events()->trigger(__FUNCTION__ . '.post', $params);
        return new ViewModel($params);
    }
    
    public function archiveAction()
    {
        $blog       = $this->getBlogId();
        $routeMatch = $this->getEvent()->getRouteMatch();
        $page       = (int) $routeMatch->getParam('page');
        $config     = $this->getServiceLocator()->get('config');
        $count      = isset($config['blog']['archive_count']) ? $config['blog']['archive_count'] : self::DEFAULT_COUNT;
        
        $articles   = $this->getRepository()->getArchived($blog, $page, $count);
        $params     = array(
            'page'     => $page,
            'articles' => $articles
        );
        
        $this->events()->trigger(__FUNCTION__ . '.post', $params);
        return new ViewModel($params);
    }
    
    public function feedAction()
    {
        return new ViewModel();
    }
    
    /**
     * Get article repository
     * 
     * @return ArticleRepository
     */
    protected function getRepository()
    {
        return $this->repository;
    }

    /**
     * Get id for blog instance
     * 
     * @return int
     */
    protected function getBlogId()
    {
        if (null === $this->blogId) {
            $page = $this->getEvent()->getParam('page', null);
            
            if ($page instanceof Page) {
                $this->blogId = $page->getModuleId();
            }
        }
        
        return $this->blogId;
    }
}
