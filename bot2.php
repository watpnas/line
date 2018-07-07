<?php
// Get POST body content
$content = file_get_contents('php://input');
// Parse JSON

$data = array( 'grant_type' => 'authorization_code', 'code' => $_GET["code"], 'redirect_uri' => 'https://dixellcallback.herokuapp.com/bot22.php', 'client_id' => '1592580012', 'client_secret' => '597224391a23fc9efb7a9646cd1f016d');

// use key 'http' even if you send the request to https://...
$options = array(
    'http' => array(
        'header'  => "Content-type: application/x-www-form-urlencoded\r\n",
        'method'  => 'POST',
        'content' => http_build_query($data)
    )
);
echo "login<br/>";
foreach ($options as $d) {
    echo $d; 
    foreach ($d as $dd) {
    echo $dd; 
    echo "<br/>";
} 
    echo "<br/>";
} 


$url = 'https://api.line.me/oauth2/v2.1/token';
$context  = stream_context_create($options);
//$result = file_get_contents($url, false, $context);
var_dump($context);
echo "get token<br/>";
if ($result === FALSE) { /* Handle error */   echo "<br/>result error"; }


