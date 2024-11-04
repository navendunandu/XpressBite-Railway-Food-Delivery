<?php

include("../Assets/Connection/connection.php");

ob_start();
include("Head.php");
$message="";
	
if(isset($_POST["btnupdate"]))
{
	$current=$_POST["txt_current"];
	$newpwd=$_POST["txt_new"];
	$confirm=$_POST["txt_confirm"];
	
	$selQry="select * from tbl_user where user_id=".$_SESSION["uid"];
  	$result= $con->query($selQry);
  	if($data=$result->fetch_assoc())
	{
		if($newpwd==$confirm)
		{
			
			$insQry ="update tbl_user set user_password='".$confirm."' where user_id='".$_SESSION["uid"]."'";
     		if($con->query($insQry))
	 		{
					header("location:MyProfile.php");
	 		}
		}
		else
		{
				$message="Password not same...";
		}
	}
	else
	{
				$message="Please check old password...";
	}
}
 		
?>



<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Untitled Document</title>
</head>

<body>
<a href="HomePage.php">Home</a>
<form id="form1" name="form1" method="post" action="" class="shadow p-4 rounded bg-dark text-white">
    <div class="container">
        <h3 class="text-center mb-4">Change Password</h3>

        <!-- Current Password -->
        <div class="form-group row mb-3">
            <label for="txt_current" class="col-sm-4 col-form-label">Current Password</label>
            <div class="col-sm-8">
                <input type="password" class="form-control bg-secondary text-white" name="txt_current" id="txt_current" required>
            </div>
        </div>

        <!-- New Password -->
        <div class="form-group row mb-3">
            <label for="txt_new" class="col-sm-4 col-form-label">New Password</label>
            <div class="col-sm-8">
                <input type="password" class="form-control bg-secondary text-white" name="txt_new" id="txt_new" required>
            </div>
        </div>

        <!-- Confirm Password -->
        <div class="form-group row mb-3">
            <label for="txt_confirm" class="col-sm-4 col-form-label">Confirm Password</label>
            <div class="col-sm-8">
                <input type="password" class="form-control bg-secondary text-white" name="txt_confirm" id="txt_confirm" required>
            </div>
        </div>

        <!-- Submit and Reset Buttons -->
        <div class="form-group row text-center">
            <div class="col-sm-12">
                <button type="submit" name="btnupdate" id="btnupdate" class="btn btn-primary">Submit</button>
                <button type="reset" name="btncancel" id="btncancel" class="btn btn-secondary">Cancel</button>
            </div>
        </div>

        <!-- Message Display -->
        <div class="form-group row text-center">
            <div class="col-sm-12">
                <?php if(isset($message)) echo "<p class='text-warning'>$message</p>"; ?>
            </div>
        </div>
    </div>
</form>
</body>
</html>
<?php
include("Foot.php");
ob_flush();
?>