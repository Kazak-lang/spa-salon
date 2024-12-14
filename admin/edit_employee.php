<?php 
	include '../components/connect.php';

	if (isset($_COOKIE['admin_id'])){
		$admin_id = $_COOKIE['admin_id'];
	}else{
		$admin_id = '';
        header('location:login.php');
	}

    // edit employee in db

    if(isset($_POST['update'])){
        $employee_id = $_POST['employee_id'];
        $employee_id = filter_var($employee_id, FILTER_SANITIZE_STRING);

        $name = $_POST['name'];
        $name = filter_var($name, FILTER_SANITIZE_STRING);

        $email = $_POST['email'];
        $email = filter_var($email, FILTER_SANITIZE_STRING);

        $profession = $_POST['profession'];
        $profession = filter_var($profession, FILTER_SANITIZE_STRING);
  
        $status = $_POST['status'];    
        $status = filter_var($status, FILTER_SANITIZE_STRING);  

        $number = $_POST['number'];    
        $number = filter_var($number, FILTER_SANITIZE_STRING); 
        
        
        $profile_desc = $_POST['content'];    
        $profile_desc = filter_var($profile_desc, FILTER_SANITIZE_STRING); 

        $update_employee = $conn->prepare("UPDATE `employee` SET name = ?, email = ?, profession = ?, status = ?, number = ?, profile_desc = ? WHERE id = ?");
        $update_employee ->execute([$name, $email, $profession, $status, $number, $profile_desc, $employee_id]);

        $success_msg[] = 'employee updated';


        $old_image = $_POST['old_image'];
        $image = $_FILES['image']['name'];
        $image = filter_var($image, FILTER_SANITIZE_STRING);

        $ext = pathinfo($image, PATHINFO_EXTENSION);
        $rename = unique_id().'.'.$ext;
        $image_size = $_FILES['image']['size'];
        $image_tmp_name = $_FILES['image']['tmp_name'];
        $image_folder = '../uploaded_files/'.$rename;



        $select_image = $conn->prepare("SELECT * FROM `employee` WHERE profile = ? AND id = ?");
        $select_image->execute([$image, $employee_id]);

        if(!empty($image)){
            if($image_size > 2000000){
                $warning_msg[] = 'image size is too large';
            }elseif($select_image->rowCount() > 0){
                $warning_msg[] = 'please rename your image';
            }else{
                $update_image = $conn->prepare("UPDATE `employee` SET profile = ? WHERE id = ?");
                $update_image->execute([$rename, $employee_id]);
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

    //delete employee

    if (isset($_POST['delete'])) {
        $employee_id = $_POST['employee_id'];
        $employee_id = filter_var($employee_id, FILTER_SANITIZE_STRING);
        
        $delete_image = $conn->prepare("SELECT * FROM `employee` WHERE id = ?");
        $delete_image->execute([$employee_id]);
        $fetch_delete_image = $delete_image->fetch(PDO::FETCH_ASSOC);
        
        if ($fetch_delete_image['image'] != '') {
            unlink('../uploaded_files/'.$fetch_delete_image['image']);
        }
        
        $delete_employee = $conn->prepare("DELETE FROM `employee` WHERE id = ?");
        $delete_employee->execute([$employee_id]);
        
        $success_msg[] = 'employee deleted successfully! ';
        header( 'location: view_employee.php' );
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
        <h1>Edit employee</h1>
        <p>Lorem ipsum dolor sit amet consectetur adipisicing elit.</p>
        <span><a href="dashboard.php">admin</a><i class="bx bx-right-arrow-alt"></i>edit employee</span>
    </div>
</div>

<section class="add_services">
    <div class="heading">
        <h1>edit employee</h1>
        <img src="../image/layer.png" alt="" width="100">
    </div>
    <?php 
        $employee_id = $_GET['id'];
        $select_employee = $conn->prepare("SELECT * FROM `employee` WHERE id=?");
        $select_employee->execute([$employee_id]);
        if($select_employee->rowCount() > 0){
            while($fetch_employee = $select_employee->fetch(PDO::FETCH_ASSOC)){

    ?>
   <div class="form-container">
       <form action="" method="post" enctype="multipart/form-data" class="register">
       <input type="hidden" value="<?= $fetch_employee['profile'];?>" name="old_image">
       <input type="hidden" value="<?= $fetch_employee['id'];?>" name="employee_id">
           <div class="flex">
               <div class="col">
               <div class="input-field">
                <p>employee status <span>*</span></p>
                    <select name="status" class="box">
                        <option value="<?= $fetch_employee['status'];?>" selected><?= $fetch_employee['status'];?></option>
                        <option value="active">active</option>
                        <option value="deactive">deactive</option>
                    </select>
                </div>
                    <div class="input-field">
                        <p>employee name <span>*</span></p>
                        <input type="text" name="name" maxlength="100" value="<?= $fetch_employee['name']; ?>" class="box" required >
                    </div>
                    <div class="input-field">
                        <p>employee email <span>*</span></p>
                        <input type="email" name="email" maxlength="100" value="<?= $fetch_employee['email']; ?>" class="box" required >
                    </div>
               </div>
           </div>
           <div class="flex">
               <div class="col">
                    <div class="input-field">
                        <p>employee proffesion <span>*</span></p>
                        <input type="text" name="profession" maxlength="100" value="<?= $fetch_employee['profession']; ?>" class="box" required >
                    </div>
                    <div class="input-field">
                        <p>employee number <span>*</span></p>
                        <input type="text" name="number" maxlength="100" placeholder="+(375)(__)___-__-__" value="<?= $fetch_employee['number']; ?>" class="box" required id="phone">
                    </div>
               </div>
            </div>
            <div class="input-field">
                <p>employee description <span>*</span></p>
                <textarea name="content" class="box" required placeholder="employee description"><?= $fetch_employee['profile_desc']; ?></textarea>
            </div>
            <div class="input-field">
                <p>employee image <span>*</span></p>
                <input type="file" name="image" accept="image/*" class="box">
                <?php if($fetch_employee['profile'] !=''){?>
                    <img src="../uploaded_files/<?= $fetch_employee['profile']; ?>" alt="" class="img">
                    <div class="flex-btn">
                        <input type="submit" name="delete_image" class="btn" value="delete image">
                        <a href="view_employee.php" class="btn" style="width: 49%; text-align: center; height: 3rem; margin-top: .7rem;">go back</a>
                    </div>
                <?php } ?>
            </div>
                <div class="flex-btn">
                    <input type="submit" name="update" value="update employee" class="btn">
                    <input type="submit" name="delete" value="delete employee" class="btn">
                </div>
        </form>
    </div>
    <?php 
            }
        }else{
            echo '
               <div class="empty">
                            <p>no employee added yet! </p>
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