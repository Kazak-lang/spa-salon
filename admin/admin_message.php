<?php
    include '../components/connect.php';

    if(isset($_COOKIE['admin_id'])){
        $admin_id = $_COOKIE['admin_id'];
    }else{
        $admin_id = '';
        header('location:login.php');
    }

    //delete message from bd
    if(isset($_POST['delete_msg'])){
        $delete_id = $_POST['delete_id'];
        $delete_id = filter_var($delete_id, FILTER_SANITIZE_STRING);

        $verify_delete = $conn->prepare("SELECT * FROM `message` WHERE id = ?");
        $verify_delete->execute([$delete_id]);

        if($verify_delete->rowCount() > 0){
            
            $delete_msg = $conn->prepare("DELETE FROM `message` WHERE id = ?");
            $delete_msg->execute([$delete_id]);

            $success_msg[] = 'message deleted successfully';
        }else{
            $warning_msg[] = 'message already deleted';
        }
    }

?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>seller registration page</title>
    <link rel="stylesheet" type="text/css" href="../css/admin_style.css" >
    <link rel="stylesheet" href="https://unpkg.com/boxicons@2.1.2/css/boxicons.min.css">
</head>
<body>

<?php include '../components/admin_header.php'; ?>

<div class="banner">
    <div class="detail">
        <h1>unread message</h1>
        <p>Lorem ipsum dolor sit amet consectetur adipisicing elit.</p>
        <span><a href="dashboard.php">admin</a><i class="bx bx-right-arrow-alt"></i>message</span>
    </div>
</div>

    <section class="appointment-container">
        <div class="heading">
            <h1>user message</h1>
            <img src="../image/layer.png" alt="" width="100">
        </div>
        <div class="box-container">
            <?php 
            $select_message = $conn->prepare("SELECT * FROM `message`");
            $select_message->execute();
            if($select_message->rowCount() > 0){
                while ($fetch_message = $select_message->fetch(PDO::FETCH_ASSOC)){
            
            ?>
            <div class="box">
                <h3 class="name"><?=$fetch_message['name']; ?></h3>
                <h4>Subject : <?=$fetch_message['subject']; ?></h4>
                <p><?=$fetch_message['message']; ?></p>
                <form action="" method="post">
                    <input type="hidden" name="delete_id" value="<?=$fetch_message['id']; ?>">
                    <button type="submit" name="delete_msg" class="btn" onclick="return confirm('delete this message');" >delete message</button>
                </form>
            </div>
            <?php 
                }
            }else{
                echo '
               <div class="empty">
                            <p>no unread message yet</p>
                        </div>
            ';
            }
            ?>
        </div>
</section>





<script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.js"></script>
<script src="../js/admin_script.js"></script>

<?php include '../components/alert.php'; ?>

</body>
</html>