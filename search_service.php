<?php
    include 'components/connect.php';

    if(isset($_COOKIE['user_id'])){
        $user_id = $_COOKIE['user_id'];
    }else{
        $user_id = '';
    }

    if(isset($_POST['login'])){
       

        $email = $_POST['email'];
        $email = filter_var($email, FILTER_SANITIZE_STRING);

        $pass = sha1($_POST['pass']);
        $pass = filter_var($pass, FILTER_SANITIZE_STRING);

        $select_user = $conn->prepare("SELECT * FROM `users` WHERE email = ? AND password =?");
        $select_user ->execute([$email, $pass]);
        $row = $select_user->fetch(PDO::FETCH_ASSOC);

        if($select_user->rowCount() > 0){
            setcookie('user_id', $row['id'], time() + 60*60*24*30, '/');
            header('location:home.php');
        }else{
            $warning_msg[] = 'incorrect email or password';
        }
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
</head>
<body>

<?php include 'components/user_header.php'; ?>

<div class="banner">
    <div class="detail">
        <h1>Search</h1>
        <p>Lorem ipsum dolor sit amet consectetur adipisicing elit.</p>
        <span><a href="home.php">home</a><i class="bx bx-right-arrow-alt"></i>Search</span>
    </div>
</div>

<section class="services">
    <div class="heading">
        <h1>search service result</h1>
        <img src="image/layer.png" alt="">
    </div>
    <div class="box-container">
        <?php 
            if(isset($_POST['search_service']) or isset($_POST['search_service_btn'])){
                $search_service = $_POST['search_service'];
                $select_service  = $conn->prepare("SELECT * FROM `services` WHERE name LIKE '%{$search_service}%' AND status = ?");
                $select_service->execute(['active']);

                if($select_service->rowCount() > 0){
                    while($fetch_service = $select_service->fetch(PDO::FETCH_ASSOC)){

                        $service_id = $fetch_service['id'];
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
                <a href="order.php?get_id=<?= $fetch_service['id']; ?>" class="btn">book appointment</a>
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
        }     
        ?>
    </div>
</section>




<?php include 'components/user_footer.php'; ?>

<script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.js"></script>

<script src="../js/script.js"></script>

<?php include 'components/alert.php'; ?>

</body>
</html>