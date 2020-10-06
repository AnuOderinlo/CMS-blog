<?php 
  require 'template/nav.php';
  $_SESSION['trackingUrl'] = $_SERVER['PHP_SELF'];
 
  /*if (isset($_POST["submit"])) {
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
  }*/
  
 ?>



      
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
    <section class="container viewport-height">
      <div class="row py-4">
        <!-- Form input starts here -->
        <div class="col-md-6 mb-5">
          <div id="errorMsg"></div>
          <form action="add_admin_processor.php" method="post" id="form">
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
                  <label class="form-check-label">Email: </label>
                  <input type="email" class="form-control" name="email" placeholder="sample@xyx.com">
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
                    <input type="hidden" name="submit">
                    <button type="submit" name="submit" class="btn btn-success btn-block"><i class="fas fa-check"></i> Create</button>
                  </div>
                </div>
              </div>
            </div>
          </form>
        </div>
        <!-- List of Admins starts here -->
        <div class="table-responsive-md col-md-6">
          <div>
            <form class="form">
              <div class="input-group mb-3">
                <input type="text" class="form-control" name="search" placeholder="Admin's username" aria-label="Admin's username" aria-describedby="button-addon2">
                <div class="input-group-append">
                  <button class="btn btn-outline-secondary" name="submit" id="button-addon2">Search</button>
                </div>
              </div>
            </form>
          </div>
          <h2>Existing Admins</h2>
          <table class="table table-bordered table-sm table-hover">
            <!-- <caption>Unapproved Comments</caption> -->
            <thead class="thead-light align-center">
              <tr class="">
                <th class="">No.</th>
                <th>Date&Time</th>
                <th>Username</th>
                <th>Admin Name</th>
                <!-- <th>Added by</th> -->
                <th>Action</th>
              </tr>
            </thead>
            
            <?php 
              // $id = $_GET['id'];
              $users = User::find_all();
              if (isset($_GET["submit"])) {
                $searchInput = "%".$_GET['search']."%";
                if ($user->search_admin($searchInput)) {
                  $users=$user->search_admin($searchInput);
                }else{
                  echo '<div class="alert alert-danger ">No result found</div>';
                }
              }


              $sn = 0;
              foreach ($users as $user):
              $sn++;
            ?>
                
            
            <tr>
              <td class=""><?php echo $sn ?></td>
              <td><?php echo $user->date; ?></td>
              <td><?php echo $user->username ?></td>
              <td><?php echo $user->adminName?></td>
              
              <td>
                <a href="#myModal" class="btn btn-sm btn-danger delete_link" data-id="<?php echo $user->id ?>" data-toggle="modal">Delete <i class=" far fa-trash-alt"></i> </a>
                <!-- <a href="deleteAdmin.php?id=<?php echo $user->id ?>" class="btn btn-sm btn-danger">Delete <i class=" far fa-trash-alt"></i></a> -->
              </td>
              
            </tr>

          <?php endforeach; ?> 
          </table>
          <!-- Modal -->
          <div id="myModal" class="modal fade" role="dialog">
            <div class="modal-dialog">
              <div class="modal-content">
                <!-- modal header goes here -->
                <div class="modal-header text-center">
                  <h4 class="modal-title">Are you sure you want to delete this Admin?</h4>
                  <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>
                
                <!-- modal footer goes here -->
                <div class="modal-footer justify-content-center">
                  <a href="deleteComment.php?id=<?php echo $comment->id ?>" class="btn btn-danger comment_id">Yes</a>
                  <button type="button" class="btn btn-info" data-dismiss="modal">
                    Cancel
                  </button>
                </div>
              </div>
            </div>
          </div>

        </div>
      </div>
    </section>

    <script type="text/javascript">
      $(document).ready(function() {
        $("#form").on("submit", function (e) {
          e.preventDefault();
          // $(".errorMsg").hide();
          // alert("is it working")
          $.ajax({
            url:"add_admin_processor.php",
            method:"POST",
            data:$("#form").serialize(),
            success:function(data){
              if (data == "Field(s) can't be empty" || data == "Passwords doesn't match" || data == "Username already exist, use another one" || data == "Password  characters can not be less than 4" || data == "Couldn't create an admin, something went wrong") {
                $("#errorMsg").html(`<div  id="error" class="alert alert-danger ">${data}</div>`);
                // $("#form")[0].reset()
                console.log(data);
                // $("#errorMsg").show();
              }else{
                // console.log(typeof data);
                $("#errorMsg").html(`<div  id="error" class="alert alert-success">${data}</div>`);
                console.log(data);
                // console.log(data);
                $("#form")[0].reset()
                // $("div#errorMsg").hide();
                // window.location.reload();

              }
            }
          })
        })


        $(".delete_link").click(function () {
          var id = $(this).attr("data-id");
          var value = "deleteAdmin.php?id=<?php ?>" + id
          $(".comment_id").attr("href", value)
            console.log(value);

        })
      

       
      })
    </script>

    <?php require 'template/footer.php'; ?>
    
  </body>
</html>