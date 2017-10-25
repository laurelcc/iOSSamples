<?php
/**
 * BuddyPress - Members Messages Loop
 *
 * @package BuddyPress
 * @subpackage bp-legacy
 */

/**
 * Fires before the members messages loop.
 *
 * @since 1.2.0
 */
do_action( 'bp_before_member_messages_loop' ); ?>

<?php if ( bp_has_message_threads( bp_ajax_querystring( 'messages' ) ) ) : ?>

	<div class="pagination no-ajax" id="user-pag">

		<h2 class="notif-count">
			<?php global $messages_template; echo bp_core_number_format( $messages_template->total_thread_count ).' messages'; ?>
		</h2>

		<div class="pagination-links" id="messages-dir-pag">
			<?php bp_messages_pagination(); ?>
		</div>

	</div><!-- .pagination -->

	<?php

	/**
	 * Fires after the members messages pagination display.
	 *
	 * @since 1.2.0
	 */
	do_action( 'bp_after_member_messages_pagination' ); ?>

	<?php

	/**
	 * Fires before the members messages threads.
	 *
	 * @since 1.2.0
	 */
	do_action( 'bp_before_member_messages_threads' ); ?>

	<form action="<?php echo bp_loggedin_user_domain() . bp_get_messages_slug() . '/' . bp_current_action() ?>/bulk-manage/" method="post" id="messages-bulk-management">

		<table id="message-threads" class="messages-notices">
			<?php while ( bp_message_threads() ) : bp_message_thread(); ?>

				<tr id="m-<?php bp_message_thread_id(); ?>" class="<?php bp_message_css_class(); ?><?php if ( bp_message_thread_has_unread() ) : ?> unread<?php else: ?> read<?php endif; ?>">
					<td width="1%" class="thread-count">
						<span class="unread-count"><?php bp_message_thread_unread_count(); ?></span>
					</td>
					<td width="1%" class="thread-avatar"><?php bp_message_thread_avatar(); ?></td>

					<?php if ( 'sentbox' != bp_current_action() ) : ?>
						<td width="30%" class="thread-from">
							<?php _e( 'From:', 'buddypress' ); ?> <?php bp_message_thread_from(); ?><br />
							<span class="activity"><?php bp_message_thread_last_post_date(); ?></span>
						</td>
					<?php else: ?>
						<td width="30%" class="thread-from">
							<?php _e( 'To:', 'buddypress' ); ?> <?php bp_message_thread_to(); ?><br />
							<span class="activity"><?php bp_message_thread_last_post_date(); ?></span>
						</td>
					<?php endif; ?>

					<td width="50%" class="thread-info">
						<p><a href="<?php bp_message_thread_view_link(); ?>" title="<?php esc_attr_e( "View Message", "buddypress" ); ?>"><?php bp_message_thread_subject(); ?></a></p>
						<p class="thread-excerpt"><?php bp_message_thread_excerpt(); ?></p>
					</td>

					<?php

					/**
					 * Fires inside the messages box table row to add a new column.
					 *
					 * This is to primarily add a <td> cell to the message box table. Use the
					 * related 'bp_messages_inbox_list_header' hook to add a <th> header cell.
					 *
					 * @since 1.1.0
					 */
					do_action( 'bp_messages_inbox_list_item' ); ?>

					<?php if ( bp_is_active( 'messages', 'star' ) ) : ?>
						<td class="thread-star">
							<?php bp_the_message_star_action_link( array( 'thread_id' => bp_get_message_thread_id() ) ); ?>
						</td>
					<?php endif; ?>

					<td width="13%" class="thread-options">
						<?php if ( bp_message_thread_has_unread() ) : ?>
							<a class="read" href="<?php bp_the_message_thread_mark_read_url();?>"><?php _e( 'Read', 'buddypress' ); ?></a>
						<?php else : ?>
							<a class="unread" href="<?php bp_the_message_thread_mark_unread_url();?>"><?php _e( 'Unread', 'buddypress' ); ?></a>
						<?php endif; ?>
						 |
						<a class="delete" href="<?php bp_message_thread_delete_link(); ?>"><?php _e( 'Delete', 'buddypress' ); ?></a>

						<?php

						/**
						 * Fires after the thread options links for each message in the messages loop list.
						 *
						 * @since 2.5.0
						 */
						do_action( 'bp_messages_thread_options' ); ?>
					</td>
				</tr>

			<?php endwhile; ?>
		</table><!-- #message-threads -->

		<div class="messages-options-nav">
			<?php bp_messages_bulk_management_dropdown(); ?>
		</div><!-- .messages-options-nav -->

		<?php wp_nonce_field( 'messages_bulk_nonce', 'messages_bulk_nonce' ); ?>
	</form>

	<?php

	/**
	 * Fires after the members messages threads.
	 *
	 * @since 1.2.0
	 */
	do_action( 'bp_after_member_messages_threads' ); ?>

	<?php

	/**
	 * Fires and displays member messages options.
	 *
	 * @since 1.2.0
	 */
	do_action( 'bp_after_member_messages_options' ); ?>

<?php else: ?>

	<div id="message" class="info">
		<p><?php _e( 'Sorry, no messages were found.', 'buddypress' ); ?></p>
	</div>

<?php endif;?>

<?php

/**
 * Fires after the members messages loop.
 *
 * @since 1.2.0
 */
do_action( 'bp_after_member_messages_loop' ); ?>
