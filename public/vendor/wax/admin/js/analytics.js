$(document).ready(function() {
    var GoogleAnalytics = GoogleAnalytics   || {};
    var LineChart       = LineChart         || {};
    var PieChart        = PieChart          || {};
    // Load google analytics api dependencies
    $.getScript("https://www.google.com/jsapi")
    .done(function(script, textStatus) {
        console.log("jsapi Script loaded successfully");
        var options = {packages:["corechart"], "callback" : GoogleAnalytics.drawCharts};
        google.load("visualization", "1", options);
    })
    .fail(function(jqxhr, settings, exception) {
        alert("Could not load google analytics jsapi script");
        return false;
    });


    LineChart.arrVisitors   = {};
    PieChart.arrVisitors    = {};

    $(window).resize(function() {
        LineChart.draw('resize');
        PieChart.draw('resize');
    });

    // Initialize our GoogleAnalytics methods
    GoogleAnalytics.drawCharts = function() {
        LineChart.draw();
        PieChart.draw();
    };

    $.fn.loadingAnimation = function(args) {
        var _self = this;
        if (_self.parent().find(".animation-image").length > 0) {
            return false;
        }
        switch (args) {
            case "show":
                var width   = _self.parent().width();
                var height  = _self.parent().parent().outerHeight();

                var animation = $("<div />", {
                    class: 'animation-image'
                });

                animation.css({
                    position            : 'relative',
                    width               : 24,
                    height              : 24,
                    left                : ((width/2)-12)+"px",
                    top                 : ((height/2)-45)+"px",
                    'background-image'  : "url('/vendor/wax/admin/images/spinner.gif')",
                    'background-repeat' : 'no-repeat',
                });


                _self.parent().append(animation);

                // Cleanup
                animation=null;

                break;
            case "hide":
                $(".animation-image").remove();
                break;
        }

        return;
    };




    // Visitor Line Chart Options
    LineChart.initVisitorOptions = function(data) {
        // Set default options
        var defaults = {
            width           : '100%',
            height          : '100%',
            title           : '',
            colors          : ['#058dc7','#e6f4fa'],
            bgcolor         : '#f8f8f8',
            areaOpacity     : 0.1,
            hAxis           : {
                                textPosition    : 'in',
                                showTextEvery   : 5,
                                slantedText     : false,
                                textStyle: {
                                    color   : '#058dc7',
                                    fontSize: 10 ,
                                }
                            },
            pointSize       : 5,
            legend          : 'none',
            chartArea       : {
                                left    : 30,
                                top     : 30,
                                width   : "100%",
                                height  : "100%",
                            },
        };


        // Extend defaults with data options
        $.extend(true, data, defaults);

        return defaults;
    };



    LineChart.initVisitorData = function (response) {
        var data        = new google.visualization.DataTable();
        var chartData   = new Array();
        data.addColumn('string', 'Day');
        data.addColumn('number', 'Visitors');
        $.each(response, function(key, value) {
            var visits = parseInt(value.metrics.visits)
            chartData.push(visits);
            data.addRows([
                [key, visits]
            ]);
        });
        var max     = Math.max.apply(Math, chartData);
        var options = LineChart.initVisitorOptions(response);

        return { options: options, points: data, max: max }
    };




    // Get visitor data from google analytics
    LineChart.getVisitorData = function() {
        var task = new $.Deferred();
        if ($(".chart-visitors-line").length <= 0) {
            task.reject();
            return task;
        }

        if (!$.isEmptyObject(LineChart.arrVisitors)) {
            task.resolve(LineChart.arrVisitors);
            return task;
        }

        $.ajax({
            type        : "GET",
            url         : window.location,
            data        : { 'action': 'panel', 'panel': 'analyticsLineChart', 'method': 'getVisitorsByDay', 'format': 'json'},
            dataType    : 'json',
            cache       : false,
            success     : function(data){
                data                    = data.success;
                data                    = LineChart.initVisitorData(data);
                LineChart.arrVisitors   = data;
                task.resolve(data);
            },
            error       : function(msg){
                //alert(msg);
                task.reject();
            }
        });
        return task;
    };



    LineChart.draw = function(e) {
        var el_chart = $(".chart-visitors-line").get(0);

        if (e != 'resize') {
            $(el_chart).loadingAnimation("show");
        }

        var e_type = e;
        $.when(LineChart.getVisitorData()).done(function(data) {
            if (e_type != 'resize') {
                $(el_chart).loadingAnimation("hide");
            }
            if (typeof el_chart == 'undefined' || typeof el_chart == null) {
                 var el_chart = $(".chart-visitors-line").get(0);
            }
            var chart   = new google.visualization.AreaChart(el_chart);
            var points  = data.points;
            var options = data.options;
            var max     = data.max;
            if(max < 3) {
                verticalAxis = {minValue: 0, maxValue: max, format: '0.0', viewWindow: {min: -0.1}};
            } else {
                verticalAxis = {minValue: 0, maxValue: max, format: 0, viewWindow: {min: -0.1}};
            }

            chart.draw(points, {
                width               : options.width,
                height              : options.height,
                title               : options.title,
                colors              : options.colors,
                backgroundColor     : options.bgcolor,
                areaOpacity         : options.areaOpacity,
                hAxis               : options.hAxis,
                vAxis               : verticalAxis,
                pointSize           : options.pointSize,
                legend              : options.legend,
                chartArea           : options.chartArea
            });
        });

        // Cleanup
        el_chart = null;
    };



    PieChart.initVisitorOptions = function(data) {
        var defaults = {
            width           : '100%',
            height          : '100%',
            title           : '',
            colors          : ['#058dc7','#008000'],
            bgcolors        : '#f8f8f8',
            legendPosition  : 'top',

        };

        $.extend(true, data, defaults);

        return data;
    };




    PieChart.initVisitorData = function (response) {
        var data = new google.visualization.arrayToDataTable([
            ['Task', 'Hours per Day'],
            ["Returning Visitor", response.returning.number],
            ["New Visitor", response.new.number]
        ]);

        var options = PieChart.initVisitorOptions(response);

        return { options: options, results: data }
    };



    /**
     * Get visitor data and draw new/old visitor pie chart
     *
     */
    PieChart.getVisitorData = function() {
        var task = new $.Deferred();
        if ($(".chart-visitors-pie").length <= 0) {
            task.reject();
            return task;
        }

        if (!$.isEmptyObject(PieChart.arrVisitors)) {
            task.resolve(PieChart.arrVisitors);
            return task;
        }


        $.ajax({
            type        : "GET",
            url         : window.location,
            data        : { 'action': 'panel', 'panel': 'analyticsPieChart', 'method': 'getVisitorNewVsOld', 'format': 'json'},
            dataType    : 'json',
            cache       : false,
            success     : function(data) {
                data                    = data.success;
                data                    = PieChart.initVisitorData(data);
                PieChart.arrVisitors    = data;
                task.resolve(data);
            },
            error       : function(msg) {
                task.reject();
            }
        });

        return task;
    };


    PieChart.draw = function(e) {
        var el_chart = $(".chart-visitors-pie").get(0);

        if (e != 'resize') {
            $(el_chart).loadingAnimation("show");
        }

        var e_type = e;
        $.when(PieChart.getVisitorData()).done(function(data) {
            if (typeof el_chart == 'undefined' || typeof el_chart == null) {
                var el_chart = $(".chart-visitors-pie").get(0);
            }

            if (e_type != 'resize') {
                $(el_chart).loadingAnimation("hide");
            }

            var chart = new google.visualization.PieChart(document.getElementsByClassName("chart-visitors-pie")[0]);
            chart.draw(data.results, data.options);
        });

        // Cleanup
        el_chart = null;
    }
});
