<?php
/**
 * Report Navbar Template
 *
 * @package Report
 */

$current_sub_page = 'overview';
$current_name    = __( 'Visão geral', 'tutor-pro' );
$sub_pages       = array(
	'overview' => __( 'Visão geral', 'tutor-pro' ),
	'courses'  => __( 'Cursos', 'tutor-pro' ),
	'reviews'  => __( 'Avaliações', 'tutor-pro' ),
	'sales'    => __( 'Vendas', 'tutor-pro' ),
	'students' => __( 'Estudantes', 'tutor-pro' ),
);

if ( ! empty( $_GET['sub_page'] ) ) {
	$current_sub_page = sanitize_text_field( $_GET['sub_page'] );
	$current_name    = isset( $sub_pages[ $current_sub_page ] ) ? $sub_pages[ $current_sub_page ] : '';
}
?>
<div class="tutor-admin-wrap">
	<div class="tutor-wp-dashboard-header tutor-px-24 tutor-mb-24">
		<div class="tutor-row tutor-align-lg-center">
			<div class="tutor-col-lg">
				<div class="tutor-d-lg-flex tutor-align-lg-center tutor-p-12">
					<span class="tutor-fs-5 tutor-fw-medium">
						<?php esc_html_e( 'Relatórios SCO', 'tutor-pro' ); ?>
					</span>

					<span class="tutor-mx-8" area-hidden="true">/</span>
					
					<span class="tutor-fs-7 tutor-color-muted">
						<?php echo esc_html( $current_name ); ?>
					</span>
				</div>
			</div>

			<div class="tutor-col-lg-auto">
				<ul class="tutor-nav tutor-nav-admin">
					<?php foreach ( $sub_pages as $key => $page ) : ?>
						<?php
							$is_active = $page === $current_name ? ' is-active' : '';
							$url       = add_query_arg(
								array(
									'page'     => 'tutor_report',
									'sub_page' => $key,
								),
								admin_url( 'admin.php' )
							);
						?>
						<li class="tutor-nav-item">
							<a class="tutor-nav-link<?php echo esc_attr( $is_active ); ?>" href="<?php echo esc_url( $url ); ?>">
								<?php echo esc_html( $page ); ?>
							</a>
						</li>
					<?php endforeach; ?>
				</ul>
			</div>
		</div>
	</div>

	<div class="tutor-admin-body">
		<div class="report-main-wrap">
			<div class="tutor-report-content">
				<?php
				$page = 'overview';
				if ( ! empty( $_GET['sub_page'] ) ) {
					$page = sanitize_text_field( $_GET['sub_page'] );
				}
				$view_page = TUTOR_REPORT()->path . 'views/pages/';

				if ( file_exists( $view_page . $page . "/{$page}.php" ) ) {
					include $view_page . $page . "/{$page}.php";
				} elseif ( file_exists( $view_page . "{$page}.php" ) ) {
					include $view_page . "{$page}.php";
				}
				?>
			</div>
		</div>
	</div>
</div>