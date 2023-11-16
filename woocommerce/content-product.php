<?php
/**
 * The template for displaying product content within loops
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/content-product.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see     https://docs.woocommerce.com/document/template-structure/
 * @package WooCommerce\Templates
 * @version 3.6.0
 */

defined('ABSPATH') || exit;

global $product;

// Ensure visibility.
if (empty($product) || !$product->is_visible()) {
	return;
}
?>

<div class="col-lg-4 col-md-6 text-center strawberry" style="position: absolute; left: 0px; top: 0px;">
	<div class="single-product-item">
		<div class="product-image">
			<a href="<?php echo $product->get_permalink(); ?>">
				<?php $image = wp_get_attachment_image_src(get_post_thumbnail_id(), 'single-post-thumbnail'); ?>
				<img src="<?php echo $image[0]; ?>" alt="">
			</a>
		</div>
		<h3>
			<?php echo $product->get_name(); ?>
		</h3>
		<p class="product-price"><span>
				<?php echo $product->get_sku(); ?>
			</span>
			<?php if($product->get_price() > 0) {
				echo number_format($product->get_price(), 0, ".", ",") . " "; echo get_woocommerce_currency();;
			}
			?>
		</p>
		<a href="cart.html" class="cart-btn"><i class="fas fa-shopping-cart"></i> Add to Cart</a>
	</div>
</div>