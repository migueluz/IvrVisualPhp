<?php
function logger($menu,$cliente,$operacion,$called){
try{
	$fecha = date('Y-m-d');
	$jump = "\r\n";
	$separator = "\t";
	$fp=fopen("CallRegistry-".$fecha.".log","a") or die("Problemas en la creacion");
		if ($fp) {
			$registro = $fecha."-La ingresa al Menu:".$menu.",Cliente:".$cliente.",Operacion a Realizar:".$operacion.", Numero Marcado:".$called."\r\n";
			fwrite($fp, $registro);
		    fclose($fp);
		}else{
	  		echo "<!-- No pude abrir el archivo -->\n";
			 }
} catch (Exception $e) {
	$ddf = fopen("Error.log","a");
	fwrite($ddf,$fecha.'Error Registrando Log: '.$e->getMessage()."\r\n");
	fclose($ddf);
	exit(1);
		}
}
?>