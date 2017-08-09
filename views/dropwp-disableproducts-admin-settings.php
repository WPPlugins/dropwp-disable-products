<?php if ( ! defined( 'ABSPATH' ) ) exit; ?>

<div id="dropwp_help">
	<h3><?php echo __( 'Dropwp Disable Products', 'dropwp_disableproducts' ); ?></h3>
	<p><?php  echo __( 'All products on create or update will be set to DRAFT.', 'dropwp_disableproducts' ); ?></p>
	<p><?php  echo __( 'Once a product is ready to be published, you have to add a custom meta <strong>dropwp_disableproducts_skip</strong> with value <strong>1</strong>', 'dropwp_disableproducts' ); ?></p>
	<p><?php  echo __( 'If you prefer to change this custom meta name, you could configure its name on this page.', 'dropwp_disableproducts' ); ?></p>
</div>

<form action="options.php" method="post" id="dropwp_bigbuy_form">
	<div class=" " style="padding: 10px;">

        <?php
            settings_fields( 'dropwp_disableproducts_configuration' );
            do_settings_sections( 'dropwp_disableproducts_configuration' );
            submit_button();
         ?>
           
        </div>
</form>