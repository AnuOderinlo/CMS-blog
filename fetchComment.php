<?php 

  require_once 'classes/init.php';

  if (isset($_POST["getData"])) {
    $start = $validator->sanitize_string($_POST["start"]);
    $limit = $validator->sanitize_string($_POST["limit"]);
    $getData = $validator->sanitize_string($_POST["getData"]);
    $id = $validator->sanitize_string($_POST["id"]);


    $result = $comment->find_comments_limit($start, $limit, $id);
  
    $num = $result->num_rows;
    If(!$result) exit("sorry something went wrong");
 
    for ($i=0; $i < $num ; $i++) { 
      $row = $result->fetch_assoc();
      $nameCommenter = $row['name'];
      $comment = $row['comment'];
      $date = $row['date'];

      echo<<<END
        <div class="media border mt-3 p-3 mb-2">
          <div class="row">
            <div class="col-12 col-md-3">
              <img src="images/myAvatar.png" class="rounded-circle img-fluid img-25">
            </div>
            <div class="col-12 col-md-9">
              <div class="media-body ">
                <h4>$nameCommenter</h4>
                <small>Posted on $date</small>
                <p class="">$comment</p>
              </div>
            </div>
          </div>
        </div>
      END;
    }
  }
  
 

 ?>


