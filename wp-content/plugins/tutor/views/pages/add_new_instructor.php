<div class="wrap">
	<h1 class="wp-heading-inline"><?php esc_html_e('Adicionar Novo Formador', 'tutor'); ?></h1>
	<hr class="wp-header-end">

	<form action="" id="new-instructor-form" method="post">
		<?php tutor_nonce_field(); ?>
		<input type="hidden" name="action" value="add_new_instructor">


		<div id="form-response"></div>

		<?php
		$errors = apply_filters('tutor_instructor_register_validation_errors', array());
		if (is_array($errors) && count($errors)) {
			echo '<div class="tutor-alert-warning"><ul class="tutor-required-fields">';
			foreach ($errors as $error_key => $error_value) {
				echo '<li>' . $error_value . '</li>';
			}
			echo '</ul></div>';
		}
		?>

		<?php do_action('tutor_add_new_instructor_form_fields_before'); ?>

		<div class="tutor-option-field-row">
			<div class="tutor-option-field-label">
				<label for="">
					<?php esc_html_e('Nome Completo', 'tutor'); ?>

					<span class="tutor-required-fields">*</span>
				</label>
			</div>
			<div class="tutor-option-field">
				<input type="text" name="first_name" value="<?php echo esc_attr(tutor_utils()->input_old('first_name')); ?>" placeholder="<?php esc_attr_e('Nome Completo', 'tutor'); ?>">
			</div>
		</div>


		<div class="tutor-option-field-row">
			<div class="tutor-option-field-label">
				<label>
					<?php esc_html_e('Nome Completo', 'tutor'); ?>
					<span class="tutor-required-fields">*</span>
				</label>
			</div>

			<div class="tutor-option-field">
				<input type="text" name="last_name" value="<?php echo esc_attr(tutor_utils()->input_old('last_name')); ?>" placeholder="<?php esc_attr_e('Alcuna', 'tutor'); ?>">
			</div>
		</div>

		<div class="tutor-option-field-row">
			<div class="tutor-option-field-label">
				<label>
					<?php esc_html_e('Nome de Utilizador', 'tutor'); ?>
					<span class="tutor-required-fields">*</span>
				</label>
			</div>

			<div class="tutor-option-field">
				<input type="text" name="user_login" class="tutor_user_name" value="<?php echo esc_attr(tutor_utils()->input_old('user_login')); ?>" placeholder="<?php esc_attr_e('Nome de utilizador', 'tutor'); ?>">
			</div>
		</div>

		<div class="tutor-option-field-row">
			<div class="tutor-option-field-label">
				<label>
					<?php esc_html_e('E-Mail', 'tutor'); ?>
					<span class="tutor-required-fields">*</span>
				</label>
			</div>

			<div class="tutor-option-field">
				<input type="text" name="email" value="<?php echo esc_attr(tutor_utils()->input_old('email')); ?>" placeholder="<?php esc_attr_e('E-Mail', 'tutor'); ?>">
			</div>
		</div>

		<div class="tutor-option-field-row">
			<div class="tutor-option-field-label">
				<label>
					<?php esc_html_e('Telefone', 'tutor'); ?>
					<span class="tutor-required-fields">*</span>
				</label>
			</div>

			<div class="tutor-option-field">
				<input type="text" name="phone_number" value="<?php echo esc_attr(tutor_utils()->input_old('phone_number')); ?>" placeholder="<?php esc_attr_e('Telefone', 'tutor'); ?>">
			</div>
		</div>

		<div class="tutor-option-field-row">
			<div class="tutor-option-field-label">
				<label>
					<?php esc_html_e('Palavra-Passe', 'tutor'); ?>
					<span class="tutor-required-fields">*</span>
				</label>
			</div>

			<div class="tutor-option-field">
				<input type="password" name="password" value="<?php echo esc_attr(tutor_utils()->input_old('password')); ?>" placeholder="<?php esc_attr_e('Palavra-Passe', 'tutor'); ?>">
			</div>
		</div>

		<div class="tutor-option-field-row">
			<div class="tutor-option-field-label">
				<label>
					<?php esc_html_e('Confirmar a Palavra-Passe', 'tutor'); ?>
					<span class="tutor-required-fields">*</span>
				</label>
			</div>

			<div class="tutor-option-field">
				<input type="password" name="password_confirmation" value="<?php echo esc_attr(tutor_utils()->input_old('password_confirmation')); ?>" placeholder="<?php esc_attr_e('Confirmar a Palavra-Passe', 'tutor'); ?>">
			</div>
		</div>

		<div class="tutor-option-field-row">
			<div class="tutor-option-field-label">
				<label>
					<?php esc_html_e('Bio', 'tutor'); ?>
				</label>
			</div>
			<div class="tutor-option-field">
				<textarea name="tutor_profile_bio"><?php esc_html_e(tutor_utils()->input_old('tutor_profile_bio')); ?></textarea>
			</div>
		</div>

		<?php do_action('tutor_add_new_instructor_form_fields_after'); ?>

		<div class="tutor-option-field-row">
			<div class="tutor-option-field-label"></div>

			<div class="tutor-option-field">
				<div class="tutor-form-group tutor-reg-form-btn-wrap">
					<button type="submit" name="tutor_register_instructor_btn" value="register" class="tutor-button tutor-button-primary">
						<i class="tutor-icon-plus-square"></i>
						<?php esc_html_e('Adicionar Novo Formador', 'tutor'); ?></button>
				</div>
			</div>
		</div>

	</form>
</div>