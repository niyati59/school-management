<?php
include 'db.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $name = $_POST['name'];
    $subject = $_POST['subject'];

    $sql = "INSERT INTO teachers (name, subject) VALUES ('$name', '$subject')";
    if ($conn->query($sql) === TRUE) {
        echo "New teacher added successfully";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Manage Teachers</title>
    <link rel="stylesheet" type="text/css" href="styles.css">
</head>
<body>
    <h1>Manage Teachers</h1>
    <form method="POST" action="">
        Name: <input type="text" name="name" required><br>
        Subject: <input type="text" name="subject" required><br>
        <button type="submit">Add Teacher</button>
    </form>

    <h2>Teacher List</h2>
    <table>
        <tr>
            <th>ID</th>
            <th>Name</th>
            <th>Subject</th>
        </tr>
        <?php
        $sql = "SELECT * FROM teachers";
        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            while($row = $result->fetch_assoc()) {
                echo "<tr><td>".$row["id"]."</td><td>".$row["name"]."</td><td>".$row["subject"]."</td></tr>";
            }
        } else {
            echo "<tr><td colspan='3'>No teachers found</td></tr>";
        }
        ?>
    </table>
</body>
</html>
