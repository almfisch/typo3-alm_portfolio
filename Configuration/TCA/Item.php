<?php
if (!defined ('TYPO3_MODE')) {
	die ('Access denied.');
}

$GLOBALS['TCA']['tx_almportfolio_domain_model_item'] = array(
	'ctrl' => $GLOBALS['TCA']['tx_almportfolio_domain_model_item']['ctrl'],
	'interface' => array(
		'showRecordFieldList' => 'sys_language_uid, l10n_parent, l10n_diffsource, hidden, title, teaser, description, client, url, cat, images',
	),
	'types' => array(
		'1' => array('showitem' => 'sys_language_uid;;;;1-1-1, l10n_parent, l10n_diffsource, hidden;;1, title, teaser, description;;;richtext:rte_transform[mode=ts_links], client, url, cat, images, --div--;LLL:EXT:cms/locallang_ttc.xlf:tabs.access, starttime, endtime'),
	),
	'palettes' => array(
		'1' => array('showitem' => ''),
	),
	'columns' => array(

		'sys_language_uid' => array(
			'exclude' => 1,
			'label' => 'LLL:EXT:lang/locallang_general.xlf:LGL.language',
			'config' => array(
				'type' => 'select',
				'renderType' => 'selectSingle',
				'foreign_table' => 'sys_language',
				'foreign_table_where' => 'ORDER BY sys_language.title',
				'items' => array(
					array('LLL:EXT:lang/locallang_general.xlf:LGL.allLanguages', -1),
					array('LLL:EXT:lang/locallang_general.xlf:LGL.default_value', 0)
				),
			),
		),
		'l10n_parent' => array(
			'displayCond' => 'FIELD:sys_language_uid:>:0',
			'exclude' => 1,
			'label' => 'LLL:EXT:lang/locallang_general.xlf:LGL.l18n_parent',
			'config' => array(
				'type' => 'select',
				'items' => array(
					array('', 0),
				),
				'foreign_table' => 'tx_almportfolio_domain_model_item',
				'foreign_table_where' => 'AND tx_almportfolio_domain_model_item.pid=###CURRENT_PID### AND tx_almportfolio_domain_model_item.sys_language_uid IN (-1,0)',
			),
		),
		'l10n_diffsource' => array(
			'config' => array(
				'type' => 'passthrough',
			),
		),

		't3ver_label' => array(
			'label' => 'LLL:EXT:lang/locallang_general.xlf:LGL.versionLabel',
			'config' => array(
				'type' => 'input',
				'size' => 30,
				'max' => 255,
			)
		),

		'hidden' => array(
			'exclude' => 1,
			'label' => 'LLL:EXT:lang/locallang_general.xlf:LGL.hidden',
			'config' => array(
				'type' => 'check',
			),
		),
		'starttime' => array(
			'exclude' => 1,
			'l10n_mode' => 'mergeIfNotBlank',
			'label' => 'LLL:EXT:lang/locallang_general.xlf:LGL.starttime',
			'config' => array(
				'type' => 'input',
				'size' => 13,
				'max' => 20,
				'eval' => 'datetime',
				'checkbox' => 0,
				'default' => 0,
				'range' => array(
					'lower' => mktime(0, 0, 0, date('m'), date('d'), date('Y'))
				),
			),
		),
		'endtime' => array(
			'exclude' => 1,
			'l10n_mode' => 'mergeIfNotBlank',
			'label' => 'LLL:EXT:lang/locallang_general.xlf:LGL.endtime',
			'config' => array(
				'type' => 'input',
				'size' => 13,
				'max' => 20,
				'eval' => 'datetime',
				'checkbox' => 0,
				'default' => 0,
				'range' => array(
					'lower' => mktime(0, 0, 0, date('m'), date('d'), date('Y'))
				),
			),
		),

		'title' => array(
			'exclude' => 1,
			'label' => 'LLL:EXT:alm_portfolio/Resources/Private/Language/locallang_db.xlf:tx_almportfolio_domain_model_item.title',
			'config' => array(
				'type' => 'input',
				'size' => 30,
				'eval' => 'trim,required'
			),
		),
		'teaser' => array(
			'exclude' => 1,
			'label' => 'LLL:EXT:alm_portfolio/Resources/Private/Language/locallang_db.xlf:tx_almportfolio_domain_model_item.teaser',
			'config' => array(
				'type' => 'text',
				'cols' => 30,
				'rows' => 2,
				'eval' => 'trim'
			)
		),
		'description' => array(
			'exclude' => 1,
			'label' => 'LLL:EXT:alm_portfolio/Resources/Private/Language/locallang_db.xlf:tx_almportfolio_domain_model_item.description',
			'config' => array(
				'type' => 'text',
				'cols' => 40,
				'rows' => 15,
				'eval' => 'trim',
			),
			'defaultExtras' => 'richtext[strong|emphasis]:rte_transform[ts]',
		),
		'client' => array(
			'exclude' => 1,
			'label' => 'LLL:EXT:alm_portfolio/Resources/Private/Language/locallang_db.xlf:tx_almportfolio_domain_model_item.client',
			'config' => array(
				'type' => 'input',
				'size' => 30,
				'eval' => 'trim'
			),
		),
		'url' => array(
			'exclude' => 1,
			'label' => 'LLL:EXT:alm_portfolio/Resources/Private/Language/locallang_db.xlf:tx_almportfolio_domain_model_item.url',
			'config' => array(
				'type' => 'input',
				'size' => 30,
				'eval' => 'trim'
			),
		),
		'cat' => array(
			'exclude' => 1,
			'label' => 'LLL:EXT:alm_portfolio/Resources/Private/Language/locallang_db.xlf:tx_almportfolio_domain_model_item.cat',
			'config' => array(
				'type' => 'select',
				'renderType' => 'selectTree',
				'foreign_table' => 'tx_almportfolio_domain_model_cat',
				'foreign_table_where' => ' AND tx_almportfolio_domain_model_cat.pid = ###CURRENT_PID###',
				'subType' => 'db',
				'treeConfig' => array(
					'parentField' => 'parent_cat',
					'appearance' => array(
						'expandAll' => TRUE,
						'showHeader' => FALSE,
						'maxLevels' => 99,
					),
				),
				'size' => 5,
				'autoSizeMax' => 20,
				'minitems' => 1,
				'maxitems' => 99,
			)
		),
		'images' => array(
			'exclude' => 1,
			'label' => 'LLL:EXT:alm_portfolio/Resources/Private/Language/locallang_db.xlf:tx_almportfolio_domain_model_item.images',
			'config' => \TYPO3\CMS\Core\Utility\ExtensionManagementUtility::getFileFieldTCAConfig(
				'images',
				array('maxitems' => 99),
				$GLOBALS['TYPO3_CONF_VARS']['GFX']['imagefile_ext']
			),
		),

	),
);
