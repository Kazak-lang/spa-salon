<?php
    include 'components/connect.php';

    if(isset($_COOKIE['user_id'])){
        $user_id = $_COOKIE['user_id'];
    }else{
        $user_id = 'login.php';
    }

    

?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>seller registration page</title>
    <link rel="stylesheet" type="text/css" href="css/user_style.css" >
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css">
    <link rel="stylesheet" href="https://unpkg.com/boxicons@2.1.2/css/boxicons.min.css">
</head>
<body>

<?php include 'components/user_header.php'; ?>

<div class="banner">
    <div class="detail">
        <h1>booked appointment</h1>
        <p>Lorem ipsum dolor sit amet consectetur adipisicing elit.</p>
        <span><a href="home.php">home</a><i class="bx bx-right-arrow-alt"></i>booked appointment</span>
    </div>
</div>

<div class="appointments">
    <div class="heading">
        <h1>my appoinyments</h1>
        <img src="image/layer.phg" alt="">
    </div>
    <div class="box-container">
        <?php 
            $select_appointments = $conn->prepare("SELECT * FROM `orders` WHERE user_id = ?");
            $select_appointments->execute([$user_id]);

            if($select_appointments->rowCount() > 0){
                while($fetch_appointments = $select_appointments->fetch(PDO::FETCH_ASSOC)){

                    $appointments_id = $fetch_appointments['service_id'];
                    $select_service = $conn->prepare("SELECT * FROM `services` WHERE id = ?");

                    $select_service->execute([$fetch_appointments['service_id']]);

                    if($select_service->rowCount() > 0){
                        while($fetch_service = $select_service->fetch(PDO::FETCH_ASSOC)){

        ?>
        <div class="box">
            <a href="view_orders.php?get_id=<?= $fetch_appointments['id'];?>">
                <img src="uploaded_files/<?= $fetch_service['image'];?>" alt="" class="image">
                <div class="content">
                    <p class="date"><i class="bx bxs-calendar-alt"></i><span><?= $fetch_appointments['date']; ?></span></p>
                    <h3 class="name"><?= $fetch_appointments['name'];?></h3>
                    <p class="price"><?= $fetch_appointments['price'];?> BYN</p>
                    <p class="status" style="color: <?php if($fetch_appointments['status'] == 'in progress'){echo 'green';}elseif($fetch_appointments['status'] == 'canceled'){echo 'red';}else{echo 'orange';} ?>"><?= $fetch_appointments['status'];?></p>
                </div>
            </a>
        </div>
        <?php 
                        }
                    }
                }
            }else{
                echo '
                <div class="empty">
                    <p>no appointments take placed yet!</p>
                </div>
                ';
            }
        ?>
    </div>
</div>




   <?php include 'components/user_footer.php'; ?>

<script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.js"></script>

<script src="../js/script.js"></script>

<?php include 'components/alert.php'; ?>

</body>
</html>