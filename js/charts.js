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
    country: "Ministerul Tehnlogiei",
    litres: 260},
{
    country: "Ministerul Tehnlogiei",
    litres: 201},
{
    country: "Ministerul Tehnlogiei",
    litres: 65},
{
    country: "Ministerul Tehnlogiei",
    litres: 39},
{
    country: "Ministerul Tehnlogiei",
    litres: 19},
    {
    country: "Ministerul Tehnlogiei",
    litres: 201},
{
    country: "Ministerul Tehnlogiei",
    litres: 65},
{
    country: "Ministerul Tehnlogiei",
    litres: 39},
{
    country: "Ministerul Tehnlogiei",
    litres: 19},
    {
    country: "Ministerul Tehnlogiei",
    litres: 201},
{
    country: "Ministerul Tehnlogiei",
    litres: 65},
{
    country: "Ministerul Tehnlogiei",
    litres: 39},
{
    country: "Ministerul Tehnlogiei",
    litres: 19},
    {
    country: "Ministerul Tehnlogiei",
    litres: 201},
{
    country: "Ministerul Tehnlogiei",
    litres: 65},
{
    country: "Ministerul Tehnlogiei",
    litres: 39},
{
    country: "Ministerul Tehnlogiei",
    litres: 19},
{
    country: "Ministerul Tehnlogiei",
    litres: 10}];

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