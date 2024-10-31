<?php
// Exit if accessed directly.
if ( ! defined( 'ABSPATH' ) )
{
	exit;
}

$video_player = '<iframe src="https://player.vimeo.com/video/' . $player_video_id . '?autoplay=0&loop=0" width="' . $player_video_width . '" height="' . $player_video_height . '" frameborder="0" webkitallowfullscreen mozallowfullscreen allowfullscreen></iframe>';
?>