<?php 
require_once 'config.php';

try{
$query = "CREATE TABLE cms_blog_user(
id INT(11) NOT NULL AUTO_INCREMENT,
email VARCHAR(255) NOT NULL UNIQUE,
firstname VARCHAR(255) NOT NULL,
lastname VARCHAR(255) NOT NULL,
password VARCHAR(255) NOT NULL,
about_you VARCHAR(255) NOT NULL,
profile_pic VARCHAR(255) NOT NULL,
activation VARCHAR(20) NOT NULL,
activation_key VARCHAR(50) NOT NULL UNIQUE,
INDEX(email(6)),
INDEX(firstname(6)),
INDEX(lastname(6)),
INDEX(about_you(10)),
PRIMARY KEY (id)) ENGINE MyISAM DEFAULT CHARSET = latin1 AUTO_INCREMENT=1";
$result = $db->query($query);
if(!$result) die($db->error);
}
catch(Exception $e){
  echo $e;
}

try{
$query = "CREATE TABLE user_registration_time(
id INT(11) NOT NULL AUTO_INCREMENT,
email VARCHAR(255) NOT NULL UNIQUE,
registration_date VARCHAR(255) NOT NULL,
registration_time INT(50) NOT NULL,
user_id INT(11) NOT NULL,
INDEX(email(6)),
PRIMARY KEY (id)) ENGINE MyISAM DEFAULT CHARSET = latin1 AUTO_INCREMENT=1";
$result = $db->query($query);
if(!$result) die($db->error);
}
catch(Exception $e){
  echo $e;
}

try{
$query = "CREATE TABLE password_recovery(
id INT(11) NOT NULL AUTO_INCREMENT,
email VARCHAR(255) NOT NULL UNIQUE,
user_id INT(11) NOT NULL,
activation_code VARCHAR(50) NOT NULL UNIQUE,
verification_time INT(50) NOT NULL,
INDEX(email(6)),
PRIMARY KEY (id)) ENGINE MyISAM DEFAULT CHARSET = latin1 AUTO_INCREMENT=1";
$result = $db->query($query);
if(!$result) die($db->error);
}
catch(Exception $e){
  echo $e;
}
  
  // category table
try{
  $query = "CREATE TABLE category(
      id INT(11) NOT NULL AUTO_INCREMENT,
      title VARCHAR(50) NOT NULL ,
      author VARCHAR(50) NOT NULL,
      date VARCHAR(50) NOT NULL,
      PRIMARY KEY (id)
    )ENGINE MyISAM DEFAULT CHARSET = latin1 AUTO_INCREMENT=1";

  $result = $db->query($query);
  if(!$result) die($db->error);
}
catch(Exception $e){
  echo $e;
}

// post table
try{
  $query = "CREATE TABLE posts(
      id INT(11) NOT NULL AUTO_INCREMENT,
      date VARCHAR(50) NOT NULL ,
      author VARCHAR(50) NOT NULL,
      title VARCHAR(300) NOT NULL,
      category VARCHAR(50) NOT NULL,
      image VARCHAR(50) NOT NULL,
      post VARCHAR(500) NOT NULL,
      PRIMARY KEY (id)
    )ENGINE MyISAM DEFAULT CHARSET = latin1 AUTO_INCREMENT=1";

  $result = $db->query($query);
  if(!$result) die($db->error);
}
catch(Exception $e){
  echo $e;
}


// comments table
try{
  $query = "CREATE TABLE comments(
      id INT(11) NOT NULL AUTO_INCREMENT,
      post_id INT(11) NOT NULL ,
      date VARCHAR(50) NOT NULL ,
      name VARCHAR(50) NOT NULL,
      email VARCHAR(300) NOT NULL,
      comment VARCHAR(500) NOT NULL,
      admin VARCHAR(65) NOT NULL,
      status VARCHAR(5) NOT NULL,
      PRIMARY KEY (id)
    )ENGINE MyISAM DEFAULT CHARSET = latin1 AUTO_INCREMENT=1";

  $result = $db->query($query);
  if(!$result) die($db->error);
}
catch(Exception $e){
  echo $e;
}

// admins table
try{
  $query = "CREATE TABLE admins(
      id INT(11) NOT NULL AUTO_INCREMENT,
      date VARCHAR(50) NOT NULL ,
      username VARCHAR(50) NOT NULL,
      adminName VARCHAR(50) NOT NULL,
      password VARCHAR(50) NOT NULL,
      superAdmin VARCHAR(65) NOT NULL,
      PRIMARY KEY (id)
    )ENGINE MyISAM DEFAULT CHARSET = latin1 AUTO_INCREMENT=1";

  $result = $db->query($query);
  if(!$result) die($db->error);
}
catch(Exception $e){
  echo $e;
}


?>

<!-- (date, username, adminName, password, superAdmin -->