<?php
/***************************************************************
*  Copyright notice
*
*  (c) 2010 Daniel Lienert <daniel@lienert.cc>, Michael Knoll <mimi@kaktusteam.de>
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
 * Interface for treewalker visitor strategies
 *
 * @package Domain
 * @subpackage Model
 * @author Michael Knoll <mimi@kaktusteam.de>
 */
interface Tx_Yag_Domain_Model_TreeWalkerVisitorInterface {

	/**
	 * Run whenever a node is visited for the first time
	 *
	 * @param Tx_Yag_Domain_Model_NodeInterface $node
	 * @param int &$index Holds the visitation index of treewalker
	 */
	public function doFirstVisit(Tx_Yag_Domain_Model_NodeInterface $node, &$index);
	
	
	
	/**
	 * Run whenever a node is visited for the last time 
	 *
	 * @param Tx_Yag_Domain_Model_NodeInterface $node
	 * @param int &$index Holds the visitation index of treewalker
	 */
	public function doLastVisit(Tx_Yag_Domain_Model_NodeInterface $node, &$index);
	
}
 
?>