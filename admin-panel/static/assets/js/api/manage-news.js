function update_news(a_id){
    var date = "#date_"+a_id;
    var title = "#title_"+a_id;
    var i = "#user_id_"+a_id;
     var id = $(i).val();
    var date = $(date).val();
    var title = $(title).val();

    
    
    var formData = '{"data":{"date":"'+date+'","title":"'+title+'"}}';
        console.log(formData);
        console.log(id);
        $.ajax({
            url:"/slim/v1/news/"+id,
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



function delete_news(a_id){
 
       var i = "#user_id_"+a_id;
    
    var id = $(i).val();

    
    var formData = '{"data":{"status":"success"}}';
        console.log(formData);
        $.ajax({
            url:"/slim/v1/news/delete/"+id,
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
    
    $.get("/slim/v1/news/all",function(data){
        
        if(data.status == "success"){
            var source = $("#news-template").html();
        var template = Handlebars.compile(source);
        var json = data;
        var view = template(json);
        $("#newss").html(view);
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