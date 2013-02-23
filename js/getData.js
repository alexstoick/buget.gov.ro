var date=[["MACPN","MAE"],"MADR"];
function findSum(array){
	var sum=0;
 	for(var i=0;i<array.length;i++)
 		getData(array[0],0,function(data){
 			sum+=data
 		});
 	return sum;
}
function getData(array,copii,callback){
	var data="institutie="
	for(var i=0;i<array.length;i++)
	{
		data+=array[i]+",";
	}
	data[data.length]=0;
	if(copii==1){
		data += "&copii=1"
	}
	$.ajax({
		dataType: "json",
		url: "ajax/getData.php",
		data: data,
		success: function(data){
			callback(data["results"][0]);
		}
	});
}