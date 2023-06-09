<!--create announcements modal-->
<div class="tutor-modal-wrap tutor-announcements-modal-wrap tutor-accouncement-create-modal">
    <div class="tutor-modal-content tutor-announcement-modal-content">
        <div class="modal-header">
            <div class="modal-title">
                <h1><?php esc_html_e( 'Criar novo anúncio', 'tutor' ); ?></h1>
            </div>
            <div class="tutor-announcements-modal-close-wrap">
                <a href="#" class="tutor-announcement-close-btn">
                    <i class="tutor-icon-times"></i>
                </a>
            </div>
        </div>
        <div class="modal-container">
            <form action="" class="tutor-announcements-form">
                <?php tutor_nonce_field(); ?>
                <div class="tutor-form-group">
                    <label>
                        <?php esc_html_e( 'Selecione o curso', 'tutor' ); ?>
                    </label>
                    <select class="ignore-nice-select" name="tutor_announcement_course" id="" required>
                        <?php if ( $courses ) : ?>
                            <?php foreach ( $courses as $course ) : ?>
                                <option value="<?php echo esc_attr( $course->ID ); ?>">
                                    <?php echo esc_html( $course->post_title ); ?>
                                </option>
                            <?php endforeach; ?>
                        <?php else : ?>
                            <option value=""><?php echo __( 'Nenhum curso encontrado', 'tutor' ); ?></option>
                        <?php endif; ?>
                    </select>
                </div>
                <div class="tutor-form-group">
                    <label>
                        <?php esc_html_e( 'Título do anúncio', 'tutor' ); ?>
                    </label>
                    <input type="text" name="tutor_announcement_title" value="" placeholder="<?php echo __( 'Título do anúncio', 'tutor' ); ?>" required>
                </div>
                <div class="tutor-form-group">
                    <label for="tutor_announcement_course">
                        <?php esc_html_e( 'Resumo', 'tutor' ); ?>
                    </label>
                    <textarea rows="6" type="text" name="tutor_announcement_summary" value="" placeholder="<?php echo __( 'Resumo...', 'tutor' ); ?>" required></textarea>
                </div>
                
                <?php do_action( 'tutor_announcement_editor/after' ); ?>
                
                <div class="tutor-form-group">
                    <div class="tutor-announcements-create-alert"></div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="tutor-btn"><?php esc_html_e( 'Publicar', 'tutor' ) ?></button>
                    <button type="button" class="quiz-modal-tab-navigation-btn  quiz-modal-btn-cancel tutor-announcement-close-btn tutor-announcement-cancel-btn"><?php esc_html_e( 'Cancelar', 'tutor' ) ?></button>
                </div>
            </form>
        </div>
    </div>
</div>
<!--create announcements modal end-->