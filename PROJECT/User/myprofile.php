<?php
include("../Assets/Connection/Connection.php");


ob_start();
include("Head.php");
$selqryone = "SELECT * FROM tbl_user WHERE user_id=".$_SESSION["uid"];
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
<div class="container my-5">
    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="card bg-dark text-light shadow-lg">
                <div class="card-header text-center bg-secondary">
                    <h4 class="text-black">My Profile</h4>
                </div>
                <div class="card bg-black">
                    <table class="table table-borderless  text-white">
                        <tr>
                            <th scope="row">Name</th>
                            <td><?php echo $dataone["user_name"]; ?></td>
                        </tr>
                        <tr>
                            <th scope="row">Email</th>
                            <td><?php echo $dataone["user_email"]; ?></td>
                        </tr>
                        <tr>
                            <th scope="row">Contact</th>
                            <td><?php echo $dataone["user_contact"]; ?></td>
                        </tr>
                    </table>
                </div>
                <div class="card-footer text-center">
                    <a href="editProfile.php" class="btn btn-primary mx-2">Edit Profile</a>
                    <a href="changePassword.php" class="btn btn-warning mx-2">Change Password</a>
                </div>
            </div>
        </div>
    </div>
</div>

</body>
</html>
<?php
include("Foot.php");
ob_flush();
?>