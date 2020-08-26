<?php 
  require_once 'include/session.php';
  require_once 'include/functions.php';
  require_once 'include/config.php';
  // require_once 'deletePost.php';
  $_SESSION['trackingUrl'] = $_SERVER['PHP_SELF'];
  confirmLogin();  
  $admin_id= $_SESSION["adminId"];
  $admin_status = $_SESSION["authority"];
  $sql = "SELECT * FROM posts WHERE admin_id=$admin_id";
  $connect = $db->query($sql);
  while ($row = $connect->fetch_assoc()) {
    $id = $row["id"];
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

    <title>Dashboard</title>
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
          <?php 
            if (check_super_admin()==$admin_status) {
            
           ?>
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
          <?php } ?>
        </div>

      </div>      
    </header>

    <!-- Main Content -->
    <section class="container">
      <?php echo errorMessage(); 
            echo successMessage(); 
      ?>
      
      <div class="row">
        <div class="col-md-3 col-3 d-none d-md-block">
          <div class="card bg-dark text-white mb-3">
            <div class="card-body">
              <h1>Posts</h1>
              <h5>
                <i class="fab fa-readme"></i>
                <?php 
                if (check_super_admin()==$admin_status) {
                  echo totalRow("posts")>0 ? totalRow("posts") : 0;
                }else{
                  $sql = "SELECT * FROM posts WHERE admin_id=$admin_id";
                  $connect = $db->query($sql);

                  $totalRow = mysqli_num_rows($connect);
                  echo $totalRow > 0 ? $totalRow : 0;
                }
                ?>
              </h5>
            </div>
          </div>
          <?php 
            if (check_super_admin()==$admin_status) {
            
           ?>
          <div class="card bg-dark text-white mb-3">
            <div class="card-body">
              <h1>Admins</h1>
              <h5>
                <i class="fab fa-readme"></i>
                <?php 
                  echo totalRow("admins")
                ?>
              </h5>
            </div>
          </div>
          <?php } ?>
          <div class="card bg-dark text-white mb-3">
            <div class="card-body">
              <h1>Categories</h1>
              <h5>
                <i class="fab fa-readme"></i>
                <?php 
                  echo totalRow("category")
                ?>
              </h5>
            </div>
          </div>
          <div class="card bg-dark text-white mb-3">
            <div class="card-body">
              <h1>Comments</h1>
              <h5>
                <i class="fab fa-readme"></i>
                <?php 
                  // echo totalRow("comments");
                  if (check_super_admin()==$admin_status) {
                    echo totalRow("comments")>0 ? totalRow("comments") : 0;
                  }else{
                    $sql = "SELECT * FROM comments WHERE post_id=$id";
                    $connect = $db->query($sql);

                    $totalRow = mysqli_num_rows($connect);
                    echo $totalRow > 0 ? $totalRow : 0;
                  }
                ?>
              </h5>
            </div>
          </div>
        </div>
        <div class="col-md-9 ">
          <div class="">
            <?php echo errorMessage(); 
                  echo successMessage(); 
            ?>
            <h1>Top Posts</h1>
            <div class="table-responsive-md">
              <table class="table table-bordered table-hover">
                <thead class="thead-dark align-center">
                  <tr >
                    <th>No.</th>
                    <th>Title</th>
                    <th>Date & Time</th>
                    <th>Author</th>
                    <th>Comments</th>
                    <th>Details</th>
                  </tr>
                </thead>
                
                <?php 
                  $sql = "SELECT * FROM posts WHERE admin_id=$admin_id  ORDER BY id desc LIMIT 0,5";
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
                      // if (strlen($row['title']) > 16) {
                        echo $row['title'];
                        // echo substr($row['title'], 0, 16)."..." ;
                      // }
                    ?>
                      
                  </td>
                  <td><?php echo $row['date'] ?></td>
                  <td><?php echo $row['author'] ?></td>
                  <td>
                    <span class="badge badge-primary p-2">
                      <?php 
                        echo comment("ON", $id);
                      ?>
                    </span>
                    <span class="badge badge-danger p-2">
                      <?php 
                        echo comment("OFF", $id);
                      ?>
                    </span>
                  </td>
                  <td>
                    <a target="_blank" href="fullPost.php?id=<?php echo $row['id'] ?>"  class="btn btn-sm btn-info">live preview</a>
                  </td>
                </tr>

              <?php } ?> 
               </table>
             </div>
          </div>
        </div>
         
      </div>
    </section>
    
    <?php require 'template/footer.php'; ?>
    
  </body>
</html>