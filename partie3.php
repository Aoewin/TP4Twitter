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

$url = "https://api.twitter.com/1.1/statuses/user_timeline.json";

$requestMethod = "GET";

if (isset($_GET['user'])) {$user = $_GET['user'];} else {$user = "radiocanadainfo";}
$count=200;
$getfield = "?screen_name=$user&count=$count";

$twitter = new TwitterAPIExchange($settings);
echo $twitter->setGetfield($getfield)
             ->buildOauth($url, $requestMethod)
             ->performRequest();
?>

<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>Partie 3</title>
  </head>
  <body>
  </body>
</html>
