<?php
/***************************************************************
*  Copyright notice
*
*  (c) 2010-2011 Daniel Lienert <daniel@lienert.cc>
*  			Michael Knoll <mimi@kaktusteam.de>
*  			
*  All rights reserved
*
*  This script is part of the TYPO3 project. The TYPO3 project is
*  free software; you can redistribute it and/or modify
*  it under the terms of the GNU General Public License as published by
*  the Free Software Foundation; either version 2 of the License, or
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
 * Class implements galleryList configuration object for YAG.
 *
 * @package Domain
 * @subpackage Configuration\GalleryList
 * @author Daniel Lienert <daniel@lienert.cc>
 */
class Tx_Yag_Domain_Configuration_GalleryList_GalleryListConfig extends Tx_PtExtbase_Configuration_AbstractConfiguration {
	
	
	/**
	 * Column count for item view
	 * 
	 * @var int
	 */
	protected $columnCount;
	
	
	
	/**
	 * @var string
	 */
	protected $galleryThumbPartial;
	
	
	/*
	 * @var int
	 */
	protected $itemsPerPage;
	
	
	
	/**
	 * Initializes configuration object (Template method)
	 */
	protected function init() {
		$this->setRequiredValue('galleryThumbPartial', 'No gallery thumb partial set!');
		
		$this->setValueIfExists('columnCount');
		$this->setValueIfExists('itemsPerPage');
	}
	
	
	
	/**
	 * @return int columnCount
	 */
	public function getColumnCount() {
		return $this->columnCount;
	}
	
	
	
	/**
	 * Get the columns relative width
	 * @return int
	 */
	public function getColumnRelativeWidth() {
		return number_format(100 / $this->columnCount,0);
	}
	
	
	
	/**
	 * @return string
	 */
	public function getGalleryThumbPartial() {
		return $this->galleryThumbPartial;
	}
	
	
	
	/**
	 * @return int
	 */
	public function getItemsPerPage() {
		return $this->itemsPerPage;
	}
}
?>