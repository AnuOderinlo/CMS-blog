<?php 
  require 'template/nav.php'; 
  $_SESSION['trackingUrl'] = $_SERVER['PHP_SELF'];

  $categories = Category::find_all();
  
 ?>



   
      <div class="row bg-primary" style="height: 3.5px"></div>
      <div class="container text-white">
        <div class="row">
          <div class="col-md-12">
            <h1><span class="fas fa-edit" style="color: grey"></span>Manage Categories</h1>
          </div>
        </div>
      </div>      
    </header>

    <!-- Main Content -->
    <section class="container">
      <div class="row py-4">
        <div class=" col-md-6 mb-5">
          <div id="errorMsg"></div>
          <form action="category_processor.php" method="post" id="form">
            <div class="card text-white">
              <div class="card-header bg-secondary">
                <h3>Add New Category</h3>
              </div>
              <div class="card-body bg-dark">
                <div class="form-group">
                  <label class="form-check-label">Category Title: </label>
                  <input type="text" class="form-control" name="categoryTitle" placeholder="Type a category">
                </div>
                <div class="row">
                  <div class="col-6">
                    <a href="dashboard.php" class="btn btn-secondary btn-block"><i class="fas fa-arrow-left"></i> Back to Dashboard </a>
                  </div>
                  <div class="col-6">
                    <input type="hidden" name="submit">
                    <button type="submit" name="submit" class="btn btn-success btn-block"><i class="fas fa-check"></i> Publish</button>
                  </div>
                </div>
              </div>
            </div>
          </form>
        </div>
        <div class="table-responsive-md  col-md-6">
          <h2>Existing Categories</h2>
          <table class="table table-bordered table-sm table-hover">
            <!-- <caption>Unapproved Comments</caption> -->
            <thead class="thead-light align-center">
              <tr class="text-center">
                <th class="">No.</th>
                <th>Date&Time</th>
                <!-- <th>Category Name</th> -->
                <th>Creator Name</th>
                <th>Action</th>
              </tr>
            </thead>
            
            <?php 
              

              $sn = 0;
              foreach ($categories as $category) :
                $sn++;
            ?>
                
            
            <tr>
              <td class=""><?php echo $sn ?></td>
              <td><?php echo $category->date; ?></td>
              <td><?php echo $category->title?></td>
              <td class="text-center">
                <a href="#myModal" class="btn btn-sm btn-danger delete_link" data-id="<?php echo $category->id ?>" data-toggle="modal">Delete <i class=" far fa-trash-alt"></i> </a>
              </td>
              
            </tr>

          <?php endforeach;  ?> 
          </table>
          <!-- Modal -->
          <div id="myModal" class="modal fade" role="dialog">
            <div class="modal-dialog">
              <div class="modal-content">
                <!-- modal header goes here -->
                <div class="modal-header text-center">
                  <h4 class="modal-title">Are you sure you want to delete this category?</h4>
                  <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>
                
                <!-- modal footer goes here -->
                <div class="modal-footer justify-content-center">
                  <a href="" class="btn btn-danger comment_id">Yes</a>
                  <button type="button" class="btn btn-info" data-dismiss="modal">
                    Cancel
                  </button>
                </div>
              </div>
            </div>
          </div>

        </div>
      </div>
    </section>


    <script type="text/javascript">
      $(document).ready(function() {
        $("#form").on("submit", function (e) {
          e.preventDefault();
          // $(".errorMsg").hide();
          $.ajax({
            url:"category_processor.php",
            method:"POST",
            data:$("#form").serialize(),
            success:function(data){
              if (data == "Field can not be empty" || data == "Category name characters can not be less than 3") {
                $("#errorMsg").html(`<div  id="error" class="alert alert-danger ">${data}</div>`);
                // $("#form")[0].reset()
                console.log(data);
                // $("#errorMsg").show();
              }else{
                // console.log(typeof data);
                console.log(data);
                $("#errorMsg").html(`<div  id="error" class="alert alert-success">${data}</div>`);
                // console.log(data);
                $("#form")[0].reset()
                $("div#errorMsg").hide();
                window.location.reload();

              }
            }
          })
        })

        $(".delete_link").click(function () {
          var id = $(this).attr("data-id");
          var value = "deleteCategory.php?id=<?php ?>" + id
          $(".comment_id").attr("href", value)
            console.log(value);

        })
      

       
      })
      
    </script>

    <?php require 'template/footer.php'; ?>
    
  </body>
</html>