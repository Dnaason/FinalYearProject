<?php

@include 'config.php';

session_start();

$admin_id = $_SESSION['admin_id'];

if(!isset($admin_id)){
   header('location:login.php');
};

if(isset($_GET['delete'])){

   $delete_id = $_GET['delete'];
   $delete_message = $conn->prepare("DELETE FROM `message` WHERE id = ?");
   $delete_message->execute([$delete_id]);
   header('location:admin_contacts.php');

}

?>

<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>messages</title>

   <!-- font awesome cdn link  -->
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">

   <!-- custom css file link  -->
   <link rel="stylesheet" href="css/admin_style.css">

</head>
<body>
   
<?php include 'admin_header.php'; ?>

<section class="messages">

   <h1 class="title">messages</h1>
   <table class="table">
     <thead>
     	<tr>
     	 <th>user id</th>
     	 <th>name</th>
     	 <th>number</th>
     	 <th>email</th>
     	 <th>message</th>
     	 <th>Option</th>
            </tr>
         </thead>

   <?php
      $select_message = $conn->prepare("SELECT * FROM `message`");
      $select_message->execute();
      if($select_message->rowCount() > 0){
         while($fetch_message = $select_message->fetch(PDO::FETCH_ASSOC)){
   ?>
   <tbody class="box">
   <tr>
      <td data-label="user id"><span span><?= $fetch_message['user_id']; ?></span></td>
      <td data-label="name"><span><?= $fetch_message['name']; ?></span></td>
      <td data-label="number"><span><?= $fetch_message['number']; ?></span></td>
      <td data-label="email"><span><?= $fetch_message['email']; ?></span></td>
      <td data-label="message"><span><?= $fetch_message['message']; ?></span></td>
      <td data-label="user id"><a href="admin_contacts.php?delete=<?= $fetch_message['id']; ?>" onclick="return confirm('delete this message?');" class="delete-btn">delete</a></td>
      </tbody>
   <?php
         }
      }else{
         echo '<p class="empty">you have no messages!</p>';
      }
   ?>

   </table>

</section>













<script src="js/script.js"></script>

</body>
</html>