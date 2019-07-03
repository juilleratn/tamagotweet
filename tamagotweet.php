<!DOCTYPE html>
 <html lang="fr" dir="ltr">
   <head>
     <meta charset="utf-8">
     <title>tamagotweet</title>
   </head>
   <body>
     <form method="post" target="blank" action="tamagotweet.php">

       <textarea name="tweet" rows="4" cols="75"placeholder="limité à 280 caractères" maxlength="280"></textarea>
       <input type="submit" name="envoi" value="Tweet!">    <!--limiter à 280caracteres-->


<?php

      require_once("TwitterAPIExchange.php");
      $settings= array (//token Laetitia
          'oauth_access_token'=> "1145657243901341698-pe40xlaC01v2xydmM5h6lo7V5K39Tg",
          'oauth_access_token_secret'=> "0zWlEBu07yjqWumEMvHYRvbrB0jGZYHu83JRBKdyweoNq",
          'consumer_key'=> "sSzpPYsJahDnNFuPeUPnpkZ5D",
          'consumer_secret'=>"yuG9e2TmyGNu4uUdA3ggFtW0T5Zbos9zc0prSJ0hwf2st8KxGC"
        );
        $url="https://api.twitter.com/1.1/statuses/update.json";//creation de tweets
      //$url = "https://api.twitter.com/1.1/search/tweets.json"; recherche
      //$url="https://api.twitter.com/1.1/statuses/user_timeline.json";recuperer les tweets
      //$url = "https://developer.twitter.com/en/docs/tweets/timelines/overview"; doc twitter
      $requestMethod = "POST";
      $text=$_POST["tweet"];
      $postfields= array('status' => $text);


      $twitter = new TwitterAPIExchange($settings);
      echo $twitter->buildOauth($url, $requestMethod)
                   ->setPostfields($postfields)
                   ->performRequest();

  ?>
  </body>
</html>
