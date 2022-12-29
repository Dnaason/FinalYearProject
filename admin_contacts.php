<?php

@include 'config.php';
define("ROW_PER_PAGE",3);

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
      $page = 1;
      $start=0;
      if(!empty($_GET["page"])) {
         $page = $_GET["page"];
         $start=($page-1) * ROW_PER_PAGE;
      }
      $limit=" limit " . $start . "," . ROW_PER_PAGE;
      
      $query0="SELECT * FROM `message`";
      $select_message0 = $conn->prepare($query0);
      $select_message0->execute();
      $results = $select_message0->rowCount();
      
      $query="SELECT * FROM `message` ".$limit;
      
               $select_message = $conn->prepare($query);
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