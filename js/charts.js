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

	//better visualization of grid
	valueAxis.gridAlpha = 0.2;

	//solved the fucking last label
	valueAxis.showLastLabel = false ;

	// valueAxis.unit=" lei";
	valueAxis.ignoreAxisWidth = true;
	// valueAxis.logarithmic=true;

	valueAxis.position = "top";
	chart.addValueAxis(valueAxis);

	// GRAPHS
	// first graph
	var graph1 = new AmCharts.AmGraph();
	graph1.type = "column";
	graph1.title = "Fonduri";
	graph1.valueField = "value";
	graph1.balloonText = "Buget:[[value]] lei";
	graph1.lineAlpha = 0;
	graph1.fillColors = ["#001e55", "#0093e0"];
	graph1.fillAlphas = 1;
	chart.addGraph(graph1);



	// LEGEND
	var legend = new AmCharts.AmLegend();
	chart.addLegend(legend);

	// WRITE
	chart.write("chartdiv");
	chart.addListener("clickGraphItem",handleClick);

	function handleClick(item)
	{
		console.log(chartData[item.index]);
		nameClickedPreviously[currentlyInLevel]=chartData[item.index].nume;
		fillLevel(chartData[item.index].nextLevel,chartData[item.index].idForThis);
	}
	fillLevel(0);
});
