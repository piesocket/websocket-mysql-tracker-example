<?php
function publishUser($event){
  $curl = curl_init();

  $post_fields = [
    "key" => "API_KEY", 
    "secret" => "API_SECRET",
    "channelId" => "my-channel",
    "message" => $event
  ];

  curl_setopt_array($curl, array(
    CURLOPT_URL => "https://CLUSTER_ID.piesocket.com/api/publish",
    CURLOPT_RETURNTRANSFER => true,
    CURLOPT_CUSTOMREQUEST => "POST",
    CURLOPT_POSTFIELDS => json_encode($post_fields),
    CURLOPT_HTTPHEADER => array(
      "Content-Type: application/json"
    ),
  ));

  $response = curl_exec($curl);
  print_r($response);
}

$connection = mysqli_connect(
    'localhost',
    'root',
    'greatness',
    'websocket-v3-prod-copy'
);
mysqli_query($connection, "INSERT INTO users .....");
$payload = json_encode([
  "event" => "new_user",
  "data" => [
  "id"=> 1, 
  "name"=>"Test user"]
]);

publishUser($payload);
?>