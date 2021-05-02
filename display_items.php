<?php

include('connection.php');


$query = 'SELECT * FROM items';
$result = $connection->query($query); // mysqli_query($connection, $query);

if (!$result) {
    die("Query Failed" . mysqli_error($connection));
}

while ($row = mysqli_fetch_array($result)) { //$result->fetch_array();

    $id = $row['id'];
    $item = $row['ItemName'];
    $quantity = $row['quantity'];

    echo "<tr>";

    echo "<td>{$id}</td>";
    echo "<td><a rel={$id} class='title-link' href='javascript:void(0)'>{$item}</a></td>";
    echo "<td>{$quantity}</td>";

    echo "</tr>";
}

?>

<script>
    $(document).ready(function() {

        $('.title-link').on('click', function() {

            $('#form-container').show();

            var id = $(this).attr('rel');

            $.post('process.php', {
                'id': id
            }, function(data) {

                $('#form-container').html(data);

            })
        })

    });
</script>