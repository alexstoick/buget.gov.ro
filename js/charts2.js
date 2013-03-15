var chart;
var legend;
var graph;
var chartData= [];
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
	valueAxis.gridAlpha = 0.1;
	valueAxis.totalText = "[[total]]";
	valueAxis.ignoreAxisWidth = true;
	valueAxis.showLastLabel = false ;
	valueAxis.usePrefixes = true ;
	valueAxis.position = "top";
	chart.addValueAxis(valueAxis);

	// GRAPHS
	graph = new AmCharts.AmGraph();
	graph.type = "column";
	graph.title = "Fonduri";
	graph.valueField = "value";
	graph.balloonText = "Buget:[[value]] lei";
	graph.lineAlpha = 0;
	graph.fillColors = ["#001e55", "#0093e0"];
	graph.fillAlphas = 1;
	graph.labelPosition = "left" ;
	graph.labelText = "[[value]]" ;
	chart.addGraph(graph);

	// LEGEND
	var legend = new AmCharts.AmLegend();
	chart.addLegend(legend);

	// WRITE
	chart.write("chartdiv");
	chart.addListener("clickGraphItem",handleClick);

	function handleClick(item)
	{
		if(currentlyInLevel===0)
		{
			nameClickedPreviously=chartData[item.index].nume;
			fillLevel(1,chartData[item.index].idForThis);
		}
	}
	fillLevel(0,0);
});