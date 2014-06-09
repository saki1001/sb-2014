<?php
/**
 * The general template used for displaying page content in page.php.
 *
 * @package CleanSlate
 * @since CleanSlate 0.1
 */
?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
    
    <?php
        $features = get_field('features');
        $television = get_field('television');
    ?>
    
    <div id="text" class="text-container">
        
        <?php
            if( !empty($features) ) :
        ?>
            <ul class="features">
                <li><h3>Features</h3></li>
        <?php
                
                foreach( $features as $feature ) :
                    $title = $feature['feature_title'];
                    $co = $feature['feature_company'];
                    $prod = $feature['feature_producers'];
                    $dir = $feature['feature_director'];
                    $note = $feature['feature_notes'];
        ?>
                    <li>
                        <div class="col1 title">
                            <h4><?php echo $title; ?></h4>
                            <span class="note"><?php echo $note; ?></span>
                        </div>
                        <p class="col2 company"><?php echo $co; ?></p>
                        <p class="col3 producer">Prod: <?php echo $prod; ?></p>
                        <p class="col4 director">Dir: <?php echo $dir; ?></p>
                    </li>
        <?php
                    
                endforeach;
                
        ?>
            </ul>
        <?php
            endif;
            
            if( !empty($television) ) :
        ?>
            <ul class="television">
                <li><h3>Television</h3></li>
        <?php
                
                foreach( $television as $tele ) :
                    $title = $tele['tele_title'];
                    $co = $tele['tele_company'];
                    $prod = $tele['tele_producers'];
                    $dir = $tele['tele_director'];
                    $note = $tele['tele_notes'];
        ?>
                    <li>
                        <div class="col1 title">
                            <h4><?php echo $title; ?></h4>
                            <span class="note"><?php echo $note; ?></span>
                        </div>
                        <p class="col2 company"><?php echo $co; ?></p>
                        <p class="col3 producer">Prod: <?php echo $prod; ?></p>
                        <p class="col4 director">Dir: <?php echo $dir; ?></p>
                    </li>
        <?php
                    
                endforeach;
                
        ?>
            </ul>
        <?php
            endif;
        ?>
        
    </div>
    
</article>