=== Dropwp Disable Products ===
Contributors: dropwp
Tags: helper, woocomerce, products, draft, disable
Requires at least: 3.0.1
Tested up to: 4.6.1
Stable tag: trunk
License: GPLv2 or later
License URI: http://www.gnu.org/licenses/gpl-2.0.html

Plugin to create all WooCommerce producst on DRAFT status until a custom_meta is added.

== Description ==

Once activated, this plugin will override all product status changes and set them to DRAFT. This way you could have a bulk importer and
only publish your products once you have already revised and updated them.

To override this status change, simply add a custom_meta to the product with name 'dropwp_disableproducts_skip' and value '1'. 


== Installation ==

1. Upload the plugin files to the `/wp-content/plugins/` directory, or install the plugin through the WordPress plugins screen directly.
2. Activate the plugin through the 'Plugins' screen in WordPress

== Changelog ==

= 1.0 =
* First version
