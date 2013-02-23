var ministere=[];
for(var j=1;j<=18;j++)
	ministere[j-1]=""+j;
var altele=[18];
var levelMembers=[[ministere,altele],[ministere]];
var levelNames=[["Ministere","Alte insutitii"],[]];
var nextLevel=[[1,2]];
var loading=0;
console.log("loading");
var level=0;
var left=0;
function fillLevel(level)
{
	
	if(level==0)
	{
		
		for(var i=0;i<levelMembers[0].length;i++)
			getData(levelMembers[level][i],0,1,level,i);
	}
	if(level==1)
	{
		chartData=[];
		for(var i=0;i<levelMembers[level].length;i++)
			getData(levelMembers[level][i],0,2,level,i);
	}
}
function fillLevelWithoutNames(level,array,itemNumber){
	var sum=0;
 	for(var i=0;i<array.length;i++)
 		sum+=parseInt(array[i].suma);
 	console.log
 	chartData.push({
    	nume: levelNames[level][itemNumber],
    	value: sum,
    	nextLevel : nextLevel[level][itemNumber] });
}
var object;
function fillLevelWithNames(level,array,itemNumber){
	var sum=0;
	console.log(array);
	object=array;
 	for(var i=0;i<array.length;i++)
 	{
 		var value=parseInt(array[i].suma);
 		// if(value>8000000)
 		// 	value=8000000;
 		chartData.push({
    		nume: array[i].numeInstitutie,
    	value: value});
 	}
}
function compare(a,b)
{
	if(a.value<b.value)
		return true;
	return false;
}
function getData(array,copii,cerere,level,itemNumber){
	var data="institutie=";
	loading=0;
	for(var i=0;i<array.length;i++)
	{
		data+=array[i];
		if(i!=array.length-1)
			data+=",";

	}
	console.log(data);
	if(copii==1){
		data += "&copii=1"
	}
	
	$.ajax({
		dataType: "json",
		url: "ajax/getData.php",
		data: data,
		success: function(data){
			if(cerere==1){
				fillLevelWithoutNames(level,data["results"],itemNumber);
				chart.dataProvider = chartData;
				chart.validateData();
				//console.log("ALIVE");
			}
			if(cerere==2)
			{

				fillLevelWithNames(level,data["results"],itemNumber);
				chartData.sort(compare);
				chart.dataProvider = chartData;

				chart.validateData();
				chart.animateAgain();
			}
			loading=1;
		}
	});
}