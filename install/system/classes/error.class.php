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
 * Date           2/16/14
 * Time           10:40 AM
 * Project        theCharlie CMS
 *
 *
 * File Name:     error.class.php
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

class Error{
    /**
     * log the error to the errorsLog.log file inside the Core directory
     *
     * @param  integer $number  error number
     * @param  string  $string  the error
     * @param  string  $file    thefilename
     * @param  string  $line    line number
     * @param  array   $context ignore this value.
     * @return boolean           true on success, false on error.
     */
    public static function log( $number = 0, $string, $file = 'Undefined', $line = 'undefined', $context = array() )
    {
        $error_log = '['.date('H:i:s - d/m/Y', time()).']'."\n".
            'File: '.str_replace(corePath, '', $file).''."\n".
            'Line: '.$line.''."\n".
            'Error: '.$string.
            "\n------------------------------------------------------------ \n";
        try
        {
            $theFile = fopen( corePath . '/errors/errorLog.log', 'a' );
            $error = fwrite( $theFile, $error_log );
            fclose( $theFile );

            return true;
        }
        catch ( Exception $pe )
        {
            error_log( $error_log );
            error_log( print_r( $pe ) );

            return false;
        }
    }

    /**
     * Thow a custom PHP error message.
     *
     * @param  string $message   the error message
     * @param  contant $errorType the error type
     */
    public static function throwError( $message, $errorType = E_USER_ERROR)
    {
        restore_error_handler();
        trigger_error($message, $errorType);
        exit;
    }
}