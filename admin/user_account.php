<?php
    include '../components/connect.php';

    if(isset($_COOKIE['admin_id'])){
        $admin_id = $_COOKIE['admin_id'];
    }else{
        $admin_id = '';
        header('location:login.php');
    }

    //delete message from bd
   

?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Spa Salon Website</title>
    <link rel="stylesheet" type="text/css" href="../css/admin_style.css" >
    <link rel="stylesheet" href="https://unpkg.com/boxicons@2.1.2/css/boxicons.min.css">
</head>
<body>

<?php include '../components/admin_header.php'; ?>

<div class="banner">
    <div class="detail">
        <h1>User accounts</h1>
        <p>Lorem ipsum dolor sit amet consectetur adipisicing elit.</p>
        <span><a href="dashboard.php">admin</a><i class="bx bx-right-arrow-alt"></i>User accounts</span>
    </div>
</div>

<section class="user-container">
<div class="heading">
            <h1>read services</h1>
            <img src="../image/layer.png" alt="" width="100">
        </div>

        <div class="box-container">
            <?php 
                $select_users = $conn->prepare("SELECT * FROM `users`");
                $select_users->execute();
            
                if($select_users->rowCount() > 0){
                    while($fetch_users = $select_users->fetch(PDO::FETCH_ASSOC)){
                        $user_id = $fetch_users['id'];         
            
            ?>
            <div class="box">
                <img src="../uploaded_files/<?= $fetch_users['image'];?>" alt="">
                <div class="detail">
                    <p>user id : <span><?= $user_id;?></span></p>
                    <p>user name : <span><?= $fetch_users['name'];?></span></p>
                    <p>user email : <span><?= $fetch_users['email'];?></span></p>
                </div>
            </div>
            <?php 
                    }
                }else{
                    echo '
                    <div class="empty">
                                 <p>no user registered yet</p>
                             </div>
                 ';
                }
            ?>
        </div>


</section>

</div>



<script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.js"></script>
<script src="../js/admin_script.js"></script>

<?php include '../components/alert.php'; ?>

</body>
</html>