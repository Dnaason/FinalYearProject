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
   <title>about</title>

   <!-- font awesome cdn link  -->
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">

   <!-- custom css file link  -->
   <link rel="stylesheet" href="css/style.css">

</head>
<body>
   
<?php include 'header.php'; ?>

<section class="about">

   <div class="row">

      <div class="box">
         <img src="images/about-img-1.png" alt="">
         <h3>why choose us?</h3>
         <p>you can choose us inorder to get a good and quality services to you, we connect you with a different markets as a farmer, and we deliver you a good products that you will be happy to have us, reach on us then you get a good services, our system will deliver you a good services, we are happy to be with you.</p>
         <a href="contact.php" class="btn">contact us</a>
      </div>

      <div class="box">
         <img src="images/about-img-2.png" alt="">
         <h3>what we provide?</h3>
         <p>we provide to you a good and quality services to you, we connect you with a different markets as a farmer, and we deliver you a good products that you will be happy to have us, reach on us then you get a good services, our system will deliver you a good services, we are happy to be with you.</p>
         <a href="shop.php" class="btn">our shop</a>
      </div>

   </div>

</section>

<section class="reviews">

   <h1 class="title">clients statements</h1>

   <div class="box-container">

      <div class="box">
         <img src="images/pic-1.png" alt="">
         <p>They have a good services deliver wonderfull services. we are happy to be with you, we are always get your services.</p>
         <div class="stars">
            <i class="fas fa-star"></i>
            <i class="fas fa-star"></i>
            <i class="fas fa-star"></i>
            <i class="fas fa-star"></i>
            <i class="fas fa-star-half-alt"></i>
         </div>
         <h3>Abdul Kal</h3>
      </div>

      <div class="box">
         <img src="images/pic-2.png" alt="">
         <p>They have a good services deliver wonderfull services. we are happy to be with you, we are always get your services.</p>
         <div class="stars">
            <i class="fas fa-star"></i>
            <i class="fas fa-star"></i>
            <i class="fas fa-star"></i>
            <i class="fas fa-star"></i>
            <i class="fas fa-star-half-alt"></i>
         </div>
         <h3>Tuyi Chanto</h3>
      </div>

      <div class="box">
         <img src="images/pic-3.png" alt="">
         <p>Farming web assistance are able to provide to us a good services to us, they connect you with a different markets as a farmer, and they deliver you a good products that you will be happy to have them, we are happy to be with you.</p>
         <div class="stars">
            <i class="fas fa-star"></i>
            <i class="fas fa-star"></i>
            <i class="fas fa-star"></i>
            <i class="fas fa-star"></i>
            <i class="fas fa-star-half-alt"></i>
         </div>
         <h3>Niyo Jea</h3>
      </div>

      <div class="box">
         <img src="images/pic-4.png" alt="">
         <p>They have a good services deliver wonderfull services. we are happy to be with you, we are always get your services.</p>
         <div class="stars">
            <i class="fas fa-star"></i>
            <i class="fas fa-star"></i>
            <i class="fas fa-star"></i>
            <i class="fas fa-star"></i>
            <i class="fas fa-star-half-alt"></i>
         </div>
         <h3>Ishimwe Mariette</h3>
      </div>

      <div class="box">
         <img src="images/pic-5.png" alt="">
         <p>They have a good services deliver wonderfull services. we are happy to be with you, we are always get your services.</p>
         <div class="stars">
            <i class="fas fa-star"></i>
            <i class="fas fa-star"></i>
            <i class="fas fa-star"></i>
            <i class="fas fa-star"></i>
            <i class="fas fa-star-half-alt"></i>
         </div>
         <h3>D Naason</h3>
      </div>

      <div class="box">
         <img src="images/pic-6.png" alt="">
         <p>They have a good services deliver wonderfull services. we are happy to be with you, we are always get your services.</p>
         <div class="stars">
            <i class="fas fa-star"></i>
            <i class="fas fa-star"></i>
            <i class="fas fa-star"></i>
            <i class="fas fa-star"></i>
            <i class="fas fa-star-half-alt"></i>
         </div>
         <h3>Uwituze Hon</h3>
      </div>

   </div>

</section>









<?php include 'footer.php'; ?>

<script src="js/script.js"></script>

</body>
</html>