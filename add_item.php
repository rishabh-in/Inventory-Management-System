<?php

    include('connection.php');

    if(isset($_POST['addData'])) {
        
        $item = mysqli_real_escape_string($connection, $_POST['itemName']);
        $quantity = mysqli_real_escape_string($connection, $_POST['quantity']);

        $query = "SELECT * FROM items WHERE ItemName LIKE '{$item}'";
        $result = mysqli_query($connection,$query);

        if(mysqli_num_rows($result) == 0) {
            $query = "INSERT INTO items(ItemName,quantity) VALUES ('$item',$quantity)";

            $result = $connection->query($query);

            echo "<p class='bg-success' id='update-feedback'>Item Added Successfully</p>";

            if(!$result) {
            
                die('QUERY FAILED'. mysqli_error($connection));
            
            }

        }
        else{
            echo "<p class='bg-danger' id='delete-feedback'>Item Exist! Please update the quantity</p>";    
        }

    }
?>