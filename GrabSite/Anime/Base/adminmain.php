<?php
session_start();

if (!isset($_SESSION['Username'])) {
    header("Location: login.php");
    exit();
}

$loggedInUser = $_SESSION['Username'];

$sn = "localhost";
$un = "root";
$ps = "";
$db = "anime";

$con = new mysqli($sn, $un, $ps, $db);

if ($con->connect_error) {
    die("Connection failed: " . $con->connect_error);
}

$sqlUsers = "SELECT ID, Name, Email FROM users";
$resultUsers = $con->query($sqlUsers);

$users = array();
if ($resultUsers->num_rows > 0) {
    while ($row = $resultUsers->fetch_assoc()) {
        $users[] = $row;
    }
}

$sqlmov = "SELECT * FROM movies";
$resultmov = $con->query($sqlmov);

$mov = array();
if ($resultmov->num_rows > 0) {
    while ($row = $resultmov->fetch_assoc()) {
        $mov[] = $row;
    }
}

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['update_movie'])) {
    $movieID = $_POST['movie_id'];
    $newName = $_POST['new_name'];
    $newType = $_POST['new_type'];
    $newGenre = $_POST['new_genre'];
    $newDuration = $_POST['new_duration'];
    $newRating = $_POST['new_rating'];
    $newDate = $_POST['new_date'];
    $newDescription = $_POST['new_description'];
    $newURL = $_POST['new_URL'];


    $updateSql = "UPDATE movies SET Movie_Name=?, Type=?, Genre=?, Duration=?, Rating=?, Date=?, Description=?, URL=? WHERE MovieID=?";
    $stmt = $con->prepare($updateSql);
    $stmt->bind_param("sssssssi", $newName, $newType, $newGenre, $newDuration, $newRating, $newDate, $newDescription, $movieID , $newURL);
    $stmt->execute();
    $stmt->close();

    foreach ($mov as &$movie) {
        if ($movie['MovieID'] == $movieID) {
            $movie['Movie_Name'] = $newName;
            $movie['Type'] = $newType;
            $movie['Genre'] = $newGenre;
            $movie['Duration'] = $newDuration;
            $movie['Rating'] = $newRating;
            $movie['Date'] = $newDate;
            $movie['Description'] = $newDescription;
            $movie['URL'] = $newURL;
            break;
        }
    }
}

$con->close();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard</title>
    <link rel="stylesheet" href="styles.css">
</head>

<body>
    <div class="header">
        <h1>Welcome <?php echo $loggedInUser; ?></h1>
        <a href="login.php"><button>Logout</button></a>
        <a href="Admin.php"><button>ADD MOVIE</button></a>
    </div>

    <div class="admin-section">
        <h2>User Management</h2>
        <table>
            <tr>
                <th>ID</th>
                <th>Name</th>
                <th>Email</th>
            </tr>
            <?php foreach ($users as $user) : ?>
                <tr>
                    <td><?php echo $user['ID']; ?></td>
                    <td><?php echo $user['Name']; ?></td>
                    <td><?php echo $user['Email']; ?></td>
                </tr>
            <?php endforeach; ?>
        </table>
    </div>

    <div class="admin-section">
        <h2>Movies you have</h2>
        <table>
            <tr>
                <th>ID</th>
                <th>Name</th>
                <th>Type</th>
                <th>Genre</th>
                <th>Duration</th>
                <th>Rating</th>
                <th>Date</th>
                <th>Description</th>
                <th>URL</th>
                <th>Edit The Thing You Want</th>
            </tr>
            <?php foreach ($mov as $movi) : ?>
                <tr>
                    <td><?php echo $movi['MovieID']; ?></td>
                    <td><?php echo $movi['Movie_Name']; ?></td>
                    <td><?php echo $movi['Type']; ?></td>
                    <td><?php echo $movi['Genre']; ?></td>
                    <td><?php echo $movi['Duration']; ?></td>
                    <td><?php echo $movi['Rating']; ?></td>
                    <td><?php echo $movi['Date']; ?></td>
                    <td><?php echo $movi['Description']; ?></td>
                    <td><?php echo $movi['URL']; ?></td>
                    <td>
                        <form method="post" action="">
                            <input class="add" type="hidden" name="movie_id" value="<?php echo $movi['MovieID']; ?>">
                            <input class="add" type="text" name="new_name" placeholder="New Name" required>
                            <input class="add" type="text" name="new_type" placeholder="New Type"required>
                            <input class="add" type="text" name="new_genre" placeholder="New Genre"required>
                            <input class="add" type="text" name="new_duration" placeholder="New Duration"required>
                            <input class="add" type="text" name="new_rating" placeholder="New Rating"required>
                            <input class="add" type="date" name="new_date" placeholder="New Date"required>
                            <input class="add" type="text" name="new_description" placeholder="New Description"required>
                            <input class="add" type="text" name="new_URL" placeholder="new URL"required>

                            <button type="submit" name="update_movie">Update</button>
                        </form>
                    </td>
                </tr>
            <?php endforeach; ?>
        </table>
    </div>
</body>

</html>