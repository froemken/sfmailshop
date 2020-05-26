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

use StefanFroemken\Sfmailshop\Domain\Model\Product;
use StefanFroemken\Sfmailshop\Domain\Model\Size;
use StefanFroemken\Sfmailshop\Domain\Model\Variant;
use TYPO3\CMS\Core\Utility\GeneralUtility;
use TYPO3\CMS\Extbase\Persistence\ObjectStorage;
use TYPO3\CMS\Extbase\Persistence\QueryInterface;
use TYPO3\CMS\Extbase\Persistence\QueryResultInterface;
use TYPO3\CMS\Extbase\Persistence\Repository;

/**
 * Methods to retrieve products from tx_sfmailshop_domain_model_product
 */
class ProductRepository extends Repository
{
    /**
     * @var SizeRepository
     */
    protected $sizeRepository;

    public function injectSizeRepository(SizeRepository $sizeRepository)
    {
        $this->sizeRepository = $sizeRepository;
    }

    /**
     * @var array
     */
    protected $defaultOrderings = [
        'isTopProduct' => QueryInterface::ORDER_DESCENDING,
        'title' => QueryInterface::ORDER_ASCENDING
    ];
}
