<?php 
  require_once 'include/session.php';
  require_once 'include/functions.php';
  require_once 'include/config.php';
  $_SESSION['trackingUrl'] = $_SERVER['PHP_SELF'];
  confirmLogin();
  if (isset($_POST["submit"])) {
    date_default_timezone_set("Africa/Lagos");
    $date = date("d/M/Y h:ia", time());
    $superAdmin = $_SESSION["adminName"];
    $username = sanitizeString($_POST["username"]);
    $name = sanitizeString($_POST["name"]);
    $password = sanitizeString($_POST["password"]);
    $confirmPassword = sanitizeString($_POST["confirmPassword"]);

    if (empty($username)||empty($password)||empty($confirmPassword)||empty($name)) {
      $_SESSION["errorMessage"] = "Field(s) can't be empty";
      Redirect("addAdmin.php");
    }elseif (strlen($password)< 4) {
      $_SESSION["errorMessage"] = "Password  characters can not be less than 4";
      Redirect("addAdmin.php");
    }elseif ($password !== $confirmPassword) {
      $_SESSION["errorMessage"] = "Passwords doesn't match";
      Redirect("addAdmin.php");
    }elseif (checkUsername($username)) {
      $_SESSION["errorMessage"] = "Username already exist, use another one";
      Redirect("addAdmin.php");
    }else{
      $sql = "INSERT INTO admins (date, username, adminName, password, superAdmin) VALUES (?,?,?,?,?)";
      $connect = $db->prepare($sql);
      $connect->bind_param("sssss", $date, $username, $name, $password, $superAdmin);
      $connect = $connect->execute();

      if ($connect) {
        $_SESSION["successMessage"] = "Successfully created an admin";
        Redirect("addAdmin.php");
      }else{
        $_SESSION["errorMessage"] = "Couldn't create an admin, something went wrong";
        Redirect("addAdmin.php");
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

    <title>Add Admin</title>
  </head>
  <body>
    <header class="container-fluid bg-dark">
      <?php require 'template/nav.php'; ?>
      <div class="row bg-primary" style="height: 3.5px"></div>
      <div class="container text-white">
        <div class="row">
          <div class="col-md-12">
            <h1><span class="fas fa-user" style="color: grey"></span>Manage Admins</h1>
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
          <form action="addAdmin.php" method="post">
            <div class="card text-white">
              <div class="card-header bg-secondary">
                <h3>Add New Admin</h3>
              </div>
              <div class="card-body bg-dark">
                <div class="form-group">
                  <label class="form-check-label">Username: </label>
                  <input type="text" class="form-control" name="username" placeholder="Username">
                </div>
                <div class="form-group">
                  <label class="form-check-label">Name: </label>
                  <input type="text" class="form-control" name="name" placeholder="Full name">
                  <!-- <small class="text-danger">*Optional</small> -->
                </div>
                <div class="form-group">
                  <label class="form-check-label">Password: </label>
                  <input type="password" class="form-control" name="password" placeholder="Type a password">
                </div>
                <div class="form-group">
                  <label class="form-check-label">Confirm Password: </label>
                  <input type="password" class="form-control" name="confirmPassword" placeholder="Retype your password">
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
          <h2>Existing Admins</h2>
          <table class="table table-bordered table-sm table-hover">
            <!-- <caption>Unapproved Comments</caption> -->
            <thead class="thead-light align-center">
              <tr class="text-center">
                <th class="">No.</th>
                <th>Date&Time</th>
                <th>Username</th>
                <th>Admin Name</th>
                <th>Added by</th>
                <th>Action</th>
              </tr>
            </thead>
            
            <?php 
              // $id = $_GET['id'];
              $sql = "SELECT * FROM admins";
              $connect = $db->query($sql);

              $sn = 0;
              while ($row = $connect->fetch_assoc()) {
                $sn++;
                $date = $row['date'];
                $username = $row['username'];
                $adminName = $row['adminName'];
                $addedBy = $row['superAdmin'];
            ?>
                
            
            <tr>
              <td class=""><?php echo $sn ?></td>
              <td><?php echo $date; ?></td>
              <td><?php echo $username ?></td>
              <td><?php echo $adminName?></td>
              <td><?php echo $addedBy?></td>
              <td><a href="deleteAdmin.php?id=<?php echo $row['id'] ?>" class="btn btn-sm btn-danger">Delete <i class=" far fa-trash-alt"></i></a>
              </td>
              
            </tr>

          <?php } ?> 
          </table>
        </div>
      </div>
    </section>

    <?php require 'template/footer.php'; ?>
    
  </body>
</html>