<?php 
  require_once 'include/session.php';
  require_once 'include/functions.php';
  require_once 'include/config.php';
  // echo $_POST["commentName"];
  if (isset($_GET['id'])) {
    $idUrl = $_GET['id'];
  }
  if (isset($_POST["submit"])) {
    date_default_timezone_set("Africa/Lagos");
    $today = date("d/M/Y h:ia", time());
    $commentName = sanitizeString($_POST["commentName"]);
    $commentEmail = sanitizeString($_POST["commentEmail"]);
    $commentText = sanitizeString($_POST['commentText']);
    // var_dump($_FILES);
      var_dump($commentName);
    if (empty($commentName) || empty($commentEmail) || empty($commentText)  ) {
      $_SESSION["errorMessage"] = "Field can't be empty";
      Redirect("fullPost.php?id=$idUrl");
    }elseif (strlen($commentText) > 499) {
      $_SESSION["errorMessage"] = "Maximum characters reach(500 characters)";
      Redirect("fullPost.php?id=$idUrl");
    }elseif (!validator($commentEmail)) {
      $_SESSION["errorMessage"] = "Invalid Email";
      Redirect("fullPost.php?id=$idUrl");
    }else{
      
      $sql = "INSERT INTO comments (post_id, date, name, email, comment) VALUES (?,?,?,?,?)";
      $connect = $db->prepare($sql);
      $connect->bind_param("issss", $idUrl, $today, $commentName, $commentEmail, $commentText);
      $connect = $connect->execute();

      Redirect("fullPost.php?id=$idUrl");
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


<!DOCTYPE html>
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
    <script type="text/javascript" src="js/jquery-3.4.1.min.js"></script>

    <title>Full Post</title>
  </head>
  <body id="note">
    <?php require 'template/header.php'; ?>

    <!-- Main Content -->
    <section class="container">
      <div class="row">
      <!-- Sub main starts here -->
        <div class="col-md-8">
          <!-- <h1>The complete Responsive CMS blog</h1> -->
          <!-- <h1 class="lead">The complete Blog by using PHP by Anuoluwapo Oderinlo</h1> -->
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
              <small class="text-muted" >Written by <a href="profile.php?author=<?php echo base64_encode($author) ?>"><?php echo $author; ?></a> <?php echo " on ".$date; ?></small>
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

            $sql = "SELECT * FROM comments WHERE post_id='$idUrl' ORDER BY id asc";
            $connect = $db->query($sql);
            // if ($connect) {
              while ($row = $connect->fetch_assoc()) {
                $nameCommenter = $row['name'];
                $comment = $row['comment'];
                $date = $row['date'];
          ?>

          <div class="media border mt-3 p-3 mb-2">
            <div class="row">
              <div class="col-12 col-md-3">
                <img src="images/myAvatar.png" class="rounded-circle img-fluid img-25">
              </div>
              <div class="col-12 col-md-9">
                <div class="media-body ">
                  <h4><?php echo $nameCommenter; ?></h4>
                  <small>Posted on <?php echo $date; ?></small>
                  <p class=""><?php echo $comment; ?></p>
                </div>
              </div>
            </div>
            
          </div>

          <?php } ?>
          <!-- commented post starts here -->
          <?php echo errorMessage(); 
                echo successMessage(); 
          ?>
          <!-- <div id="note"></div> -->
          <div class="mt-3">
            <form id="form" action="fullPostProcessing.php" method="post">
              <input type="hidden" name="id" value="<?php echo $idUrl ?>">
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
                    <input type="hidden" name="submit">
                    <button type="submit" class="btn btn-primary" id="btn" name="submit">submit</button>
                  </div>
                </div>
              </div>
            </form>
          </div>
        <!-- comment ends here -->
        </div>
      <!-- Sub main ends here -->

      <!-- sidebar starts here -->
        <?php require 'template/sidebar.php'; ?>
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


    <script type="text/javascript">


      $(document).ready(function() {
        $("#form").on("submit", function (e) {
          e.preventDefault();
          $.ajax({
            url:"fullPostProcessing.php",
            method:"POST",
            data: new FormData(this),
            contentType: false,
            processData: false,
            success:function(data){
             $("#note").html(data);
            }
          })
        })
      

       
      })
    </script>
    
    
    
    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <!-- <script type="text/javascript" src="js/jquery-3.3.1.slim.min.js"></script> -->
    <script type="text/javascript" src="js/popper.min.js"></script>
    <script type="text/javascript" src="js/bootstrap.min.js"></script>
    
  </body>
</html>