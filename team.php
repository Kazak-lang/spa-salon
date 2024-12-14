<?php
    include 'components/connect.php';

    if(isset($_COOKIE['user_id'])){
        $user_id = $_COOKIE['user_id'];
    }else{
        $user_id = '';
    }

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
        <h1>our team</h1>
        <p>Lorem ipsum dolor sit amet consectetur adipisicing elit.</p>
        <span><a href="home.php">home</a><i class="bx bx-right-arrow-alt"></i>team</span>
    </div>
</div>

<div class="services">
    <div class="box-container">
        <?php
            $select_team = $conn->prepare("SELECT * FROM `employee` WHERE status = ?");
            $select_team->execute(['active']);

            if($select_team->rowCount() > 0){
                while($fetch_team = $select_team->fetch(PDO::FETCH_ASSOC)){


        ?>
        <form action="" method="post" class="box">
            <img src="uploaded_files/<?= $fetch_team['profile'];?>" alt="" class="image">

            <div class="content">
                <div><h3><?= $fetch_team['name']; ?></h3></div>
                <p>profession : <span><?= $fetch_team['profession']; ?></span></p>
                <input type="hidden" name="employee_id" value="<?= $fetch_team['id']; ?>">
            <div class="flex-btn">
                <a href="employee_detail.php?get_id=<?= $fetch_team['id']; ?>" class="btn">view details</a>
            </div>
            </div>

        </form>
        <?php
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
</div>
















<?php include 'components/user_footer.php'; ?>

<script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.js"></script>
<script src="js/user_script.js"></script>

<?php include 'components/alert.php'; ?>

</body>
</html>