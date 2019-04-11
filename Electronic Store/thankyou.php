<html>
    <head>
        <title>Thank You!!</title>
    </head>
    <body>
        <div><a href="welcome.php">Home</a>  <a href="logout.php">Sign Out</a></div>
        <p>Thank you for your purchase!!</p>
    </body>
</html>
<?php
    include('session.php');
    $sql = "DELETE FROM cart";
    $conn->query($sql);
?>