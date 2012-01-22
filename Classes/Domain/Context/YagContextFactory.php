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
 * Class implements factory for yag Context
 *
 * @package Domain
 * @subpackage Context
 * @author Daniel Lienert <daniel@lienert.cc>
 */
class Tx_Yag_Domain_Context_YagContextFactory {

	/**
	 * Holds instance of configuration builder as singleton
	 *
	 * @var Tx_Yag_Domain_Context_YagContext
	 */
	protected static $instances = array();
	
	
	/**
	 * Indetifier of the active context
	 * 
	 * @var string
	 */
	protected static $activeContext = NULL;
	
	
	/**
	 * Create and store a named context 
	 * 
	 * @param Tx_Yag_Domain_Context_YagContext $identifier
	 * @return Tx_Yag_Domain_Context_YagContext
	 */
	public static function createInstance($identifier) {
		self::$activeContext = $identifier;
		
		if(self::$instances[$identifier] == NULL) {
			$extensionNameSpace = t3lib_div::makeInstance('Tx_Extbase_Object_ObjectManager')
                                        ->get('Tx_Yag_Extbase_ExtbaseContext')
                                        ->getExtensionNameSpace();
			
			$yagContext = new Tx_Yag_Domain_Context_YagContext($identifier);
			$yagContext->injectConfigurationBuilder(Tx_Yag_Domain_Configuration_ConfigurationBuilderFactory::getInstance());
			
			$sessionPersistenceManager = Tx_PtExtbase_State_Session_SessionPersistenceManagerFactory::getInstance();
			$sessionPersistenceManager->registerObjectAndLoadFromSession($yagContext);

			$gpVarsAdapter = Tx_PtExtbase_State_GpVars_GpVarsAdapterFactory::getInstance($extensionNameSpace);
        	$gpVarsAdapter->injectParametersInObject($yagContext);
        	
        	$yagContext->init();
        	
			self::$instances[$identifier] = $yagContext;
		}
		
		return self::$instances[$identifier];
	}
	
	
	
	/**
	 * Get an identified or active context 
	 * 
	 * @param Tx_Yag_Domain_Context_YagContext $identifier
	 * @return Tx_Yag_Domain_Context_YagContext
	 */
	public static function getInstance($identifier = '') {
		
		if(!$identifier) $identifier = self::$activeContext;
		if(!$identifier || !array_key_exists($identifier, self::$instances)) {
			Throw new Exception('No active context found! 1299089647');
		}
		
		return self::$instances[$identifier];
	}
	
}
?>