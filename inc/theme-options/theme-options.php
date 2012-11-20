<?php
/**
 * mitec Theme Options
 *
 * @package mitec
 * @since mitec 1.0
 */

/**
 * Register the form setting for our mitec_options array.
 *
 * This function is attached to the admin_init action hook.
 *
 * This call to register_setting() registers a validation callback, mitec_theme_options_validate(),
 * which is used when the option is saved, to ensure that our option values are properly
 * formatted, and safe.
 *
 * @since mitec 1.0
 */
function mitec_theme_options_init() {
	register_setting(
		'mitec_options', // Options group, see settings_fields() call in mitec_theme_options_render_page()
		'mitec_theme_options', // Database option, see mitec_get_theme_options()
		'mitec_theme_options_validate' // The sanitization callback, see mitec_theme_options_validate()
	);

	// Register our settings field group
	add_settings_section(
		'general', // Unique identifier for the settings section
		'', // Section title (we don't want one)
		'__return_false', // Section callback (we don't want anything)
		'theme_options' // Menu slug, used to uniquely identify the page; see mitec_theme_options_add_page()
	);

	// Register our individual settings fields
	add_settings_field(
		'sample_checkbox', // Unique identifier for the field for this section
		__( 'Sample Checkbox', 'mitec' ), // Setting field label
		'mitec_settings_field_sample_checkbox', // Function that renders the settings field
		'theme_options', // Menu slug, used to uniquely identify the page; see mitec_theme_options_add_page()
		'general' // Settings section. Same as the first argument in the add_settings_section() above
	);

	add_settings_field( 'sample_text_input', __( 'Sample Text Input', 'mitec' ), 'mitec_settings_field_sample_text_input', 'theme_options', 'general' );
	add_settings_field( 'sample_select_options', __( 'Sample Select Options', 'mitec' ), 'mitec_settings_field_sample_select_options', 'theme_options', 'general' );
	add_settings_field( 'sample_radio_buttons', __( 'Sample Radio Buttons', 'mitec' ), 'mitec_settings_field_sample_radio_buttons', 'theme_options', 'general' );
	add_settings_field( 'sample_textarea', __( 'Sample Textarea', 'mitec' ), 'mitec_settings_field_sample_textarea', 'theme_options', 'general' );
}
add_action( 'admin_init', 'mitec_theme_options_init' );

/**
 * Change the capability required to save the 'mitec_options' options group.
 *
 * @see mitec_theme_options_init() First parameter to register_setting() is the name of the options group.
 * @see mitec_theme_options_add_page() The edit_theme_options capability is used for viewing the page.
 *
 * @param string $capability The capability used for the page, which is manage_options by default.
 * @return string The capability to actually use.
 */
function mitec_option_page_capability( $capability ) {
	return 'edit_theme_options';
}
add_filter( 'option_page_capability_mitec_options', 'mitec_option_page_capability' );

/**
 * Add our theme options page to the admin menu.
 *
 * This function is attached to the admin_menu action hook.
 *
 * @since mitec 1.0
 */
function mitec_theme_options_add_page() {
	$theme_page = add_theme_page(
		__( 'Theme Options', 'mitec' ),   // Name of page
		__( 'Theme Options', 'mitec' ),   // Label in menu
		'edit_theme_options',          // Capability required
		'theme_options',               // Menu slug, used to uniquely identify the page
		'mitec_theme_options_render_page' // Function that renders the options page
	);
}
add_action( 'admin_menu', 'mitec_theme_options_add_page' );

/**
 * Returns an array of sample select options registered for mitec.
 *
 * @since mitec 1.0
 */
function mitec_sample_select_options() {
	$sample_select_options = array(
		'0' => array(
			'value' =>	'0',
			'label' => __( 'Zero', 'mitec' )
		),
		'1' => array(
			'value' =>	'1',
			'label' => __( 'One', 'mitec' )
		),
		'2' => array(
			'value' => '2',
			'label' => __( 'Two', 'mitec' )
		),
		'3' => array(
			'value' => '3',
			'label' => __( 'Three', 'mitec' )
		),
		'4' => array(
			'value' => '4',
			'label' => __( 'Four', 'mitec' )
		),
		'5' => array(
			'value' => '5',
			'label' => __( 'Five', 'mitec' )
		)
	);

	return apply_filters( 'mitec_sample_select_options', $sample_select_options );
}

/**
 * Returns an array of sample radio options registered for mitec.
 *
 * @since mitec 1.0
 */
function mitec_sample_radio_buttons() {
	$sample_radio_buttons = array(
		'yes' => array(
			'value' => 'yes',
			'label' => __( 'Yes', 'mitec' )
		),
		'no' => array(
			'value' => 'no',
			'label' => __( 'No', 'mitec' )
		),
		'maybe' => array(
			'value' => 'maybe',
			'label' => __( 'Maybe', 'mitec' )
		)
	);

	return apply_filters( 'mitec_sample_radio_buttons', $sample_radio_buttons );
}

/**
 * Returns the options array for mitec.
 *
 * @since mitec 1.0
 */
function mitec_get_theme_options() {
	$saved = (array) get_option( 'mitec_theme_options' );
	$defaults = array(
		'sample_checkbox'       => 'off',
		'sample_text_input'     => '',
		'sample_select_options' => '',
		'sample_radio_buttons'  => '',
		'sample_textarea'       => '',
	);

	$defaults = apply_filters( 'mitec_default_theme_options', $defaults );

	$options = wp_parse_args( $saved, $defaults );
	$options = array_intersect_key( $options, $defaults );

	return $options;
}

