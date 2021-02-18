<?php
include('security.php');

if(isset($_POST['login_btn']))
{
    $tel = $_POST['tel'];
    $password = $_POST['password'];

    $email_query = "SELECT * FROM register WHERE tel='$tel' && password = '$password' ";
    $email_query_run = mysqli_query($connection, $email_query);
    if(mysqli_num_rows($email_query_run) > 0)
    {
		while($row = mysqli_fetch_assoc($email_query_run)){
			 $teacher_name = $row['name'];
			 $_SESSION['teacher_name'] = $teacher_name;
		
		 }
		$_SESSION['usertel'] = $tel;
        header('Location: indexteacher.php');  
    }
    else
    {
		$_SESSION['status'] = 'EMail/password invalid';
        header('Location: login.php'); 
		echo "Wrong Login Info";
    }

}
?>


