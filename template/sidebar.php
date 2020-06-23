<!-- side bar starts here -->
<div class="col-md-4">
  <div class="card">
    <div class="card-body">
      <img src="images/index.gif" class="img-fluid">
      <div>
        <p>Contact:<br> <i class="fa fa-phone-alt"></i> 070452122000</p>
        <h5>For your advert placement at an affordable price, check terms & Conditions</h5>
        <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Quidem natus, nulla eveniet. Ad asperiores aspernatur ex sint, repellat voluptatem natus facere repudiandae molestiae? Maiores necessitatibus ex tempora iste ipsa dolorem.</p>
      </div>
    </div>
  </div>

  <div class="card mt-5 mb-5 text-white">
    <div class="card-header bg-info">
      <h5>Sign up for newsletter</h5>
    </div>
    <div class="card-body ">
      <form>
        <div class="input-group">
          <input type="email" placeholder="Email" name="email" class="form-control">
          <div class="input-group-append">
            <a type="submit" name="submit" class="btn btn-info btn-sm">Subscribe</a>
          </div>
        </div>
      </form>
    </div>
  </div>
  
  <!-- recent post starts here -->
  <div class="card mb-5">
    <div class="card-header bg-info text-white">
      <h5>Recent Posts</h5>
    </div>
    <div class="card-body">
  <?php 
    $sql = "SELECT * FROM posts ORDER BY id desc LIMIT 0,5";
    $connect = $db->query($sql);

    while ($row = $connect->fetch_assoc()) {
      $id = $row["id"];
      $title = htmlentities($row['title']);
      $date = htmlentities($row['date']);
      $author = htmlentities($row['author']);
      $post = htmlentities($row['post']);
      $image = htmlentities($row['image']);
   ?>
    
      <div class="media mt-3">
        <img src="upload/<?php echo $image ?>" class="" style="width: 70px; height: 60px">
        <div class="media-body ml-3">
          <h6><a href="fullPost.php?id=<?php echo $id ?>" style="color: grey" target = "_blank"><?php echo $title; ?></a></h6>
          <p class="text-secondary"><i class="fas fa-calendar "></i> <?php echo $date; ?></p>
        </div>
      </div>
      <hr>
  <?php } ?>
    </div>
  </div>
  <!-- recent post ends here -->

  <!-- category post starts here -->
  <div class="card mb-5">
    <div class="card-header bg-info text-white">
      <h5>Pupular category</h5></div>
    <div class="card-body">
      <?php 
        $sql = "SELECT id, title FROM category";
        $connect = $db->query($sql);

        if ($connect) {
          foreach ($connect as $row) {
            $id = $row['id'];
            $title = $row['title'];
            echo '<a href="blog.php?category='.$title.'" target="_blank" class="btn btn-primary btn-sm mr-1 mb-1 ">'.$title.'</a>';
          }
        }
       ?>
      
    </div>
  </div>
</div>
<!-- side bar ends here -->