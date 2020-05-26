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

use StefanFroemken\Sfmailshop\Domain\Model\Color;
use StefanFroemken\Sfmailshop\Domain\Model\Size;
use TYPO3\CMS\Extbase\DomainObject\AbstractEntity;

/**
 * This class contains all getter and setters for a Variant.
 */
class Variant extends AbstractEntity
{
    /**
     * Selected color in Cart
     *
     * @var \StefanFroemken\Sfmailshop\Domain\Model\Color|null
     */
    protected $selectedColor;

    /**
     * Selected size in Cart
     *
     * @var \StefanFroemken\Sfmailshop\Domain\Model\Size|null
     */
    protected $selectedSize;

    /**
     * @var \StefanFroemken\Sfmailshop\Domain\Model\Variant
     */
    protected $realVariant;

    /**
     * @return Color|null
     */
    public function getSelectedColor(): ?Color
    {
        return $this->selectedColor;
    }

    /**
     * @param Color|null $selectedColor
     */
    public function setSelectedColor(?Color $selectedColor): void
    {
        $this->selectedColor = $selectedColor;
    }

    /**
     * @return Size|null
     */
    public function getSelectedSize(): ?Size
    {
        return $this->selectedSize;
    }

    /**
     * @param Size|null $selectedSize
     */
    public function setSelectedSize(?Size $selectedSize): void
    {
        $this->selectedSize = $selectedSize;
    }

    /**
     * @return \StefanFroemken\Sfmailshop\Domain\Model\Variant
     */
    public function getRealVariant(): \StefanFroemken\Sfmailshop\Domain\Model\Variant
    {
        return $this->realVariant;
    }

    /**
     * @param \StefanFroemken\Sfmailshop\Domain\Model\Variant $realVariant
     */
    public function setRealVariant(\StefanFroemken\Sfmailshop\Domain\Model\Variant $realVariant): void
    {
        $this->realVariant = $realVariant;
    }
}
