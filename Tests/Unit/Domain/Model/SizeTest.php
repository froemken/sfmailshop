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
use StefanFroemken\Sfmailshop\Domain\Model\Size;

/**
 * Test case.
 */
class SizeTest extends UnitTestCase
{
    /**
     * @var Size
     */
    protected $subject;

    public function setUp()
    {
        $this->subject = new Size();
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
        $this->subject->setTitle('Big L');
        $this->assertSame(
            'Big L',
            $this->subject->getTitle()
        );
    }
}
