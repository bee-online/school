<?php
include('security.php');

if(isset($_POST['req_btn']))
{
    // $username = $_POST['username'];
	$name = $_POST['name'];
    $tel = $_POST['tel'];
    $password = $_POST['password'];
    $cpassword = $_POST['confirm_password'];

    $tel_query = "SELECT * FROM register WHERE tel='$tel' ";
    $tel_query_run = mysqli_query($connection, $tel_query);
    if(mysqli_num_rows($tel_query_run) > 0)
    {
        $_SESSION['status'] = "Phone Number Already Taken. Please Try Another one.";
        $_SESSION['status_code'] = "error";
        header('Location: teacher_reg_req.php');  
    }
    else
    {
        if($password === $cpassword)
        {
            $query = "INSERT INTO register_request (name,tel,password) VALUES ('$name','$tel','$password')";
            $query_run = mysqli_query($connection, $query);
            
            if($query_run)
            {
                // echo "Saved";
                $_SESSION['status'] = "Teacher Profile Added";
                $_SESSION['status_code'] = "success";
                header('Location: teacher_reg_req.php');
            }
            else 
            {
                $_SESSION['status'] = "Teacher Profile Not Added";
                $_SESSION['status_code'] = "error";
                header('Location: teacher_reg_req.php');  
            }
        }
        else 
        {
            $_SESSION['status'] = "Password and Confirm Password Does Not Match";
            $_SESSION['status_code'] = "warning";
            header('Location: teacher_reg_req.php');  
        }
    }

}




?>