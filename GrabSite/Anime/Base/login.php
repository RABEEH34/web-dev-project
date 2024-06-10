<?php
session_start();

$errorMsg = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST['Username'], $_POST['Password'])) {
        $username = $_POST['Username'];
        $password = $_POST['Password'];

        $sn = "localhost";
        $un = "root";
        $ps = "";
        $db = "anime";

        $con = new mysqli($sn, $un, $ps, $db);

        if ($con->connect_error) {
            die("Connection failed: " . $con->connect_error);
        }

        $sql = "SELECT * FROM admins WHERE Username = ? AND Password = ?";
        $stmt = $con->prepare($sql);
        $stmt->bind_param("ss", $username, $password);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows > 0) {
            $_SESSION['Username'] = $username;
            header("Location: adminmain.php");
            exit();
        } else {
            $errorMsg = "Invalid Username or password";
        }

        $stmt->close();
        $con->close();
    } else {
        $errorMsg = "Username and/or password not provided";
    }
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
    <title>Admin | Log In</title>
    <link rel="stylesheet" href="log.css">

<body>

    <section class="login spad">
        <div class="login__form">
            <h3>Login</h3>
            <form action="" method="post">
                <div class="input__item">
                    <input type="text" placeholder="Username" name="Username">
                    <span class="icon_mail"></span>
                </div>
                <div class="input__item">
                    <input type="password" placeholder="Password" name="Password">
                    <span class="icon_lock"></span>
                </div>
                <button type="submit" class="site-btn">Login Now</button>
                <p><?php echo $errorMsg; ?></p>
            </form>
        </div>
    </section>

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