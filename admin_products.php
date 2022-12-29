<?php

@include 'config.php';
define("ROW_PER_PAGE",3);

session_start();

$admin_id = $_SESSION['admin_id'];

if(!isset($admin_id)){
   header('location:login.php');
};

if(isset($_POST['update_products'])){

   $pid = $_POST['pid'];
   $update_status = $_POST['update_status'];
   $update_status = filter_var($update_status, FILTER_SANITIZE_STRING);
   $update_products = $conn->prepare("UPDATE `products` SET status = ? WHERE id = ?");
   $update_products->execute([$update_status, $pid]);
   $message[] = 'status has been updated!';

};

if(isset($_GET['delete'])){

   $delete_id = $_GET['delete'];
   $delete_products = $conn->prepare("DELETE FROM `products` WHERE id = ?");
   $delete_products->execute([$delete_id]);
   header('location:admin_products.php');

}

?>

<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>Products</title>

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

   <h1 class="title">Products From Farmer</h1>
   <table class="table">
     <thead>
     	<tr>
     	 <th>farmer_id</th>
     	 <th>product_name</th>
     	 <th>category</th>
     	 <th>quantity</th>
     	 <th>details</th>
     	 <th>price</th>
     	 <th>Products_status</th>
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
      
      $query0="SELECT * FROM `products` ORDER BY `id` DESC";
      $select_products0 = $conn->prepare($query0);
      $select_products0->execute();
      $results = $select_products0->rowCount();
      
      $query="SELECT * FROM `products` ORDER BY `id` DESC ".$limit;
      
               $select_products = $conn->prepare($query);
               $select_products->execute();
         if($select_products->rowCount() > 0){
            while($fetch_products = $select_products->fetch(PDO::FETCH_ASSOC)){
      ?>
      
      <tbody>
     	  <tr>
     	  	  <td data-label="farmer_id"><span><?= $fetch_products['farmer_id']; ?></span> </td>
     	  	  <td data-label="product_name"><span><?= $fetch_products['name']; ?></span></td>
     	  	  <td data-label="category"><span><?= $fetch_products['category']; ?></span></td>
     	  	  <td data-label="quantity"><span><?= $fetch_products['quantity']; ?></span></td>
     	  	  <td data-label="details"><span><?= $fetch_products['details']; ?></span></td>
     	  	  <td data-label="price"><span><?= $fetch_products['price']; ?></span></td>
     	  	  <td data-label="Option" class="box">
               <form action="" method="POST">
            <input type="hidden" name="pid" value="<?= $fetch_products['id']; ?>">
            <select name="update_status" class="drop-down">
               <option value="" selected disabled><?= $fetch_products['status']; ?></option>
               <option value="active">active</option>
               <option value="disactive">disactive</option>
            </select>
            <div class="flex-btn">
               <input type="submit" name="update_products" class="option-btn" value="update">
               <a href="admin_products.php?delete=<?= $fetch_products['id']; ?>" class="delete-btn" onclick="return confirm('delete this order?');">delete</a>
            </div>
         </form>
           </td>
     	  </tr>
     </tbody>

      <?php
         }
      }else{
         echo '<p class="empty">no products posted yet!</p>';
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