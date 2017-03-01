   <?php
      $liga = getD3D("group_act") . getD3D("page_act");
   ?>
   <style>
      @media (max-width: 1100px) {
         .menu {
            display: none;
         }
         .menu2 {
            display: none;
         }
         .menu-btn {
            display:  block;
         }
      }
      @media (min-width: 1100px) {
         .menu {
            display: block;
         }
         .menu2 {
            display: block;
         }
         .menu-btn {
            display:  none;
         }
      }
   </style>
   <nav class="pushy pushy-left">
      <ul>
         <li><a href="Sys_Hub?v=Inicio&g=pages">Inicio</a></li>
         <li><a href="Sys_Hub?v=Presupuesto&g=pages">Presupuesto</a></li>
         <li><a href="Sys_Hub?v=Porproveedor&g=pages">Gasto por proveedor</a></li>
         <li><a href="Sys_Hub?v=Porservicio&g=pages">Gasto por tipo de servicio</a></li>
         <li><a href="Sys_Hub?v=Contratos&g=pages">Contratos y órdenes de compra</a></li>
         <li><a href="Sys_Hub?v=Campanasavisos&g=pages">Campanas y avisos institucionales</a></li>
         <li><a href="Sys_Hub?v=Sujetos&g=pages">Sujetos obligados</a></li>
         <li><a href="Sys_Hub?v=Erogaciones&g=pages">Erogaciones</a></li>
      </ul>
   </nav>
   <div class="site-overlay"></div>
   <div class="page">
      <table width="100%" class="opciones"> 
         <tr>
            <td width="30%" align="right"> 
               <p style="margin:10px;">Fecha de actualización:  
               <?php foreach($fechaact as $fecha) { echo $fecha->last_update . '.';  break;} ?>
               </p>
            </td>
         </tr>
      </table>
      <div class="menu" style="padding-top:15px;margin:auto;width:1100px;height:111px;">
         <ul style="height:150px;">
            <li style="width:6%;">
               <a href="Sys_Hub?v=Inicio&g=pages" 
                  <?php if (($liga === 'pages/Inicio') or ($liga === '')) { echo 'id="primero"'; } ?> >Inicio
               </a>
            </li>
            <li style="width:10%;">
               <a href="Sys_Hub?v=Presupuesto&g=pages"  
                  <?php if ($liga === 'pages/Presupuesto')   { echo 'id="primero"'; } ?> >Presupuesto
               </a>	
            </li>
            <li style="width:10%;">
               <a href="Sys_Hub?v=Porproveedor&g=pages"  
                  <?php if ($liga === 'pages/Porproveedor')   { echo 'id="primero"'; } ?> > Gasto por<br>proveedor
               </a>
            </li>
            <li style="width:12%;">
               <a href="Sys_Hub?v=Porservicio&g=pages" 
                  <?php if ($liga === 'pages/Porservicio')   { echo 'id="primero"'; } ?> > Gasto por tipo<br>de servicio
               </a>
            </li>
            <li style="width:15%;">
               <a href="Sys_Hub?v=Contratos&g=pages" 
                  <?php if ($liga === 'pages/Contratos')   { echo 'id="primero"'; } ?> > Contratos y <br>órdenes de compra
               </a>
            </li>
            <li style="width:17%;">
               <a href="Sys_Hub?v=Campanasavisos&g=pages" 
                  <?php if ($liga === 'pages/Campanasavisos')   { echo 'id="primero"'; } ?> > Campañas y <br>avisos institucionales
               </a>
            </li>
            <li style="width:10%;">
               <a href="Sys_Hub?v=Sujetos&g=pages" 
                  <?php if ($liga === 'pages/Sujetos')   { echo 'id="primero"'; } ?> >Sujetos<br>obligados
               </a>
            </li>
            <li style="width:10%;">
               <a href="Sys_Hub?v=Erogaciones&g=pages" 
                  <?php if ($liga === 'pages/Erogaciones')   { echo 'id="primero"'; } ?> > Erogaciones
               </a>
            </li>
         </ul>
      </div> 
   </div>
   <div class="menu-btn" style="padding-left:5%;">&#9776; Menu</div>
