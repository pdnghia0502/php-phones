function setSidebarHeight(){
	setTimeout(function(){
var height = $(document).height();
    $('.grid_12').each(function () {
        height -= $(this).outerHeight();
    });
    height -= $('#site_info').outerHeight();
	height-=1;
    $('.sidemenu').css('height', height);					   
						},100);
}

function setupDashboardChart(containerElementId) {
    var s1 = [200, 300, 400, 500, 600, 700, 800, 900, 1000];
    var s2 = [190, 290, 390, 490, 590, 690, 790, 890, 990];
    var s3 = [250, 350, 450, 550, 650, 750, 850, 950, 1050];
    var s4 = [2000, 1600, 1400, 1100, 900, 800, 1550, 1950, 1050];
    var ticks = ['March', 'April', 'May', 'June', 'July', 'August', 'September', 'October', 'November'];

    var plot1 = $.jqplot(containerElementId, [s1, s2, s3, s4], {
        seriesDefaults: {
            renderer: $.jqplot.BarRenderer,
            rendererOptions: { fillToZero: true }
        },
        series: [
            { label: 'Apples' },
            { label: 'Oranges' },
            { label: 'Mangoes' },
            { label: 'Grapes' }
        ],
        legend: {
            show: true,
            placement: 'outsideGrid'
        },
        axes: {
            xaxis: {
                renderer: $.jqplot.CategoryAxisRenderer,
                ticks: ticks
            },
            yaxis: {
                pad: 1.05,
                tickOptions: { formatString: '$%d' }
            }
        }
    });
}

function drawPointsChart(containerElement) {


    var cosPoints = [];
    for (var i = 0; i < 2 * Math.PI; i += 0.4) {
        cosPoints.push([i, Math.cos(i)]);
    }

    var sinPoints = [];
    for (var i = 0; i < 2 * Math.PI; i += 0.4) {
        sinPoints.push([i, 2 * Math.sin(i - .8)]);
    }

    var powPoints1 = [];
    for (var i = 0; i < 2 * Math.PI; i += 0.4) {
        powPoints1.push([i, 2.5 + Math.pow(i / 4, 2)]);
    }

    var powPoints2 = [];
    for (var i = 0; i < 2 * Math.PI; i += 0.4) {
        powPoints2.push([i, -2.5 - Math.pow(i / 4, 2)]);
    }

    var plot3 = $.jqplot(containerElement, [cosPoints, sinPoints, powPoints1, powPoints2],
    {
        title: 'Line Style Options',
        series: [
          {
              lineWidth: 2,
              markerOptions: { style: 'dimaond' }
          },
          {
              showLine: false,
              markerOptions: { size: 7, style: "x" }
          },
          {
              markerOptions: { style: "circle" }
          },
          {
              lineWidth: 5,
              markerOptions: { style: "filledSquare", size: 10 }
          }
      ]
    }
  );

}

function drawPieChart(containerElement) {
    var data = [
    ['Heavy Industry', 12], ['Retail', 9], ['Light Industry', 14],
    ['Out of home', 16], ['Commuting', 7], ['Orientation', 9]
  ];
    var plot1 = jQuery.jqplot('chart1', [data],
    {
        seriesDefaults: {
            renderer: jQuery.jqplot.PieRenderer,
            rendererOptions: {
                showDataLabels: true
            }
        },
        legend: { show: true, location: 'e' }
    }
  );
}
function drawDonutChart(containerElement) {
    var s1 = [['a', 6], ['b', 8], ['c', 14], ['d', 20]];
    var s2 = [['a', 8], ['b', 12], ['c', 6], ['d', 9]];

    var plot3 = $.jqplot(containerElement, [s1, s2], {
        seriesDefaults: {
            renderer: $.jqplot.DonutRenderer,
            rendererOptions: {
                sliceMargin: 3,
                startAngle: -90,
                showDataLabels: true,
                dataLabels: 'value'
            }
        }
    });
}

