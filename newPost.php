<?php 
  require 'template/nav.php'; 

  $_SESSION['trackingUrl'] = $_SERVER['PHP_SELF'];
 ?>


      <div class="row bg-primary" style="height: 3.5px"></div>
      <div class="container text-white">
        <div class="row">
          <div class="col-md-12">
            <h1><span class="fas fa-edit" style="color: grey"></span>Add new post</h1>
          </div>
        </div>
      </div>      
    </header>

    <!-- Main Content -->
    <section class="container">
      <div class="row py-4">
        <div class="offset-md-1 col-md-10">
          <div id="errorMsg"></div>
          <form action="newPost.php" method="post" enctype="multipart/form-data" id="form">
            <div class="card text-white">
              <div class="card-header bg-secondary">
                <h3>Feel free to add a post</h3>
              </div>
              <div class="card-body bg-dark">
                <div class="form-group">
                  <label class="form-check-label">Post Title: </label>
                  <input type="text" class="form-control" name="postTitle" placeholder="Type a title" value="">
                </div>
                <div class="form-group">
                  
                  <label for="select-category">Choose a Category</label>
                  <select class="form-control" name="category" id="select-category">
                    <?php 
                      $categories = Category::find_all();

                      foreach ($categories as $category) {
                        echo "<option>{$category->title}</option>";
                      }
                    ?>
                  </select>
                  
                </div>
                <span class="text-danger">Image size must be less than 2MB</span>
                <div class="custom-file mb-2">
                  <input type="file" name="image" class="custom-file-input" id="customFile" value="image.jpg">
                  <label class="custom-file-label" for="customFile">Choose image</label>
                </div>
                <div class="form-group purple-border">
                  <label for="post">Post</label>
                  <textarea name="postContent" class="form-control" id="post" rows="12"></textarea>
                </div>
                <div class="row">
                  <div class="col-6">
                    <a href="dashboard.php" class="btn btn-secondary btn-block"><i class="fas fa-arrow-left"></i> Back to Dashboard </a>
                  </div>
                  <div class="col-6">
                    <input type="hidden" name="submit">
                    <button  name="submit" class="btn btn-success btn-block"><i class="fas fa-check"></i> Publish</button>
                  </div>
                </div>
              </div>
            </div>
          </form>
        </div>
      </div>
    </section>

    <script type="text/javascript">
      $(document).ready(function() {
        // var input = $('input[name="image"]').val();
        // alert(input);
        $("#form").on("submit", function (e) {
          e.preventDefault();
          // $(".errorMsg").hide();
          $.ajax({
            url:"new_post_processor.php",
            method:"POST",
            data:$("#form").serialize(),
            success:function(data){
              console.log(data);
            if (data === "Post title characters can not be less than 5") {
              $("#errorMsg").html(`<div  id="error" class="alert alert-danger ">${data}</div>`);

            }
              // if (data == "Field can't be empty" || data == "Post title characters can not be less than 5" || data == "You need an image" || data== "Couldn't post, something went wrong") {
              //   $("#errorMsg").html(`<div  id="error" class="alert alert-danger ">${data}</div>`);
              //   // $("#form")[0].reset()
              //   console.log(data);
              //   // $("#errorMsg").show();
              // }else{
              //   // console.log(typeof data);
              //   $("#errorMsg").html(`<div  id="error" class="alert alert-success">${data}</div>`);
              //   // console.log(data);
              //   $("#form")[0].reset()
              //   $("div#errorMsg").hide();

              // }
            }
          })
        })
      

       
      })
    </script>

    <?php require 'template/footer.php'; ?>
    
  </body>
</html>