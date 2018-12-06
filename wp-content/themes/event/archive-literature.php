<?php
/**
 * The main template file.
 *
 * Learn more: http://codex.wordpress.org/Template_Hierarchy
 *
 * @package Theme Freesia
 * @subpackage Event
 * @since Event 1.0
 */
get_header(); ?>

<div id="primary">
	<?php
	if( have_posts() ) {
		while(have_posts() ) {
			the_post();
			get_template_part( 'content',  'vote' );
		}
	} else { ?>
		<h2 class="entry-title"> <?php esc_html_e( 'No Posts Found.', 'event' ); ?> </h2>
	<?php } ?>
</div>
<?php get_template_part( 'pagination', 'none' ); ?>
<?php if ( is_active_sidebar( 'event_category_sidebar' ) ) : ?>
	<ul id="secondary">
		<?php dynamic_sidebar( 'event_category_sidebar' ); ?>
	</ul>
<?php endif;

get_footer();