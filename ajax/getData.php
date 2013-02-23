<?php

require_once('../model/RestServiceClient.php');
require_once('../model/IntrareBuget.php');

$res = array();
$res['results'] = array();

if(empty($_GET['minister']) || empty($_GET['copii'])){
	$res['status'] = -1;
	$res['error'] = 'Invalid parameters.';
	echo json_encode($res);
	die();
}

$rws = new RestServiceClient('http://rogovdata.cloudapp.net:8080/v1/RoGovOpenData/buget');
$rws->query = '';
$rws->results = '';
$rws->appid = '';
$rws->excuteRequest();
$xml = $rws->getResponse();

$data = new SimpleXMLElement($xml);

foreach($data->entry as $entry){
	$content = $entry->content;
	$ns_m = $content->children('http://schemas.microsoft.com/ado/2007/08/dataservices/metadata');
	$props = $ns_m->properties;
	$ns_d = $props->children('http://schemas.microsoft.com/ado/2007/08/dataservices');

	$intrare = new IntrareBuget();

	$propNames = array('id','idParinte','an','numeInstitutie',
		'denumireIndicator','tipIntrare','suma');
	foreach($propNames as $pn){
		$xmlPn = strtolower($pn);	
		$intrare->$pn = (string)$ns_d->{$xmlPn};
	}

	if(
		(substr($intrare->id, 0, strlen($_GET['minister'])+1) == $_GET['minister'].'-') &&
		(
			($_GET['copii'] == 'false' && $intrare->idParinte == 0) ||
			($_GET['copii'] == 'true' && $intrare->idParinte != 0)
		)
	){
		$res['results'][] = $intrare;	
	}
}

echo json_encode($res);
