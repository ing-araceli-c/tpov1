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
 * Time           4:22 PM
 * Project        theCharlie CMS
 *
 *
 * File Name:     installer.php
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
 * Let's setup a Database, but before hand we need to check if some CORE files are missing,
 * else create them and continue with the rest of the journey!
 */
if (isset($_POST['setDb'])) {

    /*
    //Check iv value is submitted and field is not empty!
    if (isset($_POST['dbHost']) and empty($_POST['dbHost']))
    {
        //Assign value to array!
        $dbHost = $_POST['dbHost'];
    }else{
        $error = '<div class="alert alert-danger">Please enter Database Host!</div>';
    }

    //Check iv value is submitted and field is not empty!
    if (isset($_POST['dbUser']) and empty($_POST['dbUser']))
    {
        //Assign value to array!
        $dbUser = $_POST['dbUser'];
    }else{
        $error = '<div class="alert alert-danger">Please enter Database Username!</div>';
    }

    //Check iv value is submitted and field is not empty!
    if (isset($_POST['dbName']) and !empty($_POST['dbName']))
    {
        //Assign value to array!
        $dbName = $_POST['dbName'];
    }else{
        $error = '<div class="alert alert-danger">Please enter Database Name!</div>';
    }

    //Check iv value is submitted and field is not empty!
    if (isset($_POST['dbPass']) and !empty($_POST['dbPass']))
    {
        //Assign value to array!
        $dbPass = $_POST['dbPass'];
    }else{
        $error = '<div class="alert alert-danger">Please enter Database Password!</div>';
    }
    */

    /*
     * Get POST values and assign them to variables
     */
    ini_set('display_errors', 0);

    $dbHost = $_POST['dbHost'];
    $dbUser = $_POST['dbUser'];
    $dbPass = $_POST['dbPass'];
    $dbName = $_POST['dbName'];

    /*
     * Let's see if we can connect to the Database with the credentials that we've been supplied with!
     * Else we throw you in some ERROR!
     */
	ini_set('display_errors', 0);
    if (version_compare(PHP_VERSION, '5.3', '>=')) {
	   error_reporting(E_ALL & ~E_NOTICE & ~E_DEPRECATED & ~E_STRICT & ~E_USER_NOTICE & ~E_USER_DEPRECATED);
    } else {
	   error_reporting(E_ALL & ~E_NOTICE & ~E_STRICT & ~E_USER_NOTICE);
    }

    $dbConnect = mysqli_connect($dbHost,$dbUser,$dbPass,$dbName);
    if (mysqli_connect_errno()) {
        $error = '
                      <div class="alert alert-success fade in">
                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                        <h4>¡Ocurrió un error!</h4>
                        <p>
                         No fue posible conectarse al servidor de MySQL: ' . mysqli_connect_error() . '
                        </p>
                      </div>
                  ';

    }else{
/* LFC
        $error = '
                      <div class="alert alert-success fade in">
                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                        <h4>¡Ocurrió un error!</h4>
                        <p>
                         We was able to connect with the Database!
                        </p>
                      </div>
                  ';
*/
        /*
         * Now if all is set and good!
         * Generate the Config file and kick systems up and running!
         */
        genConfig($dbHost, $dbUser, $dbPass, $dbName);
        if ($instPath == "/")
            $instPath = "";

        /*
         *Let's keep walking! LFC 4
         */
//echo "OK1";
//die;         
        header("Location: ./?step=4");
    }

    /*
     * Let's check if we could select a Database with the credentials that we've been given!
     * If we can't select it, then let's throw in an ERROR!
     */
    if (!mysqli_select_db($dbConnect,$dbName)) {
        $error = '
                    <div class="alert alert-danger fade in">
                      <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                      <h4>Se encontró un error</h4>
                      <p> Lamentablemente, no fue posible seleccionar la base de datos "' . sanitize($dbName) . '" con las credenciales proporcionadas.</p>
                      <br />
                      <p>
                      <button class="btn btn-danger" type="button">Error de MySQL ' . mysqli_error() . '</button>

                      </p>
                    </div>
                  ';

    }

    mysqli_close($dbConnect);
}


/*
 * Let's Query the Database!
 */
