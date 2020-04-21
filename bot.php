<?php
$access_token = 'aHRLBdqifx6t1bJpHdZfN2ijUVTRT51g2VNr2EE6BCisEW8UKEMX8T5PoB65EHmgBlBq2ZzADxtWRu2XMyjdk8d3FsJhmvhxqowXR5fq0rbS1S7NCIYrUgCfR9pXFXXbMX9E1yY8oPDsn/t7bniDEQdB04t89/1O/w1cDnyilFU=';

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
			
			$sourcetype =isset($event['source']['type'])? $event['source']['type']: Null;
			$userId = isset($event['source']['userId'])? $event['source']['userId']: Null;
			$groupId = isset($event['source']['groupId'])? $event['source']['groupId']: Null;
			$roomId = isset($event['source']['roomId'])? $event['source']['roomId']: Null;
			$msg=str_replace('hidixell','',$event['message']['text']);
			trim($msg," ");
			
			
			//$data = ['event' => json_encode($event)];
			$jsdata = [
					'sourcetype'=> $sourcetype,
					'userId' => $userId,
					'groupId' => $groupId,
					'roomId' => $roomId,
					'message' => $msg
				];
			$data = ['event' => json_encode($jsdata)];
			$postdata = http_build_query($data);
			$opts = array('http' =>
   					 array(
        					'method'  => 'POST',
       						 'header'  => 'Content-type: application/x-www-form-urlencoded',
       						 'content' => $postdata
    						)
				);

			$context  = stream_context_create($opts);
			//$resMes = file_get_contents("http://service.dixellasia.com:9998/activecollab/talk1982.php", false, $context);
			$resMes = file_get_contents("http://cloud.dixellasia.com:1889/line", false, $context);
			
			echo $resMes;
			
			//if($resMes===""){
				//return;
			//}

			$replyToken = $event['replyToken'];			
			// Build message to reply back
			$messages = [
				'type' => 'text',
				'text' => $resMes
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
