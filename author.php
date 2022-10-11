<?php include 'header.php'; ?>
    <div id="main-content">
      <div class="container">
        <div class="row">
            <div class="col-md-8">
                <!-- post-container -->
                <div class="post-container">

                    <?php
                    include'config.php';
                    $aid = $_GET['aid'];
                    $sql2 ="SELECT * FROM user WHERE user_id = {$aid}";
                    $result2 = mysqli_query($conn, $sql2) or die("Query0 Filed");
                    if(mysqli_num_rows($result2) > 0){
                        while($row3 = mysqli_fetch_assoc($result2)){
                            echo "<h2 class='page-heading'> {$row3['username']}</h2>";
                   }
               }?>
                   <?php  include "config.php";
                    $limit = 3;
                    if(isset($_GET['page'])){
                    $page = $_GET['page'];
                    }else{
                    $page = 1;
                    }
                    $aid = $_GET['aid'];
                    $offset = ($page - 1)*$limit;
                    $sql = "SELECT * FROM post 
                     LEFT JOIN category ON post.category = category.category_id
                     LEFT JOIN user ON post.author = user.user_id
                     WHERE author = {$_GET['aid']}
                    
                     LIMIT {$offset}, {$limit}";

                $result = mysqli_query($conn, $sql) or die ("Query Failed");
                
               

                if(mysqli_num_rows($result) > 0 ) {
                        
                while($row = mysqli_fetch_assoc($result))  {  
                             
                            ?>
                            <div class="post-content">
                        <div class="row">
                            <div class="col-md-4">
                                <a class="post-img" href="single.php?pid=<?php echo $row['post_id']; ?>"><img src="admin/upload/<?php echo $row['post_img']; ?>" alt=""></a>
                            </div>
                            <div class="col-md-8">
                                <div class="inner-content clearfix">
                                    <h3><a href='single.php'></a></h3>
                                    <div class="post-information">
                                        <span>
                                            <i class="fa fa-tags" aria-hidden="true"></i>
                                            <a href='category.php?cid=<?php echo $row['category_id']; ?>'><?php echo $row['category_name']; ?></a>
                                        </span>
                                        <span>
                                            <i class="fa fa-user" aria-hidden="true"></i>
                                            <a href="author.php?aid=<?php echo $row['user_id']; ?>"><?php echo $row['username']; ?></a>
                                        </span>
                                        <span>
                                            <i class="fa fa-calendar" aria-hidden="true"></i>
                                            <?php echo $row['post_date'];?>
                                        </span>
                                    </div>
                                    <p class="description">
                                       <?php echo $row['description'];?>
                                    </p>
                                    <a class='read-more pull-right' href='single.php?pid=<?php echo $row['post_id']; ?>'>read more</a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <?php 
                    }
        } 
    
                     ?>
                    
                  <?php 
                   include'config.php';
                 
                 $sql1 = "SELECT *  FROM post WHERE author = {$aid}";
                 $result1 = mysqli_query($conn, $sql1) or die("Query2 Failed");
                 $row1 = mysqli_fetch_assoc($result1);
              if(mysqli_num_rows($result1) > 0){

             $total_records = mysqli_num_rows($result1);
                
                 $limit = 3;
                $total_page = ceil($total_records / $limit);
                  echo "<ul class='pagination admin-pagination'>";
                  if($page > 1){
                  echo '<li><a href = "author.php?aid='.$aid.'&page='.($page - 1).'">Prev</a></li>' ;
                }
                  for($i = 1; $i<= $total_page; $i++ ){
                    
                    if($i == $page ){
                      $active = "active";
                    }else{
                      $active = "";
                    }
                    echo '<li class = "'.$active .'"><a href="author.php?aid='.$aid.'&page='.$i.'">'.$i.'</a></li>';

                  
                  }

                 }
                 if($total_page > $page  ){
                 echo '<li><a href = "author.php?aid='.$aid.'&page='.($page + 1).'" >Next</a></li>';
               }
               echo "</ul>";
             
                  ?>
                </div><!-- /post-container -->
            </div>
            <?php include 'sidebar.php'; ?>
        </div>
      </div>
    </div>
<?php include 'footer.php'; ?>

