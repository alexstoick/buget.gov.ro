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
<!doctype html>
<!--[if lt IE 7 ]><html class="ie6" lang="ro"><![rodif]-->
<!--[if IE 7 ]><html class="ie7" lang="ro"><![rodif]-->
<!--[if IE 8 ]><html class="ie8" lang="ro"><![rodif]-->
<!--[if (gte IE 9)|!(IE)]><!--><html lang="ro"><!--<![rodif]-->
	<head>
		<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">

		<title>buget.gov.ro – <?php echo str_replace("-"," ",ucwords($g_page)); ?></title>

		<link rel="stylesheet" href="css/bootstrap.min.css">
		<link rel="stylesheet" href="css/style.css">
		<!--[if IE]>
		<meta http-equiv="imagetoolbar" content="no" />
		<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
		<![endif]-->
	</head>
	<body>
		<div id="everything" class="container">
			<div id="header">
				<h1>buget.gov.ro</h1>
			</div>
			<div id="content">
				<?php if(!@include(PATH_ROOT."pages/".$g_page.".php")){ include(PATH_ROOT."pages/not-found.php"); } ?>
			</div>
			<div id="footer">
				&copy; buget.gov.ro 2013–∞
			</div>
		</div>
		<script src="ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>
		<script>window.jQuery || document.write('<script src="js/jquery.min.js"><\/script>')</script>
	</body>
</html>
