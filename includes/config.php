<?php
// Database Constants
defined('DB_SERVER') ? null : define("DB_SERVER", "localhost");
defined('DB_USER')   ? null : define("DB_USER", "root");
defined('DB_PASS')   ? null : define("DB_PASS", "");
defined('DB_NAME')   ? null : define("DB_NAME", "lbs_db");



defined('ADMIN_EMAIL')   ? null : define("ADMIN_EMAIL", "admin@places.webuda.com");
defined('DOMAIN_NAME')   ? null : define("DOMAIN_NAME", "places.webuda.com");
//defined('SITE_URL')   ? null : define("SITE_URL", "http://places.webuda.com");
defined('SITE_URL')   ? null : define("SITE_URL", "http://localhost/business_directory");

defined('DS')        ? null : define('DS', DIRECTORY_SEPARATOR);
defined('SITE_ROOT') ? null : define('SITE_ROOT', 'C:'.DS.'xampp'.DS.'htdocs'.DS.'business_directory');
defined('LIB_PATH')  ? null : define('LIB_PATH', SITE_ROOT.DS.'includes');
defined('CLASS_PATH')? null : define('CLASS_PATH', SITE_ROOT.DS.'data'.DS.'classes');


defined('GOOGLE_MAP_API_KEY')   ? null : define("GOOGLE_MAP_API_KEY", "");
defined('FACEBOOK_APP_ID')   ? null : define("FACEBOOK_APP_ID", "");
defined('MAILCHIMP_API_KEY')   ? null : define("MAILCHIMP_API_KEY", "");
defined('GA_Property_ID')   ? null : define("GA_Property_ID", "");
?>
