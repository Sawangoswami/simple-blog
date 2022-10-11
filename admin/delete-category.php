<?php
include'config.php';
$cat_id = $_GET['cat_id'];
echo $sql = "DELETE FROM category WHERE category_id = {$cat_id} ";
echo $result = mysqli_query($conn, $sql) or die("query failed:1") ;

if($result){
	header("Location: http://localhost/blog-site/admin/category.php");
}else{ 
	echo "query failed" ;
}

?>