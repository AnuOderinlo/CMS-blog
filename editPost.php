<?php 
  require_once 'include/session.php';
  require_once 'include/functions.php';
  require_once 'include/config.php';
  $_SESSION['trackingUrl'] = $_SERVER['PHP_SELF'];
  confirmLogin();
  if (isset($_POST["submit"])) {
    $id = $_GET['id'];
    date_default_timezone_set("Africa/Lagos");
    $today = date("d/M/Y h:ia", time());
    $author = $_SESSION["adminName"];
    $postTitle = trim($_POST["postTitle"]);
    $categorySelected = $_POST['category'];
    $imageName = $_FILES['image']['name'];
    $imageStored = "upload/".basename($imageName);
    $postContent = $_POST['postContent'];

    if (empty($postTitle)) {
      $_SESSION["errorMessage"] = "Post title can't be empty";
      Redirect("editPost.php");
    }elseif (strlen($postTitle)< 5) {
      $_SESSION["errorMessage"] = "Post title characters can not be less than 5";
      Redirect("editPost.php");
    }elseif (strlen($postContent) > 999) {
      $_SESSION["errorMessage"] = "Maximum characters reach(1000 characters)";
      Redirect("editPost.php");
    }else{
      move_uploaded_file($_FILES['image']['tmp_name'], $imageStored);
      if (!empty($imageName)) {
        $sql = "UPDATE posts SET title ='$postTitle', category='$categorySelected', post='$postContent', image='$imageName' WHERE id='$id'";
      }else{
        $sql = "UPDATE posts SET title ='$postTitle', category='$categorySelected', post='$postContent' WHERE id='$id'";
      }

      $connect = $db->query($sql);
      // var_dump($id);
      // var_dump($connect);
      if ($connect) {
        $_SESSION["successMessage"] = "Successfully updated a post";
        Redirect("post.php");
      }else{
        $_SESSION["errorMessage"] = "Couldn't update post, something went wrong";
        Redirect("post.php");
      }
    }
  }
  
 ?>

<!doctype html>
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

    <title>Edit post</title>
  </head>
  <body>
    <header class="container-fluid bg-dark">
      <nav class="navbar navbar-dark navbar-expand-md container ">
        <!-- Brand -->
        <a class="navbar-brand" href="#">Logo</a>
        
        <button class="navbar-toggler  navbar-light" data-toggle="collapse" data-target="#collapsibleNavbar">
          <span class="navbar-toggler-icon"></span>
        </button>
   
        <!-- Navbar links -->
        <div class="collapse navbar-collapse" id="collapsibleNavbar">
          <ul class="navbar-nav text-white mr-auto">
            <li class="nav-item">
              <a class="nav-link" href="profile.php">My profile</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="dashboard.php">Dashboard</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="post.php">Posts</a>
            </li> 
            <li class="nav-item">
              <a class="nav-link" href="categories.php">Categories</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="addAdmin.php">Manage Admins</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="comment.php">Comments</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="blog.php">Live Blog</a>
            </li>
          </ul>
          <ul class="navbar-nav">
            <li class="nav-item">
              <a href="#" class="nav-link text-danger"><i class=" fas fa-sign-out-alt"></i>Logout</a>
            </li>
          </ul>
        </div>
      </nav>
      <div class="row bg-primary" style="height: 3.5px"></div>
      <div class="container text-white">
        <div class="row">
          <div class="col-md-12">
            <h1><span class="fas fa-edit" style="color: grey"></span>Edit post</h1>
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

            $idUrl = $_GET['id'];
            $sql = "SELECT * FROM posts WHERE id='$idUrl'";
            $connect = $db->query($sql);

            if ($connect) {
              foreach ($connect as $row) {
                $id = $row['id'];
                $category = $row['category'];
                $title = $row['title'];
                $post = $row['post'];
                $image = $row['image'];
              }
            }

          ?>
          <form action="editPost.php?id=<?php echo $id ?>" method="post" enctype="multipart/form-data">
            <div class="card text-white">
              <div class="card-body bg-dark">
                <div class="form-group">
                  <label class="form-check-label">Post Title: </label>
                  <input type="text" class="form-control" name="postTitle" placeholder="Type a title" value="<?php echo $title ?>">
                </div>
                <div class="form-group">
                  <label for="select-category" class="text-primary">Existing category:</label> <?php echo $category; ?><br>
                  <label for="select-category">Choose a Category</label>
                  <select class="form-control" name="category" id="select-category">
                    <?php 
                      $sql = "SELECT id, title FROM category";
                      $connect = $db->query($sql);

                      if ($connect) {
                        foreach ($connect as $row) {
                          $id = $row['id'];
                          $title = $row['title'];
                          echo "<option>".$title."</option>";
                        }
                      }
                     ?>
                
                  </select>
                </div>
                <div class="mb-2">
                  <span class="text-primary">Existing image:</span>
                  <img style="width: 120px; height: 62px;" src="upload/<?php echo $image ?>">
                </div>
                <span class="text-danger">Image size must be less than 2MB</span>
                <div class="custom-file mb-2">
                  <input type="file" name="image" class="custom-file-input" id="customFile">
                  <label class="custom-file-label" for="customFile">Choose image</label>
                </div>
                <div class="form-group purple-border">
                  <label for="post">Post</label>
                  <textarea name="postContent" class="form-control" id="post" rows="7"><?php echo $post; ?></textarea>
                </div>
                <div class="row">
                  <div class="col-6">
                    <a href="#" class="btn btn-secondary btn-block"><i class="fas fa-arrow-left"></i> Back to Dashboard </a>
                  </div>
                  <div class="col-6">
                    <button type="submit" name="submit" class="btn btn-success btn-block"><i class="fas fa-check"></i> Publish</button>
                  </div>
                </div>
              </div>
            </div>
          </form>
        </div>
      </div>
    </section>

    <footer class="bg-dark text-white">
      <div class="container">
        <div class="row">
          <div class="col">
            <p>CMS theme built by | Anuoluwapo Oderinlo | &copy;<?php echo date("Y"); ?> All rights reserved</p>
          </div>
        </div>
      </div>
    </footer>
    
    
    
    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script type="text/javascript" src="js/jquery-3.3.1.slim.min.js"></script>
    <script type="text/javascript" src="js/popper.min.js"></script>
    <script type="text/javascript" src="js/bootstrap.min.js"></script>
    
  </body>
</html>