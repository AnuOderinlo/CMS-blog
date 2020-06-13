<?php 
  require_once 'include/session.php';
  require_once 'include/functions.php';
  require_once 'include/config.php';
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

    <title>Blog</title>
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
              <a class="nav-link" href="blog.php">Home</a>
            </li>
            <li class="nav-item"> 
              <a class="nav-link" href="#">About us</a>
            </li> 
            <li class="nav-item"> 
              <a class="nav-link" href="#">Blog</a>
            </li> 
            <li class="nav-item">
              <a class="nav-link" href="#">Contact Us</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="#">Features</a>
            </li>
          </ul>
          <ul class="navbar-nav">
            <form class="form-inline" action="blog.php" method="
            GET">
              <div class="form-group">
                <input class="form-control" type="text" name="search" placeholder="search here">
                <button  name="submit" class="btn btn-info">Search</button>
              </div>
             </form>
          </ul>
        </div>
      </nav>
      <div class="row bg-primary" style="height: 3.5px"></div>
    </header>

    <!-- Main Content -->
    <section class="container">
      <div class="row">
        <div class="col-md-8">
          <h1>The complete Responsive CMS blog</h1>
          <h1 class="lead">The complete Blog by using PHP by Anuoluwapo Oderinlo</h1>
          <?php 
              echo errorMessage(); 
              echo successMessage(); 
          ?>
          <?php 
            if (isset($_GET['submit'])) {
              $searchInput = "%".$_GET['search']."%";
              $sql = "SELECT * FROM posts WHERE date LIKE '$searchInput' OR author LIKE '$searchInput' OR category LIKE '$searchInput' OR title LIKE '$searchInput' OR post LIKE '$searchInput'";
              $connect = $db->query($sql);
              // var_dump($connect);
            }else{
              
              $sql = "SELECT * FROM posts ORDER BY id desc";
              $connect = $db->query($sql);
            }
            
            while ($row = $connect->fetch_assoc()) {
              $id = $row["id"];
              $title = htmlentities($row['title']);
              $date = htmlentities($row['date']);
              $author = htmlentities($row['author']);
              $post = htmlentities($row['post']);
              $image = htmlentities($row['image']);
          ?>
          <div class="card mb-1">
            <img src="upload/<?php echo $image; ?>" class="img-fluid card-img-top" style="max-height: 350px">
            <div class="card-body">
              <h2 class="card-title"><?php echo $title ?></h2>
              <small class="text-muted" >Written by <?php echo $author." on ".$date; ?></small>
              <span class="badge badge-info" style="float: right">comment <?php echo comment('ON', $id) ?></span>
              <hr>
              <p class="card-text">
                <?php 
                  if (strlen($row['post']) > 120) {
                    
                    echo substr($row['post'], 0, 119)."..." ;
                  }else{
                    echo $row['post'];
                  }

               ?>
                  
              </p>
              <a href="fullPost.php?id=<?php echo $row['id'] ?>" style="float: right;" class="btn btn-primary">read more</a>
            </div>
          </div>
        <?php 
            }
          
        ?>
        </div>
        <div class="col-md-4 bg-danger">Content</div>
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