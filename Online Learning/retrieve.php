<?php
    include("config.php");
    session_start();
    $usr = $_SESSION['forget_user'];
    if($_SERVER["REQUEST_METHOD"] == "POST") {
      $sql = "SELECT question, answer, password FROM a3_user WHERE username = '$usr'";
      $result = $conn->query($sql);
        $row = $result->fetch_assoc();
        if($_POST['question']==$row['question'] and $_POST['answer']==$row['answer']){
            $password='<p style="color: red;">'.$row['password'].'</p>';
            echo "Your password is ".$password;
        }
        else{
            echo "The question or the answer is wrong.<br>";
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
            <label>Security Question: </label><input type="text" name="question"><br>
            <label>Answer: </label><input type="text" name="answer"><br>
            <input type="submit" name="check" value="Check">
        </form>
    </body>
</html>