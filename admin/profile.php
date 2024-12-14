<?php
    include '../components/connect.php';

    if(isset($_COOKIE['admin_id'])){
        $admin_id = $_COOKIE['admin_id'];
    }else{
        $admin_id = '';
        header('location:login.php');
    }
    $select_service = $conn->prepare("SELECT * FROM `services`");
    $select_service->execute();
    $total_service = $select_service->rowCount();

    $select_orders = $conn->prepare("SELECT * FROM `orders`");
    $select_orders->execute();
    $total_orders = $select_orders->rowCount();

    $select_employee = $conn->prepare("SELECT * FROM `employee`");
    $select_employee->execute();
    $total_employee = $select_employee->rowCount();

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

<?php include '../components/admin_header.php'; ?>

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
                <img src="../uploaded_files/<?=$fetch_profile['image'];?>" alt="">
                <h3 class="name"><?=$fetch_profile['name']; ?></h3>
                <a href="update.php" class="btn">update profile</a>
            </div>
            <div class="flex">
                <div class="box">
                    <span><?= $total_service; ?></span>
                    <p>total service</p>
                    <a href="view_service.php" class="btn">view service</a>
                </div>
                <div class="box">
                    <span><?= $total_orders; ?></span>
                    <p>total orders placed</p>
                    <a href="view_order.php" class="btn">view orders</a>
                </div>
                <div class="box">
                    <span><?= $total_employee; ?></span>
                    <p>total employees</p>
                    <a href="view_employee.php" class="btn">view employee</a>
                </div>
            </div>
        </div>

</section>





<script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.js"></script>
<script src="../js/admin_script.js"></script>

<?php include '../components/alert.php'; ?>

</body>
</html>