<?php
// Handle form submission
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $servername = "localhost";
    $username = "root";
    $password = ""; // Add your password if set
    $database = "mydb";

    // Create connection
    $conn = new mysqli($servername, $username, $password, $database);

    // Check connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // Get and sanitize input
    $name = htmlspecialchars(trim($_POST["name"]));
    $email = htmlspecialchars(trim($_POST["email"]));
    $age = htmlspecialchars(trim($_POST["age"]));

    // Insert query
    $sql = "INSERT INTO users (name, email, age) VALUES ('$name', '$email', '$age')";

    if ($conn->query($sql) === TRUE) {
        $message = "✅ New record inserted successfully!";
    } else {
        $message = "❌ Error: " . $conn->error;
    }

    $conn->close();
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Insert User</title>
    <style>
        body { font-family: Arial, sans-serif; padding: 20px; }
        input[type="text"], input[type="email"] {
            padding: 8px; width: 300px; margin-bottom: 10px;
        }
        input[type="submit"] {
            padding: 8px 16px;
        }
        .message { margin-top: 15px; font-weight: bold; }
    </style>
</head>
<body>

<h2>Add New User</h2>

<form method="post" action="">
    <label>Name:</label><br>
    <input type="text" name="name" required><br>

    <label>Email:</label><br>
    <input type="email" name="email" required><br>
    <label>Age:</label><br>
    <input type="text" placeholder="Age" name="age"> <br>

    <input type="submit" value="Submit">
</form>

<?php if (!empty($message)): ?>
    <div class="message"><?php echo $message; ?></div>
<?php endif; ?>

</body>
</html>
