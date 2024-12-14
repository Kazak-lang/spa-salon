<?php
    include 'components/connect.php';

    if(isset($_COOKIE['user_id'])){
        $user_id = $_COOKIE['user_id'];
    }else{
        $user_id = '';
    }

?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>seller registration page</title>
    <link rel="stylesheet" type="text/css" href="css/user_style.css" >
    <link rel="stylesheet" href="https://unpkg.com/boxicons@2.1.2/css/boxicons.min.css">
</head>
<body>

<?php include 'components/user_header.php'; ?>

<div class="banner">
    <div class="detail">
        <h1>about us</h1>
        <p>Lorem ipsum dolor sit amet consectetur adipisicing elit.</p>
        <span><a href="home.php">home</a><i class="bx bx-right-arrow-alt"></i>about us</span>
    </div>
</div>
<div class="who-container">
    <div class="box-container">
        <div class="box">
            <div class="heading">
            <span>who wa are</span>
            <h1>We are passinate about making beatiful</h1>
            <img src="image/layer.png" alt="" width="100">
        </div>
        <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Rem nisi praesentium velit quas voluptate a, nesciunt omnis est unde impedit porro consequatur quia sapiente maxime eos iure quos architecto non.</p>
        <div class="flex-btn">
            <a href="service.php" class="btn" >explore our services</a>
            <a href="about.php" class="btn">visit our spa salon</a>
        </div>
    </div>
    <div class="img-box">
        <img src="image/gallery-spa-3.jpg" alt="" class="img">
    </div>
  </div>
</div>

<div class="spa-offer">
    <div class="detail">
        <span>New service</span>
        <h1>aromatheraphy</h1>
        <h2>save 25%</h2>
        <a href="contact.php" class="btn">contact us</a>
    </div>
</div>

<div class="advntages">
    <div class="detail">
        <div class="heading">
            <span>advntages</span>
            <h1>why people choose us</h1>
            <img src="image/layer.png" alt="" width="100">
        </div>
        <div class="box-container">
            <div class="box">
                <i class="bx bxs-leaf"></i>
                <h1>ecological cosmetics</h1>
                <p>Lorem ipsum dolor sit amet consectetur adipisicing.</p>
            </div>
            <div class="box">
                <i class="bx bxs-flask"></i>
                <h1>author's recipes</h1>
                <p>Lorem ipsum dolor sit amet consectetur adipisicing.</p>
            </div>
            <div class="box">
                <i class="bx bxs-droplet"></i>
                <h1>ecological cosmetics</h1>
                <p>Lorem ipsum dolor sit amet consectetur adipisicing. Lorem ipsum dolor, sit amet consectetur adipisicing elit.</p>
            </div>
            <div class="box">
                <i class="bx bxs-user"></i>
                <h1>ecological cosmetics</h1>
                <p>Lorem ipsum dolor sit amet consectetur adipisicing.</p>
            </div>
        </div>
    </div>
</div>

<div class="massage-offer">
    <div class="detail">
        <h1>30% OFF</h1>
        <span>for all massages</span>
        <p>Lorem ipsum dolor sit amet consectetur, adipisicing elit. Eligendi <br>laborum aut, aperiam laboriosam similique aliquid molestiae ab ad nulla, inventore consectetur <br> sapiente cum vitae tenetur ea omnis culpa neque. Alias?</p>
        <a href="" class="btn">book appointment</a>
    </div>
</div>

<div class="spa-service">
    <div class="heading">
        <span>for our clients</span>
        <h1>high quality spa services</h1>
        <img src="image/layer.png" alt="" width="100">
        <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Impedit aliquam voluptatibus magnam architecto eveniet deleniti dolore itaque laudantium consequatur. Numquam itaque pariatur reiciendis ad illo repudiandae sint, corporis ipsam quisquam.</p>
    </div>
    <div class="box-container">
        <div class="box">
            <img src="image/spa-1.jpg" alt="">
            <h1>media-SPA & massage</h1>
            <div class="divider"><div class="separator"></div></div>
            <p>Lorem ipsum dolor, sit amet consectetur adipisicing elit. Ut, fuga?</p>
            <p class="price"><del>BYN60.00</del>BYN40.00</p>
        </div>
        <div class="box">
            <img src="image/spa-2.jpg" alt="">
            <h1>media-SPA & massage</h1>
            <div class="divider"><div class="separator"></div></div>
            <p>Lorem ipsum dolor, sit amet consectetur adipisicing elit. Ut, fuga?</p>
            <p class="price"><del>BYN60.00</del>BYN40.00</p>
        </div>
        <div class="box">
            <img src="image/spa-3.jpg" alt="">
            <h1>media-SPA & massage</h1>
            <div class="divider"><div class="separator"></div></div>
            <p>Lorem ipsum dolor, sit amet consectetur adipisicing elit. Ut, fuga?</p>
            <p class="price"><del>BYN60.00</del>BYN40.00</p>
        </div>
        <div class="box">
            <img src="image/spa-4.jpg" alt="">
            <h1>media-SPA & massage</h1>
            <div class="divider"><div class="separator"></div></div>
            <p>Lorem ipsum dolor, sit amet consectetur adipisicing elit. Ut, fuga?</p>
            <p class="price"><del>BYN60.00</del>BYN40.00</p>
        </div>
    </div>
</div>

<div class="offer-1">
    <div class="detail">
        <h1><span>50%</span>on first couple spa</h1>
        <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Veritatis ducimus error dolor vitae praesentium animi consequatur at, numquam nisi quidem aliquam cum voluptatum, expedita debitis assumenda corrupti et velit commodi.</p>
        <a href="" class="btn">book appointments</a>
    </div>
</div>

<div class="about">
    <div class="box-container">
        <div class="box">
            <div class="heading">
                <span>about company</span>
                <h1>Lirena spa salon and wellness center</h1>
                <img src="image/layer.png" alt="">
            </div>
            <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Tenetur esse non laudantium, illo voluptatem iure veritatis placeat doloribus nisi incidunt magni asperiores ea excepturi pariatur quos! Repellat laudantium sequi a?</p>
            <div class="flex-btn">
                <a href="" class="btn">explore more</a>
                <a href="" class="btn">contact us</a>
            </div>
        </div>
    </div>
</div>


<ul class="slider">
  <li class="item item1" style="background-image: url('image/slider.jpg')"><span>Lirena</span></li>
  <li class="item item2" style="background-image: url('image/slider0.jpg')"><span>Spa</span></li>
  <li class="item item3" style="background-image: url('image/slider1.jpg')"><span>Salon</span></li>
  <li class="item item4" style="background-image: url('image/slider2.jpg')"><span>Service</span></li>
</ul>



<?php include 'components/user_footer.php'; ?>

<script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.js"></script>
<script src="js/user_script.js"></script>

<?php include 'components/alert.php'; ?>

</body>
</html>