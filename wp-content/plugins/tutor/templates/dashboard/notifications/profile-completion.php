<?php
$profile_completion = tutils()->user_profile_completion();
if ( $profile_completion->progress < 100 ) { ?>
	<div class="tutor-col-12">
		<div class="tutor-profile-completion-warning">
			<div class="profile-completion-warning-icon">
				<span class="tutor-icon-warning"></span>
			</div>
			<div class="profile-completion-warning-content">
				<h4><?php _e( 'Complete o Seu perfil', 'tutor' ); ?></h4>
				<div class="profile-completion-warning-details">
					<p><?php _e( 'Complete seu perfil para que as pessoas saibam mais sobre você! Ir para o perfil', 'tutor' ); ?> <a href="<?php echo esc_url( tutils()->tutor_dashboard_url( 'settings' ) ); ?>"><?php _e( 'Definições', 'tutor' ); ?></a></p>
					<ul>
						<?php
						foreach ( $profile_completion->empty_fields as $empty_field ) {
							echo '<li>' . __( 'Defina a sua ', 'tutor' ) . '<span> ' . $empty_field . '</span></li>';
						}
						?>
					</ul>
				</div>
				<div class="profile-completion-warning-status">
					<p>
						<span>
							<?php echo $profile_completion->progress . __( '% Complete', 'tutor' ); ?>,
						</span> 
						<?php _e( 'Você está quase acabando!', 'tutor' ); ?>
					</p>
					<div class="tutor-progress-bar-wrap">
						<div class="tutor-progress-bar">
							<div class="tutor-progress-filled" style="--tutor-progress-left: <?php echo $profile_completion->progress; ?>%;"></div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
	<?php
}
?>
