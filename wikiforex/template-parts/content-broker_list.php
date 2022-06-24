<?php
/**
 * Loop Name: Content Broker List
 */
$icon_broker = get_field( 'icon_broker' );
?>
<article id="post-<?php the_ID(); ?>" <?php post_class('content-single'); ?>>
    <a href="<?php the_permalink(); ?>">
        <div class="grid_list_broker">
            <div class="img">
            <?php 
				 if ( $icon_broker ) {
					 echo '<img src="' . $icon_broker['url']
					 . '" alt="' . $icon_broker['alt'] . '" />';
				 }else{
			 		 echo '<img src="' . get_stylesheet_directory_uri() 
					 . '/images/thumbnail-default.jpg" />';
				 }
				?>
            </div>
            <div class="title_list">
                <?php the_title( '<h4 class="title-broker">', '</h4>' ); ?> 
            </div>
        </div>
    </a>
</article>