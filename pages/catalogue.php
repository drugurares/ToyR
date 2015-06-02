<?php
$cat = Url::getParam('category');
$ageP = Url::getParam('age');
$genderP = Url::getParam('gender');
$materialP = Url::getParam('material');
$orderBy = Url::getParam('orderBy');
$asc_desc = Url::getParam('asc_desc');
if(empty($cat)) {
	require_once("error.php");
} else {

	$objCatalogue = new Catalogue();
	$category = $objCatalogue->getCategory($cat);
	
	if(empty($category)) {
		require_once("error.php");
	} else {
	
		$rows = $objCatalogue->getProducts($cat,$ageP,$genderP,$materialP,$orderBy,$asc_desc);
		
		
		$objPaging = new Paging($rows, 5);
		$rows = $objPaging->getRecords();
		
		require_once("_header.php");


	
	
?>
<?php $db1=new Dbase();?>
<h1>Catalog :: <?php echo $category['name']; ?></h1>
<form action="" method="get" enctype="multipart/form-data">
			 <input type="hidden" name="page" value="catalogue" /> 
			 <input type="hidden" name="category" value="<?php echo $category['id'];?>" /> 
					<h1>Filtreaza rezultatele: 
					<select name="age" id="age" style="border:1px solid #278700; width:100px; padding:3px; background-color: #00A552; color: #fff; margin-top: 2px;margin-bottom: 1px;margin-left: 1px;margin-right: 1px;">
							<option style="color: #fff; "value="">Varsta</option>
							<?php $ages=$db1->fetchAll("SELECT distinct(age) as ages FROM `products` where `category`=".$category['id']);
							foreach($ages as $key) { ?>
							<option style="color: #fff; "value="<?php echo $key['ages']; ?>"><?php echo $key['ages']; ?>
							</option>
							<?php } ?>
					</select>
					<select name="gender" id="gender" style="border:1px solid #278700; width:100px; padding:3px; background-color: #00A552; color: #fff; margin-top: 2px;margin-bottom: 1px;margin-left: 1px;margin-right: 1px;">
							<option style="color: #fff; "value="">Gen</option>
							<?php $genders=$db1->fetchAll("SELECT distinct(gender) as genders FROM `products` where `category`=".$category['id']);
							foreach($genders as $key) { ?>
							<option style="color: #fff; "value="<?php echo $key['genders']; ?>"><?php echo $key['genders']; ?>
							</option>
							<?php } ?>
					</select>
					<select name="material" id="material" style="border:1px solid #278700; width:100px; padding:3px; background-color: #00A552; color: #fff; margin-top: 2px;margin-bottom: 1px;margin-left: 1px;margin-right: 1px;">
							<option style="color: #fff; "value="">Material</option>
							<?php $materials=$db1->fetchAll("SELECT distinct(material) as materials FROM `products` where `category`=".$category['id']);
							foreach($materials as $key) { ?>
							<option style="color: #fff; "value="<?php echo $key['materials']; ?>"><?php echo $key['materials']; ?>
							</option>
							<?php } ?>
					</select>
					<br>Ordoneaza dupa:
					<select name="orderBy" id="orderBy" style="border:1px solid #278700; width:100px; padding:3px; background-color: #00A552; color: #fff; margin-top: 2px;margin-bottom: 1px;margin-left: 1px;margin-right: 1px;">
							<option value="name" style="color: #fff; ">Nume</option>
							<option value="price" style="color: #fff; ">Pret</option>
							<option value="date" style="color: #fff; ">Data Aparitiei</option>
							<option value="gender"style="color: #fff; ">Gen</option>
							<option value="age"style="color: #fff; ">Varsta</option>
							<option value="material"style="color: #fff; ">Material</option>
					</select>
					<select name="asc_desc" id="asc_desc" style="border:1px solid #278700; width:100px; padding:3px; background-color: #00A552; color: #fff; margin-top: 2px;margin-bottom: 1px;margin-left: 1px;margin-right: 1px;">
							<option style="color: #fff; "value="ASC">Ascendent</option>
							<option style="color: #fff; " value="DESC">Descendent</option>
					</select>
						<input type="submit" id="btn" style="border:1px solid #278700; width:100px; padding:3px; background-color: #00A552; color: #fff;margin-top: 2px;margin-bottom: 1px;margin-left: 1px;margin-right: 1px;height: 25px;" value="Aplica" />
					
					</h1>


</form>	
<?php

		if(!empty($rows)) {
			foreach($rows as $row) {
?>

<div class="catalogue_wrapper">
	<div class="catalogue_wrapper_left">
		<?php
		
			$image = !empty($row['image']) ? 
			$objCatalogue->_path.$row['image'] :
			$objCatalogue->_path.'unavailable.png';
			
			$width = Helper::getImgSize($image, 0);
			$width = $width > 120 ? 120 : $width;
			?>
		<a href="/?page=catalogue-item&amp;category=<?php echo $category['id']; ?>&amp;id=<?php echo $row['id']; ?>"><img src="<?php echo $image; ?>" alt="<?php echo Helper::encodeHtml($row['name'], 1); ?>" width="<?php echo $width; ?>" /></a>
	</div>
	<div class="catalogue_wrapper_right">
		<h4><a href="/?page=catalogue-item&amp;category=<?php echo $category['id']; ?>&amp;id=<?php echo $row['id']; ?>"><?php echo Helper::encodeHtml($row['name'], 1); ?></a></h4>
		<h4>Pret: <?php echo number_format($row['price'], 2)." "; echo Catalogue::$_currency; ?></h4>
		<p><?php echo Helper::shortenString(Helper::encodeHtml($row['description'])); ?></p>
		<p><?php echo Basket::activeButton($row['id']); ?></p>
	</div>
</div>


<?php
			}
			
			echo $objPaging->getPaging();
			
		} else {
?>
<p>Nu sunt produse in categorie.</p>
<?php		
		}
		require_once("_footer.php");
	
	}
}
?>