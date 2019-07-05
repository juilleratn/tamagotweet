<!DOCTYPE html>
 <html lang="fr" dir="ltr">
   <head>
     <meta charset="utf-8">
     <title>tamagotweet</title>
   </head>
   <body>
     <form method="post"  action="tamagotweet.php">
       <textarea name="tweet" rows="4" cols="75"placeholder="limité à 280 caractères" maxlength="280"></textarea>
       <input type="submit" name="btn"  value="Tweet!">

       <br>
<?php
//////////////////////envoi de données
    require_once("TwitterAPIExchange.php");
          $settings= array (//token Laetitia
          'oauth_access_token'=> "1145657243901341698-pe40xlaC01v2xydmM5h6lo7V5K39Tg",
          'oauth_access_token_secret'=> "0zWlEBu07yjqWumEMvHYRvbrB0jGZYHu83JRBKdyweoNq",
          'consumer_key'=> "sSzpPYsJahDnNFuPeUPnpkZ5D",
          'consumer_secret'=>"yuG9e2TmyGNu4uUdA3ggFtW0T5Zbos9zc0prSJ0hwf2st8KxGC"
        );
      $url1="https://api.twitter.com/1.1/statuses/update.json";//creation de tweets
              //$url = "https://api.twitter.com/1.1/search/tweets.json"; recherche
              //$url="https://api.twitter.com/1.1/statuses/user_timeline.json";recuperer les tweets
              //$url = "https://developer.twitter.com/en/docs/tweets/timelines/overview"; doc twitter
      $text=$_POST["tweet"];
      $requestMethod1 = "POST";
      $postfields= array('status' => $text);
      $twitter1 = new TwitterAPIExchange($settings);
      echo $twitter1->buildOauth($url1, $requestMethod1)
                   ->setPostfields($postfields)
                   ->performRequest();
//inscrit le nombre de tweet dans le fichier save.txt
      if (!empty($_POST["btn"])){
                     $txt = fopen('save.txt', 'r+');
                     $tweets = fgets($txt);
                     $tweets += (int)1;
                     fseek($txt, 0);
                     fputs($txt, $tweets);
                     fclose($txt);
                }
//le perso grossit au nombre de tweets //
      if($tweets >= 0 && $tweets <= 7){
            echo '<img src="images/image1.png"/>';
          }
          elseif($tweets >= 8 && $tweets <= 9 ){
          echo '<img src="images/image2.png"/>';
          }
          elseif ($tweets >= 10 && $tweets <= 11 ){
          echo '<img src="images/image3.png"/>';
          }else{
          echo '<img src="images/image4.png"/>';
          }
////////////////////////////recuperation données
        $url2 = "https://api.twitter.com/1.1/statuses/user_timeline.json";
          $requestMethod2 = "GET";
          $getfield = "?screen_name=LaetRamo&count=2"; //"?screen_name=".$name."&count=".$nbt
          $twitter2 = new TwitterAPIExchange($settings);
          $str =json_decode(
             $twitter2 -> setGetfield($getfield)
                      ->buildOauth($url2, $requestMethod2)
                      ->performRequest(), $assoc=true);
echo "<br>";
//recuperation horaire du tweet//
      $temps;
      $vomi;
      foreach($str as $items){
        $temps[]= $items['created_at'];
        echo "<br>";
        $vomi[]=$items['text'];
        }
        print_r ($temps);
        print_r($vomi);
      //   il reste a définir le texte du tableau en varaiable






  ?>



  </body>
</html>
