<?php
declare(strict_types = 1);
namespace StefanFroemken\Sfmailshop\Domain\Model\Order;

/*
 * This file is part of the sfmailshop project.
 *
 * It is free software; you can redistribute it and/or modify it under
 * the terms of the GNU General Public License, either version 2
 * of the License, or any later version.
 *
 * For the full copyright and license information, please read the
 * LICENSE.txt file that was distributed with this source code.
 *
 * The TYPO3 project - inspiring people to share!
 */

use StefanFroemken\Sfmailshop\Domain\Model\Traits\MemberTrait;
use TYPO3\CMS\Extbase\DomainObject\AbstractEntity;
use TYPO3\CMS\Extbase\Persistence\ObjectStorage;

/**
 * This class contains all getter and setters for a Cart.
 */
class Cart extends AbstractEntity
{
    use MemberTrait;

    /**
     * @var \TYPO3\CMS\Extbase\Persistence\ObjectStorage<\StefanFroemken\Sfmailshop\Domain\Model\Order\Product>
     * @TYPO3\CMS\Extbase\Annotation\Validate("NotEmpty")
     */
    protected $products;

    public function __construct()
    {
        $this->products = new ObjectStorage();
    }

    /**
     * @return ObjectStorage
     */
    public function getProducts(): ObjectStorage
    {
        return $this->products;
    }

    /**
     * @param ObjectStorage $products
     */
    public function setProducts(ObjectStorage $products): void
    {
        $this->products = $products;
    }

    /**
     * @param Product $product
     */
    public function addProduct(Product $product): void
    {
        $this->products->attach($product);
    }

    /**
     * @param Product $product
     * @param int $position
     */
    public function removeProduct(Product $product, int $position = 0): void
    {
        $products = $this->getProducts();
        if (array_key_exists($product->getUid(), $products)) {
            if (array_key_exists($position, $this->products[$product->getUid()])) {
                unset($this->products[$product->getUid()][$position]);
            } else {
                unset($this->products[$product->getUid()]);
            }
        }
    }

    public function getPriceTotal(): float
    {
        $price = 0;
        foreach ($this->products as $orderedProduct) {
            $price += ((int)str_replace(',', '.', $orderedProduct->getPriceTotal())) * 100;
        }
        return $price / 100;
    }
}
