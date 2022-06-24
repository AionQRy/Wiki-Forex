<?php
/**
 * Loop Name: Content Post Recent
 */
?>
<article id="post-<?php the_ID(); ?>" <?php post_class('content-single'); ?>>  
        <div class="grid_list_post">
            <div class="title_list">
            <a href="<?php the_permalink(); ?>"><?php the_title( '<h4 class="title-broker">', '</h4>' ); ?></a>
            </div>
            <div class="date_list">
                <div class="cat">           
                        <?php
                            $themes = get_the_terms( get_the_ID(), 'category');
                            if ($themes && ! is_wp_error($themes)): ?>
                                <?php foreach($themes as $theme): ?>                              
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
                <div class="date_post">
                   <time datetime="<?php echo get_the_date('c'); ?>" itemprop="datePublished"><?php echo get_the_date('d F Y'); ?></time>
                </div>
            </div>
        </div> 
</article>