(function(){
  
  // Creates the constructor for the googleGraphs
  googleGraphs = function(options) {
    // Default options for the googleGraphs
    this.config = {
      container: document.getElementById('graph_canvas'),
      data: null,
      chart: null,
      drawMethod: googleGraphs.prototype.areaChart,
      chartOptions: { title: 'NoJam graphical reports' }
    }
    
    // Store the definitive options for the googleGraphs
    this.config = $.extend({}, this.config, options);

    // Convert the json object to a DataTable
    this.config.data = new google.visualization.DataTable(this.config.data);
    
    // Execute the Draw Method of the object
    this.config.drawMethod();
  }
  
  // Draw the chart
  googleGraphs.prototype.draw = function(){
    // Execute the Draw Method of the object
    this.config.drawMethod();
  }
    
  // Create a new AreaChart
  googleGraphs.prototype.areaChart = function() {
    this.chart = new google.visualization.AreaChart(this.container);
    this.chart.draw(this.data, this.chartOptions);
  }

  // Create a new BarChart
  googleGraphs.prototype.barChart = function() {
    this.chart = new google.visualization.BarChart(this.container);
    this.chart.draw(this.data, this.chartOptions);
  }

  // Create a new ColumnChart
  googleGraphs.prototype.columnChart = function() {
    this.chart = new google.visualization.ColumnChart(this.container);
    this.chart.draw(this.data, this.chartOptions);
  }
})();