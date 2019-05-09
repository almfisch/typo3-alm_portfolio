<?php
if (!defined('TYPO3_MODE')) {
	die ('Access denied.');
}

\TYPO3\CMS\Extbase\Utility\ExtensionUtility::configurePlugin(
	'Alm.' . $_EXTKEY,
	'Portfoliofront',
	array(
		'Item' => 'list,cloud,menu,detail',
	),
	// non-cacheable actions
	array(
		'Item' => 'list,cloud,menu,detail',
	)
);

$TYPO3_CONF_VARS['EXTCONF']['cms']['db_layout']['addTables']['tx_almportfolio_domain_model_cat'][0] = array(
    'fList' => 'uid, title, parent_cat',
    'icon' => TRUE
);

$TYPO3_CONF_VARS['EXTCONF']['cms']['db_layout']['addTables']['tx_almportfolio_domain_model_item'][0] = array(
    'fList' => 'uid, title, cat',
    'icon' => TRUE
);
