<?php
    include '../components/connect.php';

    if(isset($_COOKIE['admin_id'])){
        $admin_id = $_COOKIE['admin_id'];
    }else{
        $admin_id = '';
        header('location:login.php');
    }

    if(isset($_POST['update'])){
        $service_id = $_POST['service_id'];
        $service_id = filter_var($service_id, FILTER_SANITIZE_STRING);

        $name = $_POST['name'];
        $name = filter_var($name, FILTER_SANITIZE_STRING);

        $price = $_POST['price'];
        $price = filter_var($price, FILTER_SANITIZE_STRING);

        $content = $_POST['content'];
        $content = filter_var($content, FILTER_SANITIZE_STRING);

        $category = $_POST['category'];
        $category = filter_var($category, FILTER_SANITIZE_STRING);
  
        $status = $_POST['status'];    
        $status = filter_var($status, FILTER_SANITIZE_STRING);  

        $update_service = $conn->prepare("UPDATE `services` SET name = ?, price = ?, service_detail = ?, status = ?, category = ? WHERE id = ?");
        $update_service ->execute([$name, $price, $content, $status, $category, $service_id]);

        $success_msg[] = 'service updated';


        $old_image = $_POST['old_image'];
        $image = $_FILES['image']['name'];
        $image = filter_var($image, FILTER_SANITIZE_STRING);


        $ext = pathinfo($image, PATHINFO_EXTENSION);
        $rename = unique_id().'.'.$ext;
        $image_size = $_FILES['image']['size'];
        $image_tmp_name = $_FILES['image']['tmp_name'];
        $image_folder = '../uploaded_files/'.$rename;



        // $image_size = $_FILES['image']['size'];
        // $image_tmp_name = $_FILES['image']['tmp_name'];
        // $image_folder = '../uploaded_files/'.$image; 

        $select_image = $conn->prepare("SELECT * FROM `services` WHERE image = ? AND id = ?");
        $select_image->execute([$image, $service_id]);

        if(!empty($image)){
            if($image_size > 2000000){
                $warning_msg[] = 'image size is too large';
            }elseif($select_image->rowCount() > 0){
                $warning_msg[] = 'please rename your image';
            }else{
                $update_image = $conn->prepare("UPDATE `services` SET image = ? WHERE id = ?");
                $update_image->execute([$rename, $service_id]);
                move_uploaded_file($image_tmp_name, $image_folder);
                if($old_image != $image AND $old_image != ''){
                    unlink('../uploaded_files/'.$old_image);      
                }
                $success_msg[] = 'image updated!';
            }
        }
    }

    ///delete image

    if(isset($_POST['delete_image'])){
        $empty_image = '';

        $service_id = $_POST['service_id'];
        $service_id = filter_var($service_id, FILTER_SANITIZE_STRING);

        $delete_image = $conn->prepare("SELECT * FROM `services` WHERE id = ?");
        $delete_image->execute([$service_id]);
        $fetch_delete_image = $delete_image->fetch(PDO::FETCH_ASSOC);

        if($fetch_delete_image['image'] != ''){
            unlink('../uploaded_files/'.$fetch_delete_image['image']);
        }
        $unset_image = $conn->prepare("UPDATE `services` SET image = ? WHERE id = ?");
        $unset_image->execute([$empty_image, $service_id]);
        $success_msg[] = 'image deleted';
    }

    //delete service

    if (isset($_POST['delete'])) {
        $service_id = $_POST['service_id'];
        $service_id = filter_var($service_id, FILTER_SANITIZE_STRING);
        
        $delete_image = $conn->prepare("SELECT * FROM `services` WHERE id = ?");
        $delete_image->execute([$service_id]);
        $fetch_delete_image = $delete_image->fetch(PDO::FETCH_ASSOC);
        
        if ($fetch_delete_image['image'] != '') {
            unlink('../uploaded_files/'.$fetch_delete_image['image']);
        }
        
        $delete_service = $conn->prepare("DELETE FROM `services` WHERE id = ?");
        $delete_service->execute([$service_id]);
        
        $success_msg[] = 'service deleted successfully! ';
        header( 'location: view_service.php' );
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
        <h1>Edit service</h1>
        <p>Lorem ipsum dolor sit amet consectetur adipisicing elit.</p>
        <span><a href="dashboard.php">admin</a><i class="bx bx-right-arrow-alt"></i>edit service</span>
    </div>
</div>
  
    <section class="add_services">
    <div class="heading">
        <h1>edit services</h1>
        <img src="../image/layer.png" alt="" width="100">
    </div>
<div class="container">
    <?php 
        $service_id = $_GET['id'];
        $select_service = $conn->prepare("SELECT * FROM `services` WHERE id=?");
        $select_service->execute([$service_id]);
        if($select_service->rowCount() > 0){
            while($fetch_service = $select_service->fetch(PDO::FETCH_ASSOC)){

    ?>
    <div class="form-container">
        <form action="" method="post" enctype="multipart/form-data" class="register">
            <input type="hidden" value="<?= $fetch_service['image'];?>" name="old_image">
            <input type="hidden" value="<?= $fetch_service['id'];?>" name="service_id">
            <div class="input-field">
                <p>service status <span>*</span></p>
                <select name="status" class="box">
                    <option value="<?= $fetch_service['status'];?>" selected><?= $fetch_service['status'];?></option>
                    <option value="active">active</option>
                    <option value="deactive">deactive</option>
                </select>
            </div>
            <div class="input-field">
                <p>service name <span>*</span></p>
                <input type="text" name="name" value="<?= $fetch_service['name']; ?>" class="box">
            </div>
            <div class="input-field">
                <p>service price <span>*</span></p>
                <input type="number" name="price" value="<?= $fetch_service['price']; ?>" class="box">
            </div>
            <div class="input-field">
                <p>service descript <span>*</span></p>
                <textarea name = "content" class="box"><?= $fetch_service['service_detail']; ?></textarea>
            </div>
            <div class="input-field">
                        <p>service category <span>*</span></p>
                        <select class="box" name="category" required>
                            <option value="<?= $fetch_service['category'];?>" selected><?= $fetch_service['category'];?></option>
                            <option value="spa programs">spa programs</option>
                            <option value="massages">massages</option>
                            <option value="facial">facial</option>
                            <option value="body treatment">body treatment</option>
                            <option value="for couple">sfor couple</option>
                        </select>
                    </div>
            <div class="input-field">
                <p>servcie image <span>*</span></p>
                <input type="file" name="image" accept="image/*" class="box">
                <?php if($fetch_service['image'] !=''){?>
                    <img src="../uploaded_files/<?= $fetch_service['image']; ?>" alt="" class="img">
                    <div class="flex-btn">
                        <input type="submit" name="delete_image" class="btn" value="delete image">
                        <a href="view_service.php" class="btn" style="width: 49%; text-align: center; height: 3rem; margin-top: .7rem;">go back</a>
                    </div>
                <?php } ?>
            </div>
                <div class="flex-btn">
                    <input type="submit" name="update" value="update service" class="btn">
                    <input type="submit" name="delete" value="delete service" class="btn">
                </div>
        </form>
    </div>
    <?php 
            }
        }else{
            echo '
               <div class="empty">
                            <p>no service added yet! </p>
                        </div>
            ';
        
    ?> 
    <?php } ?>
</div>   
</section>

<?php include '../components/admin_footer.php'; ?>




<script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.js"></script>
<script src="../js/admin_script.js"></script>

<?php include '../components/alert.php'; ?>

</body>
</html>