<?php 
  // require_once 'include/session.php';
  require_once 'include/functions.php';
  require_once 'include/config.php';
  // require_once 'fullPost.php';

  if (isset($_POST["getData"])) {
    $start =sanitizeString($_POST["start"]);
    $limit =sanitizeString($_POST["limit"]);
    $getData =sanitizeString($_POST["getData"]);
    $id =sanitizeString($_POST["id"]);

    $sql = "SELECT * FROM comments WHERE post_id='$id' ORDER BY id asc LIMIT $start,$limit";
    // $sql = "SELECT * FROM comments WHERE post_id='$idUrl' ORDER BY id asc";
    $connect = $db->query($sql);
    If(!$connect) exit("sorry something went wrong");
    $num = $connect->num_rows;
    for ($i=0; $i < $num ; $i++) { 
      $row = $connect->fetch_assoc();
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
  


  



  // if ($connect) {
 /* while ($row = $connect->fetch_assoc()) {
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
  }*/

 

 ?>


