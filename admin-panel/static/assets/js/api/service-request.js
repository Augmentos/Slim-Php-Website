
$(document).ready(function(){
    
    $.get("/slim/v1/getrequests/1",function(data){
       
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