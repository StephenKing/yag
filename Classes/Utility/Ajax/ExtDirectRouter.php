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
* Utility to include defined frontend libraries as jQuery and related CSS
*  
*
* @package Utility
* @author Daniel Lienert <daniel@lienert.cc>
*/

class Tx_Yag_Utility_Ajax_ExtDirectRouter {
	
	
	/*
	public function __call($name, $arguments) {
		
		$request = array(
			'extensionName' => 'yag',
			'pluginName' => 'pi1',
			'arguments' => 'arguments'
		);
		
		list($request['Controller'], $request['action']) = explode('.', $name);
		
		$dispatcher = t3lib_div::makeInstance('Tx_Yag_Utility_Ajax_Dispatcher');
		$dispatcher->setRequest($request);
		$dispatcher->dispatch();
	}
	*/
	
	
	public function getSubTree() {
		error_log('WE HAVE A CALL');
		
		$x = array(array('id' => 1, 'text' => 'TestNode', 'leaf' => false),array('id' => 2, 'text' => 'TestNode', 'leaf' => false));
		return $x;
	}
	
	
	
}
?>