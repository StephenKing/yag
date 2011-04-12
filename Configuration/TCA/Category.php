<?php
if (!defined ('TYPO3_MODE')) {
    die ('Access denied.');
}

$TCA['tx_yag_domain_model_category'] = array(
    'ctrl' => $TCA['tx_yag_domain_model_category']['ctrl'],
    'interface' => array(
        'showRecordFieldList'   => 'name,description',
    ),
    'types' => array(
        '1' => array('showitem' => 'name,description'),
    ),
    'palettes' => array(
        '1' => array('showitem' => ''),
    ),
    'columns' => array(
        'sys_language_uid' => array(
            'exclude'           => 1,
            'label'             => 'LLL:EXT:lang/locallang_general.php:LGL.language',
            'config'            => array(
                'type'                  => 'select',
                'foreign_table'         => 'sys_language',
                'foreign_table_where'   => 'ORDER BY sys_language.title',
                'items' => array(
                    array('LLL:EXT:lang/locallang_general.php:LGL.allLanguages', -1),
                    array('LLL:EXT:lang/locallang_general.php:LGL.default_value', 0)
                ),
            )
        ),
        'l18n_parent' => array(
            'displayCond'   => 'FIELD:sys_language_uid:>:0',
            'exclude'       => 1,
            'label'         => 'LLL:EXT:lang/locallang_general.php:LGL.l18n_parent',
            'config'        => array(
                'type'          => 'select',
                'items'         => array(
                    array('', 0),
                ),
                'foreign_table' => 'tx_yag_domain_model_category',
                'foreign_table_where' => 'AND tx_yag_domain_model_category.uid=###REC_FIELD_l18n_parent### AND tx_yag_domain_model_category.sys_language_uid IN (-1,0)',
            )
        ),
        'l18n_diffsource' => array(
            'config'        =>array(
                'type'      =>'passthrough',
            )
        ),
        't3ver_label' => array(
            'displayCond'   => 'FIELD:t3ver_label:REQ:true',
            'label'         => 'LLL:EXT:lang/locallang_general.php:LGL.versionLabel',
            'config'        => array(
                'type'      =>'none',
                'cols'      => 27,
            )
        ),
        'hidden' => array(
            'exclude'   => 1,
            'label'     => 'LLL:EXT:lang/locallang_general.xml:LGL.hidden',
            'config'    => array(
                'type'  => 'check',
            )
        ),
        'name' => array(
            'exclude'   => 0,
            'label'     => 'LLL:EXT:yag/Resources/Private/Language/locallang_db.xml:tx_yag_domain_model_album.name',
            'config'    => array(
                'type' => 'input',
                'size' => 30,
                'eval' => 'trim'
            ),
        ),
        'description' => array(
            'exclude'   => 0,
            'label'     => 'LLL:EXT:yag/Resources/Private/Language/locallang_db.xml:tx_yag_domain_model_album.description',
            'config'    => array(
                'type' => 'text',
                'cols' => 40,
                'rows' => 15,
                'eval' => 'trim'
            ),
        ),
        'lft' => array(
            'exclude'   => 0,
            'label'     => 'left',
            'config'    => array(
                'type' => 'input',
                'size' => 4,
                'eval' => 'int'
            ),
        ),
        'rgt' => array(
            'exclude'   => 0,
            'label'     => 'right',
            'config'    => array(
                'type' => 'input',
                'size' => 4,
                'eval' => 'int'
            ),
        ),
        'root' => array(
            'exclude'   => 0,
            'label'     => 'right',
            'config'    => array(
                'type' => 'input',
                'size' => 4,
                'eval' => 'int'
            ),
        ),
    )
);

$TCA['tx_yag_domain_model_category']['ctrl']['hideTable'] = 1;
?>