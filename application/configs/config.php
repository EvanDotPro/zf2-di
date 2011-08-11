<?php
$c = array();
$c['autoload']['Zend\Loader\StandardAutoloader']['namespaces']['Core']  = APPLICATION_PATH . '/Core';
$c['autoload']['Zend\Loader\ClassMapAutoloader'][0]['Bootstrap']        = APPLICATION_PATH . '/Bootstrap.php';

$c['phpSettings']['display_startup_errors'] = 1;
$c['phpSettings']['display_errors']         = 1;
$c['phpSettings']['error_reporting']        = (E_ALL | E_STRICT);
$c['bootstrap_class']                       = 'Bootstrap';

/**
 * Zend\Di Config
 */

// Jane
$c['di']['instance']['alias']['jane']                   = 'Core\Model\User';
$c['di']['instance']['jane']['parameters']['firstName'] = 'Jane';
$c['di']['instance']['jane']['parameters']['lastName']  = 'Doe';

// John
$c['di']['instance']['alias']['john']                   = 'Core\Model\User';
$c['di']['instance']['john']['parameters']['firstName'] = 'John';
$c['di']['instance']['john']['parameters']['lastName']  = 'Doe';

// No alias or class for 'sister', so it should be a string (works)
$c['di']['instance']['john']['methods']['addSibling']['relation'] = 'sister';
// Alias for 'jane' should be evaluated to the 'jane' instance of Core\Model\User.
// This doesn't work; the string 'jane' is passed to this method. Setting this 
// to Core\Model\User doesn't work either; as it still passes a string.
$c['di']['instance']['john']['methods']['addSibling']['user'] = 'jane';


return $c;
