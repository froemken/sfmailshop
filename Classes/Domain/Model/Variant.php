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
use StefanFroemken\Sfmailshop\Domain\Repository\SizeRepository;
use TYPO3\CMS\Core\Utility\GeneralUtility;
use TYPO3\CMS\Extbase\DomainObject\AbstractEntity;
use TYPO3\CMS\Extbase\Object\ObjectManager;
use TYPO3\CMS\Extbase\Persistence\ObjectStorage;

/**
 * This class contains all getter and setters for a Variant.
 */
class Variant extends AbstractEntity
{
    use Typo3ColumnsTrait;

    /**
     * @var string
     */
    protected $title = '';

    /**
     * @var string
     */
    protected $price = '';

    /**
     * @var int
     */
    protected $stock = 0;

    /**
     * @var \TYPO3\CMS\Extbase\Persistence\ObjectStorage<\StefanFroemken\Sfmailshop\Domain\Model\Color>
     */
    protected $color;

    /**
     * Original value from Database
     *
     * @var string
     */
    protected $size = '';

    /**
     * Manual filled sizes
     *
     * @var null|array|Size[]
     */
    protected $sizes = null;

    /**
     * @var bool
     */
    protected $hasLettering = false;

    /**
     * @var \StefanFroemken\Sfmailshop\Domain\Model\Product
     */
    protected $product;

    public function __construct()
    {
        $this->color = new ObjectStorage();
        $this->sizes = new ObjectStorage();
    }

    /**
     * @return string
     */
    public function getTitle(): string
    {
        if (empty($this->title) && $this->product instanceof Product) {
            return $this->product->getTitle();
        }
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
     * @return float
     */
    public function getPrice(): float
    {
        if (empty($this->price) && $this->product instanceof Product) {
            return $this->product->getPrice();
        }
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
     * @return array
     */
    public function getColor(): array
    {
        $colors = $this->color->toArray();
        usort($colors, function($a, $b) {
            if ($a->getTitle() === $b->getTitle()) {
                return 0;
            }
            return ($a->getTitle() < $b->getTitle()) ? -1 : 1;
        });
        return $colors;
    }

    /**
     * @param \TYPO3\CMS\Extbase\Persistence\ObjectStorage $color
     */
    public function setColor(ObjectStorage $color): void
    {
        $this->color = $color;
    }

    /**
     * @return string
     */
    public function getSize(): string
    {
        return $this->size;
    }

    /**
     * @param string $size
     */
    public function setSize(string $size): void
    {
        $this->size = $size;
    }

    /**
     * @return array|Size[]
     */
    public function getSizes(): array
    {
        if ($this->sizes === null) {
            $this->sizes = [];
            $objectManager = GeneralUtility::makeInstance(ObjectManager::class);
            $sizeRepository = $objectManager->get(SizeRepository::class);
            $sizeUids = GeneralUtility::intExplode(',', $this->getSize(), true);
            foreach ($sizeUids as $sizeUid) {
                $size = $sizeRepository->findByIdentifier($sizeUid);
                if ($size instanceof Size) {
                    $this->sizes[] = $sizeRepository->findByIdentifier($sizeUid);
                }
            }
        }
        return $this->sizes;
    }

    /**
     * @return bool
     */
    public function isHasLettering(): bool
    {
        return $this->hasLettering;
    }

    /**
     * @param bool $hasLettering
     */
    public function setHasLettering(bool $hasLettering): void
    {
        $this->hasLettering = $hasLettering;
    }

    /**
     * @return Product
     */
    public function getProduct(): Product
    {
        return $this->product;
    }

    /**
     * @param Product $product
     */
    public function setProduct(Product $product): void
    {
        $this->product = $product;
    }
}
