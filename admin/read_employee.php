<?php
    include '../components/connect.php';

    if(isset($_COOKIE['admin_id'])){
        $admin_id = $_COOKIE['admin_id'];
    }else{
        $admin_id = '';
        header('location:login.php');
    }

   $get_id = $_GET['get_id'];

   //delete employee

   if(isset($_POST['delete'])){
    $e_id = $_POST['employee_id'];
    $e_id = filter_var($e_id, FILTER_SANITIZE_STRING);

    $delete_image = $conn->prepare("DELETE FROM `employee` WHERE id = ?");
    $delete_image->execute([$e_id]);

    $fetch_delete_image = $delete_image->fetch(PDO::FETCH_ASSOC);
    if($fetch_delete_image[''] != ''){
        unlink('../uploaded_files/'.$fetch_delete_image['image']);
    }
    $delete_service = $conn->prepare("DELETE FROM `employee` WHERE id = ?");
    $delete_service->execute([$e_id]);

    header('location:view_employee.php');

   
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
        <h1>read employee</h1>
        <p>Lorem ipsum dolor sit amet consectetur adipisicing elit.</p>
        <span><a href="dashboard.php">admin</a><i class="bx bx-right-arrow-alt"></i>read employee</span>
    </div>
</div>

    <section class="read_container">
        <div class="heading">
            <h1>read employee</h1>
            <img src="../image/layer.png" alt="" width="100">
        </div>
            <div class="container">
                <?php 
                    $select_employee = $conn->prepare("SELECT * FROM `employee` WHERE id=?");
                    $select_employee -> execute([$get_id]);
                    if($select_employee->rowCount() > 0){
                        while($fetch_employee = $select_employee->fetch(PDO::FETCH_ASSOC)){
 
                ?>
                <form action="" method="post" class="box">
                    <input type="hidden"name="employee_id" value = "<?=$fetch_employee['id']; ?>">
                    <div class="status" style="color: <?php if($fetch_employee['status'] == 'active') {echo "limegreen";} else{echo "red";}  ?>">
                                    <?= $fetch_employee['status']; ?>
                    </div>
                    <?php if($fetch_employee['profile'] != ''){ ?>
                        <img src="../uploaded_files/<?= $fetch_employee['profile']; ?>" alt="" class="image">
                   <?php } ?>

                   <div class="name"><?=$fetch_employee['name']; ?></div>
                   <div class="email"><?=$fetch_employee['email']; ?></div>
                   <div class="profession"><?=$fetch_employee['profession']; ?></div>
                   
                   <div class="content"><?=$fetch_employee['profile_desc']; ?></div>
                   <div class="flex-btn">
                        <a href="edit_employee.php?id=<?=$fetch_employee['id'];?>" class="btn">edit employee</a>
                        <button type="submit" name="delete" class="btn" onclick="return confirm('delete this service?');">delete employee</button>
                        <a href="view_employee.php?post_id = <?=$fetch_employee['id']; ?>" class="btn">go back</a>
                   </div>
                </form>
                <?php 
                        }
                    }else{
                        echo '
                        <div class="empty">
                            <p>no employee added yet! <br> <a href="add_employee.php" class="btn" style="margin-top: 1.5rem;">add employee</a></p>
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