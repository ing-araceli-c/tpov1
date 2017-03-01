<?php
/**
 *
 * Created By    SimTabi™
 *
 * Company       SimTabi™ Creative Studios
 * Company URL   http://simtabi.com/ | info@simatbi.com
 * Author        @myImani | twitter.com/myImani
 * Author URL    www.mnimani.com | hello@mnimani.com
 * Copyright     Copyright © 2011-2013 SimTabi™ Creatives
 * License       http://simtabi.com/support/license/
 *            OR
 * License       http://envato.com/support/license/
 *
 * Date           2/17/14
 * Time           12:30 PM
 * Project        theCharlie CMS
 *
 *
 * File Name:     index.php
 *
 * LICENSE AGREEMENT:
 *
 * This assets file is subject to the licensing terms that
 * is available through the world-wide-web at the following URI:
 * http://simtabi.com/support/license/
 *
 *
 */
/* Not show Errors */
ini_set('display_errors', 0);
if (version_compare(PHP_VERSION, '5.3', '>=')) {
	error_reporting(E_ALL & ~E_NOTICE & ~E_DEPRECATED & ~E_STRICT & ~E_USER_NOTICE & ~E_USER_DEPRECATED);
} else {
	error_reporting(E_ALL & ~E_NOTICE & ~E_STRICT & ~E_USER_NOTICE);
}

/*Security fix to disable direct access to files*/
define( '____DONT', 1 );

//Please let's get the boll dribbling!
define('basePath', dirname(__FILE__));

/* LFC Incio */
$temporal = __DIR__;
$temporal = str_replace("install", "", $temporal);
define('BASE', $temporal );
define('BASE_CONFIG', $temporal . "data/config.php" );

$temporal = $_SERVER['REQUEST_SCHEME'] . "://".$_SERVER['HTTP_HOST'].":".$_SERVER['SERVER_PORT'].$_SERVER['REQUEST_URI'];
$temporal = str_replace("install/", "", $temporal);
$postemporal = strpos($temporal, '?');

if (!($postemporal === false)) {
   $temporal = substr($temporal, 0, $postemporal); 
}
define('URL_BASE', $temporal );

$state = "pro";
/* LFC Fin */


//Trigger the system!
include_once ('system/init.php');
