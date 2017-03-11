$(document).ready(function(){
      
    $.get("/slim/v1/home-slider",function(data){
     
        if(data.status == "success"){
              console.log(data);
            var source = $("#sliderr-template").html();
        var template = Handlebars.compile(source);
        var json = data;
        var view = template(json);
        $("#homesliderr").html(view);
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