<?php include 'header.php'; ?>
    <div id="main-content">
      <div class="container">
        <div class="row">
            <div class="col-md-8">
                <!-- post-container -->
                <div class="post-container">
                    <?php  
                         if($_GET['search'] ==""){
                          //echo "<script type='text/javascript'> alert('empty search')</script>";
                          header('Location: http://localhost/blog-site/index.php');

                         }

                          if($_GET['search'] =="" || $_GET['search'][0] ==" " ){

                                echo "<h1> Search Can't Be Empty </h1>";
                                die();
                             }

                             
                             if(isset($_GET['search'])){
                                $search_term = mysqli_real_escape_string($conn, $_GET['search']);
                             }
                             
                            ?>
                  <h2 class="page-heading">Search : <?php echo $search_term; ?></h2>
                    <div class="post-content">
                        
                            <?php 
                            if(isset($_GET['search'])){
                              $search_term = mysqli_real_escape_string($conn, $_GET['search']);
                              include'config.php';
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
                     WHERE post.title LIKE '%{$search_term}%' OR  post.description LIKE  '%{$search_term}%'
                     LIMIT {$offset}, {$limit}";
                    

                    $result = mysqli_query($conn, $sql) or die ("Query Failed");
                    if(mysqli_num_rows($result) > 0 ){
                       
                  while($row = mysqli_fetch_assoc($result)){
                   {?>
                            <div class="row">
                            <div class="col-md-4">
                                <a class="post-img" href="single.php?pid=<?php echo $row['post_id']; ?>"><img src="admin/upload/<?php echo $row['post_img'];?>" alt=""/></a>
                            </div>
                            <div class="col-md-8">
                                <div class="inner-content clearfix">
                                    <h3><a href="single.php?pid=<?php echo $row['post_id']; ?>"><?php echo $row['title'];?> </a></h3>
                                    <div class="post-information">
                                        <span>
                                            <i class="fa fa-tags" aria-hidden="true"></i>
                                           <a href='category.php?cid=<?php echo $row['category_id']; ?>'><?php echo $row['category_name']; ?></a>
                                        </span>
                                        <span>
                                            <i class="fa fa-user" aria-hidden="true"></i>
                                            <a href="author.php?aid=<?php echo $row['user_id']; ?>"><?php echo  $row['username']; ?></a>
                                        </span>
                                        <span>
                                            <i class="fa fa-calendar" aria-hidden="true"></i>
                                            <?php echo $row['post_date']; ?>
                                        </span>
                                    </div>
                                    <p class="description">
                                         <?php echo substr( $row['description'],0,250)."..." ; ?>
                                    </p>
                                    <a class='read-more pull-right' href='single.php?pid=<?php echo $row['post_id']; ?>'>read more</a>
                                </div>
                            </div>
                        </div>

                       

                    
                   <?php

               }
           }
       }elseif($_GET['search'] == ""){ 
            echo "<h2> No Rocords Found </h2>";
        }
    }
                   ?>
               
           </div>

                    <?php 

                    if(isset($_GET['search'])){
                        $search_term = $_GET['search'];
                    $sql1 = "SELECT * FROM post 
                     LEFT JOIN category ON post.category = category.category_id
                     LEFT JOIN user ON post.author = user.user_id
                     WHERE post.title LIKE '%{$search_term}%'";
                     $result1 = mysqli_query($conn, $sql1) or die ("Query Failed");
                    $x = mysqli_num_rows($result1) ;
                   
                 $total_records = $x; 
               
                
                 $limit = 3;
                $total_page = ceil($total_records / $limit);
                echo " <div class = 'flexiblebox'>
                  <ul class='pagination admin-pagination'>";
                  if($page > 1){
                  echo '<li><a href = "search.php?search='.$search_term.'&page='.($page - 1).'">Prev</a></li>' ;
                }
                  for($i = 1; $i<= $total_page; $i++ ){
                    
                    if($i == $page ){
                      $active = "active";
                    }else{
                      $active = "";
                    }
                    echo '<li class = "'.$active .'"><a href="search.php?search='.$search_term.'&page='.$i.'">'.$i.'</a></li>';

                  
                  }

                 
                 if($total_page > $page  ){
                 echo '<li><a href = "serach.php?search='.$search_term.'&page='.($page + 1).'" >Next</a></li>';
               }
               echo "</div></ul>";
             
                 } ?>

                </div><!-- /post-container -->
            </div>
            <?php include 'sidebar.php'; ?>
        </div>
      </div>
    </div>
<?php include 'footer.php'; ?>
