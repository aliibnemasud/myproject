<?php
session_start();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    

    
    <h2>Session Variables</h2>
    <p>Favorite Color: <?php echo $_SESSION["favcolor"]; ?></p>
    <p>Favorite Animal: <?php echo $_SESSION["favanimal"]; ?></p>


</body>
</html>