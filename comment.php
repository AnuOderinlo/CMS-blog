<?php 
  require_once 'include/session.php';
  require_once 'include/functions.php';
  require_once 'include/config.php';
  // require_once 'deletePost.php';
  $_SESSION['trackingUrl'] = $_SERVER['PHP_SELF'];
  confirmLogin();  
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

    <title>Manage Comment</title>
  </head>
  <body>
    <header class="container-fluid bg-dark mb-3">
      <?php require 'template/nav.php'; ?>
      <div class="row bg-primary" style="height: 3.5px"></div>
      <div class="container text-white">
        <div class="row pb-2 text-white">
          <div class="col-md-12">
            <h1><span class="fas fa-comments" style="color: grey"></span> Manage Comments</h1>
          </div>
        </div>
      </div>      
    </header>

    <!-- Main Content -->
    

    <section class="container">
      <?php echo errorMessage(); 
            echo successMessage(); 
      ?>
      <h2>Unapproved Comments</h2>
      <div class="table-responsive-md">
        <table class="table table-bordered table-sm table-hover">
          <!-- <caption>Unapproved Comments</caption> -->
          <thead class="thead-light align-center">
            <tr class="text-center">
              <th class="">No.</th>
              <th>Date&Time</th>
              <th>Name</th>
              <th>Comment</th>
              <th colspan="2">Action</th>
              <th>Details</th>
            </tr>
          </thead>
          
          <?php 
            $sql = "SELECT * FROM comments WHERE status='OFF' ORDER BY id desc";
            $connect = $db->query($sql);

            $sn = 0;
            while ($row = $connect->fetch_assoc()) {
              $sn++;
              $date = $row['date'];
              $name = $row['name'];
              $comment = $row['comment'];
          ?>
              
          
          <tr>
            <td class=""><?php echo $sn ?></td>
            <td><?php echo $date; ?></td>
            <td><?php echo $name ?></td>
            <td><?php echo $comment?></td>
            <td><a href="approveComment.php?id=<?php echo $row['id'] ?>" class="btn btn-sm btn-success">Approve</a></td>
            <td>
              <a href="deleteComment.php?id=<?php echo $row['id'] ?>" class="btn btn-sm btn-danger">Delete</a>
            </td>
            <td>
              <a target="_blank" href="fullpost.php?id=<?php echo $row['post_id'] ?>"  class="btn btn-sm btn-info">live preview</a>
            </td>
          </tr>

        <?php } ?> 
        </table>
      </div>
    </section>
    <section class="container">
      <?php echo errorMessage(); 
            echo successMessage(); 
      ?>
      <h2>Approved Comments</h2>
      <div class="table-responsive-md">
        <table class="table table-bordered table-sm table-hover">
          <!-- <caption>Unapproved Comments</caption> -->
          <thead class="thead-light align-center">
            <tr class="text-center">
              <th class="">No.</th>
              <th>Date&Time</th>
              <th>Name</th>
              <th>Comment</th>
              <th colspan="2">Action</th>
              <th>Details</th>
            </tr>
          </thead>
          
          <?php 
            $sql = "SELECT * FROM comments WHERE status='ON' ORDER BY id desc";
            $connect = $db->query($sql);

            $sn = 0;
            while ($row = $connect->fetch_assoc()) {
              $sn++;
              $date = $row['date'];
              $name = $row['name'];
              $comment = $row['comment'];
          ?>
              
          
          <tr>
            <td class=""><?php echo $sn ?></td>
            <td><?php echo $date; ?></td>
            <td><?php echo $name ?></td>
            <td><?php echo $comment?></td>
            <td><a href="unapproveComment.php?id=<?php echo $row['id'] ?>" class="btn btn-sm btn-warning"><i class="fas fa-thumbs-down"></i></a></td>
            <td>
              <a href="deleteComment.php?id=<?php echo $row['id'] ?>" class="text-white btn btn-sm btn-danger"><i class=" far fa-trash-alt"></i></a>
            </td>
            <td>
              <a target="_blank" href="fullpost.php?id=<?php echo $row['post_id'] ?>"  class="btn btn-sm btn-info">live preview</a>
            </td>
          </tr>

        <?php } ?> 
        </table>
      </div>
    </section>


    
    
    <?php require 'template/footer.php'; ?>
    
  </body>
</html>