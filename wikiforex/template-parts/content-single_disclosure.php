<?php
/**
 * Loop Name: Content Disclosure Single
 */

$user = get_post_field( 'post_author', $post_id );
$user_info = get_userdata($user);
$terms = get_the_terms( $post->ID, 'disclosure_category' );
 ?>
<article id="post-<?php the_ID(); ?>" <?php post_class('content-single'); ?>>  
        <div class="grid_content_post">
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
                <div class="date_post">
                    <time datetime="<?php echo get_the_date('c'); ?>" itemprop="datePublished"><?php echo get_the_date('d F Y'); ?></time>
                </div>
            </div>
            <div class="broker_banner">
            <?php
                $relation_disclosure = get_field('relation_disclosure');
                if( $relation_disclosure ): ?>
                    <span>broker</span>
                <?php endif; ?>
            </div>
             
            </div>
            <div class="detail_content">
                <?php                         
                    if ( !empty( $terms ) ){
                        $term = array_shift( $terms );
                ?>
                <div class="archive_content">
                    <div class="archive_title">
                        <?php     
                            // get the first term                          
                            echo '<h3>';
                            echo $term->name;
                            echo '</h3>';
                        ?>
                    </div>
                    <div class="archive_detail">
                        <?php                         
                            // get the first term
                            echo '<p>';
                            echo $term->description;
                            echo '</p>';
                        } 
                        ?>
                    </div>
                </div>
                <div class="title_content">
                    <?php the_title( '<h3 class="title-broker">', '</h3>' ); ?>
                </div>
                <div class="excerpt_content">
                    <?php the_content(); ?>
                </div>              
            </div>
            <div class="feature_image_post">
                <a href="<?php the_permalink(); ?>">
                    <?php 
                        if (has_post_thumbnail()) {
                            the_post_thumbnail( 'medium', array( 'class' => 'image_post') );
                        }else{
                            echo '<img src="' . get_stylesheet_directory_uri() 
                            . '/images/thumbnail-default.jpg" />';
                        }
                    ?>
                </a>
            </div>
            <div class="detail_content">
                <div class="sub_detail_content">
                    <div class="cat">
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
                </div>                
            </div>
        </div> 
</article>