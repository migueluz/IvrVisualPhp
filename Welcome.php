<?php echo "<?xml version=\"1.0\"?>\n"; ?>
<?php
  require("include/callvu.php");
  require("include/Logger.php");
  if (isset($_REQUEST['caller'])){
  		$caller=$_REQUEST['caller'];
		$precaller=$_REQUEST['caller'];	
		$operador=substr($caller,0,4);
	    $numeroco=substr($caller,1,10);
	    $pais=substr($caller,0,3);
	    $numerove=substr($caller,1,12);
	    $rest5=substr($caller,3,3);
	    $numero=substr($caller,6,7);
	    
		$operador1=substr($caller,0,-7);
 			 $numero1=substr($caller,3,8);
 			 $operador2=substr($caller,0,-10);
  			 $trim1=substr($caller,3,3);
  			 $trim2=substr($caller,3,10);
			 $numero2=substr($caller,4,10); 
			 $pais1=substr($caller,0,-10);
			 $numero3=substr($caller,4,10);
			 $paisCL=substr($caller,0,-9);			 
			 $CLNumb=substr($caller,4,9);
		         $Col2=substr($caller,2,10);
$paisCL=substr($caller,0,-9);
$CL=substr($caller,4,10);

  	 
			
//  	 if ($operador1=='424'||$operador1=='414'||$operador1=='412'){
//  	 		$caller='58'.$operador1.$numero1;
//  			 }else if($operador2=='+58'){
//   				 $caller='58'.$trim2;
//  			 } 	

		//if ($operador=='+317' || $operador=='+305' || $operador=='+321'|| $operador=='+315'|| $operador=='+300'|| $operador=='+304'){   		    
			//$caller='57'.$numeroco;
		//} 

if ($paisCL=='0056'){
		$caller='56'.$CL;

			  }

}
  
  if (isset($_REQUEST['called'])){
	  //$called=$_REQUEST['called'];
	  //$called="00542214450956";
 		
//  		if($called=='17864085958'){
//    		$called='17864085958';
//  		} 
//    		elseif($called=='5713810696'){
//    			$called='17864085958';
//    		}
if ($called=='56228986082') {
 			$called='0228986082';	   			
// 			$called=$_REQUEST['called'];
   		}
  		//if($called=='542214450956') {
			//$called='00542214450956';	   			
			 //		} 
  	
	}
 if (isset($_REQUEST['id'])){
 	 	$id=$_REQUEST['id'];
 }
 
 $fp=fopen("callColombia.log","a") or die("Problemas en la creacion");
 if ($fp) {
 	$registro = "ID:".$id.",caller:".$caller.",Called:".$called.",precaller:".$precaller.",Numero De Operador:".$operador1."\r\n";
 	fwrite($fp, $registro);
 	fclose($fp);
 }else{
 	echo "<!-- No pude abrir el archivo -->\n";
 }
 
logger('Welcome',$caller,'',$called);
  $page = basename(__FILE__, '.php');
  $next = "MainMenu";
  $token = "start";	
  $token = SetDisplaySend($caller, $token, $next,"DemoClaroCol","",$called);  
?>
<vxml version="2.1" xmlns="http://www.w3.org/2001/vxml" xml:lang="es-ES" application="root.vxml" >
  <form>
    <block>
     <assign name="caller" expr="'<?php echo $caller; ?>'"/>
     <assign name="called" expr="'<?php echo $called; ?>'"/>
     <prompt>Bienvenido al Servicio de Atencion al cliente de Claro</prompt>
    </block>
    <block>
     <assign name="token" expr="'<?php echo $token; ?>'"/>
     <submit method="post" namelist="caller called token" next="<?php echo $next; ?>.php"/>
    </block>
 </form>
</vxml>
