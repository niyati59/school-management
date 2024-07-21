<?php
include 'db.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $name = $_POST['name'];
    $dob = $_POST['dob'];
    $gender = $_POST['gender'];
    $class_id = $_POST['class_id'];

    $sql = "INSERT INTO students (name, dob, gender, class_id) VALUES ('$name', '$dob', '$gender', $class_id)";
    if ($conn->query($sql) === TRUE) {
        echo "New student added successfully";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Manage Students</title>
    <link rel="stylesheet" type="text/css" href="styles.css">
</head>
<body>
    <h1>Manage Students</h1>
    <form method="POST" action="">
        Name: <input type="text" name="name" required><br>
        DOB: <input type="date" name="dob" required><br>
        Gender: <select name="gender" required>
            <option value="Male">Male</option>
            <option value="Female">Female</option>
        </select><br>
        Class ID: <input type="number" name="class_id" required><br>
        <button type="submit">Add Student</button>
    </form>

    <h2>Student List</h2>
    <table>
        <tr>
            <th>ID</th>
            <th>Name</th>
            <th>DOB</th>
            <th>Gender</th>
            <th>Class ID</th>
        </tr>
        <?php
        $sql = "SELECT * FROM students";
        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            while($row = $result->fetch_assoc()) {
                echo "<tr><td>".$row["id"]."</td><td>".$row["name"]."</td><td>".$row["dob"]."</td><td>".$row["gender"]."</td><td>".$row["class_id"]."</td></tr>";
            }
        } else {
            echo "<tr><td colspan='5'>No students found</td></tr>";
        }
        ?>
    </table>
</body>
</html>
