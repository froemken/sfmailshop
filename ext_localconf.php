<?php
if (!defined('TYPO3_MODE')) {
    die('Access denied.');
}

call_user_func(function () {
    \TYPO3\CMS\Extbase\Utility\ExtensionUtility::configurePlugin(
        'StefanFroemken.Sfmailshop',
        'MailShop',
        [
            'Shop' => 'list, cart, clearCart, checkout',
        ],
        // non-cacheable actions
        [
            'Shop' => 'cart, clearCart, checkout',
        ]
    );

    // Register SVG Icon Identifier
    $svgIcons = [
        //'ext-sfmailshop-wizard-icon' => 'plugin_wizard.svg',
    ];
    // Register Bitmap Icon Identifier
    $bmpIcons = [
        //'ext-events2-calendar-single' => 'calendar_single.png',
    ];
    $iconRegistry = \TYPO3\CMS\Core\Utility\GeneralUtility::makeInstance(\TYPO3\CMS\Core\Imaging\IconRegistry::class);
    foreach ($svgIcons as $identifier => $fileName) {
        $iconRegistry->registerIcon(
            $identifier,
            \TYPO3\CMS\Core\Imaging\IconProvider\SvgIconProvider::class,
            ['source' => 'EXT:sfmailshop/Resources/Public/Icons/' . $fileName]
        );
    }
    foreach ($bmpIcons as $identifier => $fileName) {
        $iconRegistry->registerIcon(
            $identifier,
            \TYPO3\CMS\Core\Imaging\IconProvider\BitmapIconProvider::class,
            ['source' => 'EXT:sfmailshop/Resources/Public/Icons/' . $fileName]
        );
    }

    // add sfmailshop plugin to new element wizard
    \TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addPageTSConfig(
        '<INCLUDE_TYPOSCRIPT: source="FILE:EXT:sfmailshop/Configuration/TSconfig/ContentElementWizard.txt">'
    );
});
