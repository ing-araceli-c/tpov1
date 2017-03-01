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
 * Date           2/20/14
 * Time           10:10 PM
 * Project        installer
 *
 *
 * File Name:     init.php
 *
 * LICENSE AGREEMENT:
 *
 * This source file is subject to the licensing terms that
 * is available through the world-wide-web at the following URI:
 * http://simtabi.com/support/license/
 *
 *
 */







/*
* Security fix to dis allow direct file access!
*/
defined('____DONT')
or die('Not allowed to directly access ME :( Sorry folk :)!');




/*
 * Time to trigger the  system and see if it'll jerk up alive!
 * But first let's define some few constants!
 */

define('corePath', dirname(__FILE__));
define('cmsVersion', '1.a');
define('theDir', DIRECTORY_SEPARATOR);
define("theInst", str_replace('installer', '', BASE));



/*
 * SetUp a working environment! :)
 */
if( $state == "local" || $state == "testing" ){
    ini_set( "display_errors", "0" );
    error_reporting( E_ALL & ~E_NOTICE );
}else{
    error_reporting( 0 );
}



$instPath = str_replace('/installer', '', dirname($_SERVER['SCRIPT_NAME']));

$_SERVER['REQUEST_TIME'] = time();


$_REQUEST = array_merge($_POST, $_GET);

/*
 * Start the SESSION! :)
 */
ob_start();
session_start();


/*
 * Check if system is installed and prompt
 * the Installer!
 */
/*
$charlieConfig = corePath . "/includes/config.php";
if (file_exists($charlieConfig)) {
    require_once($charlieConfig);
} else {
    header("Location: installer/");
}
*/

$_REQUEST = array_merge($_POST, $_GET);

require_once(corePath . '/functions/functions.php');

try{
    /*
     * Load and include all required CLASSES!
     * require_once(corePath . ' .class.php');
     */
    //Load ERROR Class
    require_once(corePath . '/classes/error.class.php');
    set_error_handler( 'Error::log', E_ALL );

    //Load FUNCTIONS
    require_once(corePath . '/functions/functions.php');


}catch (Exception $e){
    die('Error booting Up!');
}



$step = !isset($_REQUEST['step']) ? 0 : (int)$_REQUEST['step'];


/*
 * Let's check if the user requested for the help/wiki,
 * else if not TRUE then we show Him/Her the Installer
 */
if(isset($_REQUEST['help'])){

    $helpWiki = sanitize(!isset($_REQUEST['help'])) ? '' : $_REQUEST['help'];

    /*
     * Let's include the wiki's footer. All the stylesheets required for the proper
     * functioning of the system.
     */
    include(corePath . '/views/includes/wikiHeader.php');

    switch($helpWiki) {
        case "dashboard": include(corePath . '/views/wiki/home.php'); break;
        case "inbox": include(corePath . '/views/wiki/home.php'); break;


        default: include(corePath . '/views/wiki/home.php');

    }


    /*
     * Let's include the wiki's footer. All the scripts required for the proper
     * functioning of the system.
     */
    include(corePath . '/views/includes/wikiFooter.php');

}else{
    /*
     * Let's include the installer footer. All the stylesheets required for the proper
     * functioning of the system.
     */
    include(corePath . '/views/includes/instHeader.php');

            if(!$step){
                clearstatcache();

                //Launch the Installer Interface
                include(corePath . '/views/installer/_____001_preInstall.php');
            }elseif ($step == 1){

                //Load a Read Me file or any if available
                include(corePath . '/views/installer/_____002_readMe.php');
            }elseif ($step == 2){

                //Set up the database and other MySQL related connections
                include(corePath . '/views/installer/_____003_dbConfig.php');
            }elseif ($step == 3){
                //Let's query the database, but before that we'll test for
                //it's connectivity
                include(corePath . '/views/installer/_____004_dbQuery.php');
            }elseif ($step == 4){

                //Time to configure your app's/CMS's CORE configuration settings!
                include(corePath . '/views/installer/_____005_coreConfig.php');
            }elseif ($step == 5){

                //If all the other preceding steps were successful, then set up an
                //admin account!
                include(corePath . '/views/installer/_____006_adminConfig.php');
            }elseif ($step == 6){

                //After a successful installation, wouldn't it be nice if we showed you
                //up some basic login credentials etc?
                include(corePath . '/views/installer/_____007_postInstall.php');
                
                if ( $state <> "local" && $state <> "testing" ){
                   unlink(__DIR__."/../index.php");
                   rename(__DIR__."/../index.int", __DIR__."/../index.php");
                   rrmdir(__DIR__."/../../install");
                }
                
            }else{

                //If the user made a "NASTY" request then throw him/her a "NASTY" error message!
                include(corePath . '/views/installer/notFound.php');
            }
    /*
     * Let's include the installer footer. All the scripts required for the proper
     * functioning of the system.
     */
    include(corePath . '/views/includes/instFooter.php');
}


