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

          		<a class="brand pull-right"  href="#" style="color:white;float:right">Site oficial al Guvernului Romaniei</a>
          		<a class="brand pull-right"  id="logo"href="#"   style="color:white;float:right"><img src="img/stema.png"></a>

        </div>
      	</div>
    </div>
    <div style="background-color:#0093e0;height:200px;width:100%">
    	<h3 style="padding-top:100px;color:white;padding-left:10%">buget.gov.ro</h3>
    	<h5 style="padding-left:10%;color:white">este un proiect de transparenta care indexeaza informatii prinvind bugetul de stat al Romaniei</h5>
    </div>
    <ul class="nav nav-tabs">
        <li class="active pull-right"><a href="#">Afisarea pe instituii</a></li>
        <li class="pull-right"><a href="#">Afisarea functionala</a></li>
        <li><button id="goBack" class="btn" onclick="goBack()" style="margin-top:4px">Mergi cu un nivel mai sus</button></li>
        <li class="pull-right"> <a id="currentPosition"></a></li>
	</ul>

  	<div id="chartdiv" style="width:100%; height: 700px;"></div> 
  	<table class="table table-bordered">
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
	<script src="js/amcharts.js"></script>
	<script src="js/charts.js"></script>
	<script src="js/getData.js"></script>
	<script src="js/bootstrap.min.js"></script>
	<script>window.jQuery || document.write('<script src="js/jquery.min.js"><\/script>')</script>
	</body>
</html>
