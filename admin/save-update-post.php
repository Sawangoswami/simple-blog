<?php

include "config.php";


if(empty($_FILES['new-image']['name'])){
	$new_name = $_POST['old_image'];
}else{
	$errors = array();
	$file_name = $_FILES['new-image']['name'];
	$file_size = $_FILES['new-image']['size'];
	$file_tmp = $_FILES['new-image']['tmp_name'];
	$file_type = $_FILES['new-image']['type'];
	$tmp = explode('.',$file_name);
	$file_ext = end($tmp);
	$extensions = array("jpeg", "jpg","png");
	if(in_array($file_ext,$extensions) === false){
		$errors [] = "Unvalid Extension";
	}

	if($file_size > 2097152){
		$errors [] = "file size must 2mb or lower";
	}
	$new_name = time(). "-".basename($file_name);
   $target = "upload/".$new_name;

	if(empty($errors) == true){
		move_uploaded_file($file_tmp,$target);
	}else{
		print_r($errors);
		die("");
	}

	unlink("upload/".$_POST['old_image']);
}

echo $cat_new = $_POST['category'] ;

 echo $cat_old = $_POST['old_category'] ;


 if($cat_new == $cat_old ) {


 $sql = "UPDATE post SET title = '{$_POST["post_title"]}', description = '{$_POST["postdesc"]}', category = {$_POST["category"]}, post_img = '{$new_name}'
   WHERE post_id = {$_POST['post_id'] }" ; 

   $result = mysqli_query($conn, $sql) or die("query failed");


  
}

else{
	$sql = "UPDATE post SET title = '{$_POST["post_title"]}', description = '{$_POST["postdesc"]}', category = {$_POST["category"]}, post_img = '{$file_name}'
   WHERE post_id = {$_POST['post_id']};" ; 

   $sql .= "UPDATE category SET post = post + 1 WHERE category_id = {$_POST['category']};";
  
   $sql .= "UPDATE category SET post = post - 1 WHERE category_id = {$_POST['old_category']}";

   $result = mysqli_multi_query($conn, $sql) or die("query failed");
}

if($result = true){
	header("Location: http://localhost/blog-site/admin/post.php");
}else{
	echo "Query Failed";
}

  





?>