<?php
declare(strict_types = 1);
namespace StefanFroemken\Sfmailshop\Middleware;

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

use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Server\MiddlewareInterface;
use Psr\Http\Server\RequestHandlerInterface;
use TYPO3\CMS\Core\Http\JsonResponse;
use TYPO3\CMS\Core\TimeTracker\TimeTracker;
use TYPO3\CMS\Core\Utility\GeneralUtility;
use TYPO3\CMS\Frontend\Controller\TypoScriptFrontendController;

/**
 * Add a product of sfmailshop to cart
 */
class AddToCartMiddleware implements MiddlewareInterface
{
    /**
     * Add a product to cart
     *
     * @param ServerRequestInterface $request
     * @param RequestHandlerInterface $handler
     * @return ResponseInterface
     */
    public function process(ServerRequestInterface $request, RequestHandlerInterface $handler): ResponseInterface
    {
        $pluginRequest = $request->getParsedBody()['tx_sfmailshop'] ?? $request->getQueryParams()['tx_sfmailshop'] ?? null;
        if (!isset($pluginRequest['method'])) {
            return $handler->handle($request);
        }

        $productUid = (int)$pluginRequest['productUid'];
        $variantUid = (int)$pluginRequest['variantUid'];
        $products = json_decode($this
            ->getTypoScriptFrontendController()
            ->fe_user
            ->getKey('ses', 'sfmailshop-products') ?? '', true) ?: [];

        if (!is_array($products)) {
            return new JsonResponse([
                'message' => 'Product could not be added to cart.',
                'status' => 'Error'
            ]);
        }

        if (!isset($products[$productUid][$variantUid]['amount'])) {
            $products[$productUid][$variantUid]['amount'] = 0;
        }

        switch ($pluginRequest['method']) {
            case 'addToCart':
                $products[$productUid][$variantUid]['amount'] += 1;
                break;
            case 'removeFromCart':
                if ($products[$productUid][$variantUid]['amount'] > 0) {
                    $products[$productUid][$variantUid]['amount'] -= 1;
                }
                if (empty($products[$productUid][$variantUid]['amount'])) {
                    unset($products[$productUid][$variantUid]);
                }
                break;
            default:
                // There is no default
        }

        $this->getTypoScriptFrontendController()->fe_user->setKey(
            'ses',
            'sfmailshop-products',
            json_encode($products)
        );
        $this->getTypoScriptFrontendController()->fe_user->storeSessionData();

        return new JsonResponse([
            'message' => 'Product was added to cart',
            'status' => 'Ok'
        ]);
    }

    protected function getTypoScriptFrontendController(): TypoScriptFrontendController
    {
        return $GLOBALS['TSFE'];
    }
}
