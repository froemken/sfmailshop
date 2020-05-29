<?php
declare(strict_types = 1);
namespace StefanFroemken\Sfmailshop\Controller;

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

use StefanFroemken\Sfmailshop\Configuration\ExtConf;
use StefanFroemken\Sfmailshop\Domain\Model\Order\Cart;
use TYPO3\CMS\Core\Mail\MailMessage;
use TYPO3\CMS\Core\Messaging\AbstractMessage;
use TYPO3\CMS\Core\Messaging\FlashMessage;
use TYPO3\CMS\Core\Utility\GeneralUtility;
use TYPO3\CMS\Extbase\Mvc\Controller\ActionController;
use TYPO3\CMS\Extbase\Mvc\View\ViewInterface;
use TYPO3\CMS\Frontend\Controller\TypoScriptFrontendController;

/**
 * The ShopController contains actions for list and detail view.
 */
class ShopController extends ActionController
{
    /**
     * @var \StefanFroemken\Sfmailshop\Domain\Repository\ProductRepository
     */
    protected $productRepository;

    /**
     * @var \StefanFroemken\Sfmailshop\Domain\Repository\VariantRepository
     */
    protected $variantRepository;

    public function __construct(
        \StefanFroemken\Sfmailshop\Domain\Repository\ProductRepository $productRepository,
        \StefanFroemken\Sfmailshop\Domain\Repository\VariantRepository $variantRepository
    ) {
        parent::__construct();
        $this->productRepository = $productRepository;
        $this->variantRepository = $variantRepository;
    }

    public function initializeView(ViewInterface $view)
    {
        $view->assign('host', GeneralUtility::getIndpEnv('TYPO3_REQUEST_HOST'));
        $view->assign('pageId', GeneralUtility::getIndpEnv($this->getTypoScriptFrontendController()->id));
    }

    public function listAction()
    {
        $this->view->assign('products', $this->productRepository->findAll());
    }

    public function cartAction()
    {
        $products = json_decode($this
            ->getTypoScriptFrontendController()
            ->fe_user
            ->getKey('ses', 'sfmailshop-products') ?? '', true) ?: [];

        if (!is_array($products)) {
            $this->addFlashMessage(
                'There are currently no products in cart',
                'No products found',
                AbstractMessage::NOTICE
            );
            $this->redirect('list');
        }

        /** @var Cart $cart */
        $cart = $this->objectManager->get(Cart::class);
        foreach ($products as $productUid => $variants) {
            foreach ($variants as $variantUid => $variantConfiguration) {
                /** @var \StefanFroemken\Sfmailshop\Domain\Model\Order\Product $orderedProduct */
                $orderedProduct = $this->objectManager->get(
                    \StefanFroemken\Sfmailshop\Domain\Model\Order\Product::class
                );
                /** @var \StefanFroemken\Sfmailshop\Domain\Model\Product $realProduct */
                $realProduct = $this->productRepository->findByIdentifier((int)$productUid);
                $orderedProduct->setRealProduct($realProduct);

                for ($i = 0; $i < $variantConfiguration['amount']; $i++) {
                    if ($variantUid) {
                        /** @var \StefanFroemken\Sfmailshop\Domain\Model\Order\Variant $orderedVariant */
                        $orderedVariant = $this->objectManager->get(
                            \StefanFroemken\Sfmailshop\Domain\Model\Order\Variant::class
                        );
                        /** @var \StefanFroemken\Sfmailshop\Domain\Model\Variant $realVariant */
                        $realVariant = $this->variantRepository->findByIdentifier((int)$variantUid);
                        $orderedVariant->setRealVariant($realVariant);
                        $orderedProduct->addVariant($orderedVariant);
                    } else {
                        $orderedProduct->setAmount($orderedProduct->getAmount() + 1);
                    }
                }
                $cart->addProduct($orderedProduct);
            }
        }

        $this->view->assign('cart', $cart);
    }

    public function clearCartAction()
    {
        $this->addFlashMessage(
            'Cart was cleared',
            'Cart cleared',
            AbstractMessage::OK
        );
        $this->getTypoScriptFrontendController()->fe_user->setKey(
            'ses',
            'sfmailshop-products',
            json_encode([])
        );
        $this->getTypoScriptFrontendController()->fe_user->storeSessionData();
        $this->redirect('cart', 'Shop');
    }

    /**
     * @param Cart $cart
     */
    public function checkoutAction(Cart $cart)
    {
        /** @var ExtConf $extConf */
        $extConf = $this->objectManager->get(ExtConf::class);
        $this->view->assign('cart', $cart);
        $mail = GeneralUtility::makeInstance(MailMessage::class);
        $mail->setFrom($extConf->getEmailFromAddress(), $extConf->getEmailFromName());
        $mail->setTo($extConf->getEmailToAddress(), $extConf->getEmailToName());
        $mail->setSubject($extConf->getEmailSubject());
        $mail->setBody($this->view->render(), 'text/html');
        $mail->send();
        $this->addFlashMessage('We have received your order', FlashMessage::OK);
        if (isset($GLOBALS['TSFE'])) {
            $pageUid = $GLOBALS['TSFE']->id;
            $this->cacheService->clearPageCache([$pageUid]);
        }
        $this->redirect('list', 'Shop');
    }

    public function getTypoScriptFrontendController(): TypoScriptFrontendController
    {
        return $GLOBALS['TSFE'];
    }
}
