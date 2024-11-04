<?php
include("../Assets/Connection/Connection.php");

if (isset($_POST["btn_submit"])) {
    $name = $_POST["txt_name"];
    $contact = $_POST["txt_contact"];
    $email = $_POST["txt_email"];  
    $pwd = ($_POST["txt_pwd"]);
    $photo = $_FILES["File_photo"]["name"];
    $temp = $_FILES["File_photo"]["tmp_name"];

    // Moving the uploaded file
    if(!empty($photo) && !empty($temp)) {
      $photoPath = "../Assets/Files/User/" . $photo;
      move_uploaded_file($temp, $photoPath);
    } else {
        $photoPath = "../Assets/Files/User/Default_avatar_photo_icon.jpeg"; 
    }

    //Check for duplicate values
    $checkQry = "select * from tbl_user where user_email = '$email' ";
    $checkResult = $con->query($checkQry);

    if($checkResult->num_rows > 0) {
      //If User Already Exists
      echo "<script>
              alert('Unsuccessful, User Already Exists...');
              window.location = 'userRegistration.php';
            </script>";
    } else {
        //If no duplicate values found, proceed with insertion
        $insQry = "INSERT INTO tbl_user(user_name, user_contact, user_email, user_password)
                   VALUES ('$name', '$contact', '$email', '$pwd')";
        if ($con->query($insQry)) {
          echo "<script>
                  alert('Registration Successful');
                  window.location = 'Login.php' ;
                </script>";
        }
    }
}
?>

<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">    
<title>User Registration</title>
</head>
<style>
 input[type="submit"]{
 background-color: #CCC;
 font:"Arial, Helvetica, sans-serif";
 font-size:14px;
 }

.btn{
 padding:10px;
 } 

#UserRegistration table tr td strong {
 font-family: "Georgia", "Times New Roman", "Times", "serif";
 font-size: 14px;
 font-weight: bold;
}
#userInfoTable th, #userInfoTable td {
  text-align: center; 
  border: 1px solid black;
}
#userGetInfo{
  border-spacing: 0 10px;
}

</style>

<body style="background-color:black">
    <div class="container my-5">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <div class="card bg-dark text-light shadow-lg">
                    <div class="card-header text-center bg-secondary">
                        <h4 class="text-light">User Registration</h4>
                    </div>
                    <div class="card-body">
                        <form id="UserRegistration" name="UserRegistration" method="post" action="" enctype="multipart/form-data">
                            <!-- Name Field -->
                            <div class="form-group mb-3">
                                <label for="txt_name" class="form-label">Name</label>
                                <input type="text" name="txt_name" id="txt_name" class="form-control border-light" pattern="^[A-Z]+[a-zA-Z ]*$" title="Name allows only alphabets, spaces, and the first letter must be capitalized" placeholder="Enter your Full Name" required />
                            </div>
                            <!-- Contact Field -->
                            <div class="form-group mb-3">
                                <label for="txt_contact" class="form-label">Contact</label>
                                <input type="text" name="txt_contact" id="txt_contact" class="form-control border-light" placeholder="Enter your phone number" pattern="[7-9]{1}[0-9]{9}" title="Phone number must start with 7-9 and be followed by 9 digits" required />
                            </div>
                            <!-- Email Field -->
                            <div class="form-group mb-3">
                                <label for="txt_email" class="form-label">Email</label>
                                <input type="email" name="txt_email" id="txt_email" class="form-control border-light" placeholder="Enter your Email Address" pattern="[a-z0-9.]+@[a-z]+\.[a-z]{2,}$" required />
                            </div>
                            <!-- Password Field -->
                            <div class="form-group mb-3">
                                 <label for="txt_pwd" class="form-label">Password</label>
                                 <input type="password" name="txt_pwd" id="txt_pwd" class="form-control border-light" pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}" title="Must contain at least one number, one uppercase and one lowercase letter, and be at least 8 characters long" placeholder="Password" required />
                            </div>
                            <!-- Photo Field -->
                            <div class="form-group mb-3">
                                <label for="File_photo" class="form-label">Photo</label>
                                <input type="file" name="File_photo" id="File_photo" class="form-control border-light" accept="image/*" />
                            </div>
                            <!-- Submit and Reset Buttons -->
                            <div class="text-center">
                                <button type="submit" name="btn_submit" id="btn_submit" class="btn btn-primary btn-lg px-5">Create</button>
                                <button type="reset" name="btn_cancel" id="btn_cancel" class="btn btn-secondary btn-lg px-5">Cancel</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    <script src="../Assets/JQ/jQuery.js"></script>
</body>

</html>