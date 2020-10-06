<?php 
require_once "classes/init.php";
// $_SESSION['trackingUrl'] = $_SERVER['PHP_SELF'];

if (isset($_POST["submit"])) {
  // echo "It is working";
  date_default_timezone_set("Africa/Lagos");
  $data = array();
  $data["title"] = $validator->sanitize_string($_POST["categoryTitle"]);
  $data["date"] = $validator->sanitize_string(date("d/M/Y h:ia", time()));
  $data["author"] = $validator->sanitize_string($_SESSION["adminName"]);
  if (empty($data["title"])) {
    // $_SESSION["errorMessage"] = "That can not be empty";
    echo "Field can not be empty";
    // Redirect("categories.php");
  }elseif (strlen($data["title"]) < 3) {
    // $_SESSION["errorMessage"] = "Category name characters can not be less than 3";
    echo "Category name characters can not be less than 3";
    // Redirect("categories.php");
  }else{
      if ($category->create_category($data)) {
        // $session->set_success_message("Successfully added a post");
        echo "Successfully added a category";
        // Redirect("newPost.php");
      }else{
        // $session->set_error_message("Couldn't post, something went wrong");
        echo "Couldn't post, something went wrong";
        // Redirect("newPost.php");
      }
  }
}
 ?>