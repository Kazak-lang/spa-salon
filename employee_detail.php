<?php
    include 'components/connect.php';

    if(isset($_COOKIE['user_id'])){
        $user_id = $_COOKIE['user_id'];
    }else{
        $user_id = '';
    }

    $get_id = $_GET['get_id'];

?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>seller registration page</title>
    <link rel="stylesheet" type="text/css" href="css/user_style.css" >
    <link rel="stylesheet" href="https://unpkg.com/boxicons@2.1.2/css/boxicons.min.css">
</head>
<body>

<?php include 'components/user_header.php'; ?>

<div class="banner">
    <div class="detail">
        <h1>view detail</h1>
        <p>Lorem ipsum dolor sit amet consectetur adipisicing elit.</p>
        <span><a href="home.php">home</a><i class="bx bx-right-arrow-alt"></i>view detail</span>
    </div>
</div>

<div class="view-service">
    <div class="heading">
        <h1>employee details</h1>
        <img src="image/layer.png" alt="">
    </div>
    <?php
        if(isset($_GET['get_id'])){
            $get_id = $_GET['get_id'];
            $select_employee = $conn->prepare("SELECT * FROM `employee` WHERE id = '$get_id'");
            $select_employee->execute();

            if($select_employee->rowCount() > 0){
                while($fetch_employee = $select_employee->fetch(PDO::FETCH_ASSOC)){

    ?>
    <form action="" class="box" method="post">
        <div class="img-box">
            <img src="uploaded_files/<?= $fetch_employee['profile']; ?>" alt="">
        </div>
        <div class="detail">

            <div class="name"><?= $fetch_employee['name']; ?></div>
            <p class="info">profession : <span><?= $fetch_employee['profession']; ?></span></p>
            <p class="info">phone number : <span><?= $fetch_employee['number']; ?></span></p>
            <p class="info">email : <span><?= $fetch_employee['email']; ?></span></p>
            <p class="employee_detail"><?= $fetch_employee['profile_desc']; ?></p>
            <input type="hidden" name="employee_id" value="<?= $fetch_employee['id']; ?>">
            <div class="flex-btn">
                <a href="team.php?get_id=<?= $fetch_employee['id']; ?>" class="btn" class="btn" style="width: 100%;">go back</a>
            </div>
        </div>
    </form>
    <?php 
                }
            }
        }else{
            echo '
                <div class="empty">
                    <p>no employee registred yet!</p>
                </div>
                
                ';
        }
    ?>
</div>
















<?php include 'components/user_footer.php'; ?>

<script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.js"></script>
<script src="js/user_script.js"></script>

<?php include 'components/alert.php'; ?>

</body>
</html>