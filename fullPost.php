<?php 
  require_once 'template/header.php';
 /* require_once 'fullPostProcessing.php';*/
  // require_once 'fetchComment.php';
   if (isset($_GET['id'])) {
    $idUrl = $_GET['id'];
  }

  $post = Post::find_by_id($idUrl);

?>

    <!-- Main Content -->
    <section class="container">
      <div class="row">
      <!-- Sub main starts here -->
        <div class="col-md-8">
        
          <div class="card mb-5">
            <img src="<?php echo $post->picture_path(); ?>" class="img-fluid card-img-top" style="max-height: 350px">
            <div class="card-body">
              <h2 class="card-title"><?php echo $post->title ?></h2>
              <small class="text-muted" >Written by <a href="profile.php?author=<?php echo base64_encode($post->author) ?>"><?php echo $post->author; ?></a> <?php echo " on ".$post->date; ?></small>
              <hr>
              <p class="card-text">
                <?php 
                 echo $post->post;

               ?>
                  
              </p>
            </div>
          </div>
        
        <!-- comment starts here -->
          <!-- commented post starts here -->
          
          <h6 class="display-5 text-primary">Comment</h6>
          <div id="comment" >
            <input id="id" type="hidden" name="id" value="<?php echo $idUrl ?>">
            <script type="text/javascript">

              $(document).ready(function () {
                var max = false;
                var start = 0;
                var limit = 5;
                // let btn = ;
                // $("#btn").on("click", getComment);
                // console.log($("#id").val());

                // $("#btn").on("click", getComment);

                 
                
                function getComment() {
                  if (max)
                    return;
                  $.ajax({
                    url: "fetchComment.php",
                    method: "POST",
                    dataType: "text",
                    data: {
                      getData: 1,//what is this line for?
                      start: start,
                      limit: limit,
                      id: $("#id").val()
                    },
                    success: function (data) {
                      if (data==max || data==0) {
                        max= true;
                        $("#btn").hide();
                        $(".loadingdiv").hide();
                      }else{
                        $('#comment').append(data);
                        start += limit;
                         $(".loadingdiv").hide();

                      }
                    }
                  })
                }



               getComment();

                $("#btn").on("click", function(){
                  getComment();
                   $(".loadingdiv").show();
                });
              })

              // $(document).ready(function () {
              // })   
            </script>
          </div>

          <div>
            <button id="btn" class="btn btn-primary">More comment</button> 
            <div class="loadingdiv" style="display: none;"></div>
            <style type="text/css">
              .loadingdiv{
                border: 3px solid #aaa !important;
                border-top: 3px solid #000 !important;
                border-radius: 50% !important;
                width: 30px !important;
                height: 30px !important;
                animation: spin 1s linear infinite !important;
              }

              @keyframes spin{
                0%{transform: rotate(0deg);
                }
                100%{transform: rotate(360deg);
                }
              }
            </style>
          </div>

          <!-- <div id="comment" ></div> -->

          
          <!-- commented post ends here -->
          
          <div id="errorMsg" class="mt-3"></div>
          <div class="mt-3">
            <form id="form" class="commentForm" action="fullPostProcessing.php" method="post">
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
                      <input id="name" class="form-control" type="text" name="commentName" placeholder="Name" value="">
                    </div>
                  </div>
                  <div class="form-group">
                    <div class="input-group">
                      <div class="input-group-prepend">
                        <span class="input-group-text"><i class="fas fa-envelope"></i></span>
                      </div>
                      <input id="email" class="form-control" type="email" name="commentEmail" placeholder="Email" value="">
                    </div>
                  </div>
                  <div class="form-group">
                    <textarea id="commentText" name="commentText" class="form-control" rows="6"></textarea>
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

    
    


    <?php require 'template/footer.php'; ?>
    <script type="text/javascript">
      $(document).ready(function() {
        $("#form").on("submit", function (e) {
          e.preventDefault();
          // $(".errorMsg").hide();
          $.ajax({
            url:"fullPostProcessing.php",
            method:"POST",
            data:$("#form").serialize(),
            success:function(data){
              if (data == "Field can't be empty" || data == "Maximum characters reach(500 characters)" || data == "Invalid Email" || data== "Couldn't comment, something went wrong") {
                $("#errorMsg").html(`<div  id="error" class="alert  alert-danger ">${data}<button onclick="dismiss()" type="button" class="close" data-dismiss="modal">&times;</button></div>`);
                // $("#form")[0].reset()
                console.log(data);
                // $("#errorMsg").show();
              }else{
               

                $("#comment").append(data);
                $("#form")[0].reset()
                $("div#errorMsg").hide();

              }
            }
          })

        })

      })

      function dismiss() {
        $("#error").hide();
      }
    </script>

    
  </body>
</html>


