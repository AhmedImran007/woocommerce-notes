/**
 * Change number or products per row to 4
 */
add_filter('loop_shop_columns', 'loop_columns', 999);
if (!function_exists('loop_columns')) {
	function loop_columns() {
		return 4; // 4 products per row
	}
}

// Change the Number of WooCommerce Products Displayed Per Page
add_filter( 'loop_shop_per_page', create_function( '$products', 'return 12;' ), 30 );

function imran_remove_loop_button(){
	remove_action( 'woocommerce_after_shop_loop_item', 'woocommerce_template_loop_add_to_cart', 10 ); // removes the add to cart button on the shop page
	remove_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_add_to_cart', 30 ); //removes the add to cart button on the single product page
}
add_action('init','imran_remove_loop_button');

// Change the add to 'cart button' to 'call to order' in WooCommerce Products 
function imran_woocommerce_call_to_order_button(){
	global $product; //get the product object
	if ( $product ) { // if there's a product proceed
		$url = esc_url( $product->get_permalink() ); //get the permalink to the product
		echo '<a rel="nofollow" href="' . $url . '" class="button add_to_cart_button ">Call to order!</a>'; //display a button that goes to the product page
	}
}
add_action('woocommerce_after_shop_loop_item','imran_woocommerce_call_to_order_button', 10);

function imran_woocommerce_call_to_order_text() {
	echo '<h3>Call to order this product: <br><span style="color:red">017xxxxxxx,019xxxxxxx</span></h3><br>';
}
add_action('woocommerce_single_product_summary','imran_woocommerce_call_to_order_text', 30);


// remove price from woocommerce

add_filter( 'woocommerce_get_price_html', 'imran_remove_price');
function imran_remove_price($price){     
     return ;
}
