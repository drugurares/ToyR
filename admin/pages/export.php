<?php
Login::restrictAdmin();

$action = Url::getParam('action');

switch($action) {
	
	case 'json':
	require_once('export/json.php');
	break;
	
	case 'xml':
	require_once('export/xml.php');
	break;

	case 'csv':
	require_once('export/csv.php');
	break;

	case 'html':
	require_once('export/html.php');
	break;
	
	case 'pdf':
	require_once('export/pdf.php');
	break;
	
	default:
	require_once('export/default.php');

}







