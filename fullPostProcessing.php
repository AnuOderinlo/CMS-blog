<?php 
  require_once 'include/session1.php';
  require_once 'include/functions.php';
  require_once 'include/config.php';
  // echo "Its working";
  // if (isset($_POST["submit"])) {
  //   echo $_POST["commentName"]."<br>";
  //   echo $_POST["commentEmail"]."<br>";
  //   echo $_POST["commentText"]."<br>";
  // }else{
  //   echo "Not set";
  // }
  

if (isset($_POST["submit"])) {

    date_default_timezone_set("Africa/Lagos");
    $idUrl = $_POST['id'];
    $today = date("d/M/Y h:ia", time());
    $commentName = sanitizeString($_POST["commentName"]);
    $commentEmail = sanitizeString($_POST["commentEmail"]);
    $commentText = sanitizeString($_POST['commentText']);
    // var_dump($_FILES);
      // var_dump($commentName);
    if (empty($commentName) || empty($commentEmail) || empty($commentText)  ) {
      $_SESSION["errorMessage"] = "Field can't be empty";
      echo errorMessage();
      // Redirect("fullPost.php?id=$idUrl");
    }elseif (strlen($commentText) > 499) {
      // echo "Maximum characters reach(500 characters)";
      $_SESSION["errorMessage"] = "Maximum characters reach(500 characters)";
      echo errorMessage();
      // Redirect("fullPost.php?id=$idUrl");
    }elseif (!validator($commentEmail)) {
      $_SESSION["errorMessage"] = "Invalid Email";
      // echo "Invalid Email";
      echo errorMessage();
      // Redirect("fullPost.php?id=$idUrl");
    }else{
      // echo "successful";
      $sql = "INSERT INTO comments (post_id, date, name, email, comment) VALUES (?,?,?,?,?)";
      $connect = $db->prepare($sql);
      $connect->bind_param("issss", $idUrl, $today, $commentName, $commentEmail, $commentText);
      $connect = $connect->execute();
      echo<<<END
        <div class="media border mt-3 p-3 mb-2">
          <div class="row">
            <div class="col-12 col-md-3">
              <img src="images/myAvatar.png" class="rounded-circle img-fluid img-25">
            </div>
            <div class="col-12 col-md-9">
              <div class="media-body ">
                <h4>$commentName</h4>
                <small>Posted on $today</small>
                <p class="">$commentText</p>
              </div>
            </div>
          </div>
        </div>
      END;

      


    }
  }


 ?>