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
 * Date           2/19/14
 * Time           11:25 AM
 * Project        theCharlie CMS
 *
 *
 * File Name:     postInstall.php
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



<div class="theWell">

    <div class="clearfix">

        <div class="thatInstall">
            <h1><i class="fa fa-thumbs-o-up"></i></h1>
            <h1>¡Módulo instalado exitosamente!</h1>
        </div>

        <div class="clearfix theInner">
            <div class="clearfix thatHeader">
                <h3 class="theHeading">URL del módulo:</h3>
                <p class="lead">
                    El módulo ha sido instalado en la URL: <a href="<?php echo URL_BASE; ?>"><?php echo URL_BASE; ?></a>
                </p>
            </div>
            <div class="clearfix">
                <a href="<?php echo URL_BASE; ?>" class="btn btn-lg thatBtn btn-success pull-right">Ir al módulo</a>
            </div>
        </div>


    </div>

</div>


