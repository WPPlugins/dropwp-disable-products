<?php
    if ( ! defined( 'ABSPATH' ) ) exit;
    $images = Dropwp_DisableProducts\Dropwp_Helper::get_image_list( 'wordpress' );
 ?>
<div id="dropwp_disableproducts">

    <div class="module-preheader">
    	<?php echo Dropwp_DisableProducts\Dropwp_Helper::get_image_html( $images, 'header' ); ?>
    </div>

    <div class="module-header">
    	<div class="module-title-container">
    		<div class="module-title"><?php esc_attr_e( 'Dropwp Disable Products', 'dropwp_disableproducts' ); ?><small> <?php esc_attr_e('by Dropwp', 'dropwp_disableproducts' ); ?></small></div>
    		<div class="module-version"><?php esc_attr_e('Version:', 'dropwp_disableproducts'); ?> 1.0.3</div>
    	</div>
    	<div class="module-toolbar">
    		<ul class="module-nav">
    			<li>
    				<a target="_blank" href="http://www.dropshippingwordpress.com/">
    					<img src="<?php echo plugins_url( '../img/dropwp.png', __FILE__ ); ?>">
    					<div><?php esc_attr_e('Dropwp', 'dropwp_disableproducts'); ?></div>
    				</a>
    			</li>
    		</ul>
    	</div>
    </div>
