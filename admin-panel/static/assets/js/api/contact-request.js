
$(document).ready(function(){
    
    $.get("/slim/v1/get_crequests/1",function(data){
       
        if(data.status == "success"){
            var source = $("#a-template").html();
        var template = Handlebars.compile(source);
        var json = data;
        var view = template(json);
        $("#cbody").html(view);
        $("#hello").html(view);
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