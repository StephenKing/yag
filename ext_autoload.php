<?php
// This class contains information about classes to be registered in autoload for testing

$extensionPath = t3lib_extMgm::extPath('yag');
$extensionTestsPath = $extensionPath . 'Tests/';
$extbasePath = t3lib_extMgm::extPath('extbase');
return array(
    'tx_extbase_basetestcase' => $extbasePath . 'Tests/BaseTestCase.php', 
    'tx_yag_tests_basetestcase' => $extensionTestsPath . 'BaseTestCase.php',
    'tx_yag_tests_defaulttsconfig' => $extensionTestsPath . 'DefaultTsConfig.php',
    'tx_yag_domain_model_category' => $extensionPath . 'Classes/Domain/Model/Category.php',
    'tx_yag_domain_model_nodeinterface' => $extensionPath . 'Classes/Domain/Model/NodeInterface.php',
    
    'user_tx_yag_utility_flexformdataprovider' => t3lib_extMgm::extPath('yag').'Classes/Utility/FlexformDataProvider.php',
	 'user_tx_yag_utility_flexform_typoscriptdataprovider' => t3lib_extMgm::extPath('yag').'Classes/Utility/TyposcriptDataProvider.php',
    'user_tx_yag_hooks_realurl' => t3lib_extMgm::extPath('yag').'Classes/Hooks/RealUrlHook.php',
	
    'tx_yag_report_externallibraries' => t3lib_extMgm::extPath('yag').'Classes/Report/ExternalLibraries.php',
    'tx_yag_report_environmentvariables' => t3lib_extMgm::extPath('yag').'Classes/Report/EnvironmentVariables.php',
    'tx_yag_report_filesystem' => t3lib_extMgm::extPath('yag').'Classes/Report/Filesystem.php',
);
?>