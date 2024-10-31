<?php
if ( ! defined( 'ABSPATH' ) )
{
	exit;
}
?>

<h1><?php echo pvs_word_lang( "member area" )?></h1>


<?php
if ( isset( $_GET["d"] ) ) {
	if ( $_GET["d"] == 1 ) {
		echo ( "Error. The login is incorrect." );
	}
	if ( $_GET["d"] == 4 ) {
		echo ( "Error. The email already exists." );
	}
}

include ( "login_content.php" );
?>