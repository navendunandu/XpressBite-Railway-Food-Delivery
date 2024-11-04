<?php
include('../Assets/Connection/connection.php');
session_start();
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Untitled Document</title>
</head>

<body>
<table cellpadding="10" border="1">
  <tr>
    <td>sl.no</td>
    <td>booking amount</td>
    <td>to date</td>
    <td>discount amount</td>
    <td>station</td>
    <td>platform</td>
    <td>Coach No</td>
    <td>action</td>
    
  </tr>
  <?php
  $selQry="select * from tbl_booking b inner join tbl_user u on u.user_id=b.user_id inner join tbl_cart c on c.booking_id=b.booking_id inner join tbl_food p on p.food_id=c.food_id inner join tbl_station s on b.station_id=s.station_id  where p.rest_id='".$_SESSION['rid']."' group by c.booking_id ";
  $result=$con->query($selQry);
  $i=0;
  while($row=$result->fetch_assoc())
  { $i++;
    ?>
    <tr>
      <td><?php echo $i; ?></td>
      <td><?php echo $row["booking_amount"];?> </td>
      <td><?php echo $row["booking_fordate"];?> </td>
      <td><?php echo $row["discount_amount"];?> </td>
       <td><?php echo $row["station_name"];?> </td>
        <td><?php echo $row["pnr_no"];?> </td>
        <td><?php echo $row["coach_no"];?> </td>
         <td><a href="viewbookproduct.php?bid=<?php echo $row["booking_id"]?>">VIEW PRODUCT</a></td>
    </tr>
     <?php 
  }
  ?>
 
</table>
</body>
</html>