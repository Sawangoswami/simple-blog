<?php
include 'config.php';
$post_id = $_GET['id'];
$cat_id = $_GET['cat_id'];
$sql = "SELECT * FROM post WHERE post_id ={$post_id}";
$result1 = mysqli_query($conn, $sql) or die("query failed");
$row = mysqli_fetch_assoc($result1);

if($row['post_img']){
unlink("upload/".$row['post_img']);
}

 $sql = "DELETE FROM post WHERE post_id = {$post_id};";
$sql .= "UPDATE category SET post = post - 1
WHERE category_id = {$cat_id}";

$result = mysqli_multi_query($conn, $sql) or die ("Query Failed");
if($result = 1){
	header("Location: http://localhost/blog-site/admin/post.php");
}else{

	echo "Query Failed";
}
mysqli_close($conn)

?>