<?php 
  require_once "classes/init.php";
  // $_SESSION['trackingUrl'] = $_SERVER['PHP_SELF'];


  if (isset($_POST["submit"]) ) {
    // print_r($_FILES);
    $data =  array();
    date_default_timezone_set("Africa/Lagos");
    $data["date"] = date("d/M/Y h:ia", time());
    // var_dump($today);
    $data["admin_id"] = $_SESSION["adminId"];
    $data["author"] = $_SESSION["adminName"];
    $data["title"] = $validator->sanitize_string($_POST["postTitle"]);
    $data["category"]=$validator->sanitize_string($_POST['category']);
    $data["post"] = $validator->sanitize_string($_POST['postContent']);

    if (isset($_FILES["image"])) {
      $data["image"] = $post->set_file($_FILES['image']);
      $imageStored = $post->alt_picture_path($data);
    }
    // $data["image"] = "image";


    // echo $post->image;
    // var_dump($_FILES);
    if (empty($data["title"]) || empty($data["post"]) ) {
      // $session->set_error_message("Fields can't be empty");
      echo "Fields can't be empty";
      // Redirect("newPost.php");
    }elseif (strlen($data["title"]) < 5) {
      // $session->set_error_message("Post title characters can not be less than 5");
      echo "Post title characters can not be less than 5";
      // Redirect("newPost.php");
    }elseif (empty($data["image"])) {
      // $session->set_error_message("You need an image");
      echo "You need an image";
      // Redirect("newPost.php");
    }else{
      move_uploaded_file($_FILES['image']['tmp_name'], $imageStored);
      // $post->create_post($data);

      if ($post->create_post($data)) {
        // $session->set_success_message("Successfully added a post");
        echo "Successfully added a post";
        // Redirect("newPost.php");
      }else{
        // $session->set_error_message("Couldn't post, something went wrong");
        echo "Couldn't post, something went wrong";
        // Redirect("newPost.php");
      }
    }
  }


  
 ?>

