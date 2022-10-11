<?php 

$user_id = $_GET['id'];
include 'config.php';
$sql = "DELETE FROM user WHERE user_id = '{$user_id}'";
$result = mysqli_query($conn, $sql) or die ("Query Failed");
if($result = 1){
	header("Location: http://localhost/blog-site/admin/users.php");
}
mysqli_close($conn)

?>