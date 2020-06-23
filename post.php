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

    <title>CMS|project</title>
  </head>
  <body>
    <header class="container-fluid bg-dark mb-3">
      <?php require 'template/nav.php'; ?>
      <div class="row bg-primary" style="height: 3.5px"></div>
      <div class="container text-white">
        <div class="row pb-2 text-white">
          <div class="col-md-12">
            <h1><span class="fas fa-blog" style="color: grey"></span> View post</h1>
          </div>
          <div class="col-md-3 col mb-2">
            <a href="newPost.php" class="btn text-white btn-outline-danger btn-block">
              <i class="fas fa-edit"></i> Add new Post
            </a>
          </div>
          <div class="col-md-3 col mb-2">
            <a href="categories.php" class="btn text-white btn-outline-secondary btn-block">
              <i class="fas fa-edit"></i> Add new category
            </a>
          </div>
          <div class="col-md-3 col mb-2">
            <a href="addAdmin.php" class="btn btn-outline-info text-white btn-block">
              <i class="fas fa-user-tie"></i> Add new Admin
            </a>
          </div>
          <div class="col-md-3 col mb-2">
            <a href="comment.php" class="btn text-white btn-outline-success btn-block">
              <i class="fas fa-check"></i> Approve comment
            </a>
          </div>
          
        </div>
      </div>      
    </header>

    <!-- Main Content -->
    <section class="container">
      <?php echo errorMessage(); 
            echo successMessage(); 
      ?>
      
      <div class="table-responsive-md">
        <table class="table table-bordered table-sm table-hover">
          <thead class="thead-light align-center">
            <tr >
              <th>No.</th>
              <th>Title</th>
              <th>Category</th>
              <th>Date & Time</th>
              <th>Author</th>
              <th>Banner</th>
              <th>Comments</th>
              <th>Action</th>
              <th>Live Action</th>
            </tr>
          </thead>
          
          <?php 
            $sql = "SELECT * FROM posts";
            $connect = $db->query($sql);

            $sn = 0;
            while ($row = $connect->fetch_assoc()) {
              $id = $row['id'];
              $sn++;
          ?>
              
          
          <tr>
            <td class=""><?php echo $sn ?></td>
            <td>
              <?php 
                if (strlen($row['title']) > 16) {
                  
                  echo substr($row['title'], 0, 16)."..." ;
                }else{
                  echo $row['title'];
                }
              ?>
                
            </td>
            <td><?php echo $row['category'] ?></td>
            <td><?php echo $row['date'] ?></td>
            <td><?php echo $row['author'] ?></td>
            <td>
              <img style="width: 60px; height: auto;" src="upload/<?php echo $row['image'] ?>" />  
            </td>
            <td>
              <span class="badge badge-primary p-2">
                <?php 
                  echo comment("ON", $id);
                ?>
              </span>
              <span class="badge badge-warning p-2">
                <?php 
                  echo comment("OFF", $id);
                ?>
              </span>
            </td>
            <td>
              <a href="editPost.php?id=<?php echo $row['id'] ?>" class="btn btn-sm btn-primary">edit</a>
              <a href="deletePost.php?id=<?php echo $row['id'] ?>" class="btn btn-sm btn-danger">delete</a>
            </td>
            <td>
              <a target="_blank" href="fullPost.php?id=<?php echo $row['id'] ?>"  class="btn btn-sm btn-info">live preview</a>
            </td>
          </tr>

        <?php } ?> 
         </table>
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