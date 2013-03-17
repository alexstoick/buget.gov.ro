<?php

require_once('../model/RestServiceClient.php');
require_once('../model/IntrareBuget.php');

$propNames = array('IdInstitutie','IdParinte','Sectiune',
	'NumeInstitutie','An','DenumireIndicator','Suma');
$propNamesURL= strtolower(implode($propNames,','));

if(isset($_GET['manduc'])){
	echo 'MANDUC &hearts;';
	die();
}

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

$rws = new RestServiceClient('http://rogovdata.cloudapp.net:8080/v1/RoGovOpenData/Buget/');
$filter = '';

if(!empty($_GET['institutie'])){
	if(empty($_GET['copii'])){
		$filter = '(idparinte eq 0) and ';
	}else{
		$filter = '(idparinte ne 0) and ';
	}
	$filter.='(';
	foreach(explode(",",$_GET['institutie']) as $inst){
		$filter.='(idinstitutie eq '.$inst.') or ';
	}
	$filter=substr($filter,0,strlen($filter)-4);
	$filter.=')';
}
if(!empty($_GET['sectiune'])){
	$filter = 'sectiune eq '.$_GET['sectiune'];
}

$filter='&$filter='.rawurlencode($filter);

$rws->query = '$select='.$propNamesURL.$filter;
$rws->format = 'json';
$rws->excuteRequest();
$json = $rws->getResponse();
$data = json_decode($json);
$suma = 0;

foreach($data->d as $entry){
	$intrare = array();

	foreach($propNames as $pn){
		$apiPn = strtolower($pn);
		$intrare[$pn] = (string)$entry->$apiPn;
	}

	if(!empty($_GET['suma'])){
		$suma += $intrare['Suma'];
		$numeSectiune = $intrare['DenumireIndicator'];
	}
	
	if(
		empty($_GET['copii']) ||
		(!empty($_GET['copii']) && substr($intrare['DenumireIndicator'],0,6)=='Titlul') && substr($intrare['Sectiune'],0,4)=='5001'
	){
		$res['results'][] = $intrare;
	}
}

if(!empty($_GET['suma'])){
	$res['suma'] = $suma;
	$res['numeSectiune'] = $numeSectiune;
}

echo json_encode($res);
