<?php
/**
 * @package TutorLMS/Templates
 * @version 1.4.3
 */

$product_id = tutor_utils()->get_course_product_id();
$download = new EDD_Download( $product_id );

if ($download->ID) {
	echo edd_get_purchase_link( array( 'download_id' => $download->ID ) );
} else {
	?>
    <p class="tutor-alert-warning">
		<?php _e('Certifique-se de que seu produto existe e é válido para este curso', 'tutor'); ?>
    </p>
	<?php
}