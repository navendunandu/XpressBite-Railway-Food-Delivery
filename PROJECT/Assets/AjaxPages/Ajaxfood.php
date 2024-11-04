<?php
include("../Connection/Connection.php");

    if (isset($_GET["action"])) {

        $sqlQry = "SELECT * FROM tbl_food f inner join tbl_rest r on f.rest_id=r.rest_id inner join tbl_category c on c.category_id=f.category_id where r.rest_id=".$_GET['rid'];
       
        if ($_GET["category"]!=null) {

            $category = $_GET["category"];

            $sqlQry = $sqlQry." AND c.category_id IN(".$category.")";
        }
       
		
		if ($_GET["name"]!=null) {

            $name = $_GET["name"];

            $sqlQry = $sqlQry." AND food_name LIKE '%".$name."%'";
        }

        if ($_GET["type"]!=null) {

            $type = $_GET["type"];

            $sqlQry = $sqlQry." AND food_type IN('".$type."')";
        }
        $resultS = $con->query($sqlQry);
        
       

        if ($resultS->num_rows > 0) {
            while ($rowS = $resultS->fetch_assoc()) {
?>

<div class="col-md-3 mb-2">
                            <div class="card-deck">
                                <div class="card border-secondary">
                                    <img src="../Assets/Files/Restaurant/<?php echo $rowS["food_photo"]; ?>" class="card-img-top" height="250">
                                    <div class="card-img-secondary">
                                        <h6  class="text-light bg-info text-center p-1"><?php echo $rowS["food_name"]; ?></h6>
                                    </div>
                                    <div class="card-body">
                                        <h4 class="card-title text-danger" align="center">
                                            Price : <?php echo $rowS["food_price"]; ?>/-
                                        </h4>
                                        <p align="center">
                                            <?php echo $rowS["category_name"]; ?><br>
                                        </p><p align="center">
                                            <?php echo $rowS["food_type"]; ?><br>
                                        </p>
                                        <a href="javascript:void(0)" onclick="addCart(<?php echo $rowS['food_id']; ?>)" class="btn btn-success btn-block">Add to Cart</a>
                                        
                                    </div>
                                </div>
                            </div>
                        </div>

<?php
            }
        } else {
             echo "<h4 align='center'>Products Not Found!!!!</h4>";
        }
    }

?>