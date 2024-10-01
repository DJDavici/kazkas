<?php

if (isset($_POST["add"])) {

    include_once "connection.php";

    $title = $_POST['title'];
    $date = $_POST['date'];
    $description = $_POST['description'];

    if (!$conn) {
        die("Connection failed: " . mysqli_connect_error());
    }

    $sql = "INSERT INTO tasks (title, date, description) VALUES ('$title', '$date', '$description')";

    if (mysqli_query($conn, $sql)) {
        Header ("Location: index.php");
    } else {
        echo "Error: " . $sql . "<br>" . mysqli_error($conn);
    }

    mysqli_close($conn);

}

?>

<!doctype html>
<html lang="en">
<head>
    <link rel="stylesheet" href="style.css">
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>ok</title>
</head>
<body>

<form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="POST">
<label for="title">Title</label><br>
<input type="text" id="title" name="title"><br><br>
<label for="date">Date</label><br>
<input type="date" id="date" name="date"><br><br>
<label for="description">Description</label><br>
<input type="description" id="description" name="description"><br><br>
<input type="submit" name="add" id="add" value="Add"><br><br><br>
</form>
</body>
</html>


<?php

  include_once "connection.php";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}


$sql = "SELECT title, date, description FROM tasks";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    // output data of each row
    while($row = $result->fetch_assoc()) {
        echo "Title:  " . $row["title"]. "<br><br>". "Date:  " . $row["date"]. "<br><br>". "Description:  " . $row["description"]. "<br> <br><br><img src='pencil.svg' alt='Edit'>";
    }
} else {
    echo "0 results";
}
$conn->close();
?>
