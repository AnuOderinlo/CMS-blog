<?php 
  require_once "classes/init.php";
  // $_SESSION['trackingUrl'] = $_SERVER['PHP_SELF'];




  if (isset($_POST["submit"]) ) {
    $data =  array();
    echo $id = $_POST['id'];
    $post= Post::find_by_id($id);
    // print_r($_FILES);
    $existing_image = $post->image;
    $data["post_id"] = $validator->sanitize_string($_POST["id"]);
    $data["title"] = $validator->sanitize_string($_POST["postTitle"]);
    $data["category"]=$validator->sanitize_string($_POST['category']);
    $data["post"] = $validator->sanitize_string($_POST['postContent']);

    $data["image"] = $post->set_file($_FILES['image']);
    $imageStored = $post->alt_picture_path($data);
    // $data["image"] = "image";

    // var_dump($_FILES);
    if (empty($data["title"]) || empty($data["post"]) ) {
      $session->set_error_message("Fields can't be empty");
      // echo "Fields can't be empty";
      Redirect("editPost.php?id=$id");
    }elseif (strlen($data["title"]) < 5) {
      $session->set_error_message("Post title characters can not be less than 5");
      // echo "Post title characters can not be less than 5";
      Redirect("editPost.php?id=$id");
    }else{
      unlink("upload/".$existing_image);
      move_uploaded_file($_FILES['image']['tmp_name'], $imageStored);
      // $post->create_post($data);

      if (!empty($data["image"])) {
        $post->update_post_with_image($data);
      }else{
        $post->update_post($data);
      }

      $session->set_success_message("Successfully updated the post");
      Redirect("editPost.php?id=$id");

    }
  }





  
 ?>

