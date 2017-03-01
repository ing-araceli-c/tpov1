<?php
   /*
      SendGrid   $9.95/mo 
      https://sendgrid.com/
      lfcortes
      lfcortes@diamond-d3d.com.mx
      MyGridSend7
      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
      D3DBase
      https://sendgrid.com/docs/Integrate/Code_Examples/php.html
   */
   
   if (! function_exists('sendGridMailD3D')) {
      function sendGridMailD3D( $to="lfcortes@diamond-d3d.com.mx", $from="enrolamiento@ingenierosti.com.mx", 
                                $subject="Subject", $message="Testing Mail", $typemsg="text", $copyto="enrolamiento@ingenierosti.com.mx" ) {
         $CI =& get_instance();
         $CI->load->library('email');

         if (TYPE_MAIL === 'grid') { 
            $CI->email->initialize(array(
            'protocol' =>  'smtp',
            'smtp_host' => 'smtp.sendgrid.net',
            'smtp_user' => 'lfcortes',
            'smtp_pass' => 'MyGridSend7',
            'smtp_port' => 587,
            'crlf' => "\r\n",
            'newline' => "\r\n"
            ));
         } else {         
            $CI->email->initialize(array(
            'protocol' =>  'smtp',
            'smtp_host' => 'mail.portalti.com.mx',
            'smtp_user' => 'enrolamiento@portalti.com.mx',
            'smtp_pass' => 'Myenrolamiento7*-',
            'smtp_port' => 587,
            'crlf' => "\r\n",
            'newline' => "\r\n"
            ));         
         }
         $CI->email->mailtype = $typemsg;
         $CI->email->from( $from );
         $CI->email->to( $to );
         $CI->email->cc( $copyto );
         $CI->email->subject( $subject );
         $CI->email->message( $message );
         $CI->email->send();
         if (DEBUGER === 'Y') {
            echo $CI->email->print_debugger();
         }
      }
   }

   if (! function_exists('sendMailD3D')) {
      function sendMailD3D( $id_correo=1, $to="lfcortes@diamond-d3d.com.mx", $salida="mail", $id=0, $tipo = 'i', $id_status=0 ) {
         $CI =& get_instance();
         $CI->load->model("Tpo_model", "correos");
         $CI->correos->initialize("vsys_mails");        

         $CI->load->model("Tpo_model", "correos_var");
         $CI->correos_var->initialize("vsys_mails_vars");        

         $CI->load->model("Tpo_model", "ingenieros");
         $CI->ingenieros->initialize("tab_ingenieros");        

         $CI->load->model("Tpo_model", "users");
         $CI->users->initialize("sec_users");        

         $CI->load->model("Tpo_model", "logD3D");
         $CI->logD3D->initialize("sys_log");        

         $correo  = $CI->correos->find1( 'id_mail', $id_correo, 'id_mail' );      
         $subject = $correo[0]->description;
//         $tema    = $correo[0]->tema; solo 4 nivels
         $tema    = '';
         $from    = $correo[0]->from;
         $copyto  = $correo[0]->cc;
         if (strlen( $correo[0]->to ) > 0) {
            $to = $correo[0]->to;
         } 
	
	 $dirtema = URL_MAIL . $tema .'/index.html';
         $message = file_get_contents( $dirtema );
         $imgpath = URL_MAIL . $tema .'/img/';
         $message = str_replace( '[URL_IMG]', $imgpath , $message );
         
         $vars   = $CI->correos_var->find1( 'id_mail', $id_correo, 'id_mail' );
         foreach ($vars as &$var) {            
            $message = str_replace( $var->var, $var->value , $message );
         }
         foreach ($vars as &$var) {            
            $message = str_replace( $var->var, $var->value , $message );
         }
         $message = str_replace( '[ID]', base64_encode( $id ), $message );

         if ($tipo === 'u') {
   	    if ($id > 0) {
               $user_data  = $CI->users->find1( 'id_user', $id, 'id_user' );      
               $user_username = $user_data[0]->username;
               $user_names    = $user_data[0]->fname;
               $message = str_replace( '[USERNAME]', $user_username, $message );
               $message = str_replace( '[NAMES]',    $user_names,    $message );
               $message = str_replace( '[PWD]',    base64_encode( $id ),    $message );
            }
         }
         $message = str_replace( '[URL_ROOT]', URL_ROOT, $message );
         $ligaact = $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'];         
         $typemsg ="html";

         $data_log = array();
         $data_log['id_log']       = 0;
         if (function_exists('getD3D')===true) {
            $data_log['id_user']   = getD3D('user_id');
         } else {
            $data_log['id_user']   = 0;
         }
         $data_log['id_bis'] = $id;
         $data_log['type']         = 'mail '. $salida;
         $data_log['log']          = $subject;         
         $data_log['log_coments']  = $to;
         $data_log['id_type']      = $id_correo;
         $data_log['log_status_change'] = $id_status;
         $data_log['log_ip']            = $_SERVER['REMOTE_ADDR'];
         $CI->logD3D->insert( $data_log ); 
            
         if ($salida === "mail") {
            $enviar  = URL_ROOT . 'Sys_Correo?id='.base64_encode($id).'&id_correo='. $id_correo . '&m=screen&t='.$tipo.'';
//            $message = '<br><center><a href="' . $enviar .'">Si no puedes ver este mensaje haz clic aquí.</a></center>' . $message;
            $message = '<html><head>   <meta name="viewport" content="width=device-width; initial-scale=1.0; maximum-scale=1.0;" />'
                       .'<title>Ingenieros TI</title></head><body><center><br><br><a href="' . $enviar 
                       .'">Si no puedes ver este mensaje haz clic aquí.<br><br><img src="'. $imgpath 
                       .'comunicado.png" alt="comunicado" style="display:block;" /></center></body></html>';
            sendGridMailD3D( $to, $from, $subject, $message, $typemsg, $copyto );
         } else {
            echo $message; 
         }
      }
   }
?>
