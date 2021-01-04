<?php 
  // require_once 'include/session.php';
  // require_once 'include/functions.php';
  // require_once 'include/config.php';

 require 'template/header.php';
  $post = new Post();

  $page = !empty($_GET['page'])? $_GET['page']: 1;
  $items_per_page = 4;
  $total_items = Post::count_all(); 

  $paginate = new Paginate($page, $items_per_page, $total_items );
  $sql = "SELECT * FROM posts ORDER BY id desc LIMIT {$items_per_page} OFFSET {$paginate->offset()}";
  $posts = Post::find_this_query($sql);
  
  


 ?>

    <!-- Main Content -->
    <section class="container">
      <div class="row">
        <div class="col-md-8">
          <!-- <h1>The complete Responsive CMS blog</h1> -->
          <!-- <h1 class="lead">The complete Blog by using PHP by Anuoluwapo Oderinlo</h1> -->
          <?php 
             /* echo errorMessage(); 
              echo successMessage(); */
          ?>
          <?php 
            // search query
            if (isset($_GET['submit'])) {
              $searchInput = "%".$_GET['search']."%";
              $posts=$post->post_by_search($searchInput);
              
            /* category query;*/
            }elseif (isset($_GET['category'])) {
              $category = $_GET['category'];
              $posts=$post->post_by_category($category);
              if (!$posts) {
                Redirect("blog.php");
              }
            }
            /*default sql*/
            else{
              
              
              // $result= $post->post_by_default();
              // Redirect('blog.php?page=1');
            }
             // $results=$post->post_by_default();
             foreach ($posts as $post) :
                // $post->image = $result->image;
              // var_dump($result);

                // echo $result->post;

            // while ($row = $result->fetch_assoc()) {
            //   $id = $row["id"];
            //   $title = htmlentities($row['title']);
            //   $date = htmlentities($row['date']);
            //   $author = htmlentities($row['author']);
            //   $post = htmlentities($row['post']);
            //   $image = htmlentities($row['image']);
          ?>
          <div class="card mb-1">
            <img src="<?php echo $post->picture_path();?>" class="img-fluid card-img-top" style="max-height: 350px">
            <div class="card-body">
              <h2 class="card-title"><?php echo $post->title ?></h2>
              <small class="text-muted" >Written by <a href="profile.php?author=<?php echo base64_encode($post->author) ?>"><?php echo $post->author; ?></a> <?php echo " on ".$post->date; ?></small>
              <!-- <span class="badge badge-info" style="float: right">comment <?php ($id) ?></span> -->
              <hr>
              <p class="card-text">
                <?php 
                  if (strlen($post->post) > 120) {
                    
                    echo substr($post->post, 0, 119)."..." ;
                  }else{
                    echo $post->post;
                  }

               ?>
                  
              </p>
              <a href="fullPost.php?id=<?php echo $post->id ?>"target="_blank" style="float: right;" class="btn btn-primary">read more</a>
            </div>
          </div>
        <?php 
          endforeach;
        ?>
          <!-- pagination -->
          <nav class="mt-5">
            <ul class="pagination pagination-md">
              <?php 
                if ($paginate->total_page() > 1) {
                  if ($paginate->has_previous()) {
                    echo "<li class='page-item'><a class='page-link' href='blog.php?page={$paginate->previous()}'><<</a> </li>" ;
                  }
                
                  for ($i=1; $i <= $paginate->total_page() ; $i++) { 
                    if ($i == $page) {
                      echo "<li class='page-item active'><a class='page-link' href='blog.php?page=$i''>$i</a></li>";
                    }else{
                      echo "<li class='page-item'><a class='page-link' href='blog.php?page=$i''>$i</a></li>";

                    }
                  }
                  if ($paginate->has_next()) {
                    echo "<li class='next'><a class='page-link' href='blog.php?page={$paginate->next()}'>>></a> </li>" ;
                  }

                  
                  
                }
               ?>


             <!--  -->

            </ul>
          </nav>
        </div>

        <!-- sidebar starts here -->
        <?php require 'template/sidebar.php'; ?>
      </div>


    </section>

    <?php require 'template/footer.php'; ?>
    
  </body>
</html>