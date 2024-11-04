<?php
include('../assets/connection/connection.php');
ob_start();
include("Head.php");
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Untitled Document</title>
</head>

<body>
<form>
<table width="200" border="1">
  <tr></tr>
  <tr>
  <td>SL.NO</td>
   
    <td>CONTENT</td>
    <td>DATE</td>
    <td>USER</td>
    <td>ACTION</td>
  </tr>
  <?PHP
  $i=0;
  $selQry="select * from tbl_complaint c inner join tbl_rest r on r.rest_id=c.rest_id where user_id!=''";
  $result=$con->query($selQry);
  while($row=$result->fetch_assoc())
  {
    
   $i++;
    ?>
  <tr>
    <td><?php echo $i;?></td>
    <td><?php echo $row["complaint_content"];?></td>
    <td><?php echo $row["complaint_date"];?></td>
    <td><?php echo $row["user_name"];?></td>
    
     <td>
      <?php
    if($row['complaint_reply']==""){
      ?>
      <a href="reply.php?sid=<?php echo $row["complaint_id"]?>">reply</a>
      <?php
    }
    else{
      echo $row['complaint_reply'];
    }
      ?>
     </td>
    
    
    
  </tr>
  <?php
  }
  ?>
  </table>
  
</form>
</body>
</html>
<?php
            include("Foot.php");
            ob_flush();
            ?>