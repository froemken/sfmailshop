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
use StefanFroemken\Sfmailshop\Domain\Model\Order\Cart;
use StefanFroemken\Sfmailshop\Domain\Model\Order\Product;
use StefanFroemken\Sfmailshop\Domain\Model\Order\Variant;
use TYPO3\CMS\Extbase\Persistence\ObjectStorage;

/**
 * Test case.
 */
class CartTest extends UnitTestCase
{
    /**
     * @var Cart
     */
    protected $subject;

    public function setUp()
    {
        $this->subject = new Cart();
    }

    public function tearDown()
    {
        unset($this->subject);
    }

    /**
     * @test
     */
    public function getProductsInitiallyReturnsEmptyObjectStorage()
    {
        $this->assertEquals(
            new ObjectStorage(),
            $this->subject->getProducts()
        );
    }

    /**
     * @test
     */
    public function setProductsSetsProducts()
    {
        $products = new ObjectStorage();
        $this->subject->setProducts($products);
        $this->assertSame(
            $products,
            $this->subject->getProducts()
        );
    }

    /**
     * @test
     */
    public function getPriceTotalSumsPricesOfProductsAndVariants()
    {
        $realProduct1 = new \StefanFroemken\Sfmailshop\Domain\Model\Product();
        $realProduct1->setPrice('12,34');
        $product1 = new Product();
        $product1->setAmount(3);
        $product1->setRealProduct($realProduct1);

        $variants1 = new ObjectStorage();
        $realVariant1 = new \StefanFroemken\Sfmailshop\Domain\Model\Variant();
        $realVariant1->setPrice('0,12');
        $variant1 = new Variant();
        $variant1->setRealVariant($realVariant1);
        $variants1->attach($variant1);
        $realVariant2 = new \StefanFroemken\Sfmailshop\Domain\Model\Variant();
        $realVariant2->setPrice('0,12');
        $variant2 = new Variant();
        $variant2->setRealVariant($realVariant2);
        $variants1->attach($variant2);
        $product2 = new Product();
        $product2->setRealProduct(new \StefanFroemken\Sfmailshop\Domain\Model\Product());
        $product2->setVariants($variants1);

        $variants2 = new ObjectStorage();
        $realVariant3 = new \StefanFroemken\Sfmailshop\Domain\Model\Variant();
        $realVariant3->setPrice('25,23');
        $variant3 = new Variant();
        $variant3->setRealVariant($realVariant3);
        $variants2->attach($variant3);
        $product3 = new Product();
        $product3->setRealProduct(new \StefanFroemken\Sfmailshop\Domain\Model\Product());
        $product3->setVariants($variants2);

        $products = new ObjectStorage();
        $products->attach($product1);
        $products->attach($product2);
        $products->attach($product3);
        $this->subject->setProducts($products);
        $this->assertSame(
            62.49,
            $this->subject->getPriceTotal()
        );
    }
}
