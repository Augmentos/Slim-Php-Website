   $(document).ready(function(){
    
    $.get("/slim/v1/get-email",function(data){
       
        if(data.status == "success"){
            var source = $("#a-templatee").html();
        var template = Handlebars.compile(source);
        var json = data;
        var view = template(json);
    
        $("#user").html(view);
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