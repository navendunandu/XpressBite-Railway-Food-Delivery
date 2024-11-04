<?php
include('../assets/connection/connection.php');
ob_start();
include("Head.php");

if(isset($_POST['btn_submit'])){
	$reply=$_POST['txt_reply2'];
	$insQry="update tbl_complaint set complaint_reply='".$reply."' where complaint_id=".$_GET['sid'];
	if($con->query($insQry))
	{
		?>
        <script>
		alert("Replied")
		window.location="ViewComplaint.php"
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
<form id="form1" name="form1" method="post" action="">
<table width="200" border="1">
  <tr>
    <td>Reply</td>
    <td><label for="txt_reply"></label>
      <textarea name="txt_reply2" id="txt_reply2" cols="45" rows="5"></textarea>
     
  </tr>
  <tr>
    <td colspan="2" align="center"><input type="submit" name="btn_submit"
    id="btn_submit" value="SEND" /></td>
    
  </tr>
  </table>
  </form>
</body>
</html>
<?php
            include("Foot.php");
            ob_flush();
            ?>
