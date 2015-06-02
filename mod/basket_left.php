<?php $objBasket = new Basket(); ?>
<h2>Cosul tau</h2>
<dl id="basket_left">
	<dt>Nr. produse:</dt>
	<dd class="bl_ti"><span><?php echo $objBasket->_number_of_items; ?></span></dd>
	<dt>Sub-total:</dt>
	<dd class="bl_st"><span><?php echo number_format($objBasket->_sub_total, 2); ?></span> Lei</dd>
	<dt>TVA (<span><?php echo $objBasket->_vat_rate; ?></span>%):</dt>
	<dd class="bl_vat"><span><?php echo number_format($objBasket->_vat, 2); ?></span> Lei</dd>
	<dt>Total :</dt>
	<dd class="bl_total"><span><?php echo number_format($objBasket->_total, 2); ?></span> Lei</dd>
</dl>
<div class="dev br_td">&#160;</div>
<p><a href="/?page=basket">Vezi cosul tau</a> | <a href="/?page=checkout">Checkout</a></p>
<div class="dev br_td">&#160;</div>