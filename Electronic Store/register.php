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
        $fname = $_POST['fname'];
        $lname = $_POST['lname'];
        $email = $_POST['email'];
        $address = $_POST['address'];
        $question = $_POST['question'];
        $answer = $_POST['answer'];
        $name = $fname." ".$lname;
        $sql = "INSERT INTO user (username, password, name, email, address, question, answer) VALUES('$username', '$password', '$name', '$email', '$address', '$question', '$answer')";
        
        if ($conn->query($sql) === TRUE) {
            echo "New record created successfully";
            header('location: welcome.php');
        } 
        else {
            echo "Error: " . $sql . "<br>" . $conn->error;
        }
    }

?>

<html>
    <head>
        <title>Register</title>
    </head>
    <body>
        <a href="welcome.php">Home</a>
        <form action = "" method = "post">
            <label>Username: </label><input type = "text" name = "username"/><br /><br />
            <label>Password: </label><input type = "password" name = "password"/><br/><br />
            <label>First name: </label><input type = "text" name = "fname"/><br /><br />
            <label>Last name: </label><input type = "text" name = "lname"/><br /><br />
            <label>Email: </label><input type = "text" name = "email"/><br/><br />
            <label>Address: </label><input type = "text" name = "address"/><br/><br />
            <label>Security Question: </label><input type = "text" name = "question"/><br/><br />
            <label>Answer: </label><input type = "text" name = "answer"/><br/><br />
            <input type = "submit" value = "Submit "/><br/>
        </form>
    </body>

</html>