<?php

@include 'config.php';

session_start();

$user_id = $_SESSION['user_id'];
$orderId=0;

if (!isset($user_id)) {
   header('location:login.php');
};

if (isset($_POST['order'])) {

   $name = $_POST['name'];
   $name = filter_var($name, FILTER_SANITIZE_STRING);
   $number = $_POST['number'];
   $number = filter_var($number, FILTER_SANITIZE_STRING);
   $email = $_POST['email'];
   $email = filter_var($email, FILTER_SANITIZE_STRING);
   $method = $_POST['method'];
   $method = filter_var($method, FILTER_SANITIZE_STRING);
   $address = 'flat no. ' . $_POST['flat'] . ' ' . $_POST['street'] . ' ' . $_POST['city'] . ' ' . $_POST['state'] . ' ' . $_POST['country'] . ' - ' . $_POST['pin_code'];
   $address = filter_var($address, FILTER_SANITIZE_STRING);
   $placed_on = date('d-M-Y');

   $cart_total = 0;
   $cart_products[] = '';

   $cart_query = $conn->prepare("SELECT * FROM `cart` WHERE user_id = ?");
   $cart_query->execute([$user_id]);
   $products_array = [];
   if ($cart_query->rowCount() > 0) {
      while ($cart_item = $cart_query->fetch(PDO::FETCH_ASSOC)) {
         $cart_products[] = $cart_item['name'] . ' ( ' . $cart_item['quantity'] . ' )';
         $sub_total = ($cart_item['price'] * $cart_item['quantity']);
         $quantity = ($cart_item['quantity']);
         $pid = ($cart_item['pid']);
         array_push($products_array, ['pid' => $pid, 'tot' => $sub_total]);
         $cart_total += $sub_total;
         $updt = $conn->prepare("UPDATE `products` SET quantity =quantity - '$quantity'  WHERE id ='$pid'");
         $updt->execute();
      };
   };

   $total_products = implode(', ', $cart_products);

   $order_query = $conn->prepare("SELECT * FROM `orders` WHERE name = ? AND number = ? AND email = ? AND method = ? AND address = ? AND total_products = ? AND total_price = ?");
   $order_query->execute([$name, $number, $email, $method, $address, $total_products, $cart_total]);

   if ($cart_total == 0) {
      $message[] = 'your cart is empty';
   } elseif ($order_query->rowCount() > 0) {
      $message[] = 'order placed already!';
   } else {
      $insert_order = $conn->prepare("INSERT INTO `orders`(user_id, name, number, email, method, address, total_products, total_price, placed_on) VALUES(?,?,?,?,?,?,?,?,?)");
      $insert_order->execute([$user_id, $name, $number, $email, $method, $address, $total_products, $cart_total, $placed_on]);
      $orderId = $conn->lastInsertId();
      foreach ($products_array as $orderInfo) {
         $product_query = $conn->prepare("SELECT * FROM `products` WHERE id = ?");
         $product_query->execute([$orderInfo['pid']]);
         $farmer_id = 0;
         while ($productData = $product_query->fetch(PDO::FETCH_ASSOC)) {
            $farmer_id = $productData['farmer_id'];


      }

         // ###############3

         $create_order = $conn->prepare("INSERT INTO `order_products`(price,pid,order_id,farmer_id) VALUES(?,?,?,?)");
         $create_order->execute([$orderInfo['tot'], $orderInfo['pid'], $orderId, $farmer_id]);


         // ################33


      }
      $delete_cart = $conn->prepare("DELETE FROM `cart` WHERE user_id = ?");
      $delete_cart->execute([$user_id]);



      // SELECT *,sum(price) FROM `order_products` join users ON order_products.farmer_id=users.id WHERE order_id=28 GROUP BY farmer_id;


      $sms_query = $conn->prepare("SELECT *,sum(price) as sum FROM `order_products` join users ON order_products.farmer_id=users.id WHERE order_id=? GROUP BY farmer_id");
      $sms_query->execute([$orderId]);

      while($sms_details = $sms_query->fetch(PDO::FETCH_ASSOC)){
         $curl = curl_init();
         curl_setopt_array($curl, array(
            CURLOPT_URL => 'https://api.mista.io/sms',
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => '',
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => 'POST',
            CURLOPT_POSTFIELDS => array('to' => '+25'.$sms_details['number'],'from' => 'web fa','unicode' => '0','sms' => 'Hello '.$sms_details['name'].' WebFA has received your money on '.date('d-M-Y-H:m').' Money received: '.$sms_details['sum'],'action' => 'send-sms'),
            CURLOPT_HTTPHEADER => array(
               'x-api-key: 188|aUKgh0mLT4qzUqV5HHnAB8DK9CJlR4gG02HOyusr'
            ),
            ));

            $response = curl_exec($curl);

         curl_close($curl);
      }
            
               
            
            
         

      $message[] = 'order placed successfully!';
   }
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>checkout</title>

   <!-- font awesome cdn link  -->
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">

   <!-- custom css file link  -->
   <link rel="stylesheet" href="css/style.css">

</head>

<body>

   <?php include 'header.php'; ?>

   <section class="display-orders">

      <?php
      $cart_grand_total = 0;
      $select_cart_items = $conn->prepare("SELECT * FROM `cart` WHERE user_id = ?");
      $select_cart_items->execute([$user_id]);
      if ($select_cart_items->rowCount() > 0) {
         while ($fetch_cart_items = $select_cart_items->fetch(PDO::FETCH_ASSOC)) {
            $cart_total_price = ($fetch_cart_items['price'] * $fetch_cart_items['quantity']);
            $cart_grand_total += $cart_total_price;
      ?>
            <p> <?= $fetch_cart_items['name']; ?> <span>(<?= 'Rwf ' . $fetch_cart_items['price'] . ' x ' . $fetch_cart_items['quantity']; ?>)</span> </p>
      <?php
         }
      } else {
         echo '<p class="empty">your cart is empty!</p>';
      }
      ?>
      <div class="grand-total">grand total : <span>Rwf <?= $cart_grand_total; ?></span></div>
   </section>

   <section class="checkout-orders">

      <form action="" method="POST">

         <h3>place your order</h3>

         <div class="flex">
            <div class="inputBox">
               <span>your name :</span>
               <input type="text" name="name" value="<?= $fetch_profile['name']; ?>" class="box" required>
            </div>
            <div class="inputBox">
               <span>your number :</span>
               <input type="text" name="number" value="<?= $fetch_profile['number']; ?>" class="box" required>
            </div>
            <div class="inputBox">
               <span>your email :</span>
               <input type="email" name="email" value="<?= $fetch_profile['email']; ?>" class="box" required>
            </div>
            <div class="inputBox">
               <span>payment method :</span>
               <select name="method" class="box" required>
                  <option value="cash on delivery">cash on delivery</option>
                  <option value="credit card">credit card</option>
                  <option value="paytm">MoMo</option>
                  <option value="paypal">Airtel Money</option>
               </select>
            </div>
            
            <div class="inputBox">
               <span>city :</span>
               <input type="text" name="city" value="<?= $fetch_profile['district']; ?>" class="box" required>
            </div>
            <div class="inputBox">
               <span>state :</span>
               <input type="text" name="state" value="<?= $fetch_profile['state']; ?>" class="box" required>
            </div>
            <div class="inputBox">
               <span>country :</span>
               <input type="text" name="country" value="Rwanda" class="box" required>
            </div>
            <div class="inputBox">
               <span>address line 01 :</span>
               <input type="text" name="flat" placeholder="e.g. Sonatibe" class="box" required>
            </div>
            <div class="inputBox">
               <span>pin code :</span>
               <input type="number" min="0" name="pin_code" placeholder="e.g. 123456" class="box" required>
            </div>
            <div class="inputBox">
               <span>address line 02 :</span>
               <input type="text" name="street" placeholder="e.g. kk102" class="box" required>
            </div>
         </div>

         <input type="submit" name="order" class="btn <?= ($cart_grand_total > 1) ? '' : 'disabled'; ?>" value="place order">

      </form>

   </section>








   <?php include 'footer.php'; ?>

   <script src="js/script.js"></script>

</body>

</html>