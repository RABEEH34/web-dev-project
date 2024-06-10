<?php
$errorMsg = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $movieName = $_POST['movieName'];
    $type = $_POST['type'];
    $genre = $_POST['genre'];
    $duration = $_POST['duration'];
    $rating = $_POST['rating'];
    $date = $_POST['date'];
    $description = $_POST['description'];
    $URL = $_POST['URL'];

    $targetDirectory = "http://localhost/Anime/ups/";
    $targetFile = $targetDirectory . ($_FILES["image"]["name"]);
    $uploadOk = 1;
    $imageFileType = strtolower(pathinfo($targetFile, PATHINFO_EXTENSION));

    $check = getimagesize($_FILES["image"]["tmp_name"]);
    if ($check !== false) {
        $uploadOk = 1;
    } else {
        $errorMsg = "File is not an image.";
        $uploadOk = 0;
    }

    if (file_exists($targetFile)) {
        $errorMsg = "Sorry, a file with the same name already exists.";
        $uploadOk = 0;
    }



    if (!in_array($_FILES["image"]["type"], ['image/jpeg', 'image/png', 'image/gif'])) {
        $errorMsg = "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
        $uploadOk = 0;
    }

    if ($uploadOk == 0) {
        $errorMsg .= " Sorry, your file was not uploaded.";
    } else {

        $errorMsg .= " Sorry, there was an error uploading your file.";
    }


    if ($uploadOk == 1) {
        $sn = "localhost";
        $un = "root";
        $ps = "";
        $db = "anime";
        $con = new mysqli($sn, $un, $ps, $db);
        if ($con->connect_error) {
            die("Connection Failed" . $con->connect_error);
        }

        $sql = "INSERT INTO movies (Movie_Name, Type, Genre, Duration, Rating, Date, Description, image,URL) 
                VALUES ('$movieName', '$type', '$genre', '$duration', '$rating', '$date', '$description', '$targetFile',$URL)";

        if ($con->query($sql) === TRUE) {
            $errorMsg = "Movie information added successfully";
        } else {
            $errorMsg = "Error: " . $sql . "<br>" . $con->error;
        }

        $con->close();
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Movie Information Form</title>
    <link rel="stylesheet" href="ad.css">

    <script>
        document.addEventListener('keydown', function(e) {
            if (e.key === 'Backspace' && !['input', 'textarea'].includes(e.target.tagName.toLowerCase())) {
                e.preventDefault();
            }
        });
    </script>
</head>


<body>

    <form action="Admin.php" method="POST" enctype="multipart/form-data">
        <br>
        <br>
        <br>
        <br>
        <br>
        <br>


        <label for="movieName">Movie Name:</label>
        <input type="text" id="movieName" name="movieName">

        <label for="type">Type:</label>
        <input type="text" id="type" name="type">

        <label for="genre">Genre:</label>
        <input type="text" id="genre" name="genre">

        <label for="duration">Duration:</label>
        <input type="text" id="duration" name="duration">

        <label for="rating">Rating:</label>
        <input type="text" id="rating" name="rating">

        <label for="date">Date:</label>
        <input type="date" id="date" name="date">

        <label for="description">Description:</label>
        <textarea id="description" name="description" rows="4"></textarea>

        <label for="description">URL:</label>
        <textarea id="description" name="description" rows="4"></textarea>

        <label class="custom-file-input" for="image">Choose File</label>
        <input type="file" id="image" name="image" accept="image/*" required>

        <p><?php echo $errorMsg; ?></p>

        <button type="submit">Submit</button>

        <button><a href="adminmain.php" style="text-decoration: none; color:white;">Back</a></button>

    </form>

</body>

</html>