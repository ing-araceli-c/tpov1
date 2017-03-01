<center>
<!--?php 
echo $ScreenTarget; 
die();
?-->
<?php
   if ( $ScreenTarget == "Sys_Screen?v=Inicio&g=pages/") {
?>
<iframe src="<?php echo $ScreenTarget; ?>" style="width:100%;" frameborder="0" id="myframe"
        onload="this.style.height = '950px';"> </iframe>
<?php
  } else {
?>
<iframe src="<?php echo $ScreenTarget; ?>" style="width:100%;" frameborder="0" id="myframe"
        onload="this.style.height = this.contentWindow.document.body.scrollHeight + 22 + 'px';"> </iframe>
<?php
   }
?>
</center>

