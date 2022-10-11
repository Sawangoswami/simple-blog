<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
        <title>ADMIN Panel</title>
        <!-- Bootstrap -->
        <link rel="stylesheet" href="../css/bootstrap.min.css" />
        <!-- Font Awesome Icon -->
        <link rel="stylesheet" href="../css/font-awesome.css">
        <!-- Custom stlylesheet -->
        <link rel="stylesheet" href="../css/style.css">
        <style>
            
        </style>
    </head>
    <body>
        <!-- HEADER -->
        <div id="header-admin">
            <!-- container -->
            <div class="container">
                <!-- row -->
                <div class="row rowflex">
                    <!-- LOGO -->
                    <div class = "col-lg-8 col-md-4">
                        <h1 href="post.php" class='logo'>My Blog</h1>
                    </div>
                    <!-- /LOGO -->
                      <!-- LOGO-Out -->
                      <?php session_start();?>
                    <div class="col-lg-4 col-md-4">
                        <p class="admin-logout"> You Login As <?php echo $_SESSION['username'] ;?></p><br>
                        <a href="logout.php" class="admin-logout" >logout</a>
                    </div>
                    <!-- /LOGO-Out -->
                </div>
            </div>
        </div>
        <!-- /HEADER -->
        <!-- Menu Bar -->
        <div id="admin-menubar">
            <div class="container">
                <div class="row">
                    <div class="col-md-12">
                       <ul class="admin-menu">
                            <li ><?php if($_SESSION['user_role']==1){
                                echo "<a id='user' href='users.php'>User</a>";
                                }?>
                            </li>
                            <li><?php if($_SESSION['user_role']==1){
                                echo '<a href="category.php">Category</a>';
                            }?>
                            </li>
                            <li>
                                <a href="post.php">Post</a>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
        
        <!-- /Menu Bar -->
