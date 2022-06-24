<?php
/**
 * Loop Name: Content Post Home
 */
?>
<article id="post-<?php the_ID(); ?>" <?php post_class('content-single'); ?>>  
        <div class="grid_content_home">
            <div class="feature_image_post">
            <div class="cat">           
                        <?php
                            $themes = get_the_terms( get_the_ID(), 'category');
                            if ($themes && ! is_wp_error($themes)): ?>
                                <?php foreach($themes as $theme):       
                                    if ($theme->slug == 'uncategorized'): 
                                        continue;?>   
                                    <?php endif; ?>                    
                                    <div class="cat_line <?php echo $theme->slug; ?>">
                                        <a href="<?php echo get_term_link( $theme->slug, 'category'); ?>" rel="tag" 
                                        class="custom <?php echo $theme->slug; ?>">
                                        <?php echo $theme->name; ?>  
                                        </a>                         
                                    </div>                               
                                <?php endforeach; ?>
                                <?php else: 
                                    echo '<p>'.'No Category'.'</p>';
                                ?>
                        <?php endif; ?>
                    </div>
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
                <div class="title_content">
                    <a href="<?php the_permalink(); ?>"><?php the_title( '<h3 class="title-post">', '</h3>' ); ?></a>
                </div>
                <div class="excerpt_content">
                    <?php echo get_excerpt(75); ?>
                </div>
                <div class="sub_detail_content">
                    <div class="date_post">
                    <time datetime="<?php echo get_the_date('c'); ?>" itemprop="datePublished"><?php echo get_the_date('d F Y'); ?></time>
                    </div>
                </div>                
            </div>
        </div> 
</article>