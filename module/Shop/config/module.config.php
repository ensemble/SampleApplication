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

use Shop\Service;

return array(
    'cmf_routes' => array(
        'shop' => array(
            'options' => array(
                'defaults' => array(
                    'controller' => 'Shop\Controller\ProductController',
                    'action'     => 'index'
                ),
            ),
            'child_routes' => array(
                'product' => array(
                    'type'    => 'segment',
                    'options' => array(
                        'route'    => '/day/:date',
                        'defaults' => array(
                            'action' => 'day'
                        ),
                    ),
                ),
                'cart' => array(
                    'type'    => 'literal',
                    'options' => array(
                        'route'    => '/cart',
                        'defaults' => array(
                            'controller' => 'Shop\Controller\CartController',
                            'action'     => 'index',
                        ),
                    ),
                    'may_terminate' => true,
                    'child_routes'  => array(
                        'add' => array(
                            'type'    => 'literal',
                            'options' => array(
                                'route'    => '/add',
                                'defaults' => array(
                                    'action' => 'add',
                                ),
                            ),
                        ),
                        'remove' => array(
                            'type'    => 'segment',
                            'options' => array(
                                'route'    => '/remove',
                                'defaults' => array(
                                    'action' => 'remove',
                                ),
                            ),
                        ),
                        'clear' => array(
                            'type'    => 'literal',
                            'options' => array(
                                'route'    => '/clear',
                                'defaults' => array(
                                    'action' => 'clear',
                                ),
                            ),
                        ),
                    )
                ),
            ),
        ),
    ),

    'cmf_admin_routes' => array(
        'shop' => array(
            'type' => 'literal',
            'options' => array(
                'route' => '/',
                'defaults' => array(
                    'controller' => 'ShopAdmin\Controller\OrderController',
                    'action'     => 'index'
                ),
            ),
            'may_terminate' => true,
            'child_routes'  => array(
                'order' => array(
                    'type'    => 'segment',
                    'options' => array(
                        'route'    => 'order/:id',
                        'defaults' => array(
                            'action' => 'view'
                        ),
                    ),
                ),
            ),
        ),
    ),

    'controllers' => array(
        'invokables' => array(
            'Shop\Controller\ProductController' => 'Shop\Controller\ProductController',
            'Shop\Controller\CartController'    => 'Shop\Controller\CartController',
        ),
    ),

    'view_manager' => array(
        'template_path_stack' => array(
            __DIR__ . '/../view'
        ),
    ),

    'service_manager' => array(
        'factories' => array(
            'Shop\Service\Cart' => function ($sm) {
                $em         = $sm->get('Doctrine\ORM\EntityManager');
                $repository = $em->getRepository('Shop\Entity\Product');
                $service    = new Service\Cart($repository);

                return $service;
            },
        ),
    ),

    'doctrine' => array(
        'driver' => array(
            'shop' => array(
                'paths' => array(__DIR__ . '/../src/Shop/Entity')
            ),
            'orm_default' => array(
                'drivers' => array(
                    'Shop\Entity' => 'shop'
                ),
            ),
        ),
    ),
);
