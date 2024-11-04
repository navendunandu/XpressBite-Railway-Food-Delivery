<?php
include("../Assets/Connection/connection.php");

ob_start();
include('Head.php');
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <br>
    <br>
    <br>
    <br>
    <br>
    <br>
    <div class="container my-5">
    <h3 class="text-center text-white mb-4">My Cart</h3>
    <table class="table table-dark table-hover table-bordered text-center">
        <thead>
            <tr class="bg-secondary">
                <th scope="col">Sl.No</th>
                <th scope="col">Image</th>
                <th scope="col">Food</th>
                <th scope="col">Price</th>
                <th scope="col">Quantity</th>
                <th scope="col">Total</th>
                <th scope="col">Status</th>
                <th scope="col">Action</th>
            </tr>
        </thead>
        <tbody>
            <?php
            $qry="SELECT * FROM tbl_booking b 
                  INNER JOIN tbl_cart c ON c.booking_id=b.booking_id 
                  INNER JOIN tbl_food p ON p.food_id=c.food_id 
                  INNER JOIN tbl_rest r ON r.rest_id=p.rest_id 
                  WHERE user_id=".$_SESSION['uid'];
            $res=$con->query($qry);
            $i=0;
            while($data=$res->fetch_assoc()){
                $i++;
            ?>
            <tr>
                <td><?php echo $i; ?></td>
                <td><img src="../Assets/Files/Food/<?php echo $data['food_photo']; ?>" alt="Food Image" class="img-fluid" style="width: 100px; height: 100px;"></td>
                <td><?php echo $data['food_name']; ?></td>
                <td><?php echo $data['food_price']; ?></td>
                <td><?php echo $data['cart_qty']; ?></td>
                <td><?php echo $data['cart_qty'] * $data['food_price']; ?></td>
                <td>
                    <?php 
                    if($data['cart_status'] == 1) echo "New Order";
                    else if($data['cart_status'] == 2) echo "Order Prepared";
                    else if($data['cart_status'] == 3) echo "Out for Delivery";
                    else if($data['cart_status'] == 4) echo "Completed";
                    ?>
                </td>
                <td>
                    <?php if($data['cart_status'] == 4) { ?>
                    <a href="Rating.php?id=<?php echo $data['food_id']; ?>" class="btn btn-success btn-sm">Rating</a>
                    <a href="PostComplaint.php?id=<?php echo $data['rest_id']; ?>" class="btn btn-warning btn-sm">Post Complaint</a>
                    <?php } ?>
                </td>
            </tr>
            <?php } ?>
        </tbody>
    </table>
</div>
</body>
<?php
include('Foot.php');
ob_flush();
?>
</html>