<?php 
	include '../components/connect.php';

	if (isset($_COOKIE['admin_id'])){
		$admin_id = $_COOKIE['admin_id'];
	}else{
		$admin_id = '';
        header('location:login.php');
	}

    // add service in db

    if(isset($_POST['add_service'])){
        
        $id = unique_id();

        $name = $_POST['name'];
        $name = filter_var($name, FILTER_SANITIZE_STRING);

        $price = $_POST['price'];
        $price = filter_var($price, FILTER_SANITIZE_STRING);

        $content = $_POST['content'];
        $content = filter_var($content, FILTER_SANITIZE_STRING);

        $category = $_POST['category'];
        $category = filter_var($category, FILTER_SANITIZE_STRING);
 
        $status = 'active';  
        
        $image = $_FILES['image']['name'];
        $image = filter_var($image, FILTER_SANITIZE_STRING);

        $image_size = $_FILES['image']['size'];
        $image_tmp_name = $_FILES['image']['tmp_name'];
        $image_folder = '../uploaded_files/'.$image;

        $select_image = $conn->prepare("SELECT * FROM `services` WHERE image = ?");
        $select_image->execute([$image]);

        if(isset($image)){
            if($select_image->rowCount() > 0){
                $warning_msg[] = 'image name repeated';
            }elseif($image_size > 2000000){
                $warning_msg[] = 'image size is too large';
            }
            else{
                move_uploaded_file($image_tmp_name, $image_folder);
            }
        }else{
            $image = '';
        }
        if($select_image->rowCount() > 0 AND $image !=''){
            $warning_msg[] = 'please rename your image';
        }
        else{
            $insert_product = $conn->prepare("INSERT INTO `services` (id, name, price, image, service_detail, category, status) VALUES(?,?,?,?,?,?,?)");
            $insert_product->execute([$id, $name, $price, $image, $content, $category, $status]);
            $success_msg[] = 'service added';
        }
    }

    // add service in db as draft

    if(isset($_POST['draft'])){
        
        $id = unique_id();

        $name = $_POST['name'];
        $name = filter_var($name, FILTER_SANITIZE_STRING);

        $price = $_POST['price'];
        $price = filter_var($price, FILTER_SANITIZE_STRING);

        $content = $_POST['content'];
        $content = filter_var($content, FILTER_SANITIZE_STRING);

        $category = $_POST['category'];
        $category = filter_var($category, FILTER_SANITIZE_STRING);
 
        $status = 'deactive';  
        
        $image = $_FILES['image']['name'];
        $image = filter_var($image, FILTER_SANITIZE_STRING);
        $ext = pathinfo($image, PATHINFO_EXTENSION);
        $rename = unique_id().'.'.$ext;
        $image_size = $_FILES['image']['size'];
        $image_tmp_name = $_FILES['image']['tmp_name'];
        $image_folder = '../uploaded_files/'.$rename;

        $select_image = $conn->prepare("SELECT * FROM `services` WHERE image = ?");
        $select_image->execute([$image]);

        if(isset($image)){
            if($select_image->rowCount() > 0){
                $warning_msg[] = 'image name repeated';
            }elseif($image_size > 2000000){
                $warning_msg[] = 'image size is too large';
            }
            else{
                move_uploaded_file($image_tmp_name, $image_folder);
            }
        }else{
            $image = '';
        }
        if($select_image->rowCount() > 0 AND $image !=''){
            $warning_msg[] = 'please rename your image';
        }
        else{
            $insert_product = $conn->prepare("INSERT INTO `services` (id, name, price, image, service_detail, category, status) VALUES(?,?,?,?,?,?,?)");
            $insert_product->execute([$id, $name, $price, $image, $content, $category, $status]);
            $success_msg[] = 'service save as draft';
        }


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
        <h1>Add service</h1>
        <p>Lorem ipsum dolor sit amet consectetur adipisicing elit.</p>
        <span><a href="dashboard.php">admin</a><i class="bx bx-right-arrow-alt"></i>add service</span>
    </div>
</div>

<section class="add_services">
    <div class="heading">
        <h1>add services</h1>
        <img src="../image/layer.png" alt="" width="100">
    </div>
   <div class="form-container">
       <form action="" method="post" enctype="multipart/form-data" class="register">
                    <div class="input-field">
                        <p>service name <span>*</span></p>
                        <input type="text" name="name" maxlength="100" placeholder="add service name" class="box" required >
                    </div>
                    <div class="input-field">
                        <p>service price <span>*</span></p>
                        <input type="number" name="price" maxlength="100" placeholder="add service price" class="box" required >
                    </div>
                    <div class="input-field">
                        <p>service descript <span>*</span></p>
                        <textarea name="content" class="box" required placeholder="service description"></textarea>
                    </div>
                    <div class="input-field">
                        <p>service category <span>*</span></p>
                        <select class="box" name="category" required>
                            <option disabled selected> select category</option>
                            <option value="spa programs">spa programs</option>
                            <option value="massages">massages</option>
                            <option value="facial">facial</option>
                            <option value="body treatment">body treatment</option>
                            <option value="for couple">sfor couple</option>
                        </select>
                    </div>
                    <div class="input-field">
                        <p>service image <span>*</span></p>
                        <input type="file" name="image" accept="image/*" class="box" required >
                    </div>
            
            <div class="flex-btn">
                <button type="submit" name="add_service" class="btn">add service</button>
                <button type="submit" name="draft" class="btn">save as draft</button>
            </div>
       </form>
</div>





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