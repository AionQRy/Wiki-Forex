<?php
/**
 * Loop Name: Content Disclosure List
 */
$user = get_post_field( 'post_author', $post_id );
$user_info = get_userdata($user);
?>
<article id="post-<?php the_ID(); ?>" <?php post_class('content-single'); ?>>
        <div class="grid_list_disclosure">
            <div class="title_list">
                <div class="heade_card">
                    <div class="cat_disclosure">
                    <?php    
                                $terms = get_the_term_list( get_the_ID(), 'disclosure_category', '', ',' ); 
                                $terms = strip_tags( $terms );       
                                $terms = get_the_term_list( get_the_ID(), 'disclosure_category');
                                    if ($terms) {
                                        echo '<span class="term_text">'.$terms.'</span>';                        
                                    } else  {
                                        echo '<p>'.'No Category'.'</p>';
                                    }
                            ?>
                    </div>
                    <div class="broker_relation">
                        <?php
                        $relation_disclosure = get_field('relation_disclosure');
                        if( $relation_disclosure ): ?>
                            <ul>
                            <?php foreach( $relation_disclosure as $post ): 
                            $img_broker = get_field('icon_broker');
                                // Setup this post for WP functions (variable must be named $post).
                                setup_postdata($post); ?>
                                <li>                               
                                    <?php if($img_broker): ?>
                                    <img src="<?php echo $img_broker['url']; ?>" class="img_icon" alt="">
                                    <?php else:
                                        $custom_logo_id = get_theme_mod( 'custom_logo' );
                                        $custom_logo_url = wp_get_attachment_image_url( $custom_logo_id , 'full' );
                                    ?>                                   
                                    <?php echo '<img src="' . get_stylesheet_directory_uri() . '/images/thumbnail-default.jpg" class="img_icon" />'; ?>     
                                    <?php endif;?>
                                    <a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
                                </li>
                            <?php endforeach; ?>
                            </ul>
                            <?php 
                            // Reset the global post object so that the rest of the page works correctly.
                            wp_reset_postdata(); ?>
                        <?php endif; ?>
                    </div>
                </div>
                
                
                <div class="title_disclosure">
                    <a href="<?php the_permalink(); ?>">
                     <?php the_title( '<h4 class="title-broker">', '</h4>' ); ?> 
                    </a>
                </div>
                <div class="excerpt_content">
                <p><?php echo get_excerpt(100); ?></p>
                </div>
                <div class="timeing_box">
                    <div class="avatar_disclosure">
                        <div class="head_profile">
                            <div class="image">
                                <?php if ( $user ) : ?>
                                    <img src="<?php echo esc_url( get_avatar_url( $user ) ); ?>" />
                                <?php endif; ?>
                            </div>
                            <div class="name">
                                <?php
                                $username = $user_info->user_login;
                                $first_name = $user_info->first_name;
                                echo '<p>';
                                echo $user_info->first_name;
                                echo '</p>';
                                ?>
                            </div>            
                        </div>                       
                    </div>
                    <div class="date_post">
                        <time datetime="<?php echo get_the_date('c'); ?>" itemprop="datePublished"><?php echo get_the_date('d F Y'); ?></time>
                    </div>           
                </div>                           
            </div>
            <div class="img">
            <?php 
                        if (has_post_thumbnail()) {
                            the_post_thumbnail( 'medium', array( 'class' => 'image_disclosure') );
                        }else{
                            echo '<img src="' . get_stylesheet_directory_uri() 
                            . '/images/thumbnail-default.jpg" />';
                        }
                    ?>
            </div>          
        </div>

</article>