<?php
/**
 * The template for displaying archive pages
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package paradiz
 */
get_header(); ?>

<div class="main-body post_body">
    <div id="primary" class="content-area s-container">
        <main id="main" class="site-main">           
            <div class="box_archive box_archive_broker">
            <div class="main_title">
                <h2><?php the_archive_title(); ?></h2>
            </div>
                <div class="main_archive">
                    <?php 
                    if ( have_posts() ) : ?>
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

                    <?php get_template_part( 'template-parts/content', 'none' ); ?>

                    <?php endif; ?>
                </div>
            </div>

        </main>
    </div>
</div>

<?php get_footer(); ?>