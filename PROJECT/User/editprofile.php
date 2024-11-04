<?php
include("../Assets/Connection/connection.php");

ob_start();
include("Head.php");
$selQry="select * from tbl_user where user_id=".$_SESSION['uid'];
$resultone = $con->query($selQry);
$dataone = $resultone->fetch_assoc();

if(isset($_POST["btn_update"]))
{
    $name=$_POST["txt_name"];
	$email=$_POST["txt_email"];
	$contact=$_POST["txt_contact"];
	$upQry="update tbl_user set user_name='".$name."',user_email='".$email."' ,user_contact='".$contact."' where user_id=".$_SESSION["uid"];
	if($con->query($upQry))
	{
	
		//echo "updated";
		$aid=0;
		?>
        <script>
		alert("Profile Updated...")
		window.location="myprofile.php";
		</script>
        <?php
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
<form id="form1" name="form1" method="post" action="" class="shadow p-4 rounded bg-dark text-white">
    <div class="container">
        <h3 class="text-center mb-4">Edit Profile</h3>

        <!-- Name Field -->
        <div class="form-group row mb-3">
            <label for="txt_name" class="col-sm-3 col-form-label">Name</label>
            <div class="col-sm-9">
                <input type="text" class="form-control bg-secondary text-white" name="txt_name" id="txt_name" value="<?php echo $dataone['user_name']; ?>">
            </div>
        </div>

        <!-- Email Field -->
        <div class="form-group row mb-3">
            <label for="txt_email" class="col-sm-3 col-form-label">Email</label>
            <div class="col-sm-9">
                <input type="email" class="form-control bg-secondary text-white" name="txt_email" id="txt_email" value="<?php echo $dataone['user_email']; ?>">
            </div>
        </div>

        <!-- Contact Field -->
        <div class="form-group row mb-3">
            <label for="txt_contact" class="col-sm-3 col-form-label">Contact</label>
            <div class="col-sm-9">
                <input type="text" class="form-control bg-secondary text-white" name="txt_contact" id="txt_contact" value="<?php echo $dataone['user_contact']; ?>">
            </div>
        </div>

        <!-- Submit Button -->
        <div class="text-center">
            <button type="submit" name="btn_update" id="btn_update" class="btn btn-primary">Update</button>
        </div>
    </div>
</form>
</body>
</html>
<?php
include("Foot.php");
ob_flush();
?>