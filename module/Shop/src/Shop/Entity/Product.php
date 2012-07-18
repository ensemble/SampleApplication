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

namespace Shop\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Description of Product
 *
 * @package    Carmen
 * @subpackage Shop\Entity
 * @author     Jurian Sluiman <jurian@soflomo.com>
 *
 * @ORM\Entity(repositoryClass="Shop\Repository\Product")
 * @ORM\Table(name="shop_product")
 */
class Product
{
	/**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue
     * @var int
     */
    protected $id;

    /**
     * @ORM\Column
     * @var string
     */
    protected $title;

    /**
     * @ORM\Column(type="text")
     * @var string
     */
    protected $description;

    /**
     * @ORM\Column(type="integer")
     * @var integer
     */
    protected $price;

    /**
     * @ORM\ManyToOne(targetEntity="Day", inversedBy="products")
     * @ORM\JoinColumn(name="day_id", referencedColumnName="id")
     * @var Day
     */
    protected $day;

    public function getId()
    {
        return $this->id;
    }

    public function getTitle()
    {
        return $this->title;
    }

    public function setTitle($title)
    {
        $this->title = $title;
    }

    public function getDescription()
    {
        return $this->description;
    }

    public function setDescription($description)
    {
        $this->description = $description;
    }

    public function getPrice()
    {
        return $this->price;
    }

    public function setPrice($price)
    {
        $this->price = $price;
    }

    public function getDay()
    {
        return $this->day;
    }

    public function setDay(Day $day)
    {
        $this->day = $day;
    }
}