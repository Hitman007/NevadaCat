<?php 

namespace NevadaCat;

class FrontPageShortcode{
	
	public function __construct(){}
	
	public function returnShortcodeHTML(){
		query_posts('category_name=products&post_status=publish,future');
		if ( have_posts() ) : while ( have_posts() ) : the_post();
		$postid = get_the_ID();
		$url = wp_get_attachment_url( get_post_thumbnail_id($postid) );
		$thePermalink= get_the_permalink();
		$theTitle= get_the_title();
		global $post; 
		$slug = $post->post_name;
	}
}

$output = <<<OUTPUT

<p>Nevada Cat House products are created using only ingredients sold for human consumption. No "meat bi products" here, whatever that is. Healthy, all natural food for your cat!</p>

<div class = "front_page_image" id = "front_page_image_$postid">
			<style>
				#front_page_image_$postid {background:url($url);background-size:cover;}
			</style>
		</div>
		<div class = "h2"><a href="$thePermalink">$theTitle</a></div>
		<script>
			jQuery( document ).ready(function() {
				jQuery('#subscription_button_<?php echo $slug;?>').click(function(){
					window.location.href = "nevadacathouse.biz/subscriptions/?subscription_type=<?php echo $slug;?>";
				});
			jQuery('#info_button_<?php echo $slug;?>').click(function(){
					window.location.href = "nevadacathouse.biz/<?php echo $slug;?>";
				});

			});
		</script>
		<?php $e = get_the_excerpt(); echo $e;?><br />
		<input type = "button" name = "subscription" value = "Subscriptions" class = "cat_button" id = "subscription_button_<?php echo $slug;?>" /> - Less than $2/day!<br />
		<input type = "button" name = "recipe" value = "Nutrition Info" class = "cat_button" id = "info_button_<?php echo $slug;?>"/>
		<div style = "width: 100%; clear: both; display:block;">&nbsp;</div>
	<?php endwhile; else: endif; ?>