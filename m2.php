<?php
  $access_token ="Y27E0UjR15NW0tcFH6jy9ku4z+0qLN1uSqTapuVLflT7W7lsOwS/9qZIxIvbBj7rEE0F8H+qZG4QqoWz6fTD7D80Fgamap2na10G36zr0FCGJKi2+HCq9HoLXC2ae77uSzim5PiSOlHXz4caG3U+VwdB04t89/1O/w1cDnyilFU="; 
  $receiver = "U260c3c643d920b8e07e0f3d8b887e30a";
  
 
$body=["type"=> "box",
		    	"layout"=> "vertical",
		    	"contents"=> [
		    		[
		        		"type"=> "text",
		        		"text"=> "iSer",
		        		"size"=> "lg",
				    	"weight"=>"bold",
		        		"align"=>"center",
		        		"margin"=>"xl"
		    		],
		    		[
		        		"type"=> "text",
		        		"text"=> "เพิ่งลงทะเบียนกับเราเมื่อสักครู่",
		        		"size"=> "xs",
		        		"align"=>"center",
		        		"margin"=>"xl"
		    		],
		    		[
		    			"type"=>"separator",
		    			"margin"=>"xl"
		    		],
		    		[
		        		"type"=> "text",
		        		"text"=> "dfgshdryjutjtyjhghjgjghjghjู่",
		        		"size"=> "xs",
		        		"align"=>"center",
		        		"margin"=>"xl",
		        		"color"=>"#CCCCCC"
		    		]
		    	]
	];
$hero = [				"type"=>"image",
				"url"=>"https://profile.line-scdn.net/0hiBNF8a_VNm1zPxtIW6JJOk96OAAEETAlCwpxA1M_YFpaXHc5SFt9DQU3ag8KDXM7RlhxX1Q_ag1f",
				"size"=>"md"];
$header=["type"=>"box",
				"layout"=>"vertical",
				"spacing"=>"none",
				"contents"=> [
					[
				      "type"=> "text",
				      "text"=> "ข้อมูลการลงทะเบียน",
				      "align"=>"center",
				      "weight"=>"bold",
				      "margin"=>"none"
    				]	
				]
	];
	$flex =['type'=>'bubble','header'=>$header,'hero'=>$hero,'body'=>$body];
		$messages = [
			'type' => 'flex',
  			"altText"=>"New Registration Info !!",
  			"contents"=> $flex
			];
// Make a POST Request to Messaging API to reply to sender
			$url = 'https://api.line.me/v2/bot/message/push';
			$data = [
				'to' => $receiver,
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
var_dump($result);
			curl_close($ch);
