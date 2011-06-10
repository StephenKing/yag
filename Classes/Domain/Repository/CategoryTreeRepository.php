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
 * Repository for category tree
 *
 * @package Domain
 * @subpackage Import
 * @author Michael Knoll <mimi@kaktusteam.de>
 */
class Tx_Yag_Domain_Repository_CategoryTreeRepository {

	/**
	 * Holds an instance of category repository
	 *
	 * @var Tx_Yag_Domain_Repository_CategoryRepository
	 */
	protected $categoryRepository;
	
	
	public function __construct() {
		$this->categoryRepository = new Tx_Yag_Domain_Repository_CategoryRepository();
	}
	
	
	
	/**
	 * Returns a category tree for a given root node id
	 *
	 * @param int $rootNodeId
	 * @return Tx_Yag_Domain_Model_CategoryTree
	 */
	public function findByRootId($rootNodeId) {
		$rootNode = $this->categoryRepository->findByUid($rootNodeId);
		$categoryTreeForRootId = new Tx_Yag_Domain_Model_CategoryTree($rootNode);
		return $categoryTreeForRootId;
	}
	
	
	
	/**
	 * Updates all categories of a tree in the category repository
	 *
	 * @param Tx_Yag_Domain_Model_CategoryTree $categoryTree Category tree to be updated in database
	 */
	public function update(Tx_Yag_Domain_Model_CategoryTree $categoryTree) {
		$this->categoryRepository->updateTree($categoryTree->getRoot());
	}
	
}
 
?>