
<?php
    session_start();
    error_reporting(0);

    include_once("connectdb.php");
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


<!-- =========================
    NAVIGATION 
========================== -->
<nav class="navigation dark-bg">
    <div class="wrapper">
        <!-- NAVIGATION HEADER -->
        <div class="navbar-header">
            <!-- LOGO -->
            <a class="navigation-logo" href="profile.php">
                <img src="images/logo.png" alt="logo">
            </a>
        </div>
        <!-- NAVIGATION LINKS -->
        <ul class="navigation-links" data-navigation-handle=".navbar-header">
            <li>
                <a href="#" class="external">Features</a> <!-- external link (out of this page) -->
                <!-- DROP DOWN -->
                <ul>
                    <li><a href="features/history.php">History</a></li>
                </ul>
            </li>
        </ul>
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
                Welcome to <span class="colored-text">Head Hunters</span>
            </h1>

            <!-- SUB HEADING -->
            <p class="sub-heading">
                Find new talents in the job industry for a <span class="colored-text">logical price</span>!
            </p>

            <!-- LOGIN -->
            <h2>Returning Member?</h2>
            <form class="iform" method="post">
                <input type="text" name="username" value="" placeholder="Username or Email">
                <input type="password" name="password" value="" placeholder="Password">
                <input type="submit" name="login" value="Login"></input>

                <?php
                    $acclogin = $_POST["username"];
                    $accpassw = $_POST["password"];
                    //if enter is pressed after info is provided. search db for the user.
                    if (isset($_POST["login"])) {
                        $sql1 = "SELECT pid 
                                FROM person 
                                WHERE (username='".$acclogin."' OR mail='".$acclogin."') AND password='".$accpassw."' ";
                        
                        $sql2 = "SELECT cid
                                 FROM company
                                 WHERE (username='".$acclogin."' OR mail='".$acclogin."') AND password='".$accpassw."' ";

                        /* STORE QUERY RESULTS */
                        $result1 = mysqli_query($dbconn, $sql1);
                        $row1 = mysqli_fetch_row($result1);

                        $result2 = mysqli_query($dbconn, $sql2);
                        $row2 = mysqli_fetch_row($result2);

                        if (empty($row1[0])) {
                            /* the login is a COMPANY */
                            $_SESSION['cid'] = $row2[0];

                            mysqli_free_result($result1);
                            mysqli_free_result($result2);
                            echo "<script>window.location.assign('user/profile-company.php');</script>";
                        }
                        else if (empty($row[2])) {
                            /* the login is a PERSON */
                            $_SESSION['pid'] = $row1[0];

                            mysqli_free_result($result1);
                            mysqli_free_result($result2);
                            echo "<script>window.location.assign('user/profile.php');</script>";
                        }
                        else {
                            echo "<p align='center'><font color='red'><br><br><br><br>Wrong username or password.</font></p>";
                        }
                    }
                 ?>
            </form>
        </div> <!-- /END WRAPPER -->
        <p class="isignup">
            <p>Not a member yet?</p>
            <a href="/signup/choose.php" class="colored-text" style="padding-bottom:50px;">Sign up!</a>
        </p>
    </div> <!-- /END COLOR OVERLAY -->
</header>


<!-- =========================
    TEAM   
========================= -->
<section class="team" id="team">
    <div class="wrapper">
    
        <!-- HEADING -->
        <h2>MEET OUR TEAM</h2>

        <!-- SUB HEADING -->
        <p class="sub-heading">Say Hello!</p>

        <!-- LINE -->
        <div class="main-line"></div>

        <!-- SINGLE MEMBER -->
        <div class="single-member">
            <!-- MEMBER PHOTO -->
            <img src="images/aggelos.jpg" alt="">
            
            <div class="member-info">
                <!-- HEADING -->
                <h5>Aggelos Koropoulis</h5>

                <!-- SUB HEADING -->
                <span>Database designer</span>

                <!-- BIO -->
                <p>
                    My name, is Aggelos Koropoulis. After 5 years in hell I have come back with one goal. To save my city. In order to do that I had to become someone else. Something else. I am Warriorsapopaidi.
                </p>
                
                <!-- SOCIAL MEDIA -->
                <a href="#" target="_blank"><i class="fa fa-facebook"></i></a>
                <a href="#" target="_blank"><i class="fa fa-twitter"></i></a>
                <a href="http://tinyurl.com/hjnuovl" target="_blank"><i class="fa fa-google-plus"></i></a></a>
            </div>
        </div>
        
        <!-- SINGLE MEMBER -->
        <div class="single-member">
            <!-- MEMBER PHOTO -->
            <img src="images/pavlos.jpg" alt="">
            
            <div class="member-info">
                <!-- HEADING -->
                <h5>Pavlos Panteliadis</h5>
                
                <!-- SUB HEADING -->
                <span>Website Designer</span>
                
                <!-- BIO -->
                <p>
                    Scissors cuts paper, paper covers rock, rock crushes lizard, lizard poisons Spock, Spock smashes scissors, scissors decapitates lizard, lizard eats paper, paper disproves Spock, Spock vaporizes rock, and as it always has, rock crushes scissors.
                </p>
                
                <!-- SOCIAL MEDIA -->
                <a href="http://fb.com/pavlos.panteliadis.4" target="_blank"><i class="fa fa-facebook"></i></a>
                <a href="https://twitter.com/PavlosPnt" target="_blank"><i class="fa fa-twitter"></i></a>
                <a href="https://goo.gl/snM0ps" target="_blank"><i class="fa fa-google-plus"></i></a>
            </div>
        </div>
        
    </div> <!-- /END WRAPPER -->
</section>


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
========================== -->
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

<?php 
    mysqli_close($dbconn);
?>
</body>
</html>
