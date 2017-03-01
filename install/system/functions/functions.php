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
 * Time           12:29 PM
 * Project        theCharlie CMS
 *
 *
 * File Name:     functions.php
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

include_once(corePath . '/controllers/installer.php');



/***********************************************************************************************************************
 *
 *
 *                      Time to start the installer functions controllers!
 *
 *
 **********************************************************************************************************************/

function sanitize($string, $trim = false){
    $string = filter_var($string, FILTER_SANITIZE_STRING);
    $string = trim($string);
    $string = stripslashes($string);
    $string = strip_tags($string);
    $string = str_replace(array('‘','’','“','”'), array("'","'",'"','"'), $string);
    if($trim)
        $string = substr($string, 0, $trim);

    return $string;
}

function dumpSQL($filename, $con){
    global $success,$error;
    $templine = '';

    $lines = file($filename);
    foreach ($lines as $line_num => $line) {
        if (substr($line, 0, 2) != '--' && $line != '') {
            $templine .= $line;
            if (substr(trim($line), -1, 1) == ';') {
                if (!mysqli_query($con, $templine )) {
                    $success = false;
                    $error = '
                    <div class="alert alert-warning alert-dismissable">
                      <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                      <strong>Heey!</strong> Sorry we ' . mysqli_errno() .' ' . mysqli_error() .' while querying the following:
                      {$templine}
                    </div>
                  ';
                }
                $templine = '';
            }
        }
    }
}

function genConfig($dbHost, $dbUser, $dbPass, $dbName){
    global $success;

  	$url_root = $_SERVER['REQUEST_SCHEME'] . "://".$_SERVER['HTTP_HOST'].":".$_SERVER['SERVER_PORT'].$_SERVER['REQUEST_URI'];
   $postemporal = strpos($url_root, '?');
   if (!($postemporal === false)) {
     	$url_root = substr($url_root, 0, $postemporal); 
   }
   $url_root = str_replace("install/", "", $url_root);

  
   $dir_root  = __DIR__;   
   $dir_root = str_replace("install/system/functions", "", $dir_root);
  
   $url_base = str_replace("tpov1/", "", $url_root);
   
   $dir_comun = __DIR__;
   $dir_comun = str_replace("install/system/functions", "", $dir_comun);
   $dir_comun = str_replace("tpov1/", "", $dir_comun);

   $content = "<?php
	define('dbHOST',    base64_decode('".base64_encode($dbHost)."'));
	define('dbUSER',    base64_decode('".base64_encode($dbUser)."'));
	define('dbPASS',    base64_decode('".base64_encode($dbPass)."'));
	define('dbNAME',    base64_decode('".base64_encode($dbName)."'));
        define('IURL_ROOT', base64_decode('". base64_encode($url_root)."'));
        define('IDIR_ROOT', base64_decode('". base64_encode($dir_root)."'));
        define('IURL_COMUN',base64_decode('". base64_encode($url_base)."'));
 	define('IDIR_COMUN',base64_decode('". base64_encode($dir_comun)."'));      
?>
";

    $confile = BASE_CONFIG;
    if (is_writable($confile)) {
        $handle = fopen($confile, 'w');
        fwrite($handle, $content);
        fclose($handle);
        $success = true;
    } else {
        $success = false;
    }
    
    $dir_htaccess = $_SERVER['REQUEST_URI'];  
    $dir_htaccess = str_replace("install/", "", $dir_htaccess);
    $postemporal = strpos($dir_htaccess, '?');
    if (!($postemporal === false)) {
      	$dir_htaccess = substr($dir_htaccess, 0, $postemporal); 
    }
   
$content = "<IfModule mod_rewrite.c>
RewriteEngine On

RewriteRule ^index\.php$ - [L]

Options -Indexes

RewriteCond %{REQUEST_FILENAME} !-f
RewriteCond %{REQUEST_FILENAME} !-d 
RewriteRule . ".$dir_htaccess."index.php [L]

RewriteRule ^index.php/(.*)$ [L]
</IfModule>";

    $confile = $dir_root . ".htaccess";
    if (is_writable($confile)) {
        $handle = fopen($confile, 'w');
        fwrite($handle, $content);
        fclose($handle);
        $success = true;
    } else {
        $success = false;
    }    
}

