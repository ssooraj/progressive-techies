<div id="cvm" class="wrap">
	<div class="cvm-container">
		<div class="cvm-column cvm-primary">
			<h2>Cust Vote Manager</h2>
			<form id="cvm_settings" method="post" action="options.php">
			<?php settings_fields( 'cust_vote_manager' ); ?>
				<table class="form-table">

					<tr valign="top">
						<th><label for="voting_end_date"><?php _e('Voting end date','cust-vote-manager');?></label></th>
						<td>
							<input type="text" class="widefat" name="cust_vote_manager[voting_end_date]" id="voting_end_date" value="<?php echo esc_attr($opts['voting_end_date']); ?>" /> 
						</td>
					</tr>
					<tr valign="top">
						<th><label for="articles_published_in"><?php _e('Articles published in','cust-vote-manager');?></label></th>
						<td>
							<input type="text" class="widefat" name="cust_vote_manager[articles_published_in]" id="articles_published_in" value="<?php echo esc_attr($opts['articles_published_in']); ?>" /> 
						</td>
					</tr>
				</table>
				<?php
					submit_button();
				?>
			</form>
		</div>
	</div>
</div>