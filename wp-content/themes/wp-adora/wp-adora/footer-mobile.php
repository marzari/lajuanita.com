		
		<?php 
			if(!is_array($_SESSION)){
				echo '<div class="fullVersion"><a href="'.$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI'].'"?version=full">Full version site</a></div>';
			}else{
				'<strong>IS ARRAY!</strong>';
			}
		?>
		
		</div>
		</div>	

		<div id="footer">
			<?php 
				$walker = new Walker_mobile_menu;
				
				wp_nav_menu( array( 
				'theme_location' => 'menu-mobile',
				'walker' => $walker
				)); 			
			?>
		</div>
	</div>
	
	<?php wp_footer(); ?>
</body>
</html>