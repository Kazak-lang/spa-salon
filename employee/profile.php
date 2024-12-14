<?php
    include '../components/connect.php';

    if(isset($_COOKIE['employee_id'])){
        $admin_id = $_COOKIE['employee_id'];
    }else{
        $admin_id = '';
        header('location:login.php');
    }

    $select_orders = $conn->prepare("SELECT * FROM `orders` WHERE employee_id = ?");
    $select_orders->execute([$admin_id]);
    $total_orders = $select_orders->rowCount();


?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Spa salon website</title>
    <link rel="stylesheet" type="text/css" href="../css/admin_style.css" >
    <link rel="stylesheet" href="https://unpkg.com/boxicons@2.1.2/css/boxicons.min.css">
</head>
<body>

<?php include '../components/employee_header.php'; ?>

<div class="banner">
    <div class="detail">
        <h1>My profile</h1>
        <p>Lorem ipsum dolor sit amet consectetur adipisicing elit.</p>
        <span><a href="dashboard.php">admin</a><i class="bx bx-right-arrow-alt"></i>My profile</span>
    </div>
</div>



    <section class="admin-profile">
    <div class="heading">
        <h1>profile detail</h1>
        <img src="../image/layer.png" alt="">
    </div>        
        <div class="details">
            <div class="admin">
                <img src="../uploaded_files/<?=$fetch_profile['profile'];?>" alt="">
                <h3 class="name"><?=$fetch_profile['name']; ?></h3>
                <a href="update.php" class="btn">update profile</a>
            </div>
            <div class="flex">

                <div class="box">
                    <span><?= $total_orders; ?></span>
                    <p>total your orders </p>
                    <a href="view_orders.php" class="btn">view orders</a>
                </div>

            </div>
        </div>

</section>





<script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.js"></script>
<script src="../js/admin_script.js"></script>

<?php include '../components/alert.php'; ?>

</body>
</html>