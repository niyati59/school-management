<?php
include 'db.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $class_name = $_POST['class_name'];
    $teacher_id = $_POST['teacher_id'];

    $sql = "INSERT INTO classes (class_name, teacher_id) VALUES ('$class_name', $teacher_id)";
    if ($conn->query($sql) === TRUE) {
        echo "New class added successfully";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Manage Classes</title>
    <link rel="stylesheet" type="text/css" href="css/styles.css">
</head>
<body>
    <h1>Manage Classes</h1>
    <form method="POST" action="">
        Class Name: <input type="text" name="class_name" required><br>
        Teacher ID: <input type="number" name="teacher_id" required><br>
        <button type="submit">Add Class</button>
    </form>

    <h2>Class List</h2>
    <table>
        <tr>
            <th>ID</th>
            <th>Class Name</th>
            <th>Teacher ID</th>
        </tr>
        <?php
        $sql = "SELECT * FROM classes";
        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            while($row = $result->fetch_assoc()) {
                echo "<tr><td>".$row["id"]."</td><td>".$row["class_name"]."</td><td>".$row["teacher_id"]."</td></tr>";
            }
        } else {
            echo "<tr><td colspan='3'>No classes found</td></tr>";
        }
        ?>
    </table>
</body>
</html>
