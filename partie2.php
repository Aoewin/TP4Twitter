<?php
error_reporting(E_ALL);
ini_set("display_errors", 1);
require_once('TwitterAPIExchange.php');

/** Set access tokens here - see: https://dev.twitter.com/apps/ **/
$settings = array(
    'oauth_access_token' => "975790890374647808-Ans9Z1EvapIgqMVymItOmSt2KUCPCug",
    'oauth_access_token_secret' => "UrZA6KJ3SbB0hOnCceUrUb8mvuumKP9H0sBvxAIb0ZPFP",
    'consumer_key' => "IWJzWo6TMYwKr5C5IVGoMEZBm",
    'consumer_secret' => "MkZUab2ImuN3CH9xLhb8Afuqfi66BFNBYl5R80qKBsVZN2pVvf"
);

$urlFriends = "https://api.twitter.com/1.1/friends/list.json";

$requestMethod = "GET";

if (isset($_GET['user'])) {$user = $_GET['user'];} else {$user = "prof2a4";}
$count=30;
$getfield = "?screen_name=$user&count=$count";

$twitter = new TwitterAPIExchange($settings);
$friendsJSON = $twitter->setGetfield($getfield)
             ->buildOauth($urlFriends, $requestMethod)
             ->performRequest();

$arrayFriends = json_decode($friendsJSON, true);

$maxFriends = 0;
$premier = NULL;
$deuxieme = NULL;
$troisieme = NULL;

foreach ($arrayFriends["users"] as $user) {
  if($user["followers_count"] > $maxFriends){
    $maxFriends = $user["followers_count"];
    $premier = $user;
  }
}
$maxFriends = 0;
foreach ($arrayFriends["users"] as $user) {
  if($user["followers_count"] > $maxFriends && $user != $premier){
    $maxFriends = $user["followers_count"];
    $deuxieme = $user;
  }
}
$maxFriends = 0;
foreach ($arrayFriends["users"] as $user) {
  if($user["followers_count"] > $maxFriends && $user != $premier && $user != $deuxieme){
    $maxFriends = $user["followers_count"];
    $troisieme = $user;
  }
}


$followers = [];

array_push($followers, $premier);
array_push($followers, $deuxieme);
array_push($followers, $troisieme);
?>

<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>Partie 2</title>
  </head>
  <body>
    <h1>Combien de followers : <?= sizeof($followers)?></h1>
    <ul>
      <?php foreach ($followers as $follower): ?>
        <li><?= $follower['name']?> <?= $follower['screen_name']?> <?= $follower['followers_count']?></li>
      <?php endforeach; ?>
    </ul>
  </body>
</html>
