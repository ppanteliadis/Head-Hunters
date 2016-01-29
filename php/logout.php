<?php
    session_start();
    session_destroy();

    if (isset($_SESSION['username'])) {
        $msg = "You are now logged out";
    }
    else {
        $msg = "Loggin was not possible :'(";
    }
?>

<!DOCTYPE html>
<title>Head Hunters</title>
<html>
<body>
<!-- FONT AWESOME -->
<link rel="stylesheet" href="css/font-awesome.min.css">

<!-- FORMSTONE NAVIGATION -->
<link rel="stylesheet" href="css/navigation.css">

<!-- COLORS -->
<link rel="stylesheet" href="css/colors/blue.css"> 
<!-- CUSTOM STYLESHEET -->
<link rel="stylesheet" href="css/styles.css">

<!-- RESPONSIVE FIXES -->
<link rel="stylesheet" href="css/responsive.css">

<!-- Jquery -->
<script src="js/jquery-2.0.3.min.js"></script>

<nav class="navigation dark-bg">
    <div class="wrapper">
        <!-- NAVIGATION HEADER -->
        <div class="navbar-header">
            <!-- LOGO -->
            <a class="navigation-logo" href="profile.php">
                <img src="images/logo.png" alt="logo">
            </a>    
        </div>
    </div> <!-- /END WRAPPER -->
</nav>

<!-- =========================
    INDEX
========================= -->
<header class="index dark-bg" id="index">
    <div class="color-overlay">
        <div class="iwrapper">
            <!-- HEADING -->
            <h1>
                You are now <span class="colored-text">Logged out</span>!
            </h1>
            <p><a href="login.php">Click here</a> to return to the login page.</p>
    </div> <!-- /END COLOR OVERLAY -->
</header>


<!-- =========================
     CONTACT   
========================= -->   
<section class="contact dark-bg" id="contact">
    <div class="color-overlay">
        <div class="wrapper">
    
            <!-- HEADING -->
            <h2>Contact Us</h2>
            
            <!-- LINE -->
            <div class="main-line"></div>
            
            <!-- CONTACT INFORMATION -->
            <ul class="styled-icon-list">
                <!-- SINGLE LIST ITEM -->
                <li>
                    <!-- ICON -->
                    <div class="icon">
                        <i class="fa fa-envelope-o"></i>
                    </div>
                    <!-- CONTENT -->
                    <p class="list-content"><span><a href="mailto:panteliad@csd.uoc.gr">panteliad@csd.uoc.gr</a></span></p>
                </li>

                <!-- SINGLE LIST ITEM -->
                <li>
                    <!-- ICON -->
                    <div class="icon">
                        <i class="fa fa-envelope-o"></i>
                    </div>
                    <!-- CONTENT -->
                    <p class="list-content"><span><a href="mailto:koropulis@csd.uoc.gr">koropulis@csd.uoc.gr</a></span></p>
                </li>
                
                <!-- SINGLE LIST ITEM -->
                <li>
                    <!-- ICON -->
                    <div class="icon">
                        <i class="fa fa-map-marker"></i>
                    </div>
                    <!-- CONTENT -->
                    <p class="list-content"><span>Heraklion, Crete</span></p>
                </li>
                
            </ul>
            
        </div> <!-- /END WRAPPER -->
    </div> <!-- /END OVERLAY -->
</section>


<!-- =========================
     FOOTER   
========================= -->   
<footer class="dark-bg">
    <!-- BACK TO TOP -->
    <a class="icon back-to-top" href="#home"><i class="fa fa-home"></i></a>
</footer>


<script>
//make sure that js is enabled
$('html').addClass('js');
</script>

<!-- =========================
    SCRIPTS
========================= -->   
<!-- Formstone Navigation -->
<script src="js/core.js"></script>
<script src="js/mediaquery.js"></script>
<script src="js/swap.js"></script>
<script src="js/touch.js"></script>
<script src="js/navigation.js"></script>

<!-- Smoothscroll -->
<script src="js/smoothscroll.js"></script>

<!-- Jquery Nav -->
<script src="js/jquery.nav.js"></script>

<!-- ImagesLoaded -->
<script src="js/jquery.imagesloaded.js"></script>

<!-- Wookmark -->
<script src="js/jquery.wookmark.min.js"></script>

<!-- Retina -->
<script src="js/retina.min.js"></script>

<!-- Custom Script -->
<script src="js/custom.js"></script>


</body>
</html>