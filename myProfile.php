<?php 
  require 'template/nav.php';
  $_SESSION['trackingUrl'] = $_SERVER['PHP_SELF'];
  

  $adminName = $_SESSION["adminName"];
  $admin = $user->find_by_id($admin_id);
  $admin_id = $admin->id;
  $image = $admin->image;
  
  

  

  // updating the admin
  /*if (isset($_POST["submit"])) {
    echo "working?";
    $user = User::find_by_id($admin_id);
    date_default_timezone_set("Africa/Lagos");
    // var_dump($today);
    // echo $author = $_SESSION["adminName"];
    $user->adminName= $validator->sanitize_string($_POST['name']);
    $user->headline = $validator->sanitize_string($_POST["headline"]);
    $user->about= $validator->sanitize_string($_POST['about']);
    $user->image = $_FILES['image']['name'];
    $imageStored = "images/".basename("$user->image");
    
   
    // var_dump($_FILES);
    
    if (strlen($user->about) > 299) {
      $_SESSION["errorMessage"] = "Maximum characters reach for About(300 characters)";
      Redirect("myProfile.php");
    }else{
      move_uploaded_file($_FILES['image']['tmp_name'], $imageStored);

      if (!empty($user->image)) {
        $user->update_profile_image($user->image);
        Redirect("myProfile.php");
      }else{
        $user->update_profile();
        // update the post table too
        $post->update_author($user->adminName, $admin_id);
        Redirect("myProfile.php");
      }
      
    }
  }*/


  if (isset($_POST['submit'])) {
    // echo "It is working";
    $user = User::find_by_id($admin_id);
    $user->adminName= $validator->sanitize_string($_POST['name']);
    $user->headline = $validator->sanitize_string($_POST["headline"]);
    $user->about= $validator->sanitize_string($_POST['about']);
    $user->image = $_FILES['image']['name'];
    $imageStored = "images/".basename("$user->image");


    move_uploaded_file($_FILES['image']['tmp_name'], $imageStored);
    if (empty($user->image)) {
      $user->update_profile();
      // update the post table too
      // $post->update_author($user->adminName, $admin_id);
    }else{
      $user->update_profile_image($image, $admin_id);
    }

    $post->update_author($user->adminName, $admin_id);//this update the author in the post table as the user also update its name
    Redirect("myProfile.php");

    // if (strlen($user->about) > 299) {
    //   $_SESSION["errorMessage"] = "Maximum characters reach for About(300 characters)";
    //   Redirect("myProfile.php");
    // }else{
    //   move_uploaded_file($_FILES['image']['tmp_name'], $imageStored);

    //   if (!empty($user->image)) {
    //     $user->update_profile_image($user->image);
    //     Redirect("myProfile.php");
    //   }else{
    //     $user->update_profile();
    //     // update the post table too
    //     $post->update_author($user->adminName, $admin_id);
    //     Redirect("myProfile.php");
    //   }
      
    // }
  }
  
 ?>

      <div class="row bg-primary" style="height: 3.5px"></div>
      <div class="container text-white">
        <div class="row">
          <div class="col-md-12">
            <h1><span class="fas fa-user" style="color: grey"></span> <?php echo $admin->username; ?></h1>
          </div>
        </div>
      </div>      
    </header>

    <!-- Main Content -->
    <section class="container viewport-height">
      <div class="row py-4">
        <div class="col-md-3 offset-md-1 mb-5">
          <div class="card">
            <div class="card-body">
              <img src="<?php echo $admin->picture_path()?>" class="card-img-top" alt="Profile-picture">
              <div>
                <h2><?php echo $admin->adminName; ?></h2>
                <p class="lead font-italic"><?php echo $admin->headline; ?></p>
                <hr>
                <p><?php echo $admin->about; ?></p>
              </div>
            </div>
          </div>
        </div>
        <div class="col-md-7">
          <?php 
              
          ?>
          <form action="myProfile.php" method="post" enctype="multipart/form-data">
            <div class="card text-white">
              <div class="card-header bg-secondary">
                <h3>Update your Profile</h3>
              </div>
              <div class="card-body bg-dark">
                <div class="form-group">
                  <label class="form-check-label">Full name: </label>
                  <small class="text-muted">e.g John Doe</small>
                  <input type="text" class="form-control" name="name" value="<?php echo $admin->adminName ?> " placeholder="Full name please">
                </div>
                <div class="form-group">
                  <label for="select-category">What you do: </label>
                  <small class="text-muted">e.g Blogger, web developer etc.</small>
                  <input type="text" class="form-control" name="headline" value="<?php echo $admin->headline ?>"  placeholder="What you do">
                </div>
                <span class="text-danger">Image size must be less than 2MB</span>
                <div class="custom-file mb-2">
                  <input type="file" name="image" class="custom-file-input" id="customFile">
                  <label class="custom-file-label" for="customFile">Choose image</label>
                </div>
                <div class="form-group purple-border">
                  <label for="post">About:</label>
                  <textarea name="about" class="form-control" id="post" rows="7"> <?php echo $admin->about ?></textarea>
                </div>
                <div class="row">
                  <div class="col-6">
                    <a href="dashboard.php" class="btn btn-secondary btn-block"><i class="fas fa-arrow-left"></i> Back to Dashboard </a>
                  </div>
                  <div class="col-6">
                    <button  name="submit" class="btn btn-success btn-block"><i class="fas fa-check"></i> Update</button>
                  </div>
                </div>
              </div>
            </div>
          </form>
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