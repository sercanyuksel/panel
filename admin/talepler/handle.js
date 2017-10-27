$( "#car_id" ).change(function() {
    $('#dynamicInput').remove();
    var deger=$("#car_id").val();
    $.get("ajax/fetch_car_camera.php?id="+deger, function( data ) {
            $( ".form-group" ).eq(0).after( data);
        });
});