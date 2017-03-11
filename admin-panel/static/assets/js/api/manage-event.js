function update_event(a_id){
    var name = "#user_"+a_id;
    var date = "#date_"+a_id;
    var venue = "#venue_"+a_id;
    var i = "#event_id_"+a_id;
    
    var e_name = $(name).val();
    var e_date = $(date).val();
    var e_venue = $(venue).val();
    var id = $(i).val();
    
//    var json = $(id).serializeJSON();
//        console.log(id);
//        console.log(json);
//        
//        var id = json.data.id;
//        var formData = JSON.stringify(json);
//        
    
    
    var formData = '{"data":{"e_name":"'+e_name+'","date":"'+e_date+'","venue":"'+e_venue+'"}}';
        console.log(formData);
        $.ajax({
            url:"/slim/v1/admins/event/"+id,
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
window.location.reload();
                         new PNotify({
            title: 'Message:',
            text: reply_from_json.message
        });
         
            $(".btn-success").html("update");
                    
//                    $("#add-admin").trigger("reset");
                }
                else{ 
                    $(".btn-success").html("update");
                }
                
                $(".btn-success").removeAttr("disabled");
            }
            
        });
    
}



function delete_event(a_id){
 
    var i = "#event_id_"+a_id;
    
    var id = $(i).val();

    
    var formData = '{"data":{"status":"success"}}';
        console.log(formData);
        $.ajax({
            url:"/slim/v1/admins/delete_event/"+id,
            method: "PUT",
            data: formData,
            type: "application/json",
            beforeSend:function(){
                $(".btn-success").html("please wait !");
                $(".btn-success").attr("disabled","true");
            },
            success: function(reply_from_json){
                 window.location.reload();
                if(reply_from_json.status=="success"){
//                  alert(reply_from_json.message);
              
                         new PNotify({
            title: 'Message:',
            text: reply_from_json.message
        });
         
            $(".btn-success").html("update");
                    
//                    $("#add-admin").trigger("reset");
                }
                else{ 
                    $(".btn-success").html("update");
                }
                
                $(".btn-success").removeAttr("disabled");
            }
            
        });
    
}




$(document).ready(function(){
    
    $.get("/slim/v1/admins/event/all",function(data){
        
        if(data.status == "success"){
            var source = $("#a-template").html();
        var template = Handlebars.compile(source);
        var json = data;
        var view = template(json);
        $("#adminos").html(view);
        }
        
        else{
            new PNotify({
                title: 'Awesome!',
                text: data.message,
                type: "error"
            });
            console.log(data);
        }
        
    });
    
});