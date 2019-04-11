<?php
    include('session.php');
    if (isset($_POST['pay'])) {
            header('location: thankyou.php');
    }
?>
<html>
    <head>
        <title>Payment</title>
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
            img{
                width: 75px;
                height: 50px;
            }
        </style>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
        <script>
            $(document).ready(function(){
                $('#cn').on('input',function(e){
                    var cnum = $('#cn').val();
                    if(cnum[0]==3){
                        $( "#ctype" ).attr('src', 'amexp.jpg');
                    }
                    else if(cnum[0]==4){
                        $( "#ctype" ).attr('src', 'visa.jpg');
                    }
                    else if(cnum[0]==5){
                        $( "#ctype" ).attr('src', 'mastercard.jpg');
                    }
                    else if(cnum[0]==6){
                        $( "#ctype" ).attr('src', 'discover.jpg');
                    }
                    else{
                        $( "#ctype" ).attr('src', 'white.jpg');
                    }
                });
            });
        </script>
    </head>
    <body>
        <div><a href="welcome.php">Home</a>  <a href="logout.php">Sign Out</a>  <a href="cart.php">Cart</a></div>
        
            <br /><br />
            
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
                    </tr>
                    </form>
            <?php
                    }
                    $str= '<label>Coupon: </label><input type = "text" name = "address"/><input type="submit" name="validate" value="Redeem"><br>';
                    ?>
                    <tr><td colspan='3'><label>Coupon: </label><form method="post"><input type = "text" name = "coupon"/><input type="submit" name="validate" value="Redeem"><br>
                    Total: $<?php 
                        if (isset($_POST['validate'])) {
                            $sql = "SELECT * FROM coupons WHERE coupon = ".'"'.$_POST['coupon'].'"';
                            $result = $conn->query($sql);
                            if ($result->num_rows > 0) {
                                $row = $result->fetch_assoc();
                                $total = $total * (float)$row['deal'] / 100;
                            } 
                        }
                        echo round($total, 2);
                    ?>
                    </form></td></tr>
            
            <?php   
                echo "</table>";
            }
            ?>
            <form method="post">
            <br><br><label>Name: </label><input type = "text" name = "name"/><br /><br />
            <label>Email: </label><input type = "text" name = "email"/><br/><br />
            <label>Address: </label><input type = "text" name = "address"/><br/><br />
            <label>Credit Card Number: </label><input id="cn" type = "text" name = "cnum"/><img id="ctype" src="white.jpg"/><br/><br />
            <label>Expiration: </label><input size="2" maxlength="2" type = "text" name = "exm"/>/<input type = "text" name = "exy" size="2" maxlength="2"/><br/><br />
            <label>Security Code: </label><input type = "text" name = "ccode"/><br/><br />
            <input type = "submit" name="pay" value = "Pay"/><br/>
            </form>
    </body>
</html>