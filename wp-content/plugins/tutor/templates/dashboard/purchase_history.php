<?php
/**
 * Purchase history
 * @package TutorLMS/Templates
 * @version 1.4.3
 */

defined( 'ABSPATH' ) || exit;

//global variables
$user_id     = get_current_user_id();
$time_period = $active = isset( $_GET['period'] ) ? $_GET['period'] : '';
$start_date  = isset( $_GET['start_date']) ? sanitize_text_field( $_GET['start_date'] ) : '';
$end_date    = isset( $_GET['end_date']) ? sanitize_text_field( $_GET['end_date'] ) : '';

$paged       = ( isset( $_GET['current_page'] ) && is_numeric( $_GET['current_page'] ) && $_GET['current_page'] >= 1 ) ? $_GET['current_page'] : 1;
$per_page    = tutor_utils()->get_option( 'pagination_per_page', 10 );
$offset      = ( $per_page * $paged ) - $per_page;
if ( '' !== $start_date ) {
    $start_date = tutor_get_formated_date( 'Y-m-d', $start_date );
}

if ( '' !== $end_date ) {
    $end_date = tutor_get_formated_date( 'Y-m-d', $end_date );
}

/**
 * Prepare filter period buttons
 *
 * Array structure is required as below
 *
 * @since 2.0.0
 */
$filter_period = array(
    array(
        'url'   => esc_url( tutor_utils()->tutor_dashboard_url() . 'purchase_history?period=today' ),
        'title' => __( 'Hoje', 'tutor' ),
        'type'  => 'today'
    ),
    array(
        'url'   => esc_url( tutor_utils()->tutor_dashboard_url() . 'purchase_history?period=monthly' ),
        'title' => __( 'Por mês', 'tutor' ),
        'type'  => 'monthly'
    ),
    array(
        'url'   => esc_url( tutor_utils()->tutor_dashboard_url() . 'purchase_history?period=yearly' ),
        'title' => __( 'Anual', 'tutor' ),
        'type'  => 'yearly'
    ),
);

/**
 * Calendar date buttons
 *
 * Array structure is required as below
 *
 * @since 2.0.0
 */

$filter_period_calendar = array(
    'filter_period'   => $filter_period,
    'filter_calendar' => true
);

$filter_period_calendar_template = tutor()->path . 'views/elements/purchase-history-filter.php';
tutor_load_template_from_custom_path( $filter_period_calendar_template, $filter_period_calendar );

$orders       = tutor_utils()->get_orders_by_user_id( $user_id, $time_period, $start_date, $end_date, $offset, $per_page );
$total_orders = tutor_utils()->get_total_orders_by_user_id( $user_id, $time_period, $start_date, $end_date );
$monetize_by  = tutor_utils()->get_option( 'monetize_by' );

?>

