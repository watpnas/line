<?php
$url = 'https://api.line.me/v2/bot/message/push';
$data = '{
"to":"U260c3c643d920b8e07e0f3d8b887e30a",
  "messages":[{
      "type": "template",
      "altText": "Client's Site 001\n► Device A7 is No Link\n► High Temp Alarm Location A",
      "template":{
        "type":"buttons",
        "text":"Client's Site 001\n► Device A7 is No Link\n► High Temp Alarm Location A",
        "actions":[{
          "type":"uri",
          "label":"View on Device",
          "uri":"http://xweb-lotus-hyper-30.dyndns.org"
        }]
      }
  }]
}';

// use key 'http' even if you send the request to https://...
$options = array(
    'http' => array(
        'header'  => "Content-type: application/json, Authorization: Bearer Y27E0UjR15NW0tcFH6jy9ku4z+0qLN1uSqTapuVLflT7W7lsOwS/9qZIxIvbBj7rEE0F8H+qZG4QqoWz6fTD7D80Fgamap2na10G36zr0FCGJKi2+HCq9HoLXC2ae77uSzim5PiSOlHXz4caG3U+VwdB04t89/1O/w1cDnyilFU=",
        'method'  => 'POST',
        'content' => http_build_query($data)
    )
);
$context  = stream_context_create($options);
$result = file_get_contents($url, false, $context);
if ($result === FALSE) { /* Handle error */ }

var_dump($result);
