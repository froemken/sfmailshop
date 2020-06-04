<?php
namespace StefanFroemken\Sfmailshop\Tests\Unit\Domain\Model;

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
use StefanFroemken\Sfmailshop\Domain\Model\Product;
use StefanFroemken\Sfmailshop\Domain\Model\Variant;
use TYPO3\CMS\Extbase\Persistence\ObjectStorage;

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
    public function getTitleInitiallyReturnsEmptyString()
    {
        $this->assertSame(
            '',
            $this->subject->getTitle()
        );
    }

    /**
     * @test
     */
    public function getTitleReturnsTitleOfProduct()
    {
        $product = new Product();
        $product->setTitle('Products Title');
        $this->subject->setProduct($product);
        $this->assertSame(
            'Products Title',
            $this->subject->getTitle()
        );
    }

    /**
     * @test
     */
    public function setTitleSetsTitle()
    {
        $this->subject->setTitle('Variant');
        $this->assertSame(
            'Variant',
            $this->subject->getTitle()
        );
    }

    /**
     * @test
     */
    public function getPriceInitiallyReturnsEmptyFloat()
    {
        $this->assertSame(
            0.00,
            $this->subject->getPrice()
        );
    }

    /**
     * @test
     */
    public function getPriceReturnsPriceOfProduct()
    {
        $product = new Product();
        $product->setPrice('12,99');
        $this->subject->setProduct($product);
        $this->assertSame(
            12.99,
            $this->subject->getPrice()
        );
    }

    /**
     * @test
     */
    public function setPriceSetsPrice()
    {
        $this->subject->setPrice('0.01');
        $this->assertSame(
            0.01,
            $this->subject->getPrice()
        );
    }

    /**
     * @test
     */
    public function getStockInitiallyReturnsZero()
    {
        $this->assertSame(
            0,
            $this->subject->getStock()
        );
    }

    /**
     * @test
     */
    public function setStockSetsStock()
    {
        $this->subject->setStock(123);
        $this->assertSame(
            123,
            $this->subject->getStock()
        );
    }

    /**
     * @test
     */
    public function getColorInitiallyReturnsEmptyArray()
    {
        $this->assertEquals(
            [],
            $this->subject->getColor()
        );
    }

    /**
     * @test
     */
    public function getColorReturnsColorsSorted()
    {
        $colors = new ObjectStorage();
        $greenColor = new Color();
        $greenColor->setTitle('green');
        $colors->attach($greenColor);
        $blueColor = new Color();
        $blueColor->setTitle('blue');
        $colors->attach($blueColor);

        $sortedColors = new ObjectStorage();
        $sortedColors->attach($blueColor);
        $sortedColors->attach($greenColor);

        $this->subject->setColor($colors);
        $this->assertEquals(
            $sortedColors->toArray(),
            $this->subject->getColor()
        );
    }

    /**
     * @test
     */
    public function setColorSetsColor()
    {
        $color = new Color();
        $color->setTitle('green');
        $colors = new ObjectStorage();
        $colors->attach($color);

        $this->subject->setColor($colors);
        $this->assertSame(
            $colors->toArray(),
            $this->subject->getColor()
        );
    }

    /**
     * @test
     */
    public function getSizeInitiallyReturnsEmptyString()
    {
        $this->assertSame(
            '',
            $this->subject->getSize()
        );
    }

    /**
     * @test
     */
    public function setSizeSetsSize()
    {
        $this->subject->setSize('X,M,L');
        $this->assertSame(
            'X,M,L',
            $this->subject->getSize()
        );
    }

    /**
     * @test
     */
    public function isHasLetteringInitiallyReturnsFalse()
    {
        $this->assertFalse(
            $this->subject->isHasLettering()
        );
    }

    /**
     * @test
     */
    public function setHasLetteringSetsLettering()
    {
        $this->subject->setHasLettering(true);
        $this->assertTrue(
            $this->subject->isHasLettering()
        );
    }

    /**
     * @test
     */
    public function setProductSetsProduct()
    {
        $product = new Product();
        $this->subject->setProduct($product);
        $this->assertSame(
            $product,
            $this->subject->getProduct()
        );
    }
}
