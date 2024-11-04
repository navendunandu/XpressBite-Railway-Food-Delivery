<?php

include("../Assets/Connection/connection.php");

session_start();

$message="";
	
if(isset($_POST["btnupdate"]))
{
	$current=$_POST["txt_current"];
	$newpwd=$_POST["txt_new"];
	$confirm=$_POST["txt_confirm"];
	
	$selQry="select * from tbl_rest where rest_id=".$_SESSION["rid"];
  	$result= $con->query($selQry);
  	if($data=$result->fetch_assoc())
	{
		if($newpwd==$confirm)
		{
			
			$insQry ="update tbl_rest set rest_password='".$confirm."' where rest_id='".$_SESSION["rid"]."'";
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
<a href="Homepage.php">Home</a>
<form id="form1" name="form1" method="post" action="">
  <table width="391" height="185" border="1" align="center">
    <tr>
      <td>Current Password</td>
      <td><label for="txt_current"></label>
        <input type="text" name="txt_current" id="txt_current" /></td>
    </tr>
    <tr>
      <td>New Password</td>
      <td><label for="txt_new"></label>
      <input type="text" name="txt_new" id="txt_new" /></td>
    </tr>
    <tr>
      <td>Confirm Password</td>
      <td><label for="txt_confirm"></label>
      <input type="text" name="txt_confirm" id="txt_confirm" /></td>
    </tr>
    <tr>
      <td colspan="2" align="center"><input type="submit" name="btnupdate" id="btnupdate" value="Submit" />
      <input type="reset" name="btncancel" id="btncancel" value="Cancel" /></td>
    </tr>
    <tr>
      <td colspan="2" align="center"><?php echo $message?></td>
    </tr>
  </table>
</form>
</body>
</html>