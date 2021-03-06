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
                // Homepage slideshow
                // do_action('slideshow_deploy', '35');
                get_template_part( 'page', 'home' );
                
            else :
            // Content Not Found Template
            include('content-not-found.php');
            
            endif;
        ?>
    </section>
    
<?php get_footer(); ?>