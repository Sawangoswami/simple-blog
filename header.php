<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <?php 
    
    if(isset($_GET['cid'])){
     include'config.php';
     $sql5 = "SELECT * FROM category WHERE category_id = {$_GET['cid']}";
     $result5 = mysqli_query($conn,$sql5) or die("Query Failed");
     if(mysqli_num_rows($result5) > 0){
        while($row5 = mysqli_fetch_assoc($result5)){
       echo "<title>{$row5['category_name']}</title>";
     }
 }
}else{
    echo "<title>News</title";
}
    ?>
   <!-- Bootstrap -->
    
    <!-- Font Awesome Icon -->
    <link rel="stylesheet" href="css/font-awesome.css">
    <!-- Custom stlylesheet -->
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="css/bootstrap.min.css" >
    <link href="light_box/css/lightbox.min.css" rel="stylesheet" >
</head>
<body>
<!-- HEADER -->
<div class="">
<div id="header" class="">
    <!-- container -->
    <div class="container">
        <!-- row -->
        <div class="row">
            <!-- LOGO -->
            <div class=" col-md-offset-4 col-md-4">
                <h1 id="logo"> Blog</h1>
            </div>
            <!-- /LOGO -->
        </div>
    </div>
</div>
<!-- /HEADER -->
<!-- Menu Bar -->
<div id="menu-bar">
    <div class="tst">
      
        <div class="">
            <div class="">
              <?php 
              
               include'config.php';
               $sql = "SELECT * FROM category WHERE post > 0";
               $result = mysqli_query($conn, $sql) or die("Query Failed");

                if(mysqli_num_rows($result) > 0){
                     echo '
                     <nav class="navbar navbar-default navber">
  <div class="d-flex ">
    <!-- Brand and toggle get grouped for better mobile display -->
    <div class="navbar-header">
      <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
        <span class="sr-only">Toggle navigation</span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
      </button>
      
    </div>
                     <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
      <ul class="nav navbar-nav">';
     // <li><a class = "{$active}" id = "class"  href="index.php">Home</a></li>';
                    if(!isset($_GET['cid']) && !isset($_GET['pid']) ){
                $active = "active";
               }
          else{
                         $active = "";
                     }
                     echo "<li><a class ='{$active}' id = 'class'  href='index.php'>Home</a></li>";
                    
                    while($row = mysqli_fetch_assoc($result)){
                        if(isset($_GET['cid'])){
                            if($_GET['cid'] == $row['category_id'] ){
                                $active  = "active";
                            }else{
                           $active = "";
                            }
                        }else{$active = "";}

                  echo "<li><a class ='{$active}' href='category.php?cid={$row['category_id']}'>{$row['category_name']}</a></li>";
              }

               
                  echo "</ul>";

              }
          ?>
            </div>
        </div>
    </div>
</div>
</div>
</div>

<?php

 // $url = "{$_SERVER['HTTP_HOST']}{$_SERVER['REQUEST_URI']}";
 //     if($url){
 //    header('Location: http://localhost/blog-site/index.php');
 //     }
?>




<!-- /Menu Bar -->
