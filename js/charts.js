var chart;
var legend;
var chartData=[] ;
AmCharts.ready(function() {

	chart = new AmCharts.AmSerialChart();
	chart.dataProvider = chartData;
	chart.categoryField = "nume";
	chart.startDuration = 1;
	chart.plotAreaBorderColor = "#DADADA";
	chart.plotAreaBorderAlpha = 1;
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
	valueAxis.gridAlpha = 0.2;
	valueAxis.showLastLabel = false ;
	valueAxis.ignoreAxisWidth = true;
	valueAxis.position = "top";
	valueAxis.usePrefixes = true ;
	chart.addValueAxis(valueAxis);

	// GRAPHS
	var graph = new AmCharts.AmGraph();
	graph.type = "column";
	graph.title = "Fonduri";
	graph.valueField = "value";
	graph.balloonText = "Buget:[[value]] lei";
	graph.lineAlpha = 0;
	graph.fillColors = ["#001e55", "#0093e0"];
	graph.fillAlphas = 1;
	chart.addGraph(graph);

	// LEGEND
	var legend = new AmCharts.AmLegend();
	chart.addLegend(legend);

	// WRITE
	chart.write("chartdiv");
	chart.addListener("clickGraphItem",handleClick);

	function handleClick(item)
	{
		nameClickedPreviously[currentlyInLevel]=chartData[item.index].nume;
		fillLevel(chartData[item.index].nextLevel,chartData[item.index].idForThis);
	}
	fillLevel(0);
});
