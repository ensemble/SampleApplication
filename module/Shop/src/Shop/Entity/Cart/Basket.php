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
 * @subpackage  Shop\Entity
 * @author      Jurian Sluiman <jurian@soflomo.com>
 * @copyright   2012 Soflomo http://soflomo.com.
 * @license     http://www.opensource.org/licenses/bsd-license.php  BSD License
 * @link        http://ensemble.github.com
 */

namespace Shop\Entity\Cart;

use Zend\Session\Container;
use Shop\Entity\Product;

class Basket
{
	const SESSION_NAME = 'BASKET_CONTAINER';
	protected $container;

	public function getItems()
	{
		return $this->container->items;
	}

	public function setItems(array $items)
	{
		$this->container->items = $items;
	}

	public function addItem(Item $item)
	{
		$items = $this->getItems();
		$found = false;

		foreach ($items as $basketItem) {
			if ($item->getProduct()->getId() === $basketItem->getProduct()->getId()) {
				$quantity = $basketItem->getQuantity()
				          + $item->getQuantity();
				$basketItem->setQuantity($quantity);

				$found = true;
				break;
			}
		}

		if (!$found) {
			$items[] = $item;
		}

		$this->setItems($items);
	}

	public function removeProduct(Product $product)
	{
		$found = false;
		foreach ($this->container->items as $i => $item) {
			if ($product === $item->getProduct()) {
				$found = true;
				break;
			}
		}

		if ($found) {
			unset($this->container->items[$i]);
		}

		return $found;
	}

	public function __construct(Container $container)
	{
		$this->container = $container;

		if (!isset($this->container->items)) {
			$this->container->items = array();
		}
	}

	public static function load()
	{
		$container = self::getContainer();
		return new self($container);
	}

	public static function clear()
	{
		$container = self::getContainer();
		$container->getManager()->getStorage()->clear();
	}

	protected static function getContainer()
	{
		return new Container(self::SESSION_NAME);
	}
}