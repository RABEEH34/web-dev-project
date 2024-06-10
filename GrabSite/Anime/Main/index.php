<?php

session_start();

$errorMsg = "";


if (isset($_SESSION['Username'])) {
    $loggedInUser = $_SESSION['Username'];

    $sn = "localhost";
    $un = "root";
    $ps = "";
    $db = "anime";

    $con = new mysqli($sn, $un, $ps, $db);

    if ($con->connect_error) {
        die("Connection failed: " . $con->connect_error);
    }

    $sql = "SELECT Email, Password FROM users WHERE Name = ?";
    $stmt = $con->prepare($sql);
    $stmt->bind_param("s", $loggedInUser);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $existingEmail = htmlspecialchars($row["Email"]);
        $existingPassword = htmlspecialchars($row["Password"]);
    } else {

        $existingEmail = "";
        $existingPassword = "";
    }

    $stmt->close();
    $con->close();
} else {

    // header("Location: index.php");
    // exit();
}



$sn = "localhost";
$un = "root";
$ps = "";
$db = "anime";

$conn = new mysqli($sn, $un, $ps, $db);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

function getAllMovies()
{
    global $conn;

    $query = "SELECT * FROM movies";
    $result = $conn->query($query);

    $movies = [];

    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            $movies[] = $row;
        }
    }

    return $movies;
}

$moviesList = getAllMovies();
?>


