var chart;
var legend;
var chartData=new Array();
AmCharts.ready(function() {
      chart = new AmCharts.AmSerialChart();
    chart.dataProvider = chartData;
    chart.categoryField = "nume";
    chart.startDuration = 1;
    chart.plotAreaBorderColor = "#DADADA";
    chart.plotAreaBorderAlpha = 1;
    // this single line makes the chart a bar chart          
    chart.rotate = true;

    // AXES
    // Category
    var categoryAxis = chart.categoryAxis;
    categoryAxis.gridPosition = "start";
    categoryAxis.gridAlpha = 0.1;
    categoryAxis.axisAlpha = 0;

    // Value
    var valueAxis = new AmCharts.ValueAxis();
    valueAxis.axisAlpha = 0;
    valueAxis.gridAlpha = 0.1;
    valueAxis.position = "top";
    chart.addValueAxis(valueAxis);

    // GRAPHS
    // first graph
    var graph1 = new AmCharts.AmGraph();
    graph1.type = "column";
    graph1.title = "Banii";
    graph1.valueField = "value";
    graph1.balloonText = "Income:[[value]]";
    graph1.lineAlpha = 0;
    graph1.fillColors = "#ADD981";
    graph1.fillAlphas = 1;
    chart.addGraph(graph1);

  

    // LEGEND
    var legend = new AmCharts.AmLegend();
    chart.addLegend(legend);

    // WRITE
    chart.write("chartdiv");
    chart.addListener("clickGraphItem",handleClick)
    function handleClick(item)
    {
        console.log(item);
        fillLevel(chartData[item.index].nextLevel);
    }
    fillLevel(0);
});