<?php
    include("config.php");
    session_start();    
/*
    $sql="SELECT * FROM user";
    $result = $conn->query($sql);
    if ($result->num_rows > 0) {
    // output data of each row
    while($row = $result->fetch_assoc()) {
        echo "username: " . $row["username"]. " - Name: " . $row["name"]."<br>";
    }
    } else {
        echo "0 results";
    }
*/    
    if($_SERVER["REQUEST_METHOD"] == "POST") {
        $username = $_POST['username'];
        $password = $_POST['password'];
        $repassword = $_POST['repassword'];
        $name = $_POST['name'];
        $question = $_POST['question'];
        $answer = $_POST['answer'];
        if($password==$repassword){
            $sql = "INSERT INTO a3_user (username, password, name, question, answer) VALUES('$username', '$password', '$name', '$question', '$answer')";
            if ($conn->query($sql) === TRUE) {
                echo "New record created successfully";
                header('location: home.php');
            } 
            else {
                echo "Error: " . $sql . "<br>" . $conn->error;
            }
        }
        else{
            echo "Re-type password is different";
        }
    }
?>
<html>
    <head>
        <title>Register</title>
    </head>
    <body>
        <a href="home.php">Home</a>
        <form action = "" method = "post">
            <label>Username: </label><input type = "text" name = "username"/><br /><br />
            <label>Password: </label><input type = "password" name = "password"/><br/><br />
            <label>Re-type Password: </label><input type = "password" name = "repassword"/><br/><br />
            <label>Name: </label><input type = "text" name = "name"/><br /><br />
            <label>Security Question: </label><input type = "text" name = "question"/><br/><br />
            <label>Answer: </label><input type = "text" name = "answer"/><br/><br />
            <input type = "submit" value = "Submit "/><br/>
        </form>
    </body>
</html>