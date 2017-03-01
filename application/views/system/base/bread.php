<!--- Breadcrumbs Inicio -->
<div class="col-md-2 espacio"></div>
<div class="col-md-8 espacio" style="margin-top:0;">
<!--h6 class="docs-header">breadcrumbs</h3-->
   <ul class="breadcrumb" style="width:777px;margin:auto;">
         <!--- Breadcrumbs Inicio -->
            <li><a href="Sys_Hub?v=Inicio&g=pages">Inicio</a></li>
<?php
	if ($page == "Presupuesto") {
?>
            <li><a href="Sys_Hub?v=Presupuesto&g=pages"> Presupuesto </a></li>
<?php
        }
	if ($page == "Porproveedor") {
?>
            <li><a href="Sys_Hub?v=Porproveedor&g=pages"> Gasto por proveedor </a></li>
<?php
        }
	if ($page == "PorproveedorDetalle") {
?>
        <li><a href="Sys_Hub?v=Porproveedor&g=pages"></li>
        <li><a href="Sys_Hub?v=Porproveedor&g=pages">Gasto por proveedor</a></li>
        <li><a href="Sys_Detalle2?v=PorproveedorDetalle&g=pages&proveedor=<?php echo $proveedor; ?>"> <?php echo getD3D("proveedor_name"); ?> </a></li>
                        
<?php
        }
	if ($page == "PorservicioDetalle") {
?>
            <li><a href="Sys_Hub?v=Porservicio&g=pages"></li>
            <li><a href="Sys_Hub?v=Porservicio&g=pages"> Gasto por tipo de servicio  </a></li> 
            <li><a href="Sys_Detalle3?v=PorservicioDetalle&g=pages&campana=<?php echo $campana; ?>"> Campañas y facturas</a></li>

<?php
        }
	if ($page == "contratoDetalle") {
?>
            <li><a href="Sys_Hub?v=Contratos&g=pages"> Contratos y órdenes de compra </a></li> 
            <li><a href="Sys_Detalle4?v=contratoDetalle&g=pages&contrato=<?php echo $contrato; ?>"> Contrato número: <?php echo getD3D("numero_contrato"); ?> </a></li>

<?php
        }
	if ($page == "ocDetalle") {
?>
            <li><a href="Sys_Hub?v=Contratos&g=pages"> Contratos y órdenes de compra </a></li> 
            <li><a href="Sys_Detalle4?v=ocDetalle&g=pages&oc=<?php echo $oc; ?>"> Orden de compra número: <?php echo getD3D("numero_oc"); ?></a></li>

<?php
        }
	if ($page == "campanaDetalle") {
?>
           <li><a href="Sys_Hub?v=Campanasavisos&g=pages"></li>
           <li><a href="Sys_Hub?v=Campanasavisos&g=pages"> Campañas y avisos institucionales </a></li>
           <li><a href="Sys_Detalle5?v=campanaDetalle&g=pages&campana=<?php echo $campana; ?>">
<?php echo getD3D("campana_name"); ?> </a></li>

<?php
        }
	if ($page == "erogacionesDetalle") {
?>
           <li><a href="Sys_Hub?v=Erogaciones&g=pages"> Erogaciones </a></li>
           <li><a href="Sys_Detalle7?v=erogacionesDetalle&g=pages&factura=<?php echo $factura; ?>"> Factura número: <?php echo getD3D("numero_factura"); ?> </a></li>
                        
<?php
        }
	if ($page == "Porservicio") {
?>
            <li><a href="Sys_Hub?v=Porservicio&g=pages"> Gasto por tipo de servicio </a></li>
<?php
        }
	if ($page == "Contratos") {
?>
            <li><a href="Sys_Hub?v=Contratos&g=pages"> Contratos y órdenes de compra </a></li>
<?php
        }
	if ($page == "Campanasavisos") {
?>
            <li><a href="Sys_Hub?v=Campanasavisos&g=pages"> Campañas y avisos institucionales </a></li>
<?php
        }
	if (($page == "Sujetos") or ($page == "sujetosDetalle")) {
?>
            <li><a href="Sys_Hub?v=Sujetos&g=pages"> Sujetos obligados </a></li>
<?php
        }
  	if ($page == "sujetosDetalle") {
?>
            <li><a href="Sys_Detalle6?so=<?php echo $_GET["so"]; ?>"> <?php echo getD3D("sujeto_obligado"); ?> </a></li>
<?php
        }
	if ($page == "Erogaciones") {
?>
            <li><a href="Sys_Hub?v=Erogaciones&g=pages"> Erogaciones </a></li>
<?php
        }
?>

   </ul>
</div>
<!--- Breadcrumbs Fin -->
  
