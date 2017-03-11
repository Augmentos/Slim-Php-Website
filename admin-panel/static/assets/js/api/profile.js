function cpass(){

    var o_pass = "#old";
        var n_pass = "#new";
        var confirm = "#confirm";

         var o_password = $(o_pass).val();
            var n_password = $(n_pass).val();

    var c_password = $(confirm).val();

 


    
//    var json = $(id).serializeJSON();
//        console.log(id);
//        console.log(json);
//          
//        var id = json.data.id;
//        var formData = JSON.stringify(json);
//        
    
    
    var formData = '{"data":{"o_password":"'+o_password+'","n_password":"'+n_password+'","c_password":"'+c_password+'"}}';
        console.log(formData);
        $.ajax({
            url:"/slim/v1/chng_pswd",
            method: "PUT",
            data: formData,
            type: "application/json",
            beforeSend:function(){
                $(".btn-success").html("please wait !");
                $(".btn-success").attr("disabled","true");
            },
            success: function(reply_from_json){
               
                if(reply_from_json.status=="success"){
//                  alert(reply_from_json.message);
                console.log(reply_from_json);
                window.location.reload();
                         new PNotify({
            title: 'Message:',
            text: reply_from_json.message
        });
         
            $(".btn-success").html("update");
                    
//                    $("#add-admin").trigger("reset");
                }
                else{ 
                    new PNotify({
            title: 'Message:',
            text: reply_from_json.message
        });
                }
                
                $(".btn-success").removeAttr("disabled");
            }
            
        });
    
}

function cmailf(){

     var nmaill = "#n_mail";
     var cmaill = "#c_mail";
      var nmail = $(nmaill).val();
       var cmail = $(cmaill).val();


    var formData = '{"data":{"nmail":"'+nmail+'","cmail":"'+cmail+'"}}';
        console.log(formData);
        $.ajax({
            url:"/slim/v1/admins/cmail",
            method: "PUT",
            data: formData,
            type: "application/json",
            beforeSend:function(){
                $(".btn-success").html("please wait !");
                $(".btn-success").attr("disabled","true");
            },
            success: function(reply_from_json){
               
                if(reply_from_json.status=="success"){
//                  alert(reply_from_json.message);
                console.log(reply_from_json);
                window.location.reload();
                         new PNotify({
            title: 'Message:',
            text: reply_from_json.message
        });
         
            $(".btn-success").html("update");
                    
//                    $("#add-admin").trigger("reset");
                }
                else{ 
                    new PNotify({
            title: 'Message:',
            text: reply_from_json.message
        });
                }
                
                $(".btn-success").removeAttr("disabled");
            }
            
        });





}



    $(document).ready(function(){
    
    $.get("/slim/v1/get-email",function(data){
       
        if(data.status == "success"){
            var source = $("#a-template").html();
        var template = Handlebars.compile(source);
        var json = data;
        var view = template(json);
        $("#cbody").html(view);
       
             console.log(data);
          
        }
        
        else{
            new PNotify({
                title: 'Awesome!',
                text: data.message,
                type: "error"
            });
            
           
        }
        
    });
    
});