<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <meta name="description" content="Anime Template">
    <meta name="keywords" content="Anime, unica, creative, html">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Grab & Watch | Home</title>


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
    <link rel="stylesheet" href="css/View.css" type="text/css">

    <style>
        .search-box {
            width: fit-content;
            height: fit-content;
            position: relative;
        }

        .input-search {
            height: 50px;
            width: 50px;
            border-style: none;
            padding: 10px;
            font-size: 18px;
            letter-spacing: 2px;
            outline: none;
            border-radius: 25px;
            transition: all .5s ease-in-out;
            background-color: #e53637;
            padding-right: 40px;
            color: #fff;
        }

        .input-search::placeholder {
            color: rgba(255, 255, 255, .5);
            font-size: 18px;
            letter-spacing: 2px;
            font-weight: 100;
        }

        .btn-search {
            width: 50px;
            height: 50px;
            border-style: none;
            font-size: 20px;
            font-weight: bold;
            outline: none;
            cursor: pointer;
            border-radius: 50%;
            position: absolute;
            right: 0px;
            color: #ffffff;
            background-color: transparent;
            pointer-events: painted;
        }

        .btn-search:focus~.input-search {
            width: 300px;
            border-radius: 0px;
            background-color: transparent;
            border-bottom: 1px solid rgba(255, 255, 255, .5);
            transition: all 500ms cubic-bezier(0, 0.110, 0.35, 2);
        }

        .input-search:focus {
            width: 300px;
            border-radius: 0px;
            background-color: transparent;
            border-bottom: 1px solid rgba(255, 255, 255, .5);
            transition: all 500ms cubic-bezier(0, 0.110, 0.35, 2);
        }
    </style>
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
                        <a href="./login.php"><i class="bi bi-person-fill fs-1 text-light"></i></a>
                    </div>
                </div>
            </div>
        </div>
    </header>

    <section class="hero">
        <div class="container">
            <div class="hero__slider owl-carousel">
                <div class="hero__items set-bg" data-setbg="img/hero/F9.webp">
                    <div class="row">
                        <div class="col-lg-6">
                            <div class="hero__text">
                                <div class="label">Adventure</div>
                                <h2>Mad 18</h2>
                                <p>After 30 days of travel across the world...</p>
                                <a href="#"><span>Watch Now</span> <i class="fa fa-angle-right"></i></a>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="hero__items set-bg" data-setbg="img/hero/Joker.jpg">
                    <div class="row">
                        <div class="col-lg-6">
                            <div class="hero__text">
                                <div class="label">Horror</div>
                                <h2>Invador</h2>
                                <p>After 30 days of travel across the world...</p>
                                <a href="#"><span>Watch Now</span> <i class="fa fa-angle-right"></i></a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="my-3">
        <div class="container-fluid px-2 m-0">
            <div class="row m-0 p-3 justify-content-lg-around">
                <div class="col-lg-8 col-md-12 col-sm-12 mx-2">
                    <div class="popular__product p-0">
                        <div class="row d-flex flex-row-reverse mx-3 mb-3">
                            <form method="post">
                                <div class="search-box">
                                    <button type="submit" class="btn-search"><i class="icon_search"></i></button>
                                    <input type="text" class="input-search" id="searchMovieName" name="searchMovieName" placeholder="Type to Search..." required>
                                </div>
                            </form>
                        </div>
                        <div class="row d-flex justify-content-between">
                            <div class="col-6">
                                <div class="section-title">
                                    <h4>Movies</h4>
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="primary-btn d-flex justify-content-end align-items-center">
                                    <ul class="w-100 d-flex justify-content-end" id="movie_filter">
                                        <li class="mx-2" data-filter="all_movies">All</li>
                                        <li class="mx-2" data-filter="Action">Action</li>
                                        <li class="mx-2" data-filter="Thriller">Thriller</li>
                                        <li class="mx-2" data-filter="Sci-Fi">Sci-Fi</li>
                                        <li class="mx-2" data-filter="Fantasy">Fantasy</li>
                                        <li class="mx-2" data-filter="Adventure">Adventure</li>
                                        <li class="mx-2" data-filter="Animation">Animation</li>
                                        <li class="mx-2" data-filter="Drama">Drama</li>
                                        <li class="mx-2" data-filter="Comedy">Comedy</li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <?php
                            foreach ($moviesList as $movie) {
                                echo '
                            <div class="col-lg-4 col-md-4 col-sm-6 movie-item ' . $movie["Genre"] . '">
                                <a href="details.php?movie_id=' . htmlspecialchars($movie['MovieID']) . '">
                                    <div class="product__item">
                                        <div class="product__item__pic set-bg" data-setbg="' . $movie["Image"] . '">
                                            <div class="ep">' . $movie["Rating"] . '</div>
                                            <div class="comment"><i class="fa fa-comments"></i> ' . $movie["Date"] . '</div>
                                            <div class="view"><i class="fa fa-eye"></i>' . $movie["Duration"] . '</div>
                                        </div>
                                        <div class="product__item__text">
                                            <ul>
                                                <li>' . $movie["Genre"] . '</li>
                                                <li>' . $movie["Type"] . '</li>
                                            </ul>
                                            <h5 class="text-light"><strong>' . htmlspecialchars($movie['Movie_Name']) . '</strong></h5>
                                        </div>
                                    </div>
                                </a>
                            </div>';
                            }
                            ?>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-md-4 col-sm-12 mx-3">
                    <div class="product__sidebar">
                        <div class="product__sidebar__view">
                            <div class="section-title">
                                <h5>Food</h5>
                            </div>
                            <div class="filter__gallery">
                                <a href="https://order.bklebanon.com/" target="_blank">
                                    <div class="product__sidebar__view__item set-bg" data-setbg="img/Food/burgur_king.webp">
                                        <div class="ep">Burger King</div>
                                        <div class="view">Delivery</div>
                                    </div>
                                </a>
                                <a href="https://mcdelivery.mcdonalds.com.lb/lb/browse/menu.html" target="_blank">
                                    <div class="product__sidebar__view__item set-bg" data-setbg="img/Food/Mac.png">
                                        <div class="ep">McDonald's</div>
                                        <div class="view">Delivery</div>
                                    </div>
                                </a>
                                <a href="https://order.zaatarwzeit.com/" target="_blank">
                                    <div class="product__sidebar__view__item set-bg" data-setbg="img/Food/Zaatar.jpeg">
                                        <div class="ep">Zaatar w Zeit</div>
                                        <div class="view">Delivery</div>
                                    </div>
                                </a>
                                <a href="https://uae.pizzahut.me/en/home" target="_blank">
                                    <div class="product__sidebar__view__item set-bg" data-setbg="img/Food/pizzahut.png">
                                        <div class="ep">Pizza Hut</div>
                                        <div class="view">Delivery</div>
                                    </div>
                                </a>
                                <a href="https://www.starbucks.com/menuks_URL" target="_blank">
                                    <div class="product__sidebar__view__item set-bg" data-setbg="img/Food/Starbucks.jpeg">
                                        <div class="ep">Starbucks</div>
                                        <div class="view">Dine In</div>
                                    </div>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
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
                        <a href="./index.php">
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

    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>

    <script>
        $(document).ready(function () {
          
            $('#movie_filter li').click(function () {
               
                $('#movie_filter li').removeClass('active');

            
                $(this).addClass('active');

                var selectedGenre = $(this).data('filter');

                if (selectedGenre === 'all_movies') {
                    $('.movie-item').show();
                } else {
                    $('.movie-item').hide();
                    $('.' + selectedGenre).show();
                }
            });
        });
    </script>

</body>

</html>