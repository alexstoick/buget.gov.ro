<?php

require_once('../model/RestServiceClient.php');
require_once('../model/IntrareBuget.php');

$propNames = array('IdInstitutie','IdParinte','Sectiune',
	'NumeInstitutie','An','DenumireIndicator','Suma');
$propNamesURL= strtolower(implode($propNames,','));

$res = array();
$res['results'] = array();

if(empty($_GET['institutie'])){
	$res['status'] = -1;
	$res['error'] = 'Invalid parameters. Valid request is: institutie=1[,2,...][&copii=1]';
	echo json_encode($res);
	die();
}

$rws = new RestServiceClient('http://rogovdata.cloudapp.net:8080/v1/RoGovOpenData/buget');
$rws->query = '$select='.$propNamesURL;
$rws->format = 'json';
$rws->excuteRequest();
$json = $rws->getResponse();
$data = json_decode($json);

foreach($data->d as $entry){
	$intrare = array();
	
	foreach($propNames as $pn){
		$apiPn = strtolower($pn);
		$intrare[$pn] = (string)$entry->$apiPn;
	}

	if(
		(
			(in_array($intrare['IdInstitutie'], explode(",",$_GET['institutie']))) &&
			(empty($_GET['copii']) && $intrare['IdParinte'] == '0') 
		) ||
		(
			(in_array($intrare['IdParinte'], explode(",",$_GET['institutie']))) &&
			(!empty($_GET['copii']) && $intrare['IdParinte'] != '0')
		)
	){
		$res['results'][] = $intrare;	
	}
}

echo json_encode($res);
