<?php
/**
 * @package TutorLMS/Templates
 * @version 1.4.3
 */

defined( 'ABSPATH' ) || exit;


tutor_alert( null, 'any' );


if (tutor_utils()->array_get('reset_key', $_GET) && tutor_utils()->array_get('user_id', $_GET)){
    tutor_load_template('template-part.form-retrieve-password');
}else{
	do_action( 'tutor_before_retrieve_password_form' );
	?>

	<form method="post" class="tutor-forgot-password-form tutor-ResetPassword lost_reset_password">
		<?php tutor_nonce_field(); ?>
		<input type="hidden" name="tutor_action" value="tutor_retrieve_password">

        <p><?php echo apply_filters( 'tutor_lost_password_message', esc_html__( 'Perdeu sua senha? Por favor, digite seu nome de usuário ou endereço de e-mail. Você receberá um link para criar uma nova senha por e-mail.', 'tutor' ) ); ?></p><?php // @codingStandardsIgnoreLine ?>

		<div class="tutor-form-row">
			<div class="tutor-form-col-12">
				<div class="tutor-form-group">
					<label><?php esc_html_e( 'Nome de usuário ou email', 'tutor' ); ?></label>

					<input type="text" name="user_login" id="user_login" autocomplete="username">
				</div>
			</div>
		</div>

		<div class="clear"></div>

		<?php do_action( 'tutor_lostpassword_form' ); ?>

        <div class="tutor-form-row">
            <div class="tutor-form-col-12">
                <div class="tutor-form-group">
                    <button type="submit" class="tutor-btn" value="<?php esc_attr_e( 'Redefinir a Senha', 'tutor' ); ?>"><?php
						esc_html_e( 'Redefinir a Senha', 'tutor' ); ?></button>
                </div>
            </div>
        </div>

    </form>

	<?php
	do_action( 'tutor_after_retrieve_password_form' );
}
