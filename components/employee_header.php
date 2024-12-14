<header>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/boxicons/2.0.9/css/boxicons.min.css">
    <div class="logo">
        <img src="../image/logo.png" alt="" width="130">
    </div>
    <div class="right">
        <div class="bx bxs-user" id="user-btn"></div>
        <div class="bx bx-menu" id="toggle-btn"></div>
    </div>
    <div class="profile-detail">
             <?php 
                $select_profile = $conn->prepare("SELECT * FROM `employee` WHERE id = ?");
                $select_profile->execute([$admin_id]);

                if($select_profile->rowCount() > 0){
                    $fetch_profile = $select_profile->fetch(PDO::FETCH_ASSOC);           
            ?>
            <div class="profile">
                <img src="../uploaded_files/<?= $fetch_profile['profile'];?>" alt="" class="logo-img">
                <p><?= $fetch_profile['name'];?></p>
            </div>
            
            <div class="flex-btn">
                <a href="profile.php" class="btn"> profile</a>
                <a href="../components/employee_logout.php" onclick="return confirm('logout from this website');" class="btn">logout</a>
            </div>
            <?php }else{ ?>

                <img src="image/man.png" alt="">
                <h3 style="margin-bottom: 1rem;">please login or register</h3>
                <div class="flex-btn" style="background-color: var(--white-alpha-25);">
                    <a href="login.php" class="btn">login</a>
                    <a href="register.php" class="btn">register</a>
                </div>
                <?php } ?>
        </div>
</header>

    <div class="sidebar">
        <?php 
            $select_profile = $conn->prepare("SELECT * FROM `employee` WHERE id = ?");
            $select_profile->execute([$admin_id]);

            if($select_profile->rowCount() > 0){
                $fetch_profile = $select_profile->fetch(PDO::FETCH_ASSOC);           
        ?>
        <div class="profile">
        <img src="../uploaded_files/<?= $fetch_profile['profile'];?>" alt="" class="logo-img">
        <p><?= $fetch_profile['name']; ?></p>
        </div>
        <?php }
        
        
        ?>
        
        <h5>menu</h5>
        <div class="navbar">
            <ul>
            <li><a href="view_service.php"><i class="bx bxs-food-menu"></i>view service</a></li>
            <li><a href="view_employee.php"><i class="bx bxs-food-menu"></i>view emplyee</a></li>
            <li><a href="../components/employee_logout.php" onclick="return confirm('logout from this website?');"><i class="bx bx-log-out"></i>logout</a></li>
            </ul>
        </div>
        <h5>find us</h5>
        <div class="social-links">
            <i class="bx bxl-facebook"></i>
            <i class="bx bxl-instagram-alt"></i>
            <i class="bx bxl-linkedin"></i>
            <i class="bx bxl-twitter"></i>
            <i class="bx bxl-pinterest-alt"></i>
        </div>
    </div>

<script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.js"></script>