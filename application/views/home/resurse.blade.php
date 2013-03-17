@layout('layouts.default')

@section('content')
	<h1>Bugetul României în diferite formate</h1>
	<h3>OData, JSON, Excel, CSV</h3>
	<a href="http://rogovdata.cloudapp.net/DataBrowser/RoGovOpenData/Buget#param=NOFILTER--DataView--Results">
		rogovdata.cloudapp.net
	</a>
	<h3>.xml</h3>
	<a href="{{URL::base()}}\resurse\bugetul-romaniei.csv">Download</a>
	
@endsection
