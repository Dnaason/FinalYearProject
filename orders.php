<?php

@include 'config.php';

session_start();

$user_id = $_SESSION['user_id'];

if(!isset($user_id)){
   header('location:login.php');
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>orders</title>

   <!-- font awesome cdn link  -->
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">

   <!-- custom css file link  -->
   <link rel="stylesheet" href="css/style.css">

</head>
<body>
   
<?php include 'header.php'; ?>

<section class="placed-orders">

   <h1 class="title">placed orders</h1>
   <table class="table">
      <thead>
         <tr>
         <th>placed_on</th>
         <th>name</th>
         <th>email</th>
         <th>number</th>
         <th>address</th>
         <th>payment method</th>
         <th>your_orders</th>
         <th>total price</th>
         <th>Option</th>
         </tr>
      </thead>

      <?php
         $select_orders = $conn->prepare("SELECT * FROM `orders` WHERE user_id = ?");
         $select_orders->execute([$user_id]);
         if($select_orders->rowCount() > 0){
            while($fetch_orders = $select_orders->fetch(PDO::FETCH_ASSOC)){ 
      ?>
      <tbody>
         <tr>
            <td data-label="placed_on"><span><?= $fetch_orders['placed_on']; ?></span></td>
            <td data-label="name"><span><?= $fetch_orders['name']; ?></span></td>
            <td data-label="number"><span><?= $fetch_orders['number']; ?></span></td>
            <td data-label="email"><span><?= $fetch_orders['email']; ?></span></td>
            <td data-label="address"><span><?= $fetch_orders['address']; ?></span></td>
            <td data-label="placed_on"><span><?= $fetch_orders['method']; ?></span></td>
            <td data-label="placed_on"><span><?= $fetch_orders['total_products']; ?></span></td>
            <td data-label="placed_on"><span>$<?= $fetch_orders['total_price']; ?>/-</span></td>
            <td data-label="placed_on"><span style="color:<?php if($fetch_orders['payment_status'] == 'pending'){ echo 'red'; }else{ echo 'green'; }; ?>"><?= $fetch_orders['payment_status']; ?></span></td>
         </tr>
      </tbody>
      <?php
         }
      }else{
         echo '<p class="empty">no orders placed yet!</p>';
      }
      ?>

   </table>

</section>









<?php include 'footer.php'; ?>

<script src="js/script.js"></script>

</body>
</html>