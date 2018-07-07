<?php
$access_token = 'Y27E0UjR15NW0tcFH6jy9ku4z+0qLN1uSqTapuVLflT7W7lsOwS/9qZIxIvbBj7rEE0F8H+qZG4QqoWz6fTD7D80Fgamap2na10G36zr0FCGJKi2+HCq9HoLXC2ae77uSzim5PiSOlHXz4caG3U+VwdB04t89/1O/w1cDnyilFU=';
// Get POST body content
$content = file_get_contents('php://input');
// Parse JSON
$events = json_decode($content, true);
$url = 'https://api.line.me/oauth2/v2.1/token';
$data = array( 'grant_type' => 'authorization_code', 'code' => $_GET["code"], 'redirect_uri' => 'https://dixellcallback.herokuapp.com/bot2.php', 'client_id' => '1592580012', 'client_secret' => '597224391a23fc9efb7a9646cd1f016d');

// use key 'http' even if you send the request to https://...
$options = array(
    'http' => array(
        'header'  => "Content-type: application/x-www-form-urlencoded\r\n",
        'method'  => 'POST',
        'content' => http_build_query($data)
    )
);
echo 'login';
foreach ($data as $d) {
    echo $d->type; 
    echo "<br/>";
} 


$context  = stream_context_create($options);
$result = file_get_contents($url, false, $context);
echo 'get token';
if ($result === FALSE) { /* Handle error */   echo 'result error'; }

echo 'content='.$content;

