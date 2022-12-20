<?php

@include 'config.php';

session_start();

$farmer_id = $_SESSION['farmer_id'];

if(!isset($farmer_id)){
   header('location:login.php');
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>Farmer page</title>

   <!-- font awesome cdn link  -->
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">

   <!-- custom css file link  -->
   <link rel="stylesheet" href="css/admin_style.css">

</head>
<body>
   
<?php include 'farmer_header.php'; ?>

<section class="dashboard">

   <h1 class="title">dashboard</h1>

   <div class="box-container">

      <div class="box">
      <?php
         $total_pendings = 0;
         $select_pendings = $conn->prepare("SELECT sum(price) as sum FROM `order_products` WHERE status = ? AND farmer_id= ?");
         $select_pendings->execute(['pending',$farmer_id]);
         while($fetch_pendings = $select_pendings->fetch(PDO::FETCH_ASSOC)){
            $total_pendings += $fetch_pendings['sum'];
         };
      ?>
      <h3>Rwf <?= $total_pendings; ?></h3>
      <p>total pendings</p>
      <a href="farmer_order.php" class="btn">see orders</a>
      </div>

      <div class="box">
      <?php
         $total_completed = 0;
         $select_completed = $conn->prepare("SELECT sum(price) as sum FROM `order_products` WHERE status = ? AND farmer_id= ?");
         $select_completed->execute(['completed',$farmer_id]);
         while($fetch_completed = $select_completed->fetch(PDO::FETCH_ASSOC)){
            $total_completed += $fetch_completed['sum'];
         };
      ?>
      <h3>Rwf <?= $total_completed; ?></h3>
      <p>completed orders</p>
      <a href="farmer_order.php" class="btn">see orders</a>
      </div>

      <div class="box">
      <?php
         $select_orders = $conn->prepare("SELECT DISTINCT order_id FROM `order_products` WHERE farmer_id= ?");
         $select_orders->execute([$farmer_id]);
         $number_of_orders = $select_orders->rowCount();
      ?>
      <h3><?= $number_of_orders; ?></h3>
      <p>orders placed</p>
      <a href="farmer_order.php" class="btn">see orders</a>
      </div>

      <div class="box">
      <?php
         $select_products = $conn->prepare("SELECT * FROM `products`");
         $select_products->execute();
         $number_of_products = $select_products->rowCount();
      ?>
      <h3><?= $number_of_products; ?></h3>
      <p>products added</p>
      <a href="farmer_product.php" class="btn">see products</a>
      </div>

   </div>

</section>


<script src="js/script.js"></script>

</body>
</html>