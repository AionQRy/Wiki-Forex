<?php get_header(); ?>

<?php 
	if ( !is_front_page() && is_home() ) {
		$post_id = get_option( 'page_for_posts' );
	} else {
		$post_id = get_the_ID();
	}
?>

<div class="main-body post_body">
    <div id="primary" class="content-area s-container">
        <main id="main" class="site-main">
            <div class="main_title">
            <?php
				//the_archive_title( '<h3 class="page-title entry-title">', '</h3>' );
            ?>
                <ul class="archive_title">
                    <li class="active"><a href="/blog">ใหม่ล่าสุด</a></li>
                <?php 
                $terms = wp_list_categories( array(
                    'title_li' => '',
                    'exclude' => '1',
                    'order' => 'ASC',
                    'hierarchical' => false
                ) );
                echo $terms;
                ?>
                </ul>
            </div>
            <div class="box_archive">
                <div class="main_archive">
                    <?php if ( have_posts() ) : ?>
                    <div class="post_box">
                    <?php 
                        while ( have_posts() ) : the_post();
                        get_template_part( 'template-parts/content', 'post' );
                        endwhile; 
                    ?>
                    </div>
                    <?php
                        paradiz_posts_navigation(); 
                    ?>                  

                    <?php else : ?>

                    <?php get_template_part( 'template-parts/content', 'none' ); ?>

                    <?php endif; ?>
                </div>
                <div class="aside_archive">
                    <?php echo do_shortcode( '[elementor-template id="317"]' ); ?>
                </div>
            </div>

        </main>
    </div>
</div>

<?php get_footer(); ?>