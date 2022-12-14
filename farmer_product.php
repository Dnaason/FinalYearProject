<?php

@include 'config.php';
define("ROW_PER_PAGE",5);

session_start();

$farmer_id = $_SESSION['farmer_id'];

if(!isset($farmer_id)){
   header('location:login.php');
};

if(isset($_POST['add_product'])){

   $name = $_POST['name'];
   $name = filter_var($name, FILTER_SANITIZE_STRING);
   $price = $_POST['price'];
   $price = filter_var($price, FILTER_SANITIZE_STRING);
   $category = $_POST['category'];
   $category = filter_var($category, FILTER_SANITIZE_STRING);
   $quantity = $_POST['quantity'];
   $quantity = filter_var($quantity, FILTER_SANITIZE_STRING);
   $details = $_POST['details'];
   $details = filter_var($details, FILTER_SANITIZE_STRING);

   $image = $_FILES['image']['name'];
   $image = filter_var($image, FILTER_SANITIZE_STRING);
   $image_size = $_FILES['image']['size'];
   $image_tmp_name = $_FILES['image']['tmp_name'];
   $image_folder = 'uploaded_img/'.$image;

   $select_products = $conn->prepare("SELECT * FROM `products` WHERE name = ?");
   $select_products->execute([$name]);

   if($select_products->rowCount() > 0){
      $message[] = 'product name already exist!';
   }else{

      $insert_products = $conn->prepare("INSERT INTO `products`(farmer_id, name, category, quantity, details, price, image) VALUES(?,?,?,?,?,?,?)");
      $insert_products->execute([$farmer_id, $name, $category, $quantity, $details, $price, $image]);

      if($insert_products){
         if($image_size > 2000000){
            $message[] = 'image size is too large!';
         }else{
            move_uploaded_file($image_tmp_name, $image_folder);
            $message[] = 'new product added!';
         }

      }

   }

};

if(isset($_GET['delete'])){

   $delete_id = $_GET['delete'];
   $select_delete_image = $conn->prepare("SELECT image FROM `products` WHERE id = ?");
   $select_delete_image->execute([$delete_id]);
   $fetch_delete_image = $select_delete_image->fetch(PDO::FETCH_ASSOC);
   unlink('uploaded_img/'.$fetch_delete_image['image']);
   $delete_products = $conn->prepare("DELETE FROM `products` WHERE id = ?");
   $delete_products->execute([$delete_id]);
   $delete_wishlist = $conn->prepare("DELETE FROM `wishlist` WHERE pid = ?");
   $delete_wishlist->execute([$delete_id]);
   $delete_cart = $conn->prepare("DELETE FROM `cart` WHERE pid = ?");
   $delete_cart->execute([$delete_id]);
   header('location:admin_products.php');


}

?>

<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>products</title>

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
   
<?php include 'farmer_header.php'; ?>

<section class="add-products">

   <h1 class="title">add new product</h1>

   <form action="" method="POST" enctype="multipart/form-data">
      <div class="flex">
         <div class="inputBox">
         <input type="text" name="name" class="box" required placeholder="enter product name">
         <select name="category" class="box" required>
            <option value="" selected disabled>select category</option>
               <option value="Food Crops">Food Crops</option>
               <option value="Cash Crops">Cash Crops</option>
         </select>
         </div>
         <div class="inputBox">
         <input type="number" min="0" name="price" class="box" required placeholder="enter product price">
         <input type="number" min="0" name="quantity" class="box" required placeholder="enter product quantity">
         </div>
      </div>
      <input type="file" name="image" required class="box" accept="image/jpg, image/jpeg, image/png">
      <textarea name="details" class="box" required placeholder="enter product details" cols="30" rows="10"></textarea>
      <input type="submit" class="btn" value="add product" name="add_product">
   </form>

</section>

<section class="show-products">

   <h1 class="title">products added</h1>

   <table class="table">
         <thead>
            <tr>
               <th>image</th>
               <th>product_name</th>
               <th>category</th>
               <th>quantity</th>
               <th>details</th>
               <th>price</th>
               <th>option</th>
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
               
               $query0="SELECT * FROM `products` WHERE farmer_id = $farmer_id";
               $show_products0 = $conn->prepare($query0);
               $show_products0->execute();
               $results = $show_products0->rowCount();
         
         $query="SELECT * FROM `products` WHERE farmer_id = $farmer_id ".$limit;
         
                  $show_products = $conn->prepare($query);
                  $show_products->execute();
            $show_products->execute();
            if($show_products->rowCount() > 0){
            while($fetch_products = $show_products->fetch(PDO::FETCH_ASSOC)){  
         ?>

               <tbody>
                  <tr>
                     <td data-label="image"> <img src="uploaded_img/<?= $fetch_products['image']; ?>" style="width: 100px;height: 70px;" alt=""></span> </td>
                     <td data-label="product_name"><span><?= $fetch_products['name']; ?></span></td>
                     <td data-label="category"><span><?= $fetch_products['category']; ?></span></td>
                     <td data-label="quantity"><span><?= $fetch_products['quantity']; ?></span></td>
                     <td data-label="details"><span><?= $fetch_products['details']; ?></span></td>
                     <td data-label="price"><span><?= $fetch_products['price']; ?></span></td>
                     <td data-label="Option" class="box">
                           <div class="flex-btn">
                           <a href="farmer_update_product.php?update=<?= $fetch_products['id']; ?>" class="option-btn">update</a>
                           <a href="farmer_product.php?delete=<?= $fetch_products['id']; ?>" class="delete-btn" onclick="return confirm('delete this product?');">delete</a>
                           </div>
                     </td>
                  </tr>
               </tbody>
   <?php
      }
   }else{
      echo '<p class="empty">now products added yet!</p>';
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