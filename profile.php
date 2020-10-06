<?php 
  require 'template/header.php'; 
  // require_once 'include/functions.php';
  // require_once 'include/config.php';

  if (isset($_GET['author'])) {
    $author = $_GET['author'];
    $author = base64_decode($author);
  }else{
    Redirect("blog.php");
  }

  $admin = new User();
  $users = $admin->author($author);
  foreach ($users as $user) {
    // $user->image = $admin->user_image;
    $user->adminName;
    $adminAry = explode(" ",$user->adminName);
    $firstname = $adminAry[0];
  }
  // print_r($adminAry);

  // print_r($author);
  // $sql = "SELECT * FROM  admins WHERE adminName='$author'";
  // $connect = $db->query($sql);
  // if ($connect) {
  //   // print_r($connect);
  //   foreach ($connect as $row) {
  //     $adminId = $row['id'];
  //     $adminName = $row['adminName'];
  //     $headline = $row['headline'];
  //     $username = $row['username'];
  //     $about = $row['about'];
  //     $image = $row['image'];
  //     $adminAry = explode(" ",$adminName);
  //     $firstname = $adminAry[0];

  //     // echo $adminName;
  //   }
  // }else{
  //   echo "It didnt connect";
  // }

  // echo $adminName;

 ?>

    

    <!-- Main Content -->
    <section class="container-fluid" style="margin-top: -1em">
      <div class="row">
        <div class="col-md-4 p-0" >
          <aside class="" style="background-image: url(<?php echo $user->picture_path(); ?>);"></aside>
        </div>
        <main class="col-md-5 pt-md-5 pt-0" >
          <h1 class="mb-0">Hi, I'm <?php echo $user->adminName; ?></h1>
          <div class="mb-5">
            <p class="lead mb-3"><?php echo $user->headline; ?></p>
            <h4>About <?php echo $user->adminName; ?></h4>
            <hr>
            <p><?php echo $user->about; ?></p>
            
          </div>

          <p>
            <a href="#" class="mr-2 mb-2">Twitter</a>
            <a href="#" class="mr-2 mb-2">Facebook</a>
            <a href="#" class="mr-2 mb-2">Instagram</a> 
          </p> 
        </main>

        <!-- side bar starts here -->
        <div class="col-md-3">
          <!-- recent post starts here -->
          <div class="card mb-5">
            <div class="card-header bg-dark text-white">
              <h5>Recent Posts by <?php echo $firstname?></h5>
            </div>
            <div class="card-body">
          <?php 
            $sql = "SELECT * FROM posts WHERE admin_id='$user->id' ORDER BY id desc LIMIT 0,5 ";
            $posts = Post::find_this_query($sql);

            foreach ($posts as $post):
           
           ?>
            
              <div class="media mt-1">
                <img src="<?php echo $post->picture_path() ?>" class="" style="width: 70px; height: 60px">
                <div class="media-body ml-3">
                  <h6><a href="fullPost.php?id=<?php echo $id ?>" style="color: grey" target = "_blank"><?php echo $post->title; ?></a></h6>
                  <p class="text-secondary"><i class="fas fa-calendar "></i> <?php echo $post->date; ?></p>
                </div>
              </div>
              <hr>
          <?php endforeach; ?>
            </div>
          </div>
          <!-- recent post ends here -->
        </div>
        <!-- side bar ends here -->
        

      </div>
    </section>

    <?php require 'template/footer.php'; ?>
    
  </body>
</html>