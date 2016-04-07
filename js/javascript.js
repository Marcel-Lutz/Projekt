$(document).on('click','#save',function(e) {
var data = $("#form-search").serialize();
$.ajax({
       data: data,
       type: "post",
       url: "projekt_insert.php",
       success: function(data){
            alert("Data Save: " + data);
       }
});
});
