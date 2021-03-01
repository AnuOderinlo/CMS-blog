<?php 
  require_once "classes/init.php";
 /* require_once 'include/session1.php';
  require_once 'include/functions.php';
  require_once 'include/config.php';
*/

if (isset($_POST["submit"])) {

    date_default_timezone_set("Africa/Lagos");
    $post_id = $validator->sanitize_string($_POST['id']);

    $today = date("d/M/Y h:ia", time());
    $commentName = $validator->sanitize_string($_POST["commentName"]);
    $commentEmail = $validator->sanitize_string($_POST["commentEmail"]);
    $commentText = $validator->sanitize_string($_POST['commentText']);
    if (empty($commentName) || empty($commentEmail) || empty($commentText)  ) {
      echo "Field can't be empty";
    
    }elseif (strlen($commentText) > 499) {
      // $session->message("Maximum characters reach(500 characters)");
      echo "Maximum characters reach(500 characters)";
      // echo $message;
    }elseif (!$validator->email_validator($commentEmail)) {
      // $session->message("Invalid Email");
      echo "Invalid Email";
      // echo $message;
     
    }else{
     
      $comment->create_comment($post_id, $today, $commentName, $commentEmail, $commentText);
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