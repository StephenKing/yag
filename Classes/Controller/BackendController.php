<?php
/***************************************************************
*  Copyright notice
*
*  (c) 2010-2011-2011 Daniel Lienert <daniel@lienert.cc>, Michael Knoll <mimi@kaktusteam.de>
*  All rights reserved
*
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
 * Controller for Backend Module actions 
 *
 * @package Controller
 * @author Daniel Lienert <daniel@lienert.cc>
 */
class Tx_Yag_Controller_BackendController extends Tx_Yag_Controller_AbstractController {
    
	
	/**
	 * Render a message if no settings are available
	 * 
	 */
	public function settingsNotAvailableAction() {	
    	$this->flashMessageContainer->add(
    	Tx_Extbase_Utility_Localization::translate('tx_yag_controller_backend_settingsNotAvailable.infoText', $this->extensionName),
    	Tx_Extbase_Utility_Localization::translate('tx_yag_controller_backend_settingsNotAvailable.headline', $this->extensionName), 
    	t3lib_FlashMessage::INFO);
	}
	
	
	
	/**
	 * Render a message if entry in ext_localconf is not aviable
	 * 
	 */
	public function extConfSettingsNotAvailableAction() {	
    	$this->flashMessageContainer->add(
    	Tx_Extbase_Utility_Localization::translate('tx_yag_controller_backend_extConfSettingsNotAvailable.infoText', $this->extensionName),
    	Tx_Extbase_Utility_Localization::translate('tx_yag_controller_backend_extConfSettingsNotAvailable.headline', $this->extensionName), 
    	t3lib_FlashMessage::INFO);
	}
	
	
	/**
	 * Show the maintenance overview
	 */
	public function maintenanceOverviewAction() {

		$itemRepository = $this->objectManager->get('Tx_Yag_Domain_Repository_ItemRepository'); /* @var $itemRepository Tx_Yag_Domain_Repository_ItemRepository */
		
		$galleryCount = $this->objectManager->get('Tx_Yag_Domain_Repository_GalleryRepository')->countAll();
		$albumCount = $this->objectManager->get('Tx_Yag_Domain_Repository_AlbumRepository')->countAll();
		
		$itemCount = $itemRepository->countAll();
		$itemSizeSum = t3lib_div::formatSize($itemRepository->getItemSizeSum());
		$includedCount = $this->objectManager->get('Tx_Yag_Domain_Repository_Extern_TTContentRepository')->countAllYagInstances();

		$firstItem = $itemRepository->getItemsAfterThisItem();
		if($firstItem) {
			$firstItemUid = $firstItem->getUid();
		}
				
		$resolutionFileCache = Tx_Yag_Domain_FileSystem_ResolutionFileCacheFactory::getInstance();

		$this->view->assign('galleryCount', $galleryCount);
		$this->view->assign('albumCount', $albumCount);
		$this->view->assign('itemCount', $itemCount);
		$this->view->assign('itemSizeSum', $itemSizeSum);
		$this->view->assign('firstItemUid', $firstItemUid);
		$this->view->assign('includedCount', $includedCount);
				
		$this->view->assign('resolutionFileCache', $resolutionFileCache);
	}
	
	
	
	/**
	 * Clear the cache of all pages where yag is included
	 */
	public function clearAllPageCacheAction() {
		$this->objectManager->get('Tx_Yag_PageCache_PageCacheManager')->clearAll();
		$this->flashMessageContainer->add(Tx_Extbase_Utility_Localization::translate('tx_yag_controller_backend_MaintenanceOverview.pageCacheSuccessfullyCleared', $this->extensionName));
		$this->forward('maintenanceOverview');
	}
}
?>