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
		}
	}
}
echo "OK";
