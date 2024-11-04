<?php
include("../Assets/Connection/Connection.php");
session_start();
if(isset($_POST["btn_submit"]))
{
    $email = $_POST["txt_email"];
    $password = $_POST["txt_password"];
    
    $sel = "select * from tbl_admin where admin_email='".$email."' and admin_password='".$password."'";
    $res = $con->query($sel);
    
    $usel = "select * from tbl_user where user_email='".$email."' and user_password='".$password."'";
    $ures = $con->query($usel);
    
    $msel = "select * from tbl_rest where rest_email='".$email."' and rest_password='".$password."'";
    $mres = $con->query($msel);
    
    if($row = $res->fetch_assoc())
    {
        $_SESSION["aid"] = $row["admin_id"];
        $_SESSION["aname"] = $row["admin_name"];
        header("location:../Admin/HomePage.php");
    }
    else if($row = $ures->fetch_assoc())
    {
        $_SESSION["uid"] = $row["user_id"];
        $_SESSION["uname"] = $row["user_name"];
        header("location:../User/UserHome.php");
    }
    else if($row = $mres->fetch_assoc())
    {
        $mselAA = "select * from tbl_rest where rest_id='".$row['rest_id']."' and rest_status=1";
        $mresAA = $con->query($mselAA);
        if($rowAA = $mresAA->fetch_assoc())
        {
            $_SESSION["rid"] = $rowAA["rest_id"];
            $_SESSION["rname"] = $rowAA["rest_name"];
            header("location:../Restaurant/Homepage.php");
        }
        $mselAB = "select * from tbl_rest where rest_id='".$row['rest_id']."' and rest_status=2";
        $mresAB = $con->query($mselAB);
        if($rowAB = $mresAB->fetch_assoc())
        {
           ?>
           <script>
            alert("You are Rejected");
            window.location="Login.php";
            </script>
           <?php
        }
        $mselAB = "select * from tbl_rest where rest_id='".$row['rest_id']."' and rest_status=0";
        $mresAB = $con->query($mselAB);
        if($rowAB = $mresAB->fetch_assoc())
        {
           ?>
           <script>
            alert("Please Wait for Verification...");
            window.location="Login.php";

            </script>
           <?php
        }
    }
    else
    {
        ?>
        <script>
        alert("Invalid Email or Password");
        </script>
        <?php
    }
}
?>

<!doctype html>
<html lang="en">
  <head>
    <title>Login 10</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <link href="https://fonts.googleapis.com/css?family=Lato:300,400,700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="../Assets/Templates/Login/css/style.css">
  </head>
  <body class="img js-fullheight" style="background-image: url('../Assets/Templates/Main/assets/img/pic.jpeg');">
    <section class="ftco-section">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-md-6 text-center mb-5">
                    <h2 class="heading-section">Login </h2>
                </div>
            </div>
            <div class="row justify-content-center">
                <div class="col-md-6 col-lg-4">
                    <div class="login-wrap p-0">
                        <h3 class="mb-4 text-center">Have an account?</h3>
                        <form action="" method="post" class="signin-form">
                            <div class="form-group">
                                <input type="text" name="txt_email" class="form-control" placeholder="Email" required>
                            </div>
                            <div class="form-group">
                                <input id="password-field" type="password" name="txt_password" class="form-control" placeholder="Password" required>
                                <span toggle="#password-field" class="fa fa-fw fa-eye field-icon toggle-password"></span>
                            </div>
                            <div class="form-group">
                                <button type="submit" name="btn_submit" class="form-control btn btn-primary submit px-3">Sign In</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <script src="../Assets/Templates/Login/js/jquery.min.js"></script>
    <script src="../Assets/Templates/Login/js/popper.js"></script>
    <script src="../Assets/Templates/Login/js/bootstrap.min.js"></script>
    <script src="../Assets/Templates/Login/js/main.js"></script>
  </body>
</html>
