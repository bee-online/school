<?php
//include('security.php');
include('includes/header.php'); 
include('includes/navbar.php');

?>


<div class="modal fade" id="addadminprofile" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Add Head Teacher Data</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form action="code.php" method="POST">

        <div class="modal-body">

            <!-- <div class="form-group"> -->
                <!-- <label> Username </label> -->
                <!-- <input type="text" name="username" class="form-control" placeholder="Enter Username"> -->
            <!-- </div> -->
			
			<div class="form-group">
                <label>Full Name</label>
                <input type="text" name="name" class="form-control" placeholder="HeadTeacher Name">
            </div>
            <div class="form-group">
                <label>Phone Number(11 Digits,Format:03xxxxxxxxx)</label>
                <input type="tel" name="tel" pattern="([0-9]{11})" class="form-control" placeholder="03xxxxxxxxx">
            </div>
            <div class="form-group">
                <label>Password</label>
                <input type="password" name="password" class="form-control" placeholder="Enter Password">
            </div>
            <div class="form-group">
                <label>Confirm Password</label>
                <input type="password" name="confirmpassword" class="form-control" placeholder="Confirm Password">
            </div>
            <div class="form-group">
                <label>Assign to Class:</label>
               <select name="htclass" id="htclass">
			    <option value="6J">6th Jinnah</option>
			    <option value="6I">6th Iqbal</option>
			    <option value="6L">6th Liaqat</option>
				<option value="9">9th</option>
				<option value="10">10th</option>
				<option value="11">11th</option>
				<option value="12">12th</option>
			  </select>
            </div>
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            <button type="submit" name="registerbtn" class="btn btn-primary">Save</button>
        </div>
      </form>

    </div>
  </div>
</div>


<div class="container-fluid">

<!-- DataTales Example -->
<div class="card shadow mb-4">
  <div class="card-header py-3">
    <h6 class="m-0 font-weight-bold text-primary">Total Classes
            <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#addadminprofile">
              Add Class
            </button>
			<!-- <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#addadminprofile"> -->
              <!-- Add Regular Teacher  -->
            <!-- </button> -->
    </h6>
  </div>

  <div class="card-body">

    <div class="table-responsive">
	<?php
				$server_name = "localhost";
$db_username = "root";
$db_password = "root";
$db_name = "school_admins";

$connection = mysqli_connect($server_name,$db_username,$db_password,$db_name);
                $query = "SELECT * FROM register";
                $query_run = mysqli_query($connection, $query);
            ?>

      <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
        <thead>
          <tr>
          
            <th> Class </th>
            <th>Students Enrolled </th>
            <th>Head Teacher</th>
            <th>EDIT Class</th>
            <th>DELETE Class</th>
          </tr>
        </thead>
        <tbody>
		<?php
                        if(mysqli_num_rows($query_run) > 0)        
                        {
                            while($row = mysqli_fetch_assoc($query_run))
                            {
                        ?>
        
     
          <tr>
         
			                   
                                <td><?php  echo $row['tel']; ?></td>
                                <td><?php  echo $row['name']; ?></td>
                                <td><?php  echo ("******") ?></td>
                            
                                <td>
                <form action="" method="post">
                    <input type="hidden" name="edit_id" value="">
                    <button  type="submit" name="edit_btn" class="btn btn-success"> EDIT</button>
                </form>
            </td>
			                              
            <td>
                <form action="code.php" method="post">
                  <input type="hidden" name="delete_id" value="<?php echo $row['id']; ?>">
                  <button type="submit" name="delete_btn" class="btn btn-danger"> DELETE</button>
                </form>
            </td>
          </tr>
        <?php
                            } 
                        }
                        else {
                            echo "No Record Found";
                        }
                        ?>
        </tbody>
      </table>

    </div>
  </div>
</div>

</div>
<!-- /.container-fluid -->





<?php
include('includes/scripts.php');
include('includes/footer.php');
?>