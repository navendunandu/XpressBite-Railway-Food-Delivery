<?php
include("../Assets/Connection/Connection.php");

session_start();
$selqryone = "SELECT * FROM tbl_rest WHERE rest_id=".$_SESSION["rid"];
$resultone = $con->query($selqryone);
$dataone = $resultone->fetch_assoc();
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title>Profile</title>
</head>

<body>
<form id="form1" name="form1" method="post" action="">
    <table width="343" border="1">
        <tr>
            <td width="176">NAME</td>
            <td width="151"><?php echo $dataone["rest_name"]; ?></td>
        </tr>
        <tr>
            <td>EMAIL</td>
            <td><?php echo $dataone["rest_email"]; ?></td>
        </tr>
        
        <tr>
            <td>CONTACT</td>
            <td><?php echo $dataone["rest_contact"]; ?></td>
        </tr>
        <tr>
            <td colspan="2">
                <div align="center">
                    <a href="EditProfile.php">Edit Profile</a>    
                    <a href="ChangePassword.php">Change Password</a>
                </div>
            </td>
        </tr>
    </table>
</form>
</body>
</html>