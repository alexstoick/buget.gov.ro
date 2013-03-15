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
	<style>
		/*body {
		padding-top: 60px;  60px to make the container go all the way to the bottom of the topbar
		}*/
		</style>
		<link rel="stylesheet" href="css/bootstrap-responsive.min.css">
		<link rel="stylesheet" href="css/style.css">
	</head>
	<body>
		<div class="navbar navbar-fixed-top">
			<div class="navbar-inner">
				<div class="container " id="navbarContainer">
					<a class="brand pull-right hidden-phone"  href="#" style="color:white;float:right">Site oficial al Guvernului Romaniei</a>
					<a class="brand pull-right"  id="logo"href="#"   style="color:white;float:right"><img src="img/stema.png"></a>
				</div>
			</div>
		</div>
		<div class="hero-unit" id="baraVerde">
			<div class="container">
			<h3 style="color:white;margin-top:0%">BUGET.GOV.RO</h3>
			
		</div>
		</div>
		<div class="container mainDiv" >
			<div id="loader" style="position:absolute;right:25px;top:90px;display:<?php echo resurse('resurse'); ?>" ><img src="img/loader.gif" width="50"></div>
			<ul class="nav nav-tabs" style="background-color:#e7e7e7">
				<li class="pull-right"> <a id="currentPosition"></a></li>
				<li class="pull-left <?php echo actv('acasa'); ?>"><a href="acasa"><i class="icon-home"></i></a></li>
				<li class="pull-left <?php echo actv('inst'); ?>"><a href="inst">Afisarea pe instituii</a></li>
				<li class="pull-left <?php echo actv('fct'); ?>"><a href="fct">Afisarea functionala</a></li>
				<li class="pull-left <?php echo actv('resurse'); ?>" ><a href="resurse">Resurse</a></li>
				<li><button id="goBack" class="btn" onclick="goBack()" style="margin-top:4px;display:<?php echo resurse('resurse'); ?>">Mergi cu un nivel mai sus</button></li>

			</ul>

			<?php if(!@include(PATH_ROOT.'pages/'.$g_page.'.php')){
				include(PATH_ROOT.'pages/not_found.php');
			}
			?>
		</div>
	</body>
	</html>
