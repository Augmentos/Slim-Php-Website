$(document).ready(function(){
    $("#login").submit(function(){

        var formData = JSON.stringify($(this).serializeJSON());
        
        // console.log(formData);
        
        $.ajax({
            url:"/slim/v1/login",
            method: "POST",
            data: formData,
            type: "application/json",
            beforeSend:function(){
                $("#login .btn-success").html("Please Wait !");
                $("#login .btn-success").attr("disabled","true");
            },
            success: function(reply_from_json){
                console.log(reply_from_json);
                if(reply_from_json.status=="success"){
                //alert(reply_from_json.message);
                       
                        console.log(formData.Username);
                     new PNotify({
                        title: 'Message:',
                        text: reply_from_json.message
                     });

                // $("#login .btn-success").html("submit");                   
                // $("#login").trigger("reset");
                window.location  = '../admin-panel/dashboard';
                }
                else{ 
                    new PNotify({
                        title: 'Message:',
                        text: reply_from_json.message,
                        addclass: 'translucent'
                    });
                    $("#login .btn-success").html("submit");
                }

                $("#login .btn-success").removeAttr("disabled");
            }

        });
        
    });
});