<?php
add_action( 'admin_menu', 'tbp_add_admin_menu' );
add_action( 'admin_init', 'tbp_settings_init' );


function tbp_add_admin_menu(  ) {

	add_submenu_page( 'options-general.php', 'The Big Picture', 'The Big Picture', 'manage_options', 'the_big_picture', 'tbp_options_page' );

}


function tbp_settings_init(  ) {

	register_setting( 'pluginPage', 'tbp_settings' );

	add_settings_section(
		'tbp_pluginPage_section',
		__( 'Enter your Big Picture Account ID', 'wordpress' ),
		'tbp_settings_section_callback',
		'pluginPage'
	);

	add_settings_field(
		'tbp_account_id',
		__( 'Your Big Picture account id', 'wordpress' ),
		'tbp_account_id_render',
		'pluginPage',
		'tbp_pluginPage_section'
	);


}


function tbp_account_id_render(  ) {

	$options = get_option( 'tbp_settings' );
	?>
	<input type='text' name='tbp_settings[tbp_account_id]' value='<?php echo $options['tbp_account_id']; ?>'>
	<?php

}


function tbp_settings_section_callback(  ) {

	echo __( 'You can find your Account ID in the settings page of https://thebigpicture.io', 'wordpress' );

}


function tbp_options_page(  ) {

	?>
	<form action='options.php' method='post'>

		<h2>Analytics by The Big Picture</h2>
		<p>
			Enter your Big Picture account id for this project. You can locate your account id from the "Script Tag" settings menu in your Big Picture dashboard.
		</p>
		<p>
			Once you have saved your account id, you can manage all of your integrations and tracking from the <a href="https://thebigpicture.io/">Big Picture dashboard.</a> 
		</p>

		<?php
		settings_fields( 'pluginPage' );
		do_settings_sections( 'pluginPage' );
		submit_button();
		?>

	</form>
	<?php

}

?>
