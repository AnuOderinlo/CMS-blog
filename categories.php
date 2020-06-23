<?php 
  require_once 'include/session.php';
  require_once 'include/functions.php';
  require_once 'include/config.php';
  $_SESSION['trackingUrl'] = $_SERVER['PHP_SELF'];
  confirmLogin();
  if (isset($_POST["submit"])) {
    $category = trim($_POST["categoryTitle"]);
    date_default_timezone_set("Africa/Lagos");
    $date = date("d/M/Y h:ia", time());
    $author = $_SESSION["adminName"];
    if (empty($category)) {
      $_SESSION["errorMessage"] = "That can not be empty";
      Redirect("categories.php");
    }elseif (strlen($category)< 3) {
      $_SESSION["errorMessage"] = "Category name characters can not be less than 3";
      Redirect("categories.php");
    }else{

      $sql = sprintf("INSERT INTO category (title, author, date) VALUES ('%s','%s','%s')",
          $db->real_escape_string($category),
          $db->real_escape_string($author),
          $db->real_escape_string($date)
      );

      $connect = $db->query($sql);
      if ($connect) {
        $_SESSION["successMessage"] = "Successfully added a category";
        Redirect("categories.php");
      }else{
        $_SESSION["errorMessage"] = "Couldn't add a category, something went wrong";
        Redirect("categories.php");
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

    <title>CMS|project</title>
  </head>
  <body>
    <header class="container-fluid bg-dark">
      <?php require 'template/nav.php'; ?>
      <div class="row bg-primary" style="height: 3.5px"></div>
      <div class="container text-white">
        <div class="row">
          <div class="col-md-12">
            <h1><span class="fas fa-edit" style="color: grey"></span>Manage Categories</h1>
          </div>
        </div>
      </div>      
    </header>

    <!-- Main Content -->
    <section class="container">
      <div class="row py-4">
        <div class="offset-md-2 col-md-8 mb-5">
          <?php echo errorMessage(); 
                echo successMessage(); 
          ?>
          <form action="categories.php" method="post">
            <div class="card text-white">
              <div class="card-header bg-secondary">
                <h3>Add New Category</h3>
              </div>
              <div class="card-body bg-dark">
                <div class="form-group">
                  <label class="form-check-label">Category Title: </label>
                  <input type="text" class="form-control" name="categoryTitle" placeholder="Type a category">
                </div>
                <div class="row">
                  <div class="col-6">
                    <a href="#" class="btn btn-secondary btn-block"><i class="fas fa-arrow-left"></i> Back to Dashboard </a>
                  </div>
                  <div class="col-6">
                    <button type="submit" name="submit" class="btn btn-success btn-block"><i class="fas fa-check"></i> Publish</button>
                  </div>
                </div>
              </div>
            </div>
          </form>
        </div>
        <div class="table-responsive-md offset-md-2 col-md-8">
          <h2>Existing Categories</h2>
          <table class="table table-bordered table-sm table-hover">
            <!-- <caption>Unapproved Comments</caption> -->
            <thead class="thead-light align-center">
              <tr class="text-center">
                <th class="">No.</th>
                <th>Date&Time</th>
                <th>Category Name</th>
                <th>Creator Name</th>
                <th>Action</th>
              </tr>
            </thead>
            
            <?php 
              // $id = $_GET['id'];
              $sql = "SELECT * FROM category";
              $connect = $db->query($sql);

              $sn = 0;
              while ($row = $connect->fetch_assoc()) {
                $sn++;
                $date = $row['date'];
                $category = $row['title'];
                $creator = $row['author'];
            ?>
                
            
            <tr>
              <td class=""><?php echo $sn ?></td>
              <td><?php echo $date; ?></td>
              <td><?php echo $creator ?></td>
              <td><?php echo $category?></td>
              <td><a href="deleteCategory.php?id=<?php echo $row['id'] ?>" class="btn btn-sm btn-danger">Delete</a>
              </td>
              
            </tr>

          <?php } ?> 
          </table>
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