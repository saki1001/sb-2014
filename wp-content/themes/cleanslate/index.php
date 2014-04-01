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
            if ( have_posts() ) :
                
                while ( have_posts() ) : the_post();
                    get_sidebar();
                endwhile;
                
                rewind_posts();
        ?>
        
        <div id="articles">
        
        <?php
                while ( have_posts() ) : the_post();
                    get_template_part( 'content', get_post_format() );
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