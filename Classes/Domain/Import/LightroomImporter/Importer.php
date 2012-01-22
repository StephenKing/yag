<?php
/***************************************************************
*  Copyright notice
*
*  (c) 2010-2011 Daniel Lienert <daniel@lienert.cc>, Michael Knoll <mimi@kaktsuteam.de>
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
 * Lightroom importer handles imports from Lightroom
 *
 * @package Domain
 * @subpackage Import\LightroomImporter
 * @author Michael Knoll <mimi@kaktsuteam.de>
 */
class Tx_Yag_Domain_Import_LightroomImporter_Importer extends Tx_Yag_Domain_Import_AbstractImporter {
	
	/**
	 * Runs import for file uploaded by lightroom.
	 * 
	 * The file is send via POST and stored to a temporary directory on server.
	 * From there it's taken and imported to the album associated with this 
	 * importer.
	 * 
	 * TODO add error handling here
	 * 
	 * @return Tx_Yag_Domain_Model_Item Item created for uploaded file
	 */
	public function runImport() {
		$item = $this->moveAndImportUploadedFile($_FILES['file']['tmp_name']);
		$this->persistenceManager->persistAll();
		return $item;
	}

}

?>
