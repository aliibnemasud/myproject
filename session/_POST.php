<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>

<form method="POST" action="demo_request.php">
  Name: <input type="text" name="fname">
  <input type="submit">
</form>

<?php
echo $_SERVER['PHP_SELF'];

$name = 'Linus';
echo '<h1>Hello $name</h1>';
echo "<h1>Hello $name</h1>";
?>
    
</body>
</html>