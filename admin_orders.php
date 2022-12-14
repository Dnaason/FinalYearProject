<?php

@include 'config.php';
define("ROW_PER_PAGE",3);

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
   <style>
      .pagination{
   display: flex;
   justify-content: center;
   padding: 10px;
   gap: 1px;

}
.pagination a{
   padding: 8px;
   font-size: 15px;
   border: 0.5px solid #ddd;
}
   </style>
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


$page = 1;
$start=0;
if(!empty($_GET["page"])) {
   $page = $_GET["page"];
   $start=($page-1) * ROW_PER_PAGE;
}
$limit=" limit " . $start . "," . ROW_PER_PAGE;

$query0="SELECT * FROM `orders` ORDER BY `placed_on` DESC";
$select_orders0 = $conn->prepare($query0);
$select_orders0->execute();
$results = $select_orders0->rowCount();

$query="SELECT * FROM `orders` ORDER BY `placed_on` DESC ".$limit;

         $select_orders = $conn->prepare($query);
         $select_orders->execute();
         if($select_orders->rowCount() > 0){
            while($fetch_orders = $select_orders->fetch(PDO::FETCH_ASSOC)){ 
      ?>
      
      
      <tbody>
     	  <tr>
     	  	  <td data-label="user id"><span><?= $fetch_orders['user_id']; ?></span> </td>
     	  	  <td data-label="placed on"><span><?= $fetch_orders['placed_on']; ?></span></td>
     	  	  <td data-label="name"><span><?= $fetch_orders['name']; ?></span></td>
     	  	  <td data-label="email"><span><?= $fetch_orders['email']; ?></span></td>
     	  	  <td data-label="number"><span><?= $fetch_orders['number']; ?></span></td>
     	  	  <td data-label="address"><span><?= $fetch_orders['address']; ?></span></td>
     	  	  <td data-label="total products"><span><?= $fetch_orders['total_products']; ?></span></td>
     	  	  <td data-label="total price"><span>Rfw<?= $fetch_orders['total_price']; ?>/-</span></td>
     	  	  <td data-label="payment method"><span><?= $fetch_orders['method']; ?></span></td>
     	  	  <td data-label="Option" class="box">
               <form action="" method="POST">
            <input type="hidden" name="order_id" value="<?= $fetch_orders['id']; ?>">
            <select name="update_payment" class="drop-down">
               <option value="" selected disabled><?= $fetch_orders['payment_status']; ?></option>
               <option value="pending">pending</option>
               <option value="completed">completed</option>
            </select>
            <div class="flex-btn">
               <input type="submit" name="update_order" class="option-btn" value="udate">
               <a href="admin_orders.php?delete=<?= $fetch_orders['id']; ?>" class="delete-btn" onclick="return confirm('delete this order?');">delete</a>
            </div>
         </form>
           </td>
     	  </tr>
     </tbody>

      <?php
         }
      }else{
         echo '<p class="empty">no orders placed yet!</p>';
      }
      ?>
   </table>
   <div class="pagination">

<?php 


for($i=1; $i <= ceil(($results/ROW_PER_PAGE)) ; $i++):  ?>
<a href="?page=<?php echo$i;  ?>"> <?php echo $i;  ?></a>
<?php
endfor;
?>
</div>
</section>












<script src="js/script.js"></script>

</body>
</html>