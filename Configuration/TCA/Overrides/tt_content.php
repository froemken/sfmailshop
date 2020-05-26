<?php
if (!defined('TYPO3_MODE')) {
    die('Access denied.');
}

\TYPO3\CMS\Extbase\Utility\ExtensionUtility::registerPlugin(
    'JWeiland.sfmailshop',
    'MailShop',
    'LLL:EXT:sfmailshop/Resources/Private/Language/locallang_db.xlf:plugin.sfmailshop.title'
);
