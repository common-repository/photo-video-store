<?php
if ( ! defined( 'ABSPATH' ) )
{
	exit();
}


$post_result = get_post( ( int )$_GET["id"] );

if ( $post_result != null ) {
$title = $post_result ->post_title;
$content = $post_result ->post_content;
$content = apply_filters('the_content', $content);
$content = str_replace(']]>', ']]&gt;', $content);
?>
	<html>
	<head>
	<title><?php echo $title ?></title>
	<link href="//maxcdn.bootstrapcdn.com/bootstrap/3.3.2/css/bootstrap.min.css" rel="stylesheet">
	</head>
	<body>
		<div style="padding:20px">
		<h3><?php echo $title ?></h3>
		<?php echo $content ?>
		</div>
	</body>
	</html>
	<?php
}
?>





