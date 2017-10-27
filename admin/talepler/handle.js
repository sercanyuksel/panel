$( "#car_id" ).change(function() {
    $('#dynamicInput').remove();
    var deger=$("#car_id").val();
    $.get("ajax/fetch_car_camera.php?id="+deger, function( data ) {
            $( ".form-group" ).eq(0).after( data);
        });
});

$("#handle").click(function(e){
    var id=$("#req_id").val();
    var sid=$('#ses_id').val();
    var variables='id='+id+',sid='+sid;
    $.post("ajax/handle_request.php",
    {
        id: id,
        sid: sid
    },
    function(data){
        alert(data);
        window.location.href='index.php?islem=talepler';
    });
});