<?php
    include '../components/connect.php';

    if(isset($_COOKIE['employee_id'])){
        $admin_id = $_COOKIE['employee_id'];
    }else{
        $admin_id = '';
        header('location:login.php');
    }

    if (isset($_POST['update1'])) {
        $update_id = $_POST['appointment_id'];
        $update_id = filter_var($update_id, FILTER_SANITIZE_STRING);
        $new_status = 'in process'; 
    
        // Проверяем, существует ли заказ с данным ID
        $verify_order = $conn->prepare("SELECT * FROM `orders` WHERE id = ?");
        $verify_order->execute([$update_id]);
    
        if ($verify_order->rowCount() > 0) {
            // Обновляем статус заказа
            $update_status = $conn->prepare("UPDATE `orders` SET status = ? WHERE id = ?");
            $update_status->execute([$new_status, $update_id]);
    
            $success_msg[] = 'Order status updated successfully.';
        } else {
            $warning_msg[] = 'Order not found.';
        }
    }

    if (isset($_POST['update2'])) {
        $update_id = $_POST['appointment_id'];
        $update_id = filter_var($update_id, FILTER_SANITIZE_STRING);
        $new_status = 'canceled'; 
    
        // Проверяем, существует ли заказ с данным ID
        $verify_order = $conn->prepare("SELECT * FROM `orders` WHERE id = ?");
        $verify_order->execute([$update_id]);
    
        if ($verify_order->rowCount() > 0) {
            // Обновляем статус заказа
            $update_status = $conn->prepare("UPDATE `orders` SET status = ? WHERE id = ?");
            $update_status->execute([$new_status, $update_id]);
    
            $success_msg[] = 'Order status updated successfully.';
        } else {
            $warning_msg[] = 'Order not found.';
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

<?php include '../components/employee_header.php'; ?>

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
                $select_appointment = $conn->prepare("SELECT * FROM `orders` WHERE employee_id = ?");
                $select_appointment->execute([$admin_id]);

                if($select_appointment->rowCount() > 0){
                    while($fetch_appointment = $select_appointment->fetch(PDO::FETCH_ASSOC)){
                
           ?>
           <div class="box">
                <div class="status" style="color: <?php if($fetch_appointment['status'] == 'in process') {echo "limegreen";} elseif($fetch_appointment['status'] == 'booked'){echo "orange";}else{echo "red";}  ?>">
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
                    <button type="submit" name="update1" class="btn"  style="width: 45%;">in progress</button>
                    <button type="submit" name="update2" class="btn"  style="width: 45%;">canceled</button>
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