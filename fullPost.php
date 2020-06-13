<?php 
  require_once 'include/session.php';
  require_once 'include/functions.php';
  require_once 'include/config.php';

  if (isset($_GET['id'])) {
    $idUrl = $_GET['id'];
  }
  if (isset($_POST["submit"])) {
    date_default_timezone_set("Africa/Lagos");
    $today = date("d/M/Y h:ia", time());
    $commentName = trim($_POST["commentName"]);
    $commentEmail = trim($_POST["commentEmail"]);
    $commentText = $_POST['commentText'];
    // var_dump($_FILES);
    if (empty($commentName) || empty($commentEmail) || empty($commentText)  ) {
      $_SESSION["errorMessage"] = "Field can't be empty";
      Redirect("fullPost.php?id=$idUrl");
    }elseif (strlen($commentText) > 499) {
      $_SESSION["errorMessage"] = "Maximum characters reach(500 characters)";
      Redirect("fullPost.php?id=$idUrl");
    }else{
      if (preg_match('/[a-zA-Z0-9_.]{3,}@[a-zA-Z]{4,}[.]{1}[a-zA-Z0-9.]{2,}/',$commentEmail)) {
        $commentEmail = trim($_POST["commentEmail"]);
      }else{
        $_SESSION["errorMessage"] = "Invalid email";
        Redirect("fullPost.php?id=$idUrl");
      }
      $sql = sprintf("INSERT INTO comments (post_id, date, name, email, comment, admin, status) VALUES ('%s','%s','%s','%s','%s','%s','%s')",
          $idUrl,
          $db->real_escape_string($today),
          $db->real_escape_string($commentName),
          $db->real_escape_string($commentEmail),
          $db->real_escape_string($commentText),
          'Pending','OFF'
          
      );
      // var_dump($sql);
      $connect = $db->query($sql);
      if ($connect) {
        // var_dump($connect);
        $_SESSION["successMessage"] = "Successfully commented";
        Redirect("fullPost.php?id=$idUrl");
      }else{
        echo "Not working";
        $_SESSION["errorMessage"] = "Couldn't comment, something went wrong";
        Redirect("fullPost.php?id=$idUrl");
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

    <title>Full Post</title>
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
                <button  name="searchButton" class="btn btn-info">Search</button>
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
      <!-- Sub main starts here -->
        <div class="col-md-8">
          <?php echo errorMessage(); 
                echo successMessage(); 
          ?>
          <h1>The complete Responsive CMS blog</h1>
          <h1 class="lead">The complete Blog by using PHP by Anuoluwapo Oderinlo</h1>
          <?php 
          /* this php part check for a search query
           in the search input field and returns the
            result or returns the full posts*/
            if (isset($_GET['searchButton'])) {
              $searchInput = "%".$_GET['search']."%";
              $sql = "SELECT * FROM posts WHERE date LIKE '$searchInput' OR author LIKE '$searchInput' OR category LIKE '$searchInput' OR title LIKE '$searchInput' OR post LIKE '$searchInput'";
              $connect = $db->query($sql);
              // var_dump($connect);
            }else{
              $idUrl = $_GET["id"];
              $sql = "SELECT * FROM posts WHERE id='$idUrl'";
              $connect = $db->query($sql);

              if (!isset($_GET['id']) || !ctype_digit($_GET['id'])) {
                $_SESSION["errorMessage"] = "Wrong page";
                Redirect("blog.php");
                
              }
            }
            
            while ($row = $connect->fetch_assoc()) {
              // var_dump($row['id']);
              $title = htmlentities($row['title']);
              $date = htmlentities($row['date']);
              $author = htmlentities($row['author']);
              $post = htmlentities($row['post']);
              $image = htmlentities($row['image']);
          ?>
          <div class="card mb-5">
            <img src="upload/<?php echo $image; ?>" class="img-fluid card-img-top" style="max-height: 350px">
            <div class="card-body">
              <h2 class="card-title"><?php echo $title ?></h2>
              <small class="text-muted" >Written by <?php echo $author." on ".$date; ?></small>
              <span class="badge badge-info" style="float: right">comment 14</span>
              <hr>
              <p class="card-text">
                <?php 
                 echo $row['post'];

               ?>
                  
              </p>
            </div>
          </div>
        <?php 
            }
        ?>
        <!-- comment starts here -->
          <!-- commented post starts here -->
          <h6 class="display-5 text-primary">Comment</h6>
          <?php 

          /* this php part returns the available comments on a particular post of ID*/

            $sql = "SELECT * FROM comments WHERE post_id='$idUrl' AND status='ON'";
            $connect = $db->query($sql);
            // if ($connect) {
              while ($row = $connect->fetch_assoc()) {
                $nameCommenter = $row['name'];
                $comment = $row['comment'];
                $date = $row['date'];
          ?>

          <div class="media border mt-3 p-3">
            <img src="images/myAvatar.png" class="rounded-circle" style="width: 100px">
            <div class="media-body ml-3">
              <h4><?php echo $nameCommenter; ?></h4>
              <small>Posted on <?php echo $date; ?></small>
              <p class="lead"><?php echo $comment; ?></p>
            </div>
          </div>

          <?php } ?>
          <!-- commented post starts here -->
          <div class="mt-3">
            <form class="" action="fullPost.php?id=<?php echo $idUrl ?> " method="post">
              <div class="card mb-3">
                <div class="card-header">
                  <h5 class="text-muted">Will like to hear your thought on this post</h5>
                </div>
                <div class="card-body">
                  <div class="form-group">
                    <div class="input-group">
                      <div class="input-group-prepend">
                        <span class="input-group-text"><i class="fas fa-user"></i></span>
                      </div>
                      <input class="form-control" type="text" name="commentName" placeholder="Name" value="">
                    </div>
                  </div>
                  <div class="form-group">
                    <div class="input-group">
                      <div class="input-group-prepend">
                        <span class="input-group-text"><i class="fas fa-envelope"></i></span>
                      </div>
                      <input class="form-control" type="email" name="commentEmail" placeholder="Email" value="">
                    </div>
                  </div>
                  <div class="form-group">
                    <textarea name="commentText" class="form-control" rows="6"></textarea>
                  </div>
                  <div>
                    <button type="submit" class="btn btn-primary" name="submit">submit</button>
                  </div>
                </div>
              </div>
            </form>
          </div>
        <!-- comment ends here -->
        </div>
      <!-- Sub main ends here -->

      <!-- sidebar starts here -->
        <div class="col-md-4 bg-danger">Content</div>
      <!-- sidebar ends here -->
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