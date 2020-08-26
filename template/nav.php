<?php 

  $admin_id= $_SESSION["adminId"];
  $admin_status = $_SESSION["authority"];

 ?>



<nav class="navbar navbar-dark navbar-expand-md container ">
  <!-- Brand -->
  <a class="navbar-brand" href="blog.php">i<i class="font-weight-bold" style="color: red">Blog.com</i></a>
  
  <button class="navbar-toggler  navbar-light" data-toggle="collapse" data-target="#collapsibleNavbar">
    <span class="navbar-toggler-icon"></span>
  </button>


  <!-- Navbar links -->
  <div class="collapse navbar-collapse" id="collapsibleNavbar">
    <ul class="navbar-nav text-white mr-auto">
      <li class="nav-item">
        <a class="nav-link" href="myProfile.php">My profile</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="dashboard.php">Dashboard</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="post.php">Posts</a>
      </li> 
      <?php 
        if (check_super_admin()==$admin_status) {
        
       ?>
      <li class="nav-item">
        <a class="nav-link" href="categories.php">Categories</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="addAdmin.php">Manage Admins</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="comment.php">Comments</a>
      </li>
      <?php } ?>
      <li class="nav-item">
        <a class="nav-link" href="blog.php" target="_balnk">Live Blog</a>
      </li>
    </ul>
    <ul class="navbar-nav">
      <li class="nav-item">
        <a href="logout.php" class="nav-link text-danger"><i class=" fas fa-sign-out-alt"></i>Logout</a>
      </li>
    </ul>
  </div>
</nav>