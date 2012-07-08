<?php
/**
 * Copyright (c) 2012 Soflomo http://soflomo.com.
 * All rights reserved.
 *
 * Redistribution and use in source and binary forms, with or without
 * modification, are permitted provided that the following conditions
 * are met:
 *
 *   * Redistributions of source code must retain the above copyright
 *     notice, this list of conditions and the following disclaimer.
 *
 *   * Redistributions in binary form must reproduce the above copyright
 *     notice, this list of conditions and the following disclaimer in
 *     the documentation and/or other materials provided with the
 *     distribution.
 *
 *   * Neither the names of the copyright holders nor the names of the
 *     contributors may be used to endorse or promote products derived
 *     from this software without specific prior written permission.
 *
 * THIS SOFTWARE IS PROVIDED BY THE COPYRIGHT HOLDERS AND CONTRIBUTORS
 * "AS IS" AND ANY EXPRESS OR IMPLIED WARRANTIES, INCLUDING, BUT NOT
 * LIMITED TO, THE IMPLIED WARRANTIES OF MERCHANTABILITY AND FITNESS
 * FOR A PARTICULAR PURPOSE ARE DISCLAIMED. IN NO EVENT SHALL THE
 * COPYRIGHT OWNER OR CONTRIBUTORS BE LIABLE FOR ANY DIRECT, INDIRECT,
 * INCIDENTAL, SPECIAL, EXEMPLARY, OR CONSEQUENTIAL DAMAGES (INCLUDING,
 * BUT NOT LIMITED TO, PROCUREMENT OF SUBSTITUTE GOODS OR SERVICES;
 * LOSS OF USE, DATA, OR PROFITS; OR BUSINESS INTERRUPTION) HOWEVER
 * CAUSED AND ON ANY THEORY OF LIABILITY, WHETHER IN CONTRACT, STRICT
 * LIABILITY, OR TORT (INCLUDING NEGLIGENCE OR OTHERWISE) ARISING IN
 * ANY WAY OUT OF THE USE OF THIS SOFTWARE, EVEN IF ADVISED OF THE
 * POSSIBILITY OF SUCH DAMAGE.
 *
 * @package     Ensemble\SampleApplication
 * @subpackage  Simple
 * @author      Jurian Sluiman <jurian@soflomo.com>
 * @copyright   2012 Soflomo http://soflomo.com.
 * @license     http://www.opensource.org/licenses/bsd-license.php  BSD License
 * @link        http://ensemble.github.com
 */

namespace SimpleAdmin\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;

use Doctrine\ORM\EntityManager;
use SimpleAdmin\Form\Text as TextForm;

class IndexController extends AbstractActionController
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
        $form->setData($request->getPost());

        if ($request->isPost()) {
            $content = $request->getPost()->get('content');
            $text->setContent($content);
            $this->getEntityManager()->flush();
        }

        return new ViewModel(array(
            'form' => $form,
            'text' => $text
        ));
    }

    protected function getEntityManager()
    {
        if (null === $this->em) {
            $this->em = $this->getServiceLocator()->get('Doctrine\ORM\EntityManager');
        }

        return $this->em;
    }
}
