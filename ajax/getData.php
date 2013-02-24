<?php

require_once('../model/RestServiceClient.php');
require_once('../model/IntrareBuget.php');

$propNames = array('id','idParinte','numeInstitutie',
	'denumireIndicator','tipIntrare','suma');
$propNamesURL= strtolower(implode($propNames,','));

$res = array();
$res['results'] = array();

if(empty($_GET['institutie'])){
	$res['status'] = -1;
	$res['error'] = 'Invalid parameters. Valid request is: institutie=MAE[,MAI,...][&copii=1]';
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
			(in_array($intrare['id'], explode(",",$_GET['institutie']))) &&
			(empty($_GET['copii']) && $intrare['idParinte'] == '0') 
		) ||
		(
			(in_array($intrare['idParinte'], explode(",",$_GET['institutie']))) &&
			(!empty($_GET['copii']) && $intrare['idParinte'] != '0')
		)
	){
		$res['results'][] = $intrare;	
	}
}

echo json_encode($res);
