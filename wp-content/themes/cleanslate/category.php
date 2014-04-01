<?php
/**
 * The template for routing Category posts to their respective pages.
 *
 * @package CleanSlate
 * @since CleanSlate 0.1
 */
?>

<?php get_header(); ?>
    
    <section id="content">
        
        <?php
            
            $sidebar = FALSE;
            
            if ( have_posts() ) :
                
                if ( is_category('browse') ) :
                    
                    include('content-filters.php');
                    get_template_part('content-browse', get_post_format() );
                    
                else :
                    $sidebar = TRUE;
            ?>
                    
                    <div id="articles">
                    
            <?php
                    while ( have_posts() ) : the_post();
                        get_template_part('content', get_post_format() );
                    endwhile;
            ?>
                    
                    </div>
                    
            <?php
                endif;
                
            else :
                $sidebar = TRUE;
                
                // Content Not Found Template
                include('content-not-found.php');
                
            endif;
        ?>
        
        <?php 
            if ( $sidebar != FALSE) :
                get_sidebar('featured');
            endif;
        ?>
        
        <div class="pagination">
            <div id="next-page"><?php next_posts_link('Next &rarr;','') ?></div>
        </div>
    </section>
    
<?php get_footer(); ?>