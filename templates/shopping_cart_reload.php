<?php
if ( ! defined( 'ABSPATH' ) )
{
	exit();
}
header('Content-Type: application/json');


include ( "shopping_cart_add_content.php" );
$ajax_result = array( "box_shopping_cart" => $box_shopping_cart,
		"box_shopping_cart_lite" => $box_shopping_cart_lite );


echo (json_encode($ajax_result));
?>