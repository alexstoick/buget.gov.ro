var ministere=[];
for(var j=1;j<=18;j++)
	ministere[j-1]=""+j;
var altele=[18];
var levelMembers=[[ministere,altele],[ministere]];
var levelNames=[["Ministere","Alte insutitii"],[]];
var nextLevel=[[1,2],[3,3,3,3,3,3,3,3,3,3,3,3,3,3,3,3,3,3,3,3,3,3,3,3,3,3,3,3,3,3,3,3,3]];
var loading=0;
var level=0;
var left=0;
function fillLevel(level,id)
{
	
	left=levelMembers[level].length;
	if(level==0)
	{
		for(var i=0;i<levelMembers[level].length;i++)
			getData(levelMembers[level][i],0,1,level,i);
	}
	if(level==1)
	{
		chartData=[];
		for(var i=0;i<levelMembers[level].length;i++)
			getData(levelMembers[level][i],0,2,level,i);
	}
	if(level==3)
	{
		chartData=[];
		getData()
	}
}
function fillLevelWithoutNames(level,array,itemNumber){
	var sum=0;
 	for(var i=0;i<array.length;i++)
 		sum+=parseInt(array[i].suma);
 	chartData.push({
    	nume: levelNames[level][itemNumber],
    	id: itemNumber,
    	value: sum,
    	nextLevel : nextLevel[level][itemNumber] });
}
var object;
function fillLevelWithNames(level,array,itemNumber){
	var sum=0;
	object=array;
 	for(var i=0;i<array.length;i++)
 	{
 		var value=parseInt(array[i].suma);
 		// if(value>8000000)
 		// 	value=8000000;
 		chartData.push({
    		nume: array[i].numeInstitutie,
    		id: itemNumber,
    		value: value,
    		nextLevel : nextLevel[level][itemNumber]
    });
 	}
}
function compare(a,b)
{
	if(parseInt(a.value)<parseInt(b.value))
	{
		return 1;
	}
	if(parseInt(a.value)>parseInt(b.value))
	{
		return -1;
	}
	return 0;
}
function updateData(withAnimation)
{
	chartData.sort(compare);
	console.log(chartData);
	chart.dataProvider = chartData;
	chart.validateData();
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
			left--;
			console.log(data);
			if(cerere==1){
				fillLevelWithoutNames(level,data["results"],itemNumber);
			}
			if(cerere==2)
			{
				fillLevelWithNames(level,data["results"],itemNumber);
			}
			if(cerere==3)
			{

			}
			if(left==0)
			{
				updateData(true);
			}
		}
	});
}