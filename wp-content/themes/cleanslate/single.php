<?php
/**
 * The Template for displaying all single posts.
 *
 * @package CleanSlate
 * @since CleanSlate 0.1
 */
?>

<?php get_header(); ?>
    
    <section id="content">
    
    <?php
        if ( have_posts() ) :
            
            while ( have_posts() ) : the_post();
                
                $category = get_the_category();
                
                // Determine sidebar
                if ( $category[0]->slug === 'browse' ) :
                    $sidebar = '';
                else :
                    $sidebar = '';
                endif;
                
                // Populate sidebar
                get_sidebar($sidebar);
            endwhile;
            
            rewind_posts();
    ?>
            <div id="articles">
            
    <?php
            while ( have_posts() ) : the_post();
                get_template_part('content', get_post_format() );
            endwhile;
    ?>
            
            </div>
    <?php
        else :
            // Content Not Found Template
            include('content-not-found.php');
        
        endif;
    
    ?>
    
    </section>
    
<?php get_footer(); ?>