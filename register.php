<?php

    
    include 'components/connect.php';

    if(isset($_COOKIE['user_id'])){
        $user_id = $_COOKIE['user_id'];
    }else{
        $user_id = '';
    }


    if(isset($_POST['register'])){
        $id = unique_id();
        $name = $_POST['name'];
        $name = filter_var($name, FILTER_SANITIZE_STRING);

        $email = $_POST['email'];
        $email = filter_var($email, FILTER_SANITIZE_STRING);

        $pass = sha1($_POST['pass']);
        $pass = filter_var($pass, FILTER_SANITIZE_STRING);

        $cpass = sha1($_POST['cpass']);
        $cpass = filter_var($cpass, FILTER_SANITIZE_STRING);

        $image = $_FILES['image']['name'];
        $image = filter_var($image, FILTER_SANITIZE_STRING);
        $ext = pathinfo($image, PATHINFO_EXTENSION);
        $rename = unique_id().'.'.$ext;
        $image_size = $_FILES['image']['size'];
        $image_tmp_name = $_FILES['image']['tmp_name'];
        $image_folder = 'uploaded_files/'.$rename;

        $select_user = $conn->prepare("SELECT * FROM `users` WHERE email = ?");
        $select_user ->execute([$email]);

        if($select_user->rowCount() > 0){
            $warning_msg[] = 'email already exist!';
        }
        else{
            if($pass != $cpass){
                $warning_msg[] = 'confirm password not matched';
            }
            else{
                $insert_user = $conn->prepare("INSERT INTO `users`(id, name, email, password, image) VALUES(?,?,?,?,?)");
                $insert_user->execute([$id, $name, $email, $cpass, $rename]);
                move_uploaded_file($image_tmp_name, $image_folder);
                header('location:login.php');
                $success_msg[] = 'new user registred! please login now';

            }
        }
    }
    
    

?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>spa salon website</title>
    <link rel="stylesheet" type="text/css" href="css/user_style.css" >
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css">
   
</head>
<body>

<?php include 'components/user_header.php'; ?>

<div class="banner">
    <div class="detail">
        <h1>Register</h1>
        <p>Lorem ipsum dolor sit amet consectetur adipisicing elit.</p>
        <span><a href="home.php">home</a><i class="bx bx-right-arrow-alt"></i>register</span>
    </div>
</div>
    


   <div class="form-container form">
        <form action="" method="post" enctype="multipart/form-data" class="register">
            <h3>register now</h3>
            <div class="flex">
                <div class="col">
                   <div class="input-field">
                        <p>your name <span>*</span></p>
                        <input type="text" name ="name" placeholder="enter your name" maxlength="50" required class="box">
                   </div> 
                   <div class="input-field">
                        <p>your email <span>*</span></p>
                        <input type="email" name ="email" placeholder="enter your email" maxlength="50" required class="box">
                   </div> 
                </div>
                <div class="col">
                   <div class="input-field">
                        <p>your password <span>*</span></p>
                        <input type="password" name ="pass" placeholder="enter your password" maxlength="50" required class="box">
                   </div> 
                   <div class="input-field">
                        <p>confirm password <span>*</span></p>
                        <input type="password" name ="cpass" placeholder="confirm your password" maxlength="50" required class="box">
                   </div> 
                </div>
                   
                
            </div>
            <div class="input-field">
                        <p>your profile <span>*</span></p>
                        <input type="file" name ="image" accept="image/*" required class="box">
                   </div> 
                   <p class="link">already have a account? <a href="login.php">login now</a></p>
                   <button type="submit" name="register"  class="btn">register now</button>
        </form>
   </div>






<?php include 'components/user_footer.php'; ?>
<script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.js"></script>

<script src="../js/script.js"></script>

<?php include 'components/alert.php'; ?>

</body>
</html>