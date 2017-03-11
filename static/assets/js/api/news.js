
$(document).ready(function(){
    
    $.get("/slim/v1/news",function(data){
        
        if(data.status == "success"){
            console.log(data);
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