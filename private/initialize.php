<?php

// Turn on output buffering
ob_start();

// Assign file paths to PHP constants
define("PRIVATE_PATH", dirname(__FILE__));
define("PROJECT_PATH", dirname(PRIVATE_PATH));
define("PUBLIC_PATH", PROJECT_PATH . '/public');
define("SHARED_PATH", PRIVATE_PATH . '/shared');

// Assign the root URL to a PHP constant
$public_end = strpos($_SERVER['SCRIPT_NAME'], '/public') + 7;
$doc_root = substr($_SERVER['SCRIPT_NAME'], 0, $public_end);
define("WWW_ROOT", $doc_root);

// Loads necessary PHP files once
require_once('functions.php');
require_once('status_error_functions.php');
require_once('database_credentials.php');
require_once('database_functions.php');
require_once('validation_functions.php');

// Load class definitions
require_once(PRIVATE_PATH . '/classses/DatabaseObject.php');
require_once(PRIVATE_PATH . '/classses/Admin.php');
require_once(PRIVATE_PATH . '/classses/Car.php');
require_once(PRIVATE_PATH . '/classses/Session.php');
require_once(PRIVATE_PATH . '/classses/Pagination.php');

// foreach(glob('classes/*.class.php') as $file) {
//     require_once($file);
// }

$database = db_connect();
DatabaseObject::set_database($database);

$session = new Session();

$makes = Car::MAKE_OPTIONS;
sort($makes);
$bodys = Car::BODY_OPTIONS;
sort($bodys);
$colours = Car::COLOUR_OPTIONS;
sort($colours);
$fuels = Car::FUEL_OPTIONS;
sort($fuels);
$prices = Car::PRICE_OPTIONS;
