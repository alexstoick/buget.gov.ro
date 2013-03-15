<?php

define('PATH_ROOT',getcwd().'/');

$g_page = empty($_GET['page']) ? '' : str_replace('/','',strtolower($_GET['page']));
$g_subpage = empty($_GET['subpage']) ? '' : str_replace('/','',strtolower($_GET['subpage']));
if (empty($g_page)) {
	$g_page = "acasa";
}else if(!file_exists(PATH_ROOT.'pages/'.$g_page.'.php')) {
	$g_page = "not-found";
	header("HTTP/1.0 404 Not Found");
}

function actv($str){
	global $g_page;
	if($g_page==$str)
		return 'active';
	else
		return '';
}
function resurse($str){
	global $g_page;
	if($g_page!='fct' && $g_page!='inst')
		return 'none';
	else
		return 'true';
}
?>
<!DOCTYPE html>
<!--[if lt IE 7 ]><html class="ie6" lang="ro"><![rodif]-->
<!--[if IE 7 ]><html class="ie7" lang="ro"><![rodif]-->
<!--[if IE 8 ]><html class="ie8" lang="ro"><![rodif]-->
<!--[if (gte IE 9)|!(IE)]><!--><html lang="ro"><!--<![rodif]-->
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta name="description" content="">
	<meta name="author" content="">

	<title>buget.gov.ro – <?php echo str_replace("-"," ",ucwords($g_page)); ?></title>
	
	<link rel="stylesheet" href="css/bootstrap.min.css">
	<script src="//ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>
	<script src="js/bootstrap.min.js"></script>

</style>
<link rel="stylesheet" href="css/style.css">
<link rel="stylesheet" href="css/bootstrap-responsive.min.css">

</head>
<body style="background-color:#f0efef">
	<div class="baraSus">
		<div class="container " id="navbarContainer">
			<a class="brand pull-right hidden-phone"  href="#" style="color:white;float:right;font-size:1em"><h5>Site oficial al Guvernului Romaniei</a>>
			<a class="brand pull-right"  id="logo"href="#"   style="color:white;float:right"><img src="img/stema.png"></a>
		</div>
	</div>

	<div class="hero-unit" id="baraVerde" >
		<div class="container">
			<h3 style="color:white;margin-top:0%">BUGET.GOV.RO</h3>

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
							<li class="pull-left"><a href="acasa" style="color:white"  ><i class="icon-home"></i></a></li>
							<li class="pull-left"><a href="inst" style="color:white"  >Afisarea pe instituii</a></li>
							<li class="pull-left"><a href="fct" style="color:white"  >Afisarea functionala</a></li>
							<li class="pull-left" ><a href="resurse" style="color:white"  >Resurse</a></li>
							<li class="pull-right"> <a style="color:white" id="currentPosition"></a></li>
							<li><button id="goBack" class="btn" onclick="goBack()" style="margin-top:4px;display:<?php echo resurse('resurse'); ?>">Mergi cu un nivel mai sus</button></li>
						</ul>
					</div><!--/.nav-collapse -->
				</div>
			</div>
		</div>
		<div id="loader" style="position:absolute;right:25px;top:90px;display:<?php echo resurse('resurse'); ?>" ><img src="img/loader.gif" width="50"></div>
		<div style="padding:10px">
			<?php if(!@include(PATH_ROOT.'pages/'.$g_page.'.php')){
				include(PATH_ROOT.'pages/not_found.php');
			}
			?>
		</div>
	</div>
	<div class="container" style="margin-top:30px">
		<div class="row-fluid">
			<div class="span2"><img src="img/logoguv.png"></div>
			<div class="span7">
				<h5>Cancelaria Primului-Ministru</h5>
				<h5>Departamentul pentru Servicii Online si Design</h5>
			</div>
			<div class="span3">
				<img src="img/logohack.png">
				<h5>Proiect realizat la prima editie a Hackathonului organizat de catre Guvernul Romaniei</h5>
			</div>
		</div>
	</div>
</body>
</html>
