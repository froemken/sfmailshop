<?php
declare(strict_types = 1);
namespace StefanFroemken\Sfmailshop\Domain\Repository;

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

use TYPO3\CMS\Extbase\Persistence\QueryInterface;
use TYPO3\CMS\Extbase\Persistence\Repository;

/**
 * Methods to retrieve products from tx_sfmailshop_domain_model_size
 */
class SizeRepository extends Repository
{
    /**
     * @var array
     */
    protected $defaultOrderings = [
        'sorting' => QueryInterface::ORDER_ASCENDING
    ];
}
