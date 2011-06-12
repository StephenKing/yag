<?php
/***************************************************************
*  Copyright notice
*
*  (c) 2010 Michael Knoll <mimi@kaktusteam.de>
*           Daniel Lienert <daniel@lienert.cc>
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
 * Testcase for yag category tree builder
 *
 * @package Tests
 * @subpackage Domain\Model
 * @author Michael Knoll <knoll@punkt.de>
 */
class Tx_Yag_Tests_Domain_Model_CategoryTreeBuilderTest extends Tx_Yag_Tests_BaseTestCase {

	/** @test */
	public function classExists() {
		$this->assertTrue(class_exists(Tx_Yag_Domain_Model_CategoryTreeBuilder));
	}
	
	
	
	/** @test */
	public function buildTreeReturnsCategoryTreeForGivenId() {
		$categoriesObjectStorage = self::buildSetOfCategories();
		$categoriesArray = $categoriesObjectStorage->toArray();
		$repositoryMock = $this->buildRepositoryMock();
		$repositoryMock->expects($this->once())
		    ->method('findByRootId')
		    ->will($this->returnValue($categoriesObjectStorage));
		$treeBuilder = new Tx_Yag_Domain_Model_CategoryTreeBuilder($repositoryMock);
		$tree = $treeBuilder->buildTreeForCategory(self::createCategory(1,12,1));
		
		$this->assertTrue(is_a($tree, Tx_Yag_Domain_Model_CategoryTree));

		// Assertions, that build tree is correct
		$this->assertEquals($tree->getRoot(), $categoriesArray[5], 'Root node of tree is not root of given set of nodes');
		$this->assertTrue($tree->getRoot()->getChildren()->contains($tree->getNodeByUid(2)), 'Root node of tree does not contain child of given set of nodes');
		$this->assertTrue($tree->getRoot()->getChildren()->contains($tree->getNodeByUid(5)), 'Root node of tree does not contain child of given set of nodes');
		$this->assertEquals($tree->getNodeByUid(2)->getParent(), $categoriesArray[5], 'Child of root does not have root set as its parent');
		$this->assertEquals($tree->getNodeByUid(5)->getParent(), $categoriesArray[5], 'Child of root does not have root set as its parent');
		$this->assertTrue($tree->getNodeByUid(2)->getChildren()->contains($tree->getNodeByUid(3)), 'Node 2 does not contain node 3 as its child');
		$this->assertTrue($tree->getNodeByUid(2)->getChildren()->contains($tree->getNodeByUid(4)), 'Node 2 does not contain node 4 as its child');
		$this->assertEquals($tree->getNodeByUid(3)->getParent(), $tree->getNodeByUid(2), 'Node 3 does not have node 2 set as its parent');
		$this->assertEquals($tree->getNodeByUid(4)->getParent(), $tree->getNodeByUid(2), 'Node 3 does not have node 2 set as its parent');
		$this->assertTrue($tree->getNodeByUid(5)->getChildren()->contains($tree->getNodeByUid(6)), 'Node 5 does not have node 6 set as child');
		$this->assertEquals($tree->getNodeByUid(6)->getParent(), $tree->getNodeByUid(5), 'Node 6 does not have node 6 set as its parent');
	}
	
	
	
	/**
	 * Returns an ordered set of categories
	 *
	 * @return Tx_Extbase_Persistence_ObjectStorage
	 */
	protected static function buildSetOfCategories() {
		$setOfCategories = new Tx_Extbase_Persistence_ObjectStorage();
		$setOfCategories->attach(self::createCategory(6,9,10,1,'6'));
		$setOfCategories->attach(self::createCategory(5,8,11,1,'5'));
		$setOfCategories->attach(self::createCategory(4,5,6,1,'4'));
		$setOfCategories->attach(self::createCategory(3,3,4,1,'3'));
		$setOfCategories->attach(self::createCategory(2,2,7,1,'2'));
		$setOfCategories->attach(self::createCategory(1,1,12,1,'1'));
		return $setOfCategories;
	}
	
	
	
	/**
	 * Helper method to create a category object
	 *
	 * @return Tx_Yag_Domain_Repository_CategoryRepository Mocked repository
	 */
	protected function buildRepositoryMock() {
		return $this->getMock('Tx_Yag_Domain_Repository_CategoryRepository', array('findByRootId'), array(), '', FALSE);
	}
	
	
	
	/**
	 * Helper method to create a category object
	 *
	 * @param int $lft
	 * @param int $rgt
	 * @param int $root
	 * @param string $name
	 * @param string $description
	 * @return Tx_Yag_Domain_Model_Category
	 */
	protected static function createCategory($uid, $lft, $rgt, $root, $name = '', $description = '') {
		$category = new Tx_Yag_Tests_Domain_Model_CategoryMock($uid, $name, $description);
		$category->setLft($lft);
		$category->setRgt($rgt);
		$category->setRoot($root);
		return $category;
	}
	
}

?>