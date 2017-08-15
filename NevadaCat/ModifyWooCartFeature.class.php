<?php

namespace NevadaCat;

class ModifyWooCartFeature{
	
	public $firstCatSubscriptionProductID;
	
	public $additionalCatSubscriptionProductID;
	
	public $numberOfFelineCPTsAuthoredByCurrentUserWithSubscriptions;
	
	public function __construct(){
		
		//initialize variable with something:
		$this->numberOfFelineCPTsAuthoredByCurrentUserWithSubscriptions = 0;
	
		//calculate the product IDs. Text must match $title strings.
		$title ="Single Cat Monthly Food Subscription (recurring)";
		$page = get_page_by_title($title, $output = OBJECT, $post_type = 'product');
		$this->firstCatSubscriptionProductID = $page->ID;
		
		$title = "Additional Cats Monthly Food Subscription (recurring)";
		$page = get_page_by_title($title, $output = OBJECT, $post_type = 'product');
		$this->additionalCatSubscriptionProductID = $page->ID;
	}
	
	public function calculateNumberOfFelineCPTsAuthoredByCurrentUserWithSubscriptions(){
		$currentUser = get_current_user_id();
		 $args = array(
				'post_type'	=> 	'feline',
				'author'	=>	$currentUser,
		 		'meta_query' => 
		 			array(
		 				array(
		 					'key' 	=>	'temporary_hold',
		 					'value'	=>	'GO',
		 					'compare' => '='
		 				)
		 			)
		);
		$query = new \WP_Query($args);
		$count = 0;
		while ($query->have_posts() ){
			$query->the_post();
			$count = $count + 1;
		}		
		$this->numberOfFelineCPTsAuthoredByCurrentUserWithSubscriptions = $count;

	}
	
	public function getNumberOfFelineCPTsAuthoredByCurrentUserWithoutSubscriptions(){
		die('error: not done getNumberOfFelineCPTsAuthoredByCurrentUserWithoutSubscriptions');
	}
	
	public function setShoppingCart(){
		add_action('wp_loaded', array($this, 'doAddToCart'));
	}
	
	public function removeAllModifiedProductsFromCart(){
		global $woocommerce;
		$woocommerce->cart->empty_cart(); 
	}
	
	public 	function doAddToCart() {
		global $woocommerce;

		$this->removeAllModifiedProductsFromCart();
		
		$this->calculateNumberOfFelineCPTsAuthoredByCurrentUserWithSubscriptions();
		$numberOfSubScriptions = $this->numberOfFelineCPTsAuthoredByCurrentUserWithSubscriptions;

		if($numberOfSubScriptions > 0){
			$woocommerce->cart->add_to_cart($this->firstCatSubscriptionProductID);
		}
		$numberOfSubScriptions = $numberOfSubScriptions - 1;
		
		while ($numberOfSubScriptions > 0){
			$woocommerce->cart->add_to_cart($this->additionalCatSubscriptionProductID);
			$numberOfSubScriptions = $numberOfSubScriptions - 1;			
		}
	}
	
}
