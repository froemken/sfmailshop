<?php
declare(strict_types = 1);
namespace StefanFroemken\Sfmailshop\Domain\Model;

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

use StefanFroemken\Sfmailshop\Domain\Model\Traits\Typo3ColumnsTrait;
use TYPO3\CMS\Extbase\Domain\Model\FileReference;
use TYPO3\CMS\Extbase\DomainObject\AbstractEntity;
use TYPO3\CMS\Extbase\Persistence\ObjectStorage;

/**
 * This is the product which you can order any which is in sync with product table
 */
class Product extends AbstractEntity
{
    use Typo3ColumnsTrait;

    /**
     * @var string
     */
    protected $title = '';

    /**
     * @var string
     */
    protected $articleNumber = '';

    /**
     * @var string
     */
    protected $description = '';

    /**
     * @var string
     */
    protected $price = '';

    /**
     * @var int
     */
    protected $stock = 0;

    /**
     * These are the variants from Database
     *
     * @var \TYPO3\CMS\Extbase\Persistence\ObjectStorage<\StefanFroemken\Sfmailshop\Domain\Model\Variant>
     */
    protected $variants;

    /**
     * @var \TYPO3\CMS\Extbase\Persistence\ObjectStorage<\TYPO3\CMS\Extbase\Domain\Model\FileReference>
     */
    protected $images;

    public function __construct()
    {
        $this->variants = new ObjectStorage();
        $this->images = new ObjectStorage();
    }

    /**
     * @return string
     */
    public function getTitle(): string
    {
        return $this->title;
    }

    /**
     * @param string $title
     */
    public function setTitle(string $title): void
    {
        $this->title = $title;
    }

    /**
     * @return string
     */
    public function getArticleNumber(): string
    {
        return $this->articleNumber;
    }

    /**
     * @param string $articleNumber
     */
    public function setArticleNumber(string $articleNumber): void
    {
        $this->articleNumber = $articleNumber;
    }

    /**
     * @return string
     */
    public function getDescription(): string
    {
        return $this->description;
    }

    /**
     * @param string $description
     */
    public function setDescription(string $description): void
    {
        $this->description = $description;
    }

    /**
     * @return float
     */
    public function getPrice(): float
    {
        return (float)str_replace(',', '.', $this->price);
    }

    /**
     * @param string $price
     */
    public function setPrice(string $price): void
    {
        $this->price = $price;
    }

    /**
     * @return int
     */
    public function getStock(): int
    {
        return $this->stock;
    }

    /**
     * @param int $stock
     */
    public function setStock(int $stock): void
    {
        $this->stock = $stock;
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

    /**
     * @return ObjectStorage|FileReference[]
     */
    public function getImages(): ObjectStorage
    {
        return $this->images;
    }

    /**
     * @param ObjectStorage $images
     */
    public function setImages(ObjectStorage $images): void
    {
        $this->images = $images;
    }
}
