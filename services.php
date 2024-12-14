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
        <h1>our services</h1>
        <p>Lorem ipsum dolor sit amet consectetur adipisicing elit.</p>
        <span><a href="home.php">home</a><i class="bx bx-right-arrow-alt"></i>services</span>
    </div>
</div>

<div class="services">
    <div class="box-container">
        <?php
            $select_service = $conn->prepare("SELECT * FROM `services` WHERE status = ?");
            $select_service->execute(['active']);

            if($select_service->rowCount() > 0){
                while($fetch_service = $select_service->fetch(PDO::FETCH_ASSOC)){


        ?>
        <form action="" method="post" class="box">
            <img src="uploaded_files/<?= $fetch_service['image'];?>" alt="" class="image">
            <p class="price"><?= $fetch_service['price']; ?> BYN</p>
            <div class="content">
                <div class="button">
                    <div><h3><?= $fetch_service['name']; ?></h3></div>
                    <div><a href="view_page.php?pid=<?= $fetch_service['id']; ?>" class="bx bxs-show"></a></div>
                </div>
                <input type="hidden" name="service_id" value="<?= $fetch_service['id']; ?>">
            <div class="flex-btn">
                <a href="orders.php?get_id=<?= $fetch_service['id']; ?>" class="btn">book appointment</a>
            </div>
            </div>

        </form>
        <?php
                }
            }else{
                echo '
                <div class="empty">
                    <p>no services added yet!</p>
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