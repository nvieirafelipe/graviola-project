var googleGraphs;

$(document).ready(function(){
  $.ajax({
        url: 'reports/chart-data.json',
        dataType: 'json',
        error:function (xhr, ajaxOptions, thrownError){
            renderError(xhr.status, xhr.statusText, xhr.responseText);
        },
        success: function(data) {
          // Create the option object for graph, with data retrieved from the url
          var options =   {
            container: document.getElementById('graph_canvas'),
            data: data,
            drawMethod: googleGraphs.prototype.barChart,
            chartOptions: {title: 'NoJam graphical reports! Area chart.'}
          };

          // Creates and show the chart with the options passed
          var columnGraph = new googleGraphs(options);
        }
  });
  
  function renderError(status, title, text){
    var $newdiv1 = $('<div id="error_'+status+'" class="error" />');
    $newdiv1.append('<p>'+text+'</p>');
    
    $('div#graph_canvas').append($newdiv1);
  }
});