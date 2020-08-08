<?php 
  require_once 'include/session.php';
  require_once 'include/functions.php';
  require_once 'include/config.php';

  if (isset($_GET['author'])) {
    $author = $_GET['author'];
    $author = base64_decode($author);
  }else{
    Redirect("blog.php");
  }
  $sql = "SELECT * FROM  admins WHERE adminName='$author'";
  $connect = $db->query($sql);
  if ($connect) {
    // print_r($connect);
    foreach ($connect as $row) {
      $adminId = $row['id'];
      $adminName = $row['adminName'];
      $headline = $row['headline'];
      $username = $row['username'];
      $about = $row['about'];
      $image = $row['image'];
      $adminAry = explode(" ",$adminName);
      $firstname = $adminAry[0];

      // echo $adminName;
    }
  }else{
    echo "It didnt connect";
  }

  // echo $adminName;

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

    <title>Profile</title>
  </head>
  <body>
    <?php require 'template/header.php'; ?>

    <!-- Main Content -->
    <section class="container-fluid" style="margin-top: -1em">
      <div class="row">
        <div class="col-md-4 p-0" >
          <aside class="bg-primary " style="background-image: url(images/<?php echo $image; ?>);"></aside>
        </div>
        <main class="col-md-5 pt-md-5 pt-0" >
          <h1 class="mb-0">Hi, I'm <?php echo $adminName; ?></h1>
          <div class="mb-5">
            <p class="lead mb-3"><?php echo $headline; ?></p>
            <h4>About <?php echo $adminName; ?></h4>
            <hr>
            <p><?php echo $about; ?></p>
            
          </div>

          <p>
            <a href="#" class="mr-2 mb-2">Twitter</a>
            <a href="#" class="mr-2 mb-2">Facebook</a>
            <a href="#" class="mr-2 mb-2">Instagram</a> 
          </p> 
        </main>

        <!-- side bar starts here -->
        <div class="col-md-3">
          <!-- recent post starts here -->
          <div class="card mb-5">
            <div class="card-header bg-dark text-white">
              <h5>Recent Posts by <?php echo $firstname; ?></h5>
            </div>
            <div class="card-body">
          <?php 
            $sql = "SELECT * FROM posts WHERE admin_id='$adminId' ORDER BY id desc LIMIT 0,5 ";
            $connect = $db->query($sql);

            while ($row = $connect->fetch_assoc()) {
              $id = $row["id"];
              $title = htmlentities($row['title']);
              $date = htmlentities($row['date']);
              $author = htmlentities($row['author']);
              $post = htmlentities($row['post']);
              $image = htmlentities($row['image']);
           ?>
            
              <div class="media mt-1">
                <img src="upload/<?php echo $image ?>" class="" style="width: 70px; height: 60px">
                <div class="media-body ml-3">
                  <h6><a href="fullPost.php?id=<?php echo $id ?>" style="color: grey" target = "_blank"><?php echo $title; ?></a></h6>
                  <p class="text-secondary"><i class="fas fa-calendar "></i> <?php echo $date; ?></p>
                </div>
              </div>
              <hr>
          <?php } ?>
            </div>
          </div>
          <!-- recent post ends here -->
        </div>
        <!-- side bar ends here -->
        

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