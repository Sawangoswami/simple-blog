<?php
    if(isset($_POST['esubmit'])){
        $to = "goswamisawan759@gmail.com";
        $subject = $_POST['subjects'];
        $message = $_POST['message'];
        $from = $_POST['email']; 
        $headers = "From: $from";
        
        mail($to ,$subject,$message,$headers);


        echo "<script> alert('mail sent') </script>";
    }
?>