<?php
    include '../components/connect.php';

    if(isset($_COOKIE['admin_id'])){
        $admin_id = $_COOKIE['admin_id'];
    }else{
        $admin_id = '';
        header('location:login.php');
    }

   $get_id = $_GET['get_id'];

   //delete servie

   if(isset($_POST['delete'])){
    $s_id = $_POST['service_id'];
    $s_id = filter_var($s_id, FILTER_SANITIZE_STRING);

    $delete_image = $conn->prepare("DELETE FROM `services` WHERE id = ?");
    $delete_image->execute([$s_id]);

    $fetch_delete_image = $delete_image->fetch(PDO::FETCH_ASSOC);
    if($fetch_delete_image[''] != ''){
        unlink('../uploaded_files/'.$fetch_delete_image['image']);
    }
    $delete_service = $conn->prepare("DELETE FROM `services` WHERE id = ?");
    $delete_service->execute([$s_id]);

    header('location:view_service.php');

   
}


?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Spa salon website</title>
    <link rel="stylesheet" type="text/css" href="../css/admin_style.css" >
    <link rel="stylesheet" href="https://unpkg.com/boxicons@2.1.2/css/boxicons.min.css">
</head>
<body>

<?php include '../components/admin_header.php'; ?>

<div class="banner">
    <div class="detail">
        <h1>read service</h1>
        <p>Lorem ipsum dolor sit amet consectetur adipisicing elit.</p>
        <span><a href="dashboard.php">admin</a><i class="bx bx-right-arrow-alt"></i>read service</span>
    </div>
</div>

    <section class="read_container">
        <div class="heading">
            <h1>read services</h1>
            <img src="../image/layer.png" alt="" width="100">
        </div>
            <div class="container">
                <?php 
                    $select_service = $conn->prepare("SELECT * FROM `services` WHERE id=?");
                    $select_service -> execute([$get_id]);
                    if($select_service->rowCount() > 0){
                        while($fetch_service = $select_service->fetch(PDO::FETCH_ASSOC)){
 
                ?>
                <form action="" method="post" class="box">
                    <input type="hidden"name="service_id" value = "<?=$fetch_service['id']; ?>">
                    <div class="status" style="color: <?php if($fetch_service['status'] == 'active') {echo "limegreen";} else{echo "red";}  ?>">
                                    <?= $fetch_service['status']; ?>
                    </div>
                    <?php if($fetch_service['image'] != ''){ ?>
                        <img src="../uploaded_files/<?= $fetch_service['image']; ?>" alt="" class="image">
                   <?php } ?>
                   <div class="price"><?=$fetch_service['price']; ?> BYN</div>
                   <div class="title"><?=$fetch_service['name']; ?></div>
                   <div class="content"><?=$fetch_service['service_detail']; ?></div>
                   <div class="flex-btn">
                        <a href="edit_service.php?id=<?=$fetch_service['id'];?>" class="btn">edit service</a>
                        <button type="submit" name="delete" class="btn" onclick="return confirm('delete this service?');">delete service</button>
                        <a href="view_service.php?post_id = <?=$fetch_service['id']; ?>" class="btn">go back</a>
                   </div>
                </form>
                <?php 
                        }
                    }else{
                        echo '
                        <div class="empty">
                            <p>no products added yet! <br> <a href="add_service.php" class="btn" style="margin-top: 1.5rem;">add service</a></p>
                        </div>
                        
                        ';
                    }
                ?>
            </div>         
    </section>  




<?php include '../components/admin_footer.php'; ?>
<script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.js"></script>
<script src="../js/admin_script.js"></script>

<?php include '../components/alert.php'; ?>

</body>
</html>