<?php 
  require_once 'include/session.php';
  require_once 'include/functions.php';
  require_once 'include/config.php';
  // require_once 'deletePost.php';
  
  
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
              <a class="nav-link" href="admin.php">Manage Admins</a>
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
            <a href="#" class="btn btn-outline-info text-white btn-block">
              <i class="fas fa-user-tie"></i> Add new Admin
            </a>
          </div>
          <div class="col-md-3 col mb-2">
            <a href="#" class="btn text-white btn-outline-success btn-block">
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
              <th class="">#</th>
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
            <td>comments</td>
            <td>
              <a href="editPost.php?id=<?php echo $row['id'] ?>" class="btn btn-sm btn-primary">edit</a>
              <!-- <a href="deletePost.php?id=<?php echo $row['id'] ?>" class="btn btn-sm btn-danger">delete</a> -->
              <a data-toggle="modal" href="#myModal<?php echo $row['id']  ?>" class="btn btn-sm btn-danger">delete</a>
              <!-- Modal -->
                <div id="myModal<?php echo $row['id']  ?>" class="modal fade" role="dialog">
                  <div class="modal-dialog">
                    <div class="modal-content">
                      <!-- modal header goes here -->
                      <div class="modal-header bg-dark">
                        <h4 class="modal-title text-danger">Are you sure you want to delete this post?</h4>
                        <!-- <button type="button" class="close" data-dismiss="modal">&times;</button> -->
                      </div>
                      <!-- modal body goes here -->
                      <div class="modal-body">
                        <div class="row">
                          <div class="col-6">
                            <a href="post.php"  class="btn btn-secondary btn-block"><i class="fas fa-arrow-left"></i> Cancel </a>
                          </div>
                          <div class="col-6">
                            <form action="deletePost.php?id=<?php echo $row['id'] ?>" method="post">
                              <button data-target="deletePost.php?id=<?php echo $row['id'] ?>"  name="submit" class="btn btn-danger btn-block"><i class="fas fa-trash"></i> Yes</button>
                            </form>
                          </div>
                        </div>
                      </div>

                      <!-- modal footer goes here -->
                    </div>
                  </div>
                </div>
                <!-- End of Modal -->
            </td>
            <td>
              <a target="_blank" href="fullPost.php?id=<?php echo $row['id'] ?>"  class="btn btn-sm btn-info">live preview</a>
            </td>
          </tr>

        <?php } ?> 
         </table>
         <h3><?php echo $row['category']; ?></h3>
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