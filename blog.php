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
    <?php require 'template/header.php'; ?>

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
            // search query
            if (isset($_GET['submit'])) {
              $searchInput = "%".$_GET['search']."%";
              $sql = "SELECT * FROM posts WHERE date LIKE '$searchInput' OR author LIKE '$searchInput' OR category LIKE '$searchInput' OR title LIKE '$searchInput' OR post LIKE '$searchInput'";
              $connect = $db->query($sql);
              
            // category query;
            }elseif (isset($_GET['category'])) {
              $category = $_GET['category'];
              $sql = "SELECT * FROM posts WHERE category='$category' ORDER BY id desc ";
              $connect = $db->query($sql);
            }
            elseif (isset($_GET['page'])) {
              $page = $_GET['page'];
              $pagination = ($page*3)-3;
              $sql = "SELECT * FROM posts ORDER BY id desc LIMIT $pagination,3";
              $connect = $db->query($sql);
            }
            // default sql
            else{
              
              $sql = "SELECT * FROM posts ORDER BY id desc";
              $connect = $db->query($sql);
              Redirect('blog.php?page=1');
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
              <small class="text-muted" >Written by <a href="profile.php?author=<?php echo base64_encode($author) ?>"><?php echo $author; ?></a> <?php echo " on ".$date; ?></small>
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
          <!-- pagination -->
          <nav class="mt-5">
            <ul class="pagination pagination-md">
              <?php if (isset($page)) {
                # code...
               ?>
              <?php 
                  if ($page != 1) {
               ?>
              <li class="page-item">
                <a href="blog.php?page=<?php echo $page-1?>" class="page-link "><<</a>
              </li>
            <?php 
                }
               $totalPost = totalRow("posts");
               $postPerPage = ceil($totalPost/3);

               for ($i=1; $i <= $postPerPage ; $i++) { 
                if ($page == $i) {
                  echo '<li class="page-item active">
                          <a href="blog.php?page=<?php echo $i ?>" class="page-link ">'.$i.'</a>
                        </li>';
               }else{

             ?>
            
              <li class="page-item">
                <a href="blog.php?page=<?php echo $i ?>" class="page-link "><?php echo $i; ?></a>
              </li>
              <?php } ?>
            <?php 
                  } 
                  if ($page < $postPerPage) {
               ?>
              <li class="page-item">
                <a href="blog.php?page=<?php echo $page+1?>" class="page-link ">>></a>
              </li>
              <?php } }?>

            </ul>
          </nav>
        </div>

        <!-- sidebar starts here -->
        <?php require 'template/sidebar.php'; ?>
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