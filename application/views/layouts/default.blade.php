<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
	<title>buget.gov.ro</title>
	<meta name="viewport" content="width=device-width">
	{{ HTML::style('css/bootstrap.min.css') }}
	{{ HTML::style('css/bootstrap-responsive.min.css') }}
	{{ HTML::style('css/style.css') }}
	<script src="//ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>
	{{ HTML::script('js/bootstrap.min.js') }}
	{{ HTML::script('js/respond.min.js') }}
</head>
<body>
	<div class="baraSus">
		<div class="container" id="navbarContainer">
			<a class="brand pull-right" id="stema" href="http://www.gov.ro">{{ HTML::image('img/stema.png') }}</a>
			<h5 class="pull-right" id="titluStema">SITE OFICIAL AL GUVERNULUI ROMÂNIEI</h5>

		</div>
	</div>

	<div class="hero-unit" id="baraVerde">
		<div class="container">
			<h3 id="logo">BUGET.GOV.RO</h3>
		</div>
	</div>
	<div class="container mainDiv">
		<div class="navbar">
			<div class="navbar-inner">
				<div class="container">
					<a class="btn btn-navbar collapsed" data-toggle="collapse" data-target=".nav-collapse">
						<span class="icon-bar"></span>
						<span class="icon-bar"></span>
						<span class="icon-bar"></span>
					</a>
					<ul class="container nav" style="margin:0px">
						<li><a href="{{ URL::to('home') }}"><i class="icon-home icon-white"></i></a></li>
					</ul>
					<div class="nav-collapse collapse" style="height: 0px;">
						<ul class="nav pull-left">
							<li class="pull-left"><a href="{{ URL::to('institutii') }}">AFIŞAREA PE INSTITUŢII</a></li>
							<li class="pull-left"><a href="{{ URL::to('functional') }}">AFIŞAREA FUNCŢIONALĂ</a></li>
							<li class="pull-left" ><a href="{{ URL::to('home/resurse') }}" >RESURSE</a></li>

						</ul>
						<ul class="nav pull-right">
							<li class="pull-right"><a href="{{ URL::to('despre') }}">DESPRE</a></li>
							<li class="pull-right"><a href="{{ URL::to('help') }}">HELP</a></li>

							<li class="pull-right"><a href="{{ URL::to('contact') }}">CONTACT</a></li>
						</ul>
					</div>
				</div>
			</div>
		</div>
		<div id="banner" class="visible-desktop">
			<div class="row-fluid" style="min-height:180px">
				<div class="span8" id="bannerText" >
					<h1>Bugetul național pe înțelesul tuturor</h1>
					<p id="bannerTextP">
						„Transparența și deschiderea spre partenerii sociali şi consultarea societăţii civile reprezintă constante ale actului de guvernare. Ele vor asigura o bază solidă de susţinere a iniţiativelor şi măsurilor Guvernului, întărind angajamentul acestuia pentru respectarea principiilor bunei guvernări: transparenţă, responsabilitate, participare cetăţenească”.
					</p>
					<a href="http://www.guv.ro/programul-de-guvernare-2012__l1a117011.html" style="color:#679a01;font" class="pull-right">Citește întreg Programul de Guvernare 2013-2016 »</a>
				</div>
				<div class="span4 pull-right" style="">{{HTML::image('img/govlogo.jpg', '')}}</div>
			</div>
		</div>
		<div id="loader" style="position:absolute;right:25px;top:90px;display:none;width:25px;" >{{ HTML::image("img/loader.gif") }}</div>
		<div id="content">
			@yield('content')
		</div>
	</div>
	<div class="container" style="margin-top:30px" id="footer">
		<div class="row-fluid">
			<div class="span8">{{ HTML::image("img/logoSiTextGuv.png") }}</div>
			<div class="span4">
				<p class="logohack">{{ HTML::image("img/logohack.png") }}</p>
				<p>Proiect realizat la prima ediție a Hackathonului organizat de către Guvernul României</p>
				<p><a href="{{ URL::to('echipa') }}">Vezi echipa de proiect &rarr;</a></p>
			</div>
		</div>
	</div>

</body>
</html>

