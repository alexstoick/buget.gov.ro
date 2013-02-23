var ministere=[];
for(var j=1;j<=18;j++)
	ministere[j-1]=""+j;
var altele=[18];
var levelMembers=[[ministere,altele],[ministere]];
var levelNames=[["Ministere","Alte instituţii"],[]];
var title=["Bugetul României","Ministerele României"];
var nextLevel=[[1,2],[3,3,3,3,3,3,3,3,3,3,3,3,3,3,3,3,3,3,3,3,3,3,3,3,3,3,3,3,3,3,3,3,3,3,3,3,3,3,3,3,3,3],[],[0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0]];
var beforeLevel=[-1,0,0,1];
var loading=0;
var currentlyInLevel=0;
var left=0;
var nameClickedPreviously=["","","","","",""];
function goBack()
{
	fillLevel(beforeLevel[currentlyInLevel]);
}
function fillLevel(level,id)
{
	
	currentlyInLevel=level;

	if(level==0)
	{
		chartData=[];
		$("#currentPosition").text(title[level]);
		$("#goBack").hide();
		left=levelMembers[level].length;
		for(var i=0;i<levelMembers[level].length;i++)
			getData(levelMembers[level][i],0,1,level,i);
	}
	if(level!=0)
	{
		$("#currentPosition").text(nameClickedPreviously[beforeLevel[level]]);
		$("#goBack").show();
	}
	if(level==1)
	{
		chartData=[];
		left=levelMembers[level].length;
		for(var i=0;i<levelMembers[level].length;i++)
			getData(levelMembers[level][i],0,2,level,i);
	}
	if(level==2)
	{
		//NEED DATA
	}
	if(level==3)
	{
		chartData=[];
		getData([id],1,3,level,id);
	}
	if(level==4)
	{
		
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
function fillLevelWithNames(level,array,itemNumber,type){
	var sum=0;
	object=array;
	console.log(array);
 	for(var i=0;i<array.length;i++)
 	{
 		var value=parseInt(array[i].suma);
 		var nume;
 		if(type==1)
 			nume=array[i].numeInstitutie;
 		else
 			nume=array[i].denumireIndicator;
 		chartData.push({
    		nume: nume,
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
	if(copii==1){
		data += "&copii=1"
	}
	
	$.ajax({
		dataType: "json",
		url: "ajax/getData.php",
		data: data,
		success: function(data){
			left--;
			if(cerere==1){
				fillLevelWithoutNames(level,data["results"],itemNumber);
				if(left==0)
				{
				updateData(true);
				}
			}
			if(cerere==2)
			{
				fillLevelWithNames(level,data["results"],itemNumber,1);
				if(left==0)
				{
					updateData(true);
				}
			}
			if(cerere==3)
			{
				fillLevelWithNames(level,data["results"],itemNumber,2);
				updateData(true);
			}
			
		}
	});
}