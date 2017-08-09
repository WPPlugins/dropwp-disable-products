<?php
    if ( ! defined( 'ABSPATH' ) ) exit;
    $images = Dropwp_DisableProducts\Dropwp_Helper::get_image_list( 'wordpress' );
 ?>

    <br />
    <div class="module-newsletter">
    	<form action="http://www.informax.es/subscribe/" method="post" target="_blank">
    		<input type="hidden" name="accion" value="newsletter">
    		<input type="hidden" name="id_tab" value="1">
    		<p>
    			<?php esc_attr_e( 'If you want news about or modules or Wordpress general hints, join our newsletter', 'dropwp_disableproducts'); ?>
    		</p>
    		<p>
    			<label><?php esc_attr_e( 'email', 'dropwp_disableproducts' ); ?></label>
    			<input type="text" name="email" value=""><input type="submit" name="subscribe" value="Submit">
    		</p>
    	</form>
    </div>

    <div class="module-footer">
    	<div class="module-footer-left">
    		<?php echo Dropwp_DisableProducts\Dropwp_Helper::get_image_html( $images, 'footera' ); ?>
    	</div>
    	<div class="module-footer-right">
    		<?php echo Dropwp_DisableProducts\Dropwp_Helper::get_image_html( $images, 'footerb' ); ?>
    	</div>
    </div>
</div>
