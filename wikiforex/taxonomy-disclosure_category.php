<?php
/**
 * The template for displaying archive pages
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package paradiz
 */
get_header(); ?>

<header class="title-page-header">
        <div class="navigation_page s-container">
            <div class="detail">
                <h5>ที่อยู่ของคุณ <a href="<?php home_url(); ?>">หน้าแรก</a> > <span><?php the_archive_title(); ?></span></h5>
            </div>
        </div>          
    </header>            

<div class="main-body post_body body_disclosure">
    <div id="primary" class="content-area s-container">
        <main id="main" class="site-main">
            <div class="main_title">
            <?php
				//the_archive_title( '<h3 class="page-title entry-title">', '</h3>' );
            ?>               
            </div>
            <div class="box_archive">
                <div class="aside_taxonomy">
                    <ul class="archive_title menu_disclosure">
                        <li class="active"><a href="/disclosure">ทั้งหมด</a></li>
                    <?php 
                    $terms = wp_list_categories( array(
                        'title_li' => '',
                        'exclude' => '1',
                        'taxonomy' => 'disclosure_category',
                        'order' => 'ASC',
                        'hierarchical' => false
                    ) );
                    echo $terms;
                    ?>
                    </ul>
                </div>
                <div class="main_archive">
                    <?php if ( have_posts() ) : ?>
                    <div class="post_box">
                    <?php 
                        while ( have_posts() ) : the_post();
                        get_template_part( 'template-parts/content', 'disclosure_card' );
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
                    <div class="button_add">
                        <a href="#"><i class="far fa-plus-square"></i> แจ้งเรื่องร้องเรียน</a>
                    </div>
                    <div class="side-bar">		
						<h3 class="head_author">มีการร้องเรียนสูงสุดในสัปดาห์นี้</h3>			
						<?php echo do_shortcode( '[shortcode_ranking]' ); ?>
					</div>
                </div>
            </div>

        </main>
    </div>
</div>

<?php get_footer(); ?>