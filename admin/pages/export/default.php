<?php 
require_once('template/_header.php'); 
?>
<h1>Export</h1>
	
	<form action="" method="get">
		<table cellpadding="0" cellspacing="0" border="0" class="tbl_insert">
			
			<tr>
				<th>&nbsp;</th><td>
				<label for= for="btn" class="sbm sbm_orange fl_l">
				<a href="?page=export&action=json" class=" forb" ><button style="width:80px;height:20px" class="btn" type="button">JSON</button></a>
				</label>
				</td>
			</tr>
			
			<tr>
				<th>&nbsp;</th><td>
				<label for= for="btn" class="sbm sbm_blue fl_l">
				<a href="?page=export&action=xml" class="forb" ><button style="width:80px;height:20px" class="btn" type="button">XML</button></a>
				</label>
				</td>
			</tr>
			<tr>
				<th>&nbsp;</th><td>
				<label for= for="btn" class="sbm sbm_green fl_l">
				<a href="?page=export&action=csv" class="forb" ><button style="width:80px;height:20px" class="btn" type="button">CSV</button></a>
				</label>
				</td>
			</tr>
			<tr>
				<th>&nbsp;</th><td>
				<label for= for="btn" class="sbm sbm_black fl_l">
				<a href="?page=export&action=html" class="forb" ><button style="width:80px;height:20px" class="btn" type="button">HTML</button></a>
				</label>
				</td>
			</tr>
			<tr>
				<th>&nbsp;</th><td>
				<label for= for="btn" class="sbm sbm_red fl_l">
				<a href="?page=export&action=pdf" class="forb" ><button style="width:80px;height:20px" class="btn" type="button">PDF</button></a>
				</label>
				</td>
			</tr>
			
			
		</table>
	</form>

<?php require_once('template/_footer.php');  ?>