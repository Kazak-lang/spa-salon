<?php
    include 'components/connect.php';

    if(isset($_COOKIE['user_id'])){
        $user_id = $_COOKIE['user_id'];
    }else{
        $user_id = '';
    }


    if(isset($_POST['book_appointment'])){
        
        if($user_id != ''){
            $id = unique_id();

            $name = $_POST['first_name'].' '.$_POST['last_name'];
            $name = filter_var($name, FILTER_SANITIZE_STRING);

            $email = $_POST['email'];
            $email = filter_var($email, FILTER_SANITIZE_STRING);

            $number = $_POST['number'];
            $number = filter_var($number, FILTER_SANITIZE_STRING);

            $payment = $_POST['payment'];
            $payment = filter_var($payment, FILTER_SANITIZE_STRING);

            $employee = $_POST['employee'];
            $employee = filter_var($employee, FILTER_SANITIZE_STRING);

            $date = $_POST['date'];
            $date = filter_var($date, FILTER_SANITIZE_STRING);

            $time = $_POST['time'];
            $time = filter_var($time, FILTER_SANITIZE_STRING);

            if(isset($_GET['get_id'])){
                $get_service = $conn->prepare("SELECT * FROM `services` WHERE id = ? LIMIT 1");
                $get_service->execute([$_GET['get_id']]);

                if($get_service->rowCount() > 0){
                    while($fetch_s = $get_service->fetch(PDO::FETCH_ASSOC)){

                        $insert_service = $conn->prepare("INSERT INTO `orders` (id, user_id, name, number, email, service_id, employee_id, date, time, price, payment_status) VALUES(?,?,?,?,?,?,?,?,?,?,?)");
                        $insert_service->execute([$id, $user_id, $name, $number, $email, $fetch_s['id'], $employee, $date, $time, $fetch_s['price'], $payment]);

                        $success_msg[] = 'your appointment booked';
                        header('location:book_appointment.php');
            }
        }
    }
    else{
        $warning_msg[] = 'please login first';
    }
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
        <h1>book appointment</h1>
        <p>Lorem ipsum dolor sit amet consectetur adipisicing elit.</p>
        <span><a href="home.php">home</a><i class="bx bx-right-arrow-alt"></i>book appointment</span>
    </div>
</div>

<div class="summary">
    <h3>book your appointment</h3>
    <div class="container">
        <?php
            $grand_total = 0;

            if(isset($_GET['get_id'])){
                $select_get = $conn->prepare("SELECT * FROM `services` WHERE id = ?");
                $select_get->execute([$_GET['get_id']]);

                while($fetch_get = $select_get->fetch(PDO::FETCH_ASSOC)){
                    $sub_total = $fetch_get['price'];
                    $grand_total+= $sub_total;
                
        ?>
        <div class="flex">
            <img src="uploaded_files/<?= $fetch_get['image']; ?>" class="image" alt="">
            <div>
                <h3 class="name"><?= $fetch_get['name']; ?></h3>
                <p class="price"><?= $fetch_get['price']; ?></p>
            </div>
        </div>
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
        <div class="grand-total"><span>total amount payble : </span><?= $grand_total; ?> BYN</div>
    </div>
</div>

<div class="form-container appointment">
    <form action="" enctype="multipart/form-data" method="post" class="register">
        <div class="flex">
            <div class="col">
                <div class="input-field">
                    <p>first name <span>*</span></p>
                    <input type="text" name="first_name" placeholder="first name" class="box" required>
                </div>
                <div class="input-field">
                    <p>last name <span>*</span></p>
                    <input type="text" name="last_name" placeholder="last name" class="box" required>
                </div>
                <div class="input-field">
                    <p>your number <span>*</span></p>
                    <input type="text" name="number" maxlength="100" placeholder="+(375)(__)___-__-__" class="box" required id="phone">
                </div>
                <div class="input-field">
                    <p>your email <span>*</span></p>
                    <input type="email" name="email" placeholder="your email" class="box" required>
                </div>
            </div>
            <div class="col">
                <div class="input-field">
                    <p>payment <span>*</span></p>
                    <select name="payment" id="" class="box select">
                        <option selected disabled>select payment method</option>
                        <option value="paytm">paytm</option>
                        <option value="credit card">credit card</option>
                        <option value="phone pay">phone pay</option>
                        <option value="G-pay">G-pay</option>
                    </select>
                </div>
                <div class="input-field">
                    <p>employee<span>*</span></p>
                    <select name="employee" id="" class="box select">
                        <?php
                            $select_employee = $conn->prepare("SELECT * FROM `employee` WHERE status = ?");
                            $select_employee->execute(['active']);

                            if($select_employee->rowCount() > 0){
                                while($fetch_employee = $select_employee->fetch(PDO::FETCH_ASSOC)){
                        ?>

                        <option value="<?= $fetch_employee['id']; ?>"><?= $fetch_employee['name']; ?></option>
                        <?php
                                }
                            }
                        ?>
                    </select>
                </div>
                <div class="input-field">
                    <p>select date <span>*</span></p>
                    <input type="date" name="date" placeholder="select date" class="box" required>
                </div>
                <div class="input-field">
                    <p>seelct time <span>*</span></p>
                    <select name="time" id="" class="box select" required>
                        <option selected disabled>select time</option>
                        <option value="9:00 AM - 10:00 AM">9:00 AM - 10:00 AM</option>
                        <option value="10:00 AM - 11:00 AM">10:00 AM - 11:00 AM</option>
                        <option value="11:00 AM - 12:00 AM">11:00 AM - 12:00 AM</option>
                        <option value="12:00 AM - 13:00 AM">12:00 AM - 13:00 AM</option>
                        <option value="13:00 AM - 14:00 AM">13:00 AM - 14:00 AM</option>
                        <option value="14:00 AM - 15:00 AM">14:00 AM - 15:00 AM</option>
                        <option value="15:00 AM - 16:00 AM">15:00 AM - 16:00 AM</option>
                        <option value="16:00 AM - 17:00 AM">16:00 AM - 17:00 AM</option>
                    </select>
                </div>
            </div>
        </div>
        <button type="submit" name="book_appointment" class="btn">book appointment</button>
    </form>
</div>







   <?php include 'components/user_footer.php'; ?>

<script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.js"></script>

<script src="js/user_script.js" type="text/javascript"></script>
<script src="https://unpkg.com/imask" ></script>

<?php include 'components/alert.php'; ?>

</body>
</html>