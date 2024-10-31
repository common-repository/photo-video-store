<?php
if ( ! defined( 'ABSPATH' ) )
{
	exit();
}

if ( pvs_check_vat($_REQUEST["vat"], 0)) {
	echo(1);
} else {
	echo(0);
}
?>