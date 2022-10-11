<?php include "header.php"; ?>

<?php 
if(isset($_POST['submit'])){
include "config.php";
$user_id = $_GET['id'];
$fname = mysqli_real_escape_string($conn,$_POST['fname']);
$lname = mysqli_real_escape_string($conn,$_POST['lname']);
$user = mysqli_real_escape_string($conn,$_POST['user']);
$role = mysqli_real_escape_string($conn,$_POST['role']);

$sql1 = "UPDATE user SET first_name ='{$fname}', last_name = '{$lname}', username ='{$user}', role = {$role} WHERE user_id = {$user_id} ";
$result1 = mysqli_query($conn, $sql1) or die("Query Failed") ;

if($result1 = 1){
  header("Location: http://localhost/blog-site/admin/users.php");
}

}
?>
  <div id="admin-content">
      <div class="container">
          <div class="row">
              <div class="col-md-12">
                  <h1 class="admin-heading">Modify User Details</h1>
              </div>
              <div class="col-md-offset-4 col-md-4">

                
                        <?php
                
                 include"config.php" ;
                 $user_id = $_GET['id'];
                 $sql = "SELECT * FROM user WHERE user_id  = '{$user_id}'";
                 $result = mysqli_query($conn, $sql);
                 if(mysqli_num_rows($result) > 0){
                  while($rows = mysqli_fetch_assoc($result)){
                 ?>         <!-- Form Start -->
                  <form  action="<?php  $_SERVER['PHP_SELF'] ?>" method ="POST">
                      <div class="form-group">

                          <input type="hidden" name="user_id"  class="form-control" value="<?php echo $rows['user_id'] ?>"placeholder="" >
                      </div>
                          <div class="form-group">
                          <label>First Name</label>
                          <input type="text" name="fname" class="form-control" value="<?php echo $rows['first_name'] ?>" placeholder="" required>
                      </div>
                      <div class="form-group">
                          <label>Last Name</label>
                          <input type="text" name="lname" class="form-control" value="<?php echo $rows['last_name'] ?>" placeholder="" required>
                      </div>
                      <div class="form-group">
                          <label>User Name</label>
                          <input type="text" name="user" class="form-control" value="<?php echo $rows['username'] ?>" placeholder="" required>
                      </div>
                      <div class="form-group">
                          <label>User Role</label>
                          <select class="form-control" name="role" value="<?php echo $rows['role']; ?>">
                             <?php      
                             if($rows['role'] == 0){
                              echo "<option selected value='0' >Normal User</option>
                              <option value='1' >Admin</option>";
                            }else{  
                              echo  "<option  value='1' selected>Admin</option>
                              <option value='0'>Normal User</option>";
                            }
                            ?>
                          </select>
                      </div>
                      <input type="submit" name="submit" class="btn btn-primary" value="Update" required />
                  </form>
                  <?php 
                }
              }
                ?>
                  <!-- /Form -->
              </div>
          </div>
      </div>
  </div>
<?php include "footer.php"; ?>
