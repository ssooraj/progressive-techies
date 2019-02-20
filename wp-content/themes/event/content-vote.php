<?php
/**
 * The template for displaying content.
 *
 * @package Theme Freesia
 * @subpackage Event
 * @since Event 1.0
 */
$writer = get_field ( 'writer', $post->ID );
$company = get_field ( 'company', $post->ID );
$vote = VOTE_Public::get_vote( $post->ID );
if(VOTE_Public::check_new( $post->post_date)){
?>
<h4 class="entry-list"> 
	<a class="art-title" href="<?php the_permalink(); ?>" title="<?php the_title_attribute();?>"> <?php the_title();?> - 
		<?php echo $writer;?> 
	</a> 
	<span class="cur-vote"><?php echo $vote; ?> votes</span>
</h4>
<?php }?>