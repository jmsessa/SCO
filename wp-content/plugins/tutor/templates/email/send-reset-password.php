<?php
/**
 * @package TutorLMS/Templates
 * @version 1.4.3
 */

defined( 'ABSPATH' ) || exit;
?>


<p><?php printf( esc_html__( 'Olá %s,', 'tutor' ), esc_html( $user_login ) ); ?>

<p><?php printf( esc_html__( 'Alguém solicitou uma nova senha para a seguinte conta em %s:', 'tutor' ), esc_html( wp_specialchars_decode( get_option( 'blogname' ), ENT_QUOTES ) ) ); ?></p>

<p><?php printf( esc_html__( 'Nome de Utilizador: %s', 'tutor' ), esc_html( $user_login ) ); ?></p>
<p><?php esc_html_e( 'Se você não fez esta solicitação, apenas ignore este e-mail. Se for você, continue:', 'tutor' ); ?></p>
<p>
	<a class="link" href="<?php echo add_query_arg( array( 'reset_key' => $reset_key, 'user_id' => $user_id ), tutor_utils()->tutor_dashboard_url('retrieve-password') ); ?>"><?php // phpcs:ignore ?>
		<?php esc_html_e( 'Clique aqui para redefinir sua senha', 'tutor' ); ?>
	</a>
</p>
<p><?php esc_html_e( 'Obrigado por ler.', 'tutor' ); ?></p>
