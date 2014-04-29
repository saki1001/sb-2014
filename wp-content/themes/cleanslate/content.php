<?php
/**
 * The general template for displaying content.
 *
 * @package CleanSlate
 * @since CleanSlate 0.1
 */
?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?> data-post-id="<?php echo date('m-d-Y', strtotime(get_the_date())); ?>">
    <div class="media" data-toggle-state="photos">
        <?php
            $photos = get_field('photos');
            if( empty($photos) != 1 ) :
                $hasPhotos = true;
        ?>
            <div id="gallery-<?php the_ID(); ?>" class="photos active-display"
                data-cycle-fx=scrollHorz
                data-cycle-timeout=0
                data-cycle-prev=".arrows.prev"
                data-cycle-next=".arrows.next"
                data-cycle-center-horz=true
                data-cycle-center-vert=true
                data-cycle-log="false"
            >
                
                <a href="#" class="arrows prev slide-nav"><i class="icon-chevron-left fa-5x"></i></a>
                <a href="#" class="arrows next slide-nav"><i class="icon-chevron-right fa-5x"></i></a>
                
                <?php
                    foreach( $photos as $photo ) :
                        $photoImage = $photo['photo'];
                ?>
                    <img src="<?php echo $photoImage['sizes']['large']; ?>" width="<?php echo $photoImage['sizes']['large-width']; ?>" height="<?php echo $photoImage['sizes']['large-height']; ?>" alt="<?php echo $photoImage['title']; ?>" />
                <?php
                    endforeach;
                ?>
            </div>
        <?php
            endif;
        ?>
        
        <?php
            if( get_field('video') ) :
                $hasVideo = true;
        ?>
            <div id="video-<?php the_ID(); ?>" class="video">
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
            
            <?php
                if( $hasPhotos === true && $hasVideo === true ) :
            ?>
                <div class="media-toggle">
                    <a href="#" data-toggle-value="show-photos">Photos</a>
                    <span>|</span>
                    <a href="#" data-toggle-value="show-video">Video</a>
                </div>
            <?php
                endif;
            ?>
        </div>
        
        <div class="text">
            <?php the_field('caption'); ?>
        </div>
    </div>
</article>