<?php
$access_token = 'Y27E0UjR15NW0tcFH6jy9ku4z+0qLN1uSqTapuVLflT7W7lsOwS/9qZIxIvbBj7rEE0F8H+qZG4QqoWz6fTD7D80Fgamap2na10G36zr0FCGJKi2+HCq9HoLXC2ae77uSzim5PiSOlHXz4caG3U+VwdB04t89/1O/w1cDnyilFU=';

// Get POST body content
$content = file_get_contents('php://input');
// Parse JSON
$events = json_decode($content, true);
// Validate parsed JSON data
if (!is_null($events['events'])) {
	// Loop through each event
	foreach ($events['events'] as $event) {
		// Reply only when message sent is in 'text' format
		if ($event['type'] == 'message' && $event['message']['type'] == 'text' && $event['message']['text']=='dxmyid') {
			// Get text sent
			if($event['source']['type']=='user'){
				$text = $event['source']['userId'];
			}else if($event['source']['type']=='group'){
				$text = $event['source']['groupId'];
			}else if($event['source']['type']=='room'){
				$text =$event['source']['roomId'];
			} 
			// Get replyToken
			$replyToken = $event['replyToken'];
			$text = "You're registered\nRef ID: ".$text;
			// Build message to reply back
			$messages = [
				'type' => 'text',
				'text' => $text
			];

			// Make a POST Request to Messaging API to reply to sender
			$url = 'https://api.line.me/v2/bot/message/reply';
			$data = [
				'replyToken' => $replyToken,
				'messages' => [$messages],
			];
			$post = json_encode($data);
			$headers = array('Content-Type: application/json', 'Authorization: Bearer ' . $access_token);

			$ch = curl_init($url);
			curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
			curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
			curl_setopt($ch, CURLOPT_POSTFIELDS, $post);
			curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
			curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
			$result = curl_exec($ch);
			curl_close($ch);

			echo $result . "\r\n";
		}else if($event['type'] == 'message' && $event['message']['type'] == 'text' && strpos($event['message']['text'], 'hidixell') === 0){
			
			$postdata = http_build_query(
    					array(
        				'data' => $event
    					)
				);

			$opts = array('http' =>
   					 array(
        					'method'  => 'POST',
       						 'header'  => 'Content-type: application/x-www-form-urlencoded',
       						 'content' => $postdata
    						)
				);

			$context  = stream_context_create($opts);

			$resMes = file_get_contents("http://service.dixellasia.com:9998/activecollab/talk1982.php", false, $context);
			
			
			$replyToken = $event['replyToken'];
			$text = $event;
			// Build message to reply back
			$messages = [
				'type' => 'text',
				'text' => $text
			];
			$url = 'https://api.line.me/v2/bot/message/reply';
			$data = [
				'replyToken' => $replyToken,
				'messages' => [$messages],
			];
			$post = json_encode($data);
			$headers = array('Content-Type: application/json', 'Authorization: Bearer ' . $access_token);

			$ch = curl_init($url);
			curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
			curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
			curl_setopt($ch, CURLOPT_POSTFIELDS, $post);
			curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
			curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
			$result = curl_exec($ch);
			curl_close($ch);
		}
			
	}
}
echo "OK";
