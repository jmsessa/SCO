<?php

/**
 * @package TutorLMS/Templates
 * @version 1.4.3
 */

$is_instructor = tutor_utils()->is_instructor();
if ( $is_instructor ) {
    $user_id = get_current_user_id();
    $instructor_status = get_user_meta( $user_id, '_tutor_instructor_status', true );
?>
    <div class="tutor-container">
        <div class="tutor-instructor-application-process tutor-pt-48 tutor-pb-48">
            <div class="tutor-app-process-alert">
                <div style="border:1px solid var(--tutor-color-primary);" class="tutor-primary tutor-py-12 tutor-px-20 tutor-radius-6">
                    <div class="tutor-alert-text tutor-d-flex tutor-align-center">
                    <span class="tutor-icon-circle-info tutor-fs-4 tutor-color-primary tutor-mr-12"></span>
                    <span>
                    <?php
                        if ( $instructor_status == 'pending' ) {
                            esc_html_e( 'Sua inscrição será analisada e os resultados serão enviados a você por e-mail.', 'tutor' );
                        } elseif ( $instructor_status == 'approved' ) {
                            esc_html_e( 'A sua candidatura foi aceite. Mais detalhes necessários foram enviados para sua conta de e-mail registrada.', 'tutor' );
                        } elseif ( $instructor_status == 'blocked' ) {
                            esc_html_e( 'Você foi impedido de ser um formador.', 'tutor' );
                        }
                    ?>
                    </span>
                    </div>
                </div>
            </div>
            <div class="tutor-app-process-image tutor-m-auto tutor-pt-32 tutor-pb-44 tutor-d-flex tutor-justify-center tutor-align-center">
                <span class="tutor-app-process-img">
                    <img
                    src="<?php echo esc_url( tutor()->url . 'assets/images/instructor-thankyou.png' ); ?>"
                    alt="<?php esc_attr_e( 'inscrição de formador Recebida', 'tutor' ); ?>"
                    />
                </span>
            </div>
            <div class="tutor-instructor-application-body">
                <div class="tutor-ins-app-title tutor-m-auto tutor-text-center">
                    <span class="tutor-app-process-title tutor-fs-3 tutor-fw-medium tutor-color-black">
                    <?php
                        if ( $instructor_status == 'pending' ) {
                            esc_html_e( 'Obrigado por se registrar como formador! ', 'tutor' );
                        } elseif ( $instructor_status == 'approved' ) {
                            esc_html_e( 'Parabéns! Agora você está registrado como formador.', 'tutor' );
                        } elseif ( $instructor_status == 'blocked' ) {
                            esc_html_e( 'Infelizmente, seu status de formador foi removido.', 'tutor' );
                        }
                    ?>
                    </span>
                </div>
                <div class="tutor-ins-app-subtitle tutor-m-auto tutor-text-center tutor-pt-24 tutor-pb-48">
                    <span class="tutor-app-process-subtitle tutor-fs-6 tutor-color-secondary">
                    <?php
                        if ( $instructor_status == 'pending' ) {
                            esc_html_e( 'Recebemos sua inscrição e a analisaremos em breve. Por favor, aguente firme!', 'tutor' );
                        } elseif ( $instructor_status == 'approved' ) {
                            esc_html_e( 'Comece a criar seu primeiro curso hoje e deixe sua jornada de eLearning começar.', 'tutor' );
                        } elseif ( $instructor_status == 'blocked' ) {
                            esc_html_e( 'Entre em contato com o administrador do site para mais informações.', 'tutor' );
                        }
                    ?>
                    </span>
                </div>
                <div class="tutor-instructor-apply-button tutor-text-center">
                    <a style="text-decoration:none;" class="tutor-bg-primary tutor-color-white tutor-py-16 tutor-px-32 tutor-radius-6" href="<?php echo esc_url( tutor_utils()->tutor_dashboard_url() ) ?>">
                        <?php esc_html_e( 'Ir para a dashboard', 'tutor' ); ?>
                    </a>
                </div>
            </div>
        </div>
	</div>

<?php } else {
    tutor_load_template( 'dashboard.instructor.apply_for_instructor' );
} ?>
