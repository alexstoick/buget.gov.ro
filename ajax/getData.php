<?php

require_once('../model/RestServiceClient.php');
require_once('../model/IntrareBuget.php');

$propNames = array('IdInstitutie','IdParinte','Sectiune',
	'NumeInstitutie','An','DenumireIndicator','Suma');
$propNamesURL= strtolower(implode($propNames,','));

$res = array();
$res['results'] = array();
$sumaSectiune = 0;
$numeSectiune = '';

if(
	( empty($_GET['institutie']) && empty($_GET['sectiune']) ) ||
	( !empty($_GET['suma']) && empty($_GET['sectiune']) )
){
	$res['status'] = -1;
	$res['error'] = 'Invalid parameters. Valid request is: { institutie=1[,2,...][&copii=1] | sectiune=5001[&suma] }';
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

	if( empty($_GET['suma']) && (
			!empty($_GET['institutie']) &&
			(
				// total institutie
				(
					(in_array($intrare['IdInstitutie'], explode(",",$_GET['institutie']))) &&
					(empty($_GET['copii']) && $intrare['IdParinte'] == '0') 
				) ||
				// copii insitutie
				(
					(in_array($intrare['IdParinte'], explode(",",$_GET['institutie']))) &&
					(!empty($_GET['copii']) && $intrare['IdParinte'] != '0' && $intrare['Sectiune'] == '5001')
				)
			)
			||
			!empty($_GET['sectiune']) &&
			(
				// sectiune
				(
					$intrare['Sectiune'] == $_GET['sectiune'] &&
					substr($intrare['DenumireIndicator'],0,6) != 'TITLUL'
				)
			)
		)
	){
		$res['results'][] = $intrare;	
	}else{
		if(
			$intrare['Sectiune'] == $_GET['sectiune'] &&
			substr($intrare['DenumireIndicator'],0,6) != 'TITLUL'
		){
			$sumaSectiune += $intrare['Suma'];
			if(substr($intrare['DenumireIndicator'],0,6) != 'TITLUL'){
				$numeSectiune = $intrare['DenumireIndicator'];
			}
		}
	}
}

if(!empty($_GET['suma'])){
	$res['suma'] = $sumaSectiune;
	$res['numeSectiune'] = $numeSectiune;
}

echo json_encode($res);
