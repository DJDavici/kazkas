<?php
include_once "connection.php";

if (isset($_GET['id'])) {
    $id = $_GET['id'];

    // Fetch the current data for the task
    $sql = "SELECT * FROM tasks WHERE id = '$id'";
    $result = mysqli_query($conn, $sql);
    $task = mysqli_fetch_assoc($result);
}

if (isset($_POST["update"])) {
    $title = $_POST['title'];
    $ddate = $_POST['ddate'];
    $description = $_POST['description'];

    $sql = "UPDATE tasks SET title='$title', ddate='$ddate', description='$description' WHERE id='$id'";

    if (mysqli_query($conn, $sql)) {
        header("Location: index.php");
    } else {
        echo "Error updating record: " . mysqli_error($conn);
    }
}

mysqli_close($conn);
?>

<!doctype html>
<html lang="en">
<head>
    <link rel="stylesheet" href="style.css">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Task</title>
</head>
<body>

<form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]) . '?id=' . $id; ?>" method="POST">
    <label for="title">Title</label><br>
    <input type="text" id="title" name="title" value="<?php echo $task['title']; ?>"><br><br>

    <label for="ddate">Due Date</label><br>
    <input type="datetime-local" id="ddate" name="ddate" value="<?php echo date('Y-m-d\TH:i', strtotime($task['ddate'])); ?>"><br><br>

    <label for="description">Description</label><br>
    <input type="text" id="description" name="description" value="<?php echo $task['description']; ?>"><br><br>

    <input type="submit" name="update" id="update" value="Update"><br><br>
</form>

</body>
</html>
