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

<section class="home">
    <div class="container">
<div class="msg-container">
            <div id="slider" class="slider-class">
                <div class="msg-column">
                    <h1>Lirena Spa</h1>
                    <p>Lorem, ipsum dolor sit amet consectetur adipisicing elit. Qui exercitationem voluptatem quidem sit vero sequi quos a. Illum temporibus voluptatum non est sunt corporis, dolore, fugit, recusandae tempora eum doloremque.</p>
                        <button href="service.php" class="btn">View Service</button>
                    
                </div>
                <div class="msg-column">
                    <h1>Lirena Spa</h1>
                    <p>Lorem, ipsum dolor sit amet consectetur adipisicing elit. Qui exercitationem voluptatem quidem sit vero sequi quos a. Illum temporibus voluptatum non est sunt corporis, dolore, fugit, recusandae tempora eum doloremque.</p>
                    <button href="service.php" class="btn">View Service</button>
                </div>

                <div class="msg-column">
                <h1>Lirena Spa</h1>
                <p>Lorem, ipsum dolor sit amet consectetur adipisicing elit. Qui exercitationem voluptatem quidem sit vero sequi quos a. Illum temporibus voluptatum non est sunt corporis, dolore, fugit, recusandae tempora eum doloremque.</p>
                        <button href="service.php" class="btn">View Service</button>
                </div>

                <div class="msg-column">
                <h1>Lirena Spa</h1>
                <p>Lorem, ipsum dolor sit amet consectetur adipisicing elit. Qui exercitationem voluptatem quidem sit vero sequi quos a. Illum temporibus voluptatum non est sunt corporis, dolore, fugit, recusandae tempora eum doloremque.</p>
                    <button href="service.php" class="btn">View Service</button>
                </div>

            </div>
        </div>
        <div class="controller">
            <div class="line1" id="line1_id"></div>
            <div class="line2" id="line2_id"></div>
            <div class="line3" id="line3_id"></div>
            <div class="line4" id="line4_id"></div>
            <div class="active" id="active_id"></div>
        </div>
    </div>
    </>
</section>

<div class="for">
    <div class="box-container">
        <div class="box">
            <img src="image/him.jpg" alt="">
            <div class="detail">
                <h1>for</h1><h1>him</h1>
            </div>
        </div>
        <div class="box">
            <img src="image/her.jpg" alt="">
            <div class="detail">
                <h1>for</h1><h1>her</h1>
            </div>
        </div>
        <div class="box">
            <img src="image/couple.jpg" alt="">
            <div class="detail">
                <h1>for</h1><h1>couple</h1>
            </div>
        </div>
    </div>
</div>

<div class="service">
    <div class="heading">
        <h1>our services</h1>
    </div>
    <div class="box-container">
        <div class="box">
            <div class="icon">
                <div class="icon-box">
                    <img src="image/service-icon.png" alt="" class="img1">
                </div>
            </div>
            <div class="detail">
                <h4>body treatment</h4>
            </div>
        </div>
        <div class="box">
            <div class="icon">
                <div class="icon-box">
                    <img src="image/service-icon0.png" alt="" class="img1">
                </div>
            </div>
            <div class="detail">
                <h4>spa programs</h4>
            </div>
        </div>
        <div class="box">
            <div class="icon">
                <div class="icon-box">
                    <img src="image/service-icon1.png" alt="" class="img1">
                </div>
            </div>
            <div class="detail">
                <h4>massage</h4>
            </div>
        </div>
        <div class="box">
            <div class="icon">
                <div class="icon-box">
                    <img src="image/service-icon4.png" alt="" class="img1">
                </div>
            </div>
            <div class="detail">
                <h4>aroma therapy</h4>
            </div>
        </div>
        <div class="box">
            <div class="icon">
                <div class="icon-box">
                    <img src="image/service-icon2.png" alt="" class="img1">
                </div>
            </div>
            <div class="detail">
                <h4>for couple</h4>
            </div>
        </div>
        <div class="box">
            <div class="icon">
                <div class="icon-box">
                    <img src="image/service-icon3.png" alt="" class="img1">
                </div>
            </div>
            <div class="detail">
                <h4>facials</h4>
            </div>
        </div>
    </div>
    <div class="detail">
        <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Voluptate aperiam dolores saepe, pariatur placeat velit laboriosam facere, odit, vel iste et ex fugiat expedita exercitationem iusto! Architecto minus eum atque!</p>
        <a href="service.php" class="btn"> view our services</a>
    </div>
