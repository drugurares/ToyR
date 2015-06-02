<?php
$objCatalogue = new Catalogue();
$cats = $objCatalogue->getCategories();

$objBusiness = new Business();
$business = $objBusiness->getBusiness();
?>
<!DOCTYPE html>
<html>
<head>

<title>Toyr</title>

<?php if($_GET['category']==1) echo"<link href=\"/css/figurine.css\" rel=\"stylesheet\" type=\"text/css\" />";
else
	if($_GET['category']==2) echo"<link href=\"/css/puzzle.css\" rel=\"stylesheet\" type=\"text/css\" />";
else
	if($_GET['category']==3) echo"<link href=\"/css/creative.css\" rel=\"stylesheet\" type=\"text/css\" />";
else
	if($_GET['category']==4) echo"<link href=\"/css/exterior.css\" rel=\"stylesheet\" type=\"text/css\" />";
else
	if($_GET['category']==5) echo"<link href=\"/css/electronice.css\" rel=\"stylesheet\" type=\"text/css\" />";
else
	if($_GET['category']==6) echo"<link href=\"/css/lego.css\" rel=\"stylesheet\" type=\"text/css\" />";
else
	if($_GET['category']==7) echo"<link href=\"/css/masini.css\" rel=\"stylesheet\" type=\"text/css\" />";
else
	if($_GET['category']==8) echo"<link href=\"/css/papusi.css\" rel=\"stylesheet\" type=\"text/css\" />";
else
	if($_GET['category']==9) echo"<link href=\"/css/plusuri.css\" rel=\"stylesheet\" type=\"text/css\" />";
else
	if($_GET['category']==10) echo"<link href=\"/css/promotii.css\" rel=\"stylesheet\" type=\"text/css\" />";
else

echo "<link href=\"/css/core.css\" rel=\"stylesheet\" type=\"text/css\" />";

?>
</head>
<body>
<div id="header">
	<div id="header_in">
		<h5><a href="/"><?php echo $business['name']; ?></a></h5>
		<?php
			if (Login::isLogged(Login::$_login_front)) {
				echo '<div id="logged_as">Conectat ca: <strong>';
				echo Login::getFullNameFront(Session::getSession(Login::$_login_front));
				echo '</strong> | <a href="/?page=orders">Comenzile mele</a>';
				echo ' | <a href="/?page=logout">Delogare</a></div>';				
			} else {
				echo '<div id="logged_as"><a href="/?page=login">Login</a></div>';
			}
		?>
	</div>

</div>

<div id="outer">
	<div id="wrapper">
		<div id="left">
			<?php require_once('basket_left.php'); ?>
			<?php if (!empty($cats)) { ?>
			<h2>Categorii</h2>
			<ul id="navigation">
				<?php 
					foreach($cats as $cat) {
						if($cat['id']!=-1){
						echo "<li><a href=\"/?page=catalogue&amp;category=".$cat['id']."\"";
						echo Helper::getActive(array('category' => $cat['id']));
						echo ">";
						echo Helper::encodeHtml($cat['name']);
						echo "</a></li>";
					}}
				?>
				</ul>
			

			<?php } ?>					
		</div>
<form id="promo" action="">
<a href="?page=catalogue&category=10" class=" forb" ><img src="images/promo.png" style="width:200px;height:200px;padding:20px;" /></a>
	</form>

		<div id="right">
	