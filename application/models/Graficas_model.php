<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Graficas_model extends CI_Model {
   function __construct() {
      parent::__construct();
   }
	
   function leePresupuesto( $ejercicio="" ) {
   if ($ejercicio == "") {
      $query = $this->db->query("
select 
'Total' as partida, 
'Total' as denominacion, 
sum(a.monto_presupuesto) as monto_contrato, 
(select sum(ejercido) from vtab_presupuesto) as monto_ejercido,
(sum(a.monto_presupuesto) + sum(a.monto_modificacion)) as monto_total
from 
vact_presupuestos_desglose as a,
vact_presupuestos as c
where
a.active = 1 and 
c.active = 1 and 
a.id_presupuesto = c.id_presupuesto

union

select 
b.partida as partida, 
b.denominacion as denominacion, 
sum(a.monto_presupuesto) as monto_contrato, 
(select sum(z.monto_desglose)
from
vact_facturas as y,
vact_facturas_desglose as z
where
y.id_factura = z.id_factura and
y.id_presupuesto_concepto =a.id_presupuesto_concepto) as monto_ejercido,
(sum(a.monto_presupuesto) + sum(a.monto_modificacion)) as monto_total
from 
vact_presupuestos_desglose as a,
cat_presupuesto_conceptos as b,
vact_presupuestos as c
where
a.active = 1 and 
b.active = 1 and 
c.active = 1 and 
a.id_presupuesto = c.id_presupuesto and
a.id_presupuesto_concepto = b.id_presupesto_concepto
group by b.partida, b.denominacion");
	} else {
      $query = $this->db->query(" 
select 
'Total' as partida, 
'Total' as denominacion, 
sum(a.monto_presupuesto) as monto_contrato, 
(select sum(ejercido) from vtab_presupuesto where ejercicio = '". $ejercicio . "' ) as monto_ejercido,
(sum(a.monto_presupuesto) + sum(a.monto_modificacion)) as monto_total
from 
vact_presupuestos_desglose as a,
vact_presupuestos as c,
vact_ejercicios as d 
where
a.active = 1 and 
c.active = 1 and 
d.active = 1 and 
a.id_presupuesto = c.id_presupuesto and
d.id_ejercicio = c.id_ejercicio and
d.ejercicio = '". $ejercicio . "'
union
select
b.partida as partida, 
b.denominacion as denominacion, 
sum(a.monto_presupuesto) as monto_contrato, 
(select sum(z.monto_desglose) from vact_facturas as y, vact_facturas_desglose as z where y.id_factura = z.id_factura and
y.id_presupuesto_concepto =a.id_presupuesto_concepto) as monto_ejercido,
(sum(a.monto_presupuesto) + sum(a.monto_modificacion)) as monto_total
from 
vact_presupuestos_desglose as a,
cat_presupuesto_conceptos as b,
vact_presupuestos as c,
vact_ejercicios as d 
where
a.active = 1 and 
b.active = 1 and 
c.active = 1 and 
d.active = 1 and 
a.id_presupuesto = c.id_presupuesto and
a.id_presupuesto_concepto = b.id_presupesto_concepto and
d.id_ejercicio = c.id_ejercicio and
d.ejercicio = '". $ejercicio . "' 
group by b.partida, b.denominacion");	
	}
       if ($query->num_rows() > 0) {
    	   return $query->result();
       }
       return 0;
   }

   function leeProveedores() {
      $query = $this->db->get("vact_proveedores");	
      if ($query->num_rows() > 0) {
         return $query->result();
      }
      return 0;
   }

   function leeServicios() {
      $query = $this->db->get("cat_servicios_categorias");	
      if ($query->num_rows() > 0){
         return $query->result();
      }
      return 0;
   }

   function leeServicios_categorias() {
      $query = $this->db->query("SELECT titulo_grafica,	color_grafica, nombre_servicio_categoria
		FROM cat_servicios_categorias WHERE active=1 order by titulo_grafica");
	
      if ($query->num_rows() > 0){
         return $query->result();
      }
      return 0;
   }
	
   function leeMedios_contratos($id='') {
      $query = $this->db->query("SELECT vact_proveedores.id_proveedor,	contratos.monto
		FROM vact_proveedores
		LEFT JOIN (
			SELECT vact_contratos.id_proveedor, SUM(vact_ordenes_compra.monto_servicio) AS monto
			FROM
			vact_contratos
			LEFT JOIN vact_ordenes_compra ON vact_contratos.id_contrato = vact_ordenes_compra.id_contrato
			WHERE vact_contratos.numero_contrato NOT LIKE 'Sin contrato'
		) AS contratos ON vact_proveedores.id_proveedor = contratos.id_proveedor 
		WHERE vact_proveedores.id_proveedor = ".$id);
	
      if ($query->num_rows() > 0){
         return $query->result();
      }
      return 0;
   }

   function leeMedios_ordenes_compra($id='') {
      $query = $this->db->query("SELECT vact_proveedores.id_proveedor, contratos.monto
		FROM vact_proveedores
		 LEFT JOIN ( SELECT vact_contratos.id_proveedor, SUM(vact_ordenes_compra.monto_servicio) AS monto
			FROM vact_contratos
			LEFT JOIN vact_ordenes_compra ON vact_contratos.id_contrato = vact_ordenes_compra.id_contrato
			WHERE vact_contratos.numero_contrato LIKE 'Sin contrato'
		) AS contratos ON vact_proveedores.id_proveedor = contratos.id_proveedor 
		WHERE vact_proveedores.id_proveedor = ".$id);

      if ($query->num_rows() > 0){
         return $query->result();
      }
      return 0;
   }
	
   function leeServ_contratos($id='') {
      $query = $this->db->query("SELECT cat_servicios_categorias.id_servicio_categoria, contratos.monto
		FROM cat_servicios_categorias
		 LEFT JOIN ( SELECT vact_ordenes_compra.id_servicio_categoria, SUM(vact_ordenes_compra.monto_servicio) AS monto
			FROM vact_contratos
			LEFT JOIN vact_ordenes_compra ON vact_contratos.id_contrato = vact_ordenes_compra.id_contrato
			WHERE vact_contratos.numero_contrato NOT LIKE 'Sin contrato'
		) AS contratos ON cat_servicios_categorias.id_servicio_categoria = contratos.id_servicio_categoria
		WHERE cat_servicios_categorias.id_servicio_categoria = ".$id);
	
      if ($query->num_rows() > 0){
         return $query->result();
      }
      return 0;
   }

   function leeServ_ordenes_compra($id='') {
      $query = $this->db->query("SELECT cat_servicios_categorias.id_servicio_categoria, contratos.monto
		FROM cat_servicios_categorias
		 LEFT JOIN ( SELECT vact_ordenes_compra.id_servicio_categoria, SUM(vact_ordenes_compra.monto_servicio) AS monto
			FROM vact_contratos
			LEFT JOIN vact_ordenes_compra ON vact_contratos.id_contrato = vact_ordenes_compra.id_contrato
			WHERE vact_contratos.numero_contrato LIKE 'Sin contrato'
		) AS contratos ON cat_servicios_categorias.id_servicio_categoria = contratos.id_servicio_categoria
		WHERE cat_servicios_categorias.id_servicio_categoria = ".$id);

      if ($query->num_rows() > 0){
         return $query->result();
      }
      return 0;
   }
	
   function gastoPorServicio($ejercicio='') {
      if($ejercicio!='') {
      $query = $this->db->query("select id_mes, mes_corto, nombre_servicio_categoria, TRUNCATE(sum(monto),0) as monto
from vmeses_porservicio where ejercicio = '". $ejercicio ."' group by id_mes, mes_corto, nombre_servicio_categoria order by id_mes, nombre_servicio_categoria");
      } else {
      $query = $this->db->query("select id_mes, mes_corto, nombre_servicio_categoria, TRUNCATE(sum(monto),0) as monto
from vmeses_porservicio group by id_mes, mes_corto, nombre_servicio_categoria order by id_mes, nombre_servicio_categoria");      
      }
      if ($query->num_rows() > 0) {
         return $query->result();
      }
      return 0;
/*
      if($ejercicio!='') {
      $query = $this->db->query("select id_mes, mes_corto, nombre_servicio_categoria, TRUNCATE(sum(monto/1000),0) as monto
from vmeses_porservicio where ejercicio = '". $ejercicio ."' group by id_mes, mes_corto, nombre_servicio_categoria order by id_mes, nombre_servicio_categoria");
      } else {
      $query = $this->db->query("select id_mes, mes_corto, nombre_servicio_categoria, TRUNCATE(sum(monto/1000),0) as monto
from vmeses_porservicio group by id_mes, mes_corto, nombre_servicio_categoria order by id_mes, nombre_servicio_categoria");      
      }
      if ($query->num_rows() > 0) {
         return $query->result();
      }
      return 0;
*/      
   }

   function listaPorProveedor($minimo=0,$ejercicio='') {
      if($ejercicio!='') {
         $sqltext = 'select distinct proveedor as lista from vpor_proveedor 
                   where total >= ' . $minimo . ' and ejercicio = "' . $ejercicio . '"
                  union
                   select distinct categoria as lista from vpor_proveedor where total >= ' . $minimo . ' and ejercicio = "' . $ejercicio . '"
                  union
                   select distinct tipo as lista from vpor_proveedor where total >= ' . $minimo . ' and ejercicio = "' . $ejercicio . '"';
      } else {
         $sqltext = 'select distinct proveedor as lista from vpor_proveedor 
                   where total >= ' . $minimo . '
                  union
                   select distinct categoria as lista from vpor_proveedor where total >= ' . $minimo . '
                  union
                   select distinct tipo as lista from vpor_proveedor where total >= ' . $minimo;
      }
      $resultado = $this->db->query( $sqltext )->result();
      return $resultado;
   }

   function linksTipoPorProveedor($minimo=0,$ejercicio='') {
      $sqltext = 'select categoria, tipo, sum(total) as total, count(*) as numero from vpor_proveedor where total >= ' . $minimo;

      if($ejercicio!='') {
         $sqltext = $sqltext . ' and ejercicio = "' . $ejercicio . '"'; 
      }
      $sqltext = $sqltext . ' group by categoria, tipo'; 
      $resultado = $this->db->query( $sqltext )->result();
      return $resultado;
   }

   function linksPorProveedor($minimo=0,$ejercicio='') {
      $sqltext = 'select tipo, proveedor as proveedor1, sum(total) as total, sum(numero) as numero from vpor_proveedor where total >= ' . $minimo;
      if($ejercicio!='') {
         $sqltext = $sqltext . ' and ejercicio = "' . $ejercicio . '"'; 
      }
      $sqltext = $sqltext . ' group by tipo, proveedor'; 
      $resultado = $this->db->query( $sqltext )->result();
      return $resultado;
   }

   function getMaximodeProveedores($ejercicio='') {
      if($ejercicio!='') {
         $sqltext = 'select b.id_proveedor, sum(c.monto_desglose) as monto
                       from vact_facturas as b, vact_facturas_desglose as c, cat_ejercicios as d
                      where b.id_factura = c.id_factura and 
                            b.id_ejercicio = d.id_ejercicio and 
                            d.ejercicio = "'. $ejercicio .'" 
                   group by b.id_proveedor 
                   order by sum(c.monto_desglose) desc 
                      limit 29;';
      } else {     
         $sqltext = 'select b.id_proveedor, sum(c.monto_desglose) as monto
                       from vact_facturas as b, vact_facturas_desglose as c
                      where b.id_factura = c.id_factura 
                   group by b.id_proveedor 
                   order by sum(c.monto_desglose) desc 
                      limit 29;';
      }
      $resultado = $this->db->query( $sqltext )->result();
      if (count($resultado)>0) {
         $registro = array_pop ( $resultado );
         return $registro->monto;
      } else {
         return 0;
      }
   }
   
   function getTotalProveedores($ejercicio='') {
      if($ejercicio!='') {
         $sqltext = 'select b.id_proveedor, sum(c.monto_desglose) as monto
                       from vact_facturas as b, vact_facturas_desglose as c, cat_ejercicios as d
                      where b.id_factura = c.id_factura and 
                            b.id_ejercicio = d.id_ejercicio and 
                            d.ejercicio = "'. $ejercicio .'" 
                   group by b.id_proveedor 
                   order by sum(c.monto_desglose) desc;';
      } else {     
         $sqltext = 'select b.id_proveedor, sum(c.monto_desglose) as monto
                       from vact_facturas as b, vact_facturas_desglose as c
                      where b.id_factura = c.id_factura 
                   group by b.id_proveedor 
                   order by sum(c.monto_desglose) desc;';
      }
      $resultado = $this->db->query( $sqltext )->result();
      if (count($resultado)>1) {
         $registro = $resultado[1];
         return $registro->monto;
      } else {
         return 0;
      }
   }

// Indicadores
   function leeIndicadores( $ejercicio ) { 
      switch(getD3D("page_act")) {
         case 'Presupuesto':
            // indx1 Presupuesto original ($) en miles
            if (getD3D("Ejercicio")<>"") {
               $sqltext1 = 'select sum(original) as "valor1" from vtab_presupuesto where ejercicio = "' . getD3D("Ejercicio").'"'; 
            } else {
               $sqltext1 = 'select sum(original) as "valor1" from vtab_presupuesto';
            }  
            $indicador1 = $this->db->query( $sqltext1 )->result();
            foreach ($indicador1 as $indicador) {
                if ($indicador->valor1 == '') {
                   setD3D("indicador1", 0 );
                } else {
                   setD3D("indicador1", $indicador->valor1 );
                }
             }

            // indx2 Presupuesto ejercido ($) en miles  
/*            if (getD3D("Ejercicio")<>"") {
               $sqltext2 = 'select sum(ejercido) as "valor2" from vtab_presupuesto where ejercicio = "' . getD3D("Ejercicio").'"'; 
            } else {
               $sqltext2 = 'select sum(ejercido) as "valor2" from vtab_presupuesto'; 
            }  
            $indicador2 = $this->db->query( $sqltext2 )->result();
            foreach ($indicador2 as $indicador) {
                if ($indicador->valor2 == '') {
                   setD3D("indicador2", 0 );
                } else {
                   setD3D("indicador2", $indicador->valor2 );
                }
             }
*/
            if (getD3D("Ejercicio")<>"") {
               $sqltext2 = "SELECT sum( b.monto_desglose ) as valor2
                            FROM vact_facturas as a, vact_facturas_desglose as b, vact_ejercicios as c
                            WHERE a.id_factura = b.id_factura and a.id_ejercicio = c.id_ejercicio and c.ejercicio = '" . 
                            getD3D("Ejercicio")."'"; 
            } else {
               $sqltext2 = "SELECT sum( b.monto_desglose ) as valor2 
                            FROM vact_facturas as a, vact_facturas_desglose as b, vact_ejercicios as c
                            WHERE a.id_factura = b.id_factura and a.id_ejercicio = c.id_ejercicio"; 
            }  
            $indicador2 = $this->db->query( $sqltext2 )->result();
            foreach ($indicador2 as $indicador) {
                if ($indicador->valor2 == '') {
                   setD3D("indicador2", 0 );
                } else {
                   setD3D("indicador2", $indicador->valor2 );
                }
             }

            // indx3 Presupuesto modificado ($) en miles  
            if (getD3D("Ejercicio")<>"") {
               $sqltext3 = 'select sum(presupuesto) as "valor3" from vtab_presupuesto where ejercicio = "' . getD3D("Ejercicio").'"'; 
            } else {
               $sqltext3 = 'select sum(presupuesto) as "valor3" from vtab_presupuesto'; 
            }  
            $indicador3 = $this->db->query( $sqltext3 )->result();
            foreach ($indicador3 as $indicador) {
               $ind_valor3 = setD3D("indicador3", $indicador->valor3 . "->" . $ejercicio );
               if ($indicador->valor3 == '') {
                  setD3D("indicador3", getD3D("indicador1") );
               } else {
                  if (getD3D("indicador3") <> '-  ') {
                     setD3D("indicador3", $indicador->valor3 );
                  } else {
                     setD3D("indicador3", $indicador->valor3 );
                  }
               }
            }
	 break;
         case 'Porproveedor':
            // indx1 Provedores
            if (getD3D("Ejercicio")<>"") {
/*
               $sqltext1 = "select count(*) as valor1
                              from vact_proveedores 
                             where ((id_proveedor in (
                                      select id_proveedor 
                                        from vact_contratos as a, 
                                             vact_ejercicios as b
                                       where a.id_ejercicio = b.id_ejercicio and a.active = 1 and
                                             b.ejercicio = '" . getD3D("Ejercicio") . "')) or 
                                   (id_proveedor in (select id_proveedor 
                                                       from vact_facturas as a,
                                                            vact_ejercicios as b
                                                      where a.id_ejercicio = b.id_ejercicio and a.active = 1 and
                                                            b.ejercicio = '" . getD3D("Ejercicio") . "')) or 
                                   (id_proveedor in (select id_proveedor 
                                                       from vact_ordenes_compra as a,
                                                            vact_ejercicios as b
                                                      where a.id_ejercicio = b.id_ejercicio and a.active = 1 and
                                                            b.ejercicio = '" . getD3D("Ejercicio") . "'))) and active = 1"; 
               $sqltext1 = "select count(*) as valor1
                              from vact_proveedores 
                             where  (id_proveedor in (select id_proveedor 
                                                       from vact_facturas as a,
                                                            vact_ejercicios as b
                                                      where a.id_ejercicio = b.id_ejercicio and
                                                            b.ejercicio = '" . getD3D("Ejercicio") . "'))"; 
Solo facturas */

               $sqltext1 = 'select count(*) as valor1 from vtab_proveedores where ejercicio = "' . getD3D("Ejercicio") . '"';

            } else {
/*
               $sqltext1 = "select count(*) as valor1
                              from vact_proveedores 
                             where ((id_proveedor in (select id_proveedor from vact_contratos where active=1)) or 
                                   (id_proveedor in (select id_proveedor from vact_facturas where active=1)) or
                                   (id_proveedor in (select id_proveedor from vact_ordenes_compra where active=1))) and active = 1"; 
               $sqltext1 = "select count(*) as valor1
                              from vact_proveedores 
                             where ((id_proveedor in (select id_proveedor from vact_contratos)) or 
                                   (id_proveedor in (select id_proveedor from vact_facturas))) "; 
Solo facturas y contratos */
               $sqltext1 = 'select count(*) as valor1  from vtab_proveedores';
            }  
            $indicador1 = $this->db->query( $sqltext1 )->result();
            foreach ($indicador1 as $indicador) {
                if ($indicador->valor1 == '') {
                   setD3D("indicador1", 0 );
                } else {
                   setD3D("indicador1", $indicador->valor1 );
                }
             }
            // indx2 Monto Gastado ($) en miles  
/*
            if (getD3D("Ejercicio")<>"") {
               $sqltext2 = "select truncate((sum(`a`.`monto_desglose`) / 1000),0) as valor2
                            from vact_facturas_desglose a, 
                                 vact_facturas b,
                                 vact_ejercicios as c
                           where a.id_factura = b.id_factura and
                                 a.active = 1 and
                                 b.id_ejercicio = c.id_ejercicio and c.ejercicio = '" . 
                                 getD3D("Ejercicio")."'"; 
            } else {
               $sqltext2 = "select truncate((sum(`a`.`monto_desglose`) / 1000),0) as valor2
                            from vact_facturas_desglose a, 
                                 vact_facturas b
                           where a.id_factura = b.id_factura and
                                 a.active = 1 and
                                 b.active = 1";
            }  
            $indicador2 = $this->db->query( $sqltext2 )->result();
            foreach ($indicador2 as $indicador) {
                if ($indicador->valor2 == '') {
                   setD3D("indicador2", 0 );
                } else {
                   setD3D("indicador2", $indicador->valor2 );
                }
             }
            // indx2 Presupuesto ejercido ($) en miles  
            if (getD3D("Ejercicio")<>"") {
               $sqltext2 = 'select sum(ejercido/1000) as "valor2" from vtab_presupuesto where ejercicio = "' . getD3D("Ejercicio").'"'; 
            } else {
               $sqltext2 = 'select sum(ejercido/1000) as "valor2" from vtab_presupuesto'; 
            }  
            $indicador2 = $this->db->query( $sqltext2 )->result();
            foreach ($indicador2 as $indicador) {
                if ($indicador->valor2 == '') {
                   setD3D("indicador2", 0 );
                } else {
                   setD3D("indicador2", $indicador->valor2 );
                }
             }
*/
            // indx2 Presupuesto ejercido ($) en miles  
            if (getD3D("Ejercicio")<>"") {
               $sqltext2 = "SELECT truncate((sum(`b`.`monto_desglose`) / 1000),0) as valor2
                            FROM vact_facturas as a, vact_facturas_desglose as b, vact_ejercicios as c
                            WHERE a.id_factura = b.id_factura and a.id_ejercicio = c.id_ejercicio and c.ejercicio = '" . 
                            getD3D("Ejercicio")."'"; 
            } else {
               $sqltext2 = "SELECT truncate((sum(`b`.`monto_desglose`) / 1000),0) as valor2 
                            FROM vact_facturas as a, vact_facturas_desglose as b, vact_ejercicios as c
                            WHERE a.id_factura = b.id_factura and a.id_ejercicio = c.id_ejercicio"; 
            }  
            $indicador2 = $this->db->query( $sqltext2 )->result();
            foreach ($indicador2 as $indicador) {
                if ($indicador->valor2 == '') {
                   setD3D("indicador2", 0 );
                } else {
                   setD3D("indicador2", $indicador->valor2 );
                }
             }


	 break;
         case 'Porservicio':
            // indx1 Monto 1  ($) en miles
            if (getD3D("Ejercicio")<>"") {
               $sqltext1 = "SELECT TRUNCATE(sum( b.monto_desglose )/1000,0) as valor1 
                            FROM vact_facturas as a, vact_facturas_desglose as b, vact_ejercicios as c
                            WHERE b.id_servicio_clasificacion = 1 and 
                                  a.id_factura = b.id_factura and a.id_ejercicio = c.id_ejercicio and c.ejercicio = '" . 
                            getD3D("Ejercicio")."'"; 
            } else {
               $sqltext1 = "SELECT TRUNCATE(sum( b.monto_desglose )/1000,0) as valor1
                            FROM vact_facturas as a, vact_facturas_desglose as b, vact_ejercicios as c
                            WHERE b.id_servicio_clasificacion = 1 and a.id_factura = b.id_factura and a.id_ejercicio = c.id_ejercicio"; 
            }  
            $indicador1 = $this->db->query( $sqltext1 )->result();
            foreach ($indicador1 as $indicador) {
                if ($indicador->valor1 == '') {
                   setD3D("indicador1", 0 );
                } else {
                   setD3D("indicador1", $indicador->valor1 );
                }
             }
            // indx2 Monto 2  ($) en miles  
            if (getD3D("Ejercicio")<>"") {
               $sqltext2 = "SELECT TRUNCATE(sum( b.monto_desglose )/1000,0) as valor2 
                            FROM vact_facturas as a, vact_facturas_desglose as b, vact_ejercicios as c
                            WHERE b.id_servicio_clasificacion = 2 and 
                                  a.id_factura = b.id_factura and a.id_ejercicio = c.id_ejercicio and c.ejercicio = '" . 
                            getD3D("Ejercicio")."'"; 
            } else {
               $sqltext2 = "SELECT TRUNCATE(sum( b.monto_desglose )/1000,0) as valor2
                            FROM vact_facturas as a, vact_facturas_desglose as b, vact_ejercicios as c
                            WHERE b.id_servicio_clasificacion = 2 and a.id_factura = b.id_factura and a.id_ejercicio = c.id_ejercicio"; 
            }  
            $indicador2 = $this->db->query( $sqltext2 )->result();
            foreach ($indicador2 as $indicador) {
                if ($indicador->valor2 == '') {
                   setD3D("indicador2", 0 );
                } else {
                   setD3D("indicador2", $indicador->valor2 );
                }
             }
	 break;
         case 'Contratos':
            // indx1 Contratos
            if (getD3D("Ejercicio")<>"") {
               $sqltext1 = "SELECT count( * ) as valor1 
                            FROM vact_contratos as a, vact_ejercicios as b 
                            WHERE a.id_ejercicio = b.id_ejercicio and a.id_contrato > 1 and b.ejercicio = '". getD3D("Ejercicio")."'"; 
            } else {
               $sqltext1 = "SELECT count( * ) as valor1 
                            FROM vact_contratos as a, vact_ejercicios as b 
                            WHERE a.id_ejercicio = b.id_ejercicio and a.id_contrato > 1"; 
            }  
            $indicador1 = $this->db->query( $sqltext1 )->result();
            foreach ($indicador1 as $indicador) {
                if (($indicador->valor1 == '') or ($indicador->valor1 == '0')) {
                   setD3D("indicador1", 0 );
                } else {
                   setD3D("indicador1", $indicador->valor1 );
                }
             }
            // indx2 ordenes de compra  
            if (getD3D("Ejercicio")<>"") {
               $sqltext2= "SELECT count( * ) as valor2
                            FROM vact_ordenes_compra as a, vact_ejercicios as b 
                            WHERE a.id_ejercicio = b.id_ejercicio  and a.id_orden_compra > 1 and a.id_contrato = 1 and b.ejercicio = '". getD3D("Ejercicio")."'"; 
            } else {
               $sqltext2 = "SELECT count( * ) as valor2 
                            FROM vact_ordenes_compra as a, vact_ejercicios as b 
                            WHERE a.id_ejercicio = b.id_ejercicio and a.id_orden_compra > 1 and a.id_contrato = 1; "; 
            }  
            $indicador2 = $this->db->query( $sqltext2 )->result();
            foreach ($indicador2 as $indicador) {
                if (($indicador->valor2 == '') or ($indicador->valor2 == '0')) {
                   setD3D("indicador2", 0 );
                } else {
                   setD3D("indicador2", $indicador->valor2 );
                }
             }

            // indx3 Monto total gastado ($) en miles  
            if (getD3D("Ejercicio")<>"") {
               $sqltext3 = "SELECT TRUNCATE(sum( b.monto_desglose )/1000,0) as valor3 
                            FROM vact_facturas as a, vact_facturas_desglose as b, vact_ejercicios as c
                            WHERE a.id_factura = b.id_factura and a.id_ejercicio = c.id_ejercicio and c.ejercicio = '" . 
                            getD3D("Ejercicio")."'"; 
            } else {
               $sqltext3 = "SELECT TRUNCATE(sum( b.monto_desglose )/1000,0) as valor3 
                            FROM vact_facturas as a, vact_facturas_desglose as b, vact_ejercicios as c
                            WHERE a.id_factura = b.id_factura and a.id_ejercicio = c.id_ejercicio"; 
            }  
            $indicador3 = $this->db->query( $sqltext3 )->result();
            foreach ($indicador3 as $indicador) {
                if ($indicador->valor3 == '') {
                   setD3D("indicador3", 0 );
                } else {
                   setD3D("indicador3", $indicador->valor3 );
                }
             }
	 break;
         case 'Campanasavisos':         
            // indx1 Campañas
            if (getD3D("Ejercicio")<>"") {
               $sqltext1 = "SELECT count( * ) as valor1 
                            FROM vact_campana_aviso a, vact_ejercicios as b 
                            WHERE a.id_campana_tipo = 2 and a.id_ejercicio = b.id_ejercicio and b.ejercicio = '". getD3D("Ejercicio")."'"; 
            } else {
               $sqltext1 = "SELECT count( * ) as valor1 
                            FROM vact_campana_aviso as a 
                            WHERE a.id_campana_tipo = 2"; 
            }  
            $indicador1 = $this->db->query( $sqltext1 )->result();
            foreach ($indicador1 as $indicador) {
                if (($indicador->valor1 == '') or ($indicador->valor1 == '0')) {
                   setD3D("indicador1", 0 );
                } else {
                   setD3D("indicador1", $indicador->valor1 );
                }
             }
            // indx2 Avisos  
            if (getD3D("Ejercicio")<>"") {
               $sqltext2 = "SELECT count( * ) as valor2 
                            FROM vact_campana_aviso a, vact_ejercicios as b 
                            WHERE a.id_campana_tipo = 1 and a.id_ejercicio = b.id_ejercicio and b.ejercicio = '". getD3D("Ejercicio")."'"; 
            } else {
               $sqltext2 = "SELECT count( * ) as valor2 
                            FROM vact_campana_aviso as a
                            WHERE a.id_campana_tipo = 1"; 
            }  
            $indicador2 = $this->db->query( $sqltext2 )->result();
            foreach ($indicador2 as $indicador) {
                if (($indicador->valor2 == '') or ($indicador->valor2 == '0')) {
                   setD3D("indicador2", 0 );
                } else {
                   setD3D("indicador2", $indicador->valor2 );
                }
             }
             
             
            // indx3 Monto Gastado ($) en miles  
            if (getD3D("Ejercicio")<>"") {
               $sqltext3 = "select truncate((sum(`a`.`monto_desglose`) / 1000),0) as valor3
                            from vact_facturas_desglose a, 
                                 vact_facturas b,
                                 vact_ejercicios as c
                           where a.id_factura = b.id_factura and
                                 a.active = 1 and
                                 b.id_ejercicio = c.id_ejercicio and c.ejercicio = '" . 
                                 getD3D("Ejercicio")."'"; 
            } else {
               $sqltext3 = "select truncate((sum(`a`.`monto_desglose`) / 1000),0) as valor3
                            from vact_facturas_desglose a, 
                                 vact_facturas b
                           where a.id_factura = b.id_factura and
                                 a.active = 1 and
                                 b.active = 1";
            }  
            $indicador3 = $this->db->query( $sqltext3 )->result();
            foreach ($indicador3 as $indicador) {
                if ($indicador->valor3 == '') {
                   setD3D("indicador3", 0 );
                } else {
                   setD3D("indicador3", $indicador->valor3 );
                }
             }             
	 break;
         case 'Sujetos':
            // indx1 Sujetos Contratantes
            $sqltext1 = " SELECT count(*) as valor1 FROM tab_sujetos_obligados WHERE id_so_atribucion = 1 AND active = 1;"; 
            $indicador1 = $this->db->query( $sqltext1 )->result();
            foreach ($indicador1 as $indicador) {
                if (($indicador->valor1 == '') or ($indicador->valor1 == '0')) {
                   setD3D("indicador1", 0 );
                } else {
                   setD3D("indicador1", $indicador->valor1 );
                }
             }
            // indx2 Sujetos Solicitantes
            $sqltext2 = " SELECT count(*) as valor2 FROM tab_sujetos_obligados WHERE id_so_atribucion = 2 AND active = 1;"; 
            $indicador2 = $this->db->query( $sqltext2 )->result();
            foreach ($indicador2 as $indicador) {
                if (($indicador->valor2 == '') or ($indicador->valor2 == '0')) {
                   setD3D("indicador2", 0 );
                } else {
                   setD3D("indicador2", $indicador->valor2 );
                }
             }
            // indx3 Sujetos Ambos
            $sqltext3 = " SELECT count(*) as valor3 FROM tab_sujetos_obligados WHERE id_so_atribucion = 3 AND active = 1;"; 
            $indicador3 = $this->db->query( $sqltext3 )->result();
            foreach ($indicador3 as $indicador) {
                if (($indicador->valor3 == '') or ($indicador->valor3 == '0')) {
                   setD3D("indicador3", 0 );
                } else {
                   setD3D("indicador3", $indicador->valor3 );
                }
             }
	 break;
         case 'Erogaciones':
            // indx1 Provedores
            if (getD3D("Ejercicio")<>"") {
               $sqltext1 = "select count(*) as valor1
                              from vact_facturas a,  vact_ejercicios as b
                             where a.id_ejercicio = b.id_ejercicio and
                                   b.ejercicio = '" . getD3D("Ejercicio") ."'";
            } else {
               $sqltext1 = "select count(*) as valor1
                              from vact_facturas a";
            }  
            $indicador1 = $this->db->query( $sqltext1 )->result();
            foreach ($indicador1 as $indicador) {
                if ($indicador->valor1 == '') {
                   setD3D("indicador1", 0 );
                } else {
                   setD3D("indicador1", $indicador->valor1 );
                }
             }
            // indx2 Monto Gastado ($) en miles  
            if (getD3D("Ejercicio")<>"") {
               $sqltext2 = "select truncate((sum(`a`.`monto_desglose`) / 1000),0) as valor2
                            from vact_facturas_desglose a, 
                                 vact_facturas b,
                                 vact_ejercicios as c
                           where a.id_factura = b.id_factura and
                                 a.active = 1 and
                                 b.id_ejercicio = c.id_ejercicio and c.ejercicio = '" . 
                                 getD3D("Ejercicio")."'"; 
            } else {
               $sqltext2 = "select truncate((sum(`a`.`monto_desglose`) / 1000),0) as valor2
                            from vact_facturas_desglose a, 
                                 vact_facturas b
                           where a.id_factura = b.id_factura and
                                 a.active = 1 and
                                 b.active = 1";
            }  
            $indicador2 = $this->db->query( $sqltext2 )->result();
            foreach ($indicador2 as $indicador) {
                if ($indicador->valor2 == '') {
                   setD3D("indicador2", 0 );
                } else {
                   setD3D("indicador2", $indicador->valor2 );
                }
             }
      return '';
      }
   }

// Ejercicios
   function leeListBoxEjercicios() {
      $sqltext = "SELECT * FROM vact_ejercicios WHERE active=1 ORDER BY ejercicio ASC;";
      $ejercicios = $this->db->query( $sqltext )->result();
      $ejerciciostxtx = "";
      foreach ($ejercicios as $ejercicio) {
         if (getD3D("Ejercicio") == "") {
            $ejerciciostxtx = $ejerciciostxtx . '<option class="dc-select-option" value="' . $ejercicio->ejercicio . '">' . 
                                                 $ejercicio->ejercicio . '</option>';
         } else {
             if (getD3D("Ejercicio") == $ejercicio->ejercicio) {
                $ejerciciostxtx = $ejerciciostxtx . '<option class="dc-select-option" value="' . $ejercicio->ejercicio . 
                                                    '" selected="selected">' . $ejercicio->ejercicio . '</option>';
             } else {
                $ejerciciostxtx = $ejerciciostxtx . '<option class="dc-select-option" value="' . $ejercicio->ejercicio . '">' . 
                                                    $ejercicio->ejercicio . '</option>';
             }
         }
      }
      $this->leeIndicadores( getD3D("Ejercicio") );
      return $ejerciciostxtx; 
   }

   function leeBotonesEjercicios() {
      $sqltext = "SELECT * FROM vact_ejercicios WHERE active=1 ORDER BY ejercicio ASC;";
      $ejercicios = $this->db->query( $sqltext )->result();
      $ejerciciostxtx = "";
      foreach ($ejercicios as $ejercicio) {
         $ejerciciostxtx = $ejerciciostxtx . "<li class='year'>" . $ejercicio->ejercicio . '</li>';
      }
      $this->leeIndicadores( getD3D("Ejercicio") );
      return $ejerciciostxtx; 
   }

// Campañas y avisos grafica tree
   function leeTotalCA_SO( $ejecicio = "" ) {
      if ($ejecicio == "") {   
         $sqltext = "select count(*) as total from vact_campana_aviso as a";
      } else {
         $sqltext = "select count(*) as total from vact_campana_aviso as a 
where a.id_ejercicio in (
select b.id_ejercicio 
from 
cat_ejercicios as b
where a.id_ejercicio = b.id_ejercicio and b.ejercicio = '". $ejecicio . "' )";
      }
      $rtotales = $this->db->query( $sqltext )->result();
      foreach ($rtotales as $totales) {
         $total = $totales->total;
      }
      return $total;      
   }

   function leeTotalAvisos( $ejecicio = "" ) {
      if ($ejecicio == "") {   
         $sqltext = "select count(*) as total from vact_campana_aviso as a where a.id_campana_tipo=1";
      } else {
         $sqltext = "select count(*) as total from vact_campana_aviso as a 
where a.id_ejercicio in (
select b.id_ejercicio 
from 
cat_ejercicios as b
where a.id_ejercicio = b.id_ejercicio and b.ejercicio = '". $ejecicio . "' ) and a.id_campana_tipo=1";
      }
      $rtotales = $this->db->query( $sqltext )->result();
      foreach ($rtotales as $totales) {
         $total = $totales->total;
      }
      return $total;
   }

   function leeTotalCampanas( $ejecicio = "" ) {
      if ($ejecicio == "") {   
         $sqltext = "select count(*) as total from vact_campana_aviso as a where a.id_campana_tipo=2";
      } else {
         $sqltext = "select count(*) as total from vact_campana_aviso as a 
where a.id_ejercicio in (
select b.id_ejercicio 
from 
cat_ejercicios as b
where a.id_ejercicio = b.id_ejercicio and b.ejercicio = '". $ejecicio . "' ) and a.id_campana_tipo=2";
      }
      $rtotales = $this->db->query( $sqltext )->result();
      foreach ($rtotales as $totales) {
         $total = $totales->total;
      }
      return $total;
   }

/*
   function jsonDetalleSOAvisos( $id ) {
      $childrens = '';
      // Leer campañas de todos los SO
      $sqltext = "select a.nombre_campana_aviso as campana, count(*) as total from vact_campana_aviso as a 
where a.id_so_contratante = ". $id. " group by a.nombre_campana_aviso";
      $rtotales = $this->db->query( $sqltext )->result();
      $i = 0;
      foreach ($rtotales as $totales) {
         $i = $i + 1;
      }
      $j = 0;
      foreach ($rtotales as $totales) {
         $childrens = $childrens . '{"name": "' . $totales->campana . ' - '. $totales->total .
                      '", "size": ' .  $totales->total . '}';
         $j = $j + 1;
         if ($j < $i) {
             $childrens = $childrens . ',';
         }
      }
      return $childrens;
   }
*/
   function leeChildrenSOAvisos() {
      $sqltext = "select c.nombre_sujeto_obligado as sujeto, count(*) as total from vact_campana_aviso as a, vact_sujetos_obligados c where a.id_so_contratante = c.id_sujeto_obligado and a.id_campana_tipo=1 group by c.nombre_sujeto_obligado";
      $rtotales = $this->db->query( $sqltext )->result();
      $i = 0;
      $childrens = '';
      foreach ($rtotales as $totales) {
         $i = $i + 1;
      }
      $j = 0;
      foreach ($rtotales as $totales) {
         $childrens = $childrens . '{"name": "' . $totales->sujeto . ' - '. $totales->total .
                      '", "size": ' .  $totales->total . '}';
         $j = $j + 1;
         if ($j < $i) {
             $childrens = $childrens . ',';
         }
      }
      return $childrens;
   }

   function leeChildrenSOCampanas() {
      $sqltext = "select c.nombre_sujeto_obligado as sujeto, count(*) as total from vact_campana_aviso as a, vact_sujetos_obligados c where a.id_so_contratante = c.id_sujeto_obligado and a.id_campana_tipo=2 group by c.nombre_sujeto_obligado";
      $rtotales = $this->db->query( $sqltext )->result();
      $i = 0;
      $childrens = '';
      foreach ($rtotales as $totales) {
         $i = $i + 1;
      }
      $j = 0;
      foreach ($rtotales as $totales) {
         $childrens = $childrens . '{"name": "' . $totales->sujeto . ' - '. $totales->total .
                      '", "size": ' .  $totales->total . '}';
         $j = $j + 1;
         if ($j < $i) {
             $childrens = $childrens . ',';
         }
      }
      return $childrens;
   }


   function jsonDetalle1SO( $id ) {
      $childrens = '';
      // Leer campañas de todos los SO
      $sqltext = "select b.nombre_sujeto_obligado as so, 
(select count(*) as total from vact_campana_aviso as a 
where a.id_so_contratante = b.id_sujeto_obligado group by a.id_so_contratante) as total
from vact_sujetos_obligados as b
";
      $rtotales = $this->db->query( $sqltext )->result();
      $i = 0;
      foreach ($rtotales as $totales) {
         $i = $i + 1;
      }
      $j = 0;
      foreach ($rtotales as $totales) {
         $childrens = $childrens . '{"name": "' . $totales->so . ' - '. $totales->total .
                      '", "size": ' .  $totales->total . '}';
         $j = $j + 1;
         if ($j < $i) {
             $childrens = $childrens . ',';
         }
      }
      return $childrens;
   }

// DetalleSujetos Obligados

   function jsonDetalle2SO( $id ) {
      $childrens = '';
      // Leer campañas de todos los SO
      $sqltext = "select a.nombre_campana_aviso as campana, count(*) as total from vact_campana_aviso as a 
where a.id_so_contratante = ". $id. " group by a.nombre_campana_aviso";
      $rtotales = $this->db->query( $sqltext )->result();
      $i = 0;
      foreach ($rtotales as $totales) {
         $i = $i + 1;
      }
      $j = 0;
      foreach ($rtotales as $totales) {
         $childrens = $childrens . '{"name": "' . $totales->campana . ' - '. $totales->total .
                      '", "size": ' .  $totales->total . '}';
         $j = $j + 1;
         if ($j < $i) {
             $childrens = $childrens . ',';
         }
      }
      return $childrens;
   }

   function leeTotalSO( $id, $ejercicio ) {
      if ($id>0) {
         $sqltext = "select count(*) as total from vact_sujetos_obligados as a where a.id_so_atribucion = ". $id ;
      } else {
         $sqltext = "select count(*) as total from vact_sujetos_obligados as a;";
      }
      $rtotales = $this->db->query( $sqltext )->result();
      foreach ($rtotales as $totales) {
         $total = $totales->total;
      }
      return $total;
   }


   function leeTotalTituloSO( $id, $ejercicio ) {
      if ($id>0) {
         $sqltext = "select count(*) as total from vact_sujetos_obligados as a where a.id_so_atribucion = ". $id ;
      } else {
         $sqltext = "select count(*) as total from vact_sujetos_obligados as a;";
      }
      $rtotales = $this->db->query( $sqltext )->result();
      foreach ($rtotales as $totales) {
         $total = $totales->total;
      }
/*
      if ($total<1000) {
        $total = 1000;
      }
*/
      return $total;
   }

   function leeChildrenPesosCampanasSO( $filtro, $ejercicio, $so ) {
      if ($filtro==2) {
         if ($ejercicio =="") {
            $sqltext = "select CONCAT(a.nombre_campana_aviso,'.') as nombre, sum(b.monto_desglose) as total, a.id_campana_aviso+10000 as id
from 
vact_campana_aviso as a,
vact_facturas_desglose as b,
vact_facturas as c
where
b.id_factura = c.id_factura and
b.id_campana_aviso = a.id_campana_aviso and
a.id_so_solicitante in (" . $so . ") group by a.nombre_campana_aviso, a.id_campana_aviso";
         }  else {
            $sqltext = "select CONCAT(a.nombre_campana_aviso,'.') as nombre, sum(b.monto_desglose) as total, a.id_campana_aviso+10000 as id
from 
vact_campana_aviso as a,
vact_facturas_desglose as b,
vact_facturas as c,
cat_ejercicios as d
where
b.id_factura = c.id_factura and
a.id_ejercicio = d.id_ejercicio and
d.ejercicio = '". $ejercicio ."' and 
b.id_campana_aviso = a.id_campana_aviso and
a.id_so_solicitante in (" . $so . ") group by a.nombre_campana_aviso, a.id_campana_aviso";
         }
      } else {
         if ($ejercicio =="") {
            $sqltext = "select a.nombre_campana_aviso as nombre, sum(b.monto_desglose) as total, a.id_campana_aviso as id
from 
vact_campana_aviso as a,
vact_facturas_desglose as b,
vact_facturas as c
where
b.id_factura = c.id_factura and
b.id_campana_aviso = a.id_campana_aviso and
a.id_so_contratante in (" . $so . ") group by a.nombre_campana_aviso, a.id_campana_aviso";
         }  else {
            $sqltext = "select a.nombre_campana_aviso as nombre, sum(b.monto_desglose) as total, a.id_campana_aviso as id
from 
vact_campana_aviso as a,
vact_facturas_desglose as b,
vact_facturas as c,
cat_ejercicios as d
where
b.id_factura = c.id_factura and
a.id_ejercicio = d.id_ejercicio and
d.ejercicio = '". $ejercicio ."' and 
b.id_campana_aviso = a.id_campana_aviso and
a.id_so_contratante in (" . $so . ") group by a.nombre_campana_aviso, a.id_campana_aviso";
         }
      }
      $rtotales = $this->db->query( $sqltext )->result();
      $i = 0;
      $childrens = '';
      foreach ($rtotales as $totales) {
         $i = $i + 1;
      }
      $j = 0;
      foreach ($rtotales as $totales) {
         $childrens = $childrens . '{"name": "' . $totales->nombre . ' - $ '. number_format($totales->total, 0, ".", "," ).
                      '", "size": ' .  $totales->total .  ', "id": ' . $totales->id . 
                    '}';
         $j = $j + 1;
         if ($j < $i) {
             $childrens = $childrens . ',';
         }
      }
      if (strlen($childrens) == 0) {
         $childrens = '{"name": "N/D - $ 0", "size": 1000, "id": 1}';
      }
      return $childrens; 
   }

   function leeTotalChildrenPesosCampanasSO( $filtro, $ejercicio ) {
      if ($ejercicio =="") {
         $sqltext = "select count(*) as total
from 
vact_campana_aviso as a,
vact_facturas_desglose as b,
vact_facturas as c
where
b.id_factura = c.id_factura and
b.id_campana_aviso = a.id_campana_aviso and
a.id_so_contratante in (" . $filtro . ")";
      }  else {
         $sqltext = "select count(*) as total
from 
vact_campana_aviso as a,
vact_facturas_desglose as b,
vact_facturas as c,
cat_ejercicios as d
where
b.id_factura = c.id_factura and
a.id_ejercicio = d.id_ejercicio and
d.ejercicio = '". $ejercicio ."' and 
b.id_campana_aviso = a.id_campana_aviso and
a.id_so_contratante in (" . $filtro . ")";
      }

      $rtotales = $this->db->query( $sqltext )->result();
      foreach ($rtotales as $totales) {
         $total = $totales->total;
      }
      return $total;
   }

   function leeChildrenNombresSO( $id, $ejercicio ) {
      $childrens = '';
      if ($id>0) {
         $sqltext = "select nombre_sujeto_obligado as nombre, id_sujeto_obligado as id_so from vact_sujetos_obligados as a where a.id_so_atribucion = ". $id ;
      } else {
         $sqltext = "select nombre_sujeto_obligado as nombre, id_sujeto_obligado as id_so from vact_sujetos_obligados as a;";
      }
      $rnombres = $this->db->query( $sqltext )->result();
      $i = 0;
      foreach ($rnombres as $nombres) {
         $i = $i + 1;
      }
      $j = 0;
      foreach ($rnombres as $nombres) {
         $childrens = $childrens . '{"name": "' . $nombres->nombre.  '", "children": [' .
                   $this->leeChildrenPesosCampanasSO( $id, $ejercicio, $nombres->id_so ) . ']}';
         $j = $j + 1;
         if ($j < $i) {
             $childrens = $childrens . ',';
         }
      }
      if (strlen($childrens) == 0) {
         $childrens = $childrens . '{"name": "N/D", "children": []}';
      }
      return $childrens;
   }

// Sujetos Obligados LFC treemap2 **************************************************
   function jsonSO( $ejercicio ) {
      $childrens = '{"name": "Sujetos obligados: ' .  $this->leeTotalSO(0, $ejercicio) . '", "children": [';

//if ($this->leeTotalChildrenPesosCampanasSO(1, $ejercicio)>0) {
      $childrens = $childrens . '{"name": "Sujetos obligados contratantes: '. $this->leeTotalSO(1, $ejercicio) . 
                                '", "size": ' .  $this->leeTotalTituloSO(1, $ejercicio) . 
                                ', "children": [' . $this->leeChildrenNombresSO(1, $ejercicio) . ']},';
//}

//if ($this->leeTotalChildrenPesosCampanasSO(2, $ejercicio)>0) {
      $childrens = $childrens . '{"name": "Sujetos obligados solicitantes:'. $this->leeTotalSO(2, $ejercicio) . 
                                '", "size": ' .  $this->leeTotalTituloSO(2, $ejercicio) . 
                                ', "children": [' . $this->leeChildrenNombresSO(2, $ejercicio) . ']},';
//}

//if ($this->leeTotalChildrenPesosCampanasSO(3, $ejercicio)>0) {
     $childrens = $childrens . '{"name": "Sujetos obligados contratantes y solicitantes:'.  $this->leeTotalSO(3, $ejercicio) . 
                               '", "size": ' .  $this->leeTotalTituloSO(3, $ejercicio) . 
                               ', "children": [' . $this->leeChildrenNombresSO(3, $ejercicio) . ']}';
//}
      $childrens = $childrens . ']}';
      return $childrens;      
   }


/* Nuevo grafico treemap3
   function jsonSO() {
      $sqltext = "select 
a.nombre_sujeto_obligado as 'key',
(select nombre_so_atribucion as d
from cat_so_atribucion as d
where 
d.id_so_atribucion = a.id_so_atribucion) as 'region',
(select nombre_so_atribucion as d
from cat_so_atribucion as d
where 
d.id_so_atribucion = a.id_so_atribucion) as 'subregion',
(select IFNULL(TRUNCATE(sum(c.monto_desglose),0),0) as total from 
vact_facturas as b,
vact_facturas_desglose as c
where
b.id_factura = c.id_factura and
b.id_so_contratante = a.id_sujeto_obligado ) as value,
a.id_sujeto_obligado as so
from vact_sujetos_obligados as a";

      $childrens = '[';
      $rso = $this->db->query( $sqltext )->result();
      $i = 0;
      foreach ($rso as $so) {
         $i = $i + 1;
      }
      $j = 0;
      foreach ($rso as $so) {
/*         $childrens = $childrens . '{"key": "' . $so->key.  '",
                                     "region":"' . $so->region. '",
                                     "subregion":"' . $so->subregion. '",
                                     "id":"' . $so->so. '",
                                     "value":' . $so->value. '}';
*/
/*

         $childrens = $childrens . '{"key": "' . $so->key.  '",
                                     "region":"' . $so->region. '",
                                     "subregion":"' . $so->subregion. '",
                                     "value":' . $so->value. '}';
         $j = $j + 1;
         if ($j < $i) {
             $childrens = $childrens . ',';
         }
      }
      $childrens = $childrens . ']';
      return $childrens;      
   }
*/

// Funciones para exportar datos
   function leeTablas() {
      $sqltext = "SELECT table_name FROM information_schema.tables WHERE table_schema = 'tpov1' and table_type='BASE TABLE' and table_name like 'tab_%' ORDER BY table_name DESC;";
      $rtablas = $this->db->query( $sqltext )->result();
      $tablas = array();
      foreach ($rtablas as $ntabla) {
         $tablas[] = $ntabla->table_name;
      }
      return $tablas;
   }

   function leeColumnas( $table ) {
      $sqltext = "SHOW COLUMNS FROM  $table;";
      $rcolumnas = $this->db->query( $sqltext )->result();
      $columnas = array();
      foreach ($rcolumnas as $ncolumnas) {
         $columnas[] = $ncolumnas->Field;
      }
      return $columnas;
   }

   function leerTabla( $tabla ) {
      $sqltext = "SELECT * FROM " . $tabla;
      return $this->db->query( $sqltext )->result();
   }

   function leerSQLText( $sqltext ) {
      return $this->db->query( $sqltext )->result();
   }
   
   function leerErogacionesTotal( $ejercicio ) {
      if ( $ejercicio =="" ) {
         $sqltext = "SELECT IF(sum(c.monto_desglose) IS NULL,0,sum(c.monto_desglose)) as total
                       FROM vact_facturas as b,
                            vact_facturas_desglose as c
                      WHERE b.id_factura = c.id_factura";
      } else {
         $sqltext = "SELECT IF(sum(c.monto_desglose) IS NULL,0,sum(c.monto_desglose)) as total
                       FROM vact_facturas as b,
                            vact_facturas_desglose as c
                      WHERE b.id_factura = c.id_factura and
                            year(b.fecha_erogacion) = '" . $ejercicio . "'";
      }      
      return $this->db->query( $sqltext )->result();
   }

   function leerErogacionesPorMes( $ejercicio, $total ) {
      if ( $ejercicio =="" ) {
         $sqltext = "SELECT a.mes as mes, (sum(c.monto_desglose)/" . $total . ")*100 as total
                       FROM cat_meses as a,
                            vact_facturas as b,
                            vact_facturas_desglose as c
                      WHERE b.id_factura = c.id_factura and
                            month(fecha_erogacion) = mes_orden
                   GROUP BY mes
                   ORDER BY mes_orden";
      } else {
         $sqltext = "SELECT a.mes as mes, (sum(c.monto_desglose)/" . $total . ")*100 as total
                       FROM cat_meses as a,
                            vact_facturas as b,
                            vact_facturas_desglose as c
                      WHERE b.id_factura = c.id_factura and
                            month(fecha_erogacion) = mes_orden and
                            year(b.fecha_erogacion) = '" . $ejercicio . "'
                   GROUP BY mes
                   ORDER BY mes_orden";
      }      
      return $this->db->query( $sqltext )->result();
   }

   function leerDetalleErogacionesPorMes( $ejercicio, $total, $mes ) {
      if ( $ejercicio =="" ) {
         $sqltext = "SELECT a.mes, d.nombre_servicio_subcategoria  as tipo, (sum(c.monto_desglose)/" . $total . ")*100 as total
                       FROM cat_meses as a,
                            vact_facturas as b,
                            vact_facturas_desglose as c,
                            cat_servicios_subcategorias as d
                      WHERE b.id_factura = c.id_factura and
                            c.id_servicio_subcategoria = d.id_servicio_subcategoria and
                            month(fecha_erogacion) = mes_orden and
                            a.id_mes = ". $mes ."
                   group by a.mes, d.nombre_servicio_subcategoria
                   order by a.mes_orden, c.id_servicio_subcategoria";
      } else {
         $sqltext = "SELECT a.mes, d.nombre_servicio_subcategoria as tipo, (sum(c.monto_desglose)/" . $total . ")*100 as total
                       FROM cat_meses as a,
                            vact_facturas as b,
                            vact_facturas_desglose as c,
                            cat_servicios_subcategorias as d
                      WHERE b.id_factura = c.id_factura and
                            c.id_servicio_subcategoria = d.id_servicio_subcategoria and
                            month(fecha_erogacion) = mes_orden and
                            year(b.fecha_erogacion) = " . $ejercicio . " and
                            a.id_mes = ". $mes ."
                   GROUP BY a.mes, d.nombre_servicio_subcategoria
                   ORDER BY  a.mes_orden, c.id_servicio_subcategoria";
      }      
      return $this->db->query( $sqltext )->result();
   }
   
   function leeTotalPesosCampanas( $filtro, $ejercicio ) {
      $sqltext = "select sum(b.monto_desglose) as total from 
vact_campana_aviso as a,
vact_facturas_desglose as b,
vact_facturas as c
where
b.id_factura = c.id_factura and
b.id_campana_aviso = a.id_campana_aviso and
 a.id_campana_tipo in (" . $filtro . ")";

      if ($ejercicio != '') {
         $sqltext = $sqltext . ' and a.id_ejercicio = (select id_ejercicio from cat_ejercicios as z where z.ejercicio = "' . $ejercicio. '")';
      }

      $rtotales = $this->db->query( $sqltext )->result();
      foreach ($rtotales as $totales) {
         $total = $totales->total;
      }

      $sqltext1 = "select count(*) as cuantos, id_campana_aviso disc from 
vact_campana_aviso as a
where
 a.id_campana_tipo in (" . $filtro . ")";
      if ($ejercicio != '') {
         $sqltext1 = $sqltext1 . ' and a.id_ejercicio = (select id_ejercicio from cat_ejercicios as z where z.ejercicio = "' . $ejercicio. '")';
      }

      $rtotales = $this->db->query( $sqltext1 )->result();
      foreach ($rtotales as $totales) {
         $cuantos = $totales->cuantos;
      }

      $regresa = array("$ " . number_format($total, 0, ".", "," ) . ' ( ' . $cuantos . ' )', $total, $cuantos );
      return $regresa;
   }

   function leeChildrenPesosCampanas( $filtro, $ejercicio ) {
      if ($ejercicio == '') {
         $sqltext = "select a.nombre_campana_aviso as nombre, sum(b.monto_desglose) as total, a.id_campana_aviso as id
from 
vact_campana_aviso as a,
vact_facturas_desglose as b,
vact_facturas as c
where
b.id_factura = c.id_factura and
b.id_campana_aviso = a.id_campana_aviso and
 a.id_campana_tipo in (" . $filtro . ") group by a.nombre_campana_aviso, a.id_campana_aviso";
      } else {
         $sqltext = "select a.nombre_campana_aviso as nombre, sum(b.monto_desglose) as total, a.id_campana_aviso as id
from 
vact_campana_aviso as a,
vact_facturas_desglose as b,
vact_facturas as c
where
b.id_factura = c.id_factura and
b.id_campana_aviso = a.id_campana_aviso and
a.id_ejercicio in (
select d.id_ejercicio 
from 
cat_ejercicios as d
where a.id_ejercicio = d.id_ejercicio and d.ejercicio = '". $ejercicio . "' ) and 
a.id_campana_tipo in (" . $filtro . ") group by a.nombre_campana_aviso, a.id_campana_aviso";
      } 

      $rtotales = $this->db->query( $sqltext )->result();
      $i = 0;
      $childrens = '';
      foreach ($rtotales as $totales) {
         $i = $i + 1;
      }
      $j = 0;
      foreach ($rtotales as $totales) {
         $childrens = $childrens . '{"name": "' . $totales->nombre . ' - $ '. number_format($totales->total, 0, ".", "," ).
                      '", "size": ' .  $totales->total .  ', "id": ' . $totales->id . 
                    '}';
         $j = $j + 1;
         if ($j < $i) {
             $childrens = $childrens . ',';
         }
      }
      return $childrens;
   }
            
  function jsonCA_SO( $ejercicio ) {
      $ambas   = $this->leeTotalPesosCampanas( "1,2", $ejercicio );
      $campana = $this->leeTotalPesosCampanas( "2", $ejercicio );
      $avisos  = $this->leeTotalPesosCampanas( "1", $ejercicio );

      $Json = '{"name": "Campañas y avisos institucionales ' .  $ambas[0] . '",
"children": [';
      if ($campana[1]>0) {
         $Json = $Json . '
             {"name": "Campañas ' .  $campana[0] . '", "size": ' . $campana[1]. ', 
              "children": [ ' . $this->leeChildrenPesosCampanas( "2", $ejercicio ) . '
                          ]
            }';     
      }
      if ($avisos[1]>0) {
         $Json = $Json . ',
            {
            "name": "Avisos institucionales ' . $avisos[0] . '", "size": ' . $avisos[1] . ',
              "children": [ ' . $this->leeChildrenPesosCampanas( "1", $ejercicio ) . '
                          ]
            }';
      } 
      $Json = $Json . ']}';
      return $Json;
  }
}

?>
