<?php 
  require 'template/nav.php'; 
  // require 'edit_processor.php';

  $_SESSION['trackingUrl'] = $_SERVER['PHP_SELF'];
 ?>
      <div class="row bg-primary" style="height: 3.5px"></div>
      <div class="container text-white">
        <div class="row">
          <div class="col-md-12">
            <h1><span class="fas fa-edit" style="color: grey"></span>Edit post</h1>
          </div>
        </div>
      </div>      
    </header>

    <!-- Main Content -->
    <section class="container">
      <div class="row py-4">
        <div class="offset-md-1 col-md-10">
          <?php 
           

            $id = $_GET['id'];
            $post= Post::find_by_id($id)

          ?>
          <?php
           echo $session->error_message(); 
           echo $session->success_message(); 
          ?>
          <form action="edit_processor.php" method="post" enctype="multipart/form-data">
            <div class="card text-white">
              <div class="card-body bg-dark">
                <div class="form-group">
                  <label class="form-check-label">Post Title: </label>
                  <input type="hidden" name="id" value="<?php echo $post->id ?>">
                  <input type="text" class="form-control" name="postTitle" placeholder="Type a title" value="<?php echo $post->title ?>">
                </div>
                <div class="form-group">
                  <label for="select-category" class="text-primary">Existing category:</label> <?php echo $post->category; ?><br>
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
                <div class="mb-2">
                  <span class="text-primary">Existing image:</span>
                  <img style="width: 120px; height: 62px;" src="upload/<?php echo $post->image ?>">
                </div>
                <span class="text-danger">Image size must be less than 2MB</span>
                <div class="custom-file mb-2">
                  <input type="file" name="image" class="custom-file-input" id="customFile">
                  <label class="custom-file-label" for="customFile">Choose image</label>
                </div>
                <div class="form-group purple-border">
                  <label for="post">Post</label>
                  <textarea name="postContent" class="form-control" id="post" rows="7"><?php echo $post->post; ?></textarea>
                </div>
                <div class="row">
                  <div class="col-6">
                    <a href="dashboard.php" class="btn btn-secondary btn-block"><i class="fas fa-arrow-left"></i> Back to Dashboard </a>
                  </div>
                  <div class="col-6">
                    <button type="submit" name="submit" class="btn btn-success btn-block"><i class="fas fa-check"></i> Publish</button>
                  </div>
                </div>
              </div>
            </div>
          </form>
        </div>
      </div>
    </section>

    <?php require 'template/footer.php'; ?>
    
  </body>
</html>