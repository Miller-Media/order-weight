<?php
/**
 * Plugin Name: Order Weight
 * Description: Shows the total weight of the ordered items on the Edit Order page
 * Version: 1.0.0
 * Author: Max Strukov (Miller Media)
 * Author URI: www.millermedia.io
 */

add_action('init', function() {

	add_action('woocommerce_admin_order_items_after_line_items', function($order_id) {
		$order = wc_get_order($order_id);
		$order_items = $order->get_items();
		$total_weight = 0;
		foreach ($order_items as $item_id => $item) {
			if ( $item['product_id'] > 0 ) {
				$product = wc_get_product($item['product_id']);
				if (!$product->is_virtual()) {
					$total_weight += $product->get_weight() * $item['qty'];
				}
			}
		}
		echo "<tr><td></td><td></td><td colspan='3' style='text-align: right'>Total Order Weight is <b>".$total_weight." lbs</b></td><td></td></tr>";
	});
	
});