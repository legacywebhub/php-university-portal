<?php
/*
// FOR HOLDING GLOBAL/GENERAL VARIABLES AND SETTINGS
// HAS TO BE THE FIRST LOADED FILE
// DECLARE VARIABLES AS CONSTANTS TO BE ACCESSIBLE GLOBALLY
// SESSIONS CONFIGURATION
*/ 


// PHP BASE PATHS
define('APP_PATH', __DIR__ . '/../');
define('MEDIA_PATH', APP_PATH . 'media/');
define('STATIC_PATH', APP_PATH . 'assets/');
define('VIEW_PATH', APP_PATH . 'views/');

// SERVER & DEVELOPMENT CONFIGURATIONS
if ($_SERVER["SERVER_NAME"]  == "localhost") {

    /********** DEVELOPMENT CONFIG **********/

    // DATABASE PARAMETERS FOR LOCALHOST
    define('DBHOST', "localhost");
    define('DBNAME', "learningportal_db");
    define('DBUSER', "root");
    define('DBPASS', "");

    // HTML BASE PATHS
    define('ROOT', "http://localhost/php-university-portal");
    define('MEDIA_ROOT', ROOT . '/media');
    define('STATIC_ROOT', ROOT . '/assets');

    // EMAIL CONFIG
    define('EMAIL_HOST', "smtp.gmail.com");
    define('EMAIL_USERNAME', "legacywebtechnologies@gmail.com");
    define('EMAIL_PASSWORD', "qwzwsjxljxgabecx");
    define('EMAIL_PORT', 465);

    // OTHERS
    define('DOMAIN', 'localhost');

} else {
    
    /********** LIVE CONFIG **********/

    // DATABASE PARAMETERS FOR PRODUCTION/LIVE
    define('DBHOST', "localhost");
    define('DBNAME', "learningportal_db");
    define('DBUSER', "learningportal_user");
    define('DBPASS', "p@ssword123");

    // HTML BASE PATHS
    define('ROOT', "//learningportal.com");
    define('MEDIA_ROOT', ROOT . '/media');
    define('STATIC_ROOT', ROOT . '/assets');

    // EMAIL CONFIG
    define('EMAIL_HOST', "mail.learningportal.com");
    define('EMAIL_USERNAME', "support@learningportal.com");
    define('EMAIL_PASSWORD', "p@ssword123");
    define('EMAIL_PORT', 465);

    // OTHERS
    define('DOMAIN', 'legacywebhub.com');
}

// SECURING OUR SESSIONS
ini_set('session.use_only_cookies', 1);
ini_set('session.use_strict_mode', 1);

session_set_cookie_params([
    'lifetime'=> 10800,     // Session cookie lifetime in seconds before being destroyed (3 Hours)
    'domain'=> DOMAIN,     // Change this to the proper domain name in production i.e example.com
    'path'=> '/',     // Allow any path inside our website
    'secure'=> false,     // Change this to "true" in production while using SSL (Https)
    'httponly'=> true,     // Restricts script access to clients
]);

// START SESSION
session_start();

// FURTHER SECURING OUR SESSIONS
if (!isset($_SESSION['last_regeneration'])) {
    // If not set then user is running the page for the first time

    // Regenerate our session ID to a stronger version
    session_regenerate_id(true);
    // Set the regeneration time to the current time
    $_SESSION['last_regeneration'] = time();

} else {
    // Amount of time in seconds to check
    $interval = 60 * 180; // Every 3 Hours

    // Checking if current time has reached or exceeded the interval
    // time that we want to regenerate to a new version
    if (time()- $_SESSION['last_regeneration'] >= $interval) {
        // Regenerate our session ID to a stronger version
        session_regenerate_id(true);
        $_SESSION['last_regeneration'] = time();
    }
}
