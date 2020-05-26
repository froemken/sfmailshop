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
}
