<?php
include("../Assets/Connection/connection.php");
session_start();
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Untitled Document</title>
</head>

<body>
<form id="form1" name="form1" method="post" action="">
  <table width="200" border="1">
    <tr>
      <td>title</td>
      <td><label for="txt_title"></label>
      <input type="text" name="txt_title" id="txt_title" /></td>
    </tr>
    <tr>
      <td>complaint</td>
      <td><label for="txt_complaint"></label>
      <input type="text" name="txt_complaint" id="txt_complaint" /></td>
    </tr>
    <tr>
      <td colspan="2"  align="center"><input type="submit" name="txt_send" id="txt_send" value="send" /></td>
    </tr>
  </table>
  <p>&nbsp;</p>
  <table width="200" border="1">
  <tr>
    <td>sl.no</td>
    <td>title</td>
    <td>complaint</td>
    <td>reply</td>
    <td>Action</td>
  </tr>
  <?php
  $selQry="select * from tbl_complaint where rest_id=".$_SESSION['rid']." and user_id=''";
  $result=$con->query($selQry);
  $i=0;
  while($row=$result->fetch_assoc())
  { $i++;
    ?>
    <tr>
      <td><?php echo $i; ?></td>
      <td><?php echo $row["complaint_title"];?> </td>
      <td><?php echo $row["complaint_content"];?> </td>
      <td><?php 
      if($row["complaint_reply"]==""){
        echo "Admin hasn't reviewed your complaint";
      }
      else{
        echo $row["complaint_reply"]; 
      }
      ?> </td>
      <td>
        <!-- Delete -->
      </td>
    </tr>
     <?php 
  }
  ?>
 
</table>
</form>
</body>
</html>