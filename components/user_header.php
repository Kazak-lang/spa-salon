

<header class="header" style="z-index: 1000;">
    <section class="flex">
        <a href="home.php" class="logo"><img src="image/logo.png" alt="" width="130px"></a>
        <nav class="navbar">
            <a href="home.php">home</a>
            <a href="about.php">about us</a>
            <a href="services.php">services</a>
            <a href="team.php">team</a>
            <a href="book_appointment.php">appointment</a>
            <a href="contact.php">contact</a>
        </nav>
        <form action="search_service.php" method="post" class="search-form">
            <input type="text" name="search_service" placeholder="search product..." required maxlength = "100">
            <button type="submit" class="bx bx-search-alt-2" id="search_product_btn"></button>
        </form>
        <div class="icons">

            <div class="bx bx-search-alt-2" id="search-btn"></div>

            <div class="bx bx-user" id="user-btn"></div>
        </div>
        <div class="profile">
             <?php 
                $select_profile = $conn->prepare("SELECT * FROM `users` WHERE id = ?");
                $select_profile->execute([$user_id]);

                if($select_profile->rowCount() > 0){
                    $fetch_profile = $select_profile->fetch(PDO::FETCH_ASSOC);           
            ?>
            <img src="uploaded_files/<?= $fetch_profile['image'];?>" alt="">
            <h3 style="margin-bottom: 1rem;"><?= $fetch_profile['name'];?></h3>
            <div class="flex-btn">
                <a href="profile.php" class="btn">view profile</a>
                <a href="components/user_logout.php" onclick="return confirm('logout from this website');" class="btn">logout</a>
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
    </section>
</header>