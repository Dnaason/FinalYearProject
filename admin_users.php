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

<section class="user-accounts">

   <h1 class="title">user accounts</h1>

   <table class="table">
     <thead>
     	<tr>
     	 <th>user id</th>
     	 <th>username</th>
     	 <th>email</th>
     	 <th>number</th>
     	 <th>state</th>
     	 <th>district</th>
     	 <th>sector</th>
     	 <th>user type</th>
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
      
      $query0="SELECT * FROM `users`";
      $select_users0 = $conn->prepare($query0);
      $select_users0->execute();
      $results = $select_users0->rowCount();
      
      $query="SELECT * FROM `users` ".$limit;
      
               $select_users = $conn->prepare($query);
               $select_users->execute();
         while($fetch_users = $select_users->fetch(PDO::FETCH_ASSOC)){
      ?>
   
         <tbody style="<?php if($fetch_users['id'] == $admin_id){ echo 'display:none'; }; ?>">
     	      <tr>
               <td data-label="user id"><?= $fetch_users['id']; ?></td>
               <td data-label="username"><?= $fetch_users['name']; ?></td>
               <td data-label="email"><?= $fetch_users['email']; ?></td>
               <td data-label="number"><?= $fetch_users['number']; ?></td>
               <td data-label="state"><?= $fetch_users['state']; ?></td>
               <td data-label="district"><?= $fetch_users['district']; ?></td>
               <td data-label="sector"><?= $fetch_users['sector']; ?></td>
               <td data-label="user type"><span style=" color:<?php if($fetch_users['user_type'] == 'admin'){ echo 'orange'; }; ?>"><?= $fetch_users['user_type']; ?></span></td>
               <td data-label="option"><a href="admin_users.php?delete=<?= $fetch_users['id']; ?>" onclick="return confirm('delete this user?');" class="delete-btn">delete</a></td>
            </tr>
         </tbody>
      <?php
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