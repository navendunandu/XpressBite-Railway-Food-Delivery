<?php
include("../Assets/Connection/Connection.php");
session_start();
ob_start();
include("Head.php");
if(isset($_POST['btn_submit'])){
    $qry="update tbl_booking set coach_no='".$_POST['txt_coach']."', pnr_no='".$_POST['txt_pnr']."', station_id='".$_POST['sel_station']."',booking_fordate='".$_POST['txt_date']."' where booking_id=".$_GET['bid'];
    if($con->query($qry))
    {
      $sel = "select count(*) as totalcount from tbl_booking where booking_status>0 and user_id=".$_SESSION["uid"];
      $res = $con->query($sel);
      $data = $res->fetch_assoc();
      // echo $data["totalcount"];
      if((int)$data["totalcount"] > 0)
      {
        $bookingId=$_GET['bid'];
        header("location: Payment.php?bid=$bookingId");
      } 
      else
      {
        $selbook = "select * from tbl_booking where booking_id=".$_GET["bid"];
        $resbook = $con->query($selbook);
        $databook = $resbook->fetch_assoc();
        if((int)$databook["booking_amount"] > 500)
        {
          $dis = (int)$databook["booking_amount"] * 20;
          $total = $dis / 100;
          $update = "update tbl_booking set discount_amount	='".$total."' where booking_id=".$_GET["bid"];
          if($con->query($update))
          {
            $bookingId=$_GET['bid'];
            header("location: Payment.php?bid=$bookingId");
          }
        }  
        else
        {
          $bookingId=$_GET['bid'];
          header("location: Payment.php?bid=$bookingId");
        } 
      }    
    }
    else{
        echo "Gailed";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
<form method="post" class="shadow p-4 rounded bg-dark text-white">
    <div class="container">
        <h3 class="text-center mb-4">View Bookings</h3>
        <div class="form-group row mb-3">
            <label for="txt_date" class="col-sm-3 col-form-label">Date</label>
            <div class="col-sm-9">
                <input type="date" class="form-control bg-secondary text-white" name="txt_date" id="">
            </div>
        </div>
        
        <div class="form-group row mb-3">
            <label for="sel_dist" class="col-sm-3 col-form-label">District</label>
            <div class="col-sm-9">
                <select name="sel_dist" class="form-control bg-secondary text-white" id="" onchange="getPlace(this.value)">
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
        </div>
        
        <div class="form-group row mb-3">
            <label for="sel_place" class="col-sm-3 col-form-label">Place</label>
            <div class="col-sm-9">
                <select name="sel_place" class="form-control bg-secondary text-white" id="sel_place" onchange="getStation(this.value)">
                    <option value="">---- Select ----</option>
                </select>
            </div>
        </div>
        
        <div class="form-group row mb-3">
            <label for="sel_station" class="col-sm-3 col-form-label">Station</label>
            <div class="col-sm-9">
                <select name="sel_station" class="form-control bg-secondary text-white" id="sel_station">
                    <option value="">---- Select ----</option>
                </select>
            </div>
        </div>

        <div class="form-group row mb-3">
            <label for="txt_pnr" class="col-sm-3 col-form-label">PNR Number</label>
            <div class="col-sm-9">
                <input type="text" class="form-control bg-secondary text-white" name="txt_pnr" id="">
            </div>
        </div>
        
        <div class="form-group row mb-3">
            <label for="txt_coach" class="col-sm-3 col-form-label">Coach Number</label>
            <div class="col-sm-9">
                <input type="text" class="form-control bg-secondary text-white" name="txt_coach" id="">
            </div>
        </div>
        
        <div class="text-center">
            <button type="submit" name="btn_submit" class="btn btn-primary">Pay Now</button>
        </div>
    </div>
</form>

</body>
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
  function getStation(sid) {
    $.ajax({
      url: "../Assets/AjaxPages/AjaxStation.php?id=" +sid,
      success: function (result) {
        $("#sel_station").html(result);
      }
    });
  }
</script>
</html>
<?php
include("Foot.php");
ob_flush();
?>