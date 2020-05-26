<?php
return [
    'ctrl' => [
        'title' => 'LLL:EXT:sfmailshop/Resources/Private/Language/locallang_db.xlf:tx_sfmailshop_domain_model_variant',
        'label' => 'color',
        'label_alt' => 'size, price',
        'label_alt_force' => true,
        'tstamp' => 'tstamp',
        'crdate' => 'crdate',
        'cruser_id' => 'cruser_id',
        'hideTable' => true,
        'dividers2tabs' => true,
        'versioningWS' => true,
        'origUid' => 't3_origuid',
        'languageField' => 'sys_language_uid',
        'transOrigPointerField' => 'l10n_parent',
        'transOrigDiffSourceField' => 'l10n_diffsource',
        'delete' => 'deleted',
        'enablecolumns' => [
            'disabled' => 'hidden',
            'starttime' => 'starttime',
            'endtime' => 'endtime',
        ],
        'searchFields' => 'title',
        'iconfile' => 'EXT:sfmailshop/Resources/Public/Icons/tx_sfmailshop_domain_model_variant.png',
    ],
    'interface' => [
        'showRecordFieldList' => 'sys_language_uid, l10n_parent, l10n_diffsource, hidden, title, color, size, has_lettering, price, stock, product',
    ],
    'types' => [
        '1' => [
            'showitem' => '--palette--;;l10nHidden, l10n_parent, l10n_diffsource, title, color, size, has_lettering, price, stock,
            --div--;LLL:EXT:frontend/Resources/Private/Language/locallang_tca.xlf:pages.tabs.access, 
            --palette--;LLL:EXT:frontend/Resources/Private/Language/locallang_tca.xlf:pages.palettes.access;access'
        ],
    ],
    'palettes' => [
        'l10nHidden' => ['showitem' => 'sys_language_uid, hidden'],
        'access' => [
            'showitem' => 'starttime;LLL:EXT:frontend/Resources/Private/Language/locallang_ttc.xlf:starttime_formlabel,endtime;LLL:EXT:frontend/Resources/Private/Language/locallang_ttc.xlf:endtime_formlabel',
        ]
    ],
    'columns' => [
        'sys_language_uid' => [
            'exclude' => true,
            'label' => 'LLL:EXT:core/Resources/Private/Language/locallang_general.xlf:LGL.language',
            'config' => [
                'type' => 'select',
                'renderType' => 'selectSingle',
                'special' => 'languages',
                'items' => [
                    [
                        'LLL:EXT:core/Resources/Private/Language/locallang_general.xlf:LGL.allLanguages',
                        -1,
                        'flags-multiple'
                    ],
                ],
                'default' => 0,
            ]
        ],
        'l10n_parent' => [
            'displayCond' => 'FIELD:sys_language_uid:>:0',
            'exclude' => true,
            'label' => 'LLL:EXT:core/Resources/Private/Language/locallang_general.xlf:LGL.l18n_parent',
            'config' => [
                'type' => 'select',
                'renderType' => 'selectSingle',
                'items' => [
                    ['', 0],
                ],
                'foreign_table' => 'tx_sfmailshop_domain_model_variant',
                'foreign_table_where' => 'AND tx_sfmailshop_domain_model_variant.pid=###CURRENT_PID### AND tx_sfmailshop_domain_model_variant.sys_language_uid IN (-1,0)',
                'fieldWizard' => [
                    'selectIcons' => [
                        'disabled' => true,
                    ],
                ],
                'default' => 0,
            ]
        ],
        'l10n_diffsource' => [
            'config' => [
                'type' => 'passthrough',
                'default' => ''
            ]
        ],
        'hidden' => [
            'exclude' => true,
            'l10n_display' => 'defaultAsReadonly',
            'l10n_mode' => 'exclude',
            'label' => 'LLL:EXT:core/Resources/Private/Language/locallang_general.xlf:LGL.hidden',
            'config' => [
                'type' => 'check',
                'default' => 0
            ]
        ],
        'cruser_id' => [
            'label' => 'cruser_id',
            'config' => [
                'type' => 'passthrough'
            ]
        ],
        'pid' => [
            'label' => 'pid',
            'config' => [
                'type' => 'passthrough'
            ]
        ],
        'crdate' => [
            'label' => 'crdate',
            'config' => [
                'type' => 'passthrough',
            ]
        ],
        'tstamp' => [
            'label' => 'tstamp',
            'config' => [
                'type' => 'passthrough',
            ]
        ],
        'starttime' => [
            'exclude' => true,
            'l10n_display' => 'defaultAsReadonly',
            'l10n_mode' => 'exclude',
            'label' => 'LLL:EXT:frontend/Resources/Private/Language/locallang_ttc.xlf:starttime_formlabel',
            'config' => [
                'type' => 'input',
                'renderType' => 'inputDateTime',
                'size' => 16,
                'eval' => 'datetime,int',
                'default' => 0,
                'behaviour' => [
                    'allowLanguageSynchronization' => true,
                ],
            ]
        ],
        'endtime' => [
            'exclude' => true,
            'l10n_display' => 'defaultAsReadonly',
            'l10n_mode' => 'exclude',
            'label' => 'LLL:EXT:frontend/Resources/Private/Language/locallang_ttc.xlf:endtime_formlabel',
            'config' => [
                'type' => 'input',
                'renderType' => 'inputDateTime',
                'size' => 16,
                'eval' => 'datetime,int',
                'default' => 0,
                'behaviour' => [
                    'allowLanguageSynchronization' => true,
                ],
            ]
        ],
        'title' => [
            'exclude' => true,
            'label' => 'LLL:EXT:sfmailshop/Resources/Private/Language/locallang_db.xlf:tx_sfmailshop_domain_model_variant.title',
            'config' => [
                'type' => 'input',
                'size' => 30,
                'eval' => 'trim',
            ],
        ],
        'color' => [
            'exclude' => true,
            'label' => 'LLL:EXT:sfmailshop/Resources/Private/Language/locallang_db.xlf:tx_sfmailshop_domain_model_variant.color',
            'config' => [
                'type' => 'select',
                'renderType' => 'selectMultipleSideBySide',
                'foreign_table' => 'tx_sfmailshop_domain_model_color',
                'foreign_table_where' => 'ORDER BY tx_sfmailshop_domain_model_color.title ASC',
                'maxitems' => 9999,
                'default' => ''
            ],
        ],
        'size' => [
            'exclude' => true,
            'label' => 'LLL:EXT:sfmailshop/Resources/Private/Language/locallang_db.xlf:tx_sfmailshop_domain_model_variant.size',
            'config' => [
                'type' => 'select',
                'renderType' => 'selectMultipleSideBySide',
                'foreign_table' => 'tx_sfmailshop_domain_model_size',
                'foreign_table_where' => 'ORDER BY tx_sfmailshop_domain_model_size.sorting ASC',
                'maxitems' => 9999,
                'default' => ''
            ],
        ],
        'has_lettering' => [
            'exclude' => true,
            'label' => 'LLL:EXT:sfmailshop/Resources/Private/Language/locallang_db.xlf:tx_sfmailshop_domain_model_variant.has_lettering',
            'config' => [
                'type' => 'check',
                'default' => 0
            ],
        ],
        'price' => [
            'exclude' => true,
            'label' => 'LLL:EXT:sfmailshop/Resources/Private/Language/locallang_db.xlf:tx_sfmailshop_domain_model_variant.price',
            'config' => [
                'type' => 'input',
                'size' => 30,
                'eval' => 'trim',
            ],
        ],
        'stock' => [
            'exclude' => true,
            'label' => 'LLL:EXT:sfmailshop/Resources/Private/Language/locallang_db.xlf:tx_sfmailshop_domain_model_variant.stock',
            'config' => [
                'type' => 'input',
                'size' => 30,
                'eval' => 'int,trim',
                'default' => 0
            ],
        ],
        'product' => [
            'config' => [
                'type' => 'passthrough',
            ],
        ],
    ]
];
