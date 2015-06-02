<?php 
Login::restrictFront();
$ord=new Order();
$ord->createOrder();

Session::clear();


require_once('_header.php'); ?>

<p>
Comnanda procesata cu sccces!</p>


<?php 
require_once('_footer.php'); ?>