<?php
include('../Assets/Connection/connection.php');
if(isset($_GET['id'])){
  $upd="update tbl_cart set cart_status='".$_GET['st']."' where cart_id=".$_GET['id'];
  if($con->query($upd)){
    ?>
    <script>
      alert("Updated");
      window.location="viewbookproduct.php?bid=<?php echo $_GET['bid'] ?>";
    </script>
    <?php
  }
}

if(isset($_GET['uid'])){
  $upd="update tbl_cart set cart_status='".$_GET['st']."' where booking_id=".$_GET['uid'];
  if($con->query($upd)){
    ?>
    <script>
      alert("Updated");
      window.location="viewbookproduct.php?bid=<?php echo $_GET['uid'] ?>"
    </script>
    <?php
  }
}
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
    <td>product</td>
    <td>quantity</td>
    <td>price</td>
    <td>status</td>
    <td>action</td>
  </tr>
  <?php
  $selQry="select * from tbl_cart c inner join tbl_food f on c.food_id=f.food_id where booking_id=".$_GET["bid"];
  $result=$con->query($selQry);
  $i=0;
  $j=0;
  $k=0;
  while($row=$result->fetch_assoc())
  { $i++;
    ?>
    <tr>
      <td><?php echo $i; ?></td>
      <td><?php echo $row["food_name"];?> </td>
      <td><?php echo $row["cart_qty"];?> </td>
      <td><?php echo $row['cart_qty']*$row['food_price'] ?> </td>
      <td><?php
        if($row['cart_status']==1){
          
          echo "New Order";
        }
        else if($row['cart_status']==2){
          $j++;
          echo "Order Prepared";
        }
        else if($row['cart_status']==3){
          $k++;
          echo "Out for Delivery";
        }
        else if($row['cart_status']==4){
          echo "Completed";
        }
      ?> </td>
      <td>
      <?php
        if($row['cart_status']==1){
          ?>
          <a href="viewbookproduct.php?id=<?php echo $row['cart_id'] ?>&st=2&bid=<?php echo $_GET['bid'] ?>">Order Prepared</a>
          <?php
        }
      ?> 
      </td>
    </tr>
     <?php 
  }
  ?>
  <tr><td colspan="6" align="right">
    <?php
    if($i==$j){
      ?>
      <a href="viewbookproduct.php?st=3&uid=<?php echo $_GET['bid'] ?>">Out for Delivery</a>
      <?php
    }
    else if($i==$k){
      ?>
      <a href="viewbookproduct.php?st=4&uid=<?php echo $_GET['bid'] ?>">Delivery Completed</a>
      <?php
    }
    ?>
  </td></tr>
 
</table>
</body>
</html>