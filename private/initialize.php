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
require_once(PRIVATE_PATH . '/classses/car.class.php');
require_once(PRIVATE_PATH . '/classses/parsecsv.class.php');
// foreach(glob('classes/*.class.php') as $file) {
//     require_once($file);
// }

?>