<?php 
  // require_once 'include/session.php';
  // require_once 'include/functions.php';
  // require_once 'include/config.php';
  // require_once 'deletePost.php';
  require 'template/nav.php';
  $_SESSION['trackingUrl'] = $_SERVER['PHP_SELF'];
   
  $admin_id= $_SESSION["adminId"];
  $admin_status = $_SESSION["authority"];
  if ($user->check_super_admin()==$admin_status) {
    $posts = $post->find_all();
  }else{
    $posts = $post->post_by_admin_order($admin_id);
    
  }
  if (!empty($posts)) {
    # code...
    foreach ($posts as $post) {
      $id_array[]=$post->id;
    }
  }else{
    $id_array = [];
  }
  // $post->post_by_admin($admin_id);
  // $sql = "SELECT * FROM posts WHERE admin_id=$admin_id";
  // $connect = $db->query($sql);
  // while ($row = $connect->fetch_assoc()) {
  //   $admin_id = $row["admin_id"];
  //   $id = $row['id'];
  //   $id_array[]=$id;
  
  // }
 ?>
    
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
            if ($user->check_super_admin()==$admin_status) {
            
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
              <i class="fas fa-check"></i> Manage comment
            </a>
          </div>
          <?php } ?>
        </div>

      </div>      
    </header>

    <!-- Main Content -->
    <section class="container">
      <div class="row">
        <div class="col-md-3 col-3 d-none d-md-block">
          <div class="card bg-dark text-white mb-3">
            <a href="post.php" class="text-decoration-none text-white" >
              <div class="card-body">
                <div>
                  <h1>Posts</h1>
                  <h5>
                    <i class="fab fa-readme"></i>
                    <?php 
                    if ($user->check_super_admin()==$admin_status) {
                      echo totalRow("posts")>0 ? totalRow("posts") : 0;
                    }else{
                      
                      echo $post->totalRowPost($admin_id) > 0 ? $post->totalRowPost($admin_id) : 0;
                    }
                    ?>
                  </h5>
                </div>
              </div>
            </a>
          </div>
          <?php 
            if ($user->check_super_admin()==$admin_status) {
            
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
                  if ($user->check_super_admin()==$admin_status) {
                    echo totalRow("comments")>0 ? totalRow("comments") : 0;
                  }else{
                    for ($i=0; $i < count($id_array); $i++) { 
                      // echo $id_array[$i]."<br>";
                      // echo $id_array[$i];
                      $totalRow = $comment->comment_by_post($id_array[$i]);
                      $totalRow_array[] = $totalRow;
                    }
                    if (!empty($totalRow_array)) {
                      echo array_sum($totalRow_array) > 0 ? array_sum($totalRow_array): 0 ;
                      # code...
                    }else{
                      echo 0 ;

                    }

                  }
                ?>
              </h5>
            </div>
          </div>
        </div>
        <div class="col-md-9 ">
          <div class="">
            <?php echo $session->success_message(); ?>
            <h1>Top Posts</h1>
            <div class="table-responsive-md">
              <table class="table table-bordered table-hover ">
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
                  

                  $sn = 0;
                  if (!empty($posts)) {
                    foreach ($posts as $post) :
                      $sn++;
                    # code...
                  
                ?>
                    
                
                <tr>
                  <td class=""><?php echo $sn ?></td>
                  <td>
                    <?php 
                      // if (strlen($row['title']) > 16) {
                        echo $post->title;
                        // echo substr($row['title'], 0, 16)."..." ;
                      // }
                    ?>
                      
                  </td>
                  <td><?php echo $post->date?></td>
                  <td><?php echo $post->author ?></td>
                  <td>
                    <span class="badge badge-primary p-2">
                      <?php 
                        echo $comment->comment_by_post($post->id);
                      ?>
                    </span>
                  </td>
                  <td>
                    <a target="_blank" href="fullPost.php?id=<?php echo $post->id ?>"  class="btn btn-sm btn-info">live preview</a>
                  </td>
                </tr>

              <?php endforeach;} ?> 
               </table>
             </div>
          </div>
        </div>
         
      </div>
    </section>
    
    <?php require 'template/footer.php'; ?>
    
  </body>
</html>