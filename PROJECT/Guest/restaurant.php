<?php
include('../Assets/Connection/connection.php');
if (isset($_POST['btn_submit'])) {
    $restaurant = $_POST['txt_name'];
    $email = $_POST['txt_email'];
    $contact = $_POST['txt_contact'];
    $address = $_POST['txt_address'];

    $photo = $_FILES['file_photo']["name"];
    $temp = $_FILES['file_photo']["tmp_name"];
    move_uploaded_file($temp, "../Assets/Files/Restaurant/" . $photo);
    $proof = $_FILES['file_proof']["name"];
    $temp2 = $_FILES['file_proof']["tmp_name"];
    move_uploaded_file($temp2, "../Assets/Files/Restaurant/" . $proof);
    $place = $_POST['sel_place'];
    $password = $_POST['txt_pswd'];
    $insQry = "INSERT INTO tbl_rest(rest_name, rest_contact, rest_email, rest_address, rest_photo, rest_proof, place_id, rest_password) VALUES ('$restaurant', '$contact', '$email', '$address', '$photo', '$proof', '$place', '$password')";
    if ($con->query($insQry)) {
?>
        <script>
            alert("Data inserted..");
             window.location="Login.php"
        </script>
<?php
    }
}
?>

<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">    <title>Restaurant Registration</title>
</head>

<body style="background-color:black">
    <div class="container my-5">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card bg-dark text-light shadow-lg">
                    <div class="card-header text-center bg-secondary">
                        <h4 class="text-light">Restaurant Registration</h4>
                    </div>
                    <div class="card-body">
                        <form id="form1" name="form1" method="post" enctype="multipart/form-data" action="">
                            <div class="form-group mb-3">
                                <label for="txt_name" class="form-label">Name</label>
                                <input type="text" name="txt_name" class="form-control border-light" id="txt_name" placeholder="Enter Name" required>
                            </div>
                            <div class="form-group mb-3">
                                <label for="txt_contact" class="form-label">Contact</label>
                                <input type="text" name="txt_contact" class="form-control border-light" id="txt_contact" placeholder="Enter Contact" required>
                            </div>
                            <div class="form-group mb-3">
                                <label for="txt_email" class="form-label">Email</label>
                                <input type="email" name="txt_email" class="form-control border-light" id="txt_email" placeholder="Enter Email" required>
                            </div>
                            <div class="form-group mb-3">
                                <label for="txt_address" class="form-label">Address</label>
                                <textarea name="txt_address" class="form-control border-light" id="txt_address" rows="3" placeholder="Enter Address" required></textarea>
                            </div>
                            <div class="form-group mb-3">
                                <label for="file_photo" class="form-label">Photo</label>
                                <input type="file" name="file_photo" class="form-control border-light" id="file_photo" required>
                            </div>
                            <div class="form-group mb-3">
                                <label for="file_proof" class="form-label">Proof</label>
                                <input type="file" name="file_proof" class="form-control border-light" id="file_proof" required>
                            </div>
                            <div class="form-group mb-3">
                                <label for="sel_district" class="form-label">District</label>
                                <select name="sel_district" class="form-control border-light" id="sel_district" onchange="getPlace(this.value)" required>
                                    <option value="">Select District</option>
                                    <!-- PHP options for districts -->
                                     <?php 
                                     $sel="select * from tbl_district ";
                                     $res=$con->query($sel);
                                     while($data=$res->fetch_assoc())
                                        {
                                     ?>
                                     <option value="<?php echo $data['district_id']?>"><?php echo $data['district_name']?></option>
                                     <?php } ?>
                                </select>
                            </div>
                            <div class="form-group mb-3">
                                <label for="sel_place" class="form-label">Place</label>
                                <select name="sel_place" class="form-control border-light" id="sel_place" required>
                                    <option value="">Select Place</option>
                                </select>
                            </div>
                            <div class="form-group mb-4">
                                <label for="txt_pswd" class="form-label">Password</label>
                                <input type="password" name="txt_pswd" class="form-control border-light" id="txt_pswd" placeholder="Enter Password" required>
                            </div>
                            <div class="text-center">
                                <button type="submit" name="btn_submit" id="btn_submit" class="btn btn-primary btn-lg px-5">Register</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    <script src="../Assets/JQ/jQuery.js"></script>
    <script>
        function getPlace(did) {
            $.ajax({
                url: "../Assets/AjaxPages/AjaxPlace.php?did=" + did,
                success: function (result) {
                    $("#sel_place").html(result);
                }
            });
        }
    </script>
</body>
</html>
