<?php 
  require 'template/nav.php';
  $_SESSION['trackingUrl'] = $_SERVER['PHP_SELF'];
 
  
 ?>
      <div class="row bg-primary" style="height: 3.5px"></div>
      <div class="container text-white">
        <div class="row pb-2 text-white">
          <div class="col-md-12">
            <h1><span class="fas fa-comments" style="color: grey"></span> Manage Comments</h1>
          </div>
        </div>
      </div>      
    </header>

    <!-- Main Content -->
    

    
    <section class="container">
      
      <h2>All Comments</h2>
      <div class="table-responsive-md">
        <table class="table table-bordered table-sm table-hover">
          <!-- <caption>Unapproved Comments</caption> -->
          <thead class="thead-light align-center">
            <tr class="">
              <th class="">No.</th>
              <th>Date&Time</th>
              <th>Name</th>
              <th>Comment</th>
              <th>Post title</th>
              <th>Action</th>
              <th>Details</th>
            </tr>
          </thead>
          
          <?php 
            $comments = $comment->find_comments();
            // $comments = Comment::find_all();
            $sn = 0;
            foreach ($comments as $comment):
              $sn++;
          ?>

          <?php 
            $post = $post->find_by_id($comment->post_id);

          ?>
          
          <tr>
            <td class=""><?php echo $sn ?></td>
            <td><?php echo $comment->date; ?></td>
            <td><?php echo $comment->name ?></td>
            <td><?php echo $comment->comment?></td>
            <td><?php echo $post->title; ?></td>
            
            <td>
              <a href="#myModal" class="btn btn-sm btn-danger delete_link" data-id="<?php echo $comment->id ?>" data-toggle="modal">Delete <i class=" far fa-trash-alt"></i></a>
              
            </td>
            <td>
              <a target="_blank" href="fullPost.php?id=<?php echo $comment->post_id ?>"  class="btn btn-sm btn-info">live preview</a>
            </td>
          </tr>
          <?php endforeach;  ?> 

          <!-- Modal -->
          <div id="myModal" class="modal fade" role="dialog">
            <div class="modal-dialog">
              <div class="modal-content">
                <!-- modal header goes here -->
                <div class="modal-header text-center">
                  <h4 class="modal-title">Are you sure you want to delete this comment?</h4>
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

        
        </table>
      </div>
    </section>

    


    
    <script type="text/javascript">
      $(document).ready(function () {
        $(".delete_link").click(function () {
          var id = $(this).attr("data-id");
          var value = "deleteComment.php?id=<?php ?>" + id
          $(".comment_id").attr("href", value);
            

        })
      })

      
    </script>
    <?php require 'template/footer.php'; ?>
    
  </body>
</html>