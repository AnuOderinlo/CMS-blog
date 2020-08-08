<?php 
  
  $data = "EseOkwi";
  $encode = base64_encode($data);
  $decode = base64_decode($encode);
  $fullName = explode(" ", $data);
  echo "<pre>";
  /*
  echo "original  data: ".$data. "<br>";
  echo "encoded  data: ".$encode. "<br>";
  echo "decoded  data: ".$decode. "<br>";
  echo basename("IMG_20151023_132719.jpg");*/

  print_r(str_split("alabi10@yahoo.com"));
  // echo substr(md5(uniqid(rand())), 4) ;

  // $pws = substr(md5(uniqid(rand())),0,6);
  // echo  time()  ;
  // echo md5(uniqid(rand())) ;
  // echo $fullName[0];
  echo "</pre>";


 ?>