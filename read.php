<?php
$servername = "localhost";
$username = "root";
$password = ""; // Add your MySQL password if set
$database = "mydb";

// Create connection
$conn = new mysqli($servername, $username, $password, $database);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Read from database
$sql = "SELECT id, name, email, age FROM users";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    echo "<h2>User List</h2>";
    echo "<table border='1' cellpadding='5'>";
    echo "<tr><th>ID</th><th>Name</th><th>Email</th> <th>Age</th></tr>";
    while($row = $result->fetch_assoc()) {
        echo "<tr>";
        echo "<td>". $row["id"] ."</td>";
        echo "<td>". $row["name"] ."</td>";
        echo "<td>". $row["email"] ."</td>";
        echo "<td>". $row["age"] ."</td>";
        echo "</tr>";
    }
    echo "</table>";
} else {
    echo "No records found.";
}

$conn->close();
?>
