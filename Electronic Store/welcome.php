<?php
    include('session.php');
    if($_SERVER["REQUEST_METHOD"] == "POST") {
        $itemID = $_POST['id'];
        $itemName = $_POST['name'];
        $itemPrice = $_POST['price'];
        $itemAmount = $_POST['amount'];
        /*echo "id".$itemID." ";
        echo "name".$itemName." ";
        echo "price".$itemPrice." ";
        echo "amount".$itemAmount." ";*/
        $sql = "INSERT INTO cart (buy_item_id, buy_item_name, buy_item_price, buy_item_amount) VALUES('$itemID', '$itemName', '$itemPrice', '$itemAmount')";
        $conn->query($sql);
    }
?>
<html>
    <head>
        <title>Welcome</title>
        <style>
            table, th, tr, td{border-color: black;border-collapse:collapse;border-style:solid;border-width:1px;border-collapse:collapse;padding:10px 5px;font-family:Arial;}
            p, a{
                padding-left: 10px;  
                padding-right: 10px;
            }
        </style>
    </head>
    <body>
        <p>Welcome! <?php #echo $login_session; 
            echo $_SESSION['login_user']; ?>    <a href="logout.php">Sign Out</a><a href="cart.php">Cart(<?php 
            $sql="SELECT COUNT(transactionID) FROM cart";
            $result = $conn->query($sql);
            $row = $result->fetch_assoc();
            echo $row['COUNT(transactionID)'];
        ?>)</a></p>
        <?php
            $sql="SELECT * FROM items";
            $result = $conn->query($sql);
            if ($result->num_rows > 0) {
                echo "<table>";
                ?>
                    <tr>
                        <td>ID</td>
                        <td>Name</td>
                        <td>Picture</td>
                        <td>Price</td>
                        <td>Description</td>
                        <td>Amount</td>
                        <td> </td>
                    </tr>
                <?php
                while($row = $result->fetch_assoc()) {
                    ?>
                    
                    <tr>
                        <form method="POST">
                            <td name="id">
                                <input type="hidden" name="id" value="<?php echo $row["itemID"];?>">
                                <?php echo $row["itemID"];?></td>
                            <td name="name"><input type="hidden" name="name" value="<?php echo $row["itemName"];?>"><?php echo $row["itemName"];?></td>
                            <td name="pic"><?php echo "<img src=".'"'.$row["itemPic"].'"'.' height="100" width="100" />' ;?></td>
                            <td name="price">
                                <input type="hidden" name="price" value="<?php echo $row["itemPrice"];?>">
                                <?php echo $row["itemPrice"];?></td>
                            <td name="des"><?php echo $row["itemDes"];?></td>
                            <td>
                                <select name="amount">
                                    <option value="1">1</option>
                                    <option value="2">2</option>
                                    <option value="3">3</option>
                                    <option value="4">4</option>
                                    <option value="5">5</option>
                                </select>    
                            </td>
                            <td><input type="submit" value="Buy"></td>
                        </form>
                    </tr>
                    <?php
                    #echo "<td>" . $row["itemName"]. "</td><td>" . $row["name"]."<br>";
                }
                echo "</table>";
            } 
            else {
                echo "No item!";
            }
        ?>
        <a href="cart.php">Check out</a>
    </body>
</html>