//LEVEL 0 Tipuri Functiuni
//Level 1 Functiuni pe institutii
var left=0;
var nameClickedPreviously=0;
var currentlyInLevel=0;
sectiuni = [5101 , 5401, 6701,6801,6101,6501,8001,8201,8401,5301,7001,8701,6001,6601,5601,8301,8601,7401,8501,8101,5501] ;
function fillLevel(level,id)
{
    $("#loader").show();
    chartData=[];
    if(level === 0)
    {
        currentlyInLevel=0;
        left=sectiuni.length;
        for(var i=0;i<sectiuni.length;i++)
            getData(1,sectiuni[i]);
        $("#goBack").hide();
        $("#currentPosition").text("Esti in: Tip activitati");
    }
    if(level == 1)
    {
        currentlyInLevel=1;
        left=1;
        $("#goBack").show();
        $("#currentPosition").text("Esti in: "+nameClickedPreviously);
        getData(0,id);
    }
}
function goBack()
{
    fillLevel(0);
}
function compare(a,b)
{
    if(parseInt(a.value,10) < parseInt(b.value,10) )
    {
        return 1;
    }
    if(parseInt(a.value,10)>parseInt(b.value,10))
    {
        return -1;
    }
    return 0;
}
function addCommas(str) {
    var amount = new String(str);
    amount = amount.split("").reverse();

    var output = "";
    for ( var i = 0; i <= amount.length-1; i++ ){
        output = amount[i] + output;
        if ((i+1) % 3 == 0 && (amount.length-1) !== i)output = ',' + output;
    }
    return output;
}
function updateData()
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
        currentTr.find('th:nth-child(3)').text(addCommas(chartData[i].value)+' mil. lei');
    }
}
function getData(tipRequest,id)
{
    var data="sectiune="+id;

    if(tipRequest==1)
    {
        data+="&suma=1";
    }
    $.ajax({
        dataType: "json",
        url: "ajax/getData.php",
        data: data,
        success: function(data){
            left--;
            if(tipRequest==1)
            {
                chartData.push({
                nume: data.numeSectiune,
                idForThis: id,
                value: data.suma
                });
            }
            else
            {
                var array=data["results"];

                for(var i=0;i<array.length;i++)
                {
                    chartData.push({
                        nume:array[i].NumeInstitutie,
                        idForThis:id,
                        value: array[i].Suma
                    }) ;
                }
            }
            if(left===0)
                updateData();
        }
    });
}