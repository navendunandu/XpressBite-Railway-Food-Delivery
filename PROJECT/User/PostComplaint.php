<?php
session_start();
ob_start();
include("Head.php");
include("../Assets/Connection/Connection.php");
$id="";
$title="";
$content="";
$eid=0;
if(isset($_POST["btn_submit"]))
{
	$id=$_SESSION["uid"];
	$title=$_POST["txt_title"];
	$content=$_POST["txt_content"];
	$insQry="insert into tbl_complaint(complaint_title,complaint_content,user_id,rest_id) values('".$title."','".$content."','".$id."','".$_GET['id']."')";
	
		if($con->query($insQry))
		{
			?>
            <script>
                alert("Inserted")
                window.location="PostComplaint.php?id=<?php echo $_GET['id'] ?>";
            </script>
            <?php
		}

}

if(isset($_GET["did"]))
{
	$did=$_GET["did"];
	$delQry="delete from tbl_complaint where complaint_id=".$did;
	if($Con->query($delQry))
	{
		?>
            <script>
                alert("Inserted")
                window.location="PostComplaint.php?id=<?php echo $_GET['did'] ?>";
            </script>
            <?php
	}
}

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>COMPLAIN</title>
</head>

<body>
<form id="form1" name="form1" method="post" action="">
  <table width="200" border="1">
    <tr>
      <td>Title:</td>
      <td><label for="txt_title"></label>
      <input value="<?php echo $title; ?>" type="text" name="txt_title" id="txt_title" required /></td>
    </tr>
    <tr>
      <td>Content:</td>
      <td><label for="txt_content"></label>
      <textarea value="<?php echo $content; ?>" name="txt_content" id="txt_content" cols="45" rows="5" required></textarea>
      <input type="hidden" value="<?php echo $eid;?>" name="txt_eid" id="txt_eid" />
</td>
    </tr>
    <tr>
      <td colspan="2"><div align="center">
        <input type="submit" name="btn_submit" id="btn_submit" value="Submit" />
      </div></td>
    </tr>
  </table>
</form>
<br />
<table width="200" border="1">
  <tr>
    <td>SlNo.</td>
    <td>Title</td>
    <td>Content</td>
    <td>Reply</td>
    <td>Action</td>
  </tr>
  <?php
	    $seluser="select * from tbl_complaint where user_id=".$_SESSION['uid'];
		$resuser=$con->query($seluser);
		$i=0;
		while($data=$resuser->fetch_assoc())
		{
		$i++;	
	  ?>
      <tr>
        <td><?php echo $i; ?></td>
        <td><?php echo $data["complaint_title"]; ?></td>
        <td><?php echo $data["complaint_content"]; ?></td>
        <td><?php echo $data["complaint_reply"]; ?></td>

        <td><a href="PostComplaint.php?did=<?php echo $data["complaint_id"];?>">Delete</a>
        </td>
      </tr>
      <?php
		}
	?>
</table>
</body>
</html>
<?php
include("Foot.php");
ob_flush();
?>