function drawBarchart(containerElement) {
    var s1 = [200, 600, 700, 1000];
    var s2 = [460, -210, 690, 820];
    var s3 = [-260, -440, 320, 200];
    var ticks = ['May', 'June', 'July', 'August'];

    var plot1 = $.jqplot(containerElement, [s1, s2, s3], {
        seriesDefaults: {
            renderer: $.jqplot.BarRenderer,
            rendererOptions: { fillToZero: true }
        },
        series: [
            { label: 'Hotel' },
            { label: 'Event Regristration' },
            { label: 'Airfare' }
        ],
        legend: {
            show: true,
            placement: 'outsideGrid'
        },
        axes: {
            xaxis: {
                renderer: $.jqplot.CategoryAxisRenderer,
                ticks: ticks
            },
            yaxis: {
                pad: 1.05,
                tickOptions: { formatString: '$%d' }
            }
        }
    });
}
//draw bubble chart
function drawBubbleChart(containerElement) {

    var arr = [[11, 123, 1236, ""], [45, 92, 1067, ""],
  [24, 104, 1176, ""], [50, 23, 610, "A"],
  [18, 17, 539, ""], [7, 89, 864, ""], [2, 13, 1026, ""]];

    var plot1b = $.jqplot(containerElement, [arr], {
        seriesDefaults: {
            renderer: $.jqplot.BubbleRenderer,
            rendererOptions: {
                bubbleAlpha: 0.6,
                highlightAlpha: 0.8,
                showLabels: false
            },
            shadow: true,
            shadowAlpha: 0.05
        }
    });

    $.each(arr, function (index, val) {
        $('#' + containerElement).append('<tr><td>' + val[3] + '</td><td>' + val[2] + '</td></tr>');
    });

    $('#' + containerElement).bind('jqplotDataHighlight',
    function (ev, seriesIndex, pointIndex, data, radius) {
        var chart_left = $('#' + containerElement).offset().left,
        chart_top = $('#' + containerElement).offset().top,
        x = plot1b.axes.xaxis.u2p(data[0]),
        y = plot1b.axes.yaxis.u2p(data[1]);
        var color = 'rgb(50%,50%,100%)';
        $('#tooltip1b').css({ left: chart_left + x + radius + 5, top: chart_top + y });
        $('#tooltip1b').html('<span style="font-size:14px;font-weight:bold;color:' +
      color + ';">' + data[3] + '</span><br />' + 'x: ' + data[0] +
      '<br />' + 'y: ' + data[1] + '<br />' + 'r: ' + data[2]);
        $('#tooltip1b').show();
        $('#legend1b tr').css('background-color', '#ffffff');
        $('#legend1b tr').eq(pointIndex + 1).css('background-color', color);
    });


    $('#' + containerElement).bind('jqplotDataUnhighlight',
      function (ev, seriesIndex, pointIndex, data) {
          $('#tooltip1b').empty();
          $('#tooltip1b').hide();
          $('#' + containerElement + ' tr').css('background-color', '#ffffff');
      });
}

function initializeGallery() {
    $("ul.gallery li").hover(function () {

        var $image = (this);

        $(this).find(".actions").show();

        $(this).find(".actions .delete").click(function () {

            $("#dialog-confirm").dialog({
                resizable: false,
                modal: true,
                minHeight: 0,
                draggable: false,
                buttons: {
                    "Delete": function () {
                        $(this).dialog("close");

                        $($image).fadeOut('slow', function () {
                            $($image).remove();
                        });

                    },

                    Cancel: function () {
                        $(this).dialog("close");
                    }
                }
            });

            return false;
        });

        $(this).find("img").css("opacity", "0.5");

        $(this).hover(function () {
        }, function () {

            $(this).find(".actions").hide();


            $(this).find("img").css("opacity", "1");

        });
    });
}
function setupGallery() {
    initializeGallery();
    $('ul.gallery').each(function () {
        var $fileringType = $("ul.sorting li.active a[data-type]").first().before(this);
        var $filterType = $($fileringType).attr('data-id');

        var $gallerySorting = $(this).parent().prev().children('ul.sorting');

        var $holder = $(this);

        var $data = $holder.clone();

        $($gallerySorting).find("a[data-type]").click(function (e) {
            $($gallerySorting).find("a[data-type].active").removeClass('active');
            var $filterType = $(this).attr('data-type');
            $(this).addClass('active');
            if ($filterType == 'all') {
                var $filteredData = $data.find('li');
            }
            else {
                
                var $filteredData = $data.find('li[data-type=' + $filterType + ']');
            }

            $holder.quicksand($filteredData, {
                duration: 800,
                easing: 'easeInOutQuad',
                useScaling: true,
                adjustHeight: 'auto'
            }, function () {
                $('.popup').facebox();
                initializeGallery();
            });

            return false;
        });

    });
}

