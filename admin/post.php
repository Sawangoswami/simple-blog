<?php include "header.php"; ?>
<?php

    
 if(!isset($_SESSION['username'])){
      header("Location: http://localhost/blog-site/admin/");
  }
    
?>
  <div id="admin-content">
      <div class="container">
          <div class="row">
              <div class="col-md-10">
                  <h1 class="admin-heading">All Posts</h1>
              </div>
              <div class="col-md-2">
                  <a class="add-new" href="add-post.php">add post</a>
              </div>
              <div class="col-md-12 ">
                  <table class="content-table ">
                     <?php 
                     if($_SESSION['user_role'] == 1){ 
                    include "config.php";
                    $limit = 3;
                    if(isset($_GET['page'])){
                      $page = $_GET['page'];
                    }else{
                      $page = 1;
                    }
                    $offset = ($page - 1)*$limit;
                    $sql = "SELECT * FROM post 
                     LEFT JOIN category ON post.category = category.category_id
                     LEFT JOIN user ON post.author = user.user_id ORDER BY post.post_id DESC
                     
                     LIMIT {$offset}, {$limit}";
                   }else{
                      include "config.php";
                        $limit = 3;
                      if(isset($_GET['page'])){
                      $page = $_GET['page'];
                    }else{
                      $page = 1;
                    }
                    $offset = ($page - 1)*$limit;
                  $sql = "SELECT * FROM post 
                     LEFT JOIN category ON post.category = category.category_id
                     LEFT JOIN user ON post.author = user.user_id
                     WHERE author = '{$_SESSION['user_id']}'
                     LIMIT {$offset}, {$limit}";
                   }
                     
                   
                    $result = mysqli_query($conn, $sql) or die ("Query Failed");
                    if(mysqli_num_rows($result) > 0 )
                       
                   {?>
                      <thead>
                          <th>S.No.</th>
                          <th>Title</th>
                          <th>Category</th>
                          <th>Date</th>
                          <th>Author</th>
                          <th>Edit</th>
                          <th>Delete</th>
                      </thead>
                      <?php while ($rows = mysqli_fetch_assoc($result)) {
                        
                           
                        ?>
                      <tbody>
                          <tr>
                            <?php
                            $serial = $offset + 1;
                            
                            ?>
                             
                              <td class='id'><?php echo $serial?></td>
                              <td><?php echo $rows['title'];?></td>
                              <td><?php echo $rows['category_name'];?></td>
                              <td><?php echo $rows['post_date'];?></td>
                              <td><?php echo $rows['username'];?></td>
                              <td class='edit'><a href='update-post.php?id=<?php echo $rows["post_id"]?>&cat_id=<?php echo $rows['category'] ;?>&user_id=<?php echo $rows['user_id'] ;?>'><i class='fa fa-edit'></i></a></td>
                              <td class='delete'><a href='delete-post.php?id=<?php echo $rows["post_id"]?>&cat_id=<?php echo $rows['category']; ?>'><i class='fa fa-trash-o'></i></a></td>

                          </tr>
                         </tbody>
                         <?php $offset++ ?>
                           <?php  
                     }

                    }?>
                  </table>
                  <?php
                  if($_SESSION['user_role'] == 1){
                  $sql1 = "SELECT * FROM post
                  ";
                }else{
                    $sql1 = "SELECT * FROM post WHERE author = '{$_SESSION['user_id']}'";
                  }
                 $result1 = mysqli_query($conn, $sql1) or die("Query Failed");
                 if(mysqli_Num_rows($result1) > 0){
                 
                  $total_records = mysqli_num_rows($result1);
                  $total_page = ceil($total_records/$limit);
                  echo "<ul class='pagination admin-pagination'>";
                  if($page > 1){
                    echo "<li><a href = 'post.php?page=".($page - 1)."'>Prev</a></li" ;
                }
                for($i = 1; $i <= $total_page; $i++ ){
                  if($i == $page){
                    $active = "active";
                  }else{
                    $active = "";
                  }
                  echo '<li class = "'.$active.'"><a href ="post.php?page='.$i.'">'.$i.'</a></li>' ;
                  }
                   if($total_page > $page  ){
                 echo "<li><a href = 'post.php?page=".($page + 1)."' >Next</a></li";
               }

                }    echo "</ul>";
                  ?>
              </div>
          </div>
      </div>
  </div>
<?php include "footer.php"; ?>
