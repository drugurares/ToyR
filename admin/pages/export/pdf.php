<?php 
$objExport = new export();
$pdf = $objExport->e_pdf();

		
	require_once('template/_header.php'); 
	echo "<h1>Nu este posibil fara librarii/api-ui!</h1>";
	require_once('template/_footer.php'); 
?>
