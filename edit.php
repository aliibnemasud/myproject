<?php
$servername = "localhost";
$username = "root";
$password = "";
$database = "mydb";

// Connect to DB
$conn = new mysqli($servername, $username, $password, $database);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$message = "";
$editId = $name = $email = "";

// Step 1: Handle form submission
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["update"])) {
    $editId = intval($_POST["id"]);
    $name = htmlspecialchars(trim($_POST["name"]));
    $email = htmlspecialchars(trim($_POST["email"]));
    $age = htmlspecialchars(trim($_POST["age"]));

    $sql = "UPDATE users SET name='$name', email='$email', age='$age' WHERE id=$editId";
    if ($conn->query($sql) === TRUE) {
        $message = "✅ User updated successfully!";
    } else {
        $message = "❌ Update failed: " . $conn->error;
    }
}

// Step 2: If update button clicked, load user data
if ($_SERVER["REQUEST_METHOD"] == "GET" && isset($_GET["edit"])) {
    $editId = intval($_GET["edit"]);
    $result = $conn->query("SELECT * FROM users WHERE id = $editId");
    if ($result && $result->num_rows === 1) {
        $row = $result->fetch_assoc();
        $name = $row["name"];
        $email = $row["email"];
        $age = $row["age"];
    }
}

// Step 3: Get all users
$users = $conn->query("SELECT * FROM users ORDER BY id ASC");
?>

<!DOCTYPE html>
<html>
<head>
    <title>User Management</title>
    <style>
        body { font-family: Arial, sans-serif; padding: 20px; }
        table { border-collapse: collapse; width: 100%; margin-bottom: 30px; }
        th, td { border: 1px solid #ccc; padding: 8px; text-align: left; }
        form input[type="text"], form input[type="email"] {
            width: 300px; padding: 8px; margin-bottom: 10px;
        }
        .message { font-weight: bold; margin-bottom: 15px; }
        a.btn { text-decoration: none; padding: 6px 12px; background-color: #007bff; color: white; border-radius: 4px; }
        a.btn:hover { background-color: #0056b3; }
    </style>
</head>
<body>

<h2>All Users</h2>

<?php if ($message): ?>
    <div class="message"><?php echo $message; ?></div>
<?php endif; ?>

<table>
    <tr>
        <th>ID</th><th>Name</th><th>Email</th><th>Action</th><th>Age</th>
    </tr>
    <?php while($user = $users->fetch_assoc()): ?>
    <tr>
        <td><?php echo $user["id"]; ?></td>
        <td><?php echo htmlspecialchars($user["name"]); ?></td>
        <td><?php echo htmlspecialchars($user["email"]); ?></td>
        <td><?php echo htmlspecialchars($user["age"]); ?></td>
        <td><a class="btn" href="?edit=<?php echo $user["id"]; ?>">Update</a></td>
    </tr>
    <?php endwhile; ?>
</table>

<?php if ($editId): ?>
<h2>Edit User</h2>
<form method="POST" action="">
    <input type="hidden" name="id" value="<?php echo $editId; ?>">

    <label>Name:</label><br>
    <input type="text" name="name" value="<?php echo htmlspecialchars($name); ?>" required><br>

    <label>Email:</label><br>
    <input type="email" name="email" value="<?php echo htmlspecialchars($email); ?>" required><br>

    <label>Age:</label><br>
    <input type="text" name="age" value="<?php echo htmlspecialchars($age); ?>" required><br>

    <input type="submit" name="update" value="Update">
</form>
<?php endif; ?>

</body>
</html>
