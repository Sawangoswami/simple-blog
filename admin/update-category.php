<?php include "header.php";
 if(isset($_POST['submit'])){
  include'config.php';
  $cat_id = $_GET['cat_id'];
  $cat_name =mysqli_real_escape_string($conn,$_POST['cat_name']);
 
 echo $sql = "UPDATE category SET category_name = '{$cat_name}' WHERE category_id = {$cat_id}";
 $result = mysqli_query($conn, $sql) or die("Query Failed");
  
 if($result = 1){

 header("Location: http://localhost/blog-site/admin/category.php");
 }

}   
?>
<?php
include'config.php';
$cat_id = $_GET['cat_id'];
$sql = "SELECT * FROM category where category_id = {$cat_id}";
$result = mysqli_query($conn, $sql) or die("Query Faled");
?>
  <div id="admin-content">
      <div class="container">
          <div class="row">
              <div class="col-md-12">
                  <h1 class="adin-heading"> Update Category</h1>
              </div>
              <div class="col-md-offset-3 col-md-6">
                  <form action="<?php $_SERVER['PHP_SELF']?>" method ="POST">
                      <div class="form-group">
                          <input type="hidden" name="cat_id"  class="form-control" value="1" placeholder="">
                      </div>
                      <div class="form-group">
                <label for="exampleInputCategory">Category</label>
                <?php

                        if(mysqli_num_rows($result) > 0){
                          while($row = mysqli_fetch_assoc($result)){  ?>
                            <div class="form-group">
                          <label>Category Name</label>

                          <input type="text" name="cat_name" class="form-control" value="<?php echo $row['category_name']?>"  placeholder="" required>
                        <?php  }?>
                      </div>
                    </div>
                      
                     </select>
                 
                      
                      
                      <?php
                      }
                    
                  
                       ?>
                       <input type="submit" name="submit" class="btn btn-primary" value="Update" required />
                  </form>
                </div>
              </div>
            </div>
          </div>
<?php include "footer.php"; ?>
