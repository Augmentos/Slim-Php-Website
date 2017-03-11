$(document).ready(function(){
    $("#add-news").submit(function(){
        
        var formData = JSON.stringify($(this).serializeJSON());
        
        console.log(formData);
        
        $.ajax({
            url:"/slim/v1/news/new",
            method: "POST",
            data: formData,
            type: "application/json",
            beforeSend:function(){
                $("#add-news .btn-success").html("please wait !");
                $("#add-news .btn-success").attr("disabled","true");
            },
            success: function(reply_from_json){
                console.log(reply_from_json);
                if(reply_from_json.status=="success"){
//                  alert(reply_from_json.message);

                         new PNotify({
            title: 'Message:',
            text: reply_from_json.message
        });
         
            $("#add-news .btn-success").html("submit");
                    
                    $("#add-news").trigger("reset");
                }
                else{ 
                    $("#add-news .btn-success").html("submit");
                }
                
                $("#add-news .btn-success").removeAttr("disabled");
            }
            
        });
        
    });
});