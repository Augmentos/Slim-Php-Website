$(document).ready(function(){
      
    $.get("/slim/v1/home-slider",function(data){
       console.log('heyy');
        if(data.status == "success"){
            var source = $("#slider-template").html();
        var template = Handlebars.compile(source);
        var json = data;
        var view = template(json);
        $("#homeslider").html(view);
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