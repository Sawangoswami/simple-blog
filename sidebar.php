<div id="sidebar" class="col-md-4">
    <!-- search box -->
    <div class="search-box-container">
        <h4>Search</h4>
        <form class="search-post" action="search.php" method ="GET">
            <div class="input-group">
                <input type="text" name="search" class="form-control" placeholder="Search .....">
                <span class="input-group-btn">
                    <button type="submit" class="btn btn-danger">Search</button>
                </span>
            </div>
        </form>
    </div>
    <!-- /search box -->
    <!-- recent posts box -->
    <div class="recent-post-container">
        <h4>RECENT POST</h4>
        <?php 
        error_reporting(E_ALL);
        ini_set('display_errors', '1');
        echo 787;
       // include 'config.php';
        $conn =  mysqli_connect("localhost", "u586058589_skool", "Sawangoswami@9", "u586058589_skool") or die("Connection Failed:".mysqli_connecton_error()) ;
        var_dump($conn, 123);
        $limit = 3;
        $offset = 0;
       $sql = "SELECT * FROM post 
       LEFT JOIN category ON post.category = category.category_id
       LEFT JOIN user ON post.author = user.user_id
       ORDER BY Post.post_id DESC LIMIT  {$offset}, {$limit}";
       $result = mysqli_query($conn, $sql) or die("query failed");
       if(mysqli_num_rows($result) > 0){
       
       while($row = mysqli_fetch_assoc($result))  {?>
        <div class="recent-post">
            <a class="post-img" href="single.php?pid=<?php echo $row['post_id']; ?>">
                <img src="admin/upload/<?php echo $row['post_img'];?>"alt="" loading="lazy">
            </a>
            <div class="post-content">
                <h5><a href="single.php?pid=<?php echo $row['post_id'];?>"><?php echo $row['title'];?></a></h5>
                <span>
                    <i class="fa fa-tags" aria-hidden="true"></i>
                    <a href='category.php?<?php echo $row['category_id'];?>'><?php echo $row['category_name'];?></a>
                </span>
                <span>
                    <i class="fa fa-calendar" aria-hidden="true"></i>
                    <?php echo $row['post_date'];?>
                </span>
                <a class="read-more" href="single.php?pid=<?php echo $row['post_id'];?>">read more</a>
            </div>
        </div>
        <?php
    }
}
        ?>



        
    </div>
    <!-- /recent posts box -->

    
</div>
