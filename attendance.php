<?php
include 'db.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $student_id = $_POST['student_id'];
    $date = $_POST['date'];
    $status = $_POST['status'];

    $sql = "INSERT INTO attendance (student_id, date, status) VALUES ($student_id, '$date', '$status')";
    if ($conn->query($sql) === TRUE) {
        echo "Attendance recorded successfully";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Manage Attendance</title>
    <link rel="stylesheet" type="text/css" href="css/styles.css">
</head>
<body>
    <h1>Manage Attendance</h1>
    <form method="POST" action="">
        Student ID: <input type="number" name="student_id" required><br>
        Date: <input type="date" name="date" required><br>
        Status: <select name="status" required>
            <option value="Present">Present</option>
            <option value="Absent">Absent</option>
        </select><br>
        <button type="submit">Record Attendance</button>
    </form>

    <h2>Attendance Records</h2>
    <table>
        <tr>
            <th>ID</th>
            <th>Student ID</th>
            <th>Date</th>
            <th>Status</th>
        </tr>
        <?php
        $sql = "SELECT * FROM attendance";
        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            while($row = $result->fetch_assoc()) {
                echo "<tr><td>".$row["id"]."</td><td>".$row["student_id"]."</td><td>".$row["date"]."</td><td>".$row["status"]."</td></tr>";
            }
        } else {
            echo "<tr><td colspan='4'>No attendance records found</td></tr>";
        }
        ?>
    </table>
</body>
</html>
