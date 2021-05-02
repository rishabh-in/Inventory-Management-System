$(document).ready(function() {

    // Updating the home page with cars data
    setInterval(function() {

        updateItems();

    }, 1000)

    function updateItems() {

        $.ajax( {

            url:'display_items.php',
            type:'POST',
            success: function(data) {
    
                if(!data.error) {
                    $('#show-items').html(data);
                }
            }
        })
    
    }


    $('#search').keyup(function() {
        var searchData = $('#search').val();

        // $('#result').html(searchData);

        $.ajax({
            url:'search_item.php',
            data:{newSearch:searchData},
            type:'POST',
            success: function(data) {

                if(!data.error) {
                    $('#result').html(data);
                
                }
            }
        })
    })

    // Add items

    $('.add-item-btn').on("click", function() {

        var addData = "update";

        var itemName = $(this).closest("form").find(".add-item-input").val();
        var quantity = $(this).closest("form").find(".item-quantity-input").val();

        var url = $(this).closest("form").attr('action')

        console.log(itemName+" "+quantity+" "+url);

        $.post(url,{
            itemName:itemName,
            quantity:quantity,
            addData:addData
        }, function(data) {
            if(!data.error) {
                $(".add-info").html(data);
            }
            setTimeout(() => {
                $(".add-info").html("");
                $(".add-item-input").val("");
                $(".item-quantity-input").val("");
            }, 1000);

        });

    });
    
});