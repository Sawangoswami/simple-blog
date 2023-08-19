<?php include 'header.php'; ?>
    <div id="main-content">
        <div class="container">
            <div class="row">
                <div class="col-md-8">
                  <!-- post-container -->
                    <div class="post-container">
                        <div class="post-content single-post">
                            <?php 
                            include'config.php'; 
                            echo $conn
                             $sql = "SELECT * FROM post 
                     LEFT JOIN category ON post.category = category.category_id
                     LEFT JOIN user ON post.author = user.user_id
                     WHERE post_id = {$_GET['pid']}";
                             $result = mysqli_query($conn, $sql) or die("Query Failed");
                             if(mysqli_num_rows($result) > 0) {

                                if($row = mysqli_fetch_assoc($result)){
                             ?>
                            <h3><?php echo $row['title']; ?></h3>
                            <div class="post-information">
                                <span>
                                    <i class="fa fa-tags" aria-hidden="true"></i><a href='category.php?cid=<?php echo $row['category_id']; ?>'><?php echo $row['category_name']; ?> </a>
                                  
                                </span>
                                <span>
                                    <i class="fa fa-user" aria-hidden="true"></i>
                                    <a href='author.php?aid=<?php echo $row['user_id']; ?>'><?php echo $row['username']; ?></a>
                                </span>
                                <span>
                                    <i class="fa fa-calendar" aria-hidden="true"></i>
                                    <?php echo $row['post_date']; ?>
                                </span>
                            </div>
                            <a href="admin/upload/<?php echo $row['post_img']?>" data-lightbox="admin/upload/<?php echo $row['post_img']?>"  >
                            <img class="single-feature-image" src="admin/upload/<?php echo $row['post_img']?>"alt=""  ></a>
                            <p class="description">
                                <?php echo $row['description']; ?>
                            </p>

                        </div>
                    </div>
                 <?php
               }
           }
                 ?>
                    <!-- /post-container -->
                </div>
                <?php include 'sidebar.php'; ?>
            </div>
        </div>
    </div>
<?php include 'footer.php'; ?>
