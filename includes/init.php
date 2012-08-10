<?php
defined('DS')        ? null : define('DS', DIRECTORY_SEPARATOR);
defined('SITE_ROOT') ? null : define('SITE_ROOT', 'C:'.DS.'xampp'.DS.'htdocs'.DS.'business_directory');
defined('LIB_PATH')  ? null : define('LIB_PATH', SITE_ROOT.DS.'includes');
defined('CLASS_PATH')? null : define('CLASS_PATH', SITE_ROOT.DS.'data'.DS.'classes');
// load config file first
require_once(LIB_PATH.DS.'config.php');

// load basic functions next so that everything after can use them
require_once(LIB_PATH.DS.'functions.php');

// load core objects
//require_once(LIB_PATH.DS.'session.php');
require_once(CLASS_PATH.DS.'database.php');

// load validator classes
require_once(CLASS_PATH.DS.'validate.php');

// load authentication classes
require_once(CLASS_PATH.DS.'authentication.php');

// load admin classes
require_once(CLASS_PATH.DS.'admin.php');

// load user classes
require_once(CLASS_PATH.DS.'user.php');

// load business classes
require_once(CLASS_PATH.DS.'business.php');

require_once(CLASS_PATH.DS.'banner.php');

// load pagination classes
require_once(CLASS_PATH.DS.'ps_pagination.php');

// load category classes
require_once(CLASS_PATH.DS.'category.php');

// load search classes
require_once(CLASS_PATH.DS.'search.php');

// check login status
require_once(LIB_PATH.DS.'login_status.php');

// process sign in form
require_once(LIB_PATH.DS.'process_sign_in.php');

?>