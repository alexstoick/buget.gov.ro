<?php

require_once('../model/RestServiceClient.php');
require_once('../model/IntrareBuget.php');

$propNames = array('id','idParinte','an','numeInstitutie',
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


	foreach($propNames as $pn){
		$xmlPn = strtolower($pn);	
		$intrare->$pn = (string)$ns_d->{$xmlPn};
	}

	$suffixedInstitutions = explode(",",$_GET['institutie']);
	foreach($suffixedInstitutions as &$elem){ $elem .= "-"; }
	if(
		(in_array(substr($intrare->id, 0, strpos($intrare->id,'-')+1), $suffixedInstitutions)) &&
		(
			(empty($_GET['copii']) && $intrare->idParinte == '0') ||
			(!empty($_GET['copii']) && $intrare->idParinte != '0')
		)
	){
		$res['results'][] = $intrare;	
	}
}

echo json_encode($res);