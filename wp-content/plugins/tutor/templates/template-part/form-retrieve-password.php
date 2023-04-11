<?php
/**
 * @package TutorLMS/Templates
 * @version 1.4.3
 */

defined( 'ABSPATH' ) || exit;

do_action( 'tutor_before_reset_password_form' ); ?>

<form method="post" class="tutor-reset-password-form tutor-ResetPassword lost_reset_password">
	<?php tutor_nonce_field(); ?>
	<input type="hidden" name="tutor_action" value="tutor_process_reset_password">
	<input type="hidden" name="reset_key" value="<?php echo tutor_utils()->array_get('reset_key', $_GET); ?>" />
	<input type="hidden" name="user_id" value="<?php echo tutor_utils()->array_get('user_id', $_GET); ?>" />

	<p>
		<?php echo apply_filters( 'tutor_reset_password_message', esc_html__( 'Digite a senha e confirme a senha para redefinir sua senha', 'tutor' )
		); ?>
	</p>

	<div class="tutor-form-row">
		<div class="tutor-form-col-12">
			<div class="tutor-form-group">
				<label><?php esc_html_e( 'Senha', 'tutor' ); ?></label>
				<input type="password" name="password" id="password">
			</div>
		</div>
	</div>

	<div class="tutor-form-row">
		<div class="tutor-form-col-12">
			<div class="tutor-form-group">
				<label><?php esc_html_e( 'Confirmar Senha', 'tutor' ); ?></label>
				<input type="password" name="confirm_password" id="confirm_password">
			</div>
		</div>
	</div>

	<div class="clear"></div>

	<?php do_action( 'tutor_reset_password_form' ); ?>

	<div class="tutor-form-row">
		<div class="tutor-form-col-12">
			<div class="tutor-form-group">
				<button type="submit" class="tutor-btn" value="<?php esc_attr_e( 'Redefinir senha', 'tutor' ); ?>"><?php
					esc_html_e( 'Redefinir senha', 'tutor' ); ?></button>
			</div>
		</div>
	</div>

</form>

<?php do_action( 'tutor_after_reset_password_form' ); ?>
