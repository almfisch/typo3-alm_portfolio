<?php
namespace Alm\AlmPortfolio\Controller;

/***************************************************************
 *  Copyright notice
 *
 *  (c) 2014 Andi Platen <info@die-chiemseeler.de>, Die Chiemseeler - Werbeagentur Chiemgau
 *
 *  All rights reserved
 *
 *  This script is part of the TYPO3 project. The TYPO3 project is
 *  free software; you can redistribute it and/or modify
 *  it under the terms of the GNU General Public License as published by
 *  the Free Software Foundation; either version 3 of the License, or
 *  (at your option) any later version.
 *
 *  The GNU General Public License can be found at
 *  http://www.gnu.org/copyleft/gpl.html.
 *
 *  This script is distributed in the hope that it will be useful,
 *  but WITHOUT ANY WARRANTY; without even the implied warranty of
 *  MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 *  GNU General Public License for more details.
 *
 *  This copyright notice MUST APPEAR in all copies of the script!
 ***************************************************************/

/**
 *
 *
 * @package alm_portfolio
 * @license http://www.gnu.org/licenses/gpl.html GNU General Public License, version 3 or later
 *
 */
class ItemController extends \TYPO3\CMS\Extbase\Mvc\Controller\ActionController {

	/**
	 * itemRepository
	 *
	 * @var \Alm\AlmPortfolio\Domain\Repository\ItemRepository
	 * @inject
	 */
	protected $itemRepository;


	/**
	 * catRepository
	 *
	 * @var \Alm\AlmPortfolio\Domain\Repository\CatRepository
	 * @inject
	 */
	protected $catRepository;


	/**
	 * action initialize
	 *
	 * @return void
	 */
	function initializeAction()
	{
		$this->config = $this->configurationManager->getConfiguration(\TYPO3\CMS\Extbase\Configuration\ConfigurationManager::CONFIGURATION_TYPE_FRAMEWORK);
	}


	/**
	 * action list
	 *
	 * @return void
	 */
	function listAction()
	{
		if($this->settings['template']['list'])
		{
			$this->view->setTemplatePathAndFilename($this->settings['template']['list']);
		}
		if($this->settings['flexform']['templateFile'])
		{
			$this->view->setTemplatePathAndFilename($this->settings['flexform']['templateFile']);
		}

		$order = $this->settings['flexform']['order'];
		$orderDirection = $this->settings['flexform']['orderDirection'];
		$cat = $this->settings['flexform']['cat'];
		$excludeItems = $this->settings['flexform']['excludeItems'];
		$customSelect = $this->settings['flexform']['customSelect'];
		$logicalOperator = $this->settings['flexform']['logicalOperator'];
		$includeSub = $this->settings['flexform']['includeSub'];
		$random = $this->settings['flexform']['random'];
		$maxResults = $this->settings['flexform']['maxResults'];

		if(!empty($cat) && $includeSub != 'no')
		{
			$subCat = $this->catRepository->getSub($cat);
			if($subCat)
			{
				$logicalOperator = 'yes';
				if($includeSub == 'yesStart')
				{
					$cat .= ',' . $subCat;
				}
				else
				{
					$cat = $subCat;
				}
			}
		}

		if($customSelect)
		{
			$items = $this->itemRepository->findCustomItems($customSelect);
		}
		else if(!empty($cat))
		{
			$categories = $this->catRepository->getCategories($cat);
			$items = $this->itemRepository->findItems($order, $orderDirection, $cat, $logicalOperator, $random, $maxResults);

			if($excludeItems)
			{
				$excludeItems = explode(',', $excludeItems);
				foreach($items as $key => $value)
				{
					if(in_array($value->getUid(), $excludeItems))
					{
						unset($items[$key]);
					}
				}
			}
		}

		$this->view->assign('settings', $this->settings);
		if($categories)
		{
			$this->view->assign('categories', $categories);
		}
		if($items)
		{
			$this->view->assign('items', $items);
		}
	}


	/**
	 * action cloud
	 *
	 * @return void
	 */
	function cloudAction()
	{
		if($this->settings['template']['cloud'])
		{
			$this->view->setTemplatePathAndFilename($this->settings['template']['cloud']);
		}
		if($this->settings['flexform']['templateFile'])
		{
			$this->view->setTemplatePathAndFilename($this->settings['flexform']['templateFile']);
		}

		$cat = $this->settings['flexform']['cat'];

		$tags = $this->itemRepository->findCats($cat);

		$this->view->assign('settings', $this->settings);
		$this->view->assign('tags', $tags);
	}


	/**
	 * action detail
	 *
	 * @param integer $item
	 * @return void
	 */
	function detailAction($item = 0)
	{
		if($this->settings['template']['detail'])
		{
			$this->view->setTemplatePathAndFilename($this->settings['template']['detail']);
		}
		if($this->settings['flexform']['templateFile'])
		{
			$this->view->setTemplatePathAndFilename($this->settings['flexform']['templateFile']);
		}

		$item = $this->itemRepository->findByUid($item);

		if($item)
		{
			$this->view->assign('settings', $this->settings);
			$this->view->assign('item', $item);
		}
		else
		{
			$this->flashMessageContainer->add('Error: item not found');
		}
	}
}
?>
