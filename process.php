<?php


// Processing the info to the update and delete pop up box //

include('connection.php');


if (isset($_POST['id'])) {

    $id = mysqli_real_escape_string($connection, $_POST['id']);


    $query = "SELECT * FROM items WHERE id = {$id}";

    $result = $connection->query($query);

    if (!$result) {
        die("Query Failed" . mysqli_error($connection));
    }


    // $row = $result->fetch_row();
    // echo "{$row[0]}";

    while ($row = $result->fetch_array()) {
        echo "<form rel='" . $row['id'] . "' action='process.php' method='post'>";
        echo "<div class='row'> ";

        echo "<div class='col-6'> ";
        echo "<input type='text' class='form-control title-input' value='" . $row['ItemName'] . "'>";
        echo "</div>";

        echo "<div class='col-6'> ";
        echo "<input type='number' class='form-control quantity-input' value='" . $row['quantity'] . "'>";
        echo "</div>";
        echo "<input type='button' class='btn btn-success item_update' value='Update'>";
        echo "<input type='button' class='btn btn-danger item_delete' value='Delete'>";
        echo "<input type='button' class='btn btn-dark close_box' value='Close'>";
        echo "</form>";
    }
    echo "</div>";
}


// Updating the records //

if (isset($_POST['updateData'])) {

    $id = mysqli_real_escape_string($connection, $_POST['id']);
    $updatedName = mysqli_real_escape_string($connection, $_POST['title']);
    $quantity = mysqli_real_escape_string($connection, $_POST['quantity']);

    $query = "UPDATE items SET ItemName = '{$updatedName}',quantity = {$quantity} WHERE id = {$id}";

    $result = mysqli_query($connection, $query);

    if (!$result) {

        die("Query Failed" . mysqli_error($connection));
    }
}

// Deleting the records

if (isset($_POST['deleteData'])) {

    $id = mysqli_real_escape_string($connection, $_POST['id']);

    $query = "DELETE FROM items WHERE id = '{$id}' ";

    $result = mysqli_query($connection, $query);

    if (!$result) {

        die("Query Failed" . mysqli_error($connection));
    }
}

?>


<script>
    $(document).ready(function() {

        var id;
        var title;
        var quantity;
        var updateData = 'update';
        var deleteData = 'Delete';

        $(".item_update").on("click", function() {

            title = $(this).closest("form").find(".title-input").val();
            quantity = $(this).closest("form").find(".quantity-input").val();
            id = $(this).closest("form").attr("rel");


            $.post('process.php', {
                id:id,
                title:title,
                quantity:quantity,
                updateData:updateData
            }, function(data) {

                $("#update-feedback").text("Record updated successfully");

                $('#form-container').hide();

                setTimeout(() => {
                    $("#update-feedback").text("");
                }, 2000);

            });
        });

        $(".item_delete").on('click', function() {

            if (confirm('Are you sure you want to delete')) {

                id = $(this).closest("form").attr("rel");

                $.post('process.php', {
                    id: id,
                    deleteData: deleteData
                }, function(data) {

                    $("#delete-feedback").text("Record Deleted");

                    $('#form-container').hide();

                    setTimeout(() => {
                        $("#delete-feedback").text("");
                    }, 2000);
                });
            }

        });

        $(".close_box").on('click', function() {
            $('#form-container').hide();
        })


    });
</script>