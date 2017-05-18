<?php
/**
 * $Desc
 *
 * @version    $Id$
 * @package    wpbase
 * @author     WpOpal Team <opalwordpress@gmail.com>
 * @copyright  Copyright (C) 2016 http://www.wpopal.com. All Rights Reserved.
 * @license    GNU/GPL v2 or later http://www.gnu.org/licenses/gpl-2.0.html
 *
 * @website  http://www.wpopal.com
 * @support  http://www.wpopal.com/questions/
 */

$GLOBALS['comment'] = $comment;
$add_below = '';

?>
<li <?php comment_class(); ?> id="comment-<?php comment_ID() ?>">

	<div class="the-comment">
		<div class="avatar">
			<?php echo get_avatar($comment, 54); ?>
		</div>

		<div class="comment-box">

			<div class="comment-author meta">
				<strong><?php echo get_comment_author_link() ?></strong>
				<?php printf(esc_html__('%1$s at %2$s', 'jets'), get_comment_date(),  get_comment_time()) ?></a>
				<?php edit_comment_link(esc_html__(' - Edit', 'jets'),'  ','') ?>
				<?php comment_reply_link(array_merge( $args, array( 'reply_text' => esc_html__(' - Reply', 'jets'), 'add_below' => 'comment', 'depth' => $depth, 'max_depth' => $args['max_depth']))) ?>
			</div>

			<div class="comment-text">
				<?php if ($comment->comment_approved == '0') : ?>
				<em><?php esc_html_e('Your comment is awaiting moderation.', 'jets') ?></em>
				<br />
				<?php endif; ?>
				<?php comment_text() ?>
			</div>

		</div>

	</div>