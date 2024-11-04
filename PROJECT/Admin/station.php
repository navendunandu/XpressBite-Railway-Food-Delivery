<?php
include('../Assets/Connection/Connection.php');
ob_start();
include("Head.php");
$station = "";
$addr ="";
$district_id ="";
$place_id = "" ;
$eid = 0;

if(isset($_POST['btn_submit'])) {
    $station = $_POST['txt_station'];
    $addr = $_POST['txt_addr'];
    $place_id = $_POST['sel_place'];
    $eid = $_POST['txt_eid'];

    //Check for Duplicate values
    $checkQry = "select * from tbl_station where lower(station_name) = lower('$station') and place_id = '$place_id' and station_id != $eid";
    $checkResult = $con->query($checkQry);

    if($checkResult->num_rows > 0) {
        //If Station Already Exists
        echo "<script>
                alert('Unsuccessful, User Already Exists...');
                window.location = 'userRegistration.php';
             </script>";
    } else {
        //If no duplicate values found, proceed with insertion or update
        if($eid == 0) {
            $insQry = "insert into tbl_station(station_name, station_address, place_id) values('".$station."', '".$addr."', '".$place_id."')";
            if($con->query($insQry)) {
                echo "<script>
                        alert('Data Inserted...'');
                        window.location = 'Station.php';
                      </script>";
            }
        } else {
            $upQry = "update tbl_station set station_name = '".$station."', station_address = '$addr', place_id = '$place_id' where station_id =" .$eid;
            if($con->query($upQry)) {
                echo "<script>
                        alert('Data Updated...'');
                        window.location = 'Station.php';
                      </script>";
            }
        }
    }
}

//Deleting Data
if(isset($_GET['sid'])) {
    $sid = $_GET['sid'];
    $delQry = "delete from tbl_station where station_id = ".$sid;
    if($con->query($delQry)) {
        header("location:Station.php");
        exit();
    }
}

//Editing Existing Data
if(isset($_GET['eid'])) {
    $eid = $_GET['eid'];
    $selstation = "select * from tbl_station where station_id = ".$eid;
    $selresult = $con->query($selstation);
    $seldata = $selresult->fetch_assoc();
    $station = $seldata['station_name'];
    $addr = $seldata['station_address'];
}
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>PAGE STATION</title>
</head>
<style>
    #stationGetInfo{
        border-spacing: 0 10px;
    }
    #stationInfoTable th, #stationInfoTable td {
        text-align: center;
        border: 1px solid black;
    }
</style>
<body>
<form id="Station" name="Station" method="post" action="">
<table id="stationGetInfo" width='300' align="center">
    <tr>
        <td><strong>Station Name</strong></td>
        <td><label for='txt_station'></label>
            <input type="text" name="txt_station" id="txt_station" value="<?php echo $station; ?>" required />
        </td>
    </tr>
    <tr>
        <td><strong>Station Address</strong></td>
        <td><label for='txt_addr'></label>
            <textarea name='txt_addr' rows='5' cols='30' required > <?php echo $addr ?></textarea></td>
    </tr>
    <tr>
        <td><strong>District</strong></td>
        <td><label for="sel_district"></label>
            <select name="sel_district" id="sel_district" onChange="getPlace(this.value)">
                <option value="">Select</option>
                <?php
                $selQry1 = "select * from tbl_district";
                $selresult1 = $con->query($selQry1);
                while($row = $selresult1->fetch_assoc()) {
                    echo "<option value='" . $row['district_id'] . "'" . ($row['district_id'] == $district_id ? " selected" : "") . ">" . $row['district_name'] . "</option>";
                }
                ?>
            </select>
            <input type="hidden" name="txt_eid" id="txt_eid" value="<?php echo $eid; ?>" />
        </td>
    </tr>
    <tr>
        <td><strong>Place</strong></d>
        <td><label for="sel_place"></label>
            <select name="sel_place" id="sel_place" required>
                <option value="">Select</option>
                <!-- Populate places via Ajax -->
                <?php
                //Populate places if an existing record is being edited
                if($eid != 0) {
                    $selQry2 = "select * from tbl_place where district_id = (select district_id from tbl_place where place_id = '$place_id')";
                    $selresult2 = $con->query($selQry2);
                    while($row2 = $selresult2->fetch_assoc()) {
                        ?>
                        <option value = "<?php echo $row2['place_id']; ?>" <?php if($row2['place_id'] == $place_id) echo 'selected'; ?>>
                            <?php echo $row2['place_name']; ?>
                        </option>
                        <?php
                    }
                }
                ?>
            </select>
        </td>
    </tr>
    <tr>
        <td colspan="2" align="center">
            <input type="submit" name="btn_submit" id="btn_submit" value="ADD" />
        </td>
    </tr>
</table> 
<p>&nbsp;</p>   
</form>

<table id="stationInfoTable" width="600" align="center" style="border-collapse: collapse; width: 50%">
    <tr>
        <th>SL NO</th>
        <th>STATION NAME</th>
        <th>STATION ADDRESS</th>
        <th>PLACE</th>
        <th>DISTRICT</th>
        <th>ACTION</th>
    </tr>
    <?php
    $selQry = "SELECT * from tbl_station s INNER JOIN tbl_place p ON p.place_id = s.place_id INNER JOIN tbl_district d ON d.district_id = p.district_id";
    $result = $con->query($selQry);
    $i = 0;
    while($row = $result->fetch_assoc()) {
        $i++;
        ?>
        <tr>
            <td><?php echo $i; ?> </td>
            <td><?php echo $row["station_name"]; ?> </td>
            <td><?php echo $row["station_address"]; ?> </td>
            <td><?php echo $row["place_name"]; ?> </td>
            <td><?php echo $row["district_name"] ?> </td>
            <td>
            <a href="station.php?sid=<?php echo $row["station_id"]; ?>" onclick="return confirm('Are you sure you want to delete this station?');">Delete | </a>
            <a href="Station.php?eid=<?php echo $row['station_id']; ?>">Edit | </a>
            </td>
        </tr>
        <?php
    } 
    ?>
</table>
</body>

<script src="../Assets/JQ/jQuery.js"></script>
<script>
function getPlace(did)
{

	$.ajax({
	url: "../Assets/AjaxPages/AjaxPlace.php?did="+did,
	  success: function(result){
		$("#sel_place").html(result);
	  }
	});
}
</script>
</html>
<?php
            include("Foot.php");
            ob_flush();
            ?>