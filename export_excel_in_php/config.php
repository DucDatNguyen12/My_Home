<?php 
    $con = mysqli_connect('localhost', 'root', '','export_excel');
    if(!$con)
    {
        die('Connection Error'.mysqli_error($con));
    }
    else 
    {
        if(isset($_POST['save']))
        {
            $name = $_POST['name'];
            $email = $_POST['email'];

            $dp_temp = $_FILES['db']['tmp_name'];
            $dp = $_FILES['dp']['name'];

            $path = "image/".$dp;
            $insert_query = "INSERT INTO `user_detail`(`name`, `email`, `db`) VALUES ('$name', '$email', '$path')";
            $result_query = mysqli_query($con, $insert_query);
            if($result_query){
                move_uploaded_file($dp_temp, $path);
                header('location:index.php?success');
            }
            else {
                header('location:index.php?fail');
            }
        }
    }
?>