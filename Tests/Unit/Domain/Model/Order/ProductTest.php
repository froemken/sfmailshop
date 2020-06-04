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
use StefanFroemken\Sfmailshop\Domain\Model\Order\Product;
use StefanFroemken\Sfmailshop\Domain\Model\Order\Variant;
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
    public function getAmountInitiallyReturnsZero()
    {
        $this->assertSame(
            0,
            $this->subject->getAmount()
        );
    }

    /**
     * @test
     */
    public function getAmountReturnsAmountOfRelatedVariants()
    {
        $variants = new ObjectStorage();
        $variants->attach(new Variant());
        $variants->attach(new Variant());
        $this->subject->setVariants($variants);
        $this->assertSame(
            2,
            $this->subject->getAmount()
        );
    }

    /**
     * @test
     */
    public function setAmountSetsAmount()
    {
        $this->subject->setAmount(123);
        $this->assertSame(
            123,
            $this->subject->getAmount()
        );
    }

    /**
     * @test
     */
    public function setRealProductSetsRealProduct()
    {
        $realProduct = new \StefanFroemken\Sfmailshop\Domain\Model\Product();
        $this->subject->setRealProduct($realProduct);
        $this->assertSame(
            $realProduct,
            $this->subject->getRealProduct()
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
        $variants = new ObjectStorage();
        $this->subject->setVariants($variants);
        $this->assertEquals(
            $variants,
            $this->subject->getVariants()
        );
    }

    /**
     * @test
     */
    public function getTitleReturnsTitleOfRealProduct()
    {
        $realProduct = new \StefanFroemken\Sfmailshop\Domain\Model\Product();
        $realProduct->setTitle('Product Title');
        $this->subject->setRealProduct($realProduct);
        $this->assertSame(
            'Product Title',
            $this->subject->getTitle()
        );
    }

    /**
     * @test
     */
    public function getTitleReturnsTitleOfVariant()
    {
        $realVariant = new \StefanFroemken\Sfmailshop\Domain\Model\Variant();
        $realVariant->setTitle('Variant Title');
        $variant = new Variant();
        $variant->setRealVariant($realVariant);
        $variants = new ObjectStorage();
        $variants->attach($variant);

        $this->subject->setRealProduct(new \StefanFroemken\Sfmailshop\Domain\Model\Product());
        $this->subject->setVariants($variants);
        $this->assertSame(
            'Variant Title',
            $this->subject->getTitle()
        );
    }

    /**
     * @test
     */
    public function getPriceReturnsPriceOfRealProduct()
    {
        $realProduct = new \StefanFroemken\Sfmailshop\Domain\Model\Product();
        $realProduct->setPrice('0,01');
        $this->subject->setRealProduct($realProduct);
        $this->assertSame(
            0.01,
            $this->subject->getPrice()
        );
    }

    /**
     * @test
     */
    public function getPriceReturnsPriceOfVariant()
    {
        $realVariant = new \StefanFroemken\Sfmailshop\Domain\Model\Variant();
        $realVariant->setPrice('12,34');
        $variant = new Variant();
        $variant->setRealVariant($realVariant);
        $variants = new ObjectStorage();
        $variants->attach($variant);

        $this->subject->setRealProduct(new \StefanFroemken\Sfmailshop\Domain\Model\Product());
        $this->subject->setVariants($variants);
        $this->assertSame(
            12.34,
            $this->subject->getPrice()
        );
    }

    /**
     * @test
     */
    public function getPriceTotalReturnsPriceOfAmountOfRealProducts()
    {
        $realProduct = new \StefanFroemken\Sfmailshop\Domain\Model\Product();
        $realProduct->setPrice('0,01');
        $this->subject->setRealProduct($realProduct);
        $this->subject->setAmount(3);
        $this->assertSame(
            0.03,
            $this->subject->getPriceTotal()
        );
    }

    /**
     * @test
     */
    public function getPriceTotalReturnsSumOfPriceOfVariants()
    {
        $realVariant1 = new \StefanFroemken\Sfmailshop\Domain\Model\Variant();
        $realVariant1->setPrice('12,34');
        $variant1 = new Variant();
        $variant1->setRealVariant($realVariant1);

        $realVariant2 = new \StefanFroemken\Sfmailshop\Domain\Model\Variant();
        $realVariant2->setPrice('12,34');
        $variant2 = new Variant();
        $variant2->setRealVariant($realVariant2);

        $variants = new ObjectStorage();
        $variants->attach($variant1);
        $variants->attach($variant2);

        $this->subject->setRealProduct(new \StefanFroemken\Sfmailshop\Domain\Model\Product());
        $this->subject->setVariants($variants);
        $this->assertSame(
            24.68,
            $this->subject->getPriceTotal()
        );
    }

}
