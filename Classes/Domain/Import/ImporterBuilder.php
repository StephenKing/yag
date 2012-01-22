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
 * Factory for building importers
 *
 * @package Domain
 * @subpackage Import
 * @author Michael Knoll <mimi@kaktusteam.de>
 */
class Tx_Yag_Domain_Import_ImporterBuilder {
	
	/**
	 * Holds an instance of importer builder as singleton instance of class
	 *
	 * @var Tx_Yag_Domain_Import_ImporterBuilder
	 */
	protected static $instance = null;
	
	
	
	/**
	 * Holds an instance of configuration builder
	 *
	 * @var Tx_Yag_Domain_Configuration_ConfigurationBuilder
	 */
	protected $configurationBuilder;
	
	
	
	/**
	 * Factory method for getting an instance of importer builder (singleton)
	 *
	 * @return Tx_Yag_Domain_Import_ImporterBuilder Singleton instance of importer builder
	 */
	public static function getInstance() {
		if (self::$instance === null) {
			$configurationBuilder = Tx_Yag_Domain_Configuration_ConfigurationBuilderFactory::getInstance();
			self::$instance = new self($configurationBuilder);
		}
		return self::$instance;
	}
	
	
	
	/**
	 * Constructor for importer builder
	 *
	 * @param Tx_Yag_Domain_Configuration_ConfigurationBuilder $configurationBuilder
	 */
	protected function __construct(Tx_Yag_Domain_Configuration_ConfigurationBuilder $configurationBuilder) {
		$this->configurationBuilder = $configurationBuilder;
	}
	
	

	/**
	 * Creates an instance of an importer
	 *
	 * @param string $importerClassName Class name of importer
	 * @return Tx_Yag_Domain_Import_AbstractImporter Instance of importer class
	 */
	public function createImporter($importerClassName) {
	    $importer = new $importerClassName; /* @var $importer Tx_Yag_Domain_Import_AbstractImporter */
	    $importer->injectConfigurationBuilder($this->configurationBuilder);
	    $importer->injectImporterConfiguration($this->configurationBuilder->buildImporterConfiguration());
	    $importer->injectImageProcessor(Tx_Yag_Domain_ImageProcessing_ProcessorFactory::getInstance($this->configurationBuilder));
	    $importer->injectItemRepository(t3lib_div::makeInstance('Tx_Yag_Domain_Repository_ItemRepository'));
	    $importer->injectItemMetaRepository(t3lib_div::makeInstance('Tx_Yag_Domain_Repository_ItemMetaRepository'));
	    $importer->injectPersistenceManager(t3lib_div::makeInstance('Tx_Extbase_Persistence_Manager'));
	    return $importer;
	}
	
	
	
	/**
	 * Creates an instance of an importer for a given album
	 *
	 * @param string $importerClassName Class name of importer
	 * @param Tx_Yag_Domain_Model_Album $album
	 * @return Tx_Yag_Domain_Import_AbstractImporter Instance of importer class
	 */
	public function createImporterForAlbum($importerClassName, Tx_Yag_Domain_Model_Album $album) {
		$importer = $this->createImporter($importerClassName);
        $importer->injectAlbumManager(new Tx_Yag_Domain_AlbumContentManager($album));
        $importer->setAlbum($album);
        return $importer;
	}
	
}
 
?>