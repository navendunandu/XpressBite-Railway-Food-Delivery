
<?php
include('../Assets/Connection/connection.php');
ob_start();
include("Head.php");
if(isset($_GET["cid"])) {
    $delQry = "delete from tbl_category where category_id=".$_GET["cid"];
    if($con->query($delQry)) {
        ?>
        <script>
        alert("Data Deleted...");
        window.location="category.php";
        </script>
        <?php
    }
}
if(isset($_POST['btn_submit'])){
	$category=$_POST['txt_category'];
	$insQry="insert into tbl_category(category_name)values('".$category."')";
	if($con->query($insQry))
	{
		?>
        <script>
		alert("data inserted..")
		window.location="category.php"
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

<body><body>
<form id="form1" name="form1" method="post" action="">
<table width="200" border="1">
  <tr>
    <td>category</td>
    <td><label for="txt_category"></label>
      <input type="text" name="txt_category" /></td>
  </tr>
  <tr>
    <td colspan="2" align="center"><input type="submit" name="btn_submit"
    id="btn_submit" value="ADD" /></td>
    
  </tr>
</table>
<p>&nbsp;</p>
<p>&nbsp;</p>
<table width="200" border="1">
  <tr>
    <td>sl.no</td>
    <td>category </td>
    <td>action</td>
  </tr>
  <?php
  $selQry="select * from tbl_category";
  $result=$con->query($selQry);
  $i=0;
  while($row=$result->fetch_assoc())
  { $i++;
    ?>
    <tr>
      <td><?php echo $i; ?></td>
      <td><?php echo $row["category_name"];?> </td>
      <td><p><a href="category.php?cid=<?php echo $row["category_id"]; ?>">Delete</a></p></td>
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