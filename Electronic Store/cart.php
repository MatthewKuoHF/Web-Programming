<?php
    include('session.php');
    
    if (isset($_POST['del'])) {
        #echo "del ".$_POST['id'];
        $sql = "DELETE FROM cart WHERE transactionID = ".'"'.$_POST['id'].'"';
        $conn->query($sql);
    }
    if (isset($_POST['clear'])) {
        $sql = "DELETE FROM cart";
        $conn->query($sql);
    }
?>

<html>
    <head>
        <title>Cart</title>
        <style>
            table, th, tr, td{border-color: black;border-collapse:collapse;border-style:solid;border-width:1px;border-collapse:collapse;padding:10px 5px;font-family:Arial;}
            .button {
              font: bold 11px Arial;
              text-decoration: none;
              background-color: #EEEEEE;
              color: #333333;
              padding: 2px 6px 2px 6px;
              border-top: 1px solid #CCCCCC;
              border-right: 1px solid #333333;
              border-bottom: 1px solid #333333;
              border-left: 1px solid #CCCCCC;
            }
        </style>
    </head>
    <body>
        <div><a href="welcome.php">Home</a>  <a href="logout.php">Sign Out</a></div>
        <?php 
            $total = 0;
            $sql="SELECT * FROM cart";
            $result = $conn->query($sql);
            if ($result->num_rows > 0) {
                echo "<table>";
                echo "<tr>
                    <td>Name</td>
                    <td>Price</td>
                    <td>Amount</td>
                    </tr>";
                while($row = $result->fetch_assoc()) {
            ?>
                    <form method="post">
                    <input type="hidden" name="id" value="<?php echo $row["transactionID"];?>">
                    <tr>
                    <td><?php echo $row['buy_item_name']; ?></td>
                    <td><?php echo $row['buy_item_price']; ?></td>
                    <td><?php echo $row['buy_item_amount']; 
                    $total = $total + (float)$row['buy_item_price'] * $row['buy_item_amount'];
                    ?></td>
                    <td><input type="submit" name="del" value="Delete this item"></td>
                    </tr>
                    </form>
        <?php
                }
                echo "<tr><td colspan='3'>"."Total: $".$total."</td></tr>";
                echo "</table>";
            }
        ?>
        <br>
        
        <form method="post">
            <input type="submit" name="clear" value="Delete All">
        </form>
        
        <a class="button" href="payment.php">Pay</a>
    </body>
</html>