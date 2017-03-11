
$(document).ready(function(){
    
    $.get("/slim/v1/event/all",function(data){
        
        if(data.status == "success"){
        var source = $("#event-template").html();
        var template = Handlebars.compile(source);
        var json = data;
        var view = template(json);
        $("#event_list").html(view);
        }
        else {
            new PNotify({
                title: 'Awesome!',
                text: data.message,
                type: "error"
            });
        }
        
    });
    
});