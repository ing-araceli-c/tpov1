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
 * Date           2/18/14
 * Time           1:04 PM
 * Project        theCharlie CMS
 *
 *
 * File Name:     adminConfig.php
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

<form role="form" action="" method="post">
    <div class="theWell">
        <div class="page-header">
            <h1>
                <i class="fa fa-user-md"></i>                
Configuración del administrador del sistema
                <small>Creación de usuario</small>
            </h1>
        </div>
        <?php if(isset($error)) echo $error;?>
        <div class="form-group">
            <div class="input-group col-xs-12">
                <input type="text" class="form-control" placeholder="Nombres del usuario" name="fullNames" value="<?php if(isset($_POST['fullNames'])) { echo $_POST['fullNames']; } ?>">
                <span class="input-group-addon"><i class="fa fa-edit"></i>Nombre(s)</span>
            </div>
        </div>

        <div class="form-group">
            <div class="input-group col-xs-12">
                <input type="text" class="form-control" placeholder="Apellidos del usuario" name="apellidosNames" value="<?php if(isset($_POST['apellidosNames'])) { echo $_POST['apellidosNames']; } ?>">
                <span class="input-group-addon"><i class="fa fa-edit"></i>Apellido(s)</span>
            </div>
        </div>

        <div class="form-group">
            <div class="input-group col-xs-12">
                <input type="text" class="form-control" placeholder="Usuario" name="userName" value="<?php if(isset($_POST['userName'])) { echo $_POST['userName']; } ?>">
                <span class="input-group-addon"><i class="fa fa-user"></i>Usuario</span>
            </div>
        </div>

        <div class="form-group">
            <div class="input-group col-xs-12">
                <input type="password" class="form-control" placeholder="Clave" name="newPassword">
                <span class="input-group-addon"><i class="fa fa-lock"></i>Clave</span>
            </div>
        </div>

        <div class="form-group">
            <div class="input-group col-xs-12">
                <input type="password" class="form-control" placeholder="Confirmar Clave" name="confPassword">
                <span class="input-group-addon"><i class="fa fa-unlock-alt"></i>Confirmar Clave</span>
            </div>
        </div>

        <div class="form-group">
            <div class="input-group col-xs-12">
                <input type="email" class="form-control" placeholder="Correo del administrador" name="adminEmail" value="<?php if(isset($_POST['adminEmail'])) { echo $_POST['adminEmail']; } ?>">
                <span class="input-group-addon"><i class="fa fa-envelope"></i>Correo del administrador</span>
            </div>
            <!--p class="help-block">The CMS admin's email! Don't confuse with system Email!</p-->
        </div>

        <button type="submit" name="configAdmin" class="btn btn-lg thatBtn btn-success pull-right">Continuar</button>

    </div>

</form>


