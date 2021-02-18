<?php
include('security.php');

if(isset($_POST['registerbtn']))
{
    // $username = $_POST['username'];
	$name = $_POST['name'];
    $tel = $_POST['tel'];
    $password = $_POST['password'];
    $cpassword = $_POST['confirmpassword'];

    $tel_query = "SELECT * FROM register WHERE tel='$tel' ";
    $tel_query_run = mysqli_query($connection, $tel_query);
    if(mysqli_num_rows($tel_query_run) > 0)
    {
        $_SESSION['status'] = "Phone Number Already Taken. Please Try Another one.";
        $_SESSION['status_code'] = "error";
        header('Location: register.php');  
    }
    else
    {
        if($password === $cpassword)
        {
            $query = "INSERT INTO register (name,tel,password) VALUES ('$name','$tel','$password')";
            $query_run = mysqli_query($connection, $query);
            
            if($query_run)
            {
                // echo "Saved";
                $_SESSION['status'] = "Teacher Profile Added";
                $_SESSION['status_code'] = "success";
                header('Location: register.php');
            }
            else 
            {
                $_SESSION['status'] = "Teacher Profile Not Added";
                $_SESSION['status_code'] = "error";
                header('Location: register.php');  
            }
        }
        else 
        {
            $_SESSION['status'] = "Password and Confirm Password Does Not Match";
            $_SESSION['status_code'] = "warning";
            header('Location: register.php');  
        }
    }

}

if(isset($_POST['delete_btn'])){
	$id = $_POST['delete_id'];
	$del_query = "DELETE FROM register WHERE id='$id'";
	$del_query_run = mysqli_query($connection, $del_query);
	header('Location: register.php');
}
if(isset($_POST['delete_btn_req'])){
	$id = $_POST['delete_id_req'];
	$del_query = "DELETE FROM register_request WHERE id='$id'";
	$del_query_run = mysqli_query($connection, $del_query);
	header('Location: register.php');
}

if(isset($_POST['approve_btn'])){
	$temp_id = $_POST['approve_id'];
	$getdata_query = "SELECT * FROM register_request WHERE id='$temp_id'";
	$getdata_query_run = mysqli_query($connection, $getdata_query);
	if(mysqli_num_rows($getdata_query_run) > 0){
		 while($row = mysqli_fetch_assoc($getdata_query_run)){
			 $id = $row['id'];
			 $name_reg = $row['name'];
			 $tel_reg = $row['tel'];
			 $pass_reg = $row['password'];
		 }
		 $query_insert = "INSERT INTO register (name,tel,password) VALUES ('$name_reg','$tel_reg','$pass_reg')";
         $query_run = mysqli_query($connection, $query_insert);
		 if ($query_run){
			 $query_del_req = "DELETE FROM register_request WHERE tel = '$tel_reg'" ;
			 $query_del_req_run = mysqli_query($connection, $query_del_req);
		 }
	    header('Location: register.php');
	}
	
    else{	
	header('Location: register.php');
}}


?>