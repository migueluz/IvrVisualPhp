<?php
$_GLOBAL['url'] = "http://50.62.30.32/INT2/IDS/";

function download_page($path, $timeout=90){
  	$ch = curl_init();
	curl_setopt($ch, CURLOPT_URL,$path);
    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
	curl_setopt($ch, CURLOPT_FAILONERROR,1);
	curl_setopt($ch, CURLOPT_FOLLOWLOCATION,1);
	curl_setopt($ch, CURLOPT_RETURNTRANSFER,1);
	curl_setopt($ch, CURLOPT_TIMEOUT, $timeout);
	$retValue = curl_exec($ch);
	curl_close($ch);
	return $retValue;
}

function request($path, $timeout=5)
{
  global $_GLOBAL;
  error_log($_GLOBAL['url'].$path, 0);
  $sXML = download_page($_GLOBAL['url'].$path, $timeout);
  $oXML = strip_tags($sXML);
  error_log('request result : '.$oXML, 0);

  return $oXML;
}

function SetDisplaySend($phone, $token, $file, $folder="default", $params="", $dnis="")
{
  if ($phone[0] != '0')
  if ($phone[0] != '+')
  $phone = '+'.$phone;

  if ($dnis != "")
  if ($dnis[0] != '0')
  if ($dnis[0] != '+')
  $dnis = '+'.$dnis;

  if ($dnis != "")
  $path = 'SetDisplaySend?PhoneNumber='.$phone.'&token='.$token.'&File='.$file.'&Folder='.$folder.'&params='.$params.'&DNIS='.$dnis;
  else
  $path = 'SetDisplaySend?PhoneNumber='.$phone.'&token='.$token.'&File='.$file.'&Folder='.$folder.'&params='.$params;

  return request($path);
}

function SetDisplayRcv($phone, $token, $file="", $folder="default", $timeout=90)
{
  if ($phone[0] != '0')
  if ($phone[0] != '+')
  $phone = '+'.$phone;

  $path = "SetDisplayRcv?PhoneNumber=".$phone."&token=".$token.'&File='.$file.'&Folder='.$folder;
  $res = request($path, $timeout);

  $fields = explode(",", $res);

  if ($fields[0] == $token)
  {
    error_log('SetDisplayRcv result : '.$fields[1], 0);
    return $fields[1];
  }
  else
  {
    error_log('SetDisplayRcv result : '.$res, 0);
    return $res;
  }
}

function CancelWaitForInput($phone, $token)
{
  if ($phone[0] != '0')
  $phone = '+'.$phone;

  $path = "CancelWaitForInput?PhoneNumber=".$phone."&token=".$token;
  $res = request($path);

  $fields = explode(",", $res);

  if ($fields[0] == $token)
  return $fields[1];
  else
  return "";
}

?>
