<?php
namespace Alm\AlmPortfolio\Domain\Model;

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
class Item extends \TYPO3\CMS\Extbase\DomainObject\AbstractEntity
{
	/**
	 * title
	 *
	 * @var \string
	 * @validate NotEmpty
	 */
	protected $title;

	/**
	 * teaser
	 *
	 * @var \string
	 * @validate NotEmpty
	 */
	protected $teaser;

	/**
	 * description
	 *
	 * @var \string
	 * @validate NotEmpty
	 */
	protected $description;

	/**
	 * client
	 *
	 * @var \string
	 * @validate NotEmpty
	 */
	protected $client;

	/**
	 * url
	 *
	 * @var \string
	 * @validate NotEmpty
	 */
	protected $url;

	/**
	 * cat
	 *
	 * @var \TYPO3\CMS\Extbase\Persistence\ObjectStorage<\Alm\AlmPortfolio\Domain\Model\Cat>
	 * @validate NotEmpty
	 */
	protected $cat;

	/**
	 * images
	 *
	 * @var \TYPO3\CMS\Extbase\Persistence\ObjectStorage<\TYPO3\CMS\Extbase\Domain\Model\FileReference>
	 * @validate NotEmpty
	 */
	protected $images;




	/**
	 * Returns the title
	 *
	 * @return \string $title
	 */
	public function getTitle()
	{
		return $this->title;
	}

	/**
	 * Sets the title
	 *
	 * @param \string $title
	 * @return void
	 */
	public function setTitle($title)
	{
		$this->title = $title;
	}


	/**
	 * Returns the teaser
	 *
	 * @return \string $teaser
	 */
	public function getTeaser()
	{
		return $this->teaser;
	}

	/**
	 * Sets the teaser
	 *
	 * @param \string $teaser
	 * @return void
	 */
	public function setTeaser($teaser)
	{
		$this->Teaser = $teaser;
	}


	/**
	 * Returns the description
	 *
	 * @return \string $description
	 */
	public function getDescription()
	{
		return $this->description;
	}

	/**
	 * Sets the description
	 *
	 * @param \string $description
	 * @return void
	 */
	public function setDescription($description)
	{
		$this->description = $description;
	}


	/**
	 * Returns the client
	 *
	 * @return \string $client
	 */
	public function getClient()
	{
		return $this->client;
	}

	/**
	 * Sets the client
	 *
	 * @param \string $client
	 * @return void
	 */
	public function setClient($client)
	{
		$this->client = $client;
	}


	/**
	 * Returns the url
	 *
	 * @return \string $url
	 */
	public function getUrl()
	{
		return $this->url;
	}

	/**
	 * Sets the url
	 *
	 * @param \string $url
	 * @return void
	 */
	public function setUrl($url)
	{
		$this->url = $url;
	}


	/**
	 * Returns the cat
	 *
	 * @return \TYPO3\CMS\Extbase\Persistence\ObjectStorage<\Alm\AlmPortfolio\Domain\Model\Cat> $cat
	 */
	public function getCat()
	{
		return $this->cat;
	}

	/**
	 * Sets the cat
	 *
	 * @param \TYPO3\CMS\Extbase\Persistence\ObjectStorage<\Alm\AlmPortfolio\Domain\Model\Cat> $cat
	 * @return void
	 */
	public function setCat($cat)
	{
		$this->cat = $cat;
	}


	/**
	 * Returns the images
	 *
	 * @return \TYPO3\CMS\Extbase\Persistence\ObjectStorage<\TYPO3\CMS\Extbase\Domain\Model\FileReference> $images
	 */
	public function getImages()
	{
		return $this->images;
	}

	/**
	 * Sets the images
	 *
	 * @param \TYPO3\CMS\Extbase\Persistence\ObjectStorage<\TYPO3\CMS\Extbase\Domain\Model\FileReference> $images
	 * @return void
	 */
	public function setImages($images)
	{
		$this->images = $images;
	}
}
?>