function setupPrettyPhoto() {

    $("a[rel^='prettyPhoto']").prettyPhoto();
}


function setupTinyMCE() {
    $('textarea.tinymce').tinymce({
        script_url: 'js/tiny-mce/tiny_mce.js',

        theme: "advanced",
        plugins: "autolink,lists,pagebreak,style,layer,table,save,advhr,advimage,advlink,emotions,iespell,inlinepopups,insertdatetime,preview,media,searchreplace,print,contextmenu,paste,directionality,fullscreen,noneditable,visualchars,nonbreaking,xhtmlxtras,template,advlist",

        theme_advanced_buttons1: "save,newdocument,|,bold,italic,underline,strikethrough,|,justifyleft,justifycenter,justifyright,justifyfull,styleselect,formatselect,fontselect,fontsizeselect",
        theme_advanced_buttons2: "cut,copy,paste,pastetext,pasteword,|,search,replace,|,bullist,numlist,|,outdent,indent,blockquote,|,undo,redo,|,link,unlink,anchor,image,cleanup,help,code,|,insertdate,inserttime,preview,|,forecolor,backcolor",
        theme_advanced_buttons3: "tablecontrols,|,hr,removeformat,visualaid,|,sub,sup,|,charmap,emotions,iespell,media,advhr,|,print,|,ltr,rtl,|,fullscreen",
        theme_advanced_buttons4: "insertlayer,moveforward,movebackward,absolute,|,styleprops,|,cite,abbr,acronym,del,ins,attribs,|,visualchars,nonbreaking,template,pagebreak",
        theme_advanced_toolbar_location: "top",
        theme_advanced_toolbar_align: "left",
        theme_advanced_statusbar_location: "bottom",
        theme_advanced_resizing: true,

        content_css: "css/content.css",

        template_external_list_url: "lists/template_list.js",
        external_link_list_url: "lists/link_list.js",
        external_image_list_url: "lists/image_list.js",
        media_external_list_url: "lists/media_list.js",

        template_replace_values: {
            username: "Some User",
            staffid: "991234"
        }
    });
}

function setDatePicker(containerElement) {
    var datePicker = $('#' + containerElement);
    datePicker.datepicker({
        showOn: "button",
        buttonImage: "img/calendar.gif",
        buttonImageOnly: true
    });
}
function setupProgressbar(containerElement) {
    $("#" + containerElement).progressbar({
        value: 59
    });
}

//setup dialog box

function setupDialogBox(containerElement, associatedButton) {
    $.fx.speeds._default = 1000;
    $("#" + containerElement).dialog({
        autoOpen: false,
        show: "blind",
        hide: "explode"
    });

    $("#" + associatedButton).click(function () {
        $("#" + containerElement).dialog("open");
        return false;
    });
}

function setupAccordion(containerElement) {
    $("#" + containerElement).accordion();
}

function setupLeftMenu() {
    $("#section-menu")
        .accordion({
            "header": "a.menuitem"
        })
        .bind("accordionchangestart", function (e, data) {
            data.newHeader.next().andSelf().addClass("current");
            data.oldHeader.next().andSelf().removeClass("current");
        })
        .find("a.menuitem:first").addClass("current")
        .next().addClass("current");
		
		$('#section-menu .submenu').css('height','auto');
}
