<?php
include('../Assets/Connection/connection.php');
ob_start();
include("Head.php");  // Assuming Bootstrap CDN is included in Head.php
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Restaurant Search</title>
<style>
    body {
        background-color: #000; /* Black background */
        color: #fff; /* White text for readability */
    }
    .card {
        background-color: #1c1c1c; /* Dark card background */
        border: none;
    }
    .card-title, .card-text {
        color: #fff; /* White text inside the card */
    }
    .form-control {
        background-color: #333; /* Dark background for form controls */
        color: #fff; /* White text for form controls */
        border: 1px solid #555; /* Subtle border */
    }
    .form-control::placeholder {
        color: #ccc; /* Light placeholder text */
    }
    .btn-primary {
        background-color: #007bff;
        border-color: #007bff;
    }
    .btn-primary:hover {
        background-color: #0056b3;
    }
    .shadow-custom {
        box-shadow: 0 4px 8px rgba(255, 255, 255, 0.1); /* Subtle white shadow */
    }
</style>
</head>

<body>
<div class="container mt-5">
    <div class="row">
        <div class="col-md-6 offset-md-3">
            <h2 class="text-center mb-4">Search Restaurants by Location</h2>
            <form action="" method="post" class="shadow p-4 rounded shadow-custom">
                <div class="form-group mb-3">
                    <label for="sel_dist">District</label>
                    <select name="sel_dist" class="form-control" onchange="getStation(this.value)">
                        <option value="">Select District</option>
                        <?php
                        $sel = "SELECT * FROM tbl_district";
                        $result = $con->query($sel);
                        while($row = $result->fetch_assoc()) {
                        ?>
                        <option value="<?php echo $row['district_id']; ?>"><?php echo $row['district_name']; ?></option>
                        <?php
                        }
                        ?>
                    </select>
                </div>
                <div class="form-group mb-4">
                    <label for="sel_station">Station</label>
                    <select name="sel_station" class="form-control" id="sel_station">
                        <option value="">Select Station</option>
                    </select>
                </div>
                <div class="text-center">
                    <button type="submit" name="btn_search" class="btn btn-primary">Search</button>
                </div>
            </form>
        </div>
    </div>
</div>

<?php
if(isset($_POST['btn_search'])){
    $selQry="SELECT * from tbl_rest where place_id=".$_POST["sel_station"];
    $resRest=$con->query($selQry);
    if($resRest->num_rows>0)
?>
<div class="container mt-5">
    <div class="row">
        <?php
        while($resData=$resRest->fetch_assoc()){
        ?>
        <div class="col-md-3 mb-4">
            <div class="card shadow-custom">
                <img src="../Assets/Files/Restaurant/<?php echo $resData['rest_photo']?>" class="card-img-top" alt="Restaurant Image" style="height: 200px; object-fit: cover;">
                <div class="card-body text-center">
                    <h5 class="card-title"><?php echo $resData['rest_name']; ?></h5>
                    <p class="card-text"><?php echo $resData['rest_contact']; ?></p>
                    <a href="ViewFood.php?rid=<?php echo $resData['rest_id'] ?>" class="btn btn-primary">Select Restaurant</a>
                </div>
            </div>
        </div>
        <?php
        }
        ?>
    </div>
</div>
<?php
    }
?>

<script src="../Assets/JQ/jquery.js"></script>

<script>
function getStation(pid) {
    $.ajax({
        url: "../Assets/AjaxPages/AjaxStation.php?pid=" + pid,
        success: function(result) {
            $("#sel_station").html(result);
        }
    });
}
</script>
</body>
</html>

<?php
include("Foot.php");
ob_flush();
?>
