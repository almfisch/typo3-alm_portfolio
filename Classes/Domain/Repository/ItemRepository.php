<?php
namespace Alm\AlmPortfolio\Domain\Repository;

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
class ItemRepository extends \TYPO3\CMS\Extbase\Persistence\Repository
{
	public function findItems($order = 'uid', $orderDirection = 'ASC', $cat = 0, $logicalOperator = 'and', $random = 'no', $maxResults = 0)
	{
    	$query = $this->createQuery();
    	$constraints = array();

    	if($cat != 0)
    	{
    		$cat = explode(',', $cat);
    		$cCat = array();
    		foreach($cat as $id)
    		{
    			$cCat[] = $query->contains('cat', $id);
    		}
    		if($logicalOperator == 'and')
    		{
    			$constraints[] = $query->logicalAnd($query->logicalAnd($cCat));
    		}
    		else
    		{
    			$constraints[] = $query->logicalAnd($query->logicalOr($cCat));
    		}
    	}

    	if(!empty($constraints))
    	{
        	$query->matching(
        		$query->logicalAnd($constraints)
        	);
        }

        if($order == '')
        {
        	$order = 'uid';
        }
        if($order != '')
        {
        	$order = explode(',', $order);
        	$cOrder = array();
        	foreach($order as $field)
    		{
    			if($orderDirection == 'ASC')
    			{
    				$cOrder[$field] = \TYPO3\CMS\Extbase\Persistence\QueryInterface::ORDER_ASCENDING;
    			}
    			else
    			{
    				$cOrder[$field] = \TYPO3\CMS\Extbase\Persistence\QueryInterface::ORDER_DESCENDING;
    			}
    		}

    		$query->setOrderings($cOrder);
        }

        if($maxResults > 0 && $random == 'no')
        {
        	$maxResults = intval($maxResults);
        	$query->setLimit($maxResults);
        }

        if($random == 'yes')
        {
        	$result = $query->execute()->toArray();

        	shuffle($result);
        	if($maxResults > 0)
        	{
        		$delKeys = count($result) - $maxResults;
        		if($delKeys > 0)
        		{
        			for($i = 1; $i <= $delKeys; $i++)
        			{
        				unset($result[$i]);
        			}
        		}
        	}
        }
        else
        {
        	$result = $query->execute();
        }


		//\TYPO3\CMS\Extbase\Utility\DebuggerUtility::var_dump($result);
        //$this->debugQuery($query->execute(), 1);


        return $result;
    }




    public function findCustomItems($items = 0)
	{
		$query = $this->createQuery();

		if($items != 0)
    	{
    		$items = explode(',', $items);
    	}

		$query->matching($query->in('uid', $items));

		$result = $query->execute()->toArray();

		$resArr = array();
		foreach($result as $key => $value)
		{
			if(in_array($value->getUid(), $items))
			{
				$v = array_search($value->getUid(), $items);
				$resArr[$v] = $value;
				unset($result[$key]);
			}
		}
		ksort($resArr);

        return $resArr;
	}




    public function findCats($cat = 0)
	{
		$query = $this->createQuery();

		$result = $query->execute();

        return $result;
	}




	public function debugQuery(\TYPO3\CMS\Extbase\Persistence\Generic\QueryResult $queryResult, $explainOutput = FALSE)
	{
  		$GLOBALS['TYPO3_DB']->debugOuput = 2;
  		if($explainOutput)
  		{
    		$GLOBALS['TYPO3_DB']->explainOutput = true;
  		}
  		$GLOBALS['TYPO3_DB']->store_lastBuiltQuery = true;
  		$queryResult->toArray();
  		\TYPO3\CMS\Extbase\Utility\DebuggerUtility::var_dump($GLOBALS['TYPO3_DB']->debug_lastBuiltQuery);

  		$GLOBALS['TYPO3_DB']->store_lastBuiltQuery = false;
  		$GLOBALS['TYPO3_DB']->explainOutput = false;
  		$GLOBALS['TYPO3_DB']->debugOuput = false;
	}
}
?>
