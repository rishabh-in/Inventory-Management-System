<?php

    include('connection.php');

    $search = $_POST['newSearch'];

    if(!empty($search)) {
        $query = "SELECT * FROM items WHERE ItemName LIKE '$search%' ";

        $result = $connection->query($query); // or mysqli_query($connection, $query);

        $rowCount = mysqli_num_rows($result);

        if(!$result) {
            die('QUERY FAILED'. mysqli_error($connection));
        }

        if($rowCount <= 0) {
            echo "<h4 class='bg-danger' id='item-found'>Not in stock</h4>";
        }
        else {
            while($row = mysqli_fetch_array($result)) {
            
                $item = $row['ItemName'];
    
                echo "<h4 class='bg-success' id='item-found'>$item is in stock</h4>";
    
                // echo "<br>";
    
            }
        }


    }

?>

