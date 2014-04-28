<?php
/**
 * The general template for displaying content.
 *
 * @package CleanSlate
 * @since CleanSlate 0.1
 */
?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?> data-post-id="<?php echo date('m-d-Y', strtotime(get_the_date())); ?>">
    <div class="media" data-toggle-state="video">
        <?php
            $photos = get_field('photos');
            if( empty($photos) != 1 ) :
        ?>
            <div id="gallery-<?php the_ID(); ?>" class="photos">
                <?php
                    foreach( $photos as $photo ) :
                        $photoImage = $photo['photo'];
                ?>
                    <div class="photo">
                        <img src="<?php echo $photoImage['sizes']['medium']; ?>" width="<?php echo $photoImage['sizes']['medium-width']; ?>" height="<?php echo $photoImage['sizes']['medium-height']; ?>" alt="<?php echo $photoImage['title']; ?>" />
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
        
        <?php
            if( get_field('video') ) :
        ?>
            <div id="video-<?php the_ID(); ?>" class="video active-display">
                <?php the_field('video'); ?>
            </div>
        <?php
            endif;
        ?>
    </div>
    <div class="info">
        <div class="post-header">
            <div class="info">
                <h2 class="title"><?php the_title();?></a></h2>
                <p class="director">By <?php the_field('director'); ?></p>
            </div>
            <div id="media-toggle">
                <a href="#" id="show-photos">Photos</a>
                <span>|</span>
                <a href="#" id="show-video">Video</a>
            </div>
        </div>
        
        <div class="text">
            <?php the_field('caption'); ?>
        </div>
    </div>
</article>