if (isset($_POST['dbQuery'])) {
    /*
     * Assign sample data value to variable in readiness for installation!
     */
    //$sampleData = $_POST['sampleData'];

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
        $dbConnect = mysqli_connect($dbHost,$dbUser,$dbPass,$dbName);
        if (mysqli_connect_errno()) {
            $error = '
                    <div class="alert alert-danger fade in">
                      <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                      <h4>Se encontró un error</h4>
                      <p> Lamentablemente, no fue posible seleccionar la base de datos "' . sanitize($dbName) . '" con las credenciales proporcionadas.</p>
                      <br />
                      <p>
                      <button class="btn btn-danger" type="button">MySQL Error : ' . mysqli_error() . '</button>
                      </p>
                    </div>
                  ';
        }else{

            /*
             * New we want to Create a database if it doesn't exist then we will dump some .SQL file into the newly created
             * database!
             */
// Ya existe la BD             
//            $sql = ("CREATE DATABASE IF NOT EXISTS `" . $dbName . "`;");
//            if (mysqli_query($dbConnect, $sql)) {
                /*
                 * Select Database
                 */
//                mysqli_select_db($dbName);
                /*
                 * Now let's dump the .SQL file!
                 */
                dumpSQL (corePath . '/db/structure.sql', $dbConnect);

                /*
                 * Redirect after successful dumping!
                 */                 
                header("Location: ./?step=4");
/*
            } else {
                $error = '
                      <div class="alert alert-danger fade in">
                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                        <h4>¡Ocurrió un error!</h4>
                        <p>
                          Sorry we ' . mysqli_error() .'
                        </p>
                      </div>
                  ';

            }
*/
        }

        mysqli_close($dbConnect);

    } else {
        $error = '
                      <div class="alert alert-danger fade in">
                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                        <h4>¡Ocurrió un error!</h4>
                        <p>
                          ¡Es necesario que el archivo de configuración "'. BASE_CONFIG .'" exista y tenga permisos de escritura!
                        </p>
                      </div>
                  ';
        header("Location: ./?step=2");
    }
}


/*
 * Let's setup the basic CORE CMS or whatever project you have settings!
 * After that, then we could continue to settings up a default user admin!
 */

