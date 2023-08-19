

<?php session_start(); ?>
<?php include 'header.php'; ?>
    <div id="main-content">
        <div class="container">
            <div class="row row_index">
                <div class="col-md-8">
                <h2 class="page-heading">Home</h2>
                <!-- post-container -->
                <div class="post-container">
                     <?php  include_once "config.php";

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

                    $result = mysqli_query($conn, $sql) or die ("Query Failed");
                    if(mysqli_num_rows($result) > 0 )
                       

                   {?>
                  
                    <div class="post-content">
                     
                     <?php
                                while($row = mysqli_fetch_assoc($result)){
                                ?>
                        <div class="row">

                            <div class="col-md-4 ">
                                 
                                <a class="post-img" href="single.php?pid=<?php echo $row['post_id']; ?>"><img src="admin/upload/<?php echo $row['post_img'];?>" alt="" loading="lazy"></a>
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
                        <hr class="colorhr">

                        
                    
                       
                    <?php
                       }

                   }else{

                    echo "<h1> NO Records Found </h2>";
                   }
                    ?>
                </div>
                    
                  <?php 
                  $sql1 = "SELECT * FROM post";
                 $result = mysqli_query($conn, $sql1);
                 $x = mysqli_num_rows($result) ;
               
          
               $total_records = $x; 
               
                
                 $limit = 3;
                $total_page = ceil($total_records / $limit);
                  echo "
                  <div class ='flexiblebox'>
                  <ul class='pagination admin-pagination'>
                 ";
                  if($page > 1){
                  echo '<li><a href = "index.php?page='.($page - 1).'">Prev</a></li>' ;
                }
                  for($i = 1; $i<= $total_page; $i++ ){
                    
                    if($i == $page ){
                      $active = "active";
                    }else{
                      $active = "";
                    }
                    echo '<li class = "'.$active .'"><a href="index.php?page='.$i.'">'.$i.'</a></li>';

                  
                  }

                 
                 if($total_page > $page  ){
                 echo '<li><a href = "index.php?page='.($page + 1).'" >Next</a></li>';
               }
               echo " </div></ul>";
             
                  ?>
               </div>
               </div>  
           

                <?php include 'sidebar.php'; ?>
            </div>
            </div>
        </div>
        <div class="container">
            <div class="row">
                <div class="col-lg-8">
     <?php
$cmtx_identifier = '1';
$cmtx_reference  = 'Comments';
$cmtx_folder     = '/blog-site/commentics-master/comments/';
require($_SERVER['DOCUMENT_ROOT'] . $cmtx_folder . 'frontend/index.php');
?>
</div>
<div class="col-lg-4 form-pd">
    <h3 > Any Sugestion </h3>
    <hr class="colorhr">
   <form class="Sugestion" method="post" action="form.php">
    Email: <input name="email" type="text"><br><br>
    Subject: <input name="subject" type="text"><br><br>
    Message: <br><br>
    <textarea name="message" id="" cols="40" rows="15"></textarea>
    <input name="esubmit" type="submit"> 
    </form>

</div>
    </div>
</div>

<?php include 'footer.php'; ?>
