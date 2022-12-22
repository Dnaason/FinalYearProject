<?php

@include 'config.php';

session_start();

$admin_id = $_SESSION['admin_id'];

if(!isset($admin_id)){
   header('location:login.php');
};

if(isset($_POST['update_order'])){

   $order_id = $_POST['order_id'];
   $update_payment = $_POST['update_payment'];
   $update_payment = filter_var($update_payment, FILTER_SANITIZE_STRING);
   $update_orders = $conn->prepare("UPDATE `orders` SET payment_status = ? WHERE id = ?");
   $update_orders->execute([$update_payment, $order_id]);
   $message[] = 'payment has been updated!';

};

if(isset($_GET['delete'])){

   $delete_id = $_GET['delete'];
   $delete_orders = $conn->prepare("DELETE FROM `orders` WHERE id = ?");
   $delete_orders->execute([$delete_id]);
   header('location:admin_orders.php');

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
   <link rel="stylesheet" href="css/admin_style.css">

</head>
<body>
   
<?php include 'admin_header.php'; ?>

<section class="placed-orders">

   <h1 class="title">placed orders</h1>
   <table class="table">
     <thead>
     	<tr>
     	 <th>user_id</th>
     	 <th>placed_on</th>
     	 <th>name</th>
     	 <th>email</th>
     	 <th>number</th>
     	 <th>address</th>
     	 <th>total_products</th>
     	 <th>total price</th>
     	 <th>payment method</th>
     	 <th>Option</th>
     	</tr>
     </thead>
      <?php
         $select_pendings = $conn->prepare("SELECT * FROM `orders` WHERE payment_status = ? ORDER BY `placed_on` DESC");
         $select_pendings->execute(['pending']);
         if($select_pendings->rowCount() > 0){
            while($fetch_pendings = $select_pendings->fetch(PDO::FETCH_ASSOC)){
      ?>
      
      <tbody>
     	  <tr>
     	  	  <td data-label="user id"><span><?= $fetch_pendings['user_id']; ?></span> </td>
     	  	  <td data-label="placed on"><span><?= $fetch_pendings['placed_on']; ?></span></td>
     	  	  <td data-label="name"><span><?= $fetch_pendings['name']; ?></span></td>
     	  	  <td data-label="email"><span><?= $fetch_pendings['email']; ?></span></td>
     	  	  <td data-label="number"><span><?= $fetch_pendings['number']; ?></span></td>
     	  	  <td data-label="address"><span><?= $fetch_pendings['address']; ?></span></td>
     	  	  <td data-label="total products"><span><?= $fetch_pendings['total_products']; ?></span></td>
     	  	  <td data-label="total price"><span>Rfw<?= $fetch_pendings['total_price']; ?>/-</span></td>
     	  	  <td data-label="payment method"><span><?= $fetch_pendings['method']; ?></span></td>
     	  	  <td data-label="Option" class="box">
               <form action="" method="POST">
            <input type="hidden" name="order_id" value="<?= $fetch_pendings['id']; ?>">
            <select name="update_payment" class="drop-down">
               <option value="" selected disabled><?= $fetch_pendings['payment_status']; ?></option>
               <option value="pending">pending</option>
               <option value="completed">completed</option>
            </select>
            <div class="flex-btn">
               <input type="submit" name="update_order" class="option-btn" value="udate">
               <a href="admin_orders.php" class="delete-btn" onclick="return confirm('delete this order?');">delete</a>
            </div>
         </form>
           </td>
     	  </tr>
     </tbody>

      <?php
         }
      }else{
         echo '<p class="empty">no pending orders yet!</p>';
      }
      ?>
   </table>
</section>



<script src="js/script.js"></script>

</body>
</html>