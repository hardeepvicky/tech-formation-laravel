//Ajax start
$(document).ajaxStart(function(){
    $(".page-content-wrapper").beginLoader();
});

//Ajax complete
$(document).ajaxComplete(function(){
    $(".page-content-wrapper").stopLoader();
});

$(document).ajaxError(function( event, jqxhr, settings, thrownError ) 
{
    $(".page-content-wrapper").stopLoader();
    
    $(".page-content").html(jqxhr.responseText);
    
    return;
});

$(document).on("click", ".ajax-toggle-status",function(event) 
{
    event.preventDefault();
    var obj = $(this);
    var href = obj.attr("href");
    href = href.replace("{v}", obj.attr("data-value"));
    
    $.get(href,function(data, status)
    {
        if (typeof data["status"] != "undefined")
        {
            $(obj).attr("data-value", data["status"]);

            if (data["status"] == "0")
            {
                $(obj).html('<i class="font-lg fa fa-times-circle font-red-sunglo"></i>');
            }
            else
            {
                $(obj).html('<i class="font-lg fa fa-check-circle font-green-meadow"></i>');
            }
        }
    });

    return false;
});