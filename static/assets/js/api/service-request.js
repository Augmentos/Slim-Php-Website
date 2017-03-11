$(document).ready(function(){
    $("#service-request").submit(function(){
        
        var formData = JSON.stringify($(this).serializeJSON());
        
        console.log(formData);
        
        $.ajax({
            url:"/slim/v1/porequests",
            method: "POST",
            data: formData,
            type: "application/json",
            beforeSend:function(){
                $("#service-request .btn").html("Sending..");
                $("#service-request .btn").attr("disabled","true");
            },
            success: function(reply_from_json){
                console.log(reply_from_json);
                if(reply_from_json.status=="success"){
                   new PNotify({
                    title: 'Message:',
                    text: reply_from_json.message
                    });
                    $("#service-request .btn").html("Send");
                    $("#service-request").trigger("reset");
                }
                
                else{ 
                    $("#service-request .btn").html("submit");
                     new PNotify({
                    title: 'Message:',
                    text: "Request could not be send. Please try again."
                    });
                }
                
                $("#service-request .btn-success").removeAttr("disabled");
            }
            
        });
        
    });
});