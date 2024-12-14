<?php
    include '../components/connect.php';

    if(isset($_COOKIE['admin_id'])){
        $admin_id = $_COOKIE['admin_id'];
    }else{
        $admin_id = '';
        header('location:login.php');
    }

    //delete message from bd
    if(isset($_POST['delete'])){
        $delete_id = $_POST['appointment_id'];
        $delete_id = filter_var($delete_id, FILTER_SANITIZE_STRING);

        $verify_delete = $conn->prepare("SELECT * FROM `orders` WHERE id = ?");
        $verify_delete->execute([$delete_id]);

        if($verify_delete->rowCount() > 0){
            
            $delete_msg = $conn->prepare("DELETE FROM `orders` WHERE id = ?");
            $delete_msg->execute([$delete_id]);

            $success_msg[] = 'orders successfully';
        }else{
            $warning_msg[] = 'orders already deleted';
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
        <h1>booked orders</h1>
        <p>Lorem ipsum dolor sit amet consectetur adipisicing elit.</p>
        <span><a href="dashboard.php">admin</a><i class="bx bx-right-arrow-alt"></i>orders</span>
    </div>
</div>

    <section class="message-container">
        <div class="heading">
            <h1>booked orders</h1>
            <img src="../image/layer.png" alt="" width="100">
        </div>
        <div class="box-container">
           <?php
                $select_appointment = $conn->prepare("SELECT * FROM `orders`");
                $select_appointment->execute();

                if($select_appointment->rowCount() > 0){
                    while($fetch_appointment = $select_appointment->fetch(PDO::FETCH_ASSOC)){
                
           ?>
           <div class="box">
                <div class="status" style="color: <?php if($fetch_appointment['status'] == 'in progress') {echo "limegreen";} else{echo "red";}  ?>">
                    <?= $fetch_appointment['status']; ?></div>
                <div class="detail">
                    <p>user name : <span><?= $fetch_appointment['name']; ?></span></p>
                    <p>user id : <span><?= $fetch_appointment['user_id']; ?></span></p>
                    <p>booked on : <span><?= $fetch_appointment['date']; ?></span></p>
                    <p>time : <span><?= $fetch_appointment['time']; ?></span></p>
                    <p>number : <span><?= $fetch_appointment['number']; ?></span></p>
                    <p>email : <span><?= $fetch_appointment['email']; ?></span></p>
                    <p>price : <span><?= $fetch_appointment['price']; ?> BYN</span></p>
                    <p>appointment status : <span><?= $fetch_appointment['status']; ?></span></p>   
                </div>
                <?php 
                    $select_employee = $conn->prepare("SELECT * FROM `employee` WHERE id = ? LIMIT 1");
                    $select_employee->execute([ $fetch_appointment['employee_id']]);

                    if($select_employee->rowCount() > 0){
                        while($fetch_employee = $select_employee->fetch(PDO::FETCH_ASSOC)){

                ?>
            <div class="employee">
                <p class="title">select employee : <span><?= $fetch_employee['name']; ?></span></p>
                <img src="../uploaded_files/<?= $fetch_employee['profile']; ?>"> <br>
            </div>
            <?php 
                      }
                }
            ?>
            <?php 
                $select_service = $conn->prepare('SELECT * FROM `services` WHERE id = ? LIMIT 1');
                $select_service->execute([ $fetch_appointment['service_id']]);

                if($select_service->rowCount() > 0){
                    while($fetch_service = $select_service->fetch(PDO::FETCH_ASSOC)){
                
            ?>
                <div class="employee">
                    <p class="title">selected service : <span><p><?= $fetch_service['name'];?></p></span></p>
                </div>
            <?php
                    }
                }
            ?>
            <form action="" method="post">
                <input type="hidden" name="appointment_id" value="<?= $fetch_appointment['id']; ?>">
                <div class="flex-btn">
                    <button type="submit" name="delete" class="btn" onclick="return confirm('delete this order?');" style="width: 100%;">delete order</button>
                </div>
            </form>
                
            </div>
           <?php
                }
            }else{
                echo '
               <div class="empty">
                            <p>no booked orders yet</p>
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