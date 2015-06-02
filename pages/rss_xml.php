<?php 
$objExport = new export();


	require_once('template/_header.php'); 


	
$rss = $objExport->rss_xml();
	?> <h1>RSS</h1>
	




	<?php		
	echo $rss;
		
	require_once('template/_footer.php');?>	
	

