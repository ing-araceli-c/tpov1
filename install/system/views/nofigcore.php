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
 * Date           2/21/14
 * Time           2:41 PM
 * Project        theCharlie CMS
 *
 *
 * File Name:     nofigcore.php
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
 * Let's setup the basic CORE CMS or whatever project you have settings!
 * After that, then we could continue to settings up a default user admin!
 */
if(isset($_POST['configCore'])){




    /*
     * Assign sample data value to variable in readiness for installation!
     *
     * $name = (isset($_POST['Name'])) ? $_POST['Name'] : '';
     *
     * or depending on what suits you!
     *
     * $configTitle = (!isset($_POST['configTitle'])) ? '' : $_POST['configTitle'];
     *
    $configTitle = (!isset($_POST['configTitle'])) ? '' : $_POST['configTitle'];
    $configDesc = (!isset($_POST['configDesc'])) ? '' : $_POST['configDesc'];
    $configKeywords = (!isset($_POST['configKeywords'])) ? '' : $_POST['configKeywords'];
    $configEmail = (!isset($_POST['configEmail'])) ? '' : $_POST['configEmail'];
    $configUploadSize = (!isset($_POST['configUploadSize'])) ? '' : $_POST['configUploadSize'];
    $sampleData = (!isset($_POST['sampleData'])) ? '' : $_POST['sampleData'];


    //if (!empty($_POST['name'])) $name = $_POST['name'];
    //else $name = '(enter your name)';



    /*
     * Let's first ensure that all fields aren't submited empty!
     */
    if(!isset($configTitle) || !isset($configDesc) || !isset($configKeywords) || !isset($configEmail) || !isset($configUploadSize))
    {
        $error = '
                    <div class="alert alert-warning alert-dismissable">
                      <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                      <strong>Warning!</strong> Please fill out all fields and ensure they are correctly filled in!
                    </div>
                  ';
    }


    /*
     * Let's define variables and assume them their values
     */
    /*
    if (isset($_POST['configTitle'])) {
        $configTitle = sanitize($_POST['configTitle']);
        if ($configTitle == '') {
            unset($configTitle);
        }
    }

    if (isset($_POST['configDesc'])) {
        $configDesc = sanitize($_POST['configDesc']);
        if ($configDesc == '') {
            unset($configDesc);
        }
    }

    if (isset($_POST['configKeywords'])) {
        $configKeywords = sanitize($_POST['configKeywords']);
        if ($configKeywords == '') {
            unset($configKeywords);
        }
    }

    if (isset($_POST['configEmail'])) {
        $configEmail = sanitize($_POST['configEmail']);
        if ($configEmail == '') {
            unset($configEmail);
        }
    }

    if (isset($_POST['configUploadSize'])) {
        $configUploadSize = sanitize($_POST['configUploadSize']);
        if ($configUploadSize == '') {
            unset($configUploadSize);
        }
    }

    if (isset($_POST['sampleData'])) {
        $sampleData = sanitize($_POST['sampleData']);
        if ($sampleData == '') {
            unset($sampleData);
        }
    }
    */
    /*EMail validation*/
    if (!preg_match("/[0-9a-z_]+@[0-9a-z_^\.]+\.[a-z]{2,3}/i", $configEmail))
    {
        $error = '
                    <div class="alert alert-warning alert-dismissable">
                      <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                      <strong>Hey Buddy!!</strong> That email doesn\'t seem to be damn right!
                    </div>
                  ';
    }





    /*
     * Let's check if the config file is missing, else we will return the user
     * a step back to create it and then continue with other operations!
     */
    $configFile = BASE_CONFIG;
    if (file_exists($configFile)) {

        require_once($configFile);

        $dbHost = dbHOST;
        $dbUser = dbUSER;
        $dbPass = dbPASS;
        $dbName = dbNAME;

        /*
         * Let's see if we can connect to the Database with the credentials that we've been supplied with!
         * Else we throw you in some ERROR!
         */
        $dbConnect = mysqli_connect($dbHost,$dbUser,$dbPass, $dbName);
        if (!$dbConnect) {
            $error = '
                    <div class="alert alert-danger fade in">
                      <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                      <h4>Oh Shit! You\'ve got an error!</h4>
                      <p> Unfortunately we was unable to select database ' . sanitize($dbName) . ' with the credentials that you had supplied us with.</p>
                      <br />
                      <p>
                      <button class="btn btn-danger" type="button">MySQL Error : ' . mysql_error() . '</button>

                      </p>
                    </div>
                  ';
        }else{


            /*
            * Select Database and continue with the installation process!
            */
            mysqli_select_db($dbName);

            /*
             * Now let's update the database with these new records!
             * and then later we will need to install the sample data!
             */
            $theQueryOne = mysqli_query("
            INSERT INTO settings
            (id,title,description,keywords,url,web_name,web_email,max_filesize,default_language,default_theme)
            VALUES ('1','$configTitle','$configDesc','$configKeywords','','','$configEmail','$configUploadSize','','');

            ");

            $theQueryOne = mysqli_query("
                UPDATE `settings` SET
                `id`='1',
                `title`='$configTitle',
                `description`='$configDesc',
                `keywords`='$configKeywords',
                `url`='',
                `web_name`='',
                `web_email`='$configEmail',
                `max_filesize`='$configUploadSize',
                `default_language`='',
                `default_theme`=''
                ");




            /*
             * Else if transactions isn't successful please throw in some error!
             */
            $error = '
                    <div class="alert alert-warning alert-dismissable">
                      <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                      <strong>Heey!</strong> Sorry we ' . mysqli_error() .'
                    </div>
                  ';


            $theQueryTwo = mysqli_query("
                UPDATE `plugins` SET
                `id`='1',
                `sliders`='1',
                `services`='1',
                `gallery`='1',
                `testimonials`='1',
                `portfolio`='1',
                `pages`='1',
                `articles`='1',
                `blog`='1'
                ");

            /*
             * Else if transactions isn't successful please throw in some error!
             */
            $error = '
                    <div class="alert alert-warning alert-dismissable">
                      <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                      <strong>Heey!</strong> Sorry we ' . mysqli_error() .'
                    </div>
                  ';

            /*
             * Now let's dump the .SQL dummy data file!
             */
            if ($theQueryOne || $theQueryTwo == TRUE && isset($_POST['sampleData'])) {
                $dumpIt = true;
                dumpSQL("./db/dummydata.sql");
                if (!$dumpIt) {
                    $error = '
                                    <div class="alert alert-warning alert-dismissable">
                                      <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                                      <strong>Heey!</strong> Sorry we could not dump for you your dummy data!
                                    </div>
                                ';
                }else{
                    $error = '
                                    <div class="alert alert-warning alert-dismissable">
                                      <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                                      <strong>Heey!</strong> Damn it! We dumped your data!
                                    </div>
                                ';
                }
            }



            if ($theQueryOne && $theQueryTwo == TRUE){
                $error = '
                                    <div class="alert alert-success alert-dismissable">
                                      <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                                      <strong>Heey!</strong> Damn it! We updated your database transactions! :)
                                    </div>
                                ';

                /*
                 * now after successful database transactions....let's now
                 * roll over to the more crucial stage!
                 */
                // header("Location: ./?step=5");
            }else{
                $error = '
                                    <div class="alert alert-warning alert-dismissable">
                                      <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                                      <strong>Heey!</strong> Sorry we could not complete your database transactions!
                                    </div>
                                ';
            }

        }

        mysqli_close($dbConnect);

    } else {

        $error = '
                    <div class="alert alert-success alert-dismissable">
                      <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                      <strong>Heey!</strong> Sorry the config file is missing and so we gotta create it first!
                    </div>
                  ';
        header("Location: ./?step=2");
    }



}















































/*
 * Now let's dump the .SQL dummy data file!
 */
if ($theQueryOne == TRUE && isset($sampleData)) {
    $dumpIt = true;
    dumpSQL("./db/dummydata.sql");
    if (!$dumpIt) {
        $error = '
                                    <div class="alert alert-warning alert-dismissable">
                                      <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                                      <strong>Heey!</strong> Sorry we could not dump for you your dummy data!
                                    </div>
                                ';
    }else{
        $error = '
                                    <div class="alert alert-warning alert-dismissable">
                                      <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                                      <strong>Heey!</strong> Damn it! We dumped your data!
                                    </div>
                                ';
    }
}



if ($theQueryOne && $theQueryTwo == TRUE){
    $error = '
                                    <div class="alert alert-success alert-dismissable">
                                      <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                                      <strong>Heey!</strong> Damn it! We updated your database transactions! :)
                                    </div>
                                ';

    /*
     * now after successful database transactions....let's now
     * roll over to the more crucial stage!
     */
    // header("Location: ./?step=5");
}else{
    $error = '
                                    <div class="alert alert-warning alert-dismissable">
                                      <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                                      <strong>Heey!</strong> Sorry we could not complete your database transactions!
                                    </div>
                                ';
}
