@layout('layouts.default')

@section('content')
<div class="chartMenu row-fluid">
	<div class="span6" style="text-align:center">
		<p style="margin-top:7px" id="currentPosition" style="">Hello World</p>
	</div>
	<div class="span6" style="text-align:center">
		<button id="goBack" class="btn" onclick="goBack()" >Mergi cu un nivel mai sus</button>
	</div>
</div>
<div id="chartdiv" style="width:100%; height: 700px;"></div>
<table class="table table-bordered table-striped tabel-buget">
	<thead>
		<tr>
			<th>#</th>
			<th id="tipTabel">Nume Instituţie</th>
			<th>Bugetul alocat</th>
		</tr>
	</thead>
	<tbody>

	</tbody>
</table>
<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>
<script>window.jQuery || document.write('<script src="js/jquery.min.js"><\/script>')</script>
<script src="js/bootstrap.min.js"></script>
<script src="js/amcharts.js"></script>
<script src="js/charts2.js"></script>
<script src="js/getData2.js"></script>
@endsection
