<?php
/* 
https://fcm.googleapis.com/v1/projects/<YOUR-PROJECT-ID>/messages:send
Content-Type: application/json
Authorization: Bearer <YOUR-ACCESS-TOKEN>

{
  "message": {
    "token": "eEz-Q2sG8nQ:APA91bHJQRT0JJ...",
    "notification": {
      "title": "Background Message Title",
      "body": "Background message body"
    },
    "webpush": {
      "fcm_options": {
        "link": "https://dummypage.com"
      }
    }
  }
}
 */

use Google\Auth\Credentials\ServiceAccountCredentials;
use Google\Auth\HttpHandler\HttpHandlerFactory;

require 'vendor/autoload.php';

$credential = new ServiceAccountCredentials(
    "https://www.googleapis.com/auth/firebase.messaging",
    json_decode(file_get_contents("pvKey.json"), true)
);

$token = $credential->fetchAuthToken(HttpHandlerFactory::build());

$ch = curl_init("https://fcm.googleapis.com/v1/projects/hello-notif-63ad4/messages:send");

curl_setopt($ch, CURLOPT_HTTPHEADER, [
    'Content-Type: application/json',
    'Authorization: Bearer '.$token['access_token']
]);

curl_setopt($ch, CURLOPT_POSTFIELDS, '{
    "message": {
      "token": "cCu3rvM_zkPePysRgi-ogM:APA91bH6Xb0XD0l1iQvr0G81sSp5TTzxLc3S91LXAWNTC6wUVv3uCT9q9KJLuc-X3FstUfhiiIYiagc0Q2uvfFqihgxQPPOwPFyiN2hqrdrVE1yjs6hmflmov7MIDGIaCSABHZioSIcq",
      "notification": {
        "title": "Background Message Title",
        "body": "Background message body",
        "image": "https://cdn.shopify.com/s/files/1/1061/1924/files/Sunglasses_Emoji.png?2976903553660223024"
      },
      "webpush": {
        "fcm_options": {
          "link": "https://google.com"
        }
      }
    }
  }');

  curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "post");

  $response = curl_exec($ch);

  curl_close($ch);

  echo $response;