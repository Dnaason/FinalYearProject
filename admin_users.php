<?php

@include 'config.php';

session_start();

$admin_id = $_SESSION['admin_id'];

if(!isset($admin_id)){
   header('location:login.php');
};

if(isset($_GET['delete'])){

   $delete_id = $_GET['delete'];
   $delete_users = $conn->prepare("DELETE FROM `users` WHERE id = ?");
   $delete_users->execute([$delete_id]);
   header('location:admin_users.php');

}

?>

<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>users</title>

   <!-- font awesome cdn link  -->
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">

   <!-- custom css file link  -->
   <link rel="stylesheet" href="css/admin_style.css">

</head>
<body>
   
<?php include 'admin_header.php'; ?>

<section class="user-accounts">

   <h1 class="title">user accounts</h1>

   <table>
         <thead>
            <tr>
               <td>user id</td>
               <td>username</td>
               <td>email</td>
               <td>user type</td>
               <td>Option</td>
            </tr>
         </thead>

      <?php
         $select_users = $conn->prepare("SELECT * FROM `users`");
         $select_users->execute();
         while($fetch_users = $select_users->fetch(PDO::FETCH_ASSOC)){
      ?>
   
         <tbody style="<?php if($fetch_users['id'] == $admin_id){ echo 'display:none'; }; ?>">
            <tr>
               <td><img src="uploaded_img/<?= $fetch_users['image']; ?>" alt=""></td>
               <td><?= $fetch_users['id']; ?></td>
               <td><?= $fetch_users['name']; ?></td>
               <td><?= $fetch_users['email']; ?></td>
               <td><span style=" color:<?php if($fetch_users['user_type'] == 'admin'){ echo 'orange'; }; ?>"><?= $fetch_users['user_type']; ?></span></td>
               <td><a href="admin_users.php?delete=<?= $fetch_users['id']; ?>" onclick="return confirm('delete this user?');" class="delete-btn">delete</a></td>
            </tr>
         </tbody>
     
      
      <?php
      }
      ?>
 </table>

</section>













<script src="js/script.js"></script>

</body>
</html>