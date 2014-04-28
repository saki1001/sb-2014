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
            <div id="gallery-home" class="photos">
                <?php
                    foreach( $photos as $photo ) :
                        $photoImage = $photo['home_slide'];
                ?>
                    <div class="photo">
                        <img src="<?php echo $photoImage['sizes']['large']; ?>" width="<?php echo $photoImage['sizes']['large-width']; ?>" height="<?php echo $photoImage['sizes']['large-height']; ?>" alt="<?php echo $photoImage['title']; ?>" />
                    </div>
                <?php
                    endforeach;
                ?>
                <a href="#" class="slidesjs-previous slidesjs-navigation"><i class="icon-chevron-left"></i></a>
                <a href="#" class="slidesjs-next slidesjs-navigation"><i class="icon-chevron-right"></i></a>
            </div>
        <?php
            endif;
        ?>
    </section>
    
<?php get_footer(); ?>