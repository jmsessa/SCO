<?php
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}
?>

<div class="tutor-option-field-row">
	<div class="tutor-option-field-label">
		<label for=""><?php _e( 'Instructor List Layout', 'tutor' ); ?></label>
	</div>
	<div class="tutor-option-field">
		<div class="instructor-layout-templates-fields">
			<?php
				$url_base = tutor()->url . 'assets/images/instructor-layout/';

			foreach ( $templates as $template ) {
				$img               = $url_base . $template . '.jpg';
				$selected_template = tutor_utils()->get_option( 'instructor_list_layout' );
				?>
					<label class="instructor-layout-template <?php echo $template === $selected_template ? 'selected-template' : ''; ?> ">
						<img src="<?php echo esc_url( $img ); ?>" />
						<input type="radio" name="tutor_option[instructor_list_layout]" value="<?php echo $template; ?>" <?php checked( $template, $selected_template ); ?> style="display: none;" >
					</label>
					<?php
			}
			?>
		</div>
		<p class="desc">
			<?php _e( 'O selecionado será usado se o layout não estiver definido como atributo shortcode.', 'tutor' ); ?>
		</p>
	</div>
</div>

