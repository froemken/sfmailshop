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

use SJBR\StaticInfoTables\Domain\Model\AbstractEntity;
use TYPO3\CMS\Extbase\Persistence\ObjectStorage;

/**
 * This is a special product used for checkout.
 * It has a slightly different handling of the variants
 */
class Product extends AbstractEntity
{
    /**
     * @var int
     */
    protected $amount = 0;

    /**
     * @var \StefanFroemken\Sfmailshop\Domain\Model\Product
     */
    protected $realProduct;

    /**
     * These are the variants from Database
     *
     * @var \TYPO3\CMS\Extbase\Persistence\ObjectStorage<\StefanFroemken\Sfmailshop\Domain\Model\Order\Variant>
     */
    protected $variants;

    public function __construct()
    {
        $this->variants = new ObjectStorage();
    }

    /**
     * @return int
     */
    public function getAmount(): int
    {
        $amount = $this->amount;
        if ($this->getVariants()->count()) {
            $amount = $this->getVariants()->count();
        }

        return $amount;
    }

    /**
     * @param int $amount
     */
    public function setAmount(int $amount): void
    {
        $this->amount = $amount;
    }

    /**
     * @return \StefanFroemken\Sfmailshop\Domain\Model\Product
     */
    public function getRealProduct(): \StefanFroemken\Sfmailshop\Domain\Model\Product
    {
        return $this->realProduct;
    }

    /**
     * @param \StefanFroemken\Sfmailshop\Domain\Model\Product $realProduct
     */
    public function setRealProduct(\StefanFroemken\Sfmailshop\Domain\Model\Product $realProduct): void
    {
        $this->realProduct = $realProduct;
    }

    /**
     * @return ObjectStorage|Variant[]
     */
    public function getVariants(): ObjectStorage
    {
        return $this->variants;
    }

    /**
     * @param ObjectStorage $variants
     */
    public function setVariants(ObjectStorage $variants): void
    {
        $this->variants = $variants;
    }

    /**
     * @param Variant $variant
     */
    public function addVariant(Variant $variant)
    {
        $this->variants->attach($variant);
    }

    /**
     * @param Variant $variant
     */
    public function removeVariant(Variant $variant)
    {
        $this->variants->detach($variant);
    }

    public function getTitle(): string
    {
        $title = $this->getRealProduct()->getTitle();
        // This clone is a must have. Without it, it will come to side effects within f:for
        $variants = clone $this->getVariants();
        if ($variants->count()) {
            $variants->rewind();

            /** @var Variant $variant */
            $variant = $variants->current();
            if ($variant->getRealVariant()->getTitle()) {
                $title = $variant->getRealVariant()->getTitle();
            }
        }

        return $title;
    }

    /**
     * Get price of product or, if exists, the price of the first found variant.
     * As all variants here are the same for the product, it's no problem, to check only the
     * first variant.
     *
     * This method will return the original price as it exists in DB.
     * No formatting will be applied here. So it can be 12 or 12,45 or 12.45
     *
     * @return float
     */
    public function getPrice(): float
    {
        $price = $this->getRealProduct()->getPrice();
        // This clone is a must have. Without it, it will come to side effects within f:for
        $variants = clone $this->getVariants();
        if ($variants->count()) {
            $variants->rewind();

            /** @var Variant $variant */
            $variant = $variants->current();
            if ($variant->getRealVariant()->getPrice()) {
                $price = $variant->getRealVariant()->getPrice();
            }
        }

        return $price;
    }

    public function getPriceTotal(): float
    {
        $priceAsInteger = (int)($this->getPrice() * 100);
        return (float)($priceAsInteger * $this->getAmount()) / 100;
    }
}
