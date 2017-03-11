$(document).ready(function(){
    $("#contact-request").submit(function(){
        
        var formData = JSON.stringify($(this).serializeJSON());
        
        console.log(formData);
        
        $.ajax({
            url:"/slim/v1/contact-requests",
            method: "POST",
            data: formData,
            type: "application/json",
            beforeSend:function(){
                $("#contact-request .btn").html("Sending..");
                $("#contact-request .btn").attr("disabled","true");
            },
            success: function(reply_from_json){
                console.log(reply_from_json);
                if(reply_from_json.status=="success"){
                   new PNotify({
                    title: 'Message:',
                    text: reply_from_json.message
                    });
                    $("#contact-request .btn").html("Send");
                    $("#contact-request").trigger("reset");
                }
                
                else{ 
                    $("#contact-request .btn").html("submit");
                     new PNotify({
                    title: 'Message:',
                    text: "Request could not be send. Please try again."
                    });
                }
                
                $("#add-admin .btn-success").removeAttr("disabled");
            }
            
        });
        
    });
});