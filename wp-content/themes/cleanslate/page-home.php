<?php
/**
 * The main template file.
 *
 * @package CleanSlate
 * @since CleanSlate 0.1
 */
?>

<?php get_header(); ?>
        
    <section id="content">
        <?php
            $photos = get_field('home_slideshow');
            if( empty($photos) != 1 ) :
        ?>
            <div id="gallery-home" class="photos cycle-slideshow"
                data-cycle-fx=scrollHorz
                data-cycle-timeout=0
                data-cycle-prev="#slide-prev"
                data-cycle-next="#slide-next"
                data-cycle-overlay-template="<a href={{url}}><span class=title>{{title}}</span><span class=desc>{{desc}}</span></a>"
                data-cycle-log="false"
            >
                
                <a href="#" class="arrows prev slide-nav"><i class="icon-chevron-left fa-5x"></i></a>
                <a href="#" class="arrows next slide-nav"><i class="icon-chevron-right fa-5x"></i></a>
                <div class="cycle-overlay custom"></div>
                
                <?php
                    foreach( $photos as $photo ) :
                        $photoImage = $photo['home_slide'];
                        $photoPost = reset($photo['home_slide_post']);
                        
                        $terms = reset(wp_get_post_terms( $photoPost->ID, 'project_category'));
                        $postURL = home_url( '/' ) . $terms->slug . 's#' . $photoPost->post_name;
                        
                ?>
                    <img src="<?php echo $photoImage['sizes']['large']; ?>" width="<?php echo $photoImage['sizes']['large-width']; ?>" height="<?php echo $photoImage['sizes']['large-height']; ?>" alt="<?php echo $photoImage['title']; ?>" data-cycle-title="<?php echo $photoPost->post_title; ?>" data-cycle-desc="<?php echo $photo['home_slide_description']; ?>" data-cycle-url="<?php echo $postURL ?>" />
                <?php
                    endforeach;
                ?>
            </div>
        <?php
            endif;
        ?>
    </section>
    
<?php get_footer(); ?>