</div>
<img src="image/sub-banner.jpg" alt="" class="sub-banner">

<div class="frame-container">
    <div class="box-container">
        <div class="box">
            <div class="box-detail">
                <img src="image/frame.jpg" alt="" class="img">
                <div class="detail">
                    <span>wide range</span>
                    <h1>spa and wellness</h1>
                    <a href="service.php" class="btn">view our services</a>
                </div>
            </div>
            <div class="box-detail">
                <img src="image/frame0.avif" alt="" class="img">
                <div class="detail">
                    <span>wide range</span>
                    <h1>spa and massage</h1>
                    <a href="service.php" class="btn">view our services</a>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="about-us">
    <div class="box-container">
        <div class="img-box">
            <img src="image/choose.jpg" class="img">
            <img src="image/choose0.avif" class="img1">
            <div class="play"><i class="bx bx-play"></i></div>
        </div>
        <div class="box">
            <div class="heading">
                <span>why choose us</span>
                <h1>why our salon</h1>
                <img src="image/layer.png" alt="" width="100">
            </div>
            <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Nam at amet nulla. Cupiditate nam, pariatur sequi adipisci ab optio amet eveniet dolores ut repellat rerum, consectetur minus placeat, reprehenderit vero.</p>
            <a href="about.php" class="btn">know more</a>
            <a href="contact.php" class="btn">contact us</a>
        </div>
    </div>
</div>

<div class="vid-banner">
    <div class="overplay"></div>
        <video src="image/video.mp4" autoplay loop></video>
        <div class="detail">
            <h1>beauty and spa center</h1>
            <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Eveniet culpa dicta nam cum inventore, quasi, quaerat explicabo odit vitae eos iure ipsa repellendus minus odio tenetur accusamus veniam non. Ex?</p>
            <div class="flex-btn">
                <a href="" class="btn">explore more</a>
                <a href="about.php" class="btn">more about</a>
            </div>
        </div>
    </div>

    <div class="center">
        <div class="heading">
            <span>taking care of you</span>
            <h1>professional <br> massage & spa center</h1>
            <img src="image/layer.png" alt="">
        </div>
        <div class="box-container">
            <div class="box">
                <img src="image/center.jpg" alt="">
                <span>best products</span>
                <h1>online appointments</h1>
                <p>Consectetur adipisicing edit</p>
            </div>
            <div class="box">
                <img src="image/center0.jpg" alt="">
                <span>best products</span>
                <h1>gifts cards available</h1>
                <p>Consectetur adipisicing edit</p>
            </div>
            <div class="box">
                <img src="image/center1.jpg" alt="">
                <span>best products</span>
                <h1>special offers</h1>
                <p>Consectetur adipisicing edit</p>
            </div>
            <div class="box">
                <img src="image/center2.jpg" alt="">
                <span>best products</span>
                <h1>special treatments</h1>
                <p>Consectetur adipisicing edit</p>
            </div>
        </div>
    </div>
    <div class="offer">
        <div class="detail">
            <h1>Lorem ipsum dolor, sit amet consectetur adipisicing elit. <br> dolor molestias.</h1>
            <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Eligendi, dolores laboriosam. Provident blanditiis atque quam dolore inventore eos itaque, sit vero qui at architecto, error necessitatibus earum odio minus reiciendis! Sapiente illum reprehenderit delectus eveniet vel quasi ad magni quo quis. Asperiores quam temporibus natus maiores eaque optio aperiam ducimus?</p>
            <a href="" class="btn">book appointment</a>
        </div>
    </div>



























<?php include 'components/user_footer.php'; ?>

<script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.js"></script>
<script src="js/user_script.js"></script>

<?php include 'components/alert.php'; ?>

</body>
</html>