<?php
error_reporting(E_ALL);
ini_set("display_errors", 1);
require_once('TwitterAPIExchange.php');

$settings = array(
    'oauth_access_token' => "975790890374647808-Ans9Z1EvapIgqMVymItOmSt2KUCPCug",
    'oauth_access_token_secret' => "UrZA6KJ3SbB0hOnCceUrUb8mvuumKP9H0sBvxAIb0ZPFP",
    'consumer_key' => "IWJzWo6TMYwKr5C5IVGoMEZBm",
    'consumer_secret' => "MkZUab2ImuN3CH9xLhb8Afuqfi66BFNBYl5R80qKBsVZN2pVvf"
);

$urlFriends = "https://api.twitter.com/1.1/friends/list.json";
$urlFollowers ="https://api.twitter.com/1.1/followers/list.json";

$requestMethod = "GET";

if (isset($_GET['user'])) {$user = $_GET['user'];} else {$user = "prof2A4";}
$count=30;
$getfield = "?screen_name=$user&count=$count";

$twitterFriends = new TwitterAPIExchange($settings);
$twitterFriends->setGetfield($getfield)
             ->buildOauth($urlFriends, $requestMethod)
             ->performRequest();

$twitterFollowers = new TwitterAPIExchange($settings);
$twitterFollowers->setGetfield($getfield)
                ->buildOauth($urlFollowers, $requestMethod)
                ->performRequest();
?>

<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>Twitter partie 1</title>
  </head>
  <body>
    <h1>Liste d'amis</h1>
    <ul>
      <?php foreach($twitterFriends as $friend['user']) { ?>
        <li><?= $friend['screen_name'] ?> - <img src="<?= $friend['profile_image_url']?>" alt="image twitter"></li>
      <?php } ?>

    </ul>

    <h1>Liste de followers</h1>
    <ul>
      <?php foreach($twitterFollowers as $follower) { ?>
        <li><?= $follower['screen_name'] ?> - <img src="<?= $friend['profile_image_url']?>" alt="image twitter"></li>
      <?php } ?>
    </ul>
  </body>
</html>
