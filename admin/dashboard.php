<?php 
	include '../components/connect.php';

	if (isset($_COOKIE['admin_id'])){
		$admin_id = $_COOKIE['admin_id'];
	}else{
		$admin_id = '';
        header('location:login.php');
	}



?>

<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<!-- box icon cdn link  -->
   	<link href='https://unpkg.com/boxicons@2.1.2/css/boxicons.min.css' rel='stylesheet'>

   	<link rel="stylesheet" type="text/css" href="../css/admin_style.css?v=<?php echo time(); ?>">
	<title>Spa salon website</title>
</head>
<body>
	
<?php include '../components/admin_header.php'; ?>


<div class="banner">
    <div class="detail">
        <h1>Dashboard</h1>
        <p>Lorem ipsum dolor sit amet consectetur adipisicing elit.</p>
        <span><a href="dashboard.php">admin</a><i class="bx bx-right-arrow-alt"></i>dashboard</span>
    </div>
</div>

<section class="dashdoard">
    <div class="heading">
        <h1>dashboard</h1>
        <img src="../image/layer.png" alt="" width="100">
    </div>
    <div class="box-container">
        <div class="box">
            <h3>welcome!</h3>
            <p><?= $fetch_profile['name']; ?></p>
            <a href="profile.php" class="btn">view profile</a>
        </div>
    
    <div class="box">
        <?php 
            $select_msg = $conn->prepare("SELECT * FROM `message`");  
            $select_msg->execute(); 
            $num_of_msg = $select_msg->rowCount();  
        ?>
        <h3><?= $num_of_msg; ?></h3>
        <p>unread message</p>
        <a href="admin_message.php" class="btn">view messages</a>
    </div>
    <div class="box">
        <?php 
            $select_services = $conn->prepare("SELECT * FROM `services`");  
            $select_services->execute(); 
            $num_of_services = $select_services->rowCount();  
        ?>
        <h3><?= $num_of_services; ?></h3>
        <p>services added</p>
        <a href="view_service.php" class="btn">view services</a>
    </div>
    <div class="box">
        <?php 
            $select_active_services = $conn->prepare("SELECT * FROM `services` WHERE status = ?");  
            $select_active_services->execute(['active']); 
            $num_of_active_services = $select_active_services->rowCount();  
        ?>
        <h3><?= $num_of_active_services; ?></h3>
        <p>active services</p>
        <a href="view_service.php" class="btn">view active services</a>
    </div>
    <div class="box">
        <?php 
            $select_deactive_services = $conn->prepare("SELECT * FROM `services` WHERE status = ?");  
            $select_deactive_services->execute(['deactive']); 
            $num_of_deactive_services = $select_deactive_services->rowCount();  
        ?>
        <h3><?= $num_of_deactive_services; ?></h3>
        <p>deactive services</p>
        <a href="view_service.php" class="btn">view deactive services</a>
    </div>
    <div class="box">
        <?php 
            $select_employee = $conn->prepare("SELECT * FROM `employee`");  
            $select_employee->execute(); 
            $num_of_employee = $select_employee->rowCount();  
        ?>
        <h3><?= $num_of_employee; ?></h3>
        <p>employee</p>
        <a href="view_employee.php" class="btn">view employee</a>
    </div>
    <div class="box">
        <?php 
            $select_users = $conn->prepare("SELECT * FROM `users`");  
            $select_users->execute(); 
            $num_of_users = $select_users->rowCount();  
        ?>
        <h3><?= $num_of_users; ?></h3>
        <p>total users</p>
        <a href="user_account.php" class="btn">view users</a>
    </div>
    <div class="box">
        <?php 
            $select_appointment = $conn->prepare("SELECT * FROM `orders`");  
            $select_appointment->execute(); 
            $num_of_appointment = $select_appointment->rowCount();  
        ?>
        <h3><?= $num_of_appointment; ?></h3>
        <p>total orders</p>
        <a href="view_orders.php" class="btn">all orders</a>
    </div>
    <div class="box">
        <?php 
            $canceled_appointment = $conn->prepare("SELECT * FROM `orders` WHERE status = ?");  
            $canceled_appointment->execute(['canceled']); 
            $num_of_canceled_appointment = $canceled_appointment->rowCount();  
        ?>
        <h3><?= $num_of_canceled_appointment; ?></h3>
        <p>canceled orders</p>
        <a href="view_orders.php" class="btn">canceled orders</a>
    </div>
    <div class="box">
        <?php 
            $confirm_orders = $conn->prepare("SELECT * FROM `orders` WHERE status = ?");  
            $confirm_orders->execute(['in progress']); 
            $num_of_confirm_orders = $confirm_orders->rowCount();  
        ?>
        <h3><?= $num_of_confirm_orders; ?></h3>
        <p>confirm orders</p>
        <a href="view_order.php" class="btn">confirm orders</a>
    </div>
</div>
</section>





	<?php include '../components/admin_footer.php'; ?>
	<!-- sweetalert cdn link  -->
	<script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.js"></script>
    <script type="text/javascript" src="../js/admin_script.js"></script>
	<!-- alert  -->
	<?php include '../components/alert.php'; ?>
</body>
</html>