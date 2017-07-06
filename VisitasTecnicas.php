<?php echo "<?xml version=\"1.0\"?>\n"; ?>
<?php
  require("include/callvu.php");
  require("include/Logger.php");
	$caller=$_REQUEST['caller'];
	$called=$_REQUEST['called'];
	$token=$_REQUEST['token'];
   if (isset($_REQUEST['next']))
 	 $next = $_REQUEST['next'];
  $page = basename(__FILE__, '.php');
  $i='';
  $input = $i;
  if (isset($next) && $next == $page)
	{
    $input = SetDisplayRcv($caller, $token, "", "");
    //sleep(10);
    
    if($input=='0'){
    	$next = "ConsultarSaldo";
    	$operacion="Regreso Menu PrincipalClaro";
    	
    }
logger('VisitaTecnica',$caller,$operacion,$called);
  }
  else
  {
  	$token = SetDisplaySend($caller, $token, $page, "DemoClaroCol");
    $next = $page;
  }
?>
<vxml version="2.1" xmlns="http://www.w3.org/2001/vxml" xml:lang="es-ES" application="root.vxml" >
  <form>
    <block>
     <assign name="token" expr="'<?php echo $token; ?>'"/>
     <assign name="next" expr="'<?php echo $next; ?>'"/>
    </block>
    <block cond="next == '<?php echo $page; ?>'">
<property name="memory" value="true" charset="UTF-8" />
<submit method="post" namelist="caller called token next" next="<?php echo $next; ?>.php"/>
     <catch event="error.badfetch">
      <submit method="post" namelist="caller called token" next="<?php echo $next; ?>.php"/>
     </catch>
    </block>
    <block>
     <submit method="post" namelist="caller called token" next="<?php echo $next; ?>.php"/>
    </block>
  </form>
</vxml>