<?php

if (! function_exists('exportMysqlToCsv')) { 
   function exportMysqlToCsv($table, $filename = 'export.csv') {

    $CI =& get_instance();
    $CI->load->model("Graficas_model", "export");
    $result =  $CI->export->leerTabla( $table );  
    $columnas = $CI->export->leeColumnas($table);
    $fields_cnt =  count( $columnas );

    $csv_terminated = "\n";
    $csv_separator = ",";
    $csv_enclosed = '"';
    $csv_escaped = "\\";
    $schema_insert = '';
 
    for ($i = 0; $i < $fields_cnt; $i++) {
        $l = $csv_enclosed . str_replace($csv_enclosed, $csv_escaped . $csv_enclosed, stripslashes($columnas[$i])) . $csv_enclosed;
        $schema_insert .= $l;
        $schema_insert .= $csv_separator;
    } // end for
 
    $out = trim(substr($schema_insert, 0, -1));
    $out .= $csv_terminated;
 
    // Format the data
    foreach ($result as $record) {
        $schema_insert = '';
        for ($j = 0; $j < $fields_cnt; $j++) {
            if ($record->$columnas[$j] == '0' || $record->$columnas[$j] != '') {
                if ($csv_enclosed == '') {
                    $schema_insert .= $record->$columnas[$j];
                } else {
                    $schema_insert .= $csv_enclosed . str_replace($csv_enclosed, $csv_escaped . $csv_enclosed, $record->$columnas[$j]) . $csv_enclosed;
                }
            } else {
                $schema_insert .= '';
            }
 
            if ($j < $fields_cnt - 1) {
                $schema_insert .= $csv_separator;
            }
        } // end for
 
        $out .= $schema_insert;
        $out .= $csv_terminated;
    } // end while

    header("Cache-Control: must-revalidate, post-check=0, pre-check=0");
    header("Content-Length: " . strlen($out));
    // Output to browser with appropriate mime type, you choose ;)
    header("Content-type: text/x-csv");
    //header("Content-type: text/csv");
    //header("Content-type: application/csv");
    header("Content-Disposition: attachment; filename=$filename");
    echo $out;
  }
}

if (! function_exists('exportMysqlToFile')) { 
   function exportMysqlToFile($table, $header, $filename = 'export.csv') {

    $CI =& get_instance();
    $CI->load->model("Graficas_model", "export");
    $result =  $CI->export->leerTabla( $table );  
    $columnas = $CI->export->leeColumnas($table);
    $fields_cnt =  count( $columnas );

    $csv_terminated = "\n";
    $csv_separator = ",";
    $csv_enclosed = '"';
    $csv_escaped = "\\";
    $schema_insert = '';
    $out = $header . $csv_terminated; 

    // Format the data
    foreach ($result as $record) {
        $schema_insert = '';
        for ($j = 0; $j < $fields_cnt; $j++) {
            if ($record->$columnas[$j] == 0 || $record->$columnas[$j] != '') {
                if ($csv_enclosed == '') {
                    $schema_insert .= $record->$columnas[$j];
                } else {
                    $schema_insert .= $csv_enclosed . str_replace($csv_enclosed, $csv_escaped . $csv_enclosed, $record->$columnas[$j]) . $csv_enclosed;
                }
            } else {
                $schema_insert .= '';
            }
 
            if ($j < $fields_cnt - 1) {
                $schema_insert .= $csv_separator;
            }
        } // end for
 
        $out .= $schema_insert;
        $out .= $csv_terminated;
    } // end while

    
    $archivo = fopen($filename, "w");
    fwrite($archivo, $out);
    fclose($archivo);
  }
}
 
if (! function_exists('exportMysqlToJson')) { 
   function exportMysqlToJson($sqltext, $filename = 'export.json') {
    $CI =& get_instance();
    $CI->load->model("Graficas_model", "export");

    $result =  $CI->export->leerSQLText( $sqltext );  

    $out = "[";
echo "<script>alert('" . $out . "');</script>";
    foreach ($result as $record) {
        if ($out <> "[") { $out = $out . ", "; }
        $out = $out . "{";
        $out = $out .'"title":"'. $record->title . '",';
        $out = $out .'"subtitle":"'. $record->subtitle . '",';
        $out = $out .'"ranges":["'. $record->ranges . '"],';
        $out = $out .'"measures":["'. $record->measures . '"],';
        $out = $out .'"markers":["'. $record->markers . '"]';
        $out = $out . "}";
    } // end foreach
    $out = $out . "]";

//    echo $out;
//    $out = json_encode( $result, JSON_PRETTY_PRINT); 
    $archivo = fopen($filename, "w");
    fwrite($archivo, $out);
    fclose($archivo);
  }
}

if (! function_exists('exportAllToCsv')) { 
   function exportAllToCsv() {
         $CI =& get_instance();
         $CI->load->model("Graficas_model", "export");
         $tablas =  $CI->export->leeTablas( );  
         foreach ($tablas as $tabla) {
            exportMysqlToCsv($tabla, "data.csv");
         }
   }
}

if (! function_exists('exportData1ToCsv')) { 
   function exportData1ToCsv() {
      $header  = 'ejercicio,servicio,campana,partida,ejercido,tipo,fecha,proveedor,campanaaviso,presupuesto,modificacion,proveedores,totalcampanas';
      $archivo = DIR_ROOT . 'data/inicio.csv';
      exportMysqlToFile("vgrafica1", $header, $archivo);
   }
}


if (! function_exists('exportData2ToJson')) { 
   function exportData2ToJson() {
      $sqltext = "select 'partida' as title, 'denominacion' as subtitle, 1000.00 as ranges, 1025.00 as measures, 15 as markers from cat_presupuesto_conceptos where partida is not null";
      $archivo = DIR_ROOT . 'graphs/data2.json';
      exportMysqlToJson($sqltext, $archivo);
   }
}

?>
