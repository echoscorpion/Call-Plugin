<?php
/**
 * @package ny_Call
 * @version 1
 */
/*
Plugin Name: Call Button Plugin
Description: Roses are Red, GOT has Ned, This is a call plugin, Don't loose your head.
Author: Batman
Version: 1.1
*/

add_action('admin_menu', 'test_plugin_setup_menu');
 
function test_plugin_setup_menu(){
    add_menu_page( 'Test Plugin Page', 'Call Plugin', 'manage_options', 'test-plugin', 'test_init' );

	add_action( 'admin_init', 'register_my_test_plugin' );

}

function register_my_test_plugin() {
	//register our settings saving information given by user
	register_setting( 'register_my_test_plugin_field', 'test_plugin_phone_number' );
	register_setting( 'register_my_test_plugin_field', 'test_plugin_phone_country' );
	register_setting( 'register_my_test_plugin_field', 'test_plugin_phone_color' );
	register_setting( 'register_my_test_plugin_field', 'test_plugin_phone_position' );


}

function test_init(){
	?>
	<div class="wrap">
	<h1>Call Button</h1>
	<form method="post" action="options.php">
		<?php settings_fields( 'register_my_test_plugin_field' ); ?>
		<?php do_settings_sections( 'register_my_test_plugin_field' ); ?>
		<table class="form-table">
			<tr valign="top">
			<th scope="row">Phone Number</th>
			<td><input type="text" name="test_plugin_phone_number" value="<?php echo esc_attr( get_option('test_plugin_phone_number') ); ?>" /></td>
			</tr>
			<tr valign="top">
			<th scope="row">Country Code</th>
			<td><input type="text" name="test_plugin_phone_country" value="<?php echo esc_attr( get_option('test_plugin_phone_country') ); ?>" /></td>
			</tr>
			<tr valign="top">
			<th scope="row">Color</th>
			<td><input type="color" name="test_plugin_phone_color" value="<?php echo esc_attr( get_option('test_plugin_phone_color') ); ?>" /></td>
			</tr>
			<tr valign="top">
			<th scope="row">Position (Type "Right"</Strong> "for right side and "Left" for left side)</th>
			<td><input type="text" name="test_plugin_phone_position" value="<?php echo esc_attr( get_option('test_plugin_phone_position') ); ?>" /></td>
			</tr>
		</table>
		
		<?php submit_button(); ?>
	
	</form>
	<?php settings_errors(); ?>
	</div>
	<?php 
}



function test_plugin() {
	$phone = get_option( 'test_plugin_phone_number' );
	$country = get_option( 'test_plugin_phone_country' );
	if(!is_admin()) {
		if (get_option('test_plugin_phone_number')){
				if(get_option( 'test_plugin_phone_position' )=='Right') {
					echo '<a class="ny-phone-link" href="tel:'.$country.''.$phone.'" style="background-color:'.get_option( 'test_plugin_phone_color' ).';"><div class="ny-call" style="right:10px;"><i class="fas fa-phone ny-p-i" style="transform: rotate(90deg);
					"></i></div></a>';
				}
				else {
					echo '<a class="ny-phone-link" href="tel:'.$country.''.$phone.'" style="background-color:'.get_option( 'test_plugin_phone_color' ).';"><div class="ny-call" style="left:10px;"><i class="fas fa-phone ny-p-i" style="transform: rotate(90deg);
					"></i></div></a>';
				}
		}
    }

}

// Now we set that function up to execute when the admin_notices action is called.
add_action( 'init', 'test_plugin' );

// We need some CSS to position the paragraph.
function test_plugin_css() {
	echo "
	<style type='text/css'>
	.ny-call{
		position: fixed;
		z-index: 11;
		padding: 20px;
		background: ".get_option( 'test_plugin_phone_color' ).";
		border-radius: 45px;
		bottom:20px;
		z-index:9999;
	}
	.ny-call:hover{
		transform:scale(1.2);
		transition-duration:.5s;
	}
	.ny-p-i {
		color:#fff!important;
	}

	@media screen and (max-width: 782px) {
		.ny-phone-link{
		display:none
		}
	}
	</style>
	";
}

add_action( 'init', 'test_plugin_css' );