<div class="tutor-purchase-history"> 
    <?php if ( tutor_utils()->count( $orders ) ) : ?>
        <div class="tutor-fs-5 tutor-fw-medium tutor-color-black tutor-mb-24"><?php esc_html_e( 'Order History', 'tutor' ); ?></div>
        <div class="tutor-table-responsive">
            <table class="tutor-table">
                <thead>
                    <th width="10%">
                        <?php esc_html_e( 'ID do curso ', 'tutor' ); ?>
                    </th>
                    <th width="45%">
                        <?php esc_html_e( 'Nome do curso', 'tutor' ); ?>
                    </th>
                    <th>
                        <?php esc_html_e( 'Data', 'tutor' ); ?>
                    </th>
                    <th>
                        <?php esc_html_e( 'Preço', 'tutor' ); ?>
                    </th>
                    <th>
                        <?php esc_html_e( 'Status', 'tutor' ); ?>
                    </th>
                    <th></th>
                </thead>

                <tbody>
                    <?php foreach ( $orders as $order ) : ?>
                        <?php
                            if ( $monetize_by === 'wc' ) {
                                $wc_order           = wc_get_order( $order->ID );
                                $price              = tutor_utils()->tutor_price( $wc_order->get_total() );
                                $raw_price          = $wc_order->get_total();
                                $status             = $order->post_status;
                                $badge_class        = 'primary';
                                $order_status_text  = '';

                                switch ( $status ) {
                                    case 'wc-completed' ===  $status:
                                        $badge_class = 'success';
                                        $order_status_text = __( 'Completed', 'tutor' );
                                        break;
                                    case 'wc-processing' ===  $status:
                                        $badge_class = 'warning';
                                        $order_status_text = __( 'Processing', 'tutor' );
                                        break;
                                    case 'wc-on-hold' ===  $status:
                                        $badge_class = 'warning';
                                        $order_status_text = __( 'On Hold', 'tutor' );
                                        break;
                                    case 'wc-refunded' ===  $status:
                                        $badge_class = 'danger';
                                        $order_status_text = __( 'Processing', 'tutor' );
                                        break;
                                    case 'wc-cancelled' ===  $status:
                                        $badge_class = 'danger';
                                        $order_status_text = __( 'Cancelled', 'tutor' );
                                        break;
                                    case 'wc-pending' ===  $status:
                                        $badge_class = 'warning';
                                        $order_status_text = __( 'Pending', 'tutor' );
                                        break;
                                }
                            } else if ( $monetize_by === 'edd' ) {
                                $edd_order          = edd_get_payment( $order->ID );
                                $price              = edd_currency_filter( edd_format_amount( $edd_order->total ), edd_get_payment_currency_code( $order->ID ) );
                                $raw_price          = $edd_order->total;
                                $status             = $edd_order->status_nicename;
                                $badge_class        = 'primary';
                                $order_status_text  = $status;
                            }
                        ?>
                        <tr>
                            <td>
                                #<?php esc_html_e( $order->ID ); ?>
                            </td>

                            <td>
                                <?php
                                    $courses = tutor_utils()->get_course_enrolled_ids_by_order_id( $order->ID );
                                    if ( tutor_utils()->count( $courses ) ) {
                                        foreach ( $courses as $course ) {
                                            echo '<div>' . esc_html( get_the_title( $course['course_id'] ) ) . '</div>';
                                        }
                                    }
                                ?>
                            </td>

                            <td>
                                <?php echo date_i18n( get_option( 'date_format' ), strtotime( $order->post_date ) ); ?>
                            </td>

                            <td>
                                <?php echo wp_kses_post( $price ); ?>
                            </td>

                            <td>
                                <span class="tutor-badge-label label-<?php esc_attr_e( $badge_class ); ?> tutor-m-4"><?php esc_html_e( $order_status_text ); ?></span>
                            </td>
                            
                            <td>
                                <a href="javascript:;" class="tutor-export-purchase-history tutor-iconic-btn tutor-iconic-btn-secondary" data-order="<?php echo esc_attr( $order->ID ); ?>" data-course-name="<?php echo esc_attr( get_the_title( $course['course_id'] ) ); ?>" data-price="<?php echo esc_attr( $raw_price ); ?>" data-date="<?php echo esc_attr( date_i18n( get_option( 'date_format' ), strtotime( $order->post_date ) ) ); ?>" data-status="<?php echo esc_attr( $order_status_text ); ?>">
                                    <span class="tutor-icon-receipt-line" area-hidden="true"></span>
                                </a>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>

        <?php
            $pagination_data = array(
                'total_items' => ! empty( $total_orders ) ? count( $total_orders ) : 0,
                'per_page'    => $per_page,
                'paged'       => $paged,
            );

            $total_page = ceil($pagination_data['total_items'] / $pagination_data['per_page']);
            
            if( $total_page > 1 ) {
                $pagination_template = tutor()->path . 'templates/dashboard/elements/pagination.php';
                tutor_load_template_from_custom_path( $pagination_template, $pagination_data );
            }
        ?>
    <?php else : ?>
        <?php tutor_utils()->tutor_empty_state( tutor_utils()->not_found_text() ); ?>
    <?php endif; ?>
</div>