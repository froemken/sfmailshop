<?php
declare(strict_types = 1);
namespace StefanFroemken\Sfmailshop\Domain\Model\Traits;

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

/**
 * Trait for properties, getters and setters of TYPO3 columns
 */
trait Typo3ColumnsTrait
{
    /**
     * @var string
     */
    protected $crdate;

    /**
     * @var \DateTime
     */
    protected $tstamp;

    /**
     * @var bool
     */
    protected $hidden = false;

    /**
     * @var int
     */
    protected $cruserId = 0;

    /**
     * @return string
     */
    public function getCrdate(): string
    {
        return $this->crdate;
    }

    /**
     * @param string $crdate
     */
    public function setCrdate(string $crdate): void
    {
        $this->crdate = $crdate;
    }

    /**
     * @return \DateTime
     */
    public function getTstamp(): \DateTime
    {
        return $this->tstamp;
    }

    /**
     * @param \DateTime $tstamp
     */
    public function setTstamp(\DateTime $tstamp): void
    {
        $this->tstamp = $tstamp;
    }

    /**
     * @return bool
     */
    public function isHidden(): bool
    {
        return $this->hidden;
    }

    /**
     * @param bool $hidden
     */
    public function setHidden(bool $hidden): void
    {
        $this->hidden = $hidden;
    }

    /**
     * @return int
     */
    public function getCruserId(): int
    {
        return $this->cruserId;
    }

    /**
     * @param int $cruserId
     */
    public function setCruserId(int $cruserId): void
    {
        $this->cruserId = $cruserId;
    }
}