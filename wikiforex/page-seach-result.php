<?php 
/**
 * Template Name: Page Search Result
 */
get_header(); ?>
	<div class="main-body post_body">
		<div class="s-container">

			<div id="primary" class="content-area">
				<main id="main" class="site-main">
					<div class="box_archive box_archive_broker box-result">
						<?php if (isset($_POST['s-object']) == 'passed') { ?>
							<div class="main_title">
								<h2><i class="fas fa-chevron-right"></i> ผลลัพธ์คำที่คุณค้นหา : <?php echo $_POST['keywords']; ?></h2>
							</div>
							<?php
									$args = array(
										'posts_per_page' => 30,
										's' => esc_attr( $_POST['keywords'] ),
										'post_type' => 'broker',
										'orderby' => 'title',
										'order'   => 'DESC'
									);
									query_posts( $args );

							?>
							<div class="main_archive">
								<?php if ( have_posts()) : ?>
									<div class="post_box">
									<?php 
										while ( have_posts() ) : the_post();
										get_template_part( 'template-parts/content', 'broker_card' );
										endwhile; 
									?>
									</div>
									<?php
										paradiz_posts_navigation(); 
									?>   
								<?php else : ?>
										<div class="row">
										<div class="header-project">
											<h2><i class="fas fa-chevron-right"></i> <?php _e( 'ไม่พบคำที่คุณค้นหา' ); ?> <a href="<?php echo get_home_url(); ?>" class="home-a">Back Home Page</a></h2>
										</div>
										</div>
									<?php endif; ?>
									<?php wp_reset_postdata(); ?>


								<?php  } ?>
							</div>	
					</div>

				</main><!-- #main -->
			</div><!-- #primary -->
	</div><!--container-->

</div>


<?php get_footer(); ?>
