<header class="container-fluid bg-dark mb-3">
  <nav class="navbar navbar-dark navbar-expand-md ">
    <!-- Brand -->
    <a class="navbar-brand" href="blog.php">i<i class="font-weight-bold" style="color: red">Blog.com</i></a>
    
    <button class="navbar-toggler  navbar-light" data-toggle="collapse" data-target="#collapsibleNavbar">
      <span class="navbar-toggler-icon"></span>
    </button>

    <!-- Navbar links -->
    <div class="collapse navbar-collapse justify-content-between" id="collapsibleNavbar">
      <ul class="navbar-nav text-white">
        <li class="nav-item">
          <a class="nav-link" href="blog.php">Home</a>
        </li>
        <li class="nav-item"> 
          <a class="nav-link" href="#">About us</a>
        </li> 
        <li class="nav-item"> 
          <a class="nav-link" href="#">Blog</a>
        </li> 
        <li class="nav-item">
          <a class="nav-link" href="#">Contact Us</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="#">Features</a>
        </li>
      </ul>
      <ul class="navbar-nav mr-3 justify-content-center">
        <form class="form-inline" action="blog.php" method="GET">
          <div class="form-group">
            <input class="form-control" type="text" name="search" placeholder="search here">
            <button  name="submit" class="btn btn-info">Search</button>
          </div>
        </form>
      </ul>
      <ul class="navbar-nav">
        <li class="nav-item">
          <a href="register.php" class="nav-link text-success"><i class=" fas fa-sign-out-alt"></i>Become a Blogger</a>
        </li>
        <li class="nav-item">
          <a href="login.php" class="nav-link text-danger"><i class=" fas fa-sign-out-alt"></i>Sign in</a>
        </li>
        
      </ul>
    </div>
  </nav>
</header>