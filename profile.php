<?php
    include 'components/connect.php';

    if(isset($_COOKIE['user_id'])){
        $user_id = $_COOKIE['user_id'];
    }else{
        $user_id = 'login.php';
    }

    $select_appointments = $conn->prepare("SELECT * FROM `orders` WHERE user_id = ?");
    $select_appointments->execute([$user_id]);
    $total_appointments = $select_appointments->rowCount();

    $select_message = $conn->prepare("SELECT * FROM `message` WHERE user_id = ?");
    $select_message->execute([$user_id]);
    $total_message = $select_message->rowCount();
    

?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>seller registration page</title>
    <link rel="stylesheet" type="text/css" href="css/user_style.css" >
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css">
    <link rel="stylesheet" href="https://unpkg.com/boxicons@latest/css/boxicons.min.css">
</head>
<body>

<?php include 'components/user_header.php'; ?>

<div class="banner">
    <div class="detail">
        <h1>My profile</h1>
        <p>Lorem ipsum dolor sit amet consectetur adipisicing elit.</p>
        <span><a href="home.php">home</a><i class="bx bx-right-arrow-alt"></i>profile</span>
    </div>
</div>

<div class="profile">
    <div class="heading">
        <h1>profile details</h1>
        <img src="image/layer.png" alt="" width="100">
    </div>
    <div class="details">
        <div class="user">
            <img src="uploaded_files/<?= $fetch_profile['image']; ?>" alt="">
            <h3><?= $fetch_profile['name']; ?></h3>
            <span>user</span>
            <a href="update.php" class="btn">update profile</a>
        </div>
        <div class="box-container">
            <div class="box">
                <div class="flex">
                    <i class="bx bxs-food-menu"></i>
                    <h3>Total appointments : <?= $total_appointments; ?></h3>
                </div>
                <a href="book_appointment.php" class="btn">view appointments</a>
            </div>
            <div class="box">
                <div class="flex">
                    <i class="bx bxs-chat"></i>
                    <h3>Total messages : <?= $total_message; ?></h3>
                </div>
                <a href="contact.php" class="btn">send messages</a>
            </div>
        </div>
    </div>
</div>




<?php include 'components/user_footer.php'; ?>

<script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.js"></script>

<script src="../js/script.js"></script>

<?php include 'components/alert.php'; ?>

</body>
</html>