/*Account info*/
if(isset($_POST['configCore'])){

    if (isset($_POST['URL_ADMINTPO'])) {
        $configURL = sanitize($_POST['URL_ADMINTPO']);
        if ($configURL == '') {
            unset($configURL);
        }
    }
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

    /*
    if (isset($_POST['sampleData'])) {
        $sampleData = sanitize($_POST['sampleData']);
        if ($sampleData == '') {
            unset($sampleData);
        }
    }

    $sampleData = sanitize(!isset($_POST['sampleData'])) ? '' : $_POST['sampleData'];

    /*EMail validation* LFC/
    if (!preg_match("/[0-9a-z_]+@[0-9a-z_^\.]+\.[a-z]{2,3}]+\.[a-z]{2,3}/i", $configEmail)){
        $error = '
                      <div class="alert alert-warning fade in">
                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                        <h4>¡Ocurrió un error!</h4>
                        <p>
                          That email doesn\'t seem to be damn right!
                        </p>
                      </div>
                  ';

    }
    */

    /*
    * Let's first ensure that all fields aren't submited empty!
    */
    if(!isset($configURL)){
        $error = '
                      <div class="alert alert-warning fade in">
                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                        <h4>¡Ocurrió un error!</h4>
                        <p>
                          ¡Por favor, rellene todos los campos y asegurarse de que son correctos!
                        </p>
                      </div>
                  ';

    }


    if(!isset($error)){
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
            $dbConnect = mysqli_connect($dbHost,$dbUser,$dbPass,$dbName);
            if (!$dbConnect) {
                $error = '
                    <div class="alert alert-danger fade in">
                      <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                      <h4>Se encontró un error</h4>
                      <p> Lamentablemente, no fue posible seleccionar la base de datos "' . sanitize($dbName) . '" con las credenciales proporcionadas.</p>
                      <br />
                      <p>
                      <button class="btn btn-danger" type="button">MySQL Error : ' . mysqli_error() . '</button>

                      </p>
                    </div>
                  ';
            }else{


                /*
                * Select Database and continue with the installation process!
                */
//LFC                mysqli_select_db($dbName);

                /*
                 * Now let's update the database with these new records!
                 * and then later we will need to install the sample data!
                 *
                 * But before that we want to be sure that the table is empty
                 * else we update if table isn't null!
                 */
                $query = "SELECT * FROM sys_settings";
                // execute query
                $result = mysqli_query($dbConnect, $query) or die ("Error in query: $query. ".mysqli_error());
                // see if any rows were returned

                                            
                if (mysqli_num_rows($result) > 0) {
                    $query = "SELECT urls_docs FROM sys_settings";
                     // execute query
                    $result = mysqli_query($dbConnect, $query);;
                    if (mysqli_connect_errno()) {
                       $theQueryOne = mysqli_query($dbConnect, 
                          "ALTER TABLE `sys_settings` ADD COLUMN `url_docs` VARCHAR(255) NULL AFTER `recaptcha`;");
                    }                    
                    $theQueryOne = mysqli_query($dbConnect, "
                                                    UPDATE `sys_settings` SET
                                                    `id_settings`='1',
                                                    `url_docs`='$configURL'
                                                ");
                }else{

                    /*
                     * Now let's update the database with these new records!
                     * and then later we will need to install the sample data!
                     */
                    $theQueryOne = mysqli_query($dbConnect, "
                                                INSERT INTO sys_settings
                                                (id_settings,recaptcha)
                                                VALUES ('1','$configRecaptcha');
                                               ");

                }



                /*
                 * Now let's dump the .SQL dummy data file!
                 */
                if (isset($_POST['sampleData'])) {
                    $dumpIt = true;
                    dumpSQL (corePath . '/db/dummydata.sql', $dbConnect);

                    if (!$dumpIt) {
                        $error = '
                                      <div class="alert alert-warning fade in">
                                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                                        <h4>¡Ocurrió un error!</h4>
                                        <p>
                                          ¡Error al poblar la base de datos! 
                                        </p>
                                      </div>
                                  ';

                    }else{
                        $error = '
                                      <div class="alert alert-success fade in">
                                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                                        <h4>¡Ocurrió un error!</h4>
                                        <p>
                                          ¡Error al poblar la base de datos! 
                                        </p>
                                      </div>
                                  ';

                    }


                }

                /*If information updated print error*/
/* LFC
                if ($theQueryOne && $sampleData == TRUE) {
                    $error = '
                      <div class="alert alert-success fade in">
                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                        <h4>¡Ocurrió un error!</h4>
                        <p>
                          Damn it! We\'ve successfully updated your settings! :)
                        </p>
                      </div>
                  ';
*/



                    /*
                     * now after successful database transactions....let's now
                     * roll over to the more crucial stage!
                     */
                    header("Location: ./?step=6");
/*
                }else{
                    $error = '
                      <div class="alert alert-danger fade in">
                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                        <h4>¡Ocurrió un error!</h4>
                        <p>
                          Sorry we could not make any database transactions! :( Please ensure that you have installed dummy Data!
                        </p>
                      </div>
                  ';
*/
                




            }

            mysqli_close($dbConnect);

        } else {
            $error = '
                      <div class="alert alert-danger fade in">
                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                        <h4>¡Ocurrió un error!</h4>
                        <p>
                          ¡Es necesario que el archivo de configuración "'. BASE_CONFIG .'" exista y tenga permisos de escritura!
                        </p>
                      </div>
                  ';
            header("Location: ./?step=2");
        }

    }

}



/*
 * After everything else is well configured, now it's time to setup
 * a default user Admin!
 */
if(isset($_POST['configAdmin'])){




    /*
     * Assign sample data value to variable in readiness for installation!
     *
     * $name = (isset($_POST['Name'])) ? $_POST['Name'] : '';
     *
     * or depending on what suits you!
     *
     * $configTitle = (!isset($_POST['configTitle'])) ? '' : $_POST['configTitle'];
     */
    $fullNames = (!isset($_POST['fullNames'])) ? '' : $_POST['fullNames'];
    $apellidosNames = (!isset($_POST['apellidosNames'])) ? '' : $_POST['apellidosNames'];    
    $userName = (!isset($_POST['userName'])) ? '' : $_POST['userName'];
    $newPassword = (!isset($_POST['newPassword'])) ? '' : $_POST['newPassword'];
    $confPassword = (!isset($_POST['confPassword'])) ? '' : $_POST['confPassword'];
    $adminEmail = (!isset($_POST['adminEmail'])) ? '' : $_POST['adminEmail'];

    $fullNames = sanitize($_POST['fullNames']);
    $apellidosNames = sanitize($_POST['apellidosNames']);
    $userName = sanitize($_POST['userName']);
    $newPassword = sanitize($_POST['newPassword']);
    $confPassword = sanitize($_POST['confPassword']);
    $adminEmail = sanitize($_POST['adminEmail']);

    /*
     * Let's first ensure that all fields aren't submited empty!
     */
    if(!isset($fullNames) || !isset($apellidosNames) || !isset($userName) || !isset($newPassword) || !isset($confPassword) || !isset($adminEmail))
    {
        $error = '
                      <div class="alert alert-warning fade in">
                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                        <h4>¡Ocurrió un error!</h4>
                        <p>
                          ¡Por favor, rellene todos los campos y asegurarse de que son correctos!
                        </p>
                      </div>

                  ';
    }


    /*EMail validation*/
/*    
    if (!preg_match("/[0-9a-z_]+@[0-9a-z_^\.]+\.[a-z]{2,3}/i", $adminEmail)){
        $error = '
                      <div class="alert alert-warning fade in">
                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                        <h4>¡Ocurrió un error!</h4>
                        <p>
                          That email doesn\'t seem to be damn right!
                        </p>
                      </div>
                  ';

    }
*/
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
        $dbConnect = mysqli_connect($dbHost,$dbUser,$dbPass,$dbName);


        /*
        * Select Database and continue with the installation process!
        */
//        mysqli_select_db($dbName) or die; mysqli_error();

        if (!$dbConnect) {
            $error = '
                    <div class="alert alert-danger fade in">
                      <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                      <h4>Se encontró un error</h4>
                      <p> Lamentablemente, no fue posible seleccionar la base de datos "' . sanitize($dbName) . '" con las credenciales proporcionadas.</p>
                      <br />
                      <p>
                      <button class="btn btn-danger" type="button">MySQL Error : ' . mysqli_error() . '</button>

                      </p>
                    </div>
                  ';
        }else{


            if(empty($fullNames)
                or empty($apellidosNames)            
                or empty($userName)
                or empty($newPassword)
                or empty($adminEmail)) {
                $error = '
                              <div class="alert alert-warning fade in">
                                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                        <h4>¡Ocurrió un error!</h4>
                        <p>
                          ¡Por favor, rellene todos los campos y asegurarse de que son correctos!
                        </p>
                              </div>
                          ';
            }
            elseif(!isValidUsername($userName)) {
                $error = '
                              <div class="alert alert-warning fade in">
                                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                        <h4>¡Ocurrió un error!</h4>
                                <p>
                                  ¡Proporcionar un nombre de usuario valido!
                                </p>
                              </div>
                          ';

            } 
/*            
            elseif(!isValidEmail($adminEmail)) {
                $error = '
                              <div class="alert alert-warning fade in">
                                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                        <h4>¡Ocurrió un error!</h4>
                                <p>
                                  ¡Proporcionar un correo valido!
                                </p>
                              </div>
                          ';

            }
*/             elseif($newPassword !== $confPassword) {
                $error = '
                              <div class="alert alert-warning fade in">
                                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                        <h4>¡Ocurrió un error!</h4>
                                <p>
                                  !Las claves de usuario no corresponden!
                                </p>
                              </div>
                          ';

            } else {

                /*
                 * Now let's update the database with these new records!
                 * and then later we will need to install the sample data!
                 */
                $newPassword = sha1($newPassword);
                $query = "SELECT * FROM sec_users";
                // execute query
                $result = mysqli_query($dbConnect, $query) or die ("Error in query: $query. ".mysqli_error());
                // see if any rows were returned
                if (mysqli_num_rows($result) > 0) {
                   $theQueryOne = mysqli_query($dbConnect, "
                   UPDATE `sec_users` SET 
                   `fname`='$fullNames',
                   `lname`='$apellidosNames',
                   `username`='$userName',
                   `password`='$newPassword',
                   `email`='$adminEmail',
                   `id_type_user`='1',
                   `active`='a'
                    WHERE `id_user`='1'
                   ");                
                   
                } else {
                   $theQueryOne = mysqli_query($dbConnect, "
                   INSERT INTO `sec_users` (`id_user`, 
                      `id_father`, 
                      `username`, 
                      `password`, 
                      `cookie_id`, 
                      `token`, 
                      `email`, 
                      `fname`, 
                      `lname`, 
                      `created`, 
                      `lastlogin`, 
                      `lastip`, 
                      `notes`, 
                      `id_type_user`, 
                      `record_user`, 
                      `last_update`, 
                      `active`) VALUES
                      (1, 
                       1, 
                       '$userName', 
                       '$newPassword', 
                       '0', 
                       '0', 
                       '$adminEmail', 
                       '$fullNames', 
                       '$apellidosNames', 
                       NOW(), 
                       NOW(), 
                       '127.0.0.1', 
                       NULL, 
                       1, 
                       1, 
                       NOW(), 
                       'a')");
                }


                if ($theQueryOne == TRUE){
                    $error = '
                              <div class="alert alert-success fade in">
                                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                                <h4>¡Ocurrió un error!</h4>
                                <p>
                                  ¡No fue posible actualizar los datos!
                                </p>
                              </div>
                          ';

                    /*
                     * now after successful database transactions....let's now
                     * roll over to the more crucial stage!
                     *
                     * But before that, i think it'll be better if we create assign some values
                     * to the session! We will need them later!
                     */
                    $_SESSION['install_userName'] = $_POST['userName'];
                    $_SESSION['install_newPassword'] = $_POST['newPassword'];

                    header("Location: ./?step=6");
                }else{
                    $error = '
                              <div class="alert alert-danger fade in">
                                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                                <h4>¡Ocurrió un error!</h4>
                                <p>
                                  ¡No fue posible actualizar los datos!
                                </p>
                              </div>
                          ';

                }



            }

        }

        mysqli_close($dbConnect);

    } else {
        $error = '
                      <div class="alert alert-danger fade in">
                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                        <h4>¡Ocurrió un error!</h4>
                        <p>
                          Sorry the config file is missing and so we gotta create it first!
                        </p>
                      </div>
                  ';
        header("Location: ./?step=2");
    }



}
