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
      body {
        padding-top: 60px; /* 60px to make the container go all the way to the bottom of the topbar */
      }
    </style>
		<link rel="stylesheet" href="css/bootstrap-responsive.min.css">
	</head>
	<body>
		
    <div class="navbar navbar-inverse navbar-fixed-top">
	    <div class="navbar-inner">
    		<div class="container">
          		<button type="button" class="btn btn-navbar" data-toggle="collapse" data-target=".nav-collapse">
            		<span class="icon-bar"></span>
            		<span class="icon-bar"></span>
            		<span class="icon-bar"></span>
          		</button>
          		<a class="brand" href="#">Bugetul Romaniei</a>
          		<div class="nav-collapse collapse">
            	<ul class="nav">
              		<li class="active"><a href="#">Petitii</a></li>
              		<li><a href="#about">Angajati</a></li>
              		<li><a href="#contact">Posturi</a></li>
            	</ul>
          	</div><!--/.nav-collapse -->
        </div>
      	</div>
    </div>
  <div class="row-fluid">
    <div class="span4" style="text-align:center">
      <button id="goBack" class="btn btn-large" onclick="goBack()" style="margin-top:10px">Mergi cu un nivel mai sus</button>
    </div>
    <div class="span8" style="text-align:center">
      <h1 id="currentPosition">Esti in</h1>
    </div>
  </div>
  <div id="chartdiv" style="width: 100%; height: 600px;"></div> 
  
	<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>
	<script src="js/amcharts.js"></script>
	 <script src="js/charts.js"></script>
	  <script src="js/getData.js"></script>
	  <script src="js/bootstrap.min.js"></script>
	<script>window.jQuery || document.write('<script src="js/jquery.min.js"><\/script>')</script>
	</body>
</html>
