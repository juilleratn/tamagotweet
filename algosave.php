<!doctype html>
<html lang="en">
<head>
    <title>Document</title>
</head>
<body>
<form>
<input value="tweet" href="?click=1" type="button" >
</form>
</body>

<?php


    function save(){
        $txt = fopen('save.txt', 'r+');
        $tweets = fgets($txt);
        $tweets += 1;
        fseek($txt, 0);
        fputs($txt, $tweets);
        fclose($txt);

}

      if (isset($_GET['click'])) {
          save();
      }
?>
</html>








