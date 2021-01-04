<?php 
  require_once "classes/init.php";
  if (isset($_SESSION["adminId"]) && isset($_SESSION["adminName"])) {
    $data["admin_id"] = $_SESSION["adminId"];
    $data["author"] = $_SESSION["adminName"];
  }else{
    Redirect("login.php");
  }


  if (isset($_POST["submit"]) && isset($_FILES["image"]) ) {
    $data =  array();

    date_default_timezone_set("Africa/Lagos");
    $data["date"] = date("d/M/Y h:ia", time());
    // var_dump($today);
    
        
    $data["image"] = $post->set_file($_FILES['image']);
    $imageStored = $post->alt_picture_path($data);


    /*Form validation*/
    if ($data["title"] = $validator->isEmpty($_POST["postTitle"], "Title")) {
      if ($data["image"] = $validator->isEmpty($_FILES["image"]["name"], "Image")) {
        if ($data["post"] = $validator->isEmpty($_POST["postContent"], "Post")) {
          move_uploaded_file($_FILES['image']['tmp_name'], $imageStored);

          if ($post->create_post($data)) {
            echo "Successfully added a post";
          }else{
            echo "Couldn't post, something went wrong";
          }
        }
      }
    }
    
   




  }









 ?>