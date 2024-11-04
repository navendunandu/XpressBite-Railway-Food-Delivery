<option value="">Select Station</option>
<?php
include("../Connection/Connection.php");
if(isset($_GET['pid'])){
    $sel="select * from tbl_station s inner join tbl_place p on p.place_id=s.place_id where district_id=".$_GET['pid'];

}
else{
$sel="select * from tbl_station where place_id=".$_GET['id'];
}
$res=$con->query($sel);
while($data=$res->fetch_assoc()){
    if(isset($_GET['pid'])){
        $id=$data['place_id'];
    }else{
        $id=$data['station_id'];
    }
?>
<option value="<?php echo $id ?>"><?php echo $data['station_name'] ?></option>
<?php
}
?>