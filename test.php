<?php 
  
  $data = "Ese Okwi";
  $encode = base64_encode($data);
  $decode = base64_decode($encode);

  echo "<pre>";
  echo "original  data: ".$data. "<br>";
  echo "encoded  data: ".$encode. "<br>";
  echo "decoded  data: ".$decode. "<br>";
  echo basename("IMG_20151023_132719.jpg");
  echo "</pre>";


 ?>