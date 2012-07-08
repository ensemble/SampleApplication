<?php

namespace Sitemap\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;

class SitemapController extends AbstractActionController
{
    public function indexAction()
    {

    }

    public function xmlAction()
    {
        // Explicitly set type to text/xml, otherwise it's text/html
        $this->getResponse()->getHeaders()->addHeaderLine(
            'Content-Type', 'text/xml'
        );

        // Only render the sitemap helper, without any layout
        $viewModel = new ViewModel();
        $viewModel->setTerminal(true);
        return $viewModel;
    }
}
