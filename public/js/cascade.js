function get_options(data)
{  
    var html = '';
    
    if (Object.keys(data).length > 0)
    {
        for(var i in data)
        {
            if (typeof data[i] != "undefined" && typeof data[i]["name"] != "undefined")
            {
                html += "<option value=" + data[i]["id"] + ">" + data[i]["name"] + "</option>";
            }
            else
            {
                html += '<optgroup label="' + i + '">';
                html += get_options(data[i]);
                html += "</optgroup>";
            }
        }
    }
    
    return html;
}

function casecade_fill(obj, data)
{
    if (obj.hasClass("select2me"))
    {
        obj.select2('destroy').empty(); 
        obj.html(get_options(data));
        obj.select2();
    }
    else
    {
        if (obj.attr("multiple") != "multiple")
        {
            obj.html("<option value=''>Please Select</option>");
            obj.append(get_options(data));
        }
        else
        {
            obj.html(get_options(data));
        }
    }
}

$(document).on("change", "select.cascade-list", function(e, opt)
{
    var obj = $(this).data("target");

    obj = $(obj);

    if (obj.length === 0)
    {
        console.error("No Target Found");
        return;
    }
    
    var auto_load = 0;
    if (typeof opt != "undefined" && typeof opt.pageLoad != "undefined" && opt.pageLoad)
    {
        auto_load = obj.data("auto-load");

        if (auto_load != "1")
        {
            return;
        }
    }
    
    var v = $(this).val();
    
    console.log($(this).attr("id") + " : " + v  + " auto_load : " + auto_load);
    
    if (v)
    {
        var href = $(this).data("href");
        
        href = href.replace("{{v}}", v);

        $.get(href, function(data, status)
        {
            if(status !== "success")
            {
                return;
            }

            data = JSON.parse(data);

            casecade_fill(obj, data);
            
            if (auto_load == "1")
            {
                var dv = obj.data("value");
                if (obj.attr("multiple") == "multiple")
                {
                    dv = dv.split(",");
                }
                
                obj.val(dv);
            }
            
            if (obj.hasClass("chzn-select"))
            {
                obj.trigger("chosen:updated");
            }
            
            if (obj.hasClass("cascade-list"))
            {
                if (auto_load == "1")
                {
                    obj.trigger("change", {pageLoad : true, trigger : true});
                }
                else
                {
                    obj.trigger("change", {trigger : true});
                }
            }
        });
    }
    else
    {
        casecade_fill(obj, {});
        
        if (obj.hasClass("chzn-select"))
        {
            obj.trigger("chosen:updated");
        }
        
        if (obj.hasClass("cascade-list"))
        {
            obj.trigger("change", {trigger : true});
        }
    }
});