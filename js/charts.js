var chart;
var legend;

var chartData = [{
    country: "Ministere",
    litres: 105402790000

},
    {
    country: "Altele",
    litres: 10956573000

}
];
var chartData2 = [{
    country: "Ministerul Afacerilor Externe",
    litres: 564842000
},
{
    country: "Ministerul Tehnlogiei",
    litres: 7972817000
},
{
    country: "Ministerul Tehnlogiei",
    litres: 5562740000
},
{
    country: "Ministerul Tehnlogiei",
    litres: 5194905000
},
{
    country: "Ministerul Tehnlogiei",
    litres: 546064000
},
    {
    country: "Ministerul Tehnlogiei",
    litres: 2172910000
},
{
    country: "Ministerul Tehnlogiei",
    litres: 1164991000
},
{
    country: "Ministerul Tehnlogiei",
    litres: 2801351000
},
{
    country: "Ministerul Tehnlogiei",
    litres: 23468600000
},
    {
    country: "Ministerul Tehnlogiei",
    litres: 172886000
},
{
    country: "Ministerul Tehnlogiei",
    litres: 2291551000
},
{
    country: "Ministerul Tehnlogiei",
    litres: 2084271000
},
{
    country: "Ministerul Tehnlogiei",
    litres: 30440524000
},
    {
    country: "Ministerul Tehnlogiei",
    litres: 199186000
},
{
    country: "Ministerul Tehnlogiei",
    litres: 651144000
},
{
    country: "Ministerul Tehnlogiei",
    litres: 7221673000
},
{
    country: "Ministerul Tehnlogiei",
    litres: 302374000
},
{
    country: "Ministerul Tehnlogiei",
    litres: 7291157000
}];

AmCharts.ready(function() {
      // PIE CHART
    chart = new AmCharts.AmPieChart();
    chart.dataProvider = chartData;
    chart.titleField = "country";
    chart.valueField = "litres";

    // LEGEND
    legend = new AmCharts.AmLegend();
    legend.align = "center";
    legend.markerType = "circle";
    chart.addLegend(legend);
    chart.addListener("clickSlice", handleClick)
    function handleClick()
    {
            chart.dataProvider = chartData2;
        chart.validateData();
    }
    // WRITE
    chart.write("chartdiv");
});