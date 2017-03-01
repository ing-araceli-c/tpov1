<?php defined('BASEPATH') OR exit('No direct script access allowed');
   class Sys_Screen extends CI_Controller {
      private function limpiarCadena($valor){
	$valor = str_ireplace("javascript:alert","",$valor);
	$valor = str_ireplace("alert","",$valor);
	$valor = str_ireplace("SELECT","",$valor);
        $valor = str_ireplace("INSERT","",$valor); 
	$valor = str_ireplace("COPY","",$valor);
	$valor = str_ireplace("DELETE","",$valor);
	$valor = str_ireplace("DROP","",$valor);
	$valor = str_ireplace("DUMP","",$valor);
	$valor = str_ireplace(" OR ","",$valor);
	$valor = str_ireplace(" AND ","",$valor);
	$valor = str_ireplace("%","",$valor);
	$valor = str_ireplace("LIKE","",$valor);
	$valor = str_ireplace("--","",$valor);
	$valor = str_ireplace("^","",$valor);
	$valor = str_ireplace("[","",$valor);
	$valor = str_ireplace("]","",$valor);
	$valor = str_ireplace("\\","",$valor);
	$valor = str_ireplace("!","",$valor);
	$valor = str_ireplace("¡","",$valor);
	$valor = str_ireplace("?","",$valor);
	$valor = str_ireplace("=","",$valor);
	$valor = str_ireplace("&","",$valor);
	$valor = str_ireplace("<?php","",$valor);
	$valor = str_ireplace("?>","",$valor);
	return $valor;
      }

      private function mysql_escape_mimic($inp) { 
         if(is_array($inp)) 
            return array_map(__METHOD__, $inp); 
 
         if(!empty($inp) && is_string($inp)) { 
            return str_replace(array('\\', "\0", "\n", "\r", "'", '"', "\x1a"), array('\\\\', '\\0', '\\n', '\\r', "\\'", '\\"', '\\Z'), $inp); 
         } 
         return $inp; 
      } 

      public function __construct() {
		         parent::__construct();
      }

      public function index() {

         $input_arr = array(); 
         foreach ($_POST as $key => $input_arr) { 
	    $_POST[$key] = htmlspecialchars(addslashes($this->limpiarCadena($this->mysql_escape_mimic(strip_tags($input_arr))))); 
         }
         $input_arr = array(); 
         foreach ($_GET as $key => $input_arr) { 
	    $_GET[$key] = htmlspecialchars(addslashes($this->limpiarCadena($this->mysql_escape_mimic(strip_tags($input_arr))))); 
         }

         $this->load->helper("d3d_helper");
         setD3D("page_act",   $_GET['v']);
         
         if (isset($_GET['e'])) {
            setD3D("Ejercicio", $_GET['e']);
         } else {
            setD3D("Ejercicio", '');
         }

         if (isset($_GET['filtro'])) {
            setD3D("filtro", $_GET['filtro']);
         } else {
            setD3D("filtro", 150000);
         }

         $this->load->model("Graficas_model");

         setD3D("ListaEjercicios",$this->Graficas_model->leeListBoxEjercicios());
         setD3D("BotonesEjercicios",$this->Graficas_model->leeBotonesEjercicios());
         $this->load->model("Tpo_model", "settings");
         $this->settings->initialize("sys_settings");

         //Debug
         //$this->output->enable_profiler(TRUE);

      define('URL_DOCS',  $this->settings->get_url_docs()); 
		
		$var_pool='';		
		switch(getD3D("page_act"))
		 {
		 		case 'Presupuesto':
			 		$this->load->helper('file');
			 		$qry_Presupuesto = $this->Graficas_model->leePresupuesto( getD3D("Ejercicio") );
			 		if(isset($qry_Presupuesto) && $qry_Presupuesto>0){
						foreach($qry_Presupuesto as $key=>$row_Presupuesto){
                                                   if ($row_Presupuesto->partida <> 'Total') {
							$presupuesto[$key]['title']= 'Partida: ' . $row_Presupuesto->partida;
                                                   } else {
							$presupuesto[$key]['title']= $row_Presupuesto->partida;
                                                   }          
//						   $presupuesto[$key]['subtitle']=$row_Presupuesto->denominacion;
						   $presupuesto[$key]['subtitle']="";
						   $presupuesto[$key]['ranges']=array($row_Presupuesto->monto_contrato);
						   $presupuesto[$key]['measures']=array($row_Presupuesto->monto_ejercido);
						   $presupuesto[$key]['markers']=array($row_Presupuesto->monto_total);
						}
					//Creamos el JSON
					$json_string = json_encode($presupuesto);
					$file = 'data/presupuesto.json';
					delete_files($file);
					write_file($file, $json_string);
					
				} else {
					$file = 'data/presupuesto.json';
					delete_files($file);
					write_file($file, '');
				}
				break;
				case 'Porproveedor':
					$this->load->helper('file');					
                                        $maximo = $this->Graficas_model->getMaximodeProveedores(getD3D('Ejercicio'));
                                        setD3D('maximo', $maximo);

                                        $total = $this->Graficas_model->getTotalProveedores(getD3D('Ejercicio'));
                                        setD3D('total', $total-10000);

					$indice=0;
					$array_lista=array();
					$qry_lista = $this->Graficas_model->listaPorProveedor( getD3D('filtro'), getD3D('Ejercicio') ); 
			 		if(isset($qry_lista) && $qry_lista>0){
						foreach($qry_lista as $lista){
							$node[$indice]['name']=$lista->lista;
    						$indice++;
    						array_push($array_lista, $lista->lista);
						}
					}
    				        array_push($array_lista, "Contratos");
    				        array_push($array_lista, "Órdenes de compra");

					$links=array();
					$qry_links1 = $this->Graficas_model->linksTipoPorProveedor( getD3D('filtro'), getD3D('Ejercicio') ); 
			 		if(isset($qry_links1) && $qry_links1>0){
						foreach($qry_links1 as $links1){
								$links[]=array(
								'source'=> array_search($links1->categoria, $array_lista, true),
								'target'=> array_search($links1->tipo, $array_lista, true),
								'value'=> $links1->total,
								'numero'=> $links1->numero,
								'tipo'=> $links1->tipo
								);
						}
					}					
					$qry_links2 = $this->Graficas_model->linksPorProveedor( getD3D('filtro'), getD3D('Ejercicio') ); 
					$i = 0;
			 		if(isset($qry_links2) && $qry_links2>0){
						foreach($qry_links2 as $links2){
								$links[]=array(
								'source'=> array_search($links2->tipo, $array_lista, true),
								'target'=> array_search($links2->proveedor1, $array_lista, true),
								'value'=> $links2->total,
								'numero'=> $links2->numero,
								'tipo'=> $links2->tipo
								);
 					         $i = $i+1;
						}
				  }
				  
				  $json_string = '';
				  if (isset($node)) {
						//Creamos el JSON						
    					$json_string = json_encode(array('nodes'=>$node,'links'=>$links));
    			  }		
	    		  $file = 'data/porproveedor.json';
//$json_string = str_replace("Ó", "O", $json_string);
//$json_string = str_replace("\u00d3", "O", $json_string);
		    	  delete_files($file);
			     write_file($file, $json_string);
					
				break;
				case 'Porservicio':
				   $json_array = array();				   
				   $freq = array();
				   $var_pool['categorias']= object_to_array($this->Graficas_model->leeServicios_categorias( ));
				   $var_pool['json_gxs']='';
				   
				   $qry_gastoPorServicio = $this->Graficas_model->gastoPorServicio( getD3D('Ejercicio')  ); 

			 		if(isset($qry_gastoPorServicio) && $qry_gastoPorServicio>0){
			 		   $mes_act = 'ENE';
						foreach($qry_gastoPorServicio as $row_gastoPorServicio){							
					      if ($row_gastoPorServicio->mes_corto == $mes_act) {								
					         $var_pool['json_gxs']=$var_pool['json_gxs'].'';

     						   array_push($freq, array( $row_gastoPorServicio->nombre_servicio_categoria =>$row_gastoPorServicio->monto));
     						} else {
 						      array_push($json_array, array("State"=>$mes_act,"freq"=>$freq));
  				            $freq = array();
     						   array_push($freq, array( $row_gastoPorServicio->nombre_servicio_categoria =>$row_gastoPorServicio->monto));
  				         }
    			 		   $mes_act = $row_gastoPorServicio->mes_corto;
						}
 						array_push($json_array, array("State"=>$mes_act,"freq"=>$freq));
						$var_pool['json_gxs']=json_encode($json_array);
                  $var_pool['json_gxs'] = str_replace('"', "", $var_pool['json_gxs']);						                  
                  $var_pool['json_gxs'] = str_replace('{State:', 'State:', $var_pool['json_gxs']);						
                  $var_pool['json_gxs'] = str_replace('State:ENE', 'State:"ENE"', $var_pool['json_gxs']);						
                  $var_pool['json_gxs'] = str_replace('State:FEB', 'State:"FEB"', $var_pool['json_gxs']);						
                  $var_pool['json_gxs'] = str_replace('State:MAR', 'State:"MAR"', $var_pool['json_gxs']);						
                  $var_pool['json_gxs'] = str_replace('State:ABR', 'State:"ABR"', $var_pool['json_gxs']);						
                  $var_pool['json_gxs'] = str_replace('State:MAY', 'State:"MAY"', $var_pool['json_gxs']);						
                  $var_pool['json_gxs'] = str_replace('State:JUN', 'State:"JUN"', $var_pool['json_gxs']);						
                  $var_pool['json_gxs'] = str_replace('State:JUL', 'State:"JUL"', $var_pool['json_gxs']);						
                  $var_pool['json_gxs'] = str_replace('State:AGO', 'State:"AGO"', $var_pool['json_gxs']);						
                  $var_pool['json_gxs'] = str_replace('State:SEP', 'State:"SEP"', $var_pool['json_gxs']);						
                  $var_pool['json_gxs'] = str_replace('State:OCT', 'State:"OCT"', $var_pool['json_gxs']);						
                  $var_pool['json_gxs'] = str_replace('State:NOV', 'State:"NOV"', $var_pool['json_gxs']);						
                  $var_pool['json_gxs'] = str_replace('State:DIC', 'State:"DIC"', $var_pool['json_gxs']);
                  $var_pool['json_gxs'] = str_replace(',freq:[', ',freq:', $var_pool['json_gxs']);
                  $var_pool['json_gxs'] = str_replace('},{', ',', $var_pool['json_gxs']);
                  $var_pool['json_gxs'] = str_replace('State:', '{State:', $var_pool['json_gxs']);
                  $var_pool['json_gxs'] = str_replace('}]}', '}}', $var_pool['json_gxs']);                                    						
					}				
				break;
				case 'Campanasavisos':
			      $datos_CA_SO = $this->Graficas_model->jsonCA_SO( getD3D("Ejercicio") );
               file_put_contents('data/ca_so.json', $datos_CA_SO);
				break;
				case 'Sujetos':
			      $datos_SO = $this->Graficas_model->jsonSO( getD3D("Ejercicio") );
               //file_put_contents('data/so.json', $datos_SO);
				break;
				case 'Erogaciones':
				   $totales = $this->Graficas_model->leerErogacionesTotal( getD3D("Ejercicio") );
				   foreach($totales as $total){
                  $totaerogaciones = $total->total;
               }
               if ($totaerogaciones > 0) {
                  $pormeses = $this->Graficas_model->leerErogacionesPorMes( getD3D("Ejercicio"), $totaerogaciones );
     			      $pieh = "";
   				   foreach($pormeses as $pormes){
   				      if ( $pieh <> "") {
                        $pieh = $pieh . ", ";
   				      } 
                     $pieh = $pieh . "{ name : '" . $pormes->mes . "', y: " . $pormes->total . ", drilldown: '" . $pormes->mes . "' } ";
                  }

     			      $pied = "";     			     
                  for ($i = 1; $i <= 12; $i++) { 
                     $detallemeses = $this->Graficas_model->leerDetalleErogacionesPorMes( getD3D("Ejercicio"), $totaerogaciones, $i );
       			      $piedd = "";
   				      $j = 0;
     				      if ( $pied <> "") {
                        $pied = $pied . ", ";
   				      } 
                     foreach($detallemeses as $detallemes ) {   				      				      				   
     				         if ( $piedd == "") {
                           $piedd = "{ name : '" . $detallemes->mes . "', id: '" . $detallemes->mes . "', data: ["; 				         
     				         }     				         
     				         if ( $j > 0) {
                           $piedd = $piedd . ", ";   				         
   				         }
   				         $j = $j+1;
                        $piedd = $piedd . "[ '" . $detallemes->tipo . "', " . $detallemes->total . "] ";
                     }
                     $pied = $pied . $piedd;
                     $pied = $pied . ']} ';
        			      $piedd = "";
                  }                  
               file_put_contents('data/pieh.json', $pieh);            
               file_put_contents('data/pied.json', $pied);                        
            } else {
               file_put_contents('data/pieh.json', '');            
               file_put_contents('data/pied.json', '');                        
            }
				break;
		 }
		
		if (strlen(trim($this->input->get('g')))==0) {
			setD3D("group_act",  "");
			}
		else {
			setD3D("group_act",  $this->input->get('g') . "/");
			}
		if (getD3D("page_act")=='') {
			setD3D("group_act", "pages/");
			setD3D("page_act",  "Inicio");
			}
		$this->load->view(getD3D("group_act") . getD3D("page_act"),$var_pool);
      }
   }
?>

