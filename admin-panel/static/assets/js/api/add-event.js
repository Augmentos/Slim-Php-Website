$(document).ready(function(){
    $("#add-event").submit(function(){
        
        var formData = JSON.stringify($(this).serializeJSON());
        
        console.log(formData);
        
        $.ajax({
            url:"/slim/v1/admin/add-event",
            method: "POST",
            data: formData,
            type: "application/json",
            beforeSend:function(){
                $("#add-event .btn-success").html("Creating...");
                $("#add-event .btn-success").attr("disabled","true");
            },
            success: function(reply_from_json){
                console.log(reply_from_json);
                if(reply_from_json.status=="success"){
                   new PNotify({
                    title: 'Message:',
                    text: reply_from_json.message
                });
                   $("#add-event .btn-success").html("submit");
                   $("#add-event").trigger("reset");
               }
               else{ 
                $("#add-event .btn-success").html("submit");
            }
            $("#add-event .btn-success").removeAttr("disabled");
        }
    });
    });
});