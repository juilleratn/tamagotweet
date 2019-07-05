<?php

$tweets = 1000;

if($tweets >= 0 && $tweets <= 10)
{
echo '<img src="images/image1.png"/>';
}
elseif($tweets >= 11 && $tweets <= 20 )
{
echo '<img src="images/image2.png"/>';
}
elseif ($tweets >= 21 && $tweets <= 30 )
{
echo '<img src="images/image3.png"/>';
}
else
{
echo '<img src="images/image4.png"/>';
}

?>
