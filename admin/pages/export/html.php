<?php 
$objExport = new export();
$html = $objExport->e_html();

		
	require_once('template/_header.php'); 
	echo "<h1>Exportat cu succes.</h1>";
	require_once('template/_footer.php'); 
?>
