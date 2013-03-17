@layout('layouts.default')

@section('content')
<div class="row-fluid">
	<div class="span9">
		<h1>Bugetul României este disponibil în diferite formate</h1>
		<p>Am pus bugetul la dispozitie </p>
		<h3>OData, JSON</h3>
		<a href="http://rogovdata.cloudapp.net/DataBrowser/RoGovOpenData/Buget#param=NOFILTER--DataView--Results">
			rogovdata.cloudapp.net
		</a>
		<h3>.CSV</h3>
		<a href="http://rogovdata.cloudapp.net/DataBrowser/DownloadCsv?container=RoGovOpenData&entitySet=Buget&filter=NOFILTER">
			Download
		</a>
	</div>
	<div class="sidebar">
   		<?php echo render('partials.sidebar'); ?>
	</div>

</div>	
@endsection