/**
 * Renders the sample checkbox setting field.
 */
function mitec_settings_field_sample_checkbox() {
	$options = mitec_get_theme_options();
	?>
	<label for="sample-checkbox">
		<input type="checkbox" name="mitec_theme_options[sample_checkbox]" id="sample-checkbox" <?php checked( 'on', $options['sample_checkbox'] ); ?> />
		<?php _e( 'A sample checkbox.', 'mitec' ); ?>
	</label>
	<?php
}

/**
 * Renders the sample text input setting field.
 */
function mitec_settings_field_sample_text_input() {
	$options = mitec_get_theme_options();
	?>
	<input type="text" name="mitec_theme_options[sample_text_input]" id="sample-text-input" value="<?php echo esc_attr( $options['sample_text_input'] ); ?>" />
	<label class="description" for="sample-text-input"><?php _e( 'Sample text input', 'mitec' ); ?></label>
	<?php
}

/**
 * Renders the sample select options setting field.
 */
function mitec_settings_field_sample_select_options() {
	$options = mitec_get_theme_options();
	?>
	<select name="mitec_theme_options[sample_select_options]" id="sample-select-options">
		<?php
			$selected = $options['sample_select_options'];
			$p = '';
			$r = '';

			foreach ( mitec_sample_select_options() as $option ) {
				$label = $option['label'];
				if ( $selected == $option['value'] ) // Make default first in list
					$p = "\n\t<option style=\"padding-right: 10px;\" selected='selected' value='" . esc_attr( $option['value'] ) . "'>$label</option>";
				else
					$r .= "\n\t<option style=\"padding-right: 10px;\" value='" . esc_attr( $option['value'] ) . "'>$label</option>";
			}
			echo $p . $r;
		?>
	</select>
	<label class="description" for="sample_theme_options[selectinput]"><?php _e( 'Sample select input', 'mitec' ); ?></label>
	<?php
}

/**
 * Renders the radio options setting field.
 *
 * @since mitec 1.0
 */
function mitec_settings_field_sample_radio_buttons() {
	$options = mitec_get_theme_options();

	foreach ( mitec_sample_radio_buttons() as $button ) {
	?>
	<div class="layout">
		<label class="description">
			<input type="radio" name="mitec_theme_options[sample_radio_buttons]" value="<?php echo esc_attr( $button['value'] ); ?>" <?php checked( $options['sample_radio_buttons'], $button['value'] ); ?> />
			<?php echo $button['label']; ?>
		</label>
	</div>
	<?php
	}
}

/**
 * Renders the sample textarea setting field.
 */
function mitec_settings_field_sample_textarea() {
	$options = mitec_get_theme_options();
	?>
	<textarea class="large-text" type="text" name="mitec_theme_options[sample_textarea]" id="sample-textarea" cols="50" rows="10" /><?php echo esc_textarea( $options['sample_textarea'] ); ?></textarea>
	<label class="description" for="sample-textarea"><?php _e( 'Sample textarea', 'mitec' ); ?></label>
	<?php
}

/**
 * Renders the Theme Options administration screen.
 *
 * @since mitec 1.0
 */
function mitec_theme_options_render_page() {
	?>
	<div class="wrap">
		<?php screen_icon(); ?>
		<?php $theme_name = function_exists( 'wp_get_theme' ) ? wp_get_theme() : get_current_theme(); ?>
		<h2><?php printf( __( '%s Theme Options', 'mitec' ), $theme_name ); ?></h2>
		<?php settings_errors(); ?>

		<form method="post" action="options.php">
			<?php
				settings_fields( 'mitec_options' );
				do_settings_sections( 'theme_options' );
				submit_button();
			?>
		</form>
	</div>
	<?php
}

/**
 * Sanitize and validate form input. Accepts an array, return a sanitized array.
 *
 * @see mitec_theme_options_init()
 * @todo set up Reset Options action
 *
 * @param array $input Unknown values.
 * @return array Sanitized theme options ready to be stored in the database.
 *
 * @since mitec 1.0
 */
function mitec_theme_options_validate( $input ) {
	$output = array();

	// Checkboxes will only be present if checked.
	if ( isset( $input['sample_checkbox'] ) )
		$output['sample_checkbox'] = 'on';

	// The sample text input must be safe text with no HTML tags
	if ( isset( $input['sample_text_input'] ) && ! empty( $input['sample_text_input'] ) )
		$output['sample_text_input'] = wp_filter_nohtml_kses( $input['sample_text_input'] );

	// The sample select option must actually be in the array of select options
	if ( isset( $input['sample_select_options'] ) && array_key_exists( $input['sample_select_options'], mitec_sample_select_options() ) )
		$output['sample_select_options'] = $input['sample_select_options'];

	// The sample radio button value must be in our array of radio button values
	if ( isset( $input['sample_radio_buttons'] ) && array_key_exists( $input['sample_radio_buttons'], mitec_sample_radio_buttons() ) )
		$output['sample_radio_buttons'] = $input['sample_radio_buttons'];

	// The sample textarea must be safe text with the allowed tags for posts
	if ( isset( $input['sample_textarea'] ) && ! empty( $input['sample_textarea'] ) )
		$output['sample_textarea'] = wp_filter_post_kses( $input['sample_textarea'] );

	return apply_filters( 'mitec_theme_options_validate', $output, $input );
}
