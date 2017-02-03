jQuery.fn.extend({
    sentance: function ()
    {
        return this.each(function ()
        {
            if ($(this).tagName() == "input")
            {
                var v = $(this).val();

                if (v.length > 0)
                {
                    $(this).val(v.charAt(0).toUpperCase() + v.slice(1));
                }
            }
            else
            {
                var v = $(this).html();

                if (v.length > 0)
                {
                    $(this).html(v.charAt(0).toUpperCase() + v.slice(1));
                }
            }
        });
    },
    tagName: function ()
    {
        return this.prop("tagName").toLowerCase();
    },
    replaceAll: function (search, replace, str)
    {
        var strs = str.spilt(search);

        return strs.join(replace);
    },
    percentage: function (opt)
    {
        return this.each(function ()
        {
            var _this = $(this);
            var total = $(this).data("target-total");
            total = $(total);

            total.keyup(function ()
            {
                _this.showPer(opt);
            });

            var value = $(this).data("target-value");
            value = $(value);

            value.keyup(function ()
            {
                _this.showPer(opt);
            });

            _this.showPer(opt);
        });
    },
    showPer: function (opt)
    {
        return this.each(function ()
        {
            var total = $(this).data("target-total");
            total = $(total);

            if (total.length == 0)
            {
                console.warn("target-total not found");
            }

            total = parseFloat(total.val());

            var value = $(this).data("target-value");
            value = $(value);

            if (value.length == 0)
            {
                console.warn("target-value not found");
            }

            value = parseFloat(value.val());

            var v = 0;

            if (total && value)
            {
                v = value * 100 / total;
            }

            if (typeof opt != "undefined")
            {
                if (typeof opt.round != "undefined")
                {
                    v = Math.round(v, opt.round);
                }
            }

            if ($(this).tagName() == "input")
            {
                $(this).val(v);
            }
            else
            {
                $(this).html(v + " %");
            }
        });
    },
    sum: function (opt)
    {
        return this.each(function ()
        {
            var objs = $(this).data("sum-from");
            objs = objs.split(",");

            var _this = $(this);

            for (var i in objs)
            {
                var s = objs[i].trim();

                $(s).keyup(function ()
                {
                    _this.showSum(objs, opt);
                });
            }

            $(this).showSum(objs, opt);
        });
    },
    showSum: function (objs, opt)
    {
        return this.each(function ()
        {
            var sum = 0;

            for (var i in objs)
            {
                var s = objs[i].trim();

                var v = parseFloat($(s).val());
                if (v)
                {
                    sum += v;
                }
            }

            sum = Math.round(sum, opt.round);

            if ($(this).tagName() == "input")
            {
                $(this).val(sum);
            }
            else
            {
                $(this).html(sum);
            }
        });
    },
    
    chkSelectAll: function ()
    {
        return this.each(function()
        {
            var _this = $(this);
            var target = $(this).attr("data-href");
            
            $(this).change(function ()
            {
                $(target).prop("checked", this.checked);
            });
            
            $(target).change(function ()
            {
                var checked = $(target).length == $(target + ":checked").length;
                
                _this.prop("checked", checked);
            });
            
            var checked = $(target).length == $(target + ":checked").length;
            _this.prop("checked", checked);
        });
    }
});

$(".show-percentage").percentage({
    round: 0
});

$(".show-sum").sum({
    round: 0
});

$(".chk-select-all").chkSelectAll();

$(document).on("click", ".css-toggler", function (e, opt)
{
    var obj = $($(this).data("href"));
    var css = $(this).data("toggler-class");
    obj.toggleClass(css);
});

$(document).ready(function()
{
   $("form").find("input.error").parents(".form-group").addClass("has-error"); 
});

