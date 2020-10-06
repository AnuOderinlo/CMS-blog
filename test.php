<?php 
  
 /* $data = "EseOkwi";
  $encode = base64_encode($data);
  $decode = base64_decode($encode);
  $fullName = explode(" ", $data);*/
  $value = [];
  $value2 = [];

  for ($i=0; $i < 5 ; $i++) { 
    $value[$i] = "?";
    $value2[$i] = "s";
  }
  // print_r($value);

  echo "<pre>";
    echo implode(",", $value)."<br>";
    echo implode("", $value2);
  echo "</pre>";


 ?>