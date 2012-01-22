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
* Viewhelper for rendering an URL of an image for a given item and a given resolution.
* 
* Example:
* 
* <yag:resource.image item="{item}" resolutionName="thumb">
* 
* Only renders URL, no link action!
* 
* @package ViewHelpers
* @subpackage Resource
* @author Daniel Lienert <daniel@lienert.cc>
* @author Michael Knoll <mimi@kaktusteam.de>
*/

class Tx_Yag_ViewHelpers_Resource_ImageViewHelper extends Tx_Fluid_Core_ViewHelper_AbstractViewHelper {



	/**
	 * Render the image
	 * 
	 * @param Tx_Yag_Domain_Model_Item $item
	 * @param string $resolutionName
	 * @param int $width width in px
	 * @param int $height height in px
	 * @param int $quality jpeg quality in percent
	 * @throws Tx_Fluid_Core_ViewHelper_Exception
	 */
	public function render($item, $resolutionName = NULL, $width = NULL, $height = NULL, $quality = NULL) {

		if($resolutionName) {
			$resolutionConfig = Tx_Yag_Domain_Configuration_ConfigurationBuilderFactory::getInstance()
													->buildThemeConfiguration()
													->getResolutionConfigCollection()->getResolutionConfig($resolutionName);
		} elseIf ($width || $height) {
			$resolutionSettings = array(
				'width' => $width,
				'height' => $height,
				'quality' => $quality
			);
			$resolutionConfig = new Tx_Yag_Domain_Configuration_Image_ResolutionConfig(Tx_Yag_Domain_Configuration_ConfigurationBuilderFactory::getInstance(),$resolutionSettings);
		} else {
			$resolutionConfig = NULL;
		}
		
		$imageResolution = $item->getResolutionByConfig($resolutionConfig);

		return $imageResolution->getPath();
	}
}
?>