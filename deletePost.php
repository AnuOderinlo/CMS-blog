<?php 
  require_once 'include/config.php';
  require_once 'include/session.php';
  require_once 'include/functions.php';
  confirmLogin()
  /*$sql = "SELECT * FROM posts WHERE id='$id'";
  $connect = $db->query($sql);
  foreach ($connect as $row) {
    var_dump($row);
  }*/
  if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $idUrl = $_GET['id'];
  }else {
    Redirect('post.php');
  }
  
  $sql = "SELECT * FROM posts WHERE id='$idUrl'";
  $connect = $db->query($sql);

  // if ($connect) {
    foreach ($connect as $row) {
      $id = $row['id'];
      $category = $row['category'];
      $title = $row['title'];
      $post = $row['post'];
      $image = $row['image'];
    }
  // }

  // var_dump($id);
  if (isset($_POST["submit"])) {
    $sql = "DELETE FROM posts WHERE id='$id'";
    $connect = $db->query($sql);
  
    if ($connect) {
      $dirImage = "upload/$image";
      unlink($dirImage);
      $_SESSION["successMessage"] = "Successfully deleted a post";
      Redirect("post.php");
    }else{
      $_SESSION["errorMessage"] = "Couldn't delete the post, something went wrong!";
      Redirect("post.php");
    }
   }
 ?>

 <?php 
  require_once 'include/session.php';
  require_once 'include/functions.php';
  require_once 'include/config.php';
  $id = $_GET['id'];
  if (isset($_POST["submit"])) {
    $sql = "DELETE FROM posts WHERE id='$id'";
    $connect = $db->query($sql);
  
    if ($connect) {
      $_SESSION["successMessage"] = "Successfully deleted a post";
      Redirect("post.php");
    }else{
      $_SESSION["errorMessage"] = "Couldn't delete the post, something went wrong!";
      Redirect("post.php");
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

    <title>Delete post</title>
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
              <a class="nav-link" href="dasboard.php">Dashboard</a>
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
              <a href="logout.php" class="nav-link text-danger"><i class=" fas fa-sign-out-alt"></i>Logout</a>
            </li>
          </ul>
        </div>
      </nav>
      <div class="row bg-primary" style="height: 3.5px"></div>
      <div class="container text-white">
        <div class="row">
          <div class="col-md-12">
            <h1><span  class="fas fa-trash text-danger" style="color: grey"></span>&nbsp;Delete post</h1>
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

            /*$idUrl = $_GET['id'];
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
            }*/

          ?>
          <form action="deletePost.php?id=<?php echo $id ?>" method="post" enctype="multipart/form-data">
            <div class="card text-white">
              <div class="card-body bg-dark">
                <div class="form-group">
                  <label class="form-check-label text-primary">Post Title: </label>
                  <input disabled type="text" class="form-control" name="postTitle" placeholder="Type a title" value="<?php echo $title ?>">
                </div>
                <div class="form-group">
                  <label for="select-category" class="text-primary">Existing category:</label> <?php echo $category; ?><br>
                </div>
                <div class="mb-2">
                  <span class="text-primary">Existing image:</span>
                  <img style="width: 120px; height: 62px;" src="upload/<?php echo $image ?>">
                </div>
                
                <div class="form-group purple-border text-primary">
                  <label for="post" >Post</label>
                  <textarea disabled name="postContent" class="form-control" id="post" rows="7"><?php echo $post; ?></textarea>
                </div>
                <div class="row">
                  <div class="col-6">
                    <a href="#" class="btn btn-secondary btn-block"><i class="fas fa-arrow-left"></i> Back to Dashboard </a>
                  </div>
                  <div class="col-6">
                    <button type="submit" name="submit" class="btn btn-danger btn-block"><i class="fas fa-trash"></i> delete</button>
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

