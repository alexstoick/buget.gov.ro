function getData(id,copii){
	$.ajax({
		dataType: "json",
		url: "ajax/getData.php",
		data: "minister="+id+"&copii="+copii,
		success: function(data){
			console.log(data);
		}
	});
}