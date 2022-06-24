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

<header class="title-page-header">
        <div class="navigation_page s-container">
            <div class="detail">
                <h5>ที่อยู่ของคุณ <a href="<?php home_url(); ?>">หน้าแรก</a> > <span><?php the_title(); ?></span></h5>
            </div>
        </div>          
</header>            

<div class="main-body post_body body_disclosure single_disclosure">
    <div id="primary" class="content-area s-container">
        <main id="main" class="site-main">
            <div class="main_title">
            <?php
				//the_archive_title( '<h3 class="page-title entry-title">', '</h3>' );
            ?>               
            </div>
            <div class="box_archive">
                <div class="main_archive">

                    <div class="post_box">
                    <?php 

                        get_template_part( 'template-parts/content', 'single_disclosure' );
 
                    ?>
                    </div> 
                            
                        <?php
                        $relation_disclosure = get_field('relation_disclosure');
                        if( $relation_disclosure ): ?>
                        <div class="broker_relation_box">
                            <div class="head_title">
                                <h3>โบรกเกอร์</h3>
                            </div>    
                            <?php foreach( $relation_disclosure as $post ): 
                            $img_broker = get_field('icon_broker');
                            $logo_flag = get_field('flag_country');
                            $url_broker = get_field('url_broker'); 
                            $register_broker = get_field('register_broker');
                            $moderate = get_field('moderate');
                            $image_feature = get_field('image_feature');
                                // Setup this post for WP functions (variable must be named $post).
                                setup_postdata($post); ?>
                            
                        <div class="broker_relation_card">                                               
                            <div class="box-image_broker col_broker <?php if($moderate == 'pass'){ echo 'pass'; }elseif($moderate == 'notpassed'){ echo 'notpassed';}
                                else{ echo 'waiting';} ?>">
                                <?php 
                                    if($moderate == 'pass'){
                                        $status_moderate = 'อยู่ในการกำกับดูแล'; 
                                        $moderate_color = '#2BB351';
                                    }elseif($moderate == 'notpassed'){
                                        $status_moderate = 'ยังไม่มีการกำกับดูแล';
                                        $moderate_color = '#e85e4f';
                                    } else{
                                        $status_moderate = 'อยู่ในระหว่างตรวจสอบ';
                                        $moderate_color = '#ee760c';
                                    } 
                                ?>
                                    <div class="image_class">
                                        <span class="status_broker" style="background: <?php echo $moderate_color; ?>;">  
                                            <?php echo $status_moderate; ?>
                                        </span>
                                        <?php if (has_post_thumbnail()) {
                                                the_post_thumbnail( 'full', array( 'class' => 'image_borker') );
                                            }else{
                                                echo '<img src="' . get_stylesheet_directory_uri() 
                                                . '/images/thumbnail-default.jpg" />';
                                            }?>         
                                        <span class="popup_feature" style="border-color: <?php echo $moderate_color;?>;color: <?php echo $moderate_color;?>;">
                                            <?php echo $status_moderate; ?>    
                                        </span>
                                    </div>
                            </div>
                                            
                            <div class="box-content_broker col_broker">
                                <div class="title_broker">
                                    <?php the_title( '<h2 class="title-broker">', '</h2>' ); ?>                       
                                </div>
                                <div class="img_flag">
                                    <?php
                                        if ( $logo_flag ) {
                                            echo '<img src="' . $logo_flag['url']
                                            . '" alt="' . $logo_flag['alt'] . '" />';
                                        }
                                    ?>                      
                                </div>
                                <div class="content_broker">
                                    <?php if ( have_rows('list_detail') ) : ?>
                                        <ul class="list-content_broker">
                                            <?php 
                                                while( have_rows('list_detail') ) : the_row();
                                                $list = get_sub_field('short_detail');
                                            ?>
                                                <li>
                                                <?php echo $list; ?>
                                                </li>
                                            <?php endwhile; ?>
                                        </ul>
                                    <?php else:?>
                                        <p>ไม่มีข้อมูล</p>
                                    <?php endif; ?>  
                                </div>     
                                <?php if ( $url_broker ) : ?>
                                <div class="website">                   
                                    <p>เว็บไซต์ <span><?php echo $url_broker; ?></span></p> 
                                </div>
                                <?php endif; ?>              
                                            
                            </div>
                        </div>
                            <?php endforeach; ?>

                            <?php 
                            // Reset the global post object so that the rest of the page works correctly.
                            wp_reset_postdata(); ?>
                        </div>
                        <?php endif; ?>
                               

                </div>
                <div class="aside_archive">
                    <div class="button_add">
                        <a href="/post-disclosure/"><i class="far fa-plus-square"></i> แจ้งเรื่องร้องเรียน</a>
                    </div>
                    <div class="side-bar">		
						<h3 class="head_author">มีการร้องเรียนสูงสุดในสัปดาห์นี้</h3>			
						<?php echo do_shortcode( '[ranking_disclosure]' ); ?>
					</div>
                </div>
            </div>

        </main>
    </div>
</div>
<?php endwhile; ?>
<?php get_footer(); ?>