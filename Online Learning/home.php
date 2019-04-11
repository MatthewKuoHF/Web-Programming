<?php
    include('session.php');
    session_start();
?>
<html>
    <head>
        <title>Home</title>
    </head>
    <body>
        <div>
            <p>Hello, <?php echo $_SESSION['login_user'];?>!      <a href="logout.php">Sign Out</a></p>
            <a href="html.html">HTML</a>
            <a href="php.html">PHP</a>
            <a href="mysql.html">MySQL</a>
        </div>
    </body>
</html>