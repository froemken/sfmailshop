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
use StefanFroemken\Sfmailshop\Domain\Model\Product;
use StefanFroemken\Sfmailshop\Domain\Model\Variant;
use TYPO3\CMS\Extbase\Domain\Model\FileReference;
use TYPO3\CMS\Extbase\Persistence\ObjectStorage;

/**
 * Test case.
 */
class ProductTest extends UnitTestCase
{
    /**
     * @var Product
     */
    protected $subject;

    public function setUp()
    {
        $this->subject = new Product();
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
    public function setTitleSetsTitle()
    {
        $this->subject->setTitle('My Article');
        $this->assertSame(
            'My Article',
            $this->subject->getTitle()
        );
    }

    /**
     * @test
     */
    public function getArticleNumberInitiallyReturnsEmptyString()
    {
        $this->assertSame(
            '',
            $this->subject->getArticleNumber()
        );
    }

    /**
     * @test
     */
    public function setArticleNumberSetsArticleNumber()
    {
        $this->subject->setArticleNumber('MA01');
        $this->assertSame(
            'MA01',
            $this->subject->getArticleNumber()
        );
    }

    /**
     * @test
     */
    public function getDescriptionInitiallyReturnsEmptyString()
    {
        $this->assertSame(
            '',
            $this->subject->getDescription()
        );
    }

    /**
     * @test
     */
    public function setDescriptionSetsDescription()
    {
        $this->subject->setDescription('What a fine product');
        $this->assertSame(
            'What a fine product',
            $this->subject->getDescription()
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

    public function priceDataProvider()
    {
        return [
            'price as string without floating numbers' => ['12', 12.00],
            'price as string with floating numbers 00' => ['12,00', 12.00],
            'price as string with floating numbers 99' => ['12,99', 12.99],
            'price as string with floating numbers' => ['12,34', 12.34],
            'price as string with floating divider' => ['13.12', 13.12],
        ];
    }

    /**
     * @test
     * @dataProvider priceDataProvider
     *
     * @param string $price
     * @param float $expectedPrice
     */
    public function setPriceSetsPrice(string $price, float $expectedPrice)
    {
        $this->subject->setPrice($price);
        $this->assertSame(
            $expectedPrice,
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
        $this->subject->setStock(124);
        $this->assertSame(
            124,
            $this->subject->getStock()
        );
    }

    /**
     * @test
     */
    public function getVariantsInitiallyReturnsEmptyObjectStorage()
    {
        $this->assertEquals(
            new ObjectStorage(),
            $this->subject->getVariants()
        );
    }

    /**
     * @test
     */
    public function setVariantsSetsVariants()
    {
        $variant = new Variant();
        $variants = new ObjectStorage();
        $variants->attach($variant);

        $this->subject->setVariants($variants);
        $this->assertSame(
            $variants,
            $this->subject->getVariants()
        );
    }

    /**
     * @test
     */
    public function addVariantAddsVariantToObjectStorage()
    {
        $variant = new Variant();
        $variants = new ObjectStorage();
        $variants->attach($variant);

        $this->subject->addVariant($variant);
        $this->assertEquals(
            $variants,
            $this->subject->getVariants()
        );
    }

    /**
     * @test
     */
    public function removeVariantRemovesVariantFromObjectStorage()
    {
        $variant = new Variant();
        $variants = new ObjectStorage();
        $variants->attach($variant);

        $this->subject->setVariants($variants);
        $this->subject->removeVariant($variant);
        $this->assertEquals(
            $variants,
            $this->subject->getVariants()
        );
    }

    /**
     * @test
     */
    public function getImagesInitiallyReturnsEmptyObjectStorage()
    {
        $this->assertEquals(
            new ObjectStorage(),
            $this->subject->getImages()
        );
    }

    /**
     * @test
     */
    public function setImageSetsImages()
    {
        $fileReference = new FileReference();
        $fileReferences = new ObjectStorage();
        $fileReferences->attach($fileReference);

        $this->subject->setImages($fileReferences);
        $this->assertSame(
            $fileReferences,
            $this->subject->getImages()
        );
    }
}
