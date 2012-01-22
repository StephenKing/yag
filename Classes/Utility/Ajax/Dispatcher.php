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

class Tx_Yag_Utility_Ajax_Dispatcher {
	
	
	/**
	 * Array of all request Arguments
	 * 
	 * @var array
	 */
	protected $requestArguments = array();
	
	
	
	/**
	 * Extbase Object Manager
	 * @var Tx_Extbase_Object_ObjectManager
	 */
	protected $objectManager;
	
	
	
	/**
	 * @var string
	 */
	protected $extensionName;
	
	
	
	/**
	 * @var string
	 */
	protected $pluginName;
	
	
	
	/**
	 * @var string
	 */
	protected $controllerName;
	
	
	
	/**
	 * @var string
	 */
	protected $actionName;
	
	
	
	/**
	 * @var array
	 */
	protected $arguments;
	
	
	
	/**
	 * Called by ajax.php / eID.php
	 * Builds an extbase context and returns the response
	 */
	public function dispatch() {
		$this->prepareCallArguments();
		
		$configuration['extensionName'] = $this->extensionName;
		$configuration['pluginName'] = $this->pluginName;
		
		
		$bootstrap = t3lib_div::makeInstance('Tx_Extbase_Core_Bootstrap');
		$bootstrap->initialize($configuration);
		
		$this->objectManager = t3lib_div::makeInstance('Tx_Extbase_Object_ObjectManager');

		$request = $this->buildRequest();
		$response = $this->objectManager->create('Tx_Extbase_MVC_Web_Response');
		
		$dispatcher =  $this->objectManager->get('Tx_Extbase_MVC_Dispatcher');
		$dispatcher->dispatch($request, $response);

		$response->sendHeaders();
		// TODO this should be removed, I think
		echo $response->getContent();
		
		$this->cleanShutDown();
	}

	
	
	/**
	 * We have to do some persisting when shuttind down Dispatcher
	 * 
	 * TODO what about session persistence here?
	 */
	protected function cleanShutDown() {
		$this->objectManager->get('Tx_Extbase_Persistence_Manager')->persistAll();
		$this->objectManager->get('Tx_Extbase_Reflection_Service')->shutdown();
	}
	
	
	
	/**
	 * Build a request object
	 * 
	 * @return Tx_Extbase_MVC_Web_Request $request
	 */
	protected function buildRequest() {
		$request = $this->objectManager->get('Tx_Extbase_MVC_Web_Request'); /* @var $request Tx_Extbase_MVC_Request */
		$request->setControllerExtensionName($this->extensionName);
		$request->setPluginName($this->pluginName);
		$request->setControllerName($this->controllerName);
		$request->setControllerActionName($this->actionName);
		$request->setArguments($this->arguments);
		
		return $request;
	}
	
	
	
	/**
	 * Set the request array
	 * 
	 * @param array $request
	 */
	public function setRequest(array $request) {
		$this->request = $request;
	}
	
	
	
	/**
	 * Prepare the call arguments
	 * @TODO escape / unescape values ?
	 */
	protected function prepareCallArguments() {
		$request = t3lib_div::_GP('request');

		if($request) {
			$this->setRequestArgumentsFromJSON($request);
			$this->setRequestArgumentsFromGetPost();
		}
		
		$this->extensionName 	= $this->requestArguments['extensionName'];
		$this->pluginName 		= $this->requestArguments['pluginName'];
		$this->controllerName 	= $this->requestArguments['controllerName'];
		$this->actionName 		= $this->requestArguments['actionName'];
		

		$call = json_decode($callJSON, TRUE);
		$this->extensionName 	= $call['extensionName'];
		$this->pluginName 		= $call['pluginName'];
		$this->controllerName 	= $call['controllerName'];
		$this->actionName 		= $call['actionName'];
		$this->arguments 		= $call['arguments'];	
	}
	
	
	
	/**
	 * Set the request array from the getPost array
	 * 
	 * @param array $request
	 */
	protected function setRequestArgumentsFromGetPost() {
		$validArguments = array('extensionName','pluginName','controllerName','actionName','arguments');
		foreach($validArguments as $argument) {
			if(t3lib_div::_GP($argument)) $this->requestArguments[$argument] = t3lib_div::_GP($argument);
		}
	}
	
}

?>