<?php
/**
 * Template: Single Broker
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#single-post
 *
 * @package paradiz
 */

get_header(); ?>

<?php while ( have_posts() ) : the_post(); ?>


<div class="main-body">
    <div id="primary" class="content-area">
        <main id="main" class="site-main hide-title">

            <?php get_template_part( 'template-parts/content-single_broker' ); ?>

            <?php wp_reset_postdata(); ?>

        </main>
    </div>
</div>
<?php endwhile; ?>
<?php get_footer(); ?>