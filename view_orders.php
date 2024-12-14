<?php
    include 'components/connect.php';

    if(isset($_COOKIE['user_id'])){
        $user_id = $_COOKIE['user_id'];
    }else{
        $user_id = 'login.php';
    }

    if(isset($_GET['get_id'])){
        $get_id = $_GET['get_id'];
    }else{
        $get_id = '';
        header('location:book_appointment.php');
    }

    if(isset($_POST['canceled'])){

        $update_appointment = $conn->prepare("UPDATE `orders` SET status = ? WHERE id = ? LIMIT 1");
        $update_appointment->execute(['canceled', $get_id]);
        header('location:book_appointment.php');
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
        <h1>appointment details</h1>
        <p>Lorem ipsum dolor sit amet consectetur adipisicing elit.</p>
        <span><a href="home.php">home</a><i class="bx bx-right-arrow-alt"></i>appointment details</span>
    </div>
</div>

<div class="appointment-detail">
    <div class="heading">
        <h1>appoinyment details</h1>
        <img src="image/layer.phg" alt="">
    </div>
    <div class="container">
        <?php
            $grand_total = 0;
            $select_appointment = $conn->prepare("SELECT * FROM `orders` WHERE id = ? LIMIT 1");
            $select_appointment->execute([$get_id]);

            if($select_appointment->rowCount() > 0){
                while($fetch_appointment = $select_appointment->fetch(PDO::FETCH_ASSOC)){
                     $select_service = $conn->prepare("SELECT * FROM `services` WHERE id = ? LIMIT 1");
                     $select_service->execute([$fetch_appointment["service_id"]]);

                     if($select_service->rowCount() > 0){
                        while($fetch_service = $select_service->fetch(PDO::FETCH_ASSOC)){
                            $sub_total = $fetch_appointment['price'];
                            $grand_total += $sub_total;
                    
        ?>
        <div class="box">
            <div class="col">
                <img src="uploaded_files/<?= $fetch_service['image']; ?>" alt="" class="image">
                <p class="date"><i class="bx bxs-calendar-alt"></i><span><?= $fetch_appointment['date']; ?></span></p>
                <div class="detail">
                    <h3 class="name"><?= $fetch_appointment['name']; ?></h3>
                    <p class="grand-total">total amount paid : <span><?= $grand_total; ?> BYN</span></p>
                </div>
            </div>
            <div class="col">
                <?php 
                    $select_employee = $conn->prepare("SELECT * FROM `employee` WHERE id = ?");
                    $select_employee->execute([$fetch_appointment['employee_id']]);

                    if($select_employee->rowCount() > 0){
                        while($fetch_employee = $select_employee->fetch(PDO::FETCH_ASSOC)){
                ?>
                <p class="title">employee select</p>
                <div class="employee_detail">
                    <img src="uploaded_files/<?= $fetch_employee['profile']?>" alt="" class="employee"><br>
                    <div>
                        <p><?= $fetch_employee['name']?></p>
                       <p><?= $fetch_employee['profession']?></p>
                    </div>
                </div>
                <?php 
                        }
                    }
                ?>
                <p class="title">customer details</p>
                <p class="user"><i class="bx bxs-rectangle"></i><?= $fetch_appointment['name'];?></p>
                <p class="user"><i class="bx bxs-phone-outgoing"></i><?= $fetch_appointment['number'];?></p>
                <p class="user"><i class="bx bxs-envelope"></i><?= $fetch_appointment['date'];?></p>
                <p class="user"><i class="bx bxs-rectangle"></i><?= $fetch_appointment['time'];?></p>
                <p class="status" style="color: <?php if($fetch_appointment['status'] == 'in process'){echo 'green';}elseif($fetch_appointment['status'] == 'canceled'){echo 'red';}else{echo 'orange';} ?>"><?= $fetch_appointment['status'];?></p>

                <?php if($fetch_appointment['status'] = 'canceled'){?>
                    <a href="orders.php?get_id=<?= $fetch_service['id']; ?>" class="btn">book appointment again</a>
                    <?php } else{?>
                        <form action="" method="post">
                            <button type="submit" name="canceled" class="btn" onclick="return confirm('do you want to canceled this appointment?')">cancele this appointment</button>
                        </form>
                    <?php }?>
            </div>
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