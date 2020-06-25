<?php 
  require_once 'include/session.php';
  require_once 'include/functions.php';
  require_once 'include/config.php';
  $_SESSION['trackingUrl'] = $_SERVER['PHP_SELF'];
  confirmLogin();

  // fetching existing admin
  $adminid = $_SESSION["adminId"];
  $adminName = $_SESSION["adminName"];
  

  $sql = "SELECT * FROM  admins WHERE id='$adminid'";
  $connect = $db->query($sql);
  if ($connect) {
    foreach ($connect as $row) {
      $adminName = $row['adminName'];
      $headline = $row['headline'];
      $username = $row['username'];
      $about = $row['about'];
      $image = $row['image'];
    }
  }else{
    echo "It didnt connect";
  }

  // updating the admin
  if (isset($_POST["submit"])) {

    date_default_timezone_set("Africa/Lagos");
    $today = date("d/M/Y h:ia", time());
    // var_dump($today);
    $author = $_SESSION["adminName"];
    $name= $_POST['name'];
    $headline = trim($_POST["headline"]);
    $about= $_POST['about'];
    $imageName = $_FILES['image']['name'];
    $imageStored = "images/".basename("$imageName");
    
   
    // var_dump($_FILES);
    if (empty($name) && empty($headline) && empty($imageName) && empty($about)) {
      $_SESSION["errorMessage"] = "No field to update!";
      Redirect("myProfile.php");
    }elseif (strlen($headline) > 29) {
      $_SESSION["errorMessage"] = "What you do reach maximun characters";
      Redirect("myProfile.php");
    }
    elseif (strlen($about) > 299) {
      $_SESSION["errorMessage"] = "Maximum characters reach for About(300 characters)";
      Redirect("myProfile.php");
    }else{
      move_uploaded_file($_FILES['image']['tmp_name'], $imageStored);



      if (!empty($imageName)) {
        if ($image !== "myAvatar.png") {
          unlink("images/".$image);
        }
        $sql = sprintf("UPDATE admins SET adminName='%s', headline='%s', image='%s', about='%s' WHERE id='$adminid'",
            $db->real_escape_string($name),
            $db->real_escape_string($headline),
            $db->real_escape_string($imageName),
            $db->real_escape_string($about)
        );
      }else{
        $sql = sprintf("UPDATE admins SET adminName='%s', headline='%s', about='%s' WHERE id='$adminid'",
            $db->real_escape_string($name),
            $db->real_escape_string($headline),
            $db->real_escape_string($about)
        );

        $sql2 = "UPDATE posts SET author='$name' WHERE admin_id='$adminid'";

      }
      
      var_dump($sql);
      $connect = $db->query($sql);
      $connect2 = $db->query($sql2);
      if ($connect && $connect2) {
        $_SESSION["successMessage"] = "Successfully updated your profile";
        Redirect("myProfile.php");
      }else{
        $_SESSION["errorMessage"] = "Couldn't update, something went wrong";
        Redirect("myProfile.php");
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

    <title>My Profile</title>
  </head>
  <body>
    <header class="container-fluid bg-dark">
      <?php require 'template/nav.php'; ?>
      <div class="row bg-primary" style="height: 3.5px"></div>
      <div class="container text-white">
        <div class="row">
          <div class="col-md-12">
            <h1><span class="fas fa-user" style="color: grey"></span> <?php echo $username; ?></h1>
          </div>
        </div>
      </div>      
    </header>

    <!-- Main Content -->
    <section class="container">
      <div class="row py-4">
        <div class="col-md-3 offset-md-1 mb-5">
          <div class="card">
            <div class="card-body">
              <img src="images/<?php echo $image ?>" class="card-img-top" alt="Profile-picture">
              <div>
                <h2><?php echo $adminName; ?></h2>
                <p class="lead font-italic"><?php echo $headline; ?></p>
                <hr>
                <p><?php echo $about; ?></p>
              </div>
            </div>
          </div>
        </div>
        <div class="col-md-7">
          <?php 
              echo errorMessage(); 
              echo successMessage(); 
          ?>
          <form action="myProfile.php" method="post" enctype="multipart/form-data">
            <div class="card text-white">
              <div class="card-header bg-secondary">
                <h3>Update your Profile</h3>
              </div>
              <div class="card-body bg-dark">
                <div class="form-group">
                  <label class="form-check-label">Full name: </label>
                  <small class="text-muted">e.g John Doe</small>
                  <input type="text" class="form-control" name="name" value="<?php echo $adminName ?> " placeholder="Full name please">
                </div>
                <div class="form-group">
                  <label for="select-category">What you do: </label>
                  <small class="text-muted">e.g Blogger, web developer etc.</small>
                  <input type="text" class="form-control" name="headline" value="<?php echo $headline ?>"  placeholder="What you do">
                </div>
                <span class="text-danger">Image size must be less than 2MB</span>
                <div class="custom-file mb-2">
                  <input type="file" name="image" class="custom-file-input" id="customFile">
                  <label class="custom-file-label" for="customFile">Choose image</label>
                </div>
                <div class="form-group purple-border">
                  <label for="post">About:</label>
                  <textarea name="about" class="form-control" id="post" rows="7"> <?php echo $about ?></textarea>
                </div>
                <div class="row">
                  <div class="col-6">
                    <a href="dashboard.php" class="btn btn-secondary btn-block"><i class="fas fa-arrow-left"></i> Back to Dashboard </a>
                  </div>
                  <div class="col-6">
                    <button  name="submit" class="btn btn-success btn-block"><i class="fas fa-check"></i> Update</button>
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