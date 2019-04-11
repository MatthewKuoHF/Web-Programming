<?php
    include("config.php");
    session_start();
    if($_SERVER["REQUEST_METHOD"] == "POST") {
      $usr = $_POST['usr'];
      $sql = "SELECT * FROM a3_user WHERE username = '$usr'";
      $result = $conn->query($sql);
      if ($result->num_rows == 1) {
        $_SESSION['forget_user'] = $usr;
        header("location: retrieve.php");    
    } else {
            echo "Username does not exist.<br>";
    }
   }
?>
<html>
    <head>
        <title>Forget Password?</title>
    </head>
    <body>
        <a href="home.php">Home</a>
        <form method="post">
            <label>Username: </label><input type="text" name="usr"><br>
            <input type="submit" name="forget" value="Retrieve">
        </form>
    </body>
</html>