<?php 
  require 'template/nav.php';
  if ($user->check_super_admin()==$admin_status) {
    $posts = $post->find_all();
  }else{
    $posts = $post->post_by_admin_order($admin_id);
  }


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
    <section class="container viewport-height">
      
      
      <div class="table-responsive-md">
        <table class="table table-bordered table-sm table-hover">
          <thead class="thead-light align-center">
            <tr >
              <th>No.</th>
              <th>Title</th>
              <th>Category</th>
              <th>Date & Time</th>
              <th>Author</th>
              <th>Banner</th>
              <th>Comments</th>
              <th>Action</th>
              <th>Live Action</th>
            </tr>
          </thead>
          
          <?php 
            

            $sn = 0;
            foreach ($posts as $post) :
              $sn++;
          ?>
              
          
          <tr>
            <td class=""><?php echo $sn ?></td>
            <td>
              <?php 
                if (strlen($post->title) > 16) {
                  
                  echo substr($post->title, 0, 16)."..." ;
                }else{
                  echo $post->title;
                }
              ?>
                
            </td>
            <td><?php echo $post->category ?></td>
            <td><?php echo $post->date ?></td>
            <td><?php echo $post->author ?></td>
            <td>
              <img style="width: 60px; height: auto;" src="<?php echo $post->picture_path() ?>" />  
            </td>
            <td>
              <span class="badge badge-primary p-2">
                <?php 
                  echo $comment->comment_by_post($post->id);
                ?>
              </span>
            </td>
            <td>
              <a href="editPost.php?id=<?php echo $post->id ?>" class="btn btn-sm btn-primary" title="edit"><i class="fas fa-edit"></i></a>
              <!-- <a href="deletePost.php?id=<?php echo $post->id ?>" class="btn btn-sm btn-danger" title="delete"><i class="far fa-trash-alt"></i></a> -->
              <a href="#myModal" class="btn btn-sm btn-danger delete_link" data-id="<?php echo $post->id ?>" data-toggle="modal"> <i class=" far fa-trash-alt"></i> </a>
            </td>
            <td>
              <a target="_blank" href="fullPost.php?id=<?php echo $post->id ?>"  class="btn btn-sm btn-info">live preview</a>
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
                 <h4 class="modal-title">Are you sure you want to delete this post?</h4>
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
    </section>

    <script type="text/javascript">
      $(document).ready(function () {
        $(".delete_link").click(function () {
          var id = $(this).attr("data-id");
          var value = "deletePost.php?id=<?php ?>" + id
          $(".comment_id").attr("href", value)
            

        })
      })

      
    </script>
    
    <?php require 'template/footer.php'; ?>
    
  </body>
</html>