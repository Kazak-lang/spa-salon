<?php
    include 'components/connect.php';

    if(isset($_COOKIE['user_id'])){
        $user_id = $_COOKIE['user_id'];
    }else{
        $user_id = '';
    }

    if(isset($_POST['send_message'])){
        if($user_id != ''){

            $id = unique_id();

            $name = $_POST['name'];
            $name = filter_var($name, FILTER_SANITIZE_STRING);

            $email = $_POST['email'];
            $email = filter_var($email, FILTER_SANITIZE_STRING);

            $subject = $_POST['subject'];
            $subject = filter_var($subject, FILTER_SANITIZE_STRING);

            $message = $_POST['message'];
            $message = filter_var($message, FILTER_SANITIZE_STRING);

            $verify_message = $conn->prepare("SELECT * FROM `message` WHERE user_id = ? AND name = ? AND email = ? AND subject = ? AND message = ?");
            $verify_message->execute([$user_id, $name, $email, $subject, $message]);

            if($verify_message->rowCount() > 0){
                $warning_msg[] = 'message already sent';
            }else{
                $insert_message = $conn->prepare('INSERT INTO `message`(id, user_id, name, email, subject, message) VALUES(?,?,?,?,?,?)');
                $insert_message->execute([$id, $user_id, $name, $email, $subject, $message]);
                $success_msg[] = 'message sent';
            }
        }else{
            $warning_msg[] = 'please login to send a message';
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
    <link rel="stylesheet" href="https://unpkg.com/boxicons@2.1.2/css/boxicons.min.css">
</head>
<body>

<?php include 'components/user_header.php'; ?>

<div class="banner">
    <div class="detail">
        <h1>contact us</h1>
        <p>Lorem ipsum dolor sit amet consectetur adipisicing elit.</p>
        <span><a href="home.php">home</a><i class="bx bx-right-arrow-alt"></i>contact</span>
    </div>
</div>

<div class="contact">
    <div class="heading" style="margin-top: 2%;">
        <h1>droap a line</h1>
        <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Magnam voluptate, in deleniti nihil fugit facere nisi ut voluptatem quos provident. Iste maiores excepturi incidunt perspiciatis fugit nam neque quibusdam soluta?</p>
        <img src="image/layer.png" alt="">
    </div>
    <div class="form-container">
    <div style="position:relative;overflow:hidden;"><a href="https://yandex.by/maps/26030/navapolatsk/search/WellnessBeautySPA/?utm_medium=mapframe&utm_source=maps" style="color:#eee;font-size:12px;position:absolute;top:0px;">WellnessBeautySPA в Новополоцке</a><a href="https://yandex.by/maps/26030/navapolatsk/?utm_medium=mapframe&utm_source=maps" style="color:#eee;font-size:12px;position:absolute;top:14px;">Новополоцк</a><iframe src="https://yandex.by/map-widget/v1/?ll=28.718711%2C55.516068&mode=search&sll=28.698389%2C55.507729&sspn=3.109131%2C3.854040&text=WellnessBeautySPA&z=13" width="560" height="830" frameborder="1" allowfullscreen="true" style="position:relative; border-radius: 10px"></iframe></div>
        <form action="" method="post" enctype="multipart/form-data" class="login">
            <div class="input-field">
                <p>your name <span>*</span></p>
                <input type="text" name="name" class="box" required placeholder="enter your name" maxlength="50">
            </div>
            <div class="input-field">
                <p>your email <span>*</span></p>
                <input type="email" name="email" class="box" required placeholder="enter your email" maxlength="60">
            </div>
            <div class="input-field">
                <p>subject <span>*</span></p>
                <input type="text" name="subject" class="box" required placeholder="enter your subject" maxlength="150">
            </div>
            <div class="input-field">
                <p>message <span>*</span></p>
                <textarea name="message" class="box" required ></textarea>
            </div>
            <button type="submit" name="send_message" class="btn">send message</button>
        </form>
    </div>
</div>
<div class="address">
    <div class="heading">
        <p style="text-transform: capitalize; font-weight: bold; font-size: 2rem;">Our details</p>
        <img src="image/layer.png" alt="">
    </div>
    <div class="box-container">
        <div class="box">
            <i class="bx bxs-map-alt"></i>
        <div>
            <h4>our address</h4>
            <p>Navapolatsk <br> Belarus</p>
        </div>
    </div>
    <div class="box">
            <i class="bx bxs-phone-incoming"></i>
        <div>
            <h4>phone number</h4>
            <p>MTS : <br>375 (33) 361-60-81.</p>
        </div>
    </div>
    <div class="box">
            <i class="bx bxs-envelope"></i>
        <div>
            <h4>email</h4>
            <p>lirena@mail.ru</p>
        </div>
    </div>
    </div>
</div>

















<?php include 'components/user_footer.php'; ?>

<script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.js"></script>
<script src="js/user_script.js"></script>

<?php include 'components/alert.php'; ?>

</body>
</html>