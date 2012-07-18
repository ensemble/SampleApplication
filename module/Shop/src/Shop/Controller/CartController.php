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
 * @package     Carmen
 * @subpackage  Shop
 * @author      Jurian Sluiman <jurian@soflomo.com>
 * @copyright   2012 Soflomo http://soflomo.com.
 * @license     http://www.opensource.org/licenses/bsd-license.php  BSD License
 * @link        http://ensemble.github.com
 */

namespace Shop\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;

use Shop\Entity\Cart\Basket;
use Shop\Exception;

class CartController extends AbstractActionController
{
    public function indexAction()
    {
        $basket = Basket::load();

        return new ViewModel(array(
            'basket' => $basket
        ));
    }

    public function addAction()
    {
        if (!$this->getRequest()->isPost()) {
            throw new Exception\MethodNowAllowedException(
                'You can only add products to your cart with a POST request'
            );
        }

        $service = $this->getServiceLocator()->get('Shop\Service\Cart');
        $basket  = Basket::load();
        $items   = $this->getRequest()->getPost()->toArray();
        $service->addItemsFromPost($basket, $items);

        return $this->redirect()->toRoute('/cart');
    }

    public function removeAction()
    {
        if (!$this->getRequest()->isPost()) {
            throw new Exception\MethodNowAllowedException(
                'You can only remove products from your cart with a POST request'
            );
        }

        $id = $this->getRequest()->getPost('product');
        $em = $this->getServiceLocator()->get('Doctrine\ORM\EntityManager');
        $repository = $em->getRepository('Shop\Entity\Product');
        $product    = $repository->find($id);

        if (null === $product) {
            throw new Exception\ProductNotFoundException(
                sprintf('Product with id %s cannot be found', $id)
            );
        }

        $basket = Basket::load();
        $basket->removeProduct($product);

        return $this->redirect()->toRoute('/cart');
    }

    public function clearAction()
    {
        if (!$this->getRequest()->isPost()) {
            throw new Exception\MethodNowAllowedException(
                'You can only clear your cart with a POST request'
            );
        }

        Basket::clear();
        return $this->redirect()->toRoute('/cart');
    }

    public function previewAction()
    {
        if (!$this->getRequest()->isPost()) {
            throw new Exception\MethodNowAllowedException(
                'You can only clear your cart with a POST request'
            );
        }
    }
}
