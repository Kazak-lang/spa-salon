<?php 
	include '../components/connect.php';

	if (isset($_COOKIE['employee_id'])){
		$admin_id = $_COOKIE['employee_id'];
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
	
<?php include '../components/employee_header.php'; ?>


<div class="banner">
    <div class="detail">
        <h1>View employee</h1>
        <p>Lorem ipsum dolor sit amet consectetur adipisicing elit.</p>
        <span><a href="dashboard.php">admin</a><i class="bx bx-right-arrow-alt"></i>view employee</span>
    </div>
</div>

<section class="view_container">
    <div class="heading">
        <h1>View employee</h1>
        <img src="../image/layer.png" alt="" width="100">
    </div>
    <div class="box-container">
                 <?php
                    $select_employee = $conn->prepare("SELECT * FROM `employee`");
                    $select_employee->execute();
                    if($select_employee->rowCount() > 0){
                        while($fetch_employee = $select_employee->fetch(PDO::FETCH_ASSOC)){
          
                        ?>
                        <form action="" method="post" class="box">
                            <input type="hidden" name="employee_id" value = "<?= $fetch_employee['id'];?>">
                            <?php if($fetch_employee['profile'] != ''){ ?>
                            <img src="../uploaded_files/<?= $fetch_employee['profile']; ?>" alt="" class="image">
                             <?php } ?>
                                <div class="status" style="color: <?php if($fetch_employee['status'] == 'active') {echo "limegreen";} else{echo "red";}  ?>">
                                    <?= $fetch_employee['status']; ?>
                    </div>
                    <p class="profession"><?= $fetch_employee['profession']; ?></p>
                    <div class="content">
                            <div class="title"><?= $fetch_employee['name']; ?></div>
                            <div class="title"><?= $fetch_employee['number']; ?></div>
                            
                </div>
            </form>
           
            <?php
                    }
                }else{
                    echo '
                    <div class="empty">
                        <p>no employee added yet! <br> <a href="add_employee.php" class="btn" style="margin-top: 1rem;">add employee</a></p>
                    </div>
                    
                    ';
                }
            ?>
</section>




	<?php include '../components/admin_footer.php'; ?>
	<!-- sweetalert cdn link  -->
	<script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.js"></script>
	

    <script type="text/javascript" src="../js/admin_script.js">
        <?php include 'script.js' ?>
    </script>
	<!-- alert  -->
	<?php include '../components/alert.php'; ?>
</body>
</html>