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
class CatRepository extends \TYPO3\CMS\Extbase\Persistence\Repository
{
	protected $resList = array();

	public function getSub($cat = 0)
	{
		$query = $this->createQuery();

		if($cat != 0)
    	{
    		$cat = explode(',', $cat);
    	}

		$query->matching($query->in('parent_cat', $cat));

		$result = $query->execute()->toArray();
		$resArr = array();
		foreach($result as $key => $value)
		{
			$resArr[] = $value->getUid();
		}
		if(!empty($resArr))
		{
			$this->resList = array_merge($this->resList, $resArr);
			$resArr = implode(',', $resArr);
			$this->getSub($resArr);
		}

        return implode(',', $this->resList);
	}




	public function getCategories($cat = 0)
	{
		$query = $this->createQuery();

		if($cat != 0)
    	{
    		$cat = explode(',', $cat);
    	}

    	$query->matching($query->in('uid', $cat));

    	$result = $query->execute();

    	return $result;
	}
}
?>
