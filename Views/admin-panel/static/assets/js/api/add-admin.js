$(document).ready(function(){
    $("#add-admin").submit(function(){
        
        var formData = JSON.stringify($(this).serializeJSON());
        
        console.log(formData);
        
        $.ajax({
            url:"/slim/v1/admin/new",
            method: "POST",
            data: formData,
            type: "application/json",
            beforeSend:function(){
                $("#add-admin .btn-success").html("please wait !");
                $("#add-admin .btn-success").attr("disabled","true");
            },
            success: function(reply_from_json){
                console.log(reply_from_json);
                if(reply_from_json.status=="success"){
//                  alert(reply_from_json.message);

                         new PNotify({
            title: 'Message:',
            text: reply_from_json.message
        });
         
            $("#add-admin .btn-success").html("submit");
                    
                    $("#add-admin").trigger("reset");
                }
                else{ 
                    $("#add-admin .btn-success").html("submit");
                }
                
                $("#add-admin .btn-success").removeAttr("disabled");
            }
            
        });
        
    });
});