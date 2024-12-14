<?php 
	include '../components/connect.php';

	if (isset($_COOKIE['admin_id'])){
		$admin_id = $_COOKIE['admin_id'];
	}else{
		$admin_id = '';
        header('location:login.php');
	}

      //delete service from db
      if(isset($_POST['delete'])){
        $service_id = $_POST['service_id'];
        $service_id = filter_var($service_id, FILTER_SANITIZE_STRING);

        $delete_service = $conn->prepare("DELETE FROM `services` WHERE id = ?");
        $delete_service->execute([$service_id]);

        $success_msg[] = 'service deleted successfully';
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
        <h1>View service</h1>
        <p>Lorem ipsum dolor sit amet consectetur adipisicing elit.</p>
        <span><a href="dashboard.php">admin</a><i class="bx bx-right-arrow-alt"></i>view service</span>
    </div>
</div>

<section class="view_container">
    <div class="heading">
        <h1>View services</h1>
        <img src="../image/layer.png" alt="" width="100">
    </div>
    <div class="box-container">
                 <?php
                    $select_services = $conn->prepare("SELECT * FROM `services`");
                    $select_services->execute();
                    if($select_services->rowCount() > 0){
                        while($fetch_service = $select_services->fetch(PDO::FETCH_ASSOC)){
          
                        ?>
                        <form action="" method="post" class="box">
                            <input type="hidden" name="service_id" value = "<?= $fetch_service['id'];?>">
                            <?php if($fetch_service['image'] != ''){ ?>
                            <img src="../uploaded_files/<?= $fetch_service['image']; ?>" alt="" class="image">
                             <?php } ?>
                                <div class="status" style="color: <?php if($fetch_service['status'] == 'active') {echo "limegreen";} else{echo "red";}  ?>">
                                    <?= $fetch_service['status']; ?>
                    </div>
                    <p class="price"><?= $fetch_service['price']; ?> BYN</p>
                    <div class="content">
                            <div class="title"><?= $fetch_service['name']; ?></div>
                            <div class="flex-btn">
                                <a href="edit_service.php?id=<?= $fetch_service['id'];?>" class="btn">edit</a>
                                <button type="submit" name="delete" class="btn" onclick="return confirm('delete this service');">delete</button>
                                <a href="read_service.php?get_id=<?= $fetch_service['id'];?>" class="btn">read</a>
                    </div>
                </div>
            </form>
           
            <?php
                    }
                }else{
                    echo '
                    <div class="empty">
                        <p>no services added yet! <br> <a href="add_service.php" class="btn" style="margin-top: 1rem;">add services</a></p>
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