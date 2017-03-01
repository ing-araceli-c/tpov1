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
 * Time           2:26 PM
 * Project        theCharlie CMS
 *
 *
 * File Name:     preInstall.php
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

    <div class="jumbotron">
        <center><h2>TPO Ver. <?php echo cmsVersion; ?></h2></center>
        <center>
           <a href="http://inicio.ifai.org.mx/SitePages/ifai.aspx" target="_inai">
              <img src="assets/img/logo.png" width=200 />
           </a> 
           <a href="http://fundar.org.mx/" target="_fundar">
              <img src="assets/img/logofundar.png" width=200 style="margin-left:50px;"/>
          </a>
        <center>
        <p>Instalación del módulo "TPO Front", Ver. <?php echo cmsVersion; ?></p>
    </div>

    <div class="clearfix theInner">

        <div class="col-lg-6 paddingBlock">

            <div class="clearfix thatHeader">
                <h3 class="theHeading">
                    <i class="fa fa-cogs"></i>                    
                      Requisitos de configuración del servidor y de instalación
                </h3>
                <p class="lead">
                    Las directivas siguientes deben cumplirse y están disponibles para el funcionamiento normal de la aplicación!
                </p>
            </div>

            <table class="table table-striped">
                <thead>
                <tr>
                    <th>#</th>
                    <th>Directiva</th>
                    <th class="col-lg-2 text-center">Resultado</th>
                </tr>
                </thead>
                <tbody>
                <tr>
                    <td>1</td>
                    <td>PHP version</td>
                    <td class="col-lg-2 text-center">
                        <?php echo version_compare("5.3.0", PHP_VERSION, ">") ? '<span class="label label-danger">Not Supported</span>' : '<span class="yes">'.PHP_VERSION.'</span>';?>
                    </td>
                </tr>
                <tr>
                    <td>2</td>
                    <td>MySQLi version</td>
                    <td class="col-lg-2 text-center">
                        <?php echo function_exists('mysqli_connect') ? '
                        <span class="label label-success">'. softTrim( mysqli_get_client_info() , 15) .'</span>
                            <div class="theTip">
                                <a role="button" data-content="'.  mysqli_get_client_info() .'" title="" data-toggle="popover" data-placement="top" href="#" data-original-title="Installed MySQLi Version Details">
                                 Read More
                                </a>
                            </div>
                        ' : '
                        <span class="label label-danger">MySQLi 5.x and Higher is REQUIRED!</span>
                        '; ?>
                    </td>
                </tr>
                <tr>
                    <td>3</td>
                    <td>MySQL support</td>
                    <td class="col-lg-2 text-center">
                        <?php echo function_exists('mysql_connect') ? '<span class="label label-success">Available</span>' : '<span class="label label-danger">Unavailable (required)</span>';?>
                    </td>
                </tr>
                <tr>
                    <td>4</td>
                    <td>GD extension</td>
                    <td class="col-lg-2 text-center">
                        <?php echo extension_loaded('gd') ? '<span class="label label-success">Available</span>' : '<span class="label label-danger">Unavailable (highly recommended)</span>';?>
                    </td>
                </tr>
                <tr>
                    <td>5</td>
                    <td>Zlib compression</td>
                    <td class="col-lg-2 text-center">
                        <?php echo extension_loaded('zlib') ? '<span class="label label-success">Available</span>' : '<span class="label label-danger">Unavailable (highly recommended)</span>';?>
                    </td>
                </tr>
                <tr>
                    <td>6</td>
                    <td>Mbstring extension</td>
                    <td class="col-lg-2 text-center">
                        <?php echo extension_loaded('mbstring') ? '<span class="label label-success">Available</span>' : '<span class="label label-danger">Unavailable (not a big deal!)</span>';?>
                    </td>
                </tr>
                </tbody>
            </table>
        </div>

        <div class="col-lg-6 paddingBlock">
            <div class="clearfix thatHeader">
                <h3 class="theHeading">
                    <i class="fa fa-code-fork"></i>
                    Configuraciones recomendadas
                </h3>
                <p class="lead">
                    ¡Las directrices siguientes se deben cumplir para el funcionamiento normal de la aplicación!
                </p>
            </div>

            <table class="table table-striped">
                <thead>
                <tr>
                    <th>#</th>
                    <th>Directiva</th>
                    <th>Recomendación</th>
                    <th class="col-lg-2 text-center">Resultado</th>
                </tr>
                </thead>
                <tbody>
                <?php $theOptions = array(
                    array ('File Uploads','file_uploads','ON'),
                    array ('Magic Quotes GPC','magic_quotes_gpc','OFF'),
                    array ('Register Globals','register_globals','OFF'));
                ?>
                <?php
                foreach ($theOptions as $theRequired):?>
                    <tr>
                        <td>#</td>
                        <td><?php echo $theRequired[0]; ?></td>
                        <td class="col-lg-2 text-center"><?php echo $theRequired[2]; ?></td>
                        <td class="col-lg-2 text-center">
                            <?php if ( ifOptions($theRequired[1]) == $theRequired[2] ):?>
                                <span class="label label-success">
                                        <?php else: ?>
                                </span>
                                <span class="label label-danger">
                                    <?php endif;?>
                                    <?php echo ifOptions($theRequired[1]); ?>
                                </span>
                        </td>
                    </tr>
                <?php endforeach;?>
                </tbody>
            </table>
        </div>

        <div class="col-lg-12 upperBlock paddingBlock">
            <div class="clearfix thatHeader">
                <h3 class="theHeading">
                    <i class="fa fa-folder-open"></i>
                    Directorio y permisos de archivo
                </h3>
                <p class="lead">
                    Se requieren los siguientes ajustes para el funcionamiento normal de la aplicación.
                </p>
                <p class="lead">
                    Directorio base del módulo: <br><?php echo BASE; ?> <br><br>
                    URL base del módulo: <br><?php echo URL_BASE; ?> 
                </p>
            </div>
            <table class="table table-striped">
                <thead>
                <tr>
                    <th>Directorio o archivo</th>
                    <th class="col-lg-2 text-center">Resultado</th>
                </tr>
                </thead>
                <tbody>
                <?php ifWritable( 'data');?>
                <?php ifWritable( 'data/config.php');?>
                <?php ifWritable( '.htaccess');?>
                </tbody>
            </table>

        </div>
    </div>


    <a href="./" class="btn btn-lg thatBtn btn-default pull-left">Validar</a>

    <a href="?step=1" class="btn btn-lg thatBtn btn-success pull-right">Continuar</a>



</div>



