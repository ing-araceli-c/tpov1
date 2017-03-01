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
 * Time           1:47 PM
 * Project        theCharlie CMS
 *
 *
 * File Name:     dbQuery.php
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
    <div class="thisHome clearfix">
        <?php if(isset($error)) echo $error;?>
        <form action="" method="POST" role="form" class="form-inline dbQuery">
            <!-- Jumbotron -->
            <div class="jumbotron">
                <h1>
                    <i class="fa fa-refresh"></i>
                </h1>
                <h1>
                    Cargar datos del sistema.
                </h1>
                <p class="lead">
                    <h2>El sistema cuenta con datos iniciales, para su optimo funcionamiento.</h2>
                </p>
                <p>
                    (Este proceso puede tardar, favor de esperar)
                </p>
                    <button type="submit" class="btn btn-lg thatBtn btn-success testDb" name="dbQuery" style="margin-top:20px;" >
                       Continuar
                    </button>
            </div>

        </form>

    </div>
</div>


