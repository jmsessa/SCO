<?php

namespace TUTOR_PRO;

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

class General {

	public function __construct() {
		add_action( 'tutor_action_tutor_add_course_builder', array( $this, 'tutor_add_course_builder' ) );
		add_filter( 'frontend_course_create_url', array( $this, 'frontend_course_create_url' ) );
		add_filter( 'template_include', array( $this, 'fs_course_builder' ), 99 );

		add_filter( 'tutor/options/extend/attr', array( $this, 'extend_general_option' ) );
		add_filter( 'tutor_course_builder_logo_src', array( $this, 'tutor_course_builder_logo_src' ) );
		add_filter( 'tutor_email_logo_src', array( $this, 'tutor_email_logo_src' ) );
	}

	/**
	 * Process course submission from frontend course builder
	 *
	 * @since v.1.3.4
	 */
	public function tutor_add_course_builder() {
		// Checking nonce
		tutor_utils()->checking_nonce();

		$user_id          = get_current_user_id();
		$course_post_type = tutor()->course_post_type;

		$course_ID = (int) sanitize_text_field( tutor_utils()->array_get( 'course_ID', $_POST ) );
		$post_ID   = (int) sanitize_text_field( tutor_utils()->array_get( 'post_ID', $_POST ) );

		if ( ! tutor_utils()->can_user_edit_course( $user_id, $post_ID ) ) {
			wp_send_json_error( array( 'message' => __( 'Access Denied', 'tutor-pro' ) ) );
		}

		$post   = get_post( $post_ID );
		$update = true;

		/**
		 * Update the post
		 */

		$content   = wp_kses_post( tutor_utils()->array_get( 'content', $_POST ) );
		$title     = sanitize_text_field( tutor_utils()->array_get( 'title', $_POST ) );
		$tax_input = tutor_utils()->array_get( 'tax_input', $_POST );

		$postData = array(
			'ID'           => $post_ID,
			'post_title'   => $title,
			'post_name'    => sanitize_title( $title ),
			'post_content' => $content,
		);

		// Publish or Pending...
		$message       = null;
		$show_modal    = true;
		$submit_action = tutor_utils()->array_get( 'course_submit_btn', $_POST );

		if ( $submit_action === 'save_course_as_draft' ) {
			$postData['post_status'] = 'draft';
			$message                 = __( 'Course has been saved as a draft.', 'tutor-pro' );
			$show_modal              = false;
		} elseif ( $submit_action === 'submit_for_review' ) {
			$postData['post_status'] = 'pending';
			$message                 = __( 'Course has been submitted for review.', 'tutor-pro' );
		} elseif ( $submit_action == 'publish_course' ) {
			$can_publish_course = (bool) tutor_utils()->get_option( 'instructor_can_publish_course' );
			if ( $can_publish_course || current_user_can( 'administrator' ) ) {
				$postData['post_status'] = 'publish';
				$message                 = __( 'Course has been published.', 'tutor-pro' );
			} else {
				$postData['post_status'] = 'pending';
				$message                 = __( 'Course has been submitted for review.', 'tutor-pro' );
			}
		}

		if ( $message ) {
			update_user_meta( $user_id, 'tutor_frontend_course_message_expires', time() + 5 );
			update_user_meta(
				$user_id,
				'tutor_frontend_course_action_message',
				array(
					'message'    => $message,
					'show_modal' => $show_modal,
				)
			);
		}
		wp_update_post( $postData );

		/**
		 * Setting Thumbnail
		 */
		$_thumbnail_id = (int) sanitize_text_field( tutor_utils()->array_get( 'tutor_course_thumbnail_id', $_POST ) );
		if ( $_thumbnail_id ) {
			update_post_meta( $post_ID, '_thumbnail_id', $_thumbnail_id );
		} else {
			delete_post_meta( $post_ID, '_thumbnail_id' );
		}

		/**
		 * Adding taxonomy
		 */
		if ( tutor_utils()->count( $tax_input ) ) {
			foreach ( $tax_input as $taxonomy => $tags ) {
				$taxonomy_obj = get_taxonomy( $taxonomy );
				if ( ! $taxonomy_obj ) {
					/* translators: %s: taxonomy name */
					_doing_it_wrong( __FUNCTION__, sprintf( __( 'Invalid taxonomy: %s.' ), $taxonomy ), '4.4.0' );
					continue;
				}

				// array = hierarchical, string = non-hierarchical.
				if ( is_array( $tags ) ) {
					$tags = array_filter( $tags );
				}
				wp_set_post_terms( $post_ID, $tags, $taxonomy );
			}
		}

		/**
		 * Adding support for do_action();
		 */
		// Removing below both action to avoid multiple fire
		// do_action( "save_post_{$course_post_type}", $post_ID, $post, $update );
		// do_action( 'save_post', $post_ID, $post, $update );
		do_action( 'save_tutor_course', $post_ID, $postData );

		if ( wp_doing_ajax() ) {
			wp_send_json_success();
		} else {

			/**
			 * If update request not comes from edit page, redirect it to edit page
			 */
			$edit_mode = (int) sanitize_text_field( tutor_utils()->array_get( 'course_ID', $_GET ) );
			if ( ! $edit_mode ) {
				$edit_page_url = add_query_arg( array( 'course_ID' => $post_ID ) );
				wp_redirect( $edit_page_url );
				die();
			}

			/**
			 * Finally redirect it to previous page to avoid multiple post request
			 */
			wp_redirect( tutor_utils()->referer() );
			die();
		}
		die();
	}


	/**
	 * @return string
	 *
	 * Frontend Course builder url
	 */
	public function frontend_course_create_url() {
		return tutor_utils()->get_tutor_dashboard_page_permalink( 'create-course' );
	}


	/**
	 * @param $template
	 *
	 * @return bool|string
	 *
	 * Include Dashboard
	 */
	public function fs_course_builder( $template ) {
		global $wp_query;

		if ( $wp_query->is_page ) {
			$student_dashboard_page_id = (int) tutor_utils()->get_option( 'tutor_dashboard_page_id' );
			if ( $student_dashboard_page_id === get_the_ID() ) {
				if ( tutor_utils()->array_get( 'tutor_dashboard_page', $wp_query->query_vars ) === 'create-course' ) {
					if ( is_user_logged_in() ) {
						$template = tutor_get_template( 'dashboard.create-course' );
					} else {
						$template = tutor_get_template( 'login' );
					}
				}
			}
		}

		return $template;
	}


	public function extend_general_option( $attr ) {
		array_unshift(
			$attr['design']['blocks']['block_course']['fields'],
			array(
				'key'   => 'tutor_frontend_course_page_logo_id',
				'type'  => 'upload_full',
				'label' => __( 'Course Builder Page Logo', 'tutor' ),
				'desc'  => __(
					'<p>Size: <strong>700x430 pixels;</strong> File Support:<strong>jpg, .jpeg or .png.</strong></p>',
					'tutor'
				),
			)
		);

		return $attr;
	}

	public function tutor_course_builder_logo_src( $url ) {
		$media_id = (int) get_tutor_option( 'tutor_frontend_course_page_logo_id' );
		if ( $media_id ) {
			return wp_get_attachment_url( $media_id );
		}
		return $url;
	}

	public function tutor_email_logo_src( $url = null, $size = null ) {

		$media_id = (int) get_tutor_option( 'tutor_email_template_logo_id' );
		if ( $media_id ) {
			return wp_get_attachment_image_url( $media_id, 'tutor-email-logo-size' );
		}
		return $url;
	}
}
