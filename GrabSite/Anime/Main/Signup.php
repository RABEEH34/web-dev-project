<?php
$errorMsg = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $Email = $_POST['Email'];
    $Name = $_POST['Name'];
    $Password = sha1($_POST['Password']);

    $sn = "localhost";
    $un = "root";
    $ps = "";
    $db = "anime";

    $con = new mysqli($sn, $un, $ps, $db);
    if ($con->connect_error) {
        die("Connection Failed" . $con->connect_error);
    }

    $sql = "SELECT * FROM users WHERE Email = '$Email'";
    $result = $con->query($sql);

    if ($result->num_rows > 0) {
        $errorMsg = "User with this email already exists";
    } else {
        $sql1 = "INSERT INTO users (Email, Name, Password) VALUES ('$Email', '$Name', '$Password')";

        if ($con->query($sql1) === TRUE) {
            $errorMsg = "Created successfully";
        } else {
            $errorMsg = "Error creating user: " .   $con->error;
        }
    }

    $con->close();
}
?>

<!DOCTYPE html>
<html lang="zxx">

<head>
    <meta charset="UTF-8">
    <meta name="description" content="Anime Template">
    <meta name="keywords" content="Anime, unica, creative, html">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Grab & Watch | Sign Up</title>

    <link href="https://fonts.googleapis.com/css2?family=Oswald:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Mulish:wght@300;400;500;600;700;800;900&display=swap" rel="stylesheet">

    <link rel="stylesheet" href="css/bootstrap.min.css" type="text/css">
    <link rel="stylesheet" href="css/font-awesome.min.css" type="text/css">
    <link rel="stylesheet" href="css/elegant-icons.css" type="text/css">
    <link rel="stylesheet" href="css/plyr.css" type="text/css">
    <link rel="stylesheet" href="css/nice-select.css" type="text/css">
    <link rel="stylesheet" href="css/owl.carousel.min.css" type="text/css">
    <link rel="stylesheet" href="css/slicknav.min.css" type="text/css">
    <link rel="stylesheet" href="css/style.css" type="text/css">
</head>

<body>

    <div id="preloder">
        <div class="loader"></div>
    </div>



    <section class="normal-breadcrumb set-bg" data-setbg="img/normal-breadcrumb.jpg">
        <div class="container">
            <div class="row">
                <div class="col-lg-12 text-center">
                    <div class="normal__breadcrumb__text">
                        <h2>Sign Up</h2>
                        <p>Welcome to the official Grab & Watch Website</p>

                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="signup spad">

        <div class="login__form">
            <h3>Sign Up</h3>
            <form action="Signup.php" method="POST">
                <div class="input__item">
                    <input type="text" placeholder="Email address" name="Email">
                    <span class="icon_mail"></span>
                </div>
                <div class="input__item">
                    <input type="text" placeholder="Your Name" name="Name">
                    <span class="icon_profile"></span>
                </div>
                <div class="input__item">
                    <input type="text" placeholder="Password" name="Password">
                    <span class="icon_lock"></span>
                </div>
                <button type="submit" class="site-btn">Sign Up Now</button>
            </form>

            <p><?php echo $errorMsg; ?></p>

            <h5>Already have an account? <br><a href="./Login.php">Log In!</a></h5>
        </div>

    </section>

    <footer class="footer">
        <div class="page-up">
            <a href="#" id="scrollToTopButton"><span class="arrow_carrot-up"></span></a>
        </div>
        <div class="container">
            <div class="row d-flex justify-content-center justify-content-lg-between">
                <div class="col-4 col-md-4 col-lg-3 d-flex flex-row align-items-baseline">
                    <div class="col-6 header__logo px-3 d-flex align-items-baseline">
                        <a href="#">
                            <img src="img/logo.png" alt="">
                        </a>
                    </div>
                    <h3 class="col-6 lead text-light px-3">Grab & Watch</h3>
                </div>
                <div class="col-lg-6 mt-3 row d-flex justify-content-evenly text-center align-items-baseline">
                    <p class="col-4">Rabeeh Shehayeb</p>
                    <p class="col-4">Amir Moadad</p>
                    <p class="col-4">Jad Harfoush</p>
                </div>
                <div class="col-2 header__logo px-3 d-flex align-items-baseline">
                    <img src="https://www.aust.edu.lb/assets/images/home/banner-logo.webp">
                </div>
            </div>
        </div>
    </footer>

    

    <script src="js/jquery-3.3.1.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script src="js/player.js"></script>
    <script src="js/jquery.nice-select.min.js"></script>
    <script src="js/mixitup.min.js"></script>
    <script src="js/jquery.slicknav.js"></script>
    <script src="js/owl.carousel.min.js"></script>
    <script src="js/main.js"></script>

</body>

</html>