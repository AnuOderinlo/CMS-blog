<?php 
  require_once 'include/session.php';
  require_once 'include/functions.php';
  require_once 'include/config.php';
  $_SESSION['trackingUrl'] = $_SERVER['PHP_SELF'];
  confirmLogin();

  if (isset($_POST["submit"])) {
    date_default_timezone_set("Africa/Lagos");
    $today = date("d/M/Y h:ia", time());
    // var_dump($today);
    $adminId = $_SESSION["adminId"];
    $author = $_SESSION["adminName"];
    $postTitle = sanitizeString($_POST["postTitle"]);
    $categorySelected = $_POST['category'];
    $imageName = $_FILES['image']['name'];
    $imageStored = "upload/".basename($imageName);
    $postContent = sanitizeString($_POST['postContent']);
    // var_dump($_FILES);
    if (empty($postTitle)) {
      $_SESSION["errorMessage"] = "Post title can't be empty";
      Redirect("newPost.php");
    }elseif (strlen($postTitle) < 5) {
      $_SESSION["errorMessage"] = "Post title characters can not be less than 5";
      Redirect("newPost.php");
    }
    // elseif (strlen($postContent) > 999) {
    //   $_SESSION["errorMessage"] = "Maximum characters reach(1000 characters)";
    //   Redirect("newPost.php");
    // }
    elseif (empty($imageName)) {
      $_SESSION["errorMessage"] = "You need an image";
      Redirect("newPost.php");
    }/*elseif (isset($imageName)) {
      if ($_FILES['image']['size'] > 1900000) {
        $_SESSION["errorMessage"] = "Image size must be less than 2MB)";
        Redirect("newPost.php");
      }
    }*/else{
      move_uploaded_file($_FILES['image']['tmp_name'], $imageStored);
      $sql ="INSERT INTO posts (admin_id, date, author, title, category, image, post) VALUES (?,?,?,?,?,?,?)";

      $connect = $db->prepare($sql);
      $connect->bind_param("sssssss", $adminId, $today, $author, $postTitle, $categorySelected, $imageName, $postContent);
      if ($connect->execute()) {
        $_SESSION["successMessage"] = "Successfully added a post";
        Redirect("newPost.php");
      }else{
        $_SESSION["errorMessage"] = "Couldn't post, something went wrong";
        Redirect("newPost.php");
      }
    }
  }
  
 ?>


<!DOCTYPE html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" type="text/css" href="css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="css/style.css">
    <!-- <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css"> -->
    <link rel="stylesheet" type="text/css" href="css/css/all.css">
    <script src="https://cdn.tiny.cloud/1/no-api-key/tinymce/5/tinymce.min.js" referrerpolicy="origin"></script>
      <script>tinymce.init({selector:'textarea'});</script>

    <title>Add Post</title>
  </head>
  <body>
    <header class="container-fluid bg-dark">
      <?php require 'template/nav.php'; ?>
      <div class="row bg-primary" style="height: 3.5px"></div>
      <div class="container text-white">
        <div class="row">
          <div class="col-md-12">
            <h1><span class="fas fa-edit" style="color: grey"></span>Add new post</h1>
          </div>
        </div>
      </div>      
    </header>

    <!-- Main Content -->
    <section class="container">
      <div class="row py-4">
        <div class="offset-md-1 col-md-10">
          <?php 
              echo errorMessage(); 
              echo successMessage(); 
          ?>
          <form action="newPost.php" method="post" enctype="multipart/form-data">
            <div class="card text-white">
              <div class="card-header bg-secondary">
                <h3>Feel free to add a post</h3>
              </div>
              <div class="card-body bg-dark">
                <div class="form-group">
                  <label class="form-check-label">Post Title: </label>
                  <input type="text" class="form-control" name="postTitle" placeholder="Type a title">
                </div>
                <div class="form-group">
                  <label for="select-category">Choose a Category</label>
                  <select class="form-control" name="category" id="select-category">
                    <?php 
                      $sql = "SELECT id, title FROM category";
                      $connect = $db->prepare($sql);

                      if ($connect->execute()) {
                        $connect->bind_result($id, $title);
                        while ($connect->fetch()) {
                          echo "<option>".$title."</option>";
                        }
                        $connect->close();
                      }
                      $db->close();
                     ?>
                
                  </select>
                </div>
                <span class="text-danger">Image size must be less than 2MB</span>
                <div class="custom-file mb-2">
                  <input type="file" name="image" class="custom-file-input" id="customFile">
                  <label class="custom-file-label" for="customFile">Choose image</label>
                </div>
                <div class="form-group purple-border">
                  <label for="post">Post</label>
                  <textarea name="postContent" class="form-control" id="post" rows="20"></textarea>
                </div>
                <div class="row">
                  <div class="col-6">
                    <a href="dashboard.php" class="btn btn-secondary btn-block"><i class="fas fa-arrow-left"></i> Back to Dashboard </a>
                  </div>
                  <div class="col-6">
                    <button  name="submit" class="btn btn-success btn-block"><i class="fas fa-check"></i> Publish</button>
                  </div>
                </div>
              </div>
            </div>
          </form>
        </div>
      </div>
    </section>

    <?php require 'template/footer.php'; ?>
    
  </body>
</html>