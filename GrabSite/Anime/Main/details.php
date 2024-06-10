<?php
$sn = "localhost";
$un = "root";
$ps = "";
$db = "anime";

$conn = new mysqli($sn, $un, $ps, $db);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}


function getMovieDetails($movieId)
{
    global $conn;

    $query = "SELECT * FROM movies WHERE MovieID = ?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("i", $movieId);
    $stmt->execute();

    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        return $result->fetch_assoc();
    } else {
        return false;
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
    <title>Grab & Watch | Movie Details</title>


    <link href="https://fonts.googleapis.com/css2?family=Oswald:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Mulish:wght@300;400;500;600;700;800;900&display=swap" rel="stylesheet">


    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">

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


    <header class="header">
        <div class="container">
            <div class="row d-flex justify-content-between">
                <div class="col-6 col-md-4 col-lg-3 d-flex flex-row align-items-baseline">
                    <div class="col-6 header__logo px-3 d-flex align-items-baseline">
                        <a href="./index.php">
                            <img src="img/logo.png" alt="">
                        </a>
                    </div>
                    <h3 class="col-6 lead text-light px-3">Grab & Watch</h3>
                </div>
                <div class="col-2 col-md-1 p-3 d-flex align-items-center">
                    <div class="text-center text-light">
                        <a href="./profile.php"><i class="bi bi-person-fill fs-1 text-light"></i></a>
                    </div>
                </div>
            </div>
        </div>
        <style>
            .set-bg {
                background-image: url('<?php echo $movieDetails["Image"]; ?>');
            }
        </style>
    </header>

    <section class="container">
            <?php
            if (isset($_GET['movie_id'])) {
                $movieId = $_GET['movie_id'];
                $movieDetails = getMovieDetails($movieId);
            
                if ($movieDetails) {
                    echo '<div class="row">
                            <div class="col-lg-12">
                                <div class="anime__details__text">
                                    <div class="anime__details__title">
                                    <h3>' . $movieDetails['Movie_Name'] . '</h3>
                                    </div>
                                    <p>' . $movieDetails['Description'] . '</p>
                                    <div class="anime__details__widget">
                                    <div class="row">
                                        <div class="col-lg-6 col-md-6">
                                            <ul>
                                                <li><span>Type:</span> ' . $movieDetails['Type'] . '</li>
                                                <li><span>Date aired:</span> ' . $movieDetails['Date'] . '</li>
                                                <li><span>Genre:</span> ' . $movieDetails['Genre'] . '</li>
                                            </ul>
                                        </div>
                                        <div class="col-lg-6 col-md-6">
                                            <ul>
                                                <li><span>Rating:</span> ' . $movieDetails['Rating'] . '</li>
                                                <li><span>Duration:</span> ' . $movieDetails['Duration'] . '</li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                                    <section class="anime-details my-3">
                                        <div class="container">
                                            <div class="row">
                                                <div class="col-lg-12 pb-4">
                                                    <div class="anime__video__player w-100 d-flex justify-content-center">
                                                    <iframe width="80%" style="aspect-ratio:16/9" 

                                                    src="https://www.youtube.com/embed/'. $movieDetails['URL'] .'" frameborder="0" allowfullscreen></iframe>
                                                </div>
                                            </div>
                                        </div>
                                    </section>
                                </div>
                            </div>
                        </div>';
                } else {
                    echo '<div class="col"><p class="text-danger">Movie details not available.</p></div>';
                }
            } else {
                echo '<div class="col"><p class="text-danger">Invalid request. Movie ID is missing.</p></div>';
            }
            ?>

    
    </section>

    <footer class="footer">
        <div class="page-up">
            <a href="#" id="scrollToTopButton"><span class="arrow_carrot-up"></span></a>
        </div>
        <div class="container">
            <div class="row d-flex justify-content-center">
                <div class="col-6 col-md-4 col-lg-3 d-flex flex-row align-items-center">
                    <div class="col-6 header__logo px-3 d-flex align-items-center">
                        <a href="./index.php">
                            <img src="img/logo.png" alt="">
                        </a>
                    </div>
                    <h3 class="col-6 lead text-light px-3">Grab & Watch</h3>
                </div>
                <div class="col-md-2 col-4 header__logo px-3 d-flex align-items-center">
                    <img src="https://www.aust.edu.lb/assets/images/home/banner-logo.webp">
                </div>
            </div>
            <div class="row">
                <div class="col mt-3 row d-flex justify-content-center text-center align-items-baseline">
                    <p class="col-4 px-3">Rabeeh Shehayeb</p>
                    <p class="col-4 px-3">Amir Moadad</p>
                    <p class="col-4 px-3">Jad Harfoush</p>
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