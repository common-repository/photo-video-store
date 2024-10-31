<?php
// Exit if accessed directly.
if ( ! defined( 'ABSPATH' ) )
{
	exit;
}

$video_player = '<iframe width="' . $player_video_width . '" height="' . $player_video_height . '" src="https://www.youtube.com/embed/' . $player_video_id . '" frameborder="0" allow="autoplay; encrypted-media" allowfullscreen></iframe>';
?>