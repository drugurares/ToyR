<?php 
$objExport = new export();
$xml = $objExport->e_xml();

		
	require_once('template/_header.php'); 
	echo "<h1>Exportat cu succes.</h1>";
	require_once('template/_footer.php'); 
?>
