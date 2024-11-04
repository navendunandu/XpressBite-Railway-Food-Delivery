<?php
include('../Assets/Connection/connection.php');
session_start();
if(isset($_POST['btn_submit'])){
  $photo = $_FILES['txt_photo']['name'];
  $temp = $_FILES['txt_photo']['tmp_name'];
  move_uploaded_file($temp,'../Assets/Files/Restaurant/'.$photo);
	$insQry="insert into tbl_food(food_name,food_price,food_photo,category_id,rest_id,food_desc,food_type)
  values('".$_POST['txt_name']."','".$_POST['txt_price']."','".$photo."','".$_POST['txt_category']."','".$_SESSION['rid']."','".$_POST['txt_description2']."','".$_POST['rad_type']."')";
	if($con->query($insQry))
	{
		?>
        <script>
		alert("data inserted..")
		window.location="food.php"
		</script>
      <?php
	}
}

if(isset($_GET['did'])) {
  $did = $_GET['did'];
  $delQry="delete from tbl_food where food_id = ".$did;
  if($con->query($delQry)) {
    header("location:food.php");
    exit();
  }
}
?>	
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Untitled Document</title>
</head>
<style>
  body{
    background-image:url(../Assets/Templates/Main/assets/img/food.jpeg);
    background-size:cover;
    color:white;
  }
  a{
    color:yellow;
  }
</style>
<body>
<form id="form1" name="form1" method="post" action="" enctype="multipart/form-data">
<table width="200" border="1">
 <tr>
    <td>name</td>
    <td><label for="txt_name"></label>
      <input type="text" name="txt_name" /></td>
  </tr>
  <tr>
    <td>price</td>
  <td><label for="txt_price"></label>
      <input type="text" name="txt_price" /></td>  
  </tr>
  <tr>
    <td>Type</td>
  <td><label for="txt_price"></label>
      <input type="radio" name="rad_type" value="VEG" />&nbsp;Veg&nbsp;<input type="radio" name="rad_type" value="NON" />&nbsp;Non-Veg</td>  
  </tr>
  
  <tr>
    <td>photo</td>
    <td><label for="txt_photo"></label>
      <input type="file" name="txt_photo" id="txt_photo2" />
  </tr>
   <tr>
    <td>description</td>
    <td><label for="txt_description"></label>
      <textarea name="txt_description2" id="txt_description" cols="21" rows="5"></textarea></td>
  
  </tr>
  <tr>
    <td>category</td>
    <td><label for="txt_category"></label>
      <select name="txt_category">
      <option value="">Select Category</option>
      <?php
	  $selCat="SELECT * from tbl_category";
	  $resCat=$con->query($selCat);
	  while($dataCat=$resCat->fetch_assoc()){
		  ?>
          <option value="<?php echo $dataCat['category_id'] ?>"><?php echo $dataCat['category_name'] ?></option>
          <?php
	  }
	  ?>
      </select></td>
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
    <td>name</td>
    <td>price</td>
    <td>photo</td>
    <td>description</td>
    <td>action</td>
  </tr>
  <?php
  $selQry="select * from tbl_food where rest_id=".$_SESSION['rid'];
  $result=$con->query($selQry);
  $i=0;
  while($row=$result->fetch_assoc())
  { $i++;
    ?>
    <tr>
      <td><?php echo $i; ?></td>
      <td><?php echo $row["food_name"];?> </td>
      <td><?php echo $row["food_price"];?> </td>
      <td><?php echo $row["food_photo"];?> </td>
      <td><?php echo $row["food_desc"];?> </td>
      <td><a href="food.php?did=<?php echo $row['food_id']; ?>">DELETE</a></td>
    </tr>
     <?php 
  }
  ?>
 
</table>
</form>
</body>
</body>
</html>