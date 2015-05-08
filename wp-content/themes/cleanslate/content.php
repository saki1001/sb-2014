<?php
/**
 * The general template for displaying content.
 *
 * @package CleanSlate
 * @since CleanSlate 0.1
 */
?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?> data-post-id="<?php echo date('m-d-Y', strtotime(get_the_date())); ?>">
    <div class="media">
        <?php
            $hasPhotos = false;
            $photos = get_field('photos');
            if( empty($photos) != 1 ) :
                $hasPhotos = true;
        ?>
            <div id="gallery-<?php the_ID(); ?>" class="photos"
                data-cycle-fx=scrollHorz
                data-cycle-timeout=0
                data-cycle-prev=".arrows.prev"
                data-cycle-next=".arrows.next"
                data-cycle-log="false"
            >
            <?php
                $pI = 1;
                foreach( $photos as $photo ) :
                    $photoImage = $photo['photo'];
            ?>
                <img
                    src="<?php echo $photoImage['sizes']['large']; ?>"
                    width="<?php echo $photoImage['sizes']['large-width']; ?>"
                    height="<?php echo $photoImage['sizes']['large-height']; ?>"
                    alt="<?php echo $photoImage['title']; ?>" />
            <?php
                    $pI++;
                endforeach;
                
                // Show nav for 1 or more Videos
                if( $pI > 2 ) :
            ?>
                <div class="cycle-pager"></div>
                <a href="#" class="arrows prev slide-nav"><i class="icon-chevron-left fa-5x"></i></a>
                <a href="#" class="arrows next slide-nav"><i class="icon-chevron-right fa-5x"></i></a>
            <?php
                endif;
            ?>
            </div>
        <?php
            endif;
        ?>
        
        <?php
            $hasVideo = false;
            $videos = get_field('videos');
            if( empty($videos) != 1 ) :
                $hasVideo = true;
        ?>
            <div id="video-cycle-<?php the_ID(); ?>" class="videos"
                data-cycle-fx=scrollHorz
                data-cycle-timeout=0
                data-cycle-prev=".arrows.prev"
                data-cycle-next=".arrows.next"
                data-cycle-log="false"
                data-cycle-slides="> div"
                data-cycle-caption="#video-caption"
                data-cycle-pager-template="<a href='#'>{{title}}</a>"
            >
                <?php
                    // Loop through Video Embed Codes
                    $vI = 1;
                    foreach( $videos as $video ) :
                        
                        // Set src and ID for Vimeo API
                        // Create a DOM object
                        $html = new simple_html_dom();
                        
                        // Load HTML from a string
                        $html->load($video['video_embed']);
                        
                        $iframe = $html->find('iframe',0);
                        
                        // Set ID
                        $iframe->id = 'post-' . $post->id . 'video-' . $vI;

                        // Set Title
                        $iframe->title = $video['video_title'];
                        
                        $id = $iframe->id;
                        $source = $iframe->src;
                        $source .= '?api=1&player_id=' . $id;
                        
                        // Set source
                        $iframe->src = $source;
                        
                        echo $iframe;
                        
                        // Avoid memory leaks
                        $html->clear();
                        
                        $vI++;
                    endforeach;
                    
                    // Show nav for 1 or more Videos
                    if( $vI > 2 ) :
                ?>
                    <span class="cycle-pager"></span>
                    <a href="#" class="arrows prev slide-nav"><i class="icon-chevron-left fa-5x"></i></a>
                    <a href="#" class="arrows next slide-nav"><i class="icon-chevron-right fa-5x"></i></a>
                <?php
                    endif;
                ?>
            </div>
        <?php
            endif;
        ?>
    </div>
    <div class="description">
        <div class="post-header">
            <div class="info">
                <h2 class="title"><?php the_title();?></a></h2>
                <p class="director">Directed by <?php the_field('director'); ?></p>
            </div>
            
            <?php
                if( $hasPhotos === true && $hasVideo === true ) :
            ?>
                <div class="media-toggle">
                    <a href="#" class="toggle-photos" data-toggle-value="show-photos">Photos</a>
                    <span>|</span>
                    <a href="#" class="toggle-video" data-toggle-value="show-video">Video</a>
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