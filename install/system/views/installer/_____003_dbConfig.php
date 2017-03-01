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
 * Time           4:20 PM
 * Project        theCharlie CMS
 *
 *
 * File Name:     dbConfig.php
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


?>








<div class="theWell clearfix">

    <form action="" method="POST" role="form" class="dbConfig">

        <div class="page-header">
            <h1>
                <i class="fa fa-chain"></i>
                Configuración de la base de datos
                <small>Conexión a MySQL</small>
            </h1>
        </div>
        <?php if(isset($error)) echo $error;?>
        <div class="clearfix theInner">

            <div class="clearfix thatHeader">
                <h3 class="theHeading">Las credenciales de base de datos</h3>
                <p class="lead">
                    Se requieren los siguientes ajustes para el funcionamiento normal de la aplicación.
                </p>
            </div>
            <hr class="theStrip">
            <div class="form-group">
                <div class="input-group col-xs-12">
                    <input type="text" class="form-control" placeholder="Servidor (IP o hostname)" name="dbHost" value="<?php if(isset($_POST['dbHost'])) { echo $_POST['dbHost']; }else echo('localhost'); ?>">
                    <span class="input-group-addon"><i class="fa fa-unlink"></i>Servidor (IP o hostname)</span>
                </div>
            </div>

            <div class="form-group">
                <div class="input-group col-xs-12">
                    <input type="text" class="form-control" placeholder="Usuario de MySQL" name="dbUser" value="<?php if(isset($_POST['dbUser'])) { echo $_POST['dbUser']; } ?>">
                    <span class="input-group-addon"><i class="fa fa-pencil-square-o"></i>Usuario de MySQL</span>
                </div>
            </div>

            <div class="form-group">
                <div class="input-group col-xs-12">
                    <input type="password" class="form-control" placeholder="Clave del usuario" name="dbPass" value="<?php if(isset($_POST['dbPass'])) { echo $_POST['dbPass']; } ?>">
                    <span class="input-group-addon"><i class="fa fa-lock"></i>Clave del usuario</span>
                </div>
            </div>

            <div class="form-group">
                <div class="input-group col-xs-12">
                    <input type="text" class="form-control" placeholder="Base de datos MySQL" name="dbName" value="<?php if(isset($_POST['dbName'])) { echo $_POST['dbName']; } ?>">
                    <span class="input-group-addon"><i class="fa fa-bars"></i>Base de datos MySQL</span>
                </div>
            </div>
            <hr class="theStrip">
        </div>
        
        <input type="hidden" name="dbQuery" value="" />

        <button type="submit" class="btn btn-lg thatBtn btn-success pull-right" name="setDb">Continuar</button>
    </form>
</div>
