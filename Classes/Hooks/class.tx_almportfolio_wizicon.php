<?php

class tx_almportfolio_wizicon
{
	/**
    * Processing the wizard items array
    *
    * @param array $wizardItems The wizard items
    * @return array Modified array with wizard items
    */
    function proc($wizardItems)
    {
    	$wizardItems['plugins_tx_almportfolio'] = array(
        	'icon' => \TYPO3\CMS\Core\Utility\ExtensionManagementUtility::extRelPath('alm_portfolio') . 'Resources/Public/Icons/tx_almportfolio_domain_model_wizard.gif',
            'title' => $GLOBALS['LANG']->sL('LLL:EXT:alm_portfolio/Resources/Private/Language/locallang_db.xlf:tx_almportfolio_ext_title'),
            'description' => $GLOBALS['LANG']->sL('LLL:EXT:alm_portfolio/Resources/Private/Language/locallang_db.xlf:tx_almportfolio_ext_description'),
            'params'=>'&defVals[tt_content][CType]=list&defVals[tt_content][list_type]=almportfolio_portfoliofront'
        );

        return $wizardItems;
    }
}

?>
