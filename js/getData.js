var ministere=[14,15,16,17,18,19,20,21,22,23,24,25,26,27,28,29,35,54,65];
var altele = [1,2,3,4,5,6,7,8,9,10,11,13,30,31,32,33,34,37,38,39,40,41,42,43,44,45,46,47,48,50,51,52,53];
var levelMembers=[[ministere,altele],[ministere],[altele]];
var levelNames=[["Ministere","Alte instituţii"],[]];
var title=["Bugetul României","Ministerele României"];
var nextLevel=[[1,2],[3,3,3,3,3,3,3,3,3,3,3,3,3,3,3,3,3,3,3,3,3,3,3,3,3,3,3,3,3,3,3,3,3,3,3,3,3,3,3,3,3,3],[4,4,4,4,4,4,4,4,4,4,4,4,4,4,4,4,4,4,4,4,4,4,4,4,4,4,4,4,4,4,4,4,4,4,4,4,4,4,4],[0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0],[0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0]];
var beforeLevel=[-1,0,0,1,2];
var loading=0;
var currentlyInLevel=0;
var left=0;
var nameClickedPreviously=["","","","","",""];
function goBack()
{
    fillLevel(beforeLevel[currentlyInLevel]);
}
//LEVEL 0 : Ministere si alte institutii
//Level 1 : Ministere
//Level 2 : Alte institutii
//Level 3 : Titluri din interiorul fiecarui minister
//Level 4 : Titluri din interiorul fiecarei institutii
function fillLevel(level,id)
{
    $("#loader").show();
    currentlyInLevel=level;
    //STYLING
    if(level==2)
    {
        $("#chartdiv").addClass("big");
        $("#chartdiv").removeClass("small");
    }
    else
    {
        $("#chartdiv").removeClass("big");
        $("#chartdiv").addClass("small");
    }
    //FILLING AND CALLING DATA
    if(level===0)
    {
        chartData=[];
        $("#currentPosition").text("Te aflii la: "+title[level]);
        $("#goBack").hide();
        left=levelMembers[level].length;
        for(var i=0;i<levelMembers[level].length;i++)
            getData(levelMembers[level][i],0,1,level,i);
    }
    //MODYIFING
    if(level!=0)
    {
        $("#currentPosition").text("Te aflii la: "+nameClickedPreviously[beforeLevel[level]]);
        $("#goBack").show();
    }
    if(level==1)
    {
        chartData=[];
        left=levelMembers[level].length;
        for( var i=0;i<levelMembers[level].length;i++)
            getData(levelMembers[level][i],0,2,level,i);
    }
    if(level==2)
    {
        chartData=[];
        $("#chartdiv").addClass("big");
        left=levelMembers[level].length;
        for(var i=0;i<levelMembers[level].length;i++)
            getData(levelMembers[level][i],0,2,level,i);
    }
    if(level==3)
    {
        chartData=[];
        getData([id],1,3,level,id);
    }
    if(level==4)
    {
        console.log(id);
        chartData=[];
        getData([id],1,3,level,id);
    }

}
function fillLevelWithoutNames(level,array,itemNumber){
    var sum=0;
    for(var i=0;i<array.length;i++)
        sum+=parseInt(array[i].Suma);
        chartData.push({
        nume: levelNames[level][itemNumber],
        idForThis: itemNumber,
        value: sum,
        nextLevel : nextLevel[level][itemNumber] });
}
var object;
function fillLevelWithNames(level,array,itemNumber,type){

    var sum=0;
    object=array;
    for(var i=0;i<array.length;i++)
    {
        var value=parseInt(array[i].Suma);
        var nume;
        if(type==1)
            nume=array[i].NumeInstitutie;
        else
            nume=array[i].DenumireIndicator;
        chartData.push({
            nume: nume,
            idForThis: array[i].IdInstitutie,
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
    $("#loader").hide();
    chartData.sort(compare);
    chart.dataProvider = chartData;
    chart.validateData();
    $("[cursor='pointer']").hide();
    $("tbody").empty();
    for(var i=0;i<chartData.length;i++)
    {
        $("tbody").append("<tr><th></th><th></th><th></th></tr>");
        var currentTr=$('tbody tr:nth-child('+(i+1)+')');
        currentTr.find('th:nth-child(1)').text(i+1);
        currentTr.find('th:nth-child(2)').text(chartData[i].nume);
        currentTr.find('th:nth-child(3)').text(chartData[i].value+' lei');
    }
    if(currentlyInLevel===0 || currentlyInLevel ==1 )
    {
        $("#tipTabel").text("Nume institutie");
    }
    if(currentlyInLevel==3)
    {
        $("#tipTabel").text("Nume titlu");
    }
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
        data += "&copii=1" ;
    }
    console.log(data);
    $.ajax({
        dataType: "json",
        url: "ajax/getData.php",
        data: data,
        success: function(data){
            left--;
            console.log(data);
            if(cerere==1){
                console.log(left);
                fillLevelWithoutNames(level,data["results"],itemNumber);
                if(left===0)
                {
                updateData(true);
                }
            }
            if(cerere==2)
            {
                fillLevelWithNames(level,data["results"],itemNumber,1);
                if(left===0)
                {
                    updateData(true);
                }
            }
            if(cerere==3)
            {
                console.log(data);
                fillLevelWithNames(level,data["results"],itemNumber,2);
                updateData(true);
            }

        }
    });
}