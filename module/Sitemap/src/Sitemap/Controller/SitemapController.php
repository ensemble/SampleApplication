<?php

namespace Sitemap\Controller;

use Zend\Mvc\Controller\ActionController;
use Zend\View\Model\ViewModel;

class SitemapController extends ActionController
{
    public function indexAction()
    {

    }

    public function xmlAction()
    {
        // Explicitly set type to text/xml, otherwise it's text/html
        $this->getResponse()->headers()->addHeaderLine(
            'Content-Type', 'text/xml'
        );

        // Only render the sitemap helper, without any layout
        $viewModel = new ViewModel();
        $viewModel->setTerminal(true);
        return $viewModel;
    }
}
