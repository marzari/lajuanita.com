	<?php if (get_option('ermad_twitter_enabled')=='true')
		{		
			echo '
				<div class="section all-medium clearfix">
					<div class="band-content full">
						<div class="tweets">
							<h2><a href="http://www.twitter.com/'.get_option('ermad_twitter_account').'/" title="*" >'.get_option('ermad_twitter_label').':</a></h2><span></span>
						</div>
					</div>
				</div>';
		}else{
			/*** 
			
			@todo : fill the space here with a good height without br.
			
			***/

			echo '<br/><br/><br/>';
		}
	?>
		
	</div>
	</div>
	
	<div id="footer-wrapper" >
	<div id="footer" class="clearfix">
		<div id="footer-content" class="clearfix">

		<?php 			
				echo '<div class="section all-medium style-classic">';				
					echo '<div>';
					if ( !function_exists('dynamic_sidebar')  || !dynamic_sidebar('footer-widget-left'));
					echo '</div>';
					
					echo '<div class="custom-tiny">';
					if ( !function_exists('dynamic_sidebar')  || !dynamic_sidebar('footer-widget-center-left') );
					echo '</div>';
					
					echo '<div class="custom-tiny">';
					if ( !function_exists('dynamic_sidebar')  || !dynamic_sidebar('footer-widget-center-right') );
					echo '</div>';
					
					echo '<div class="medium">';
					if ( !function_exists('dynamic_sidebar')  || !dynamic_sidebar('footer-widget-right') );
					echo '</div>';
				echo '</div>';
		?>
		</div> <!--Footer content -->
		
		<div class="dashed-band"></div>

		<?php 
			switch ( get_option('ermad_theme_color') )
			{
				case 'Light': 
					$theme_color = 'light';
					break;  
					
				case 'Brown': 
					$theme_color = 'brown';
					break;  
					
				default: 
					$theme_color = 'light';
					break;  
			}
		?>
		
		<div class="credits">
			<p>
				<img src="<?php bloginfo( 'template_directory' ); ?>/images/<?php echo $theme_color ?>/footer_star.png" alt="star" />
				<?php echo get_option('ermad_credits_line1','<strong>2010</strong> &copy; Copyright <strong>Ermark Adora HTML</strong>')?> 
				<img src="<?php bloginfo( 'template_directory' ); ?>/images/<?php echo $theme_color ?>/footer_star.png" alt="star" />
			</p>
			<p><?php echo get_option('ermad_credits_line2','A Theme by Ermark Studio')?></p>
			<div class="section hr"></div>
		</div>
	</div>
	</div>
	
	</div> <!-- Hash wrapper  -->

	
	<div class="shadows">
		<div class="left"><div class="right"></div></div>
	</div>

	<?php wp_footer(); ?>

</body>
</html>