function isValidURL($url) {
    return preg_match('|^http(s)?://[a-z0-9-]+(.[a-z0-9-]+)*(:[0-9]+)?(/.*)?$|i', $url);
}

function isValidUsername($str) {
    return preg_match('/^[a-zA-Z0-9-_]+$/',$str);
}

function isValidEmail($str) {
    return filter_var($str, FILTER_VALIDATE_EMAIL);
}

function softTrim($text, $count, $wrapText=''){

    if(strlen($text)>$count){
        preg_match('/^.{0,' . $count . '}(?:.*?)\b/siu', $text, $matches);
        $text = $matches[0];
    }else{
        $wrapText = '';
    }
    return $text . $wrapText;

    // echo softTrim("Lorem Ipsum is simply dummy text", 10);
    /* Output: Lorem Ipsum... */

    // echo softTrim("Lorem Ipsum is simply dummy text", 33);
    /* Output: Lorem Ipsum is simply dummy text */

    // echo softTrim("LoremIpsumissimplydummytext", 10);
    /* Output: LoremIpsumissimplydummytext... */
}

function safeConfig($dbHost, $dbUser, $dbPass, $dbName){
    $content = "<?php
/**
 *
 * @Created       By SimTabi™
 *
 * @Company       SimTabi™ Creative Studios <info@simtabi.com>
 * @Author        Imani Manyara <imani@simtabi.com>
 * @Copyright     Copyright © 2011-2012 SimTabi™ Creatives
 * @License       http://simtabi.com/support/license/
 * @URL           http://simtabi.com/
 *
 * Date & Time    Generated ".date('F j, Y H:i:s')."
 *
 * Updated
 *
 * File:
 *
 * LICENSE AGREEMENT:
 *
 * This source file is subject to the licensing terms that
 * is available through the world-wide-web at the following URI:
 * http://simtabi.com/support/license/
 *
 *
 */

	// Database Access Credentials
	// Unless you know what you're doing, don't get crazy!!!
	define('dbHOST', '".$dbHost."');
	define('dbUSER', '".$dbUser."');
	define('dbPASS', '".$dbPass."');
	define('dbNAME', '".$dbName."');




	// Hope you Enjoy! Have fun!

?>
";

    return $content;
}

function  baseUrl(){
    /* First we need to get the protocol the website is using */
    $protocol = strtolower(substr($_SERVER["SERVER_PROTOCOL"], 0, 5)) == 'https' ? 'https://' : 'http://';

    /* returns /myproject/index.php */
    $path = $_SERVER['PHP_SELF'];

    /*
     * returns an array with:
     * Array (
     *  [dirname] => /myproject/
     *  [basename] => index.php
     *  [extension] => php
     *  [filename] => index
     * )
     */
    $path_parts = pathinfo($path);
    $directory = $path_parts['dirname'];
    /*
     * If we are visiting a page off the base URL, the dirname would just be a "/",
     * If it is, we would want to remove this
     */
    $directory = ($directory == "/") ? "" : $directory;

    /* Returns localhost OR mysite.com */
    $host = $_SERVER['HTTP_HOST'];

    /*
     * Returns:
     * http://localhost/mysite
     * OR
     * https://mysite.com
     */
    //return $protocol . $host . $directory;
    return $protocol . $host . $directory;
}

function ifOptions($getOptions){
    $result = (ini_get($getOptions) == '1' ? 'ON' : 'OFF');
    return $result;
}

function ifWritable($theDirectory){
    echo '<tr>';
    if (is_file( BASE . $theDirectory )) {
       echo '<td> Archivo: '.BASE.$theDirectory.'</td>';
    } else {
       echo '<td> Directorio: '.BASE.$theDirectory.'/</td>';
    }   
    echo '<td class="col-lg-2 text-center">';
    echo is_writable(theInst.$theDirectory) ? '<span class="label label-success"> Con permiso de escritura </span>' : '<span class="label label-danger"> Sin permiso de escritura </span>';
    echo '</td>';
    echo '</tr>';
}

function rrmdir($dir) { 
   if (is_dir($dir)) { 
     $objects = scandir($dir); 
     foreach ($objects as $object) { 
       if ($object != "." && $object != "..") { 
         if (is_dir($dir."/".$object))
           rrmdir($dir."/".$object);
         else
           if ($object<>"index.php") {
              unlink($dir."/".$object); 
           }
       } 
     }
     rmdir($dir); 
   } 
 }
