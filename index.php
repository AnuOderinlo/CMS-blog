<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" type="text/css" href="css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="css/style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

    <title>CMS|project</title>
  </head>
  <body>
    <header class="container-fluid bg-dark">
      <nav class="navbar navbar-dark navbar-expand-md container ">
        <!-- Brand -->
        <a class="navbar-brand" href="#">Logo</a>
        
        <button class="navbar-toggler  navbar-light" data-toggle="collapse" data-target="#collapsibleNavbar">
          <span class="navbar-toggler-icon"></span>
        </button>
   

        <!-- Navbar links -->
        <div class="collapse navbar-collapse" id="collapsibleNavbar">
          <ul class="navbar-nav text-white mr-auto">
            <li class="nav-item">
              <a class="nav-link" href="profile.php">My profile</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="dasboard.php">Dashboard</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="post.php">Posts</a>
            </li> 
            <li class="nav-item">
              <a class="nav-link" href="category.php">Categories</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="admin.php">Manage Admins</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="comment.php">Comments</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="blog.php">Live Blog</a>
            </li>
          </ul>
          <ul class="navbar-nav">
            <li class="nav-item">
              <a href="#" class="nav-link text-white">Logout</a>
            </li>
          </ul>
        </div>
        

        <!-- <div class="collapse navbar-collapse justify-content-end" id="collapsibleNavbar">
          <ul class="navbar-nav text-dark">
            <li class="nav-item">
              <a class="nav-link" href="#"><span class=" fa fa-cart-arrow-down"></span></a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="#">Your Dashboard</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="#">Join as a maker</a>
            </li> 
          </ul>
        </div>  -->
        
      </nav>
      
    </header>
    <h1>Main Content</h1>
    <?php require 'template/footer.php'; ?>
    
  </body>
</html>