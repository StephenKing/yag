<?php
/***************************************************************
* Copyright notice
*
*   2010 Daniel Lienert <daniel@lienert.cc>, Michael Knoll <mimi@kaktusteam.de>
* All rights reserved
*
*
* This script is part of the TYPO3 project. The TYPO3 project is
* free software; you can redistribute it and/or modify
* it under the terms of the GNU General Public License as published by
* the Free Software Foundation; either version 2 of the License, or
* (at your option) any later version.
*
* The GNU General Public License can be found at
* http://www.gnu.org/copyleft/gpl.html.
*
* This script is distributed in the hope that it will be useful,
* but WITHOUT ANY WARRANTY; without even the implied warranty of
* MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE. See the
* GNU General Public License for more details.
*
* This copyright notice MUST APPEAR in all copies of the script!
***************************************************************/

/**
 * We overwrite Persistence Backend for respecting our own PIDs when storing new objects
 *
 * Configuration for replacing original backend is given in TypoScript:
 *
 * config.tx_extbase.objects.Tx_Extbase_Persistence_Storage_BackendInterface.className = Tx_Yag_Extbase_Persistence_Backend
 *
 * @package Extbase
 * @subpackage Persistence
 * @author Michael Knoll
 */
class Tx_Yag_Extbase_Persistence_Backend extends Tx_Extbase_Persistence_Backend {

	/**
	 * Holds instance of pid detector
	 *
	 * @var Tx_Yag_Utility_PidDetector
	 */
	protected $pidDetector;



	/**
	 * Constructor for persistence backend
	 *
	 * @param Tx_Extbase_Configuration_ConfigurationManagerInterface $configurationManager
	 */
	public function __construct(Tx_Extbase_Configuration_ConfigurationManagerInterface $configurationManager) {
		parent::__construct($configurationManager);

		// TODO think about a way to inject this!
		$this->pidDetector = Tx_Yag_Utility_PidDetector::getInstance();
	}



	/**
	 * Determine the storage page ID for a given NEW record
	 *
	 * This does the following:
	 * - If there is a TypoScript configuration "classes.CLASSNAME.newRecordStoragePid", that is used to store new records.
	 * - If there is no such TypoScript configuration, it uses the first value of The "storagePid" taken for reading records.
	 *
	 * @param Tx_Extbase_DomainObject_DomainObjectInterface $object
	 * @return int the storage Page ID where the object should be stored
	 */
	protected function determineStoragePageIdForNewRecord(Tx_Extbase_DomainObject_DomainObjectInterface $object = NULL) {
		if (count($this->pidDetector->getPids()) > 0) {
			$pids = $this->pidDetector->getPids();
			return $pids[0];
		} else {
			return parent::determineStoragePageIdForNewRecord($object);
		}
	}
    
}
?>