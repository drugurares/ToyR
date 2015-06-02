<?php
Login::restrictFront();


$objBasket = new Basket();

$out = array();

$session = Session::getSession('basket');

if (!empty($session)) {
	$objCatalogue = new Catalogue();
	foreach($session as $key => $value) {
		$out[$key] = $objCatalogue->getProduct($key);
	}
}

require_once("_header.php");
?>

<h1>Sumar comanda.</h1>

<?php if (!empty($out)) { ?>

<div id="big_basket">
	<form action="" method="post" id="frm_basket">
		
		<table cellpadding="0" cellspacing="0" border="0" class="tbl_repeat">
		
			<tr>
				<th>Produs</th>
				<th class="ta_r">Qty</th>
				<th class="ta_r col_15">Pret</th>
			</tr>
			
			<?php foreach($out as $item) { ?>
			
				<tr>
					<td><?php echo $item['name']; ?></td>
					<td class="ta_r"><?php echo $session[$item['id']]['qty']; ?></td>
				<td class="ta_r"><?php echo number_format($objBasket->itemTotal($item['price'], $session[$item['id']]['qty']), 2); ?> Lei</td> 
				</tr>				
			<?php } ?>
			
			<?php if ($objBasket->_vat_rate > 0) { ?>
			
			<tr>
				<td colspan="2" class="br_td">
					Sub-total:
				</td>
				<td class="ta_r br_td">
					<?php echo number_format($objBasket->_sub_total, 2); ?> Lei
				</td>
			</tr>
			
			<tr>
				<td colspan="2" class="br_td">
					TVA (<?php echo $objBasket->_vat_rate; ?>%)
				</td>
				<td class="ta_r br_td">
					<?php echo number_format($objBasket->_vat, 2); ?> Lei
				</td>
			</tr>
			
			<?php } ?>
			
			<tr>
				<td colspan="2" class="br_td">
					<strong>Total:</strong>
				</td>
				<td class="ta_r br_td">
					<strong><?php echo number_format($objBasket->_total, 2); ?> Lei</strong>
				</td>
			</tr>
			
		</table>
		
		<div class="dev br_td">&#160;</div>
		
		<div class="sbm sbm_blue fl_r paypal" 
			>
			<a href="/?page=order_confirm" class="btn">Comanda</a>
		</div>
		
		<div class="sbm sbm_blue fl_l">
			<a href="/?page=basket" class="btn">Anuleaza comanda.</a>
		</div>
		
	</form>
	
	


<?php } else { ?>

	<p>Cosul tau este momentan gol.</p>

<?php } ?>


<?php
require_once("_footer.php");

?>