<?php
public function returnCatsArray($user_ID){
	global $current_user;
	$args           = array(
			'post_type' => 'feline',
			'author' => $user_ID
	);
	$your_cats_roll = new \WP_Query($args);

	if ($your_cats_roll->have_posts()) {
		while ($your_cats_roll->have_posts()) {
			$posts = array();
			$your_cats_roll->the_post();
			$postID = get_the_ID();
			$posts[] = $postID;
			return $posts;
		}
	}else{
		return FALSE;
	}
}
