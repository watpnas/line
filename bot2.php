<?php
// Get POST body content
$content = file_get_contents('php://input');
// Parse JSON
if($content){$events = json_decode($content, true);}
//var_dump($events);

$data = array( 'grant_type' => 'authorization_code', 'code' => $_GET["code"], 'redirect_uri' => 'https://dixellcallback.herokuapp.com/bot2.php', 'client_id' => '1592580012', 'client_secret' => '597224391a23fc9efb7a9646cd1f016d');

// use key 'http' even if you send the request to https://...
$options = array(
    'http' => array(
        'header'  => "Content-type: application/x-www-form-urlencoded\r\n",
        'method'  => 'POST',
        'content' => http_build_query($data)
    )
);

//foreach ($options as $d) {
//
//    foreach ($d as $dd) {
//    echo $dd; 
//    echo "<br/>";
//} 
//    echo "<br/>";
//} 


$url = 'https://api.line.me/oauth2/v2.1/token';
//$url = 'https://dixellcallback.herokuapp.com/bot22.php';
$context  = stream_context_create($options);
$result = file_get_contents($url, false, $context);
//var_dump($options);

if ($result === FALSE) { /* Handle error */   echo "<br/>result error"; }

$res = json_decode($result,true);
//echo 'ID_TOKENs = '.$res['id_token'];
$key = explode(".",$res['id_token']);
$events = json_decode( base64_decode($key[1]), true);
var_dump($events);
//$xml = file_get_contents("https://dixellcallback.herokuapp.com/messenger.php?user=".$events['sub']."&name=".$events['name']);

echo "Thank You!";
