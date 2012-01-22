<?php
/***************************************************************
*  Copyright notice
*
*  (c) 2010-2011 Daniel Lienert <daniel@lienert.cc>, Michael Knoll <mimi@kaktusteam.de>
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
 * @package Domain
 * @subpackage ImageProcessing
 * @author Daniel Lienert <daniel@lienert.cc>
 */
class Tx_Yag_Domain_ImageProcessing_ProcessorFactory {
	
	/**
	 * Holds an instance of the image processor
	 *
	 * @var Tx_Yag_Domain_ImageProcessing_AbstractProcessor
	 */
	protected static $instance = NULL;
	
	
	
	/**
	 * Factory method for file repository
	 *
	 * @return Tx_Yag_Domain_ImageProcessing_AbstractProcessor
	 */
	public static function getInstance(Tx_Yag_Domain_Configuration_ConfigurationBuilder $configurationBuilder) {
		if(self::$instance == NULL) {
			
			$processorClass = 'Tx_Yag_Domain_ImageProcessing_Typo3Processor';
			$objectManager = t3lib_div::makeInstance('Tx_Extbase_Object_ObjectManager');
			
			
			self::$instance = new $processorClass($configurationBuilder->buildImageProcessorConfiguration());
			self::$instance->injectConfigurationManager($objectManager->get('Tx_Extbase_Configuration_ConfigurationManagerInterface'));
			self::$instance->injectResolutionFileRepository($objectManager->get('Tx_Yag_Domain_Repository_ResolutionFileCacheRepository'));
			self::$instance->injectHashFileSystem(Tx_Yag_Domain_FileSystem_HashFileSystemFactory::getInstance());
			self::$instance->init();
		}

		return self::$instance;
	}
}
?>