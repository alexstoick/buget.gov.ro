<!doctype html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
	<title>buget.gov.ro</title>
	<meta name="viewport" content="width=device-width">
	{{ HTML::style('css/bootstrap.min.css') }}
	{{ HTML::style('css/bootstrap-responsive.min.css') }}
	{{ HTML::style('css/style.css') }}
</head>
<body>
	<div class="baraSus">
		<div class="container" id="navbarContainer">
			<a class="brand pull-right hidden-phone" href="#" style="color:white;float:right;font-size:1em"><h5>Site oficial al Guvernului Romaniei</a>
			<a class="brand pull-right" id="logo" href="#" style="color:white;float:right">{{ HTML::image('img/stema.png') }}</a>
		</div>
	</div>

	<div class="hero-unit" id="baraVerde">
		<div class="container">
			<h3 style="color:white;margin-top:0">BUGET.GOV.RO</h3>
		</div>
	</div>
	<div class="container mainDiv" style="background-color:white">
		<div class="navbar">
			<div class="navbar-inner">
				<div class="container">
					<a class="btn btn-navbar collapsed" data-toggle="collapse" data-target=".nav-collapse">
						<span class="icon-bar"></span>
						<span class="icon-bar"></span>
						<span class="icon-bar"></span>
					</a>
					<div class="nav-collapse collapse" style="height: 0px;">
						<ul class="nav">
							<li class="pull-left"><a href="{{ URL::to('home') }}"><i class="icon-home icon-white"></i></a></li>
							<li class="pull-left"><a href="{{ URL::to('institutii') }}">Afisarea pe instituii</a></li>
							<li class="pull-left"><a href="{{ URL::to('functional') }}">Afisarea functionala</a></li>
							<li class="pull-left" ><a href="{{ URL::to('home/resurse') }}" >Resurse</a></li>
						</ul>
					</div>
				</div>
			</div>
		</div>
		<div id="loader" style="position:absolute;right:25px;top:90px;display:none;width:25px;" >{{ HTML::image("img/loader.gif") }}</div>
		@yield('content')
	</div>
	<div class="container" style="margin-top:30px" id="footer">
		<div class="row-fluid">
			<div class="span8">{{ HTML::image("img/logoSiTextGuv.png") }}</div>
			<div class="span4">
				<p class="logohack">{{ HTML::image("img/logohack.png") }}</p>
				<p>Proiect realizat la prima editie a Hackathonului organizat de catre Guvernul Romaniei</p>
				<p><a href="{{ URL::to('echipa') }}">Vezi echipa de proiect &rarr;</a></p>
			</div>
		</div>
	</div>	
	<script src="//ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>
	<script src="js/bootstrap.min.js"></script>
</body>
</html>

