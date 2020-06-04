<?php
namespace StefanFroemken\Sfmailshop\Tests\Unit\Domain\Model\Order;

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
use Nimut\TestingFramework\TestCase\UnitTestCase;
use StefanFroemken\Sfmailshop\Domain\Model\Color;
use StefanFroemken\Sfmailshop\Domain\Model\Order\Variant;
use StefanFroemken\Sfmailshop\Domain\Model\Size;

/**
 * Test case.
 */
class VariantTest extends UnitTestCase
{
    /**
     * @var Variant
     */
    protected $subject;

    public function setUp()
    {
        $this->subject = new Variant();
    }

    public function tearDown()
    {
        unset($this->subject);
    }

    /**
     * @test
     */
    public function getSelectedColorInitiallyReturnsNull()
    {
        $this->assertNull(
            $this->subject->getSelectedColor()
        );
    }

    /**
     * @test
     */
    public function setSelectedColorSetsSelectedColor()
    {
        $color = new Color();
        $this->subject->setSelectedColor($color);
        $this->assertSame(
            $color,
            $this->subject->getSelectedColor()
        );
    }

    /**
     * @test
     */
    public function getSelectedSizeInitiallyReturnsNull()
    {
        $this->assertNull(
            $this->subject->getSelectedSize()
        );
    }

    /**
     * @test
     */
    public function setSelectedSizeSetsSelectedSize()
    {
        $size = new Size();
        $this->subject->setSelectedSize($size);
        $this->assertSame(
            $size,
            $this->subject->getSelectedSize()
        );
    }

    /**
     * @test
     */
    public function getSelectedLetteringInitiallyReturnsEmptyString()
    {
        $this->assertSame(
            '',
            $this->subject->getSelectedLettering()
        );
    }

    /**
     * @test
     */
    public function setSelectedLetteringSetsSelectedLettering()
    {
        $this->subject->setSelectedLettering('Hello Stefan');
        $this->assertSame(
            'Hello Stefan',
            $this->subject->getSelectedLettering()
        );
    }

    /**
     * @test
     */
    public function setRealVariantSetsRealVariant()
    {
        $realVariant = new \StefanFroemken\Sfmailshop\Domain\Model\Variant();
        $this->subject->setRealVariant($realVariant);
        $this->assertSame(
            $realVariant,
            $this->subject->getRealVariant()
        );
    }
}
