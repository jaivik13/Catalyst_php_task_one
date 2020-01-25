<?php $var = range(0, 100); ?>

  <?php foreach ($var as &$number) {
    if ($number % 3 == 0 && $number % 5 == 0) {
      echo ">>>>>>>  foobar \n \n";
    } elseif ($number % 3 == 0) {
      echo ">>>>>>>  foo \n \n";
    } elseif ($number % 5 == 0) {
      echo ">>>>>>>  bar \n \n";
    }else
     echo "Numbers : ". $number ."\n \n";
  }
  ?>
 