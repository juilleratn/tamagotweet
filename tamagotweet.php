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
                     $tweets += (int) 1;
                     fseek($txt, 0);
                     fputs($txt, $tweets);
                     fclose($txt);
                }
//le perso grossit au nombre de tweets //

      if($tweets >= 0 && $tweets <= 7){
            echo '<img src="images/phase1.gif"/>';
          }
          elseif($tweets >= 8 && $tweets <= 9 ){
          echo '<img src="images/prevomi.gif"/>';
          }
          elseif ($tweets >= 10 && $tweets <= 11 ){
          echo '<img src="images/vomi.gif"/>';
          }else{
          echo '<img src="images/barbouille.gif"/>';
          }
////////////////////////////recuperation données
        $url2 = "https://api.twitter.com/1.1/statuses/user_timeline.json";
          $requestMethod2 = "GET";
          $getfield = "?screen_name=LaetRamo&count=5"; //"?screen_name=".$name."&count=".$nbt
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
      }

      //   vomi
      $horaire1 = explode(" ",$temps[1]);
      $heure1 = explode(":",$horaire1[3]);
      switch ($horaire1[1]) {
        case 'Jan':
        $horaire1[1] = 01;
        break;
        case 'Feb':
        $horaire1[1] = 02;
        break;
        case 'Mar':
        $horaire1[1] = 03;
          break;
          case 'Apr':
          $horaire1[1] = 04;
            break;
            case 'May':
              $horaire1[1] = 05;
              break;
              case 'Jun':
                $horaire1[1] = 06;
                break;
                case 'Jul':
                  $horaire1[1]  = 07;
                  break;
                  case 'Aug':
                    $horaire1[1]  = 8;
                    break;
                    case 'Sep':
                      $horaire1[1]  = 9;
                      break;
                      case 'Oct':
                        $horaire1[1]  = 10;
                        break;
                        case 'Nov':
                          $horaire1[1]  = 11;
                          break;
                          case 'Dec':
                            $horaire1[1]  = 12;
                            break;
                      default:
                        break;
                        }
      $times= mktime($heure1[0],$heure1[1],$heure1[2],$horaire1[1],$horaire1[2],$horaire1[5]);
        $now=time();
        $diff = abs($now - $times);
        $slim1=172800;//2jours
        $slim2=43200;//12h
        $slim3=3600;//1h
        /*  if ($diff>$slim1) {
            $txt = fopen('save.txt', 'r+');
            $tweets = fgets($txt);
            $tweets = (int)0;
            fseek($txt, 0);
            fputs($txt, $tweets);
            fclose($txt);
          }elseif ($diff>$slim2) {
            $txt = fopen('save.txt', 'r+');
            $tweets = fgets($txt);
            $tweets = (int)8;
            fseek($txt, 0);
            fputs($txt, $tweets);
            fclose($txt);
          }elseif ($diff>$slim3) {
            $txt = fopen('save.txt', 'r+');
            $tweets = fgets($txt);
            $tweets = (int)10;
            fseek($txt, 0);
            fputs($txt, $tweets);
            fclose($txt);
          }*/

          $tw;
          foreach($str as $items){
          $tw[] =  $items['text'];
          }
          $items0 = explode(" ",$tw[0]);
          $items1 = explode(" ",$tw[1]);
          $items2 = explode(" ",$tw[2]);
          $items3 = explode(" ",$tw[3]);
          $items4 = explode(" ",$tw[4]);

echo "</br>".$items0[0]." ".$items1[1]." ".$items2[2]." ".$items3[3]." ".$items4[1]."</br>"."</br>";


  ?>



  </body>